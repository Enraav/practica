<?php
use src\User;
use src\exceptions\InvalidArgumentException;

$page = 'register.php';

require 'init.php';
require_once 'User.php';

if ($user->isGuest || !$user->isAdmin) {
    header('Location: feedback.php');
    exit;
}

$newUser = new User($request, $db);

$error = null;
$flash = null;

if ($request->isPost) {
    $formData = $request->post()['RegisterForm'] ?? [];
    $newUser->loadFromForm($formData);

    try {
        $newUser->validate();

        if ($newUser->save()) {
            $_SESSION['flash'] = 'Новый пользователь успешно зарегистрирован!';
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            $error = "Не удалось сохранить пользователя в базу данных.";
        }
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}

if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}
