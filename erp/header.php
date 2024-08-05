<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robot" content="nofollow,noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
<!--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">-->
<!--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">-->
    <title>WESEND - Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="admin/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Popup CSS -->
    <link href="plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- summernotes CSS -->
    <link href="plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
    <!-- Alertify CSS -->
    <link href="plugins/bower_components/alertify/css/alertify.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/alertify/css/themes/semantic.min.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="admin/css/style.css" rel="stylesheet">
    <link href="admin/css/preloader.css" rel="stylesheet">
    <!-- color CSS -->

    <link href="admin/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- Select 2 -->
    <link href="plugins/bower_components/select2/dist/css/select2.min.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9] -->
    <!--[endif]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    
    <style>
       .dhh:hover{
            background-image: linear-gradient(rgb(236, 236, 236),rgb(13, 219, 255));
           
       }
    .hide-menu{
        color:white ;
    }
   </style>
</head>

<body class="fix-sidebar">

<!-- Preloader -->
<div id="preloader">
    <div id="preloader-spinner"></div>
</div>

<!-- Mobile Warning Dialog -->
<div id="mobile-warning-dialog">
    <div id="mobile-warning-content">
        <i class="fas fa-tools fa-3x"></i> <!-- Maintenance Icon -->
        <p><strong>Mobile view is under construction. Please switch to desktop mode.</strong></p>
    </div>
</div>

<?php
include_once 'db_config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_unique_id = $_SESSION['user_unique_id'];
$user_type = $_SESSION['login_type'];
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
    .navbar-header{
        /* background-color: #ed5094 !important; */
        background-color: #007bff !important;
    }
    .profile{
        background-color: #007bff !important;
    }
</style>

<div  id="wrapper">
       <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
       <div class="navbar-header"> 
    <a class="navbar-toggle hidden-sm hidden-md hidden-lg" href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
    <ul class="nav navbar-top-links navbar-left hidden-xs">
        <li><a href="index.php" class="hidden-xs waves-effect waves-light"><span class="wperp">WP ERP USER PANEL</span></a></li>
    </ul>

    <button class="btn dropdown-toggle pull-right profile" type="button" data-toggle="dropdown" style="font-size: 20px;">
        <?php if (!empty($profile_pic)){ ?>
                    <img class="profile-image" src="admin/img/upload/<?php echo $profile_pic; ?>"  width="40px;" height="40px;" alt="user_image">
                    <?php } else { ?>
                        <img src="admin/img/upload/user.png"  width="40px;" height="40px;" alt="user_image">
                   <?php } ?><?php echo !empty($u_username)? $u_username : ""; ?><span class = "caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right profile-wth">
        <li><a href="login-profile.php"><img src="./plugins/images/icon/34.png" width="30px" height="30px" alt="profile_img"> Profile</a></li>
        <li><a href="change-password.php"><img src="./plugins/images/icon/36.png" width="30px" height="30px" alt="password_img"> Change Password</a></li>
        <li><a href="logout.php"><img src="./plugins/images/icon/38.png" width="30px" height="30px" alt="logout_img"> Logout</a></li>
    </ul>
</div>


        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->

    
    <!-- Left navbar-header -->
     <style>
        .sidebar{
            background-color: #007bff;
            /* background-color: #f97d4d; */
            color: #fff; 
            overflow: hidden;
            /* width: 22%; */
            border-right: 1px solid #000000;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.6);
            padding: 0 5px;
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
                <li>&emsp;<b>Total Credit :&nbsp;<span class="hide-menu" style="font-family:'Roboto', sans-serif;font-size:16px;color:#ff1744; text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.8); "><?php echo $credit; ?></span></b></li>

                <li class="sdbrLnks"> <a href="index.php" class="waves-effect"><img src="./plugins/images/icon/11.png" width="35px;" height="35px;" alt="dasboard_img"> <span class="hide-menu ml-2"> Dashboard</span></a> </li>


                  
                <li class="sdbrLnks"> <a href="sendwhatsapp.php" class="waves-effect"><img src="./plugins/images/icon/6.png" width="35px;" height="35px;" alt="wp_sms_img"> <span class="hide-menu ml-2"> Send Whatsapp SMS</span></a> </li>

                <li class="sdbrLnks">
                    <a href="javascript:void(0);" class="waves-effect"><img src="./plugins/images/icon/16.png" width="40px;" height="40px;" alt="wp-report-img"> <span class="hide-menu">Whatsapp Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="deliveryapp.php"><img src="./plugins/images/icon/2.png" width="35px;" height="35px;" alt="cam_img"> Campaign Wise</a></li>
                    </ul>
                </li>

                <li class="sdbrLnks">
                <?php if($user_type == 'user') { ?>
                    <a href="javascript:void(0);" class="waves-effect"><img src="./plugins/images/icon/24.png" width="40px;" height="40px;" alt="credit_img"> <span class="hide-menu">Credit Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="user-report.php"><img src="./plugins/images/icon/9.png" width="30px;" height="30px;" alt="report_img_usr"> User Report</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if($user_type == 'reseller') { ?>

                <li class="sdbrLnks"> <a href="reseller.php" class="waves-effect"><img src="./plugins/images/icon/10.png" width="45px;" height="45px;" alt="reseller_img"> <span class="hide-menu"> Manage Reseller</span></a> </li>

                <li class="sdbrLnks"> <a href="user.php" class="waves-effect"><img src="./plugins/images/icon/7.png" width="40px;" height="40px;" alt="user_img"> <span class="hide-menu">Manage User</span></a> </li>
                
                <li class="sdbrLnks">
                <a href="javascript:void(0);" class="waves-effect"><img src="./plugins/images/icon/4.png" width="40px;" height="40px;" alt="credit_img"> <span class="hide-menu">Credit Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="user-report.php"><img src="./plugins/images/icon/9.png" width="30px;" height="30px;" alt="report_img_usr"> User Report</a></li>
                    </ul>
                </li>
                <?php } ?>

                <li class="sdbrLnks">
                    <a href="javascript:void(0);" class="waves-effect"><img src="./plugins/images/icon/14.png" width="40px;" height="40px;" alt="setting_img"> <span class="hide-menu">Settings <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="login-profile.php"><img src="./plugins/images/icon/15.png" width="40px;" height="40px;" alt="up_profile_img"> Update Profile</a></li>
                        <li><a href = "change-password.php"><img src="./plugins/images/icon/36.png" width="35px;" height="35px;" alt="ch_pass_img"> Change Password</a></li>
                    </ul>
                </li>

                <li class="sdbrLnks"> <a href="news.php" class="waves-effect"><img src="./plugins/images/icon/30.png" width="30px;" height="30px;" alt="news_img"> <span class="hide-menu">News</span></a> </li>

                <li class="sdbrLnks"> <a href="contact.php" class="waves-effect"><img src="./plugins/images/icon/1.png" width="30px;" height="30px;" alt="contact_img"> <span class="hide-menu"> Contact Us</span></a> </li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->

    <!-- preloader script -->
    <script src="admin/js/preloader.js"></script>
    <script type="text/javascript">
        // Toggle the sublists
document.querySelectorAll('.sdbrLnks > a').forEach(item => {
    item.addEventListener('click', function() {
        // First, remove the 'active' class from all other items
        document.querySelectorAll('.sdbrLnks.active').forEach(activeItem => {
            if (activeItem !== this.parentNode) {
                activeItem.classList.remove('active');
            }
        });
        
        // Then, toggle the 'active' class on the currently clicked item
        this.parentNode.classList.toggle('active');
    });
});

    </script>

    </body>

</html>