let currentPage = 1;
const searchInput = $('#search');
const showSelect = $('#show');
const dataContainer = $('#data-container');
const pagination = $('#pagination');
const alertMsg = $('.alert');

const JADWAL_JANJI = '/jadwal_janji.php';
const BUKU_TAMU = '/buku_tamu.php';

const JANJI_TEMU_RESERVATION_TYPE = 'janji_temu';
const BUKU_TAMU_RESERVATION_TYPE = 'buku_tamu';

function getReservationType() {
    return window.location.pathname === JADWAL_JANJI
        ? JANJI_TEMU_RESERVATION_TYPE
        : BUKU_TAMU_RESERVATION_TYPE;
}

function loadData(page) {
    currentPage = page;
    let search = searchInput.val().trim();
    let recordsPerPage = showSelect.val();

    let type = getReservationType();

    $.ajax({
        url: '/php/fetch_reservasi_tamu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            search: search,
            page: currentPage,
            records_per_page: recordsPerPage,
            jenis_reservasi: type,
        },
        success: function (response) {
            renderData(type, response);
        },
        error: function (response) {
            $('.alert').css('display', 'block');
            $('.alert').addClass('failure');
            $('.alert').removeClass('success');
            $('.alert #message').text(response.message);
        },
    });
}

function renderData(type, response) {
    dataContainer.empty(); // Clear previous data
    if (response.data.length > 0) {
        if (type === JANJI_TEMU_RESERVATION_TYPE) {
            $.each(response.data, function (index, row) {
                // Format appointment_date into Indonesian date format
                let appointmentDate = formatDateIndonesian(row.tanggal);

                let rowData = `
                    <tr>
                        <td data-label="No">${
                            index +
                            1 +
                            (currentPage - 1) * response.records_per_page
                        }</td>
                        <td data-label="Nama">${row.nama_tamu}</td>
                        <td data-label="Nama">${row.email_pemohon}</td>
                        <td data-label="Alamat">${row.alamat}</td>
                        <td data-label="Jenis Kelamin">${
                            row.jenis_kelamin === 'l'
                                ? 'Laki-laki'
                                : 'Perempuan'
                        }</td>
                        <td data-label="Telepon">${row.nomor_telepon}</td>
                        <td data-label="Bertemu Dengan">${
                            row.nama_karyawan
                        }</td>
                        <td data-label="Keperluan">${row.keperluan}</td>
                        <td data-label="Tanggal">${appointmentDate}</td>
                        <td data-label="Jumlah Orang">${row.jumlah_orang}</td>
                        <td data-label="Foto Tamu"><img src="${
                            row.foto
                        }" alt="Foto Tamu"></td>
                        ${renderActionRow(row.id)}
                    </tr>
                `;

                dataContainer.append(rowData);
            });
        } else {
            $.each(response.data, function (index, row) {
                let appointmentDate = formatDateIndonesian(row.tanggal);

                let rowData = `
                    <tr>
                        <td data-label="No">${
                            index +
                            1 +
                            (currentPage - 1) * response.records_per_page
                        }</td>
                        <td data-label="Nama">${row.nama_tamu}</td>
                        <td data-label="Alamat">${row.alamat}</td>
                        <td data-label="Jenis Kelamin">${
                            row.jenis_kelamin === 'l'
                                ? 'Laki-laki'
                                : 'Perempuan'
                        }</td>
                        <td data-label="Nomor Telp Tamu">${
                            row.nomor_telepon
                        }</td>
                        <td data-label="Nama Karyawan">${row.nama_karyawan}</td>
                        <td data-label="Keperluan">${row.keperluan}</td>
                        <td data-label="Jam Janji">${row.jam_janji.substring(
                            0,
                            5
                        )}</td>
                        <td data-label="Jam Janji">${
                            row.jam_masuk ? row.jam_masuk.substring(0, 5) : ''
                        }</td>
                        ${renderActionRow(row.id, row.nama_tamu)}
                    </tr>
                `;

                dataContainer.append(rowData);
            });
        }
    } else {
        dataContainer.append(renderNotFoundData(13));
    }

    pagination.empty(); // Clear previous pagination

    // Previous Button
    if (currentPage > 1) {
        let prevPage = currentPage - 1;
        let prevLink = `<a href="#" onclick="loadData(${prevPage})">&laquo;</a>`;
        pagination.append(prevLink);
    }

    // Page Links with Ellipses
    const totalPages = response.total_pages;
    const maxPagesToShow = 5;

    if (totalPages <= maxPagesToShow) {
        for (let i = 1; i <= totalPages; i++) {
            let pageLink = `<a href="#" class="${
                currentPage === i ? 'active' : ''
            }" onclick="loadData(${i})">${i}</a> `;
            pagination.append(pageLink);
        }
    } else {
        if (currentPage <= Math.ceil(maxPagesToShow / 2)) {
            for (let i = 1; i <= maxPagesToShow - 1; i++) {
                let pageLink = `<a href="#" class="${
                    currentPage === i ? 'active' : ''
                }" onclick="loadData(${i})">${i}</a> `;
                pagination.append(pageLink);
            }
            pagination.append('<span>...</span>');
            let lastPageLink = `<a href="#" onclick="loadData(${totalPages})">${totalPages}</a> `;
            pagination.append(lastPageLink);
        } else if (currentPage >= totalPages - Math.floor(maxPagesToShow / 2)) {
            let firstPageLink = `<a href="#" onclick="loadData(1)">1</a> `;
            pagination.append(firstPageLink);
            pagination.append('<span>...</span>');
            for (
                let i = totalPages - (maxPagesToShow - 2);
                i <= totalPages;
                i++
            ) {
                let pageLink = `<a href="#" class="${
                    currentPage === i ? 'active' : ''
                }" onclick="loadData(${i})">${i}</a> `;
                pagination.append(pageLink);
            }
        } else {
            let firstPageLink = `<a href="#" onclick="loadData(1)">1</a> `;
            pagination.append(firstPageLink);
            pagination.append('<span>...</span>');
            for (
                let i = currentPage - Math.floor((maxPagesToShow - 2) / 2);
                i <= currentPage + Math.floor((maxPagesToShow - 2) / 2);
                i++
            ) {
                let pageLink = `<a href="#" class="${
                    currentPage === i ? 'active' : ''
                }" onclick="loadData(${i})">${i}</a> `;
                pagination.append(pageLink);
            }
            pagination.append('<span>...</span>');
            let lastPageLink = `<a href="#" onclick="loadData(${totalPages})">${totalPages}</a> `;
            pagination.append(lastPageLink);
        }
    }

    // Next Button
    if (currentPage < response.total_pages) {
        let nextPage = currentPage + 1;
        let nextLink = `<a href="#" onclick="loadData(${nextPage})">&raquo;</a>`;
        pagination.append(nextLink);
    }
}

