
$.ajax({
  url: "actividades",
  beforeSend: () => {
    $('#spinner-custom').fadeIn();
  },
}).done((res) => {
  $('#spinner-custom').fadeOut();
  const actividades = res.actividades;
  console.log(actividades);
  actividades.forEach(actividad => {
    let actividad_row = `<tr>`;
    const { id, nombre, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
    const td_nombre = `<td> ${nombre} </td>`;
    const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
    const td_horario = `<td> ${hora_desde}  / ${hora_hasta} </td>`;
    const td_destacado = `<td> ${destacado} </td>`;
    const td_destacado_principal = `<td> ${destacado_principal} </td>`;
    const td_activo = `<td> ${activo} </td>`;
    const td_created_at = `<td> ${created_at} </td>`;

    actividad_row += td_nombre + td_limite_usuarios + td_horario + td_destacado + td_destacado_principal + td_activo + td_created_at;
    actividad_row += `<td> <div class="dropdown-pizarra-${id}" onclick="dropdownOptions('dropdownbtn-pizarra-${id}', ${id})">
    <i class="fa-solid fa-ellipsis-vertical dropdownbtn-pizarra-${id}"></i>
    <div id="dropdown-list-${id}" class="dropdown-content-pizarra"> 
        <a href="#" onclick="getActividad(${id},'ver')"><i class="fa-regular fa-file fa-lg"></i> Ver </a> 
        <a href="#" onclick="getActividad(${id},'editar')"> <i class="fa-regular fa-pen-to-square fa-lg"></i> Editar</a>
        <a href="dashboard"><i class="fa-regular fa-trash-can fa-lg"></i> Borrar </a>
    </div>
    </div></td>`
    actividad_row += '</tr>';

    console.log(actividad_row);
      
    $('.actividades-table').append(actividad_row)
  });
});


const getActividad = async (id,action) =>{
  console.log(id);

  $.ajax({
    url: `actividades/${id}`,
    beforeSend: () => {
      $('#spinner-custom').fadeIn();
    },
  }).done((res) => {
    showActividad(res.actividad, action);

  }).fail((error)=>{
    console.log(error);
  })

}


const showActividad = (actividad, action) => {
  $("#actividades-form :input").attr("disabled", action == 'ver' ? true : false);
  const {nombre, description, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
  $('#spinner-custom').fadeOut();
  $('#actividad-nombre').val(nombre);
  action == 'ver' ? $('.btn-actualizar').hide() : $('.btn-actualizar').show() ;
  $('#actividad-limite').val(limite_usuarios);
  $('#actividad-horario').val(`desde ${hora_desde} hasta ${hora_hasta}`);
  $('#actividad-descripcion').val(description);
  $('#actividad-activo').prop('checked', activo);
  $('#actividad-destacado').prop('checked', destacado);
  $('#actividad-destacado-principal').prop('checked', destacado_principal);

  $('#modal-actividades').modal('toggle');

}


const updateActividad = (id) =>{

console.log(id);
}
$('.nueva-actividad-button').on('click', () =>{
  $('#modal-actividades').modal('toggle');
})
