let dropdown_actions = document.getElementsByClassName("dropdown-actions")[0];
//Función que muestra el dropdown
const showActividadesActions = () => {
  document.getElementById("dropdown-list").classList.toggle("show");
  dropdown_actions.classList.add('active');
}
window.onclick = (e) => {
  if (!e.target.matches('.dropdown_actions')) {
    let dropdowns = document.getElementsByClassName("dropdown-content");
    let i;
    for (i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
        dropdown_actions.classList.remove('active');

      }
    }
  }
}

$.ajax({
  url: "actividades",
  beforeSend: () => {
  $('#spinner-loading').fadeIn();
},
}).done((res) => {
  $('#spinner-loading').fadeOut();
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
    actividad_row += `<td> <div class="dropdown" onclick="showActividadesActions()">
    <i class="fa-solid fa-ellipsis-vertical dropdown_actions"></i>
    <div id="dropdown-list" class="dropdown-content">
        <a href="dashboard">Panel de usuario</a>
        <button type="submit" form="form-logout" class="logout-btn">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i> </button>
    </div>
    </div></td>`
    actividad_row += '</tr>'
    $('.actividades-table').append(actividad_row)
  });
});

