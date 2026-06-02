<!DOCTYPE html>
<html lang="ru-RU" class="h-100">

<head>
    <title>Макияж</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <header id="header">
        <nav class="navbar-expand-md navbar-dark bg-dark fixed-top navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">МАКИЯЖ</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav-collapse"
                    aria-controls="nav-collapse" aria-expanded="false" aria-label="Переключить навигацию">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="nav-collapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav nav">
                        <li class="nav-item"><a class="nav-link <?= $page == 'feedback.php' ? 'active' : '' ?>" href="feedback.php">ОТЗЫВЫ</a></li>
                        <?php if ($user->isGuest): ?>
                            <li class="nav-item"><a class="nav-link <?= $page == 'login.php' ? 'active' : '' ?>" href="login.php">ВОЙТИ</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link <?= $page == 'login.php' ? 'active' : '' ?>" href="logout.php"><?= $user->getLogin() ?>(ВЫЙТИ)</a></li>
                        <?php endif ?>
                        <?php if (!$user->isGuest && ($user->isAdmin() || true)): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $page == 'account.php' ? 'active' : '' ?>" href="account.php">ЛИЧНЫЙ КАБИНЕТ</a>
                            </li>
                        <?php endif; ?>
                        <?php if (!$user->isGuest && $user->isAdmin()) : ?>
                            <li class="nav-item"><a class="nav-link <?= $page == 'register.php' ? 'active' : '' ?>" href="register.php">РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЕЙ</a></li>
                            <li class="nav-item"><a class="nav-link <?= $page == 'admin-panel.php' ? 'active' : '' ?>" href="admin-panel.php">ПАНЕЛЬ АДМИНИСТРАТОРА</a></li>

                            <li class="nav-item"><a class="nav-link <?= $page == 'admin-reviews.php' ? 'active' : '' ?>" href="admin-reviews.php">МОДЕРАЦИЯ ОТЗЫВОВ</a></li>

                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="margin-top: 120px;">
        <?= $_SESSION['flash'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>