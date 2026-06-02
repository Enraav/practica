<?php

require 'init.php';

$page = 'index.php';

$feedback = new \src\Feedback($request, $db);

$feedbacks = $feedback->findAll();

$feedbacks = array_filter(
    $feedbacks,
    fn($item) => $item['status'] === 'approved'
);
