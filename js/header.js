let isHeaderVisible = true;

window.addEventListener('scroll', function() {
    const header = document.getElementById('header');
    const firstSection = document.getElementById('first-section');
    const welcomeOffset = firstSection.offsetTop;

    if (window.scrollY >= welcomeOffset) {
        if (!header.classList.contains('fixed')) {
            header.classList.add('fixed');
            header.classList.remove('slide-up');
            isHeaderVisible = true;
        }
    } else {
        if (header.classList.contains('fixed') && isHeaderVisible) {
            header.classList.add('slide-up');
            setTimeout(() => {
                header.classList.remove('fixed');
                header.classList.remove('slide-up');
                isHeaderVisible = false;
            }, 500);
        }
    }
});
