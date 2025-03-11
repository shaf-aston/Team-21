const image = document.getElementById('product-image');
const zoomResult = document.getElementById('zoom-result');

image.addEventListener('mousemove', (e) => {
    zoomResult.style.display = 'block';
    const rect = image.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const xPercent = (x / rect.width) * 100;
    const yPercent = (y / rect.height) * 100;
    zoomResult.style.backgroundImage = `url(${image.src})`;
    zoomResult.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
});

image.addEventListener('mouseleave', () => {
    zoomResult.style.display = 'none';
});
