<?php

require_once __DIR__ . '/helper.php';

// данные из post в переменные
$email = $_POST['email'];
$password = $_POST['password'];

// валидация

if (empty ($email)) {
    setValidationError('email', 'Пустой email!');
}
if (empty ($password)) {
    setValidationError('password', 'Пустой пароль!');
}



$user = getUserByEmail($email);

// вход

// проверка пароля
if (!hasValidationErrors() && !password_verify($password, $user['password'])) {
    setMessage('error', 'Неверный пароль');
    redirect('/main.php');
}

// если в валидации какие-то ошибки, то обратно

if (hasValidationErrors()) {
    setUserMenuDisplay(true);
    setOldValue('email', $email);
    // redirect('/main.php');
    redirectToPrevious();
}
    // успешный заход

    $_SESSION['user']['id'] = $user['id'];

    setUserMenuDisplay(false);
    redirectToPrevious();


