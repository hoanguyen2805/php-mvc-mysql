<?php
session_start();
require_once('controllers/base_controller.php');

class ProductsController extends BaseController
{
    /**
     * @var ProductModel
     */
    protected $productModel;

    /**
     * ProductsController constructor
     */
    function __construct()
    {
        $this->folder = 'products';
        $this->productModel = $this->model('product');
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
            if (in_array($method,
                    ['manageProduct', 'add', 'addProductForm', 'delete', 'updateProductForm']) && !$this->isLogin()) {
                header("location:index.php?controller=users&action=sign-in");
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
     * Created at 07-05-2021 08h:30
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
     * Created at 07-05-2021 08h40
     * go to page manage product
     *
     */
    protected function manageProduct()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            $page = 1;
            if (!empty($_GET['page'])) {
                $page = $_GET['page'];
            }
            $products = $this->productModel->paginate($page);
            $categories = $this->productModel->getCategories();
            $totalPages = $this->productModel->getTotalPages();
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
            $this->render('manage_product', $data);
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 10h10
     * go to page add product
     *
     */
    protected function add()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            $categories = $this->productModel->getCategories();
            $data = array(
                'categories' => $categories
            );
            if (isset($_GET['notify'])) {
                $data['notify'] = $_GET['notify'];
            }
            $this->render('add', $data);
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 10h20
     * handling form add product
     *
     */
    protected function addProductForm()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            if (isset($_POST['add_product'])) {
                $name = trim($_POST['name']);
                $price = trim($_POST['price']);
                $category = trim($_POST['category']);
                $notify = "";
                if ($this->productModel->validateAddProduct($name, $price, $category)) {
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
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 13h40
     * just admin can delete product
     *
     */
    protected function delete()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            if (isset($_GET['id'])) {
                $id = trim($_GET['id']);
                $this->productModel->deleteProductById($id);
            }
            header("location:index.php?controller=products&action=manage-product");
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }
    }


    /**
     *
     * Hoa
     * Created at 07-05-2021 14h20
     * handling form update product
     *
     */
    protected function updateProductForm()
    {
        $role = $_SESSION["role"];
        if ($role == ADMIN) {
            if (isset($_POST['update_product']) && isset($_GET['old'])) {
                $name = trim($_POST['name']);
                $price = trim($_POST['price']);
                $category = trim($_POST['category']);
                $oldNameProduct = trim($_GET['old']);
                if ($this->productModel->validateUpdateProduct($name, $price, $category)) {
                    $product = $this->productModel->updateProduct($name, $price, $category, $oldNameProduct);
                }
            }
            header("location: index.php?controller=products&action=manage-product");
        } else {
            $notify = "You are not permitted to use this feature!";
            header("location:index.php?controller=users&action=info&notify=$notify");
        }

    }
}