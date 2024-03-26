<?php

require_once __DIR__ . '/helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $queries = json_decode($_POST['queries']);

    // foreach ($query as $queries) {
    //     var_dump($query);
    // }
    var_dump($queries);
    foreach ($queries as $query) {
        runDBQuery($query);
    }

}

// redirect('/assessment.php');