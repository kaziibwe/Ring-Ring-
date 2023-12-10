let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); //
}

// let slideIndex = 0;
// showSlides();

// function showSlides() {
//   let i;
//   let slides = document.getElementsByClassName("mySlides");
//   let dots = document.getElementsByClassName("dot");

//   // Hide all slides
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }

//   slideIndex++;
//   if (slideIndex > slides.length) {
//     slideIndex = 1;
//   }

//   // Display the current slide
//   slides[slideIndex-1].style.display = "block";
//   dots[slideIndex-1].className += " active";

//   // Adjust the time here (e.g., 3000ms for display, 1000ms for transition)
//   setTimeout(() => {
//     slides[slideIndex-1].style.display = "none"; // Hide the current slide
//     dots[slideIndex-1].className = dots[slideIndex-1].className.replace(" active", "");
//     setTimeout(showSlides, 1000); // Transition time
//   }, 5000); // Display time
// }
