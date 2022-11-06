const createPagination = (registros, url) => {
    const { last_page, current_page } = registros;
  
    setTotalPages(last_page, current_page, url);
  }
  
  const setTotalPages = (total, current_page, url) => {
    let paginacion_list= $('.pagination-list');
    let prev_page = current_page - 1;
    let next_page = current_page + 1
    paginacion_list.empty();
    let pages = `<li><a href="#" onclick='setPage(${prev_page == 0 ? total : prev_page}, "${url}")'><i class="fa-solid fa-chevron-left"></i></a></li>`;
  
    for (let i = 0; i < total; i++) {
      let page = i + 1;
      pages += `<li><a href="#" class="${current_page == page && 'active'}" onclick='setPage(${page}, "${url}")'>${page}</a></li>`;
    }
  
    pages+= `<li><a href="#" onclick='setPage(${next_page > total ? 1 : next_page}, "${url}")'><i class="fa-solid fa-chevron-right"></i></a></li>`
    paginacion_list.append(pages);
  }
  
  const setPage = (page, url) =>{
    $.ajax({
      url: url + `?page=${page}`,
      method: 'get',
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
    }).always(async () => {
      $('#spinner-custom').fadeOut();
    })
  }