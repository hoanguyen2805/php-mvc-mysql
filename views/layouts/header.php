<div class="topnav" id="myTopnav">
    <?php
    function active($currect_page)
    {
        $url_array = explode('/', $_SERVER['REQUEST_URI']);
        $url = end($url_array);
        if (strpos($url, $currect_page) !== false) {
            echo 'active'; //class name in css
        }
    }

    if (!isset($_SESSION['user'])) {
        ?>
        <a href="index.php?controller=users&action=sign-in"
           class="<?php active("index.php?controller=users&action=sign-in"); ?>">
            <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In
        </a>
        <a href="index.php?controller=users&action=sign-up"
           class="<?php active("index.php?controller=users&action=sign-up"); ?>">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up
        </a>
        <?php
    } else {
        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
            ?>
            <a href="index.php?controller=users&action=list-users"
               class="<?php active("index.php?controller=users&action=list-users"); ?>">
                <i class="fa fa-users" aria-hidden="true"></i> Manage users
            </a>
            <a href="index.php?controller=products&action=manage-product"
               class="<?php active("index.php?controller=products&action=manage-product"); ?>">
                <i class="fa fa-product-hunt" aria-hidden="true"></i> Manage products
            </a>
            <?php
        }
        ?>
        <a href="index.php?controller=users&action=info"
           class="<?php active("index.php?controller=users&action=info"); ?>">
            <i class="fa fa-user" aria-hidden="true"></i> My Account
        </a>
        <a href="index.php?controller=users&action=sign-out">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out
        </a>
        <?php
    }
    ?>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>