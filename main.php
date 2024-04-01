<?php
require_once __DIR__ . '/backend/helper.php';

?>

<!DOCTYPE html>
<html>

<head>
  <title>Site Name</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/styles_main.css"> -->
  <?php require_once __DIR__ . '/css/styles_main.php'; ?>
  <?php include_once __DIR__ . '/templates/script_reload.php'; ?>
  <link rel="icon" href="data:;base64,=">
</head>

<body>
  <?php include_once __DIR__ . '/templates/header.php' ?>
  <main class="main">
    <h1 class="heading">Лабораторная работа 1</h1>
    <div class="main_text">
      <br>
      Лабораторная работа 1. Определение видов программистов и ИТ,
      ПВК для определенного вида деятельности
      <br>
      Цель и задачи лабораторной работы: научиться разрабатывать системы в проектной
      деятельности, понять какие профессионально важные качества необходимы в
      профессиональной деятельности программистов и ИТ-специалистов.
      <div style="position: relative; height: 300px;">

        <img class="down_img" src="/src/p.png">

      </div>
    </div>
  </main>
</body>

</html>