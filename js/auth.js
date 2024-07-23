/* Alert Message */
const errMessage = document.querySelector('.alert');

/* Register Form */
const registerForm = document.getElementById('admin_register_form');

/* Login Form */
const loginForm = document.getElementById('admin_login_form');

/* Function to send authentication request */
const sendAuth = (isLogin) => {
    const url = isLogin ? 'php/login.php' : 'php/register.php';
    const form = isLogin ? loginForm : registerForm;
    const xhr = new XMLHttpRequest();

    xhr.open('POST', url, true);

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
};

/* Event Listeners for Register and Login Forms */
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    sendAuth(false);
});

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    sendAuth(true);
});
