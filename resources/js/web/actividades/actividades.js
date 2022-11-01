flatpickr('#calendar-reserva', {
  "minDate": new Date().fp_incr(1),
  locale: {
    firstDayOfWeek: 1,
    weekdays: {
      shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
      longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
    }, 
    months: {
      shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
      longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    },
  },
});

const createReserva = () =>{
 const data = {
  'actividad_id': $('#actividad_id').val(),
  'fecha_reserva' : $('#calendar-reserva').val(),
 } 
 $.ajax({
  url: 'guardar',
  method: 'post',
  dataType: 'json',
  data: data,
}).done((res) => {
console.log(res);
});
}
