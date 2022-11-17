
const setSlide = (nSlide) => {
  showSlides(slideIndex += nSlide);
}
const showSlides = (n) => {
  let slides = $(".slide");
  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex - 1].style.display = "block";
}

let slideIndex = 1;
showSlides(slideIndex);