$(function () {
  // Random
  $('.random').click(function () {
    $('input[name=title]').val('Jacket');
    $('input[name=description]').val('lorem ipsum dolor');
    $('input[name=cost]').val('65');
    $('input[name=price]').val('85');
  });
  /**
   * Image Preview
   */
  const pictureInput = $('#pictureInput');
  const picturePlaceholder = $('#picturePlaceholder');
  const picturePreview = $('#picturePreview');

  picturePlaceholder.click(() => pictureInput.click()); // Trigger the file upload click

  pictureInput.change(function () {
    const supportedExt = ['jpg', 'jpeg', 'png'];
    const ext = this.files[0].name.split('.').pop();

    if (supportedExt.includes(ext)) {
      const fileReader = new FileReader();
      fileReader.readAsDataURL(this.files[0]);

      fileReader.onload = function () {
        if (picturePlaceholder.hasClass('picture-placeholder-error')) {
          // Remove error msg if already Exists
          picturePlaceholder
            .removeClass('picture-placeholder-error')
            .children()
            .first()
            .text('Add Picture');
        }
        picturePreview.attr('src', this.result).parent().removeClass('d-none');
        picturePlaceholder.hide().removeClass('d-flex');
      };

      fileReader.onerror = function () {
        picturePlaceholder.addClass('picture-placeholder-error');
      };
    } else {
      picturePlaceholder
        .addClass('picture-placeholder-error')
        .children()
        .first()
        .text('Image Required');
    }
  });

  $('.edit-image').click(() => pictureInput.click());

  $('.delete-image').click(function () {
    picturePreview.attr('src', '').parent().addClass('d-none');
    picturePlaceholder.show().addClass('d-flex');
    $('input[name=picture]').val('');
  });

  /**
   * Gallery
   */
  const uploadForm = $('#uploadImage');
  const addBtn = $('#addImage');
  const imageInput = $('#imageInput');

  const images = new FormData(uploadForm[0]);
  const imagesPreview = [];
  addBtn.click(() => imageInput.click());

  images.delete('picture');

  imageInput.change(function () {
    if (!images.get(this.files[0].name)) {
      const loading = $('.loading');
      loading.toggleClass('d-none');

      // 1. Append file to FormData
      images.append(this.files[0].name, this.files[0]);
      // 2. Read Content and append it to the list of previews
      const fileReader = new FileReader();
      fileReader.readAsDataURL(this.files[0]);

      fileReader.onload = function () {
        imagesPreview.push(this.result);
        loading.toggleClass('d-none');
        renderImagesPreview();
      };
    } else {
      // Already Exists
    }
  });

  function renderImagesPreview() {
    const container = $('.images').first();

    container.children().remove();

    for (const imgPrev of imagesPreview) {
      const img = $('<img />');
      img.attr('src', imgPrev);
      img.css({
        width: '140px',
        height: '140px',
        'objec-fit': 'cover',
        'border-radius': '5px',
        'margin-left': '5px',
        'margin-right': '5px',
        'margin-bottom': '5px',
      });
      container.append(img);
    }
  }
  /**
   * Image Upload
   */
  uploadForm.submit(function (ev) {
    ev.preventDefault();

    $.ajax({
      url: 'post.php',
      type: 'POST',
      data: images,
      processData: false,
      contentType: false,
      success(data) {
        console.log(data);
      },
      error() {
        throw new Error('Ooops!');
      },
    });
  });

  /**
   * Product Form Submission
   */
  $('#addProduct').submit(function (e) {
    e.preventDefault();
    const product = new FormData(this);
    product.append('ready_to_sell', this.ready_to_sell.checked);

    /**
     * TODO: Data Validation
     */

    $.ajax({
      url: '/products/post.php',
      type: 'POST',
      data: product,
      processData: false,
      contentType: false,
      success(data) {
        const errorBox = $('.error-box');
        if (data.errors && Object.keys(data.errors).length) {
          // Display All the errors
          errorBox.show().children().remove();

          for (const error of Object.values(data.errors))
            errorBox.append($('<p class="m-0"></p>').text(error));
        } else if (data.msg === 'created') {
          errorBox.hide();
          $('.success-box')
            .text('Product is Saved')
            .fadeIn(700)
            .delay(1000)
            .fadeOut(700);

          this.reset();
          picturePlaceholder.show().addClass('d-flex');
          picturePreview.parent().addClass('d-none');
        }
      },
    });
  });

  /**
   *  Display Stores
   */
  function renderStores() {
    const container = $('.stores-listing');
    container.children().remove();
    container.append($('<span class="loading">Loading...</span>'));

    $.ajax({
      url: 'stores.php',
      error(err) {
        container
          .find('.loading')
          .replaceWith($('<span class="text-danger">').text('Someting wrong!'));
      },
      success(data) {
        if (data.stores) {
          container.find('.loading').remove();

          for (const store of data.stores) {
            const card = $(
              '<div class="store border rounded p-3 mb-2 d-flex ">'
            );
            card.append(
              $('<div style="flex: 1 1 auto;"></div>').append(
                $('<h4></h4>').text(store.name)
              )
            );

            /**
             * TODO: Complete Store Editing
             */
            function deleteStore() {
              $.ajax({
                url: 'delete.php?id=' + store.id,
                success(data) {
                  if (data.deleted) renderStores();
                },
                error(err) {
                  console.log(err);
                },
              });
            }

            function editStore() {
              const h4 = $(this).parent().parent().parent().find('h4');
              console.log(h4);
              const nameInput = $('<input type="text" class="form-control">');
              h4.replaceWith(nameInput);
              nameInput.val(h4.text());

              const saveBtn = $(
                '<button type="submit" class="btn btn-sm btn-success">Save</button>'
              );

              $(this).replaceWith(saveBtn);
            }

            function updateStore(e) {
              e.preventDefault();
              const product = new FormData(this);
              product.append('id', store.id);
              const nameInp = $(this).parent().parent().find('input');
              product.append('name', nameInp.val());

              $.ajax({
                url: 'edit.php',
                type: 'POST',
                processData: false,
                contentType: false,
                data: product,
                success(response) {
                  console.log(response);
                },
                error(err) {
                  console.log(err);
                },
              });
            }

            const editForm = $('<form class="d-inline-block">')
              .append(
                $('<button type="button" class="btn btn-sm btn-dark">')
                  .text('Edit')
                  .click(editStore)
              )
              .submit(updateStore);

            const deleteButton = $(
              '<button class="btn btn-sm btn-danger ms-2">'
            )
              .text('Delete')
              .click(deleteStore);

            card.append($('<div>').append([editForm, deleteButton]));
            $('.stores-listing').append(
              $('<div class="col-12"></div>').append(card)
            );
          }
        }
      },
    });
  }
  renderStores();
  /**
   * Store Form Submission
   */
  $('#storeForm').submit(function (e) {
    e.preventDefault();
    const store = new FormData(this);
    /**
     * TODO: DATA VALIDATION
     */
    $.ajax({
      url: 'post.php',
      type: 'POST',
      processData: false,
      contentType: false,
      data: store,
      success(data) {
        if (data.msg === 'duplicate') {
          $('.add-store-msg')
            .show()
            .removeClass('text-danger')
            .addClass('text-danger')
            .text('Already exists');
        } else if (data.msg === true) {
          $('.add-store-msg')
            .show()
            .removeClass('text-danger')
            .addClass('text-success')
            .text('Saved!')
            .delay(2000)
            .fadeOut(700);
          renderStores();
        }
      },
      error(err) {
        console.log(err);
      },
    });
  });
});
