document.addEventListener("DOMContentLoaded", function () {
  const lazyImages = document.querySelectorAll(".lazy");

  const lazyLoad = () => {
    lazyImages.forEach((img) => {
      if (
        img.getBoundingClientRect().top < window.innerHeight &&
        !img.classList.contains("loaded")
      ) {
        img.src = img.dataset.src;
        img.classList.add("loaded");
      }
    });
  };

  window.addEventListener("scroll", lazyLoad);
  lazyLoad();
});