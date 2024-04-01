<?php

require_once __DIR__ . '/helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    // формат "id роли - имя роли" переделать в id роли
    $user_role_id = str_split($user_role)[0];
    if (is_numeric($user_role_id) && $user_role_id >= 0 && $user_role_id <= 2) {
        updateUser($user_id, $user_name, $user_email, $user_role_id);
    } else {
        redirectToPrevious();
    }
}

redirectToPrevious();