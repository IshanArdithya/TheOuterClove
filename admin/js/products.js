document.addEventListener("DOMContentLoaded", () => {
    const discountCheckbox = document.getElementById("discountAvailable");
    const discountedPriceContainer = document.getElementById("discountedPriceContainer");

    discountCheckbox.addEventListener("change", () => {
        if (discountCheckbox.checked) {
            discountedPriceContainer.style.display = "block";
        } else {
            discountedPriceContainer.style.display = "none";
        }
    });
});
