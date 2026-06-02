<?php
require 'init.php';

if($user->isGuest){
    header('Location: login.php');
    exit();
}

$application = new \src\Application($request, $db);
$applications = $application->findByColumn('user_id', $user->id);
if($applications === null) $applications = [];
$statusFilter = $_GET['status_id'] ?? '';
if(isset($_GET['id'])) {
    $application->id = $_GET['id'];
    $application->update(['status' => 'canceled']);
    $_SESSION['flash'] = 'Заявка успешно отменена';
    header('Location: account.php');
    exit();
}
if(!empty($statusFilter)){
    $applications = array_filter($applications, function($app) use ($statusFilter){
        return $app['status'] === $statusFilter;
    });
}
?>