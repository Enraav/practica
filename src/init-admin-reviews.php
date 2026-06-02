init-admin-reviews.php

<?php

require 'init.php';

if ($user->isGuest) {
    header('Location: login.php');
    exit();
}

if (!$user->isAdmin()) {
    header('Location: login.php');
    exit();
}

$feedback = new \src\Feedback($request, $db);

if ($request->isPost) {

    $id = (int)($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($id > 0) {

        $feedback->id = $id;

        if ($action === 'publish') {

            $feedback->update([
                'status' => 'approved',
                'status_id' => 2
            ]);

            $_SESSION['flash'] = 'Отзыв опубликован';
        } elseif ($action === 'reject') {

            $feedback->update([
                'status' => 'rejected',
                'status_id' => 3
            ]);

            $_SESSION['flash'] = 'Отзыв отклонён';
        }

        header('Location: admin-reviews.php');
        exit();
    }
}

if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

$reviews = $feedback->findAll();
