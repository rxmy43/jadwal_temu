// Function for approval modal
function confirmationModal(button, apprStatus) {
    const id = button.getAttribute('data-id');

    const confirmText = document.getElementById('confirm_text');
    const confirmBtn = document.getElementById('confirm_button');
    const cancelBtn = document.getElementById('cancel_button');

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
        document.getElementById('form_alasan_penolakan').style.display =
            'block';
    } else {
        confirmBtn.classList.remove('decline');
        document.getElementById('form_alasan_penolakan').style.display = 'none';
    }

    cancelBtn.onclick = () => {
        modal.style.display = 'none';
    };

    document.getElementsByClassName('close')[0].onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
}

function appointmentApproval(id, isApprove) {
    $('#confirm_button, #cancel_button').prop('disabled', true);
    $.ajax({
        url: '/php/approval_jadwal_temu.php',
        type: 'POST',
        dataType: 'json',
        data: {
            approval_status: isApprove,
            id: parseInt(id),
            reject_reason: isApprove ? '' : $('#alasan_penolakan').val(),
            suggested_date: isApprove ? '' : $('#suggested_date').val(),
        },
        success: function (response) {
            $('.alert').css('display', 'block');
            $('.alert').addClass('success');
            $('.alert').removeClass('failure');
            $('.alert #message').text(response.message);
            $('#confirm_modal').css('display', 'none');

            setTimeout(() => {
                window.location.href = '/jadwal_janji.php';
            }, 1500);

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
            $('#confirm_button, #cancel_button').prop('disabled', false);
            $('.alert').css('display', 'block');
            $('.alert').addClass('failure');
            $('.alert').removeClass('success');
            $('.alert #message').text('Approval failed');
        },
    });
}
