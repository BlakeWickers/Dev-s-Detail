/** * Dev's Detail - Interactive Logic
 **/

document.addEventListener("DOMContentLoaded", () => {
  initSlideshow();
  initNavbarScroll();
});

/** * Slideshow Logic
 * Uses a cleaner approach to cycling through slides
 **/
function initSlideshow() {
  let slideIndex = 0;
  const slides = document.querySelectorAll(".mySlides");

  // Safety check in case elements are missing
  if (slides.length === 0) return;

  function showSlides() {
    // Reset all slides
    slides.forEach((slide) => {
      slide.style.display = "none";
    });

    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";

    // Change slide every 5 seconds (slightly slower is more "professional")
    setTimeout(showSlides, 5000);
  }

  showSlides();
}

/** * Navbar Scroll Effect
 * Shrinks logo and adds background blur on scroll
 **/
function initNavbarScroll() {
  const header = document.getElementById("header");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("mobile-toggle");
  const nav = document.getElementById("nav-list");

  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      nav.classList.toggle("active");

      // Optional: Changes icon from bars to an 'X'
      const icon = toggle.querySelector("i");
      icon.classList.toggle("fa-bars");
      icon.classList.toggle("fa-times");
    });
  }
});
