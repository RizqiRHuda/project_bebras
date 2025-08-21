
// Mobile menu toggle


// Simple carousel
document.addEventListener('DOMContentLoaded', function () {
    const carouselItems = document.querySelectorAll('[data-carousel-item]');
    const indicators = document.querySelectorAll('[data-carousel-slide-to]');
    let currentIndex = 2;

    function showSlide(index) {
        carouselItems.forEach(item => {
            item.style.opacity = '0';
            item.style.zIndex = '0';
        });
        carouselItems[index].style.opacity = '1';
        carouselItems[index].style.zIndex = '10';

        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.replace('bg-opacity-50', 'bg-white');
            } else {
                indicator.classList.replace('bg-white', 'bg-opacity-50');
            }
        });

        currentIndex = index;
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showSlide(index);
        });
    });

    document.querySelector('[data-carousel-prev]').addEventListener('click', () => {
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = carouselItems.length - 1;
        showSlide(newIndex);
    });

    document.querySelector('[data-carousel-next]').addEventListener('click', () => {
        let newIndex = currentIndex + 1;
        if (newIndex >= carouselItems.length) newIndex = 0;
        showSlide(newIndex);
    });

    setInterval(() => {
        let newIndex = currentIndex + 1;
        if (newIndex >= carouselItems.length) newIndex = 0;
        showSlide(newIndex);
    }, 5000);
});


