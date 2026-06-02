<?php

use src\Feedback;
use src\services\Request;
use src\services\Db;

require 'init.php';
$page = 'feedback.php';
$feedback = new Feedback($request, $db);

if ($request->isPost) {
    $feedback->loadFromForm($request->post(), $_FILES['imageFile']);
    try {
        $feedback->validate();
        if ($feedback->save()) {

            $_SESSION['flash'] = 'Отзыв добавлен';

            header('Location: feedback.php');
            exit();
        }
    } catch (src\exceptions\InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

$feedbacks = $feedback->findAll();
$feedbacks = array_filter(
    $feedbacks,
    fn($item) => $item['status'] === 'approved'
);
