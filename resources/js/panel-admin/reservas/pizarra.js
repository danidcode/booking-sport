

$(document).ready(async function () {
    $('#spinner-custom').fadeIn();
    await initTable();
    $('#spinner-custom').fadeOut();
    url = getJsonReservas;
  
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
          console.log(res);
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
  
  
  
  
  const getReserva = async (id, action) => {
  
    $.ajax({
      url: `reservas/${id}`,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done((res) => {
      showreserva(res.reserva, action);
  
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
    $('.reservas-row').remove(); //Reiniciamos la tabla
  
    reservas.forEach(reserva => {
      let reserva_row = `<tr class="reservas-row">`;
      const { id, actividad_nombre, fecha_reserva, user_nombre, user_email, estado, created_at} = reserva;
      const td_actividad = `<td> ${actividad_nombre} </td>`;
      const td_user = `<td> ${user_nombre} (${user_email}) </td>`;
      const td_fecha_reserva = `<td> ${fecha_reserva} </td>`;
      const td_dias_restantes = `<td> ${getDiasRestantes(fecha_reserva)} </td>`;
      const td_estado = `<td> ${estado ? ("<span class='activo'> activa </span>") : ("<span class='inactivo'> inactiva </span>")} </td>`;
      const td_created_at = `<td> ${created_at} </td>`;
  
      reserva_row += td_actividad + td_user + td_fecha_reserva + td_dias_restantes + td_estado + td_created_at;
      reserva_row += `<td> <div class="wrapper-dropdown container"> 
                              <div class="dropdown ">
                                <i class="fa-solid fa-ellipsis-vertical dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                                      <li><a class="dropdown-item" href="#" onclick="destroyReserva(${id})"><i class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                                   </ul>
                              </div> 
                            </div> 
                        </td>`;
  
      reserva_row += '</tr>'
  
      $('.reservas-table').append(reserva_row)
    });
  }
  

  
  
  