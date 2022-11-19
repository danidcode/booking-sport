let slides = $(".slide");
let carruseles = [];
for (let i = 0; i < slides.length; i++) {
  carruseles.forEach((carrusel, index) => {
    let repetido = false;
    if (Object.values(carrusel).indexOf(slides[i].id) > -1) {

      carrusel.slides.push(slides[i]);
    } else {
      carruseles.forEach(element => {
        if (element.tipo == slides[i].id) repetido = true;
      });
      !repetido && carruseles.push({ tipo: slides[i].id, slides: [slides[i]], index: 1 });
    }
  })

  if (carruseles.length === 0) {

    carruseles.push({ tipo: slides[i].id, slides: [slides[i]], index: 1 });
  }

}

const setSlide = (nSlide, tipo = null) => {

  showSlides(nSlide, tipo.id);
}
const showSlides = (n, tipo = null) => {

  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }

  if (tipo == null) {
    carruseles.forEach(carrusel => {
      carrusel.slides.forEach(slide => {
        slide.style.display = "none";
      });
      carrusel.slides[carrusel.index - 1].style.display = "block";
    });
  } else {
    carruseles.forEach(carrusel => {
      if (carrusel.tipo == tipo) {
        carrusel.slides.forEach(slide => {
          slide.style.display = "none";
        });
        if (carrusel.index + n > carrusel.slides.length) {
          carrusel.index = 1;
          carrusel.slides[0].style.display = "block";
        }
        else if (carrusel.index + n < 1) {
          carrusel.slides[carrusel.slides.length - 1].style.display = "block";
          carrusel.index = carrusel.slides.length;
        }
        else {
          carrusel.slides[carrusel.index + n - 1].style.display = "block";
          carrusel.index = carrusel.index + n;
        }

      }
    });
  }
}

let slideIndex = 1;
showSlides(slideIndex);