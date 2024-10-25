const scrollToTopButton = document.getElementById('scrollToTop');
let isButtonVisible = false;

window.addEventListener('scroll', function() {
    const welcomeSection = document.getElementById('first-section');
    const welcomeOffset = welcomeSection.offsetTop;

    if (window.scrollY >= welcomeOffset && !isButtonVisible) {
        isButtonVisible = true;
        scrollToTopButton.style.display = 'flex';
        scrollToTopButton.style.animation = 'slideIn 0.5s forwards';
    } else if (window.scrollY < welcomeOffset && isButtonVisible) {
        isButtonVisible = false;
        scrollToTopButton.style.animation = 'slideOut 0.5s forwards';
        setTimeout(() => {
            scrollToTopButton.style.display = 'none';
        }, 500);
    }
});

scrollToTopButton.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
