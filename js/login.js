const form = document.getElementById('admin_login_form');
const errMessage = document.querySelector('.alert');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const xhr = new XMLHttpRequest();

    xhr.open('POST', '/php/login.php', true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.LOADING) {
            errMessage.style.display = 'none';
            errMessage.classList.remove('success');
            errMessage.classList.remove('failure');
        }
        if (xhr.readyState === XMLHttpRequest.DONE) {
            errMessage.style.display = 'block';
            if (xhr.responseText.toLowerCase().includes('berhasil')) {
                errMessage.classList.add('success');
                setTimeout(() => {
                    location.href = '/dashboard.php';
                }, 1000);
            } else {
                errMessage.classList.add('failure');
            }
            errMessage.querySelector(
                '#alert-message'
            ).innerHTML = `<strong>${xhr.responseText}</strong>`;
        }
    };

    xhr.onerror = () => {
        errMessage.style.display = 'block';
        errMessage.classList.add('failure');
        errMessage.innerHTML = `<strong>Network error. Please try again.</strong>`;
    };

    const formData = new FormData(form);
    xhr.send(formData);
});
