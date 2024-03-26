<?php

require_once __DIR__ . '/helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}

redirectToPrevious();