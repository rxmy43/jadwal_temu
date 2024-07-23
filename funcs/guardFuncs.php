<?php

function checkAuth() {
    if (!isset($_SESSION['unique_id'])) {
        header("location: /login.php");
        exit;
    }
}

function checkRole($conn, $role_names, $unique_id) {
    if (is_array($role_names)) {
        $users = [];
        foreach ($role_names as $role_name) {
            $role_name = strtolower($role_name);
            $query = mysqli_query($conn, "SELECT unique_id FROM $role_name WHERE unique_id = '$unique_id'");
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);
                $users[] = $row;
            }
        }

        if (count($users) == 0) {
            header("location: forbidden.php");
            exit;
        }
    } else {
        $role_names = strtolower($role_names);
        $query = mysqli_query($conn, "SELECT unique_id FROM $role_names WHERE unique_id = '$unique_id'");
        if (mysqli_num_rows($query) == 0) {
            header("location: forbidden.php");
            exit;
        }
    }
}

function getUniqueId() {
    return $_SESSION['unique_id'];
}