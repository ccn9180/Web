function scrollNav(amount) {
    document.querySelector('.genre-nav ul').scrollBy({
        left: amount,
        behavior: 'smooth'
    });
}

$('[data-post]').on('click', e => {
    e.preventDefault();
    const url = e.target.dataset.post;
    const f = $('<form>').appendTo(document.body)[0];
    f.method = 'POST';
    f.action = url || location;
    f.submit();
});

document.addEventListener("DOMContentLoaded", function () {
    const books = document.querySelectorAll('.book');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // animate once
            }
        });
    }, {
        threshold: 0.1
    });

    books.forEach(book => {
        observer.observe(book);
    });

const wrapper = document.getElementById("sliderWrapper");
const dots = document.querySelectorAll(".dot");
let currentSlide = 0;
const totalSlides = dots.length;

function goToSlide(index) {
  wrapper.style.transform = `translateX(-${index * 100}%)`;
  dots.forEach(dot => dot.classList.remove("active"));
  dots[index].classList.add("active");
  currentSlide = index;
}

dots.forEach(dot => {
  dot.addEventListener("click", () => {
    const index = parseInt(dot.getAttribute("data-index"));
    goToSlide(index);
  });
});

function autoSlide() {
  currentSlide = (currentSlide + 1) % totalSlides;
  goToSlide(currentSlide);
}

let slideInterval = setInterval(autoSlide, 5000); // slower

goToSlide(0);
});




  