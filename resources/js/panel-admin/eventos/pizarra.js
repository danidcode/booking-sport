

$(document).ready(async function () {
    $('#spinner-custom').fadeIn();
    await initTable();
    $('#spinner-custom').fadeOut();
    initInputFile('evento')
  });
  
  const getJsonEventos = 'eventos/json/getEventos';
  const initTable = (eventos = null) => {
    if (eventos == null) {
  
      return new Promise((resolve, reject) => {
        $.ajax({
          url: getJsonEventos,
          method: 'get',
          dataType: 'json',
        }).done((res) => {
          const eventos = res.eventos;
          setRegistros(eventos.data);
          createPagination(eventos)
        });
        resolve();
      })
    } else {
      setRegistros(eventos.data);
      createPagination(eventos)
    }
  }
  
  
  
  
  const getActividad = async (id, action) => {
  
    $.ajax({
      url: `eventos/${id}`,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done((res) => {
      showActividad(res.evento, action);
  
    }).fail((error) => {
      Swal.fire({
        title: '¡Error!',
        text: 'Ha ocurrido un error',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    })
  
  }
  
  
  const showActividad = (evento, action) => {
    $("#eventos-form :input").attr("disabled", action == 'ver' ? true : false);
    const { id, nombre, descripcion, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = evento;
    $('#spinner-custom').fadeOut();
    $('#evento-nombre').val(nombre);
    if (action == 'ver') {
      $('.btn-actualizar').hide();
      $('.btn-crear').hide();
      $('#modal-eventos-titulo').text('Ver evento');
    } else {
      $('#record-id').data('id', id);
      $('.btn-actualizar').show();
      $('.btn-crear').hide();
      $('#modal-eventos-titulo').text('Actualizar evento');
    }
    $('#evento-limite').val(limite_usuarios);
    $('#evento-horario').val(`desde ${hora_desde} hasta ${hora_hasta}`);
    $('#evento-descripcion').val(descripcion);
    $('#evento-activo').prop('checked', activo);
    $('#evento-destacado').prop('checked', destacado);
    $('#evento-destacado-principal').prop('checked', destacado_principal);
    $('#evento_display_uploaded').attr('src', imagen)
    $('#modal-eventos').modal('toggle');
  
  }
  
  const destroyActividad = (id) => {
    $.ajax({
      url: `eventos/${id}`,
      method: 'DELETE',
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done(async (res) => {
      Swal.fire({
        title: 'Éxito!',
        text: 'La evento se ha borrado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      });
  
      await initTable();
  
    }).fail((error) => {
      Swal.fire({
        title: '¡Error!',
        text: 'Ha ocurrido un error',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    }).always(() => {
      $('#spinner-custom').fadeOut();
    })
  }
  
  const updateActividad = () => {
    const id = $('#record-id').data('id');
    const data = formarData();
  
    $.ajax({
      url: `eventos/${id}`,
      method: 'put',
      data: data,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done((res) => {
      Swal.fire({
        title: 'Éxito!',
        text: 'La evento se ha actualizado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      });
  
    }).fail((error) => {
      Swal.fire({
        title: '¡Error!',
        text: 'Ha ocurrido un error',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    }).always(async () => {
      await initTable();
      $('#spinner-custom').fadeOut();
    })
  }
  
  const createActividad = () => {
  
    const data = formarData();
  
    $.ajax({
      url: `eventos/guardar`,
      method: 'post',
      data: data,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done((res) => {
      Swal.fire({
        title: 'Éxito!',
        text: 'La evento se ha creado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      });
  
    }).fail((error) => {
      Swal.fire({
        title: '¡Error!',
        text: 'Ha ocurrido un error',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    }).always(async () => {
      $('#spinner-custom').fadeOut();
      await initTable();
    })
  }
  
  const formarData = () => {
    const data = {
      nombre: $('#evento-nombre').val(),
      limite_usuarios: $('#evento-limite').val(),
      horario: $('#evento-horario').val(),
      descripcion: $('#evento-descripcion').val(),
      activo: $('#evento-activo').prop('checked') ? 1 : 0,
      destacado: $('#evento-destacado').prop('checked') ? 1 : 0,
      destacado_principal: $('#evento-destacado-principal').prop('checked') ? 1 : 0,
      imagen: $('#evento_display_uploaded').attr('src'),
    }
  
    return data;
  }
  
  const setRegistros = (eventos) => {
    $('.eventos-row').remove(); //Reiniciamos la tabla
  
    eventos.forEach(evento => {
      let evento_row = `<tr class="eventos-row">`;
      const { id, nombre, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = evento;
      const td_imagen = `<td colspan='1'><img src='${imagen}'></img></td>`
      const td_nombre = `<td> ${nombre} </td>`;
      const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
      const td_horario = `<td> ${hora_desde}  / ${hora_hasta} </td>`;
      const td_destacado = `<td> <span> ${destacado ? ("<span> SI </span>") : ("<span> NO </span>")} </span></td>`;
      const td_destacado_principal = `<td> ${destacado_principal ? ("<span> SI </span>") : ("<span> NO </span>")} </td>`;
      const td_activo = `<td> ${activo ? ("<span class='activo'> activo </span>") : ("<span class='inactivo'> inactivo </span>")} </td>`;
      const td_created_at = `<td> ${created_at} </td>`;
  
      evento_row += td_imagen + td_nombre + td_limite_usuarios + td_horario + td_destacado + td_destacado_principal + td_activo + td_created_at;
      evento_row += `<td> <div class="wrapper-dropdown container"> 
                              <div class="dropdown ">
                                <i class="fa-solid fa-ellipsis-vertical dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                                      <li><a class="dropdown-item" href="#" onclick="getActividad(${id},'ver')"><i class="fa-regular fa-file fa-lg"></i> Ver </a></li>
                                      <li><a class="dropdown-item" href="#" onclick="getActividad(${id},'editar')"><i class="fa-regular fa-pen-to-square fa-lg"></i> Editar</a></li>
                                      <li><a class="dropdown-item" href="#" onclick="destroyActividad(${id})"><i class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                                   </ul>
                              </div> 
                            </div> 
                        </td>`;
  
      evento_row += '</tr>'
  
      $('.eventos-table').append(evento_row)
    });
  }
  
  $('.nuevo-evento-button').on('click', () => {
    $('#modal-eventos-titulo').text('Crear evento');
    $('.btn-crear').show();
    $('.btn-actualizar').hide();
  
    $('#evento_display_uploaded').attr('src', `${asset_global_images}/upload.jpg`);
    $('#modal-eventos').modal('toggle');
  })
  
  