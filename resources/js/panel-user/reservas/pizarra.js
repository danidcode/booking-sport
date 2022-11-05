

$(document).ready(async function () {
  $('#spinner-custom').fadeIn();
  await initTable();
  $('#spinner-custom').fadeOut();
  initInputFile('reserva');

  $("select").bsMultiSelect();

});


const getJsonReservas = 'reservas/json/getReservas';
const initTable = (reservas = null) => {
  if (reservas == null) {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: getJsonReservas,
        method: 'get',
        dataType: 'json',
      }).done((res) => {
        const reservas = res.reservas;
        setRegistros(reservas.data);
        createPagination(reservas)
      });
      resolve();
    })
  } else {
    setRegistros(reservas.data);
    createPagination(reservas)
  }
}




const getReserva = async (id, action) => {

  $.ajax({
    url: `reservas/${id}`,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    showReserva(res.reserva, action);

  }).fail((error) => {
    Swal.fire({
      title: '¡Error!',
      text: 'Ha ocurrido un error',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  })

}


const destroyReserva = (id) => {
  $.ajax({
    url: `reservas/${id}`,
    method: 'DELETE',
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done(async (res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La reserva se ha borrado correctamente',
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

const updateReserva = () => {
  const id = $('#record-id').data('id');
  const data = formarData();

  $.ajax({
    url: `reservas/${id}`,
    method: 'put',
    data: data,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La reserva se ha actualizado correctamente',
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

const createReserva= () => {

  const data = formarData();
  console.log(data);
  $.ajax({
    url: `reservas/guardar`,
    method: 'post',
    data: data,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    Swal.fire({
      title: 'Éxito!',
      text: 'La reserva se ha creado correctamente',
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
    nombre: $('#reserva-nombre').val(),
    limite_usuarios: $('#reserva-limite').val(),
    dias_activo: $('#reserva-horario').val(),
    descripcion: $('#reserva-descripcion').val(),
    activo: $('#reserva-activo').prop('checked') ? 1 : 0,
    destacado: $('#reserva-destacado').prop('checked') ? 1 : 0,
    destacado_principal: $('#reserva-destacado-principal').prop('checked') ? 1 : 0,
    imagen: $('#reserva_display_uploaded').attr('src'),
  }

  return data;
}

const setRegistros = (reservas) => {
  console.log(reservas);
  $('.reservas-row').remove(); //Reiniciamos la tabla

  reservas.forEach(reserva => {
    let reserva_row = `<tr class="reservas-row">`;
    const { id, actividad,fecha_reserva, created_at } = reserva;
    const td_actividad = `<td> ${actividad.nombre} </td>`;
    const td_fecha_reserva = `<td> ${fecha_reserva} </td>`;
    const td_dias_restantes = `<td> ${getDiasRestantes(fecha_reserva)} </td>`;
    const td_created_at = `<td> ${created_at} </td>`;

    reserva_row += td_actividad + td_fecha_reserva + td_dias_restantes + td_created_at;
    reserva_row += `<td> <button class="cancelar-reserva"> Cancelar </button></td>`;

    reserva_row += '</tr>'

    $('.reservas-table').append(reserva_row)
  });
}

$('.nueva-reserva-button').on('click', () => {
  $('#modal-reservas-titulo').text('Crear reserva');
  $('.btn-crear').show();
  $('.btn-actualizar').hide();

  $('#reserva_display_uploaded').attr('src', `${asset_global_images}/upload.jpg`);
  $('#modal-reservas').modal('toggle');
})

const getDiasRestantes = (fecha_reserva) => {

  const date = new Date();
  const current_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
  const date1 = new Date(current_date);
  const date2 = new Date(fecha_reserva);
  const time_diff = Math.abs(date2 - date1);
  const dias_restantes = Math.ceil(time_diff / (1000 * 60 * 60 * 24)); 

  return dias_restantes;

}