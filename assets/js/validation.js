/**
 *
 * Hoa
 * Created at 21-04-2021 08h:40
 * Validate for Form Sign Up
 *
 */
function validateFormSignUp() {
    let fullName = document.forms["my_form"]["full_name"].value.trim();
    let email = document.forms["my_form"]["email"].value.trim();
    let username = document.forms["my_form"]["username"].value.trim();
    let password = document.forms["my_form"]["password"].value.trim();
    let confirmPassword = document.forms["my_form"]["confirm_password"].value.trim();
    let birth = document.forms["my_form"]["birth_day"].value.trim();
    let avatar = document.forms["my_form"]["avatar"].value.trim();
    let regex = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
    let check = true;

    let errName = document.getElementById("err-sign-up-name");
    let errEmail = document.getElementById("err-sign-up-email");
    let errUsername = document.getElementById("err-sign-up-username");
    let errBirthday = document.getElementById("err-sign-up-birth-day");
    let errAvatar = document.getElementById("err-sign-up-avatar");
    let errPassword = document.getElementById("err-sign-up-password");
    let errConfirmPassword = document.getElementById("err-sign-up-password-confirm");
    // Full name
    if (fullName == "" || fullName == null) {
        errName.style.display = "block";
        errName.innerText = "Full Name is required!";
        document.forms["my_form"]["full_name"].style.border = "1px solid red";
        check = false;
    } else if (fullName.length < 4 || fullName.length > 255) {
        errName.style.display = "block";
        errName.innerText = "Please input the full name between 4 and 255 characters!";
        document.forms["my_form"]["full_name"].style.border = "1px solid red";
        check = false;
    } else {
        errName.style.display = "none";
        document.forms["my_form"]["full_name"].style.border = "0";
    }

    // Email
    if (email == "" || email == null) {
        errEmail.style.display = "block";
        errEmail.innerText = "Email is required!";
        document.forms["my_form"]["email"].style.border = "1px solid red";
        check = false;
    } else if (email.length < 5 || email.length > 32) {
        errEmail.style.display = "block";
        errEmail.innerText = "Please input the email between 5 and 32 characters!";
        document.forms["my_form"]["email"].style.border = "1px solid red";
        check = false;
    } else {
        errEmail.style.display = "none";
        document.forms["my_form"]["email"].style.border = "0";
    }

    // Username
    if (username == "" || username == null) {
        errUsername.style.display = "block";
        errUsername.innerText = "Username is required!";
        document.forms["my_form"]["username"].style.border = "1px solid red";
        check = false;
    } else if (!regex.test(username) && username != "") {
        errUsername.style.display = "block";
        errUsername.innerText = "Please do not enter following special characters in the username field";
        document.forms["my_form"]["username"].style.border = "1px solid red";
        check = false;
    } else if (username.length < 4 || username.length > 255) {
        errUsername.style.display = "block";
        errUsername.innerText = "Please input the username between 4 and 255 characters!";
        document.forms["my_form"]["username"].style.border = "1px solid red";
        check = false;
    } else {
        errUsername.style.display = "none";
        document.forms["my_form"]["username"].style.border = "0";
    }

    // Password
    if (password == "" || password == null) {
        errPassword.style.display = "block";
        errPassword.innerText = "Password is required!";
        document.forms["my_form"]["password"].style.border = "1px solid red";
        check = false;
    } else if (password.length < 4 || password.length > 20) {
        errPassword.style.display = "block";
        errPassword.innerText = "Please input the password between 4 and 20 characters!";
        document.forms["my_form"]["password"].style.border = "1px solid red";
        check = false;
    } else {
        errPassword.style.display = "none";
        document.forms["my_form"]["password"].style.border = "0";
    }

    if (confirmPassword == "" && confirmPassword == password) {
        errConfirmPassword.style.display = "block";
        errConfirmPassword.innerText = "Confirm password is required!";
        document.forms["my_form"]["confirm_password"].style.border = "1px solid red";
        check = false;
    } else if (password != confirmPassword) {
        errConfirmPassword.style.display = "block";
        errConfirmPassword.innerText = "password and confirm password must be match!";
        document.forms["my_form"]["confirm_password"].style.border = "1px solid red";
        check = false;
    } else {
        errConfirmPassword.style.display = "none";
        document.forms["my_form"]["confirm_password"].style.border = "0";
    }

    // Birthday
    if (birth == "" || birth == null) {
        errBirthday.style.display = "block";
        document.forms["my_form"]["birth_day"].style.border = "1px solid red";
        check = false;
    } else {
        errBirthday.style.display = "none";
        document.forms["my_form"]["birth_day"].style.border = "0";
    }

    // Avatar
    if (avatar == "" || avatar == null) {
        errAvatar.style.display = "block";
        document.forms["my_form"]["avatar"].style.border = "1px solid red";
        check = false;
    } else {
        errAvatar.style.display = "none";
        document.forms["my_form"]["avatar"].style.border = "0";
    }

    if (check == false) {
        return check;
    }
}

