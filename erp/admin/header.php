<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robot" content="nofollow,noindex">

    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <title>WP ERP - Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap Core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

<style>
    .profile-image {
        border-radius: 50%;
        object-fit: cover;
    }
    .wperp{
        font-size: 20px; 
        font-weight: bolder; 
        font-family: 'Arial Black', 'Arial', sans-serif;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.8);
        color: linear-gradient(to right, #e0e0e0, white);

    }
</style>


<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"> 
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg" href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="hidden-xs waves-effect waves-light"><span class="wperp">WP ERP ADMIN PANEL</span></a></li>
            </ul>

            <div class="dropdown pull-right">
                <button class="btn dropdown-toggle profile" type="button" data-toggle="dropdown" style="font-size: 20px;">
                    <?php if (!empty($profile_pic)){ ?>
                        <img class="profile-image" src="img/upload/<?php echo $profile_pic; ?>" width="40px" height="40px" alt="user_image">
                    <?php } else { ?>
                        <img class="profile-image" src="img/upload/user.png" width="40px" height="40px" alt="user_image">
                    <?php } ?>
                    <?php echo !empty($u_username) ? $u_username : ""; ?> 
                </button>
                <ul class="dropdown-menu dropdown-menu-right profile-wth">
                    <li><a href="login-profile.php"><img src="../plugins/images/icon/34.png" width="30px" height="30px" alt="profile_img"> Profile</a></li>
                    <li><a href="change-password.php"><img src="../plugins/images/icon/36.png" width="30px" height="30px" alt="password_img"> Change Password</a></li>
                    <li><a href="logout.php"><img src="../plugins/images/icon/38.png" width="30px" height="30px" alt="logout_img"> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Top Navigation -->
    
    <!-- Left navbar-header -->
    <style>
        .sidebar {
            background-color: #f97d4d;
            color: #fff; 
            overflow: hidden;
            /* width: 22%; */
            border-right: 1px solid #000000;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.6);
            padding: 0 10px;
        }
        .sidebar-nav {
            list-style: none; /* Remove bullet points */
            padding: 0; /* Remove default padding */
            overflow: hidden;
        }
        .sidebar-nav li {
            margin-bottom: 15px; /* Space between items */
            overflow: hidden;
        }
        .sidebar-nav li a {
            display: flex; /* Align icon and text */
            align-items: center; /* Vertically align content */
            color: #fff !important; 
            text-decoration: none; /* Remove underline from links */
            transition: background-color 0.3s ease, color 0.3s ease; 
            overflow: hidden;
        }
        .sidebar-nav li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffe0b3; 
        }
    </style>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <br/>
                <li>&emsp;<b>Total Credit :&nbsp;<span class="hide-menu" style="font-family:'Roboto', sans-serif;font-size:16px;color:green "><?php echo $credit; ?></span></b></li>
                <li> <a href="index.php" class="waves-effect"><img src="../plugins/images/icon/20.png" width="35px;" height="35px;" alt="dasboard_img"> <span class="hide-menu"> Dashboard</span></a> </li>
                <li> <a href="sendwhatsapp.php" class="waves-effect"><img src="../plugins/images/icon/21.png" width="35px;" height="35px;" alt="wp_sms_img"> <span class="hide-menu"> Send Whatsapp SMS</span></a> </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="../plugins/images/icon/23.png" width="40px;" height="40px;" alt="wp-report-img"> <span class="hide-menu">Whatsapp Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="deliveryapp.php"><img src="../plugins/images/icon/28.png" width="35px;" height="35px;" alt="cam_img"> Campaign Wise</a></li>
                        <li><a href="search-mobile-no.php"><img src="../plugins/images/icon/33.png" width="40px" height="40px" alt="mobile_img"> Search Mobile No.</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="../plugins/images/icon/24.png" width="40px" height="40px" alt="credit_img"> <span class="hide-menu">Credit Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="reseller-report.php"><img src="../plugins/images/icon/29.png" width="30px" height="30px" alt="report_img"> Reseller Report</a></li>
                        <li><a href="user-report.php"><img src="../plugins/images/icon/29.png" width="30px" height="30px" alt="report_img_usr"> User Report</a></li>
                    </ul>
                </li>
                <li> <a href="reseller.php" class="waves-effect"><img src="../plugins/images/icon/25.png" width="45px" height="45px" alt="reseller_img"> <span class="hide-menu"> Manage Reseller</span></a> </li>
                <li> <a href="user.php" class="waves-effect"><img src="../plugins/images/icon/26.png" width="40px" height="40px" alt="user_img"> <span class="hide-menu">Manage User</span></a> </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="../plugins/images/icon/27.png" width="40px" height="40px" alt="setting_img"> <span class="hide-menu">Settings <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="login-profile.php"><img src="../plugins/images/icon/34.png" width="40px" height="40px" alt="up_profile_img"> Update Profile</a></li>
                        <li><a href = "change-password.php"><img src="../plugins/images/icon/36.png" width="35px" height="35px" alt="ch_pass_img"> Change Password</a></li>
                        <li><a href="update_credit.php"><img src="../plugins/images/icon/37.png" width="35px" height="35px" alt="up_credit_img"> Update Credit</a></li>
                    </ul>
                </li>
                <li> <a href="news.php" class="waves-effect"><img src="../plugins/images/icon/30.png" width="30px" height="30px" alt="news_img"> <span class="hide-menu">News</span></a> </li>
                <li> <a href="client-tree-view.php" class="waves-effect"><img src="../plugins/images/icon/31.png" width="30px" height="30px" alt="tree_img"> <span class="hide-menu"> Tree View</span></a> </li>
                <li> <a href="contact.php" class="waves-effect"><img src="../plugins/images/icon/32.png" width="30px" height="30px" alt="contact_img"> <span class="hide-menu"> Contact Us</span></a> </li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
