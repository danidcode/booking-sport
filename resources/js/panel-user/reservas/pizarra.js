

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
        createPagination(reservas, getJsonReservas)
      });
      resolve();
    })
  } else {
    setRegistros(reservas.data);
    createPagination(reservas, getJsonReservas)
  }
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
      text: 'La reserva se ha cancelado correctamente',
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
    reserva_row += `<td> <button class="cancelar-reserva" onclick='destroyReserva(${id})'> Cancelar </button></td>`;

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

