const getDiasRestantes = (fecha_reserva) => {

    const date = new Date();
    const current_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
    const date1 = new Date(current_date);
    const date2 = new Date(fecha_reserva);
    const time_diff = Math.abs(date2 - date1);
    const dias_restantes = Math.ceil(time_diff / (1000 * 60 * 60 * 24)); 
  
    return dias_restantes;
  
  }