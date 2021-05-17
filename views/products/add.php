<div class="signup">
    <h1 class="signup-heading">Add Product</h1>
    <?php
    if (isset($notify)) {
        echo "<h3 class='sign-up-error'>" . $notify . "</h3>";
    }
    ?>
    <form action="index.php?controller=products&action=add-product-form" class="signup-form" autocomplete="off"
          method="post"
          enctype="multipart/form-data" name="form_add_product"
          onsubmit="return validateFormAddProduct()">

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-input" id="name" placeholder="Eg: iphone 11" name="name">
            <p class="error" id="err-name-product">Name is required!</p>
        </div>

        <div class="form-group">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-input" id="price" placeholder="Eg: 50000" name="price" step="0.01" min="0">
            <p class="error" id="err-price-product">Price is required!</p>
        </div>

        <div class="form-group">
            <label for="username" class="form-label">Category</label>
            <select name="category" id="category" class="form-input">
                <?php
                foreach ($categories as $category) {
                    ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php
                }
                ?>
            </select>
            <p class="error" id="err-select-product">Category is required!</p>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-input" id="image" name="image">
            <p class=" error" id="err-image-product">Image is required!</p>
        </div>
        <button type="submit" class="form-submit" name="add_product">ADD</button>
    </form>
</div>
