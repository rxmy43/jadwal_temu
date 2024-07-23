<?php

function notBlank($field, $name) {
    if (empty($field)) {
        echo $name . " harus diisi";
        exit;
    }
}