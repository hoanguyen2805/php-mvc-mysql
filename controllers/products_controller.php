<?php
session_start();
require_once('controllers/base_controller.php');

class ProductsController extends BaseController
{
    function __construct()
    {
        $this->folder = 'products';
        $this->productModel = $this->model('product');
    }

    /**
     *
     * Hoa
     * Created at 26-04-2021 08h:30
     * go to page home
     *
     */
    public function index()
    {
        $this->render('index');
    }


    /**
     *
     * Hoa
     * Created at 26-04-2021 08h30
     * go to page manage product
     *
     */
    public function manageProduct()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                $page = 1;
                if (!empty($_GET['page'])) {
                    $page = $_GET['page'];
                }
                $products = $this->productModel->paginate($page);
                $size = 0;
                if ($this->productModel->getProducts() != null) {
                    $size = count($this->productModel->getProducts());
                }
                $categories = $this->productModel->getCategories();
                $totalPages = ceil($size / 5);
                // thong bao cho update
                $notify = "";
                if (isset($_SESSION["updateProductNotify"])) {
                    $notify = $_SESSION["updateProductNotify"];
                    unset($_SESSION["updateProductNotify"]);
                }
                $data = array(
                    'products' => $products,
                    'totalPages' => $totalPages,
                    'categories' => $categories,
                );
                if (trim($notify) != "") {
                    $data['notify'] = $notify;
                }
                $this->render('manage-product', $data);
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users&action=info';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }

    }

    /**
     *
     * Hoa
     * Created at 26-04-2021 08h40
     * go to page add product
     *
     */
    public function add()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                $categories = $this->productModel->getCategories();
                $data = array(
                    'categories' => $categories
                );
                if (isset($_GET['notify'])) {
                    $data['notify'] = $_GET['notify'];
                }
                $this->render('add', $data);
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users&action=info';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }
    }

    /**
     *
     * Hoa
     * Created at 26-04-2021 09h00
     * handling form add product
     *
     */
    public function addProductForm()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                if (isset($_POST['addProduct'])) {
                    $name = trim($_POST['name']);
                    $price = trim($_POST['price']);
                    $category = trim($_POST['category']);
                    $notify = "";
                    if ($this->productModel->validateProduct($name, $price, $category)) {
                        $this->productModel->saveProduct($name, $price, $category);
                    }
                    if (isset($_SESSION["addProductNotify"])) {
                        $notify = $_SESSION["addProductNotify"];
                        unset($_SESSION["addProductNotify"]);
                    }
                    header("location: index.php?controller=products&action=add&notify=$notify");
                } else {
                    header("location: index.php?controller=products&action=add");
                }
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users&action=info';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }
    }

    /**
     *
     * Hoa
     * Created at 27-04-2021 08h20
     * just admin can delete product
     *
     */
    public function delete()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                if (isset($_GET['name'])) {
                    $name = trim($_GET['name']);
                    $this->productModel->deleteProductByName($name);
                }
                header("location:index.php?controller=products&action=manage-product");
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users&action=info';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }
    }


    /**
     *
     * Hoa
     * Created at 27-04-2021 14h40
     * handling form update product
     *
     */
    public function updateProductForm()
    {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION["role"];
            if ($role == 1) {
                if (isset($_POST['updateProduct']) && isset($_GET['old'])) {
                    $name = trim($_POST['name']);
                    $price = trim($_POST['price']);
                    $category = trim($_POST['category']);
                    $oldNameProduct = trim($_GET['old']);
                    $notify = "";
                    if ($this->productModel->validateUpdateProduct($name, $price, $category)) {
                        $product = $this->productModel->updateProduct($name, $price, $category, $oldNameProduct);
                        if ($product) {
                            //echo "<script>
                            //             alert('Update successful!');
                            //      </script>";
                        }
                    }
                }
                header("location: index.php?controller=products&action=manage-product");
            } else {
                echo "<script>
                            alert('You are not permitted to use this feature!');
                            window.location.href='index.php?controller=users&action=info';
                      </script>";
            }
        } else {
            header("location:index.php?controller=users&action=sign-in");
        }

    }
}