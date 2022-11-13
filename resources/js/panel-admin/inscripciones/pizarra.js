

$(document).ready(async function () {
    $('#spinner-custom').fadeIn();
    await initTable();
    $('#spinner-custom').fadeOut();
  
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
          console.log(res);
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
        text: 'La inscripción se ha borrado correctamente',
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
  
  
  const formarData = () => {
    const data = {
      nombre: $('#inscripcion-nombre').val(),
      limite_usuarios: $('#inscripcion-limite').val(),
      dias_activo: $('#inscripcion-horario').val(),
      descripcion: $('#inscripcion-descripcion').val(),
      activo: $('#inscripcion-activo').prop('checked') ? 1 : 0,
      destacado: $('#inscripcion-destacado').prop('checked') ? 1 : 0,
      destacado_principal: $('#inscripcion-destacado-principal').prop('checked') ? 1 : 0,
      imagen: $('#inscripcion_display_uploaded').attr('src'),
    }
  
    return data;
  }
  
  const setRegistros = (inscripciones) => {
    $('.inscripciones-row').remove(); //Reiniciamos la tabla
  
    inscripciones.forEach(inscripcion => {
      let inscripcion_row = `<tr class="inscripciones-row">`;
      const { id, evento, user, estado, created_at} = inscripcion;
      const td_evento = `<td> ${evento.nombre} </td>`;
      const td_user = `<td> ${user.name} (${user.email}) </td>`;
      const td_fecha_evento = `<td> ${evento.fecha_inicio} </td>`;
      const td_dias_restantes = `<td> ${getDiasRestantes(evento.fecha_inicio)} </td>`;
      const td_estado = `<td> ${estado ? ("<span class='activo'> activa </span>") : ("<span class='inactivo'> inactiva </span>")} </td>`;
      const td_created_at = `<td> ${created_at} </td>`;
  
      inscripcion_row += td_evento + td_user + td_fecha_evento + td_dias_restantes + td_estado + td_created_at;
      inscripcion_row += `<td> <div class="wrapper-dropdown container"> 
                              <div class="dropdown ">
                                <i class="fa-solid fa-ellipsis-vertical dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                                      <li><a class="dropdown-item" href="#" onclick="destroyInscripcion(${id})"><i class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                                   </ul>
                              </div> 
                            </div> 
                        </td>`;
  
      inscripcion_row += '</tr>'
  
      $('.inscripciones-table').append(inscripcion_row)
    });
  }
  

  
  
  