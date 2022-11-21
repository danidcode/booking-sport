let url = null;

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
      url: url,
      method: 'get',
      data: data,
      beforeSend: () => {
        $('#spinner-custom').fadeIn();
      },
    }).done(async (res) => {
      const registros = Object.values(res)[1];
    await initTable(registros);
    }).fail((error) => {
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