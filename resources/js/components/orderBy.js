const sort = (data) => {
    const column = data.getAttribute("data-column")
    const order = data.getAttribute("data-order")
    sortBy(column, order);
  
  }
  
  const sortBy = async (column, order) => {
    const data = {
      column: column,
      order: order
    }
    $.ajax({
      url: getJsonActividades,
      method: 'get',
      data: data,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done(async (res) => {
      const actividades = res.actividades;
      await initTable(actividades);
    }).fail((error) => {
      Swal.fire({
        title: '¡Error!',
        text: 'Ha ocurrido un error',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
    }).always(async () => {
      $('#spinner-custom').fadeOut();
    })
  }