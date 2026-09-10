$(document).ready(function() {
    console.log("Página de inicio cargada");
});

document.addEventListener('DOMContentLoaded', function() {
    var carousel = document.getElementById('carouselExampleIndicators');
    var thumbnails = document.querySelectorAll('.carousel-thumbnails img');

    carousel.addEventListener('slide.bs.carousel', function (e) {
        thumbnails.forEach(img => img.classList.remove('active'));
        thumbnails[e.to].classList.add('active');
    });

    thumbnails.forEach((img, index) => {
        img.addEventListener('click', function() {
            new bootstrap.Carousel(carousel).to(index);
        });
    });
});
