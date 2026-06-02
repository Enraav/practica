<?php require 'src/init-account.php'; ?>
<?php include 'src/header.php'; ?>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <div class="feedback-index p-3">

            <form id="w0" action="" method="post">

                <div class="mb-3 field-feedback-fio required">
                    <label class="form-label">
                        Выберите дату
                    </label>

                    <input
                        type="date"
                        id="app-date"
                        class="form-control"
                        name="date"
                        value="<?= htmlspecialchars($_POST['date'] ?? '') ?>"
                        aria-required="true">

                </div>

                <div class="mb-3 field-feedback-fio required">
                    <label class="form-label">
                        Выберите время посещения
                    </label>

                    <input
                        type="time"
                        id="app-time"
                        class="form-control"
                        name="time"
                        value="<?= htmlspecialchars($_POST['time'] ?? '') ?>"
                        aria-required="true">

                </div>

                <div class="mb-3 field-feedback-fio required">
                    <label class="form-label">
                        Причина посещения (кратко)
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="reason"
                        value="<?= htmlspecialchars($_POST['reason'] ?? '') ?>"
                        aria-required="true">

                </div>

                <div class="mb-3 field-feedback-text required">
                    <label class="form-label">
                        Причина посещения (подробно)
                    </label>

                    <textarea
                        class="form-control"
                        name="text"
                        aria-required="true"><?= htmlspecialchars($_POST['text'] ?? '') ?></textarea>

                </div>

                <div class="form-group">
                    <button
                        type="submit"
                        class="btn btn-primary">
                        Отправить заявку
                    </button>
                </div>

            </form>

        </div>

    </div>
</main>

<?php include 'src/footer.php'; ?>