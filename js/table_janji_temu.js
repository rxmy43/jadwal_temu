let currentPage = 1;
const searchInput = $('#search');
const showSelect = $('#show');
const dataContainer = $('#data-container');
const pagination = $('#pagination');
const alertMsg = $('.alert');

const JADWAL_JANJI = '/jadwal_janji.php';
const BUKU_TAMU = '/buku_tamu.php';

function loadData(page) {
    currentPage = page;
    let search = searchInput.val().trim();
    let recordsPerPage = showSelect.val();

    $.ajax({
        url: '/php/fetch_jadwal_temu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            search: search,
            page: currentPage,
            records_per_page: recordsPerPage,
        },
        success: function (response) {
            renderData(response);
        },
    });
}

function renderData(response) {
    dataContainer.empty(); // Clear previous data

    if (response.data.length > 0) {
        $.each(response.data, function (index, row) {
            // Format appointment_date into Indonesian date format
            let appointmentDate = formatDateIndonesian(row.tanggal_janji);

            let rowData = `
                <tr>
                    <td data-label="No">${
                        index +
                        1 +
                        (currentPage - 1) * response.records_per_page
                    }</td>
                    <td data-label="Nama">${row.nama_tamu}</td>
                    <td data-label="Alamat">${row.alamat}</td>
                    <td data-label="Jenis Kelamin">${row.jenis_kelamin}</td>
                    <td data-label="Telepon">${row.nomor_telepon}</td>
                    <td data-label="Bertemu Dengan">${row.nama_karyawan}</td>
                    <td data-label="Keperluan">${row.keperluan}</td>
                    <td data-label="Jam Masuk">${row.jam_janji}</td>
                    <td data-label="Tanggal">${appointmentDate}</td>
                    <td data-label="Jumlah Orang">${row.jumlah_orang}</td>
                    <td data-label="Foto Tamu"><img src="${
                        row.foto
                    }" alt="Foto Tamu"></td>
                    ${renderActionRow(row.id, row.status)}
                </tr>
            `;

            dataContainer.append(rowData);
        });
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
function renderActionRow(id, status) {
    let result = '';

    switch (status) {
        case 'Menunggu':
            result = `<td data-label="Edit"><button data-id="${id}" onclick="appointmentApproval(this, true)">Setujui</button></td>
                    <td data-label="Hapus"><button class="decline" data-id="${id}" onclick="appointmentApproval(this, false)">Tolak</button></td>`;
            break;
        case 'Disetujui':
            result = `<td colspan="2" style="text-align:center;"><span class="badge badge-success">${status}</span></td>`;
            break;
        case 'Ditolak':
            result = `<td colspan="2" style="text-align:center;"><span class="badge badge-danger">${status}</span></td>`;
            break;
        default:
            break;
    }

    return result;
}

function renderNotFoundData(colspan) {
    return `<td colspan="${colspan}" style="text-align: center;font-weight: 600">Data tidak ditemukan.</td>`;
}

function appointmentApproval(event, isApprove) {
    var approvalStatus = isApprove ? 'Disetujui' : 'Ditolak';
    var id = $(event).data('id');

    $.ajax({
        url: '/php/approval_jadwal_temu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            approval_status: approvalStatus,
            id: parseInt(id),
        },
        success: function (response) {
            $('.alert').css('display', 'block');
            $('.alert').addClass('success');
            $('.alert').removeClass('failure');
            $('.alert #message').text(response.message);
            loadData(currentPage);
        },
        error: function () {
            $('.alert').css('display', 'block');
            $('.alert').addClass('failure');
            $('.alert').removeClass('success');
            $('.alert #message').text('Approval failed');
        },
    });
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
