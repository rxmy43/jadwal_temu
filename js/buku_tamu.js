/* Form Buku Tamu */
const form = document.getElementById('form_jadwal_buku_tamu');
const alertMsg = document.querySelector('.alert');
const msg = alertMsg.querySelector('strong');

form.onsubmit = (e) => {
    e.preventDefault();
    console.log('Form submission prevented');

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
        msg.innerHTML = 'Semua kolom harus diisi.';
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/reservasi_tamu.php', true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.LOADING) {
            alertMsg.style.display = 'none';
            alertMsg.classList.remove('failure');
            alertMsg.classList.remove('success');
        }
        if (xhr.readyState === XMLHttpRequest.DONE) {
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
    formData.append('tipe_reservasi', 'buku_tamu');
    xhr.send(formData);
};
