let selectedDay = null;
let selectedTime = null;

function showSchedulePopup() {
    let today = new Date();
    let dateOptions = '';

    for (let i = 0; i < 7; i++) {
        let day = new Date(today);
        day.setDate(today.getDate() + i);
        let dayName = day.toLocaleDateString('en-US', { weekday: 'long' });
        let monthName = day.toLocaleDateString('en-US', { month: 'short' });
        let date = day.getDate();
        dateOptions += `
            <div class="date-option" onclick="selectDay('${day.toISOString()}', this, '${today.toISOString()}')">
                <strong>${dayName}</strong><br>
                ${monthName} ${date}
            </div>`;
    }

    let timeOptions = '<div class="time-options"></div>';

    Swal.fire({
        title: 'Schedule Your Order',
        html: `
            <div>
                <div class="select-date-container">
                    <h4>Select a Date</h4>
                    <div class="select-date">${dateOptions}</div>
                </div>
                <hr>
                <div class="select-time-section">
                    <h4>Select a Time</h4>
                    <div class="select-time-container">
                        ${timeOptions}
                    </div>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Confirm Schedule',
        customClass: {
            popup: 'schedule-popup',
            title: 'schedule-title',
            confirmButton: 'schedule-confirm'
        },
        preConfirm: () => {
            let selectedTimeOption = document.querySelector('input[name="time"]:checked');
            if (!selectedTimeOption) {
                Swal.showValidationMessage('Please select a time');
                return false;
            }
            selectedTime = selectedTimeOption.value;
            return true;
        }
    }).then((result) => {
        if (result.isConfirmed && selectedDay && selectedTime) {
            updateScheduleOption(selectedDay, selectedTime);
        }
    });

    selectDay(today.toISOString(), document.querySelector('.date-option'), today.toISOString());
}

function selectDay(dayISO, element, todayISO) {
    selectedDay = dayISO;

    document.querySelectorAll('.date-option').forEach(el => el.classList.remove('selected'));
    element.classList.add('selected');

    const timeOptionsContainer = document.querySelector('.time-options');
    timeOptionsContainer.innerHTML = '';

    const selectedDayDate = new Date(dayISO);
    const todayDate = new Date(todayISO);
    const currentTime = new Date();

    let startHour, endHour, startMinute = 0;

    if (selectedDayDate.toDateString() === todayDate.toDateString()) {
        let nextAvailableTime = new Date(currentTime.getTime() + 60 * 60 * 1000);

        let nextMinutes = Math.ceil(nextAvailableTime.getMinutes() / 15) * 15;
        if (nextMinutes === 60) {
            nextAvailableTime.setHours(nextAvailableTime.getHours() + 1);
            nextAvailableTime.setMinutes(0);
        } else {
            nextAvailableTime.setMinutes(nextMinutes);
        }

        startHour = nextAvailableTime.getHours();
        startMinute = nextAvailableTime.getMinutes();
        endHour = 20;
    } else {
        startHour = 9;
        endHour = 20;
    }

    for (let hour = startHour; hour <= endHour; hour++) {
        for (let minutes = 0; minutes < 60; minutes += 15) {
            if (hour === startHour && minutes < startMinute) continue;

            let time = new Date(0, 0, 0, hour, minutes).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            timeOptionsContainer.innerHTML += `
            <div class="time-option">
                <label>
                    <input type="radio" name="time" value="${time}"> ${time}
                </label>
            </div>`;
        }
    }
}
