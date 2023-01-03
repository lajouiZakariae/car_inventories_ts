const picturePlaceholder = document.getElementById("picturePlaceholder");

if (picturePlaceholder) {
  picturePlaceholder.onclick = function () {
    const pictureInput = document.getElementById("pictureInput");
    pictureInput.click();
  };

  pictureInput.onchange = function () {
    const fileReader = new FileReader();

    fileReader.readAsDataURL(this.files[0]);

    fileReader.onload = function () {
      const picturePreview = document.getElementById("picturePreview");

      if (picturePreview) {
        picturePreview.classList.remove("d-none");
        picturePreview.src = this.result;
        picturePlaceholder.classList.add("d-none");
      }
    };

    fileReader.onerror = function () {
      picturePlaceholder.classList.add("picture-placeholder-error");
    };
  };
}
