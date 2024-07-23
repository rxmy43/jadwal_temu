function fetchData() {
    const refreshButton = document.getElementById('refreshButton');
    refreshButton.classList.add('spinning');

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/dashboard_fetch_data.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                document.getElementById('total-tamu').textContent =
                    response.total_tamu;
                document.getElementById('tamu-hari-ini').textContent =
                    response.tamu_hari_ini;
                document.getElementById('jadwal-temu').textContent =
                    response.jadwal_temu;
            } else {
                console.error('Failed to fetch data.');
            }
        }
    };

    setTimeout(() => {
        refreshButton.classList.remove('spinning');
    }, 1000);
    xhr.send();
}

document.getElementById('refreshButton').addEventListener('click', fetchData);

document.addEventListener('DOMContentLoaded', fetchData);
