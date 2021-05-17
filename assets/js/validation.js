/**
 *
 * Hoa
 * Created at 21-04-2021 08h:40
 * Validate for Form Sign Up
 *
 */
function validateFormSignUp() {
    let fullName = document.forms["my_form"]["full_name"].value;
    let email = document.forms["my_form"]["email"].value;
    let username = document.forms["my_form"]["username"].value;
    let password = document.forms["my_form"]["password"].value;
    let confirmPassword = document.forms["my_form"]["confirm_password"].value;
    let birth = document.forms["my_form"]["birth_day"].value;
    let avatar = document.forms["my_form"]["avatar"].value;
    let regex = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
    let check = true;
    if (fullName == "" || fullName == null) {
        document.getElementById("err-name").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-name").style.display = "none";
    }
    if (email == "" || email == null) {
        document.getElementById("err-email").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-email").style.display = "none";
    }
    if (username == "" || username == null) {
        document.getElementById("err-username").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-username").style.display = "none";
    }
    if (password == "" || password == null) {
        document.getElementById("err-password").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-password").style.display = "none";
    }
    if (birth == "" || birth == null) {
        document.getElementById("err-birth-day").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-birth-day").style.display = "none";
    }
    if (avatar == "" || avatar == null) {
        document.getElementById("err-avatar").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-avatar").style.display = "none";
    }
    if (password != confirmPassword) {
        document.getElementById("err-password-confirm").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-password-confirm").style.display = "none";
    }
    if (check == false) {
        return check;
    }

    if (check) {
        if (!regex.test(username)) {
            alert("Please do not enter following special characters in the Username field");
            check = false;
            return check;
        }
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
        document.getElementById("err-username").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-username").style.display = "none";
    }
    if (password == "" || username == null) {
        document.getElementById("err-password").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-password").style.display = "none";
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
    let email = document.forms["forgot-form"]["email"].value;
    let check = true;
    if (email == "" || email == null) {
        document.getElementById("err-email-forgot").style.display = "block";
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
    let check = true;
    if (password !== confirmPassword) {
        document.getElementById("err-password-reset-confirm").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-password-reset-confirm").style.display = "none";
    }
    if (password == "" || password == null) {
        document.getElementById("err-password-reset").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-password-reset").style.display = "none";
    }
    if (check == false) {
        return check;
    }
}

/**
 *
 * Hoa
 * Created at 27-04-2021 08h:50
 * click open menu on mobi
 *
 */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
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
    let name = document.forms["form_add_product"]["name"].value;
    let price = document.forms["form_add_product"]["price"].value;
    let category = document.forms["form_add_product"]["category"].value;
    let img = document.forms["form_add_product"]["image"].value;
    // let regex = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
    let check = true;
    if (name == "" || name == null) {
        document.getElementById("err-name-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-name-product").style.display = "none";
    }
    if (price == "" || price == null || isNaN(price)) {
        document.getElementById("err-price-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-price-product").style.display = "none";
    }
    if (category == "" || category == null) {
        document.getElementById("err-select-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-select-product").style.display = "none";
    }

    if (img == "" || img == null) {
        document.getElementById("err-image-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-image-product").style.display = "none";
    }

    if (check == false) {
        return check;
    }
    // if (check) {
    //     if (!regex.test(name)) {
    //         alert("Please do not enter following special characters in the name field");
    //         check = false;
    //         return check;
    //     }
    // }
}


/**
 *
 * Hoa
 * Created at 27-04-2021 15h00
 * validate for form update product
 *
 */
function validateFormUpdateProduct() {
    let name = document.forms["form_update_product"]["name"].value;
    let price = document.forms["form_update_product"]["price"].value;
    let category = document.forms["form_update_product"]["category"].value;
    // let regex = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
    let check = true;
    if (name == "" || name == null) {
        document.getElementById("err-name-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-name-product").style.display = "none";
    }
    if (price == "" || price == null || isNaN(price)) {
        document.getElementById("err-price-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-price-product").style.display = "none";
    }
    if (category == "" || category == null) {
        document.getElementById("err-select-product").style.display = "block";
        check = false;
    } else {
        document.getElementById("err-select-product").style.display = "none";
    }

    if (check == false) {
        return check;
    }
    // if (check) {
    //     if (!regex.test(name)) {
    //         alert("Please do not enter following special characters in the name field");
    //         check = false;
    //         return check;
    //     }
    // }
}