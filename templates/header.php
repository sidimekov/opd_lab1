<header class="header">
  <div class="user-icon">
    <button class="user-icon-button" id="user-icon-button">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
    </button>
    <div class="user-menu">
      <?php if (checkAuth()): ?>
        <form method="post" action="/backend/logout.php">
          <button class="menu-button">Выйти</button>
        </form>
      <?php else: ?>
        <button class="menu-button" data-type="authorization">Авторизация</button>
        <button class="menu-button" data-type="registration">Регистрация</button>
        <?php $name_val = getValidationError('name');
        $email_val = getValidationError('email');
        $pass_val = getValidationError('password');
        $message_err = getMessage('error'); ?>
        <form class="menu-form authorization" method="post" action="backend/login.php">
          <label for="email">Почта:</label>
          <input type="email" id="email" name="email" value="<?php echo getOld('email') ?>">
          <?php if (hasValidationError('email'))
            echo $email_val . '<br><br>'; ?>
          <label for="password">Пароль:</label>
          <input type="password" id="password" name="password" value="<?php echo getOld('password') ?>">
          <?php if (hasValidationError('password'))
            echo $pass_val . '<br><br>'; ?>
          <?php if (hasMessage('error'))
            echo $message_err . '<br><br>'; ?>
          <button type="submit">Войти</button>
        </form>
        <form class="menu-form registration" method="post" action="backend/register.php">
          <label for="name">Имя:</label>
          <input type="text" id="name" name="name" value="<?php echo getOld('name') ?>">
          <?php if (hasValidationError('name'))
            echo $name_val . '<br><br>'; ?>
          <label for="email">Почта:</label>
          <input type="email" id="email" name="email" value="<?php echo getOld('email') ?>">
          <?php if (hasValidationError('email'))
            echo $email_val . '<br><br>'; ?>
          <label for="password">Пароль:</label>
          <input type="password" id="password" name="password" value="<?php echo getOld('password') ?>">
          <?php if (hasValidationError('password'))
            echo $pass_val . '<br><br>'; ?>
          <?php if (hasMessage('error'))
            echo $message_err . '<br><br>'; ?>
          <button type="submit">Зарегистрироваться</button>
        </form>
      <?php endif; ?>
    </div>
  </div>
  <?php if (checkAuth()): ?>
    <?php $user = getCurrentUser(); ?>
    <label for="user-icon-button" id="heading-text">
      <?php echo $user['name']; ?>
    </label>
  <?php else: ?>
    <label for="user-icon-button" id="heading-text">Войти / Зарегистрироваться</label>
  <?php endif; ?>
</header>
<nav class="nav" style="margin-top: 50px;">
  <a href="main.php" class="nav-link">
    <h3>Главная</h3>
  </a>
  <a href="professions.php" class="nav-link">
    <h3>Профессии</h3>
  </a>
  <?php if (checkAuth() && getCurrentUser()['role_id'] >= 1): ?>
    <a href="assessment.php" class="nav-link">
      <h3>Оценка профессий</h3>
    </a>
  <?php endif; ?>
  <?php if (checkAuth() && getCurrentUser()['role_id'] >= 2): ?>
    <a href="admin/user_list.php" class="nav-link">
      <h3>admin: Список пользователей</h3>
    </a>
    <a href="admin/rate_list.php" class="nav-link">
      <h3>admin: Список оценок</h3>
    </a>
  <?php endif; ?>
</nav>
<!-- <nav class="nav" style="margin-top: 50px;">
  <a href="main.php" class="nav-link">Главная</a>
  <a href="professions.php" class="nav-link">Профессии</a>
  <a href="assessment.php" class="nav-link">Оценка профессий</a>
</nav> -->