// Function to format date into Indonesian format
function formatDateIndonesian(dateStr) {
    let months = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];

    let dateObj = new Date(dateStr);
    let day = dateObj.getDate();
    let monthIndex = dateObj.getMonth();
    let year = dateObj.getFullYear();

    return `${day} ${months[monthIndex]} ${year}`;
}

// Function for actions
function renderActionRow(id, name = null) {
    let result = '';

    const reservation = getReservationType();

    if (reservation === JANJI_TEMU_RESERVATION_TYPE) {
        // result = `<td data-label="Edit"><button data-id="${id}" onclick="confirmationModal(${id}, true)">Setujui</button></td>
        //             <td data-label="Hapus"><button class="decline" data-id="${id}" onclick="confirmationModal(${id}, false)">Tolak</button></td>`;
        result = `<td style="display:flex;align-items:center;gap:5px"> <button class="warning" onclick="sendWa(${id});">Hubungi</button>
                         <button data-id="${id}" onclick="confirmationModal(${id}, true)">Setujui</button> 
                         <button class="decline" data-id="${id}" onclick="confirmationModal(${id}, false)">Tolak</button></td>`;
    } else {
        result = `<td style="display:flex;align-items:center;gap:5px"> <button data-id="${id}" onclick="fetchOneBukuTamu(event)">Edit</button> <button class="decline" data-name="${name}" data-id="${id}" onclick="openDeleteModal(event)">Hapus</button> </td>`;
    }

    return result;
}

function sendWa(id) {
    $.ajax({
        url: '/php/fetch_one_reservasi_tamu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            jenis: 'janji_temu',
        },
        success: function (response) {
            var namaKaryawan = response.nama_karyawan;
            var namaTamu = response.nama_tamu;
            var tanggal = response.tanggal;
            var jam = response.jam_janji;
            var keperluan = response.keperluan;
            var phoneNumber = response.nomor_telepon_karyawan;
            if (phoneNumber.startsWith('08')) {
                phoneNumber = '+62' + phoneNumber.substring(1);
            }

            var message = `Hallo ${namaKaryawan}, kami menerima permintaan perjanjian janji temu dengan Anda. Dengan nama tamu ${namaTamu} pada ${tanggal} jam ${jam} WIB dengan keperluan ${keperluan}\nhttp://localhost:4000/detail-janji-temu.php?id=${id}`;
            var whatsappUrl =
                'https://wa.me/' +
                phoneNumber +
                '?text=' +
                encodeURIComponent(message);
            window.open(whatsappUrl);
        },
        error: function (e) {
            console.error(e);
        },
    });
}

