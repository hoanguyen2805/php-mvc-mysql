<section class="user-info">
    <div class="container-w">
        <div class="row">
            <div class="col">
                <div class="user-info__header">
                    <h1>User Information</h1>
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
