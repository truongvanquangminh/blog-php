<?php
include '../Session.php';
Session::checkSession();
include '../Database.php';
include '../helpers/Format.php';
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/logo.png" alt="Logo" />
                </div>
                <div class="floatleft middle">
                    <h1>????o t???o v???i d??? ??n tr???c ti???p</h1>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                        Session::destroy();
                    }
                    ?>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('username'); ?></li>
                            <li><a href="?action=logout">????ng xu???t</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>B???ng ??i???u khi???n</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>Th??ng tin ng?????i d??ng</span></a></li>
                <?php if (Session::get('userRole') == '0') {
                ?>
                    <li class="ic-grid-tables"><a href="inbox.php"><span>H???p th?? ?????n
                                <?php
                                $query = "SELECT * FROM tbl_contact WHERE status ='0' ORDER BY id DESC";
                                $msg = $db->select($query);
                                if ($msg) {
                                    $count = mysqli_num_rows($msg);
                                    echo "(" . $count . ")";
                                } else {
                                    echo "(0)";
                                }

                                ?>
                            </span></a></li>
                    <li class="ic-charts"><a href="adduser.php"><span>Th??m ng?????i d??ng</span></a></li>
                <?php
                } ?>
                <li class="ic-charts"><a href="userlist.php"><span>Danh s??ch ng?????i d??ng</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>