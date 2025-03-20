<div id="splash-screen" class="splash-screen">
  <div class="splash-content">
    <div id="splash-sequence-container"></div>
  </div>
</div>

<style>
  .splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: #fff;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s ease-out;
  }

  .splash-content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #splash-sequence-container {
    width: 100%;
    height: 100%;
    position: relative;
  }

  #splash-sequence-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    opacity: 0;
  }

  #splash-sequence-container img.active {
    opacity: 1;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    console.log('Splash screen script started');
    const splashScreen = document.getElementById('splash-screen');
    const container = document.getElementById('splash-sequence-container');

    if (!splashScreen || !container) {
      console.error('Splash screen elements not found');
      return;
    }

    localStorage.removeItem('splashShown');

    const totalFrames = 13;
    const imagePaths = [];

    for (let i = 1; i <= totalFrames; i++) {
      imagePaths.push(`{{ asset('images/Splash Screen/MacBook Air - ${i}.png') }}`);
    }

    console.log('Loading images from paths:', imagePaths);

    const preloadImages = imagePaths.map(path => {
      return new Promise((resolve, reject) => {
        const img = new Image();
        img.src = path;
        img.classList.add('splash-image');
        img.onload = () => {
          console.log('Loaded image:', path);
          resolve(img);
        };
        img.onerror = (e) => {
          console.error('Failed to load: ' + path);
          reject(e);
        };
        container.appendChild(img);
      });
    });

    Promise.all(preloadImages)
      .then(images => {
        console.log('All images loaded successfully:', images.length);
        let currentFrame = 0;

        images[0].classList.add('active');

        const frameInterval = 150; 
        const interval = setInterval(() => {
          images[currentFrame].classList.remove('active');
          currentFrame = (currentFrame + 1) % totalFrames;
          images[currentFrame].classList.add('active');
          console.log('Showing frame:', currentFrame + 1);

          if (currentFrame === totalFrames - 1) {
            console.log('Animation complete, cleaning up');
            clearInterval(interval);

            setTimeout(() => {
              splashScreen.style.opacity = '0';

              setTimeout(() => {
                splashScreen.style.display = 'none';
                localStorage.setItem('splashShown', 'true');
              }, 500);
            }, 500);
          }
        }, frameInterval);
      })
      .catch(error => {
        console.error('Error loading splash images:', error);
        splashScreen.style.display = 'none';
      });
  });
</script>