<section class="sign-up-form">
    <div class="container-w">
        <div class="row">
            <div class="col">
                <div class="sign-up-form__header">
                    <h1>CREATE ACCOUNT</h1>
                    <?php
                    if (isset($notify)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?= $notify ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <div class="sign-up-form__content">
                    <form action="index.php?controller=users&action=sign-up-form" autocomplete="off" method="post"
                          enctype="multipart/form-data" name="my_form"
                          onsubmit="return validateFormSignUp()">

                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-input" id="name" placeholder="Eg: John Doe" name="full_name">
                            <p class="error" id="err-sign-up-name"></p>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-input" id="email" placeholder="Eg: johndoe@email.com"
                                   name="email">
                            <p class="error" id="err-sign-up-email"></p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-input" id="username" placeholder="Eg: john" name="username"
                                   maxlength="255">
                            <p class="error" id="err-sign-up-username"></p>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-input" id="password" placeholder="******"
                                   name="password">
                            <p class="error" id="err-sign-up-password"></p>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-input" id="confirm-password" placeholder="******"
                                   name="confirm_password">
                            <p class="error" id="err-sign-up-password-confirm"></p>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="form-label">Birthday</label>
                            <input type="date" class="form-input" id="birth-day" name="birth_day">
                            <p class="error" id="err-sign-up-birth-day">Birthday is required!</p>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" class="form-input" id="avatar" name="avatar">
                            <p class="error" id="err-sign-up-avatar">Avatar is required!</p>
                        </div>
                        <button type="submit" class="form-submit" name="sign_up">Sign up</button>
                    </form>
                    <p class="sign-up-form__already">Already have an account ?
                        <a href="index.php?controller=users&action=sign-in" class="sign-up-form__already--link">
                            Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>