/**
 *
 * Hoa
 * Created at 21-04-2021 17h:05
 * Validate for Form Sign in
 *
 */
function validateFormLogin() {
    let username = document.forms["login_form"]["username"].value;
    let password = document.forms["login_form"]["password"].value;
    let check = true;
    if (username.trim() == "" || username == null) {
        document.getElementById("err-login-username").style.display = "block";
        document.forms["login_form"]["username"].style.borderColor = "red";
        check = false;
    } else {
        document.getElementById("err-login-username").style.display = "none";
        document.forms["login_form"]["username"].style.borderColor = "#eee";
    }
    if (password == "" || username == null) {
        document.getElementById("err-login-password").style.display = "block";
        document.forms["login_form"]["password"].style.borderColor = "red";
        check = false;
    } else {
        document.getElementById("err-login-password").style.display = "none";
        document.forms["login_form"]["password"].style.borderColor = "#eee";
    }
    if (check == false) {
        return false;
    }
}


/**
 *
 * Hoa
 * Created at 22-04-2021 14h:10
 * Validate for Form Forgot Password - send email
 *
 */
function validateFormForgotPassword() {
    let email = document.forms["forgot_form"]["email"].value;
    let check = true;
    if (email == "" || email == null) {
        document.getElementById("err-email-forgot").style.display = "block";
        document.forms["forgot_form"]["email"].style.borderColor = "red";
        check = false;
    } else {
        document.getElementById("err-email-forgot").style.display = "none";
    }
    if (check == false) {
        return check;
    }
}

/**
 *
 * Hoa
 * Created at 23-04-2021 10h:05
 * Validate for Form Reset Password
 *
 */
function validateFormResetPassword() {
    let password = document.forms["reset_form"]["password"].value;
    let confirmPassword = document.forms["reset_form"]["password_confirm"].value;
    let errPasswordReset = document.getElementById("err-password-reset");
    let errConfirmPasswordReset = document.getElementById("err-password-reset-confirm");
    let check = true;
    if (password == "" || password == null) {
        errPasswordReset.style.display = "block";
        errPasswordReset.innerText = "Password is required";
        document.forms["reset_form"]["password"].style.borderColor = "red";
        check = false;
    } else if (password.length < 4 || password.length > 20) {
        errPasswordReset.style.display = "block";
        errPasswordReset.innerText = "Please input the password between 4 and 20 characters!";
        document.forms["reset_form"]["password"].style.borderColor = "red";
        check = false;
    } else {
        errPasswordReset.style.display = "none";
        document.forms["reset_form"]["password"].style.borderColor = "#eee";
    }

    if (confirmPassword == "" && confirmPassword == password) {
        errConfirmPasswordReset.style.display = "block";
        errConfirmPasswordReset.innerText = "Confirm password is required!";
        document.forms["reset_form"]["password_confirm"].style.borderColor = "red";
        check = false;
    } else if (password != confirmPassword) {
        errConfirmPasswordReset.style.display = "block";
        errConfirmPasswordReset.innerText = "password and confirm password must be match!";
        document.forms["reset_form"]["password_confirm"].style.borderColor = "red";
        check = false;
    } else {
        errConfirmPasswordReset.style.display = "none";
        document.forms["reset_form"]["password_confirm"].style.borderColor = "#eee";
    }

    if (check == false) {
        return check;
    }
}


