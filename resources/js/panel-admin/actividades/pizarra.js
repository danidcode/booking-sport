

$(document).ready(async function () {
  $('#spinner-custom').fadeIn();
  await initTable();
  $('#spinner-custom').fadeOut();
  initInputFile('actividad');

  $("select").bsMultiSelect();

});


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
        createPagination(actividades)
      });
      resolve();
    })
  } else {
    setRegistros(actividades.data);
    createPagination(actividades)
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
      confirmButtonText: 'Aceptar'
    });
  })

}


const showActividad = (actividad, action) => {
  $("#actividades-form :input").attr("disabled", action == 'ver' ? true : false);
  const { id, nombre, descripcion, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
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
    $('#modal-actividades-titulo').text('Actualizar actividad');
  }
  $('#actividad-limite').val(limite_usuarios);
  $('#actividad-horario').val(`desde ${hora_desde} hasta ${hora_hasta}`);
  $('#actividad-descripcion').val(descripcion);
  $('#actividad-activo').prop('checked', activo);
  $('#actividad-destacado').prop('checked', destacado);
  $('#actividad-destacado-principal').prop('checked', destacado_principal);
  $('#actividad_display_uploaded').attr('src', imagen)
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
      confirmButtonText: 'Aceptar'
    });

    await initTable();

  }).fail((error) => {
    console.log(error);
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
    nombre: $('#actividad-nombre').val(),
    limite_usuarios: $('#actividad-limite').val(),
    dias_activo: $('#actividad-horario').val(),
    descripcion: $('#actividad-descripcion').val(),
    activo: $('#actividad-activo').prop('checked') ? 1 : 0,
    destacado: $('#actividad-destacado').prop('checked') ? 1 : 0,
    destacado_principal: $('#actividad-destacado-principal').prop('checked') ? 1 : 0,
    imagen: $('#actividad_display_uploaded').attr('src'),
  }

  return data;
}

const setRegistros = (actividades) => {
  $('.actividades-row').remove(); //Reiniciamos la tabla

  actividades.forEach(actividad => {
    let actividad_row = `<tr class="actividades-row">`;
    const { id, nombre, imagen, limite_usuarios, dias_activo, destacado, destacado_principal, activo, created_at } = actividad;
    const td_imagen = `<td colspan='1'><img src='${imagen}'></img></td>`
    const td_nombre = `<td> ${nombre} </td>`;
    const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
    const td_horario = `<td> ${formarDias(dias_activo)} </td>`;
    const td_destacado = `<td> <span> ${destacado ? ("<span> SI </span>") : ("<span> NO </span>")} </span></td>`;
    const td_destacado_principal = `<td> ${destacado_principal ? ("<span> SI </span>") : ("<span> NO </span>")} </td>`;
    const td_activo = `<td> ${activo ? ("<span class='activo'> activo </span>") : ("<span class='inactivo'> inactivo </span>")} </td>`;
    const td_created_at = `<td> ${created_at} </td>`;

    actividad_row += td_imagen + td_nombre + td_limite_usuarios + td_horario + td_destacado + td_destacado_principal + td_activo + td_created_at;
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
  $('#modal-actividades-titulo').text('Crear actividad');
  $('.btn-crear').show();
  $('.btn-actualizar').hide();

  $('#actividad_display_uploaded').attr('src', `${asset_global_images}/upload.jpg`);
  $('#modal-actividades').modal('toggle');
})

const formarDias = (dias) => {
  console.log(dias);
  dias = JSON.parse(dias);
  let dias_activos = "";
  const options = new Array();
  options[1] = 'Lunes';
  options[2] = 'Martes';
  options[3] = 'Miércoles';
  options[4] = 'Jueves';
  options[5] = 'Viernes';
  options[6] = 'Sábado';
  options[7] = 'Domingo';

  dias.forEach((dia, index) => {
    if(dias.length == index + 1){
      dias_activos += `${options[dia]}`
    }else{
      dias_activos += `${options[dia]}, `
    }
  });
  return dias_activos;
}
