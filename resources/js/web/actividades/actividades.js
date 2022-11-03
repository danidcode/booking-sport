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
  disable: [ 
      (date) => {
         let dias_activo = $('#dias_activo').val();
        return (!dias_activo.includes(date.getDay() == 0 ? 7 : date.getDay()));
    }
]});

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
  beforeSend: () => {
    $('#spinner-custom').fadeIn();
  }
}).done((res) => {
  Swal.fire({
    title: 'Éxito!',
    text: 'La reserva se ha realizado correctamente',
    icon: 'success',
    confirmButtonText: 'Aceptar'
  });
}).fail((error)=>{
  console.log(error);
  Swal.fire({
    title: '¡Error!',
    text: `${error.responseJSON.message}`,
    icon: 'error',
    confirmButtonText: 'Aceptar'
  });
}).always(() => {
  $('#spinner-custom').fadeOut();
});
}
