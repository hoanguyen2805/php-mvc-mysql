<section class="manage-user">
    <div class="container-fluid-w">
        <div class="row">
            <div class="col">
                <div class="manage-user__header">
                    <h1>MANAGE USER</h1>
                </div>
            </div>
            <div class="col">
                <form action="index.php?controller=users&action=form-search" method="post" class="manage-user__form">
                    <input type="text" placeholder="Enter username or email" name="key">
                    <button type="submit" name="search" class="btn btn-search"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="col">
                <div class="divTable blueTable">
                    <div class="divTableHeading">
                        <div class="divTableRow">
                            <div class="divTableHead" style="width: 5%">ID</div>
                            <div class="divTableHead" style="width: 10%">Avatar</div>
                            <div class="divTableHead" style="width: 20%">Full Name</div>
                            <div class="divTableHead" style="width: 20%">Email</div>
                            <div class="divTableHead" style="width: 15%">Username</div>
                            <div class="divTableHead" style="width: 15%">Birthday</div>
                            <div class="divTableHead" style="width: 15%;">Action</div>
                        </div>
                    </div>
                    <div class="divTableBody">
                        <?php
                        if ($users != null) {
                            foreach ($users as $user) {
                                ?>
                                <div class="divTableRow">
                                    <div class="divTableCell"><?= $user->user_id ?></div>
                                    <div class="divTableCell">
                                        <img src="<?= $user->avatar ?>" alt="" onclick="showModalImg(this)">
                                    </div>
                                    <div class="divTableCell">
                                        <?= $user->full_name ?>
                                    </div>
                                    <div class="divTableCell">
                                        <?= $user->email ?>
                                    </div>
                                    <div class="divTableCell"><?= $user->username ?></div>
                                    <div class="divTableCell"><?= $user->birth_day ?></div>
                                    <div class="divTableCell">
                                        <?php
                                        if ($user->is_admin != 1) {
                                            ?>
                                            <a href="index.php?controller=users&action=delete-user&id=<?= $user->user_id ?>"
                                               onClick="return confirm('Are you sure you want to delete this user?');"
                                               class="btn btn-danger">
                                                <i class="fa fa-trash"
                                                   aria-hidden="true"></i> DELETE</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
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
                            $key = "";
                            if (isset($_GET['key'])) {
                                $key = $_GET['key'];
                            }
                            for ($i = 1; $i <= $totalPages; $i++) {
                                if ($page == $i) {
                                    echo "&nbsp;<a href=\"index.php?controller=users&action=list-users&page=$i&key=$key\" class='page-active'>$i</a>";
                                } else {
                                    echo "&nbsp;<a href=\"index.php?controller=users&action=list-users&page=$i&key=$key\">$i</a>";
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
    <div id="myModalImg" class="modal-img">
        <span class="close-img">&times;</span>
        <img class="modal-content__img" id="img01">
        <div id="caption"></div>
    </div>
</section>
