<?php require 'src/init-account.php'; ?>
<?php include 'src/header.php' ?>
<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($flash)): ?>
    <div class="alert alert-success">
        <?= $flash ?>
    </div>
<?php endif; ?>

        <nav aria-label="breadcrumb">
            <ol id="w4" class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">заявки</li>
            </ol>
        </nav>
        <div class="application-index">

            <h1>заявки</h1>

            <p>
                <a class="btn btn-success" href="add-application.php">подать заявку</a>
            </p>
            <p>
                <a class="btn btn-primary" href="change-password.php">сменить пароль</a>
            </p>

            <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
                <div class="application-search">
                    <form id="w0" action="/account/application/index" method="get" data-pjax="1">
                        <div class="form-group field-applicationsearch-status_id">
                            <label class="control-label" for="applicationsearch-status_id">статус</label>
                            <select id="applicationsearch-status_id" class="form-control" name="status_id">
                                <option value="">выберите статус</option>
                                <option value="1">На посещение</option>
                                <option value="2">Время забронировано</option>
                                <option value="3">Услуга оказана</option>
                                <option value="4">Посещение перенесено</option>
                            </select>
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">найти</button>
                            <a class="btn btn-outline-secondary" href="./">сбросить</a>
                        </div>
                    </form>
                </div>
                <div id="w1" class="list-view">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php foreach ($applications as $app): ?>
                            <div class="item col">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $app['reason'] ?></h5>
                                        <p class="card-text"><?= $app['text'] ?></p>
                                        <div class="card-text">
                                            <div class="opacity-50">дата и время посещения:</div>
                                            <?= $app['date'] ?> <?= $app['time'] ?>
                                        </div>
                                        <div class="card-text">
                                            <div class="opacity-50">дата и время создания:</div>
                                            <?= $app['created_at'] ?>
                                        </div>
                                        <div class="card-text">
                                            <div class="opacity-50">статус:</div>
                                            <?= $app['status_id'] ?>
                                        </div>
                                        <a class="btn btn-primary" href="application.php?id=<?= $app['id'] ?>">просмотр</a>
                                        <a class="btn btn-danger" href="delete-app.php?id=<?= $app['id'] ?>">отменить</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'src/footer.php' ?>