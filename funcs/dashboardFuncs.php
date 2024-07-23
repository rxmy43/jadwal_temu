<?php 

function get_total_guests($conn) {
    $query = mysqli_query($conn, "SELECT COUNT(*) AS total_guests FROM guest_appointments WHERE appointment_type = 'buku_tamu'");
}