// Function for edit buku tamu modal
function fetchOneBukuTamu(event) {
    var id = event.target.getAttribute('data-id');
    $.ajax({
        url: '/php/fetch_one_reservasi_tamu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            jenis: 'buku_tamu',
        },
        success: function (response) {
            renderFetchOneBukuTamu(response);
        },
        error: function (error) {
            console.error(error);
        },
    });
}

/* Edit */
const formEdit = document.getElementById('form_edit_buku_tamu');
const submitEdit = formEdit.querySelector("button[type='submit']");
const alertMessageEdit = document.querySelector('#editModal .alert');
const messageEdit = alertMessageEdit.querySelector('strong');

function renderFetchOneBukuTamu(response) {
    formEdit.querySelector("input[name='nama_tamu']").value =
        response.nama_tamu;
    formEdit.querySelector("textarea[name='alamat']").value = response.alamat;
    formEdit.querySelector("select[name='jenis_kelamin']").value =
        response.jenis_kelamin;
    formEdit.querySelector("select[name='karyawan_id']").value =
        response.karyawan_id;
    formEdit.querySelector("input[name='keperluan']").value =
        response.keperluan;
    formEdit.querySelector("input[name='jam_janji']").value =
        response.jam_janji;
    formEdit.querySelector("input[name='tanggal']").value = response.tanggal;
    formEdit.querySelector("input[name='instansi']").value = response.instansi;
    formEdit.querySelector("input[name='email_pemohon']").value =
        response.email_pemohon;
    formEdit.querySelector("input[name='jumlah_orang']").value =
        response.jumlah_orang;
    formEdit.querySelector('#img_foto').src = response.foto;
    submitEdit.setAttribute('data-id', response.id);
    submitEdit.setAttribute('data-old-photo-path', response.foto);
    openModal('editModal');
}

formEdit.onsubmit = (e) => {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/edit_reservasi_tamu.php', true);
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
    formData.append(
        'old_photo_path',
        submitEdit.getAttribute('data-old-photo-path')
    );
    xhr.send(formData);
};

// Function for delete buku tamu
const formDelete = document.getElementById('form_delete_buku_tamu');
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
    xhr.open('POST', 'php/delete_buku_tamu.php', true);
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

    let formData = new FormData();
    formData.append('id', submitDelete.getAttribute('data-id'));
    xhr.send(formData);
};
