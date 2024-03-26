<?php

require_once __DIR__ . "/helper.php";

// данные из post в переменные
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// валидация

if (empty ($name)) {
    setValidationError('name', 'Пустое имя!');
}

if (empty ($email)) {
    setValidationError('email', 'Пустой email!');
}
if (empty ($password)) {
    setValidationError('password', 'Пустой пароль!');
}

if (hasValidationErrors()) {
    setUserMenuDisplay(true);
    redirectToPrevious();
    // redirect('/main.php');
}


$pdo = getPDO();

// временно поставлены роли экспертов всем, кто зарегался
$query = "INSERT INTO users (email, name, password, role_id) VALUES (:email, :name, :password, 1)";

// $query = "INSERT INTO users (email, name, password) VALUES (:email, :name, :password)";

$params = [
    'name' => $name,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (\Exception $e) {
    setMessage('error', 'Произошла ошибка, возможно, эта почта уже занята.');
    setUserMenuDisplay(true);
    redirectToPrevious();
}

$user = getUserByEmail($email);
$_SESSION['user']['id'] = $user['id'];

setUserMenuDisplay(false);
redirectToPrevious();