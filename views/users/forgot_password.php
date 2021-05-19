<section class="forgot-password">
    <div class="container-w">
        <div class="row">
            <div class="col">
                <div class="forgot-password__header">
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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h1 class="text-center">Forgot Password?</h1>
                            <p>We will be sending a reset password link to your email</p>
                            <div class="panel-body">
                                <form id="forgot-password-form" role="form" autocomplete="off" method="post"
                                      action="index.php?controller=users&action=forgot-password-form"
                                      onsubmit="return validateFormForgotPassword()"
                                      name="forgot_form">
                                    <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address"
                                                   class="form-control"
                                                   type="email">
                                        </div>
                                        <p class="error" id="err-email-forgot">Email is required!</p>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover_password" class="btn btn-lg btn-primary btn-block"
                                               value="Send" type="submit">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

