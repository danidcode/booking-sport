const createPagination = (actividades) => {
    console.log(actividades);
    const { last_page, current_page } = actividades;
  
    setTotalPages(last_page, current_page);
  }
  
  const setTotalPages = (total, current_page) => {
    let paginacion_list= $('.pagination-list');
    let prev_page = current_page - 1;
    let next_page = current_page + 1
    paginacion_list.empty();
    let pages = `<li><a href="#" onclick='setPage(${prev_page == 0 ? total : prev_page})'><i class="fa-solid fa-chevron-left"></i></a></li>`;
  
    for (let i = 0; i < total; i++) {
      let page = i + 1;
      pages += `<li><a href="#" class="${current_page == page && 'active'}" onclick='setPage(${page})'>${page}</a></li>`;
    }
  
    pages+= `<li><a href="#" onclick='setPage(${next_page > total ? 1 : next_page})'><i class="fa-solid fa-chevron-right"></i></a></li>`
    paginacion_list.append(pages);
  }
  
  const setPage = (page) =>{
  
    $.ajax({
      url: getJsonActividades + `?page=${page}`,
      method: 'get',
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