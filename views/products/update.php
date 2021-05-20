<div class="modal fade" id="update-modal-<?= $product->product_id ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="index.php?controller=products&action=update-product-form&old=<?= $product->name ?>"
                  autocomplete="off"
                  method="post"
                  enctype="multipart/form-data" name="form_update_product_<?= $product->product_id ?>"
                  onsubmit="return validateFormUpdateProduct(<?= $product->product_id ?>)">
                <div class="modal-header">
                    <h3 class="modal-title">UPDATE PRODUCT</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <!-- Form Group -->

                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-input" id="name" placeholder="Eg: iphone 11" name="name"
                                   value="<?= $product->name ?>">
                            <p class="error" id="err-name-update-product-<?= $product->product_id ?>"></p>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-input" id="price" placeholder="Eg: 50000" name="price"
                                   min="0"
                                   value="<?= $product->price ?>">
                            <p class="error" id="err-price-update-product-<?= $product->product_id ?>"></p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">Category</label>
                            <select name="category" id="category" class="form-input">
                                <?php
                                foreach ($categories as $category) {
                                    if ($product->category_id == $category->category_id) {
                                        echo "<option value='$category->category_id' selected>$category->name</option>";
                                    } else {
                                        echo "<option value='$category->category_id'>$category->name</option>";
                                    }
                                }
                                ?>
                            </select>
                            <p class="error" id="err-select-update-product-<?= $product->product_id ?>">Category is
                                required!</p>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-input" id="image-<?= $product->product_id ?>" name="image"
                                   onchange="PreviewImage(<?= $product->product_id ?>);">
                        </div>
                        <img id="upload-preview-<?= $product->product_id ?>" style="width: 100px; height: 100px;"
                             src="<?= $product->image ?>"/>

                        <!-- END -->
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button name="update_product" class="btn btn-warning" type="submit">
                        <span class="glyphicon glyphicon-edit"></span> Update
                    </button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>