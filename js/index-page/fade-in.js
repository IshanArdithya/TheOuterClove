document.addEventListener("DOMContentLoaded", function () {
  const scrollElements = document.querySelectorAll(".scroll");

  const checkVisibility = () => {
    const triggerBottom = window.innerHeight * 0.75;

    scrollElements.forEach((element) => {
      const box = element.getBoundingClientRect();
      if (box.top < triggerBottom) {
        element.classList.add("visible");
      } else {
        element.classList.remove("visible");
      }
    });
  };

  window.addEventListener("scroll", checkVisibility);
  checkVisibility();
});
