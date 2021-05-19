<?php
session_start();
require_once('controllers/base_controller.php');

class UsersController extends BaseController
{

    /**
     * @var UserModel
     */
    protected $userModel;

    /**
     * UsersController constructor
     */
    function __construct()
    {
        $this->folder = 'users';
        $this->userModel = $this->model('user');
    }

    /**
     *
     * Hoa
     * Created at 19-05-2021 10h10
     * filter method
     *
     */
    public function __call($method, $arguments)
    {
        // TODO: Implement __call() method.
        if (method_exists($this, $method)) {
            // chưa login thì không được truy cập
            if (in_array($method, ['info', 'listUsers', 'formSearch', 'deleteUser']) && !$this->isLogin()) {
                header("location:index.php?controller=users&action=sign-in");
                return null;
            }
            // đã login thì không được truy cập
            if (in_array($method,
                    [
                        'signUp',
                        'signUpForm',
                        'signIn',
                        'signInForm',
                        'forgotPassword',
                        'forgotPasswordForm',
                        'resetPassword',
                        'resetPasswordForm'
                    ]) && $this->isLogin()) {
                header("location:index.php?controller=users&action=info");
                return null;
            }

            return call_user_func_array([$this, $method], $arguments);
        }
    }

    /**
     *
     * Hoa
     * Created at 19-05-2021 14h00
     * check login
     *
     */
    private function isLogin()
    {
        if (isset($_SESSION["user"])) {
            return true;
        }
        return false;
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 09h00
     * go to page user information
     *
     */
    protected function info()
    {
        $username = $_SESSION["user"];
        $user = $this->userModel->getUserByUsername($username);
        if ($user == null) {
            header("location:index.php?controller=users&action=sign-in");
        } else {

            $data = array(
                'full_name' => $user->full_name,
                'email' => $user->email,
                'username' => $user->username,
                'password' => $user->password,
                'birth_day' => $user->birth_day,
                'avatar' => $user->avatar,
                'is_admin' => $user->is_admin
            );
            if (isset($_GET['notify'])) {
                $data['notify'] = $_GET['notify'];
            }
            $this->render('info', $data);
        }
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 10h00
     * go to page error when user entered wrong path
     *
     */
    public function error()
    {
        $this->render('error');
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 10h10
     * go to page sign up
     *
     */
    protected function signUp()
    {
        if (isset($_GET['notify'])) {
            $data = array(
                'notify' => $_GET['notify'],
            );
            $this->render('sign_up', $data);
        }
        $this->render('sign_up');
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 10h20
     * handling form sign up
     *
     */
    protected function signUpForm()
    {
        if (isset($_POST['sign_up'])) {
            $fullName = trim($_POST['full_name']);
            $email = trim($_POST['email']);
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $birthDay = trim($_POST['birth_day']);
            $notify = "";
            if ($this->userModel->validateSignUp($fullName, $email, $username, $password, $birthDay)) {
                $this->userModel->signUp($fullName, $email, $username, md5($password), $birthDay);
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
     * Created at 05-05-2021 14h00
     * go to page sign in
     *
     */
    protected function signIn()
    {
        if (isset($_GET['notify'])) {
            $data = array(
                'notify' => $_GET['notify'],
            );
            $this->render('sign_in', $data);
        }
        $this->render('sign_in');
    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 14h20
     * handling form sign in
     *
     */
    protected function signInForm()
    {
        if (isset($_POST['login'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
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
     * Created at 05-05-2021 15h30
     * sign out then go to page sign in
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
     * Created at 05-05-2021 15h40
     * go to page forgot password
     *
     */
    protected function forgotPassword()
    {
        if (isset($_GET['notify'])) {
            $data = array(
                'notify' => $_GET['notify'],
            );
            $this->render('forgot_password', $data);
        } else {
            $this->render('forgot_password');
        }

    }

    /**
     *
     * Hoa
     * Created at 05-05-2021 16h00
     * handling form forgot password - send email
     *
     */
    protected function forgotPasswordForm()
    {
        if (isset($_POST['recover_password'])) {
            $email = trim($_POST["email"]);
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
     * Created at 06-05-2021 08h20
     * go to page reset password
     *
     */
    protected function resetPassword()
    {
        if (isset($_GET['notify'])) {
            $data = array(
                'notify' => $_GET['notify'],
            );
            $this->render('reset_password', $data);
        }
        $this->render('reset_password');
    }

    /**
     *
     * Hoa
     * Created at 06-05-2021 08h50
     * handling form reset password
     *
     */
    protected function resetPasswordForm()
    {
        if (empty($_GET['key']) || empty($_GET['token'])) {
            $notify = "Token or email do not exist!";
            header("location:index.php?controller=users&action=reset-password&notify=$notify");
        } else {
            $email = trim($_GET['key']);
            $token = trim($_GET['token']);
            if (isset($_POST['reset'])) {
                $newPassword = trim($_POST['password']);
                $result = $this->userModel->resetPassword($email, $token, $newPassword);
                $notify = "";
                if (isset($_SESSION['resetPasswordNotify'])) {
                    $notify = $_SESSION['resetPasswordNotify'];
                    unset($_SESSION['resetPasswordNotify']);
                }
                if ($result) {
                    $notify = "Reset password successful!";
                    header("location:index.php?controller=users&action=reset-password&notify=$notify");
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
     * Created at 06-05-2021 13h30
     * just admin can go to listUsers page
     *
     */
    protected function listUsers()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            $page = 1;
            $key = "";
            if (!empty($_GET['page'])) {
                $page = trim($_GET['page']);
            }
            if (!empty($_GET['key'])) {
                $key = trim($_GET['key']);
            }
            $users = $this->userModel->paginate($page, trim($key));
            $totalPages = $this->userModel->getTotalPages($key);
            $data = array('users' => $users, 'totalPages' => $totalPages);
            $this->render("manage_user", $data);
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }

    /**
     *
     * Hoa
     * Created at 06-05-2021 14h50
     * handling form search username | email
     *
     */
    protected function formSearch()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            if (isset($_POST['search'])) {
                if ($_POST['key'] == "") {
                    header("location:index.php?controller=users&action=list-users");
                } else {
                    header("location:index.php?controller=users&action=list-users&page=1&key=" . $_POST['key']);
                }
            }
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }

    /**
     *
     * Hoa
     * Created at 06-05-2021 15h00
     * just admin can delete user
     *
     */
    protected function deleteUser()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->userModel->deleteUserById($id);
            }
            header("location:index.php?controller=users&action=list-users");
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }
}
