document.addEventListener("DOMContentLoaded", function () {
    const track = document.getElementById("carouselTrack");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");

    let currentIndex = 0;
    const itemWidth = document.querySelector(".carousel-item").offsetWidth;
    const itemsCount = document.querySelectorAll(".carousel-item").length;

    nextButton.addEventListener("click", function () {
        if (currentIndex < itemsCount - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarousel();
    });

    prevButton.addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = itemsCount - 1;
        }
        updateCarousel();
    });

    function updateCarousel() {
        const newPosition = -currentIndex * itemWidth + "px";
        track.style.transform = "translateX(" + newPosition + ")";
    }
});
