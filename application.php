<?php require 'src/init-application.php'; ?>
<?php include 'src/header.php' ?>
<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif (!empty($applicationData)): ?>
            <nav aria-label="breadcrumb">
                <ol id="w4" class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="account.html">заявки</a></li>
                </ol>
            </nav>
            <div class="application-index">

                <h1>Заявка на посещение</h1>



                <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">

                    <div id="w1" class="list-view">
                        <div class="d-flex flex-wrap justify-content-between layout-card">
                            <div class="item" data-key="9">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <?= $applicationData['reason'] ?> </h5>
                                            <p class="card-text">
                                                <?= $applicationData['text'] ?></p>
                                            <div class="card-text">
                                                <div class="opacity-50">
                                                    дата и время посещения:
                                                </div>
                                                <?= $applicationData['date'] ?>
                                            </div>
                                            <div class="card-text">
                                                <div class="opacity-50">
                                                    дата и время создания:
                                                </div>
                                                <?= $applicationData['created_at'] ?>

                                            </div>
                                            <div class="card-text">
                                                <div class="opacity-50">
                                                    статус:
                                                </div>
                                                <?php switch ($applicationData['status_id']) {

                                                    case 1:
                                                        echo 'Новая';
                                                        break;

                                                    case 2:
                                                        echo 'Подтверждена';
                                                        break;

                                                    case 3:
                                                        echo 'Выполнена';
                                                        break;

                                                    case 4:
                                                        echo 'Отклонена';
                                                        break;
                                                }
                                                 ?>
                                            </div>

                                            <a class="btn btn-danger" href="delete-app.php?id=<?= $applicationData['id'] ?>">отменить</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>
<?php endif ?>
<?php include 'src/footer.php' ?>