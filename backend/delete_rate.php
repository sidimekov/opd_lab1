<?php

require_once __DIR__ . '/helper.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = getCurrentUser()['id'];
    $profId = intval($_POST['delete_rate']);
    deleteRatingBy($userId, $profId);
    // var_dump($_POST);
}

redirect('/assessment.php');