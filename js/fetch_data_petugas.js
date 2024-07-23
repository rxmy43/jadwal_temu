let currentPage = 1;
const searchInput = $('#search');
const showSelect = $('#show');
const dataContainer = $('#data-container');
const pagination = $('#pagination');

function loadData(page) {
    currentPage = page;
    let search = searchInput.val().trim();
    let recordsPerPage = showSelect.val();

    $.ajax({
        url: '/php/fetch_petugas.php',
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
        error: function (response) {
            console.log(response);
        },
    });
}

function renderData(response) {
    dataContainer.empty(); // Clear previous data
    if (response.data.length > 0) {
        $.each(response.data, function (index, row) {
            let rowData = `
                <tr>
                    <td data-label="No">${
                        index +
                        1 +
                        (currentPage - 1) * response.records_per_page
                    }</td>
                    <td data-label="Nama">${row.nama_petugas}</td>
                    <td data-label="Shift">${row.shift}</td>
                    <td data-label="Telepon">${row.nomor_telepon}</td>
                    <td data-label="Email">${row.email}</td>
                    <td><button class="edit-karyawan" data-id="${
                        row.id
                    }" style="margin-right:8px" onclick="fetchOnePetugas(event)">Edit</button><button class="hapus-karyawan decline" data-id="${
                row.id
            }" data-name="${
                row.nama_petugas
            }" onclick="openDeleteModal(event)">Hapus</button></td>
                </tr>
            `;

            dataContainer.append(rowData);
        });
    } else {
        dataContainer.append(renderNotFoundData(6));
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

function renderNotFoundData(colspan) {
    return `<td colspan="${colspan}" style="text-align: center;font-weight: 600">Data tidak ditemukan.</td>`;
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
