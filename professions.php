<?php
require_once __DIR__ . '/backend/helper.php';

?>

<!DOCTYPE html>
<html>

<head>
  <title>Professions</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/styles_main.css"> -->
  <?php require_once __DIR__ .'/css/styles_main.php'; ?>
  <?php include_once __DIR__ . '/templates/script_reload.php';?>
  <link rel="icon" href="data:;base64,=">
</head>

<body>
  <?php include_once __DIR__ . '/templates/header.php' ?>

  <main class="main">
    <h1 class="heading">Профессии</h1>
    <div class="profession-boxes">
      <?php require_once __DIR__ . '/templates/profession_box.php'; ?>
    </div>
  </main>

</body>

</html>