/**
 *
 * Hoa
 * Created at 26-04-2021 10h00
 * validate for form add product
 *
 */
function validateFormAddProduct() {
    let name = document.forms["form_add_product"]["name"].value.trim();
    let price = document.forms["form_add_product"]["price"].value.trim();
    let img = document.forms["form_add_product"]["image"].value;

    let errName = document.getElementById("err-name-add-product");
    let errPrice = document.getElementById("err-price-add-product");
    let errImg = document.getElementById("err-image-add-product");

    let check = true;

    if (name == "" || name == null) {
        errName.style.display = "block";
        errName.innerText = "Name is required!";
        document.forms["form_add_product"]["name"].style.border = "1px solid red";
        check = false;
    } else if (name.length < 4 || name.length > 255) {
        errName.style.display = "block";
        errName.innerText = "Please input the Name between 4 and 255 characters!";
        document.forms["form_add_product"]["name"].style.border = "1px solid red";
        check = false;
    } else {
        errName.style.display = "none";
        document.forms["form_add_product"]["name"].style.border = "0";
    }

    if (isNaN(price) || price == "") {
        errPrice.style.display = "block";
        errPrice.innerText = "Price not valid!";
        document.forms["form_add_product"]["price"].style.border = "1px solid red";
        check = false;
    } else if (price > 2147483647 || price < 0) {
        errPrice.style.display = "block";
        errPrice.innerText = "Please input the Price between >= 0 and <= 2147483647";
        document.forms["form_add_product"]["price"].style.border = "1px solid red";
        check = false;
    } else {
        errPrice.style.display = "none";
        document.forms["form_add_product"]["price"].style.border = "0";
    }

    if (img == "" || img == null) {
        errImg.style.display = "block";
        document.forms["form_add_product"]["image"].style.border = "1px solid red";
        check = false;
    } else {
        errImg.style.display = "none";
        document.forms["form_add_product"]["image"].style.border = "0";
    }

    if (check == false) {
        return check;
    }
}


/**
 *
 * Hoa
 * Created at 27-04-2021 15h00
 * validate for form update product
 *
 */
function validateFormUpdateProduct() {
    let name = document.forms["form_update_product"]["name"].value.trim();
    let price = document.forms["form_update_product"]["price"].value.trim();

    let errName = document.getElementById("err-name-update-product");
    let errPrice = document.getElementById("err-price-update-product");

    let check = true;

    if (name == "" || name == null) {
        errName.style.display = "block";
        errName.innerText = "Name is required!";
        document.forms["form_update_product"]["name"].style.border = "1px solid red";
        check = false;
    } else if (name.length < 4 || name.length > 255) {
        errName.style.display = "block";
        errName.innerText = "Please input the Name between 4 and 255 characters!";
        document.forms["form_update_product"]["name"].style.border = "1px solid red";
        check = false;
    } else {
        errName.style.display = "none";
        document.forms["form_update_product"]["name"].style.border = "0";
    }

    if (isNaN(price) || price == "") {
        errPrice.style.display = "block";
        errPrice.innerText = "Price not valid!";
        document.forms["form_update_product"]["price"].style.border = "1px solid red";
        check = false;
    } else if (price > 2147483647 || price < 0) {
        errPrice.style.display = "block";
        errPrice.innerText = "Please input the Price between >= 0 and <= 2147483647";
        document.forms["form_update_product"]["price"].style.border = "1px solid red";
        check = false;
    } else {
        errPrice.style.display = "none";
        document.forms["form_update_product"]["price"].style.border = "0";
    }

    console.log("chay vao day" + check);
    if (check == false) {
        return check;
    }
}