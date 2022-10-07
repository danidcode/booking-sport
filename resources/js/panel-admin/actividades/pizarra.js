
$.ajax({
  url: "actividades",
  beforeSend: () => {
    $('#spinner-custom').fadeIn();
  },
}).done((res) => {
  $('#spinner-custom').fadeOut();
  const actividades = res.actividades;

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
    actividad_row += `<td> <div class="dropdown-pizarra" onclick="dropdownOptions('dropdownbtn-pizarra')">
    <i class="fa-solid fa-ellipsis-vertical dropdownbtn-pizarra"></i>
    <div id="dropdown-list" class="dropdown-content-pizarra">
        <a href="#" onclick="getActividad()"><i class="fa-regular fa-file fa-lg"></i> Ver </a> 
        <a href="dashboard"> <i class="fa-regular fa-pen-to-square fa-lg"></i> Editar</a>
        <a href="dashboard"><i class="fa-regular fa-trash-can fa-lg"></i> Borrar </a>
    </div>
    </div></td>`
    actividad_row += '</tr>'
    $('.actividades-table').append(actividad_row)
  });
});


const getActividad = async () =>{

  $.ajax({
    url: "actividades/1",
    beforeSend: () => {
      // $('#spinner-loading-main').fadeIn();
    },
  }).done((actividad) => {

    showActividad(actividad);

  }).fail((error)=>{
    console.log(error);
  })

  $('#modal-actividades-ver').modal('toggle');
}


const showActividad = (actividad) => {



}
