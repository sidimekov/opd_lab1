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
</head>

<body>
  <?php include_once __DIR__ . '/templates/header.php' ?>

  <main class="main">
    <h1 class="heading">Список оценок</h1>

    <table class="table">
      <colgroup>
        <col span="1" style="width: 2%;">
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 36%;">
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 12%;">
        <col span="1" style="width: 30%;">
      </colgroup>


      <thead>
        <tr>
          <th>ID</th>
          <th>Профессия</th>
          <th>ПВК</th>
          <th>Эксперт</th>
          <th>Дата оценки</th>
          <th>Оценка</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (getAllRatings() as $rating): ?>
          <?php
          $rating_id = $rating['id'];

          $user_id = $rating['expert_id'];
          $user_name = getUserById($user_id)['name'];

          $prof_id = $rating['profession_id'];
          $prof_name = getProfessionById($prof_id)['name'];

          $piq_id = $rating['piq_id'];
          $piq_name = getPiqById($piq_id)['name'];

          $date = $rating['date'];

          $priority = $rating['priority'] * 10;
          ?>
          <tr>
            <td style="width=5%">
              <?php echo $rating_id; ?>
            </td>
            <td>
              <?php echo $prof_name; ?>
            </td>
            <td>
              <?php echo $piq_name; ?>
            </td>
            <td>
              <?php echo $user_name ?>
            </td>
            <td>
              <?php echo $date; ?>
            </td>
            <td>
              <div class="progress"><?php echo $priority . '%'; ?></div>
              <div class="progress-bar"
                style="width: 90%; background: linear-gradient(to right, red <?php echo $priority; ?>%, white 0%);">
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


  </main>

</body>

</html>