<?php

$DAYS = array(
    0 => "Minggu",
    1 => "Senin",
    2 => "Selasa",
    3 => "Rabu",
    4 => "Kamis",
    5 => "Jum'at",
    6 => "Sabtu",
);

$MONTHS = array(
    1 => "Januari",
    2 => "Februari",
    3 => "Maret",
    4 => "April",
    5 => "Mei",
    6 => "Juni",
    7 => "Juli",
    8 => "Agustus",
    9 => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember",
);

function get_current_date() : string {
    global $MONTHS;
    global $DAYS;

    $current_day_index = date('w');
    $current_month = date('n');

    $current_date = $DAYS[$current_day_index] . ", " .  date('d ') . $MONTHS[$current_month] . date(' Y');

    return $current_date;
}