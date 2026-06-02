<?php require 'src/init-admin-panel.php' ?>
<?php include 'src/header.php'; ?>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol id="w4" class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">заявки</li>
            </ol>
        </nav>

        <div class="application-index">
            <h1>Все заявки из формы</h1>

            <div class="mb-3">
                <a href="admin-panel.php" class="btn <?= !isset($_GET['today']) ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm">Все заявки</a>
                <a href="admin-panel.php?today" class="btn <?= isset($_GET['today']) ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm">Только сегодняшние</a>
            </div>

            <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
                <div class="application-search">
                    <form id="w0" action="admin-panel.php" method="get">
                        <?php if (isset($_GET['today'])): ?>
                            <input type="hidden" name="today" value="">
                        <?php endif; ?>

                        <div class="form-group field-applicationsearch-status_id">
                            <label class="control-label" for="applicationsearch-status_id">статус</label>
                            <select id="applicationsearch-status_id" class="form-control" name="status_id">
                                <option value="">выберите статус</option>
                                <option value="1" <?= isset($_GET['status_id']) && $_GET['status_id'] == '1' ? 'selected' : '' ?>>Новая</option>
                                <option value="2" <?= isset($_GET['status_id']) && $_GET['status_id'] == '2' ? 'selected' : '' ?>>Время забронировано</option>
                                <option value="3" <?= isset($_GET['status_id']) && $_GET['status_id'] == '3' ? 'selected' : '' ?>>Услуга оказана</option>
                                <option value="4" <?= isset($_GET['status_id']) && $_GET['status_id'] == '4' ? 'selected' : '' ?>>Посещение перенесено</option>
                            </select>
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">найти</button>
                            <a class="btn btn-outline-secondary" href="admin-panel.php">сбросить</a>
                        </div>
                    </form>
                </div>

                <div id="w1" class="list-view mt-4">
                    <div class="d-flex flex-wrap justify-content-start gap-3">
                        <?php if (isset($applications) && is_array($applications) && !empty($applications)): ?>
                            <?php foreach ($applications as $app): ?>
                                <div class="item" data-key="<?= htmlspecialchars($app['id']) ?>">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= isset($app['reason']) ? htmlspecialchars($app['reason']) : 'Без названия' ?></h5>
                                            <p class="card-text"><?= isset($app['text']) ? htmlspecialchars($app['text']) : '' ?></p>

                                            <div class="card-text">
                                                <div class="opacity-50">дата и время посещения:</div>
                                                <?= isset($app['date']) ? htmlspecialchars($app['date']) : '' ?>
                                                <?= isset($app['time']) ? htmlspecialchars($app['time']) : '' ?>
                                            </div>

                                            <div class="card-text">
                                                <div class="opacity-50">дата и время создания:</div>
                                                <?= !empty($app['created_at']) ? htmlspecialchars($app['created_at']) : 'Не указано' ?>
                                            </div>

                                            <div class="card-text">
                                                <div class="opacity-50">отправитель (ID):</div>
                                                <?= isset($app['user_id']) ? htmlspecialchars($app['user_id']) : '' ?>
                                            </div>

                                            <div class="card-text mb-3">
                                                <div class="opacity-50">статус:</div>
                                                <?php
                                                $statusValue = (int)$app['status_id'];

                                                if ($statusValue === 1) echo 'Новая';
                                                elseif ($statusValue === 2) echo 'Время забронировано';
                                                elseif ($statusValue === 3) echo 'Услуга оказана';
                                                elseif ($statusValue === 4) echo 'Посещение перенесено';
                                                else echo htmlspecialchars($statusValue);
                                                ?>
                                            </div>

                                            <div class="mt-3">
                                                <a class="btn btn-primary btn-sm" href="admin-app.php?id=<?= $app['id'] ?>">просмотр</a>

                                                <?php if ($app['status_id'] == 1): ?>
                                                    <a class="btn btn-primary btn-sm" href="admin-panel.php?id=<?= $app['id'] ?>&submit<?= isset($_GET['today']) ? '&today' : '' ?>">подтвердить</a>
                                                <?php elseif ($app['status_id'] == 2 || $app['status_id'] == 4): ?>
                                                    <a class="btn btn-success btn-sm" href="admin-panel.php?id=<?= $app['id'] ?>&finish<?= isset($_GET['today']) ? '&today' : '' ?>">завершить</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="alert alert-info">Заявки отсутствуют или база данных пуста.</div>
                        <?php endif ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php include 'src/footer.php' ?>