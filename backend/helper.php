<?php

session_start();

require_once __DIR__ . '/config.php';


$PDO = null;
$professionPiqs = []; // список всех пвк и их важности для каждой профессии
// [ид_профессии => [ид_пвк => ['piq' => piq, 'importance' => float]]]
function redirect(string $path)
{
    header("Location: $path");
    die();
}

// Вернуться на предыдущую страницу
function redirectToPrevious()
{
    if (!empty($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        redirect('/main.php');
    }
    die();
}


// поставить ошибку валидации, проверить, получить
function setValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}
function hasValidationError(string $fieldName): bool
{
    return isset ($_SESSION['validation'][$fieldName]);
}

function hasValidationErrors() : bool
{
    if (!empty($_SESSION['validation']) || (hasMessage('error'))) {
        return true;
    } else {
        return false;
    }
}
function getValidationError(string $fieldName): string
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}


// при обновлении страницы ставим старые значения из сессии
function setOldValue(string $key, mixed $value): void
{
    $_SESSION['old'][$key] = $value;
}

// возвращаем старые значения
function getOld(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}


// поставить в сессию сообщение
function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}
// проверить сообщение
function hasMessage(string $key): bool
{
    return isset ($_SESSION['message'][$key]);
}
// получить сообщение
function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}




// получить объект PDO для работы с БД
function getPDO(): PDO
{
    global $PDO;
    try {
        if (is_null($PDO)) {
            $PDO = new \PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
        }
        return $PDO;
    } catch (\PDOException $e) {
        die ("Connection error: {$e->getMessage()}");
    }
}

// найти пользователя с таким email
function getUserByEmail(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

// получить текущего пользователя
function getCurrentUser(): array|false
{
    $pdo = getPDO();

    if (!isset ($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

// выполнить запрос к БД
function runDBQuery($query) {
    $pdo = getPDO();

    $stmt = $pdo->prepare($query);
    try {
        $stmt->execute();
    } catch (\Exception $e) {
        die ($e->getMessage());
    }
}

function logout(): void
{
    unset($_SESSION['user']['id']);
    redirectToPrevious();
}

function checkAuth(): bool
{
    if (!isset ($_SESSION['user']['id'])) {
        return false;
    }
    return true;
}


function getUsers(): array
{
    // user['id']
    // user['name']
    // user['email']
    // user['password']
    // user['role_id']
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
function getUserById(int $user_id): array|bool
{
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function setUserRole(int $user_id, int $role_id): void
{
    $pdo = getPDO();
    $query = 'UPDATE users SET role_id = :role_id WHERE users.id = :user_id;';
    $params = [
        'user_id' => $user_id,
        'role_id' => $role_id
    ];
    $stmt = $pdo->prepare($query);
    try {
        $stmt->execute($params);
    } catch (\Exception $e) {
        die ($e->getMessage());
    }
}

function getProfessions(): array|bool
{
    // professions['id']
    // professions['name']
    // professions['description']
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM professions");
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

function getProfessionById(int $prof_id): array|bool
{
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM professions WHERE id = :id");
    $stmt->execute(['id' => $prof_id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function getPiqs(): array|bool
{
    // piq['id']
    // piq['name']
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM piqs");
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
function getPiqById(int $piq_id): array|bool
{
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM piqs WHERE id = :id");
    $stmt->execute(['id' => $piq_id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

// Найти все ОЦЕНКИ у профессии
// (каждый эксперт делает столько оценок, сколько пвк)
function getProfRatings(int $prof_id): array|bool
{
    // rating - как вариант для инстанса ОДНОГО рейтинга у профессии, опциональная строка
    // rating['id']
    // rating['piq']
    // rating['priority'] приоритет при записи подсчитывать как приоритет / 10 (максимум можно эксперту выбрать 10 пвк)
    // rating['expert']
    // rating['date']
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM ratings WHERE profession_id = :id");
    $stmt->execute(['id' => $prof_id]);
    $tuples = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if (!$tuples) {
        return false;
    } else {
        foreach ($tuples as $key => $tuple) {
            $tuple['piq'] = getPiqById($tuple['piq_id']);
            $tuple['expert'] = getUserById($tuple['expert_id']);
            $tuples[$key] = $tuple;
        }
    }
    return $tuples;
}

// ПОСЧИТАТЬ ИТОГОВЫЙ отсортированный рейтинг у профессии
// типа подсчитать список ПВК и их процент важности у каждого для ОДНОЙ профессии
function countProfResultRating(int $prof_id): void
{
    global $professionPiqs;
    // возвращается список ссылочных массивов
    // resultPiq - как вариант инстанса одного такого массива (пвк + его важность от 0 до 1 вкл.)
    // resultPiq = getProfResultRating[piq_id]
    // resultPiq['piq']
    // resultPiq['importance']
    $ratings = getProfRatings($prof_id);
    $result = []; // result = [piq_id => ['piq' => piq, 'importance' => float]]
    if ($ratings) {
        foreach ($ratings as $rating) {
            $currPiq = $rating['piq'];
            $currPriority = $rating['priority'];
            $piq = $result[$currPiq['id']] ?? null;
            if (is_null($piq)) {
                $result[$currPiq['id']]['piq'] = $currPiq;
                $result[$currPiq['id']]['importance'] = $currPriority / 10;
            } else {
                $result[$currPiq['id']]['importance'] = ($result[$currPiq['id']]['importance'] + ($currPriority / 10)) / 2;
            }
        }
    }

    usort($result, 'importanceSort');
    $result = array_reverse($result);
    $professionPiqs[$prof_id] = $result;
}

// Получить подсчёт всех ПВК для ОДНОЙ профессии
function getProfResultRating(int $prof_id, int $n = 0): array
{
    global $professionPiqs;
    if (is_null($professionPiqs[$prof_id] ?? null)) {
        countProfResultRating($prof_id);
    }
    if ($n == 0) {
        return $professionPiqs[$prof_id];
    } else {
        return array_slice($professionPiqs[$prof_id], 0, $n);
    }
}

function importanceSort ($x, $y) {
    return $x['importance'] <=> $y['importance'];
}

function setUserMenuDisplay($display){
    $_SESSION['userMenu'] = $display;
}
function getUserMenuDisplay() : bool {
    if (!isset($_SESSION['userMenu'])) {
        $_SESSION['userMenu'] = false;
    }
    return $_SESSION['userMenu'];
}
function getCSSUserMenuDisplay() : string
{
    if (getUserMenuDisplay()) {
        return 'block';
    } else {
        return 'none';
    }
}

// получить оценку эксперта одной профессии
function getRatingBy($userId, $professionId) : array
{
    $pdo = getPDO();
    
    $stmt = $pdo->prepare("SELECT * FROM ratings WHERE profession_id = :profession_id AND expert_id = :expert_id;");
    $stmt->execute(['profession_id' => $professionId, 'expert_id' => $userId]);
    $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $return;
}

// удалить оценки эксперта одной профессии
function deleteRatingBy($userId, $professionId)
{
    $pdo = getPDO();
    
    $stmt = $pdo->prepare("DELETE FROM ratings WHERE profession_id = :profession_id AND expert_id = :expert_id;");
    $stmt->execute(['profession_id' => $professionId, 'expert_id' => $userId]);
}