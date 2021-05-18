<section class="login-form">
    <div class="container-w">
        <div class="row">
            <div class="col">
                <div class="login-form__header">
                    <h1>LOGIN FORM</h1>
                    <?php
                    if (isset($notify)) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $notify ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <div class="login-form__content">
                    <form autocomplete="off" action="index.php?controller=users&action=sign-in-form"
                          method="post"
                          name="login_form"
                          onsubmit="return validateFormLogin()">
                        <input type="text" name="username" placeholder="Username"/>
                        <p class="error" id="err-login-username">username is required!</p>
                        <input type="password" name="password" placeholder="Password"/>
                        <p class="error" id="err-login-password">password is required!</p>
                        <div class="login-form__link">
                            <a href="index.php?controller=users&action=forgot-password">Forgot
                                password?</a>
                            <a href="index.php?controller=users&action=sign-up">Sign up!</a>
                        </div>
                        <button type="submit" name="login" class="btn btn-sign-in">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>