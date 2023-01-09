$(function () {
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
   * Product Form Submission
   */
  const addProduct = $('#addProduct');

  addProduct.submit(function (e) {
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

          console.log(addProduct[0].reset());
          picturePreview.addClass('d-none');
          picturePlaceholder.removeClass('d-none').attr('src', '');
        }
      },
    });
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
});