// Function for approval modal
function confirmationModal(id, apprStatus) {
    const confirmText = document.querySelector('#confirm_modal #confirm_text');
    const confirmBtn = document.querySelector('#confirm_modal #confirm_button');
    const cancelBtn = document.querySelector('#confirm_modal #cancel_button');

    const modal = document.getElementById('confirm_modal');

    modal.style.display = 'block';

    const approvalText = `<span style="color: ${
        apprStatus ? '#007a63' : '#cc0000'
    }"">${apprStatus ? 'Menyetujui' : 'Menolak'}</span>`;

    confirmText.innerHTML =
        'Apakah Anda yakin ingin ' + approvalText + ' data ini?';

    confirmBtn.innerHTML = apprStatus ? 'Setujui' : 'Tolak';
    confirmBtn.onclick = function () {
        appointmentApproval(id, apprStatus);
    };

    if (!apprStatus) {
        confirmBtn.classList.add('decline');
        document.querySelector(
            '#confirm_modal #form_alasan_penolakan'
        ).style.display = 'block';
        document.querySelector(
            '#confirm_modal #form_edit_jadwal_janji__'
        ).style.display = 'none';
    } else {
        confirmBtn.classList.remove('decline');
        document.querySelector(
            '#confirm_modal #form_alasan_penolakan'
        ).style.display = 'none';
        document.querySelector(
            '#confirm_modal #form_edit_jadwal_janji__'
        ).style.display = 'block';
    }

    cancelBtn.onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
}

function renderNotFoundData(colspan) {
    return `<td colspan="${colspan}" style="text-align: center;font-weight: 600">Data tidak ditemukan.</td>`;
}

function appointmentApproval(id, isApprove) {
    if (isApprove) {
        $('#confirm_modal #confirm_button').text('Loading...');
    } else {
        $('#confirm_modal #cancel_button').text('Loading...');
    }

    $('#confirm_modal #confirm_button, #confirm_modal #cancel_button')
        .prop('disabled', true)
        .css('cursor', 'wait');
    $.ajax({
        url: '/php/approval_jadwal_temu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            approval_status: isApprove,
            id: parseInt(id),
            reject_reason: isApprove
                ? ''
                : $('#confirm_modal #alasan_penolakan').val(),
            suggested_date: isApprove
                ? ''
                : $('#confirm_modal #suggested_date').val(),
        },
        success: function (response) {
            $('.alert').css('display', 'block');
            $('.alert').addClass('success');
            $('.alert').removeClass('failure');
            $('.alert #message').text(response.message);
            $('#confirm_modal').css('display', 'none');
            loadData(currentPage);

            // if (isApprove) {
            //     // Fetch phone number and convert to international format if needed
            //     var phoneNumber = response.phone; // Replace with your input ID
            //     var namaKaryawan = response.nama_karyawan;
            //     var namaTamu = response.nama_tamu;
            //     var tanggal = response.tanggal;
            //     var jam = response.jam;
            //     var keperluan = response.keperluan;
            //     if (phoneNumber.startsWith('08')) {
            //         phoneNumber = '+62' + phoneNumber.substring(1);
            //     }

            //     var message = `Hallo ${namaKaryawan}, kami menerima permintaan perjanjian janji temu dengan Anda. Dengan nama tamu ${namaTamu} pada ${tanggal} jam ${jam} WIB dengan keperluan ${keperluan}`;
            //     var whatsappUrl =
            //         'https://wa.me/' +
            //         phoneNumber +
            //         '?text=' +
            //         encodeURIComponent(message);
            //     window.location.href = whatsappUrl;
            // }
        },
        error: function () {
            $('#confirm_modal #confirm_button, #confirm_modal #cancel_button')
                .prop('disabled', false)
                .css('cursor', 'default');
            if (isApprove) {
                $('#confirm_modal #confirm_button').text('Setujui');
            } else {
                $('#confirm_modal #cancel_button').text('Tolak');
            }
            $('.alert').css('display', 'block');
            $('.alert').addClass('failure');
            $('.alert').removeClass('success');
            $('.alert #message').text('Approval failed');
        },
    });

    $('#confirm_modal #confirm_button, #confirm_modal #cancel_button')
        .prop('disabled', false)
        .css('cursor', 'default');
    if (isApprove) {
        $('#confirm_modal #confirm_button').text('Setujui');
    } else {
        $('#confirm_modal #cancel_button').text('Tolak');
    }
}

// Initial load and event listeners
$(document).ready(function () {
    loadData(currentPage);

    searchInput.on(
        'keyup',
        debounce(function () {
            loadData(currentPage);
        }, 300)
    ); // Debounce search input to limit frequency of calls

    showSelect.on('change', function () {
        loadData(currentPage);
    });
});

// Debounce function for throttling event handlers
function debounce(func, delay) {
    let timer;
    return function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            func.apply(this, arguments);
        }, delay);
    };
}
