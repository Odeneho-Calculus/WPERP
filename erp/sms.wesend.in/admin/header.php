<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robot" content="nofollow,noindex">
<!--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">-->
<!--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">-->
    <title>WP ERP - Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Popup CSS -->
    <link href="../plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- summernotes CSS -->
    <link href="../plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
    <!-- Alertify CSS -->
    <link href="../plugins/bower_components/alertify/css/alertify.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/alertify/css/themes/semantic.min.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->

    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- Select 2 -->
    <link href="../plugins/bower_components/select2/dist/css/select2.min.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9] -->
    <!--[endif]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body class="fix-sidebar">
<!-- Preloader -->
<!--<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>-->
<?php
include_once 'db_config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_unique_id = $_SESSION['user_unique_id'];
$stmt = $conn->prepare("SELECT `username`,  `profilepic`, credit  FROM `logins` WHERE user_unique_id = ?");
$stmt->bind_param("s", $user_unique_id);
$stmt->execute();
$stmt->bind_result($u_username, $profile_pic, $credit);
$stmt->fetch();
$conn->close();
?>
<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part"><a class="logo" href="index.php"><span class="hidden-xs"><strong>WP ERP </strong></span></a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="hidden-xs waves-effect waves-light"> ADMIN PANEL </a></li>
            </ul>
<!--            <ul class="nav navbar-top-links navbar-right pull-right">-->
                <!--<li><a href="login.html"><i class="ti-settings"></i> Settings</a></li>-->
<!--                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>-->
<!--            </ul>-->

                <button class ="btn dropdown-toggle pull-right profile" type = "button" data-toggle="dropdown">
                    <?php if (!empty($profile_pic)){ ?>
                    <img src="img/upload/<?php echo $profile_pic; ?>"  width="40px;" height="40px;" alt="user_image">
                    <?php } else { ?>
                        <img src="img/upload/user.png"  width="40px;" height="40px;" alt="user_image">
                   <?php } ?><?php echo !empty($u_username)? $u_username : ""; ?> <i class="ti-angle-down p-2"></i><span class = "caret"></span></button>
                <ul class = "dropdown-menu dropdown-menu-right profile-wth">
                    <li><a href = "login-profile.php"><img src="../plugins/images/icon/34.png" width="30px;" height="30px;" alt="profile_img"> Profile</a></li>
                    <li><a href = "change-password.php"><img src="../plugins/images/icon/36.png" width="30px;" height="30px;" alt="password_img"> Change Password</a></li>
                    <li><a href="logout.php"><img src="../plugins/images/icon/38.png" width="30px;" height="30px;" alt="logout_img"> Logout</a></li>
                </ul>
        </div>

        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">
                <br/>
                <li>&emsp;<b>Total Credit :&nbsp;<span class="hide-menu" style="font-family:'Roboto', sans-serif;font-size:16px;color:green "><?php echo $credit; ?></span></b></li>
                <li> <a href="index.php" class="waves-effect"><img src="../plugins/images/icon/20.png" width="35px;" height="35px;" alt="dasboard_img"> <span class="hide-menu"> Dashboard</span></a> </li>


                  <!--<li> <a href="add-gallery.php" class="waves-effect"><i class="ti-plus p-r-10"></i> <span class="hide-menu">Add Gallery</span></a> </li>-->
                <li> <a href="sendwhatsapp.php" class="waves-effect"><img src="../plugins/images/icon/21.png" width="35px;" height="35px;" alt="wp_sms_img"> <span class="hide-menu"> Send Whatsapp SMS</span></a> </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="../plugins/images/icon/23.png" width=40px;" height="40px;" alt="wp-report-img"> <span class="hide-menu">Whatsapp Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="deliveryapp.php"><img src="../plugins/images/icon/28.png" width="35px;" height="35px;" alt="cam_img"> Campaign Wise</a></li>
                        <li><a href="search-mobile-no.php"><img src="../plugins/images/icon/33.png" width="40px;" height="40px;" alt="mobile_img"> Search Mobile No.</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="../plugins/images/icon/24.png" width="40px;" height="40px;" alt="credit_img"> <span class="hide-menu">Credit Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="reseller-report.php"><img src="../plugins/images/icon/29.png" width="30px;" height="30px;" alt="report_img"> Reseller Report</a></li>
                        <li><a href="user-report.php"><img src="../plugins/images/icon/29.png" width="30px;" height="30px;" alt="report_img_usr"> User Report</a></li>

                    </ul>
                </li>
                <li> <a href="reseller.php" class="waves-effect"><img src="../plugins/images/icon/25.png" width="45px;" height="45px;" alt="reseller_img"> <span class="hide-menu"> Manage Reseller</span></a> </li>
                <li> <a href="user.php" class="waves-effect"><img src="../plugins/images/icon/26.png" width="40px;" height="40px;" alt="user_img"> <span class="hide-menu">Manage User</span></a> </li>

<!--                <li> <a href="filter.php" class="waves-effect"><img src="../plugins/images/icon/22.png" width="30px;" height="30px;" alt="filter_wp_img"><span class="hide-menu">Filter Whatsapp No.</span></a> </li>-->
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="../plugins/images/icon/27.png" width="40px;" height="40px;" alt="setting_img"> <span class="hide-menu">Settings <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="login-profile.php"><img src="../plugins/images/icon/34.png" width="40px;" height="40px;" alt="up_profile_img"> Update Profile</a></li>
                        <li><a href = "change-password.php"><img src="../plugins/images/icon/36.png" width="35px;" height="35px;" alt="ch_pass_img"> Change Password</a></li>
                        <li><a href="update_credit.php"><img src="../plugins/images/icon/37.png" width="35px;" height="35px;" alt="up_credit_img"> Update Credit</a></li>
                    </ul>
                </li>
                <li> <a href="news.php" class="waves-effect"><img src="../plugins/images/icon/30.png" width="30px;" height="30px;" alt="news_img"> <span class="hide-menu">News</span></a> </li>
                <li> <a href="client-tree-view.php" class="waves-effect"><img src="../plugins/images/icon/31.png" width=30px;" height="30px;" alt="tree_img"> <span class="hide-menu"> Tree View</span></a> </li>
<!--                <li> <a href="search-mobile-no.php" class="waves-effect"><img src="../plugins/images/icon/19.png" width=30px;" height="30px;" alt=""> <span class="hide-menu"> Search Mobile No.</span></a> </li>-->
                <li> <a href="contact.php" class="waves-effect"><img src="../plugins/images/icon/32.png" width=30px;" height="30px;" alt="contact_img"> <span class="hide-menu"> Contact Us</span></a> </li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->