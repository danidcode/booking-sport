

$(document).ready(async function () {
    $('#spinner-custom').fadeIn();
    await initTable();
    $('#spinner-custom').fadeOut();
    initInputFile('inscripcion');
  
    $("select").bsMultiSelect();
  
  });
  
  
  const getJsonInscripciones = 'inscripciones/json/getInscripciones';
  const initTable = (inscripciones = null) => {
    if (inscripciones == null) {
      return new Promise((resolve, reject) => {
        $.ajax({
          url: getJsonInscripciones,
          method: 'get',
          dataType: 'json',
        }).done((res) => {
          const inscripciones = res.inscripciones;
          setRegistros(inscripciones.data);
          createPagination(inscripciones, getJsonInscripciones)
        });
        resolve();
      })
    } else {
      setRegistros(inscripciones.data);
      createPagination(inscripciones, getJsonInscripciones)
    }
  }
  
  
  const destroyInscripcion = (id) => {
    $.ajax({
      url: `inscripciones/${id}`,
      method: 'DELETE',
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done(async (res) => {
      Swal.fire({
        title: 'Éxito!',
        text: 'La inscripción se ha cancelado correctamente',
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
  
  
  const setRegistros = (inscripciones) => {
    console.log(inscripciones);
    $('.inscripciones-row').remove(); //Reiniciamos la tabla
  
    inscripciones.forEach(inscripcion => {
      let inscripcion_row = `<tr class="inscripciones-row">`;
      const { id, evento, created_at} = inscripcion;
      const td_evento = `<td> ${evento.nombre} </td>`;
      const td_fecha_evento = `<td> ${evento.fecha_inicio} </td>`;
      const td_dias_restantes = `<td> ${getDiasRestantes(evento.fecha_inicio)} </td>`;
      const td_created_at = `<td> ${created_at} </td>`;
  
      inscripcion_row += td_evento + td_fecha_evento + td_dias_restantes + td_created_at;
      inscripcion_row += `<td> <button class="cancelar-inscripcion" onclick='destroyInscripcion(${id})'> Cancelar </button></td>`;
  
      inscripcion_row += '</tr>'
  
      $('.inscripciones-table').append(inscripcion_row)
    });
  }
  
  $('.nueva-inscripcion-button').on('click', () => {
    $('#modal-inscripciones-titulo').text('Crear inscripcion');
    $('.btn-crear').show();
    $('.btn-actualizar').hide();
  
    $('#inscripcion_display_uploaded').attr('src', `${asset_global_images}/upload.jpg`);
    $('#modal-inscripciones').modal('toggle');
  })
  
  