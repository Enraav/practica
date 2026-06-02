<?php
require 'autoLoad.php';
require 'config.php';
session_start();
try {
    $request = new src\services\Request();
    $db = new src\services\Db($dbOptions);
    $user = new src\User($request, $db);
    $identity = $user->identity();
    if ($identity !== null) {
        $user->load($identity);
        $user->isGuest = $identity ? false : true;
        $user->isAdmin = $user->isAdmin();
    }
} catch (\src\exceptions\DbExceptions $e) {
    echo $e->getMessage();
    exit();
}
// var_dump($user); die;
