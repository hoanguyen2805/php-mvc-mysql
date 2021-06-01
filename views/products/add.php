<section class="add-product">
    <div class="container-w">
        <div class="row">
            <div class="col">
                <div class="add-product__header">
                    <h1>ADD PRODUCT</h1>
                    <?php
                    if (isset($notify)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?= $notify ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <!---->
                <div class="add-product__content">
                    <form action="index.php?controller=products&action=add-product-form"
                          autocomplete="off"
                          method="post"
                          enctype="multipart/form-data" name="form_add_product"
                          onsubmit="return validateFormAddProduct()">

                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-input" id="name" placeholder="Eg: iphone 11" name="name">
                            <p class="error" id="err-name-add-product"></p>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-input" id="price" placeholder="Eg: 50000" name="price"
                                   min="0">
                            <p class="error" id="err-price-add-product"></p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">Category</label>
                            <select name="category" id="category" class="form-input">
                                <?php
                                foreach ($categories as $category) {
                                    ?>
                                    <option value="<?= $category->category_id ?>"><?= $category->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-input" id="image" name="image">
                            <p class=" error" id="err-image-add-product">Image is required!</p>
                        </div>
                        <button type="submit" class="form-submit" name="add_product">ADD</button>
                    </form>
                    <!---->


                    <!---->
                </div>
            </div>
        </div>
    </div>
</section>