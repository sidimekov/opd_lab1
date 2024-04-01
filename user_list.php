<?php
require_once __DIR__ . '/backend/helper.php';

$user = getCurrentUser();

if (!checkAuth() || $user['role_id'] < 2) {
  redirect('/main.php');
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Список пользователей</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/styles_main.css"> -->
  <?php require_once (__DIR__ . '/css/styles_main.php'); ?>
  <?php include_once (__DIR__ . '/templates/script_reload.php'); ?>
</head>

<body>
  <?php include_once (__DIR__ . '/templates/header.php'); ?>

  <main class="main">
    <h1 class="heading">Список пользователей</h1>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Имя</th>
          <th>Почта</th>
          <th>Дата создания</th>
          <th>Роль</th>
          <th>Обновить</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (getUsers() as $user): ?>
          <?php
          $user_id = $user['id'];
          $role_id = $user['role_id'];
          $role = '';
          if ($role_id == 0) {
            $role = 'Пользователь';
          } else if ($role_id == 1) {
            $role = 'Эксперт';
          } else if ($role_id == 2) {
            $role = 'Админ';
          } ?>
          <tr>
            <form action="/backend/change_user.php" method="post">
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
              <td>
                <?php echo $user_id; ?>
              </td>
              <td><input type="text" name="user_name" value="<?php echo $user['name']; ?>"></td>
              <td><input type="text" name="user_email" value="<?php echo $user['email']; ?>"></td>
              <td>
                <?php echo $user['creation_date']; ?>
              </td>
              <td><input list="role_id" name="user_role" id="<?php echo $role_id; ?>" value="<?php echo $role_id . " - " . $role; ?>">
                <datalist id="role_id">
                  <option id="0" value="0 - Пользователь">
                  <option id="1" value="1 - Эксперт">
                  <option id="2" value="2 - Админ">
                </datalist>
              </td>
              <td><button type="submit">Обновить</button></td>
            </form>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


  </main>

</body>

</html>