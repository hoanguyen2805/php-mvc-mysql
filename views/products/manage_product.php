<section class="manage-product">
    <div class="container-fluid-w">
        <div class="row">
            <div class="col">
                <div class="login-form__header">
                    <h1>MANAGE PRODUCT</h1>
                    <?php
                    if (isset($notify)) {
//    echo "<h3 class='sign-up-error'>" . $notify . "</h3>";
                        echo '<script type="text/javascript">alert("' . $notify . '")</script>';
                    }
                    ?>
                </div>
            </div>
            <div class="col">
                <a href="index.php?controller=products&action=add" class="manage-product__add">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add Product
                </a>
            </div>

            <div class="col">
                <div class="divTable blueTable">
                    <div class="divTableHeading">
                        <div class="divTableRow">
                            <div class="divTableHead">ID</div>
                            <div class="divTableHead">Image</div>
                            <div class="divTableHead">Name</div>
                            <div class="divTableHead">Price</div>
                            <div class="divTableHead">Category</div>
                            <div class="divTableHead">Action</div>
                        </div>
                    </div>
                    <div class="divTableBody">
                        <?php
                        if ($products != null) {
                            foreach ($products as $product) {
                                ?>
                                <div class="divTableRow">
                                    <div class="divTableCell">
                                        <?= $product->product_id ?>
                                    </div>
                                    <div class="divTableCell">
                                        <img src="<?= $product->image ?>" alt="" width="60px">
                                    </div>
                                    <div class="divTableCell"><?= $product->name ?></div>
                                    <div class="divTableCell">
                                        <?= number_format("$product->price", 0, ",", " ") ?> đ
                                    </div>
                                    <div class="divTableCell"><?= $product->category_name ?></div>
                                    <div class="divTableCell">
                                        <a href="index.php?controller=products&action=delete&id=<?= $product->product_id ?>"
                                           onClick="return confirm('Are you sure you want to delete this product?');"
                                           class="btn btn-danger">
                                            <i class="fa fa-trash"
                                               aria-hidden="true"></i> DELETE
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                        <!--                        <a href="index.php?controller=products&action=update&name=-->
                                        <?//= $product[0]?><!--">UPDATE</a>-->
                                        <button class="btn btn-warning" data-toggle="modal" type="button"
                                                data-target="#update_modal_<?= $product->product_id ?>"><span
                                                    class="glyphicon glyphicon-edit"></span> Edit
                                        </button>
                                    </div>

                                </div>
                                <?php
                                include 'views/products/update.php';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col">


                <div class="blueTable outerTableFooter">
                    <div class="tableFootStyle">
                        <div class="links">
                            <!--            <a href="">&laquo;</a>-->
                            <?php
                            $page = 1;
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                                if ((int)$page == 0) {
                                    $page = 1;
                                }
                            }
                            for ($i = 1; $i <= $totalPages; $i++) {
                                if ($page == $i) {
                                    echo "&nbsp;<a href=\"index.php?controller=products&action=manage-product&page=$i\" class='page-active'>$i</a>";
                                } else {
                                    echo "&nbsp;<a href=\"index.php?controller=products&action=manage-product&page=$i\">$i</a>";
                                }
                            }
                            ?>
                            <!--            <a href="#">&raquo;</a>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


