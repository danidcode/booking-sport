

$(document).ready(async function () {
    $('#spinner-custom').fadeIn();
    await initTable();
    $('#spinner-custom').fadeOut();
  
  });
  
  
  const getJsonUsuarios = 'lista-usuarios/json/getUsuarios';
  const initTable = (usuarios = null) => {
    if (usuarios == null) {
  
      return new Promise((resolve, reject) => {
        $.ajax({
          url: getJsonUsuarios,
          method: 'get',
          dataType: 'json',
        }).done((res) => {
          console.log(res);
          const usuarios = res.usuarios;
          setRegistros(usuarios.data);
          createPagination(usuarios, getJsonUsuarios)
        });
        resolve();
      })
    } else {
      setRegistros(usuarios.data);
      createPagination(usuarios, getJsonUsuarios)
    }
  }
  
  
  
  
  const getUsuario = async (id, action) => {
  
    $.ajax({
      url: `usuarios/${id}`,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done((res) => {
      showUsuario(res.usuario, action);
  
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
  
  
  const destroyUsuario = (id) => {
    $.ajax({
      url: `lista-usuarios/${id}`,
      method: 'DELETE',
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done(async (res) => {
      Swal.fire({
        title: 'Éxito!',
        text: 'El usuario se ha borrado correctamente',
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

  const setRegistros = (usuarios) => {
    $('.usuarios-row').remove(); //Reiniciamos la tabla
  
    usuarios.forEach(usuario => {
      let usuario_row = `<tr class="usuarios-row">`;
      const { id, name, email, inscripcion_count, reserva_count, created_at} = usuario;
      const td_nombre = `<td> ${name} </td>`;
      const td_email = `<td> ${email} </td>`;
      const td_reserva = `<td> ${reserva_count} </td>`;
      const td_inscripcion = `<td> ${inscripcion_count} </td>`;
      const td_created_at = `<td> ${created_at} </td>`;
  
      usuario_row += td_nombre + td_email + td_reserva + td_inscripcion + td_created_at;
      usuario_row += `<td> <div class="wrapper-dropdown container"> 
                              <div class="dropdown ">
                                <i class="fa-solid fa-ellipsis-vertical dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                                      <li><a class="dropdown-item" href="#" onclick="destroyUsuario(${id})"><i class="fa-regular fa-trash-can fa-lg"></i> Borrar </a></li>
                                   </ul>
                              </div> 
                            </div> 
                        </td>`;
  
      usuario_row += '</tr>'
  
      $('.usuarios-table').append(usuario_row)
    });
  }
  

  
  
  