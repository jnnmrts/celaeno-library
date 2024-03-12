// Image array for image rotation
const images = ['img2.jpg', 'img3.jpg', 'img4.jpg'];

// Function to change the background image every 3 seconds
function changeBackgroundImage() {
  const backgroundElement = document.querySelector('.background-animation');
  let index = 0;

  setInterval(() => {
    backgroundElement.style.backgroundImage = `url('${images[index]}')`;
    index = (index + 1) % images.length;
  }, 3000);
}

changeBackgroundImage();
