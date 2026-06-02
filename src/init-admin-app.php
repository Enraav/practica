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

$application = new \src\Application($request, $db);

$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    header('Location: admin-panel.php');
    exit();
}

$applicationData = $application->getId($id);

if (empty($applicationData)) {
    $error = 'Заявка не найдена';
} else {
    $applicationData = $applicationData[0];
}

if ($request->isPost) {

    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    if (empty($date)) {
        throw new \src\exceptions\InvalidArgumentException(
            'Укажите дату'
        );
    }

    if (empty($time)) {
        throw new \src\exceptions\InvalidArgumentException(
            'Укажите время'
        );
    }

    $application->id = $id;

    $application->update([
        'date' => $date,
        'time' => $time,
        'status_id' => 4
    ]);
    header('Location: admin-app.php?id=' . $id);
    exit();
}
