<?php
require 'src/init-index.php';
include 'src/header.php';
?>

<main id="main" class="flex-shrink-0" role="main">
    <h1 class="mt-5">Макияж в мурино</h1>
</main>
<img src="img/1.png" alt="фото1" width="480" height="480">
<h6>Макияж и создание причёски</h6>
<h4>7 500 ₽</h4>
<img src="img/2.png" alt="фото2" width="480" height="480">
<h6>Свадебный образ (макияж +прическа)</h6>
<h4>8 000 ₽</h4>
<img src="img/3.png" alt="фото3" width="480" height="480">
<h6>Репетиция свадебного образа</h6>
<h4>7 500 ₽</h4>
<img src="img/4.png" alt="фото3" width="480" height="480">
<h6>Макияж (любая сложность)</h6>
<h4>4 500 ₽</h4>
<hr>

<h2>Отзывы клиентов</h2>

<?php if (!empty($feedbacks)): ?>

    <?php foreach ($feedbacks as $item): ?>

        <div class="card mb-3" style="width: 25rem;">

            <?php if (!empty($item['img'])): ?>
                <img src="<?= htmlspecialchars($item['img']) ?>"
                    class="card-img-top"
                    alt="Фото">
            <?php endif; ?>

            <div class="card-body">

                <h5 class="card-title">
                    <?= htmlspecialchars($item['name']) ?>
                </h5>

                <p class="card-text">
                    <?= htmlspecialchars($item['feedback_text']) ?>
                </p>

            </div>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>Опубликованных отзывов пока нет.</p>

<?php endif; ?>
<?php include 'src/footer.php' ?>