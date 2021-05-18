<section class="reset-password">
    <div class="container_w">
        <div class="row">
            <div class="col">
                <div class="login-form__header">
                    <h1>RESET PASSWORD</h1>
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
                <div class="reset-password__content">
                    <?php
                    $key = "";
                    $token = "";
                    if (isset($_GET['key'])) {
                        $key = $_GET['key'];
                    }
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];
                    }
                    ?>
                    <form autocomplete="off"
                          action="index.php?controller=users&action=reset-password-form&key=<?= $key ?>&token=<?= $token ?>"
                          method="post"
                          name="reset_form"
                          onsubmit="return validateFormResetPassword()">
                        <input type="password" name="password" placeholder="New Password"/>
                        <p class="error" id="err-password-reset"></p>
                        <input type="password" name="password_confirm" placeholder="Confirm Password"/>
                        <p class="error" id="err-password-reset-confirm"></p>
                        <button type="submit" name="reset" class="btn btn-sign-in">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

