

$(document).ready(function () {
  initTable();
  initInputFile('actividad')
});

const initTable = () => {

  $.ajax({
    url: "actividades/json/getActividades",
    method: 'get',
    dataType: 'json',
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    $('.actividades-row').remove();
    $('#spinner-custom').fadeOut();
    const actividades = res.actividades;
    actividades.forEach(actividad => {
      let actividad_row = `<tr class="actividades-row">`;
      const { id, nombre, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
      const td_imagen = `<td colspan='1'><img src='${imagen}'></img></td>`
      const td_nombre = `<td> ${nombre} </td>`;
      const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
      const td_horario = `<td> ${hora_desde}  / ${hora_hasta} </td>`;
      const td_destacado = `<td> ${destacado} </td>`;
      const td_destacado_principal = `<td> ${destacado_principal} </td>`;
      const td_activo = `<td> ${activo} </td>`;
      // const td_created_at = `<td> ${created_at} </td>`;

      actividad_row += td_imagen + td_nombre + td_limite_usuarios + td_horario + td_destacado + td_destacado_principal + td_activo;
      actividad_row += `<td> <div class="wrapper-dropdown container"> 
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

      actividad_row += '</tr>'

      $('.actividades-table').append(actividad_row)
    });
  });
}




const getActividad = async (id, action) => {
  console.log(id);

  $.ajax({
    url: `actividades/${id}`,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    showActividad(res.actividad, action);

  }).fail((error) => {
    console.log(error);
  })

}


const showActividad = (actividad, action) => {
  $("#actividades-form :input").attr("disabled", action == 'ver' ? true : false);
  const { nombre, descripcion, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
  $('#spinner-custom').fadeOut();
  $('#actividad-nombre').val(nombre);
  if (action == 'ver') {
    $('.btn-actualizar').hide();
    $('.btn-crear').hide();
    $('#modal-actividades-titulo').text('Ver actividad');
  } else {
    $('.btn-actualizar').show();
    $('.btn-crear').hide();
    $('#modal-actividades-titulo').text('Actualizar actividad');
  }
  $('#actividad-limite').val(limite_usuarios);
  $('#actividad-horario').val(`desde ${hora_desde} hasta ${hora_hasta}`);
  $('#actividad-descripcion').val(descripcion);
  $('#actividad-activo').prop('checked', activo);
  $('#actividad-destacado').prop('checked', destacado);
  $('#actividad-destacado-principal').prop('checked', destacado_principal);

  $('#modal-actividades').modal('toggle');

}

const destroyActividad = (id) => {
  $.ajax({
    url: `actividades/${id}`,
    method: 'DELETE',
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La actividad se ha borrado correctamente',
      icon: 'success',
      confirmButtonText: 'Aceptar'
    });

    initTable();

  }).fail((error) => {
    console.log(error);
  }).always(() => {
    $('#spinner-custom').fadeOut();
  })
}

const updateActividad = (id) => {
  const data = {
    nombre: $('#actividad-nombre').val(),
    limite_usuarios: $('#actividad-limite').val(),
    horario: $('#actividad-horario').val(),
    descripcion: $('#actividad-descripcion').val(),
    activo: $('#actividad-activo').val(),
    destacado: $('#actividad-destacado').val(),
    destacado_principal: $('#actividad-destacado-principal').val(),
    imagen: ('#actividad-imagen').val(),
  }

  $.ajax({
    url: `actividades/${id}`,
    method: 'put',
    data: data,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La actividad se ha actualizado correctamente',
      icon: 'success',
      confirmButtonText: 'Aceptar'
    });

  }).fail((error) => {
    console.log(error);
  }).always(() => {
    $('#spinner-custom').fadeOut();
    initTable();
  })
}

const createActividad = () => {

  const data = {
    nombre: $('#actividad-nombre').val(),
    limite_usuarios: $('#actividad-limite').val(),
    horario: $('#actividad-horario').val(),
    descripcion: $('#actividad-descripcion').val(),
    activo: $('#actividad-activo').prop('checked') ? 1 : 0,
    destacado: $('#actividad-destacado').prop('checked') ? 1 : 0,
    destacado_principal: $('#actividad-destacado-principal').prop('checked') ? 1 : 0,
    imagen: $('#actividad_display_uploaded').attr('src'),
  }

  $.ajax({
    url: `actividades/guardar`,
    method: 'post',
    data: data,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La actividad se ha creado correctamente',
      icon: 'success',
      confirmButtonText: 'Aceptar'
    });

  }).fail((error) => {
    console.log(error);
  }).always(() => {
    $('#spinner-custom').fadeOut();
    initTable();
  })
}

$('.nueva-actividad-button').on('click', () => {
  $('#modal-actividades-titulo').text('Crear actividad');
  $('.btn-crear').show();
  $('.btn-actualizar').hide();
  $('#modal-actividades').modal('toggle');
})
