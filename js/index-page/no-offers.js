function typeMessage(message, element, cursor) {
  let index = 0;

  const typingInterval = setInterval(() => {
    if (index < message.length) {
      element.textContent += message.charAt(index);
      index++;
    } else {
      clearInterval(typingInterval);
      cursor.style.animation = "blink 1s step-end infinite";
    }
  }, 100);
}

function isElementInViewport(el) {
  const rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
  );
}

window.addEventListener("scroll", () => {
  const typingElement = document.getElementById("typing-effect");
  const cursor = document.querySelector(".cursor");

  if (typingElement && cursor) {
    if (
      isElementInViewport(typingElement) &&
      !cursor.classList.contains("active")
    ) {
      cursor.classList.add("active");
      typeMessage("No offers available at the moment.", typingElement, cursor);
    }
  }
});