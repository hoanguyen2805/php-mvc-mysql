<?php
session_start();
require_once('controllers/base_controller.php');

class UsersController extends BaseController
{

    function __construct()
    {
        $this->folder = 'users';
        $this->userModel = $this->model('user');
    }

    /**
     *
     * Hoa
     * Created at 21-04-2021 21h00
     * go to page index
     * xong
     *
     */
    public function info()
    {
        if (isset($_SESSION["user"])) {
            $username = $_SESSION["user"];
            $user = $this->userModel->getUserByUsername($username);
            if ($user == null) {
                header("location:index.php?controller=users&action=sign-in");
            } else {
                $data = array(
                    'fullName' => $user->fullName,
                    'email' => $user->email,
                    'username' => $user->username,
                    'password' => $user->password,
                    'birthDay' => $user->birthDay,
                    'urlAvatar' => $user->avatar,
                    'role' => $user->isAdmin
                );
                $this->render('info', $data);
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }
    }

    /**
     *
     * Hoa
     * Created at 21-04-2021 21h50
     * go to page error when user entered wrong path
     * XONG
     *
     */
    public function error()
    {
        $this->render('error');
    }

    /**
     *
     * Hoa
     * Created at 22-04-2021 08h00
     * go to page sign up
     * XONG
     *
     */
    public function signUp()
    {
        if (isset($_SESSION["user"])) {
            header("location:index.php?controller=users&action=info");
        } else {
            if (isset($_GET['notify'])) {
                $data = array(
                    'notify' => $_GET['notify'],
                );
                $this->render('sign-up', $data);
            }
            $this->render('sign-up');
        }
    }

    /**
     *
     * Hoa
     * Created at 22-04-2021 08h20
     * handling form sign up
     * XONG
     *
     */
    public function signUpForm()
    {
        if (isset($_POST['signUp'])) {
            $fullName = trim($_POST['fullName']);
            $email = trim($_POST['email']);
            $username = trim($_POST['username']);
            $password = trim(md5($_POST['password']));
            $birthDay = trim($_POST['birth']);
            $notify = "";
            if ($this->userModel->validateSignUp($fullName, $email, $username, $password, $birthDay)) {
                $this->userModel->signUp($fullName, $email, $username, $password, $birthDay);
            }
            if (isset($_SESSION["signUpNotify"])) {
                $notify = $_SESSION["signUpNotify"];
                unset($_SESSION["signUpNotify"]);
            }
            header("location:index.php?controller=users&action=sign-up&notify=$notify");
        } else {
            header("location:index.php?controller=user&action=sign-up");
        }
    }


    /**
     *
     * Hoa
     * Created at 22-04-2021 10h00
     * go to page sign in
     * XONG
     *
     */
    public function signIn()
    {
        if (isset($_SESSION["user"])) {
            header("location:index.php?controller=users&action=info");
        } else {
            if (isset($_GET['notify'])) {
                $data = array(
                    'notify' => $_GET['notify'],
                );
                $this->render('sign-in', $data);
            }
            $this->render('sign-in');
        }

    }

    /**
     *
     * Hoa
     * Created at 22-04-2021 10h20
     * handling form sign in
     * XONG
     *
     */
    public function signInForm()
    {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $user = $this->userModel->signIn($username, $password);
            if ($user) {
                header("location:index.php?controller=users&action=info");
            } else {
                $notify = "";
                if (isset($_SESSION["signInNotify"])) {
                    $notify = $_SESSION["signInNotify"];
                    unset($_SESSION["signInNotify"]);
                }
                header("location:index.php?controller=users&action=sign-in&notify=$notify");
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }
    }

    /**
     *
     * Hoa
     * Created at 22-04-2021 11h50
     * sign out then go to page sign in
     * XONG
     *
     */
    public function signOut()
    {
        session_destroy();
        header("location:index.php?controller=users&action=sign-in");
    }

    /**
     *
     * Hoa
     * Created at 22-04-2021 13h40
     * go to page forgot password
     * XONG
     *
     */
    public function forgotPassword()
    {
        if (isset($_SESSION["user"])) {
            header("location:index.php?controller=users&action=info");
        } else {
            if (isset($_GET['notify'])) {
                $data = array(
                    'notify' => $_GET['notify'],
                );
                $this->render('forgot-password', $data);
            }
            $this->render('forgot-password');
        }
    }

    /**
     *
     * Hoa
     * Created at 22-04-2021 14h00
     * handling form forgot password - send email
     * XONG
     */
    public function forgotPasswordForm()
    {
        if (isset($_POST['recoverPassword'])) {
            $email = $_POST["email"];
            $this->userModel->forgotPassword($email);
            $notify = "";
            if (isset($_SESSION['forgotPasswordNotify'])) {
                $notify = $_SESSION['forgotPasswordNotify'];
                unset($_SESSION['forgotPasswordNotify']);
            }
            header("location:index.php?controller=users&action=forgot-password&notify=$notify");
        } else {
            header("location:index.php?controller=users&action=forgot-password");
        }
    }


    /**
     *
     * Hoa
     * Created at 23-04-2021 08h20
     * go to page reset password
     * XONG
     *
     */
    public function resetPassword()
    {
        if (isset($_SESSION["user"])) {
            echo "<script>
                          alert('Please Log out before using this feature!');
                          window.location.href='index.php?controller=users';
                  </script>";
        } else {
            if (isset($_GET['notify'])) {
                $data = array(
                    'notify' => $_GET['notify'],
                );
                $this->render('reset-password', $data);
            }
            $this->render('reset-password');
        }
    }

    /**
     *
     * Hoa
     * Created at 23-04-2021 08h50
     * handling form reset password
     * XONG
     *
     */
    public function resetPasswordForm()
    {
        if (empty($_GET['key']) || empty($_GET['token'])) {
            $notify = "Token or email do not exist!";
            header("location:index.php?controller=users&action=reset-password&notify=$notify");
        } else {
            $email = trim($_GET['key']);
            $token = trim($_GET['token']);
            if (isset($_POST['reset'])) {
                $newPassword = md5($_POST['password']);
                $newPassword = $this->userModel->resetPassword($email, $token, $newPassword);
                $notify = "";
                if (isset($_SESSION['resetPasswordNotify'])) {
                    $notify = $_SESSION['resetPasswordNotify'];
                    unset($_SESSION['resetPasswordNotify']);
                }
                if ($newPassword) {
                    echo "<script>
                            alert('Success! Please Log in');
                            window.location.href='index.php?controller=users&action=sign-in';
                          </script>";
                } else {
                    header("location:index.php?controller=users&action=reset-password&key=$email&token=$token&notify=$notify");
                }
            } else {
                header("location:index.php?controller=users&action=reset-password&key=$email&token=$token");
            }
        }

    }


    /**
     *
     * Hoa
     * Created at 24-04-2021 09h00
     * just admin can go to listUsers page
     * XONG
     *
     */
    public function listUsers()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                $page = 1;
                $key = "";
                if (!empty($_GET['page'])) {
                    $page = trim($_GET['page']);
                }
                if (!empty($_GET['key'])) {
                    $key = trim($_GET['key']);
                }
                $users = $this->userModel->paginate($page, trim($key));
                $size = $this->userModel->countRecord($key);
                $totalPages = ceil($size / 5);
                $data = array('users' => $users, 'totalPages' => $totalPages);
                $this->render("list", $data);
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }

    }

    /**
     *
     * Hoa
     * Created at 24-04-2021 09h50
     * just admin can delete user
     *
     */
    public function deleteUser()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $this->userModel->deleteUserById($id);
                }
                header("location:index.php?controller=users&action=list-users");
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }
    }

    /**
     *
     * Hoa
     * Created at 24-04-2021 13h40
     * handling form search username | email
     * XONG
     *
     */
    public function formSearch()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                if (isset($_POST['search'])) {
                    if ($_POST['key'] == "") {
                        header("location:index.php?controller=users&action=list-users");
                    } else {
                        header("location:index.php?controller=users&action=list-users&page=1&key=" . $_POST['key']);
                    }
                }
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }

    }
}