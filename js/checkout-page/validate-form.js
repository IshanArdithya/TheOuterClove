document.getElementById('agreementAccept').addEventListener('change', validatePlaceOrderButton);
document.getElementById('deliverySender').addEventListener('change', toggleDeliveryForm);
document.getElementById('shipping_option').addEventListener('change', validatePlaceOrderButton);
document.getElementById('timing_option').addEventListener('change', validatePlaceOrderButton);
document.getElementById('payment_method').addEventListener('change', validatePlaceOrderButton);

const billingInputs = document.querySelectorAll('#placeOrderForm .billing-details-form input[required]');
const deliveryInputs = document.querySelectorAll('#delivery-details-form input[required]');

billingInputs.forEach(input => input.addEventListener('input', validatePlaceOrderButton));
deliveryInputs.forEach(input => input.addEventListener('input', validatePlaceOrderButton));

function toggleDeliveryForm() {
    const deliverySenderChecked = document.getElementById('deliverySender').checked;
    const deliveryFormVisible = !deliverySenderChecked;

    if (deliveryFormVisible) {
        deliveryInputs.forEach(input => {
            input.setAttribute('required', true);
            input.disabled = false;
        });
    } else {
        deliveryInputs.forEach(input => {
            input.removeAttribute('required');
            input.disabled = true;
        });
    }

    validatePlaceOrderButton();
}

function validatePlaceOrderButton() {
    const placeOrderButton = document.getElementById('placeOrderButton');
    const placeOrderButtonContainer = document.getElementById('placeOrderButtonContainer');
    
    const agreementAccepted = document.getElementById('agreementAccept').checked;

    const billingFormValid = validateForm('#placeOrderForm .billing-details-form input[required]');

    const deliverySenderChecked = document.getElementById('deliverySender').checked;
    const deliveryFormValid = deliverySenderChecked ? true : validateForm('#delivery-details-form input[required]');

    const shippingOptionSelected = document.getElementById('shipping_option').value !== '';

    const timingOptionSelected = document.getElementById('timing_option').value !== '';

    const paymentMethodSelected = document.getElementById('payment_method').value !== '';

    if (agreementAccepted && billingFormValid && deliveryFormValid && shippingOptionSelected && timingOptionSelected && paymentMethodSelected) {
        placeOrderButton.disabled = false;
        placeOrderButtonContainer.classList.remove('disabled-btn');
    } else {
        placeOrderButton.disabled = true;
        placeOrderButtonContainer.classList.add('disabled-btn');
    }
}

function validateForm(selector) {
    const inputs = document.querySelectorAll(selector);
    for (let input of inputs) {
        if (!input.value.trim()) {
            return false;
        }
        if (input.type === 'email' && !validateEmail(input.value)) {
            return false;
        }
    }
    return true;
}

function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

toggleDeliveryForm();
