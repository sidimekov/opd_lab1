<?php
require_once __DIR__ . '/backend/helper.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Site Name</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <header class="header">
        <div class="user-icon">
            <button class="user-icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </button>
            <div class="user-menu">
                <form method="post" action="backend/login.php">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo getOld('name') ?>">
                    <?php if (hasValidationError('name'))
                        echo getValidationError('name'); ?>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo getOld('email') ?>">
                    <?php if (hasValidationError('email'))
                        echo getValidationError('email'); ?>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo getOld('password') ?>">
                    <?php if (hasValidationError('password'))
                        echo getValidationError('password'); ?>
                    <?php if (hasMessage('error'))
                        echo getMessage('error'); ?>
                    <button type="submit">Log in/Sign in</button>
                </form>
            </div>
        </div>
    </header>
    <nav class="nav" style="margin-top: 50px">
        <a href="main.php" class="nav-link">Главная</a>
        <a href="professions.php" class="nav-link">Профессии</a>
        <a href="assessment.php" class="nav-link">Оценка профессий</a>
    </nav>

    <br>
    <form method="post" action="backend/login.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo getOld('name') ?>">
        <?php if (hasValidationError('name'))
            echo getValidationError('name'); ?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo getOld('email') ?>">
        <?php if (hasValidationError('email'))
            echo getValidationError('email'); ?>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo getOld('password') ?>">
        <?php if (hasValidationError('password'))
            echo getValidationError('password'); ?>
        <?php if (hasMessage('error'))
            echo getMessage('error'); ?>
        <button type="submit">Log in/Sign in</button>
    </form>
</body>

</html>