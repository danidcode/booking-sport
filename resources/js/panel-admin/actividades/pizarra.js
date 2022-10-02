

$.ajax({
  url: "actividades",
}).done((res) => {
  console.log(res.actividades);
  const actividades = res.actividades;

  actividades.forEach(actividad => {
    let actividad_row =`<tr>`;
    const {nombre, imagen, limite_usuarios, hora_desde, hora_hasta, destacado, destacado_principal, activo, created_at } = actividad;
    const td_nombre = `<td> ${nombre} </td>`;
    const td_limite_usuarios = `<td> ${limite_usuarios} </td>`;
    const td_horario = `<td> ${hora_desde}  / ${hora_hasta} </td>`;
    const td_destacado = `<td> ${destacado} </td>`;
    const td_destacado_principal = `<td> ${destacado_principal} </td>`;
    const td_activo = `<td> ${activo} </td>`;
    const td_created_at = `<td> ${created_at} </td>`;

    actividad_row += td_nombre + td_limite_usuarios + td_horario + td_destacado + td_destacado_principal + td_activo + td_created_at;
    actividad_row+= `<td> <i class="fa-solid fa-ellipsis-vertical"></i></td>`
    actividad_row+= '</tr>'
      $('.actividades-table').append(actividad_row)
  });
});