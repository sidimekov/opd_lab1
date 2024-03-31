<?php
require_once __DIR__ . '/backend/helper.php';

if (!checkAuth() || getCurrentUser()['role_id'] < 1) {
  redirect('/main.php');
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Professions</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/styles_main.css"> -->
  <?php require_once __DIR__ . '/css/styles_main.php'; ?>
  <?php include_once __DIR__ . '/templates/script_reload.php'; ?>
  <link rel="icon" href="data:;base64,=">
</head>

<body>
  <?php include_once __DIR__ . '/templates/header.php' ?>

  <main class="main">
    <h1 class="heading">Оценка профессий</h1>
    <div class="profession-boxes">
      <?php require_once __DIR__ . '/templates/profession_rate_box.php'; ?>
  </main>

  <?php include_once __DIR__ . '/templates/windows/choose_piqs.php'; ?>
  <?php include_once __DIR__ . '/templates/windows/rate_piqs.php'; ?>
  <?php include_once __DIR__ . '/templates/windows/show_rating.php'; ?>

  <script type="module" src="scripts/rate_piqs.js"></script>

</body>

</html>