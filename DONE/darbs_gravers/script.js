function formatPersonalCode(event) {
    const input = event.target;
    let value = input.value.replace(/\D/g, '');

    if (value.length > 6) {
        value = value.slice(0, 6) + '-' + value.slice(6, 11);
    }

    input.value = value;
}

let rotated = false;

function rotatePage() {
    document.body.style.transform = rotated ? "rotate(0deg)" : "rotate(360deg)";
    rotated = !rotated;
}

function activateLink(event) {
    const links = document.querySelectorAll('.link-container a');
    links.forEach(link => link.classList.remove('active'));


    event.target.classList.add('active');
}

async function fetchWeather() {
    const latitude = 57.314;
    const longitude = 25.291;
    const url = `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.current_weather) {
            const weatherInfo = `
                <p><strong>Temperature:</strong> ${data.current_weather.temperature}°C</p>
                <p><strong>Wind Speed:</strong> ${data.current_weather.windspeed} km/h</p>
            `;
            document.getElementById('weather-info').innerHTML = weatherInfo;
        } else {
            document.getElementById('weather-info').innerHTML = 'Weather data not available.';
        }
    } catch (error) {
        document.getElementById('weather-info').innerHTML = 'Error fetching weather data.';
        console.error('Error fetching weather data:', error);
    }
}

fetchWeather();



function populateEditForm() {
    var userId = document.getElementById('user_id').value;
    var form = document.getElementById('edit-user-form');
    var editUserIdField = document.getElementById('edit_user_id');

    editUserIdField.value = userId;

    if (userId) {
        fetch(`get_user.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.id) {
                    document.getElementById('edit_name').value = data.name || '';
                    document.getElementById('edit_surname').value = data.surname || '';
                    document.getElementById('edit_phone').value = data.phone_number || '';
                    document.getElementById('edit_personal_code').value = data.personal_code || '';
                } else {
                    console.error('No data found for the selected user.');
                    clearEditForm();
                }
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                clearEditForm();
            });
    } else {
        clearEditForm();
    }
}

function clearEditForm() {
    document.getElementById('edit_user_id').value = '';
    document.getElementById('edit_name').value = '';
    document.getElementById('edit_surname').value = '';
    document.getElementById('edit_phone').value = '';
    document.getElementById('edit_personal_code').value = '';
}

function validateEditForm() {
    var userId = document.getElementById('edit_user_id').value;
    if (!userId) {
        alert('Please select a user to edit.');
        return false;
    }
    return true;
}