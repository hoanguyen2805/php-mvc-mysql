<h3 style='text-align: center;'>Reset Password</h3>
<?php
if (isset($notify)) {
    echo "<p style='color:red; text-align: center'>" . $notify . "</p>";
}
$key = "";
$token = "";
if (isset($_GET['key'])) {
    $key = $_GET['key'];
}
if (isset($_GET['token'])) {
    $token = $_GET['token'];
}
?>
<form class="login-form" autocomplete="off"
      action="index.php?controller=users&action=reset-password-form&key=<?= $key ?>&token=<?= $token ?>"
      method="post"
      name="reset_form"
      onsubmit="return validateFormResetPassword()">

    <input type="password" name="password" placeholder="New Password"/>
    <p class="error" id="err-password-reset">password is required!</p>
    <input type="password" name="password_confirm" placeholder="Confirm Password"/>
    <p class="error" id="err-password-reset-confirm">password and confirm password must be match!</p>
    <button type="submit" name="reset">Reset Password</button>
</form>