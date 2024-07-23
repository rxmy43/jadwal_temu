/* Karyawan Select */
function phoneNumberFill() {
    const karyawanSelect = document.getElementById('karyawan');
    const selectedOption = karyawanSelect.options[karyawanSelect.selectedIndex];
    const phoneNumberInp = document.getElementById('telepon');

    const phoneNumber = selectedOption.getAttribute('data-phone');
    phoneNumberInp.value = phoneNumber;
}

/* Pathname */
const bukuTamu = {
    PATH: '/form_jadwal_buku_tamu.php',
    RESV_TYPE: 'buku_tamu',
    FORM_ID: 'form_jadwal_buku_tamu',
};

const janjiTemu = {
    PATH: '/form_jadwal_janji_temu.php',
    RESV_TYPE: 'janji_temu',
    FORM_ID: 'form_jadwal_janji_temu',
};

/* Form */
let form = null;
if (window.location.pathname === janjiTemu.PATH) {
    form = document.getElementById(janjiTemu.FORM_ID);
} else if (window.location.pathname === bukuTamu.PATH) {
    form = document.getElementById(bukuTamu.FORM_ID);
}
const submit = form.querySelector("button[type='submit']");
const alertMsg = document.querySelector('.alert');
const msg = alertMsg.querySelector('strong');

form.onsubmit = (e) => {
    e.preventDefault();
};

submit.onclick = () => {
    let isValid = true;
    form.querySelectorAll('[required]').forEach((input) => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    });

    if (!isValid) {
        alertMsg.style.display = 'block';
        alertMsg.classList.add('failure');
        msg.innerHTML = 'Tolong isi semua fields.';
        return;
    }

    submit.disabled = true;
    submit.innerHTML = 'Loading...';

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/reservasi_tamu.php', true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.LOADING) {
            alertMsg.style.display = 'none';
            alertMsg.classList.remove('failure');
            alertMsg.classList.remove('success');
        }
        if (xhr.readyState === XMLHttpRequest.DONE) {
            submit.disabled = false;
            submit.innerHTML = 'Submit';
            alertMsg.style.display = 'block';
            if (xhr.responseText.toLowerCase().includes('berhasil')) {
                alertMsg.classList.add('success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                alertMsg.classList.add('failure');
            }
            msg.innerHTML = xhr.responseText;
        }
    };

    let formData = new FormData(form);

    if (window.location.pathname === janjiTemu.PATH) {
        formData.append('jenis_reservasi', janjiTemu.RESV_TYPE);
    } else if (window.location.pathname === bukuTamu.PATH) {
        formData.append('jenis_reservasi', bukuTamu.RESV_TYPE);
    } else {
    }
    xhr.send(formData);
};

function loadingState(state) {
    if (state == true) {
        document.querySelectorAll('button').forEach((el) => {
            el.disabled = true;
        });
        document.querySelector("button[type='submit']").innerHTML =
            'sending...';
    } else {
        document.querySelectorAll('button').forEach((el) => {
            el.removeAttribute('disabled');
        });
        document.querySelector("button[type='submit']").innerHTML = 'send';
    }
}
