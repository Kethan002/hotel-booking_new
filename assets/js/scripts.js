// Array to store hero images
const heroImages = document.querySelectorAll('.hero-image');

// Get the previous and next buttons
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');

// Initialize the current image index
let currentIndex = 0;

// Function to show the next image
function showNextImage() {
  heroImages[currentIndex].classList.remove('active');
  currentIndex = (currentIndex + 1) % heroImages.length;
  heroImages[currentIndex].classList.add('active');
}

// Function to show the previous image
function showPrevImage() {
  heroImages[currentIndex].classList.remove('active');
  currentIndex = (currentIndex - 1 + heroImages.length) % heroImages.length;
  heroImages[currentIndex].classList.add('active');
}

// Add event listeners to the buttons
prevBtn.addEventListener('click', showPrevImage);
nextBtn.addEventListener('click', showNextImage);