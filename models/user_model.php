<?php
include('libs/SendMail.php');
require_once('models/file.php');

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 10h30
     * validate for form sign up
     *
     */
    public function validateSignUp($fullName, $email, $username, $password, $birthDay)
    {
        $check = true;
        $err = "";
        if ($fullName == "") {
            $err = $err . "Full Name is required. ";
            $check = false;
        }
        if ($username == "") {
            $err = $err . "Username is required. ";
            $check = false;
        }
        $regex = preg_match('/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/', $username);
        if (!$regex) {
            $err = $err . "The Username cannot contain special characters. ";
            $check = false;
        }
        if ($email == "") {
            $err = $err . "Email is required.\n ";
            $check = false;
        }
        if ($password == "") {
            $err = $err . "Password is required.\n ";
            $check = false;
        }
        if ($birthDay == "") {
            $err = $err . "BirthDay is required.\n ";
            $check = false;
        }
        if ($check == false) {
            $_SESSION["signUpNotify"] = $err;
            return false;
        }
        return true;
    }


    /**
     *
     * Hoa
     * Created at 05-05-2021 10h50
     * sign up
     *
     */
    public function signUp($fullName, $email, $username, $password, $birthDay)
    {
        if ($this->isUsernameExists($username)) {
            $_SESSION["signUpNotify"] = "Username is already taken!";
            return false;
        }
        if ($this->isEmailExists($email)) {
            $_SESSION["signUpNotify"] = "Email is already taken!";
            return false;
        }
        $urlAvatar = $this->uploadAvatar();
        if (!is_string($urlAvatar)) {
            return false;
        }
        $sql = "INSERT INTO user (full_name, email, username, password, birth_day, avatar, is_admin) VALUE (?,?,?,?,?,?,?)";
        $this->db->setQuery($sql);
        $this->db->execute(array($fullName, $email, $username, $password, $birthDay, $urlAvatar, false));
        $_SESSION["signUpNotify"] = "Registered successfully, please login!";
        return true;
    }

    /**
     *
     * Hoa
     * created at 05-05-2021 11h20
     * checking username exists
     *
     */
    public function isUsernameExists($username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $this->db->setQuery($sql);
        return $this->db->loadRow();
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 11h40
     * checking email exists
     *
     */
    public function isEmailExists($email)
    {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $this->db->setQuery($sql);
        return $this->db->loadRow();
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 13h:40
     * upload avatar to images folder
     *
     */
    public function uploadAvatar()
    {
        $target_dir = "assets/images/users/";
        //lấy đuôi file
        $temp = explode(".", $_FILES["avatar"]["name"]);
        //tạo tên file và đường dẫn
        $target_file = $target_dir . round(microtime(true)) . uniqid() . '.' . end($temp);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION["signUpNotify"] = "File is not an image!";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION["signUpNotify"] = "File already exists!";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["avatar"]["size"] > 500000) {
            $_SESSION["signUpNotify"] = "Sorry, your file is too large!";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $_SESSION["signUpNotify"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed!";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                echo "The File " . htmlspecialchars(basename($_FILES["avatar"]["name"])) . " has been uploaded.";
                return $target_file;
            } else {
                $_SESSION["signUpNotify"] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 14h40
     * sign in
     *
     */
    public function signIn($username, $password)
    {
        //validate form SignIn
        if (trim($username) == "") {
            $_SESSION["signInNotify"] = "The username field is required!";
            return false;
        }
        if (trim($password) == "") {
            $_SESSION["signInNotify"] = "The password field is required!";
            return false;
        }

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $this->db->setQuery($sql);
        $result = $this->db->loadRow();
        if ($result === false) {
            $_SESSION["signInNotify"] = "Username not found!";
            return false;
        }
        if ($result->password !== $password) {
            $_SESSION["signInNotify"] = "Password is incorrect!";
            return false;
        } else {
            $_SESSION["id"] = $result->user_id;
            $_SESSION["user"] = $username;
            $_SESSION["role"] = $result->is_admin;
            return true;
        }

    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 16h:20
     * check email for sending
     *
     */
    public function forgotPassword($email)
    {
        if (trim($email) == "") {
            $_SESSION['forgotPasswordNotify'] = "Please enter your email!";
            return false;
        } else {
            if ($this->isEmailExists($email)) {
                $this->sendEmail($email);
                return true;
            } else {
                $_SESSION['forgotPasswordNotify'] = "Email not found!";
                return false;
            }
        }
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 16h:40
     * send email by phpmailer and save [token - email] into database
     *
     */
    public function sendEmail($email)
    {
        $user = $this->getUserByEmail($email);
        $token = md5($email) . rand(10, 9999) . uniqid();
        /**
         * $expFormat = mktime(
         * date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")
         * );
         * $expDate = date("Y-m-d H:i:s", $expFormat);
         */
        $link = "<a href='http://localhost:8081/php-mvc-mysql/index.php?controller=users&action=reset-password&key="
            . $email . "&token=" . $token . "'>Click To Reset Your Password!</a>";
        $title = 'Reset Your Password!';     //chủ đề
        $content = "<h3> Dear " . $user->full_name . "</h3>";
        $content .= "<p>We have received a request to re-issue your password recently.</p>";
        $content .= "<p>Please click on the following link to reset your password.</p>";
        $content .= "<b>$link</b>";
        $send = new SendMail();
        $sendMai = $send->send($title, $content, $user->full_name, $email);
        if ($sendMai) {
            $sql = "INSERT INTO recovery_code (email, token) VALUE (?,?)";
            $this->db->setQuery($sql);
            $this->db->execute(array($email, $token));
            $_SESSION['forgotPasswordNotify'] = "Check your email to reset password!";
        } else {
            $_SESSION['forgotPasswordNotify'] = 'An error has occurred unable to retrieve the password!';
        }
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 19h50
     * get user by email
     *
     */
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $this->db->setQuery($sql);
        $result = $this->db->loadRow();
        if ($result === false) {
            return null;
        }
        return $result;
    }


    /**
     *
     * Hoa
     * Created at 05-05-2021 09h30
     * get user by username
     *
     */
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $this->db->setQuery($sql);
        $result = $this->db->loadRow();
        if ($result === false) {
            return null;
        }
        return $result;
    }


    /**
     *
     * Hoa
     * Created at 06-05-2021 09h:30
     * reset password
     *
     */
    public function resetPassword($email, $token, $password)
    {
        if ($this->isEmailAndTokenExist($email, $token)) {
            if ($this->isEmailExists($email)) {
                $user = $this->getUserByEmail($email);
                $user->password = $password;
                //update password
                $sql = "UPDATE user SET password = '$user->password' WHERE user_id = $user->id";
                $this->db->setQuery($sql);
                $this->db->execute();
                //delete token
                $sql_delete = "DELETE FROM recovery_code WHERE email = '$email'";
                $this->db->setQuery($sql_delete);
                $this->db->execute();
                return true;
            } else {
                $_SESSION['resetPasswordNotify'] = "User not found!";
                return false;
            }
        }
    }

    /**
     *
     * Hoa
     * Created at 06-05-2021 09h:50
     * checking Email and token exist on table recovery_code
     *
     */
    public function isEmailAndTokenExist($email, $token)
    {
        $sql = "SELECT * FROM recovery_code WHERE email = '$email' AND token = '$token'";
        $this->db->setQuery($sql);
        $result = $this->db->loadRow();
        if ($result === false) {
            $_SESSION['resetPasswordNotify'] = "Token or email is incorrect!";
            return false;
        }
        return true;
    }


    /**
     *
     * Hoa
     * Created at 06-05-2021 14h30
     * count record in user table
     *
     */
    public function countRecord($key)
    {
        $sql = "SELECT COUNT(*) FROM user WHERE username LIKE '%$key%' OR email LIKE '%$key%'";
        $this->db->setQuery($sql);
        return $this->db->loadRecord();
    }

    /**
     *
     * Hoa
     * Created at 06-05-2021 13h50
     * paginate with email | username
     *
     */
    public function paginate($page, $key)
    {
        if ((int)$page == 0) {
            $page = 1;
        }
        $index = ($page - 1) * 5;
        $sql = "SELECT * FROM user WHERE username LIKE '%$key%' OR email LIKE '%$key%' LIMIT $index, 5";
        $this->db->setQuery($sql);
        $users = $this->db->loadAllRows();
        if ($users == null) {
            return null;
        } else {
            return $users;
        }
    }

    /**
     *
     * Hoa
     * Created at 06-05-2021 15h20
     * delete user by id
     *
     */
    public function deleteUserById($id)
    {
        //delete img
        $sql_get_user = "SELECT * FROM user WHERE user_id = $id";
        $this->db->setQuery($sql_get_user);
        $user = $this->db->loadRow();
        File::deleteImage(trim($user->avatar));
        //delete user
        $sql = "DELETE FROM user WHERE user_id = $id";
        $this->db->setQuery($sql);
        $this->db->execute();
    }
}
