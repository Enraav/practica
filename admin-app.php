<?php
require 'src/init-admin-app.php';
include 'src/header.php';
?>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($flash)): ?>
            <div class="alert alert-success"><?= $flash ?></div>
        <?php endif; ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="admin-panel.php">заявки</a></li>
                <li class="breadcrumb-item active">просмотр</li>
            </ol>
        </nav>
        <div class="application-index">
            <h1>Заявка на посещение</h1>

            <div class="feedback-index p-3">
                <form id="w0" action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Выберите дату</label>
                        <input type="date" class="form-control" name="date" value="<?= $applicationData['date'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Выберите время посещения</label>
                        <input type="time" class="form-control" name="time" value="<?= $applicationData['time'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">изменить время</button>
                </form>
            </div>

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title"><?= $applicationData['reason'] ?></h3>
                    <p class="card-text">Пользователь: <?= $applicationData['user_id'] ?></p>
                    <p class="card-text"><?= $applicationData['text'] ?></p>
                    <div class="card-text">
                        <div class="opacity-50">дата и время посещения:</div>
                        <?= $applicationData['date'] ?> <?= $applicationData['time'] ?>
                    </div>
                    <div class="card-text">
                        <div class="opacity-50">дата и время создания:</div>
                        <?= $applicationData['created_at'] ?>
                    </div>
                    <div class="card-text mb-3">
                        <div class="opacity-50">статус:</div>
                        <?= $applicationData['status_id'] ?>
                    </div>



                    <?php if ($applicationData['status_id'] === 'new'): ?>
                        <a class="btn btn-primary" href="admin-app.php?id=<?= $applicationData['id'] ?>&submit">подтвердить</a>
                    <?php elseif ($applicationData['status_id'] === 'timereserv' || $applicationData['status_id'] === 'timechange'): ?>
                        <a class="btn btn-success" href="admin-app.php?id=<?= $applicationData['id'] ?>&finish">завершить</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'src/footer.php' ?>