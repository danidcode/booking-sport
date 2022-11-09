const createInscripcion = () =>{
    const data = {
     'evento_id': $('#evento_id').val(),
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
       text: 'La inscripción se ha realizado correctamente',
       icon: 'success',
       confirmButtonText: 'Aceptar',
       heightAuto: false
     });
   }).fail((error)=>{
     console.log(error);
     Swal.fire({
       title: '¡Error!',
       text: `${error.responseJSON.message}`,
       icon: 'error',
       confirmButtonText: 'Aceptar',
       heightAuto: false
     });
   }).always(() => {
     $('#spinner-custom').fadeOut();
   });
   }