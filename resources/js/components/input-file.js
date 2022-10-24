function initInputFile(name, maxSize = 1000) {

    const imageDisplay = $(`#${name}_display_uploaded`),
      inputFile = $(`#${name}_image_upload`),
      inputBase64 = $(`#${name}_image_uploaded`),
      inputUpdate = $(`#${name}_image_uploaded_update`),
      imgDefautUrl = asset_global_images + '/upload.jpg',
      btnDelete = $(`#${name}_delete_btn`);
  
    imageDisplay.on('click', function () {
      inputFile.trigger('click');
    });
  
    inputFile.on('change', function () {
      var reader = new FileReader();
      let size_kb = this.files[0].size / 1024;
      //let size_kb = 400;
      switch (this.files[0].type) {
        case 'image/jpeg':
        case 'image/jpg':
        case 'image/png':
          if (size_kb / 1000 <= maxSize / 1000) {
            reader.onload = function (e) {
              var old_base64 = e.target.result
              imageDisplay.attr('src', old_base64);
              inputBase64.val(old_base64);
            }
            reader.readAsDataURL(this.files[0]);
            $(`#${name}-lbl-valid`).addClass('d-none');
          } else {
            Swal.fire({
              title: '¡Error!',
              text: `La imágen no puede ser mayor a ${maxSize/1000} mb. Peso de la imagen actual subida: ${(size_kb/1000).toFixed(2)} mb aproximadamente.`,
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-primary'
              },
              buttonsStyling: false
            });
          }
          break;
        default:
          Swal.fire({
            title: '¡Error!',
            text: `Solo se permiten imágenes con formatos JPG, JPEG y PNG`,
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          });
          break;
      }
    });
  
    inputUpdate.on('change', function () {
      const value = inputUpdate.val();
      if (value == '') {
        imageDisplay.attr('src', imgDefautUrl);
      } else {
        imageDisplay.attr('src', value);
      }
      inputBase64.val(value);
    });
  
    btnDelete.on('click', function () {
      imageDisplay.attr('src', imgDefautUrl);
      inputBase64.val('borrado');
    })
  }
  
