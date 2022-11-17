

$(document).ready(async function () {
  $('#spinner-custom').fadeIn();
  await initTable();
  $('#spinner-custom').fadeOut();
  initInputFile('actividad');

});

var selector_dias = $("#actividad-horario");
selector_dias.bsMultiSelect();


const getJsonActividades = 'actividades/json/getActividades';
const initTable = (actividades = null) => {
  if (actividades == null) {

    return new Promise((resolve, reject) => {
      $.ajax({
        url: getJsonActividades,
        method: 'get',
        dataType: 'json',
      }).done((res) => {
        const actividades = res.actividades;
        setRegistros(actividades.data);
        createPagination(actividades, getJsonActividades)
      });
      resolve();
    })
  } else {
    setRegistros(actividades.data);
    createPagination(actividades, getJsonActividades)
  }
}




const getActividad = async (id, action) => {

  $.ajax({
    url: `actividades/${id}`,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    showActividad(res.actividad, action);

  }).fail((error) => {
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });
  })

}


const showActividad = (actividad, action) => {
  $("#actividades-form :input").attr("disabled", action == 'ver' ? true : false);
  const { id, nombre, descripcion, imagen, limite_usuarios, dias_activo, destacado, activo, created_at } = actividad;
  $('#spinner-custom').fadeOut();
  $('#actividad-nombre').val(nombre);
  if (action == 'ver') {
    $('.btn-actualizar').hide();
    $('.btn-crear').hide();
    $('#modal-actividades-titulo').text('Ver actividad');
  } else {
    $('#record-id').data('id', id);
    $('.btn-actualizar').show();
    $('.btn-crear').hide();
    $('#actividad-limite').prop("disabled", true);
    $('#modal-actividades-titulo').text('Actualizar actividad');
  }
  $('#actividad-limite').val(limite_usuarios);
  $('#actividad-horario').val(2);
  $('#actividad-descripcion').val(descripcion);
  $('#actividad-activo').prop('checked', activo);
  $('#actividad-destacado').prop('checked', destacado);
  $('#actividad_display_uploaded').attr('src', imagen);

  let dias = JSON.parse(dias_activo)
  selector_dias.BsMultiSelect().deselectAll()
  dias.forEach(dia => {

    selector_dias.find('option').eq(dia - 1).prop('selected', 'selected');
    selector_dias.data('DashboardCode.BsMultiSelect').updateOptionSelected(dia - 1);

  });
  $('#modal-actividades').modal('toggle');

}

const destroyActividad = (id) => {
  $.ajax({
    url: `actividades/${id}`,
    method: 'DELETE',
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done(async (res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La actividad se ha borrado correctamente',
      icon: 'success',
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });

    await initTable();

  }).fail((error) => {
    console.log(error);
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });
  }).always(() => {
    $('#spinner-custom').fadeOut();
  })
}

const updateActividad = () => {
  const id = $('#record-id').data('id');
  const data = formarData();

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
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });

  }).fail((error) => {
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });
  }).always(async () => {
    await initTable();
    $('#spinner-custom').fadeOut();
  })
}

const createActividad = () => {

  const data = formarData();
  console.log(data);
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
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });

  }).fail((error) => {
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar',
      heightAuto: false
    });
  }).always(async () => {
    $('#spinner-custom').fadeOut();
    await initTable();
  })
}

const formarData = () => {
  const data = {
    nombre: $('#actividad-nombre').val(),
    limite_usuarios: $('#actividad-limite').val(),
    dias_activo: $('#actividad-horario').val(),
    descripcion: $('#actividad-descripcion').val(),
    activo: $('#actividad-activo').prop('checked') ? 1 : 0,
    destacado: $('#actividad-destacado').prop('checked') ? 1 : 0,
    imagen: $('#actividad_display_uploaded').attr('src'),
  }

  return data;
}

const setRegistros = (actividades) => {
  $('.actividades-row').remove(); //Reiniciamos la tabla

  actividades.forEach(actividad => {
    let actividad_row = `<tr class="actividades-row">`;
    const { id, nombre, imagen, limite_usuarios, reserva_count, dias_activo, destacado, activo, created_at, paginacion } = actividad;
    console.log(actividad);
    const td_imagen = `<td colspan='1'><img src='${imagen}'></img></td>`
    const td_nombre = `<td> ${nombre} </td>`;
    const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
    const td_horario = `<td> ${dias_activo} </td>`;
    const td_reservas = `<td colspan='1'>${reserva_count}</td>`
    const td_destacado = `<td> <span> ${destacado ? ("<span> SI </span>") : ("<span> NO </span>")} </span></td>`;
    const td_activo = `<td> ${activo ? ("<span class='activo'> activo </span>") : ("<span class='inactivo'> inactivo </span>")} </td>`;
    const td_created_at = `<td> ${created_at} </td>`;

    actividad_row += td_imagen + td_nombre + td_limite_usuarios + td_horario + td_reservas + td_destacado + td_activo + td_created_at;
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
}

$('.nueva-actividad-button').on('click', () => {
  $("#actividades-form").trigger('reset');
  $("#actividades-form :input").attr("disabled", false);
  $('#modal-actividades-titulo').text('Crear actividad');
  $('.btn-crear').show();
  $('.btn-actualizar').hide();

  $('#actividad_display_uploaded').attr('src', `${asset_global_images}/upload.jpg`);
  $('#modal-actividades').modal('toggle');
})


