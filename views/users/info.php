<section class="user-info">
    <div class="container-w">
        <div class="row">
            <div class="col">
                <div class="user-info__header">
                    <h1>USER INFORMATION</h1>
                    <?php
                    if (isset($notify)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible"
                             style="text-align: center; max-width: 500px; margin: 30px auto">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?= $notify ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <div class="user-info__content">
                    <div class="user-info__content--img">
                        <img src="<?= $avatar ?>" alt="" width="130px">
                    </div>
                    <div class="user-info__content--txt">
                        <p><span>Full Name:</span> <?= $full_name ?></p>
                        <p><span>Email:</span> <?= $email ?></p>
                        <p><span>Username:</span> <?= $username ?></p>
                        <p><span>Birthday:</span> <?= $birth_day ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
