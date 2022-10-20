

$(document).ready(async function () {
  $('#spinner-custom').fadeIn();
  await initTable();
  $('#spinner-custom').fadeOut();
  initInputFile('actividad')
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
    horario: $('#actividad-horario').val(),
    descripcion: $('#actividad-descripcion').val(),
    activo: $('#actividad-activo').prop('checked') ? 1 : 0,
    destacado: $('#actividad-destacado').prop('checked') ? 1 : 0,
    destacado_principal: $('#actividad-destacado-principal').prop('checked') ? 1 : 0,
    imagen: $('#actividad_display_uploaded').attr('src'),
  }

  return data;
}

const sort = (data) => {
  const column = data.getAttribute("data-column")
  const order = data.getAttribute("data-order")
  sortBy(column, order);

}

const sortBy = async (column, order) => {
  const data = {
    column: column,
    order: order
  }
  $.ajax({
    url: getJsonActividades,
    method: 'get',
    data: data,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done(async (res) => {
    const actividades = res.actividades;
    await initTable(actividades);
  }).fail((error) => {
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  }).always(async () => {
    $('#spinner-custom').fadeOut();
  })
}

const setRegistros = (actividades) => {
  $('.actividades-row').remove(); //Reiniciamos la tabla

  actividades.forEach(actividad => {
    let actividad_row = `<tr class="actividades-row">`;
    const { id, nombre, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
    const td_imagen = `<td colspan='1'><img src='${imagen}'></img></td>`
    const td_nombre = `<td> ${nombre} </td>`;
    const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
    const td_horario = `<td> ${hora_desde}  / ${hora_hasta} </td>`;
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

const createPagination = (actividades) => {
  console.log(actividades);
  const { last_page, current_page } = actividades;

  setTotalPages(last_page, current_page);
}

const setTotalPages = (total, current_page) => {
  let paginacion_list= $('.pagination-list');
  let prev_page = current_page - 1;
  let next_page = current_page + 1
  paginacion_list.empty();
  let pages = `<li><a href="#" onclick='setPage(${prev_page == 0 ? total : prev_page})'><i class="fa-solid fa-chevron-left"></i></a></li>`;

  for (let i = 0; i < total; i++) {
    let page = i + 1;
    pages += `<li><a href="#" onclick='setPage(${page})'>${page}</a></li>`;
  }

  pages+= `<li><a href="#" onclick='setPage(${next_page > total ? 1 : next_page})'><i class="fa-solid fa-chevron-right"></i></a></li>`
  paginacion_list.append(pages);
}

const setPage = (page) =>{

  $.ajax({
    url: getJsonActividades + `?page=${page}`,
    method: 'get',
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done(async (res) => {
    const actividades = res.actividades;
    await initTable(actividades);
  }).fail((error) => {
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  }).always(async () => {
    $('#spinner-custom').fadeOut();
  })
}