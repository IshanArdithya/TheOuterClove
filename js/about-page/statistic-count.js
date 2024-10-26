document.addEventListener("DOMContentLoaded", () => {
    const statistics = document.querySelectorAll('.statistic-title');
    let hasCounted = false;

    const countUp = (element, target) => {
        let count = 0;
        const duration = 1000;
        const startTime = performance.now();

        const animateCount = () => {
            const currentTime = performance.now();
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);

            count = Math.floor(progress * target);
            element.textContent = count;

            if (progress < 1) {
                requestAnimationFrame(animateCount);
            } else {
                element.textContent = target;
            }
        };

        requestAnimationFrame(animateCount);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasCounted) {
                statistics.forEach(stat => {
                    const count = parseInt(stat.getAttribute('data-count'), 10);
                    countUp(stat, count);
                });
                hasCounted = true;
            }
        });
    });

    observer.observe(document.getElementById('statistics'));
});
