const form = document.getElementById('form_tambah_petugas');
const submit = form.querySelector("button[type='submit']");
const alertMessage = document.querySelector('.alert');
const message = alertMessage.querySelector('strong');

form.onsubmit = (e) => {
    e.preventDefault();
};

submit.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/tambah_petugas.php', true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.LOADING) {
            alertMessage.style.display = 'none';
            alertMessage.classList.remove('success');
            alertMessage.classList.remove('failure');
        }
        if (xhr.readyState === XMLHttpRequest.DONE) {
            document.getElementById('myModal').scrollTo(0, 0);
            alertMessage.style.display = 'block';
            if (xhr.responseText.toLowerCase().includes('berhasil')) {
                alertMessage.classList.add('success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                alertMessage.classList.add('failure');
            }

            message.innerHTML = xhr.responseText;
        }
    };

    let formData = new FormData(form);
    xhr.send(formData);
};

/* Edit */
const formEdit = document.getElementById('form_edit_petugas');
const submitEdit = formEdit.querySelector("button[type='submit']");
const alertMessageEdit = document.querySelector('#editModal .alert');
const messageEdit = alertMessageEdit.querySelector('strong');

function fetchOnePetugas(event) {
    let id = event.target.getAttribute('data-id');

    $.ajax({
        url: '/php/get_one_petugas.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
        },
        success: function (response) {
            renderOneData(response);
            openModal('editModal');
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function renderOneData(response) {
    formEdit.querySelector("input[name='nama']").value = response.nama_petugas;
    formEdit.querySelector("input[name='username']").value = response.username;
    formEdit.querySelector("input[name='nip']").value = response.nip;
    formEdit.querySelector("input[name='telpon']").value =
        response.nomor_telepon;
    formEdit.querySelector("input[name='email']").value = response.email;
    formEdit.querySelector("input[name='shift']").value = response.shift;
    formEdit.querySelector("textarea[name='alamat']").value = response.alamat;
    submitEdit.setAttribute('data-id', response.id);
}

formEdit.onsubmit = (e) => {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/edit_petugas.php', true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.LOADING) {
            alertMessageEdit.style.display = 'none';
            alertMessageEdit.classList.remove('success');
            alertMessageEdit.classList.remove('failure');
        }
        if (xhr.readyState === XMLHttpRequest.DONE) {
            document.getElementById('editModal').scrollTo(0, 0);
            alertMessageEdit.style.display = 'block';
            if (xhr.responseText.toLowerCase().includes('berhasil')) {
                alertMessageEdit.classList.add('success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                alertMessageEdit.classList.add('failure');
            }

            messageEdit.innerHTML = xhr.responseText;
        }
    };

    let formData = new FormData(formEdit);
    formData.append('id', submitEdit.getAttribute('data-id'));
    xhr.send(formData);
};

/* Hapus */
const formDelete = document.getElementById('form_delete_petugas');
const submitDelete = formDelete.querySelector("button[type='submit']");
const alertMessageDelete = document.querySelector('#deleteModal .alert');
const messageDelete = alertMessageDelete.querySelector('strong');

function openDeleteModal(event) {
    submitDelete.setAttribute('data-id', event.target.getAttribute('data-id'));
    document.getElementById('deletion_name').innerHTML =
        event.target.getAttribute('data-name');
    openModal('deleteModal');
}

formDelete.onsubmit = (e) => {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/delete_petugas.php', true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.LOADING) {
            alertMessageDelete.style.display = 'none';
            alertMessageDelete.classList.remove('success');
            alertMessageDelete.classList.remove('failure');
        }
        if (xhr.readyState === XMLHttpRequest.DONE) {
            document.getElementById('deleteModal').scrollTo(0, 0);
            alertMessageDelete.style.display = 'block';
            if (xhr.responseText.toLowerCase().includes('berhasil')) {
                alertMessageDelete.classList.add('success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                alertMessageDelete.classList.add('failure');
            }

            messageDelete.innerHTML = xhr.responseText;
        }
    };

    let formData = new FormData(formDelete);
    formData.append('id', submitDelete.getAttribute('data-id'));
    xhr.send(formData);
};
