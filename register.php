<?php require 'src/init-register.php';?>
<?php include 'src/header.php' ?>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <nav aria-label="breadcrumb">
                <ol id="w2" class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">регистрация</li>
                </ol>
            </nav>
            <div class="site-register">
                <h1>регистрация</h1>
                <?php if(!empty($flash)): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($flash) ?>
                </div>
                <?php endif ?>
                <form id="contact-form" action="" method="post">
                    <input type="hidden" name="_csrf"
                        value="rI0t9QFOm_bq9-tz8v8o0PlFBi-r8gGoNNEz1CtEt__v-H-4OXfyprKHgCzAsFuKphJQZ5mcbNxX4lWbHhCHtA==">
                    
                    <div class="mb-3 field-registerform-login required">
                        <label class="form-label" for="registerform-login">логин</label>
                        <input type="text" id="registerform-login" class="form-control" name="RegisterForm[login]" value="<?= htmlspecialchars($newUser->getLogin() ?? '') ?>"
                            aria-required="true">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3 field-registerform-password required">
                        <label class="form-label" for="registerform-password">пароль</label>
                        <input type="password" id="registerform-password" class="form-control" name="RegisterForm[password]" value="<?= htmlspecialchars($newUser->getPassword() ?? '') ?>"
                            aria-required="true">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3 field-registerform-fio required">
                        <label class="form-label" for="registerform-fio">фио</label>
                        <input type="text" id="registerform-fio" class="form-control" name="RegisterForm[name]" value="<?= htmlspecialchars($newUser->getName() ?? '') ?>"
                            aria-required="true">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3 field-registerform-email">
                        <label class="form-label" for="registerform-email">Email</label>
                        <input type="text" id="registerform-email" class="form-control" name="RegisterForm[email]" value="<?= htmlspecialchars($newUser->getEmail() ?? '') ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3 field-registerform-phone required">
                        <label class="form-label" for="registerform-phone">телефон</label>
                        <input type="text" id="registerform-phone" class="form-control" name="RegisterForm[phone]" value="<?= htmlspecialchars($newUser->getPhone() ?? '') ?>"
                            aria-required="true" data-plugin-inputmask="inputmask_f59f28e6">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">зарегистрировать</button>
                    </div>
                </form>
            </div><!-- site-register -->
        </div>
    </main>

<?php include 'src/footer.php'?>
