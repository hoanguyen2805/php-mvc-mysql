<?php
/**
 *
 * Các controllers trong hệ thống [users và products] và các action có thể gọi ra từ controller đó.
 *
 */
$controllers = array(
    'users' => [
        'info',
        'error',
        'sign-in',
        'sign-in-form',
        'sign-up',
        'sign-up-form',
        'forgot-password',
        'forgot-password-form',
        'reset-password',
        'reset-password-form',
        'sign-out',
        'list-users',
        'delete-user',
        'form-search',
    ],
    'products' => ['index', 'manage-product', 'add', 'add-product-form', 'update-product-form', 'delete'],
);

/**
 *
 * Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
 * thì trang báo lỗi sẽ được gọi ra
 * vế đầu là kiểm tra key controller có trong mảng controllers không, không có trả về false, !false = true
 * vế sau là kiêm tra giá trị action có tồn tại trong mảng controllers[controller] không,
 * không có trả về false, !false = true
 *
 */
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'users';
    $action = 'error';
}

/**
 *
 * Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
 *
 */
include_once('controllers/' . $controller . '_controller.php');

/**
 *
 * Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
 * ucwords($controller, '_') VD: users -> Users_
 * str_replace('_', '', x) thay thế '_' bằng '' VD: Users_ -> Users
 * Users.Controller -> UsersController
 *
 */

$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;

$url = explode("-", $action);
for ($i = 0; $i < count($url); $i++) {
    if ($i != 0) {
        $url[$i] = ucfirst($url[$i]);
    }
}
$newAction = implode("", $url);

$controller->$newAction();