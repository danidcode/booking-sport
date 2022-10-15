function initInputFile(name, maxSize = 1000) {
    // CARGA DE IMÁGENES
    const imageDisplay = $(`#${name}_display_uploaded`),
      inputFile = $(`#${name}_image_upload`),
      inputBase64 = $(`#${name}_image_uploaded`),
      inputUpdate = $(`#${name}_image_uploaded_update`),
      imgDefautUrl = '/images/pages/upload.png',
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
      //Apaño, hay que arreglar
      inputBase64.val('borrado');
    })
  }
  
  function changeImgSource(name, source) {
    $(`#${name}_display_uploaded`).attr('src', source);
  }
  
  function clearImg(name) {
    $(`#${name}_image_uploaded_update`).val('').trigger('change');
  }
  
  function getHtmlInputFile(name, options = null) {
    let inputName = name;
    let classRequired = '';
    let htmlRequired = '';
    let infoMessage = '';
    let imageStyle = 'max-height: 100%';
    if (options != null && options != undefined) {
      // Saber si es múltiple, es decir, habrán varios inputs con name []
      if (options.multiple != undefined && options.multiple == true) {
        inputName += '[]';
        do {
          name += '_' + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
        } while ($(`#${name}_display_uploaded`).length > 0);
      }
      // Saber si es requerido
      if (options.required != undefined && options.required == true) {
        classRequired = 'image-upload-required';
        htmlRequired = `<small id="${name}-lbl-valid" class="w-100 text-danger d-none">La imagen es requerida</small>`;
      }
      // Saber si tiene un mensaje de info
      if (options.infoMessage != undefined) {
        infoMessage = `<small class="w-100"><i class="mr-50" data-feather="info"></i>${options.infoMessage}</small>`;
      }
      // Saber si la imagen tiene un estilo personalizado
      if (options.imageStyle != undefined) {
        imageStyle = options.imageStyle;
      }
    }
    const html = `
      <div class="w-100 text-center">
        <img id="${name}_display_uploaded" class="img-fluid cursor-pointer" src="/images/pages/upload.png" style="${imageStyle}">
        <br>
        ${infoMessage}
        ${htmlRequired}
      </div>
      <input type="text" class="${classRequired}" id="${name}_image_uploaded" name="${inputName}" style="position: absolute;z-index: -1;">
      <input type="file" hidden id="${name}_image_upload">
      <input type="text" hidden id="${name}_image_uploaded_update" class="image-uploaded-update">
      <button type="button" class="btn py-50 px-25" id="${name}_delete_btn">
        <img class="cursor-pointer mr-25" src="/images/web/trash.png" alt="" width="20px">
        <span>Borrar imagen</span>
      </button>
    `;
    return {
      html: html,
      realName: name
    };
  }
  
  function createInputFile(parent, name, options = null) {
    const inputFile = getHtmlInputFile(name, options)
    if (options != null && options.clearParent != undefined && options.clearParent == true) {
      $(parent).empty();
    }
    $(parent).append(inputFile.html);
    initInputFile(inputFile.realName, ((options != null && options.maxSize != undefined) ? options.maxSize : 1000))
  }