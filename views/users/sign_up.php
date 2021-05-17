<div class="signup">
    <h1 class="signup-heading">Sign up</h1>
    <?php
    if (isset($notify)) {
        echo "<h3 class='sign-up-error'>" . $notify . "</h3>";
    }
    ?>
    <form action="index.php?controller=users&action=sign-up-form" class="signup-form" autocomplete="off" method="post"
          enctype="multipart/form-data" name="my_form"
          onsubmit="return validateFormSignUp()">

        <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-input" id="name" placeholder="Eg: John Doe" name="full_name">
            <p class="error" id="err-name">Full Name is required!</p>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-input" id="email" placeholder="Eg: johndoe@email.com" name="email">
            <p class="error" id="err-email">Email is required!</p>
        </div>

        <div class="form-group">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-input" id="username" placeholder="Eg: john" name="username">
            <p class="error" id="err-username">Username is required!</p>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-input" id="password" placeholder="******" name="password">
            <p class="error" id="err-password">Password is required!</p>
        </div>

        <div class="form-group">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-input" id="confirm-password" placeholder="******" name="confirm_password">
            <p class="error" id="err-password-confirm">password and confirm password must be match!</p>
        </div>

        <div class="form-group">
            <label for="birth" class="form-label">Birthday</label>
            <input type="date" class="form-input" id="birth-day" name="birth_day">
            <p class="error" id="err-birth-day">Birthday is required!</p>
        </div>

        <div class="form-group">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-input" id="avatar" name="avatar">
            <p class="error" id="err-avatar">Avatar is required!</p>
        </div>
        <button type="submit" class="form-submit" name="sign_up">Sign up</button>
    </form>
    <p class="signup-already">Already have an account ? <a href="index.php?controller=users&action=sign-in"
                                                           class="signup-already-link">Login</a></p>
</div>