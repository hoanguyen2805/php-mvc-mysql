<?php
require_once('models/file.php');

class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 10h30
     * validate for form add product
     *
     */
    public function validateProduct($name, $price, $category)
    {
        $check = true;
        $err = "";
        if ($name == "") {
            $err = $err . "Name is required. ";
            $check = false;
        }
        if ($price == "" || !is_numeric($price)) {
            $err = $err . "Price is required. ";
            $check = false;
        }
        if ($price < 0) {
            $err = $err . "Price must be greater than or equal to 0. ";
            $check = false;
        }
        if ($category == "") {
            $err = $err . "Category is required. ";
            $check = false;
        }
        if ($check == false) {
            $_SESSION["addProductNotify"] = $err;
            return false;
        }
        return true;
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 10h40
     * save product
     *
     */
    public function saveProduct($name, $price, $category)
    {
        if ($this->isNameExists($name)) {
            $_SESSION["addProductNotify"] = "Name is already taken!";
            return false;
        }
        $urlImage = $this->uploadImage();
        if (!is_string($urlImage)) {
            return false;
        }
        $sql = "INSERT INTO product (name, price, category_id, image) VALUE (?,?,?,?)";
        $this->db->setQuery($sql);
        $this->db->execute(array($name, $price, $category, $urlImage));
        $_SESSION["addProductNotify"] = "Added successfully!";
        return true;
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 11h00
     * checking name exists
     *
     */
    public function isNameExists($name)
    {
        $sql = "SELECT * FROM product WHERE name = '$name'";
        $this->db->setQuery($sql);
        return $this->db->loadRow();
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 11h:10
     * upload image to images/products folder
     *
     */
    public function uploadImage()
    {
        $target_dir = "assets/images/products/";
        //lấy đuôi file
        $temp = explode(".", $_FILES["image"]["name"]);
        //tạo tên file và đường dẫn
        $target_file = $target_dir . round(microtime(true)) . uniqid() . '.' . end($temp);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION["addProductNotify"] = "File is not an image!";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION["addProductNotify"] = "File already exists!";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $_SESSION["addProductNotify"] = "Sorry, your file is too large!";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $_SESSION["addProductNotify"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed!";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The File " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                return $target_file;
            } else {
                $_SESSION["addProductNotify"] = "Sorry, there was an error uploading your file.";
            }
        }
    }


    /**
     *
     * Hoa
     * Created at 07-05-2021 09h50
     * get categories
     *
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM category ORDER BY category_id ASC";
        $this->db->setQuery($sql);
        return $this->db->loadAllRows();
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 09h30
     * count record on product table
     *
     */
    public function countRecord()
    {
        $sql = "SELECT COUNT(*) FROM product";
        $this->db->setQuery($sql);
        return $this->db->loadRecord();
    }

    /**
     *
     * Hoa
     * Create at 17-05-2021 10h40
     * get total page
     *
     */
    public function getTotalPages()
    {
        return ceil($this->countRecord() / 5);
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 09h00
     * paginate product
     *
     */
    public function paginate($page)
    {
        if ((int)$page == 0) {
            $page = 1;
        }
        $index = ($page - 1) * 5;
        $sql = "SELECT product.*, category.name AS category_name FROM product 
        INNER JOIN category ON product.category_id = category.category_id LIMIT $index, 5";
        $this->db->setQuery($sql);
        $products = $this->db->loadAllRows();
        if ($products == null) {
            return null;
        } else {
            return $products;
        }
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 13h50
     * delete product by id
     *
     */
    public function deleteProductById($id)
    {
        //delete image
        $sql_get_product = "SELECT * FROM product WHERE product_id = $id";
        $this->db->setQuery($sql_get_product);
        $product = $this->db->loadRow();
        File::deleteImage(trim($product->image));

        // delete product
        $sql = "DELETE FROM product WHERE product_id = $id";
        $this->db->setQuery($sql);
        $this->db->execute();
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 14h30
     * validate for form update
     *
     */
    public function validateUpdateProduct($name, $price, $category)
    {
        $check = true;
        $err = "";
        if ($name == "") {
            $err = $err . "Name is required. ";
            $check = false;
        }
        /*$regex = preg_match('/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/', $name);
        if (!$regex) {
            $err = $err . "The name cannot contain special characters. ";
            $check = false;
        }*/
        if ($price == "" || !is_numeric($price)) {
            $err = $err . "Price is required. ";
            $check = false;
        }
        if ($price < 0) {
            $err = $err . "Price must be greater than or equal to 0. ";
            $check = false;
        }
        if ($category == "") {
            $err = $err . "Category is required. ";
            $check = false;
        }
        if ($check == false) {
            $_SESSION["updateProductNotify"] = $err;
            return false;
        }
        return true;
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 14h40
     * update product
     *
     */
    public function updateProduct($newName, $price, $category, $oldName)
    {
        if ($this->isNewNameExists($newName, $oldName)) {
            $_SESSION["updateProductNotify"] = "New Name is already taken!";
            return false;
        }
        $sql = "SELECT * FROM product WHERE name = '$oldName'";
        $this->db->setQuery($sql);
        $product = $this->db->loadRow();
        if ($_FILES['image']['name'] == "") {
            // khong update image
            $sql_update = "UPDATE product SET name = '$newName', price = $price, category_id = $category WHERE product_id = $product->id";
            $this->db->setQuery($sql_update);
            $this->db->execute();
        } else {
            //update img - delete img
            $urlImage = $this->updateImage();
            if (!is_string($urlImage)) {
                return false;
            }
            $newProduct[3] = $urlImage;
            $sql_update = "UPDATE product SET name = '$newName', price = $price, category_id = $category, image = '$urlImage' WHERE product_id = $product->id";
            $this->db->setQuery($sql_update);
            $this->db->execute();
            File::deleteImage(trim($product->image));
        }
        $_SESSION["updateProductNotify"] = "updated successfully";
        return true;
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 15h10
     * checking new name exists
     *
     */
    public function isNewNameExists($newName, $oldName)
    {
        $sql = "SELECT * FROM product WHERE name = '$newName' AND name != '$oldName'";
        $this->db->setQuery($sql);
        return $this->db->loadRow();
    }

    /**
     *
     * Hoa
     * Created at 07-05-2021 15h:30
     * update image
     *
     */
    public function updateImage()
    {
        $target_dir = "assets/images/products/";
        //lấy đuôi file
        $temp = explode(".", $_FILES["image"]["name"]);
        //tạo tên file và đường dẫn
        $target_file = $target_dir . round(microtime(true)) . uniqid() . '.' . end($temp);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION["updateProductNotify"] = "File is not an image!";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION["updateProductNotify"] = "File already exists!";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $_SESSION["updateProductNotify"] = "Sorry, your file is too large!";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $_SESSION["updateProductNotify"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed!";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The File " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                return $target_file;
            } else {
                $_SESSION["updateProductNotify"] = "Sorry, there was an error uploading your file.";
            }
        }
    }


}