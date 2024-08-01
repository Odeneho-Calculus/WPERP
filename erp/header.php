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
$user_type = $_SESSION['login_type'];
$stmt = $conn->prepare("SELECT `username`,  `profilepic`, credit  FROM `logins` WHERE user_unique_id = ?");
$stmt->bind_param("s", $user_unique_id);
$stmt->execute();
$stmt->bind_result($u_username, $profile_pic, $credit);
$stmt->fetch();
$conn->close();
?>
<div  id="wrapper">
    <!-- Top Navigation -->
    <nav style="background-image: linear-gradient(rgb(0, 138, 177),rgb(0, 0, 0));" class="navbar navbar-default navbar-static-top m-b-0">
        <div style="background-image: linear-gradient(rgb(0, 138, 177),rgb(0, 0, 0));"  class="navbar-header" style="background:#128c79;"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div style="background-image: linear-gradient(rgb(0, 138, 177),rgb(0, 0, 0));" class="top-left-part" style="background: #15b49a;"><a class="logo" href="index.php"><span class="hidden-xs"><strong>WP ERP </strong></span></a></div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="hidden-xs waves-effect waves-light"> </a></li>
            </ul>
<!--            <ul class="nav navbar-top-links navbar-right pull-right">-->
                <!--<li><a href="login.html"><i class="ti-settings"></i> Settings</a></li>-->
<!--                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>-->
<!--            </ul>-->

                <button style="background-image: linear-gradient(rgb(0, 138, 177),rgb(0, 0, 0));" class ="btn dropdown-toggle pull-right profile" style="background: #128c79;" type = "button" data-toggle="dropdown">
                    <?php if (!empty($profile_pic)){ ?>
                    <img src="admin/img/upload/<?php echo $profile_pic; ?>"  width="40px;" height="40px;" alt="user_image">
                    <?php } else { ?>
                        <img src="admin/img/upload/user.png"  width="40px;" height="40px;" alt="user_image">
                   <?php } ?><?php echo !empty($u_username)? $u_username : ""; ?> <i class="ti-angle-down p-2"></i><span class = "caret"></span></button>
                <ul class = "dropdown-menu dropdown-menu-right profile-wth">
                    <li><a href = "login-profile.php"><img src="plugins/images/icon/34.png" width="30px;" height="30px;" alt=""> Profile</a></li>
                    <li><a href = "change-password.php"><img src="plugins/images/icon/36.png" width="25px;" height="25px;" alt=""> Change Password</a></li>
                    <li><a href="logout.php"><img src="plugins/images/icon/38.png" width="30px;" height="30px;" alt=""> Logout</a></li>
                </ul>
        </div>

        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
    <div style="background-color:black" class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">
                <br/>
                <li style="color:white;font-size:16px;">&emsp;<b>TOTAL CREDIT :&nbsp;<span class="hide-menu" style="font-size:26px;color:white "><?php echo $credit; ?></span></b></li>
                <li class="dhh"> <a href="index.php" class="waves-effect"><img src="plugins/images/icon/11.png" width="35px;" height="35px;" alt=""> <span class="hide-menu">DASHBOARD</span></a> </li>


                  <!--<li> <a href="add-gallery.php" class="waves-effect"><i class="ti-plus p-r-10"></i> <span class="hide-menu">Add Gallery</span></a> </li>-->
                <li class="dhh"> <a href="sendwhatsapp.php" class="waves-effect"><img src="plugins/images/icon/6.png" width="35px;" height="35px;" alt=""> <span class="hide-menu">SEND WHATSAPP SMS</span></a> </li>

                <li class="dhh">
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/16.png" width="40px;" height="40px;" alt=""> <span class="hide-menu">WHATSAPP REPORT <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li style="background-color:black" class="dhh"><a href="deliveryapp.php"><img src="plugins/images/icon/2.png" width="35px;" height="35px;" alt=""> <span class="hide-menu"> CAMPAIGN WISE </span></a></li>
                    </ul>
                </li>
                 <?php if($user_type == 'user') { ?>
                <li class="dhh">
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/24.png" width="40px;" height="40px;" alt=""> <span class="hide-menu">CREDIT REPORT <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li class="dhh" style="background-color:black"><a href="user-report.php"><img src="plugins/images/icon/29.png" width="30px;" height="30px;" alt=""><span class="hide-menu"> USER REPORT </span></a></li>
                    </ul>
                </li>
              <?php } ?>
                <?php if($user_type == 'reseller') { ?>
                <li class="dhh"> <a href="reseller.php" class="waves-effect"><img src="plugins/images/icon/10.png" width="30px;" height="30px;" alt=""> <span class="hide-menu"> MANAGE RESELLER</span></a> </li>

                <li class="dhh"> <a href="user.php" class="waves-effect"><img src="plugins/images/icon/7.png" width="30px;" height="40px;" alt=""> <span class="hide-menu">MANAGE USER</span></a> </li>

                <li class="dhh">
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/4.png" width="40px;" height="40px;" alt=""> <span class="hide-menu">CREDIT REPORT <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="reseller-report.php"><img src="plugins/images/icon/9.png" width="45px;" height="45px;" alt=""> RESELLER REPORTt</a></li>
                        <li><a href="user-report.php"><img src="plugins/images/icon/9.png" width="40px;" height="40px;" alt=""> <span class="hide-menu"> USER REPORT</span> </a></li>
                    </ul>
                </li>
                <?php } ?>

                <li class="dhh">
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/14.png" width="40px;" height="40px;" alt=""> <span class="hide-menu">SETTINGS <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li class="dhh" style="background-color:black"><a href="login-profile.php"><img src="plugins/images/icon/15.png" width="40px;" height="40px;" alt="">  <span class="hide-menu"> Update Profile </span></a></li>
                        <li class="dhh" style="background-color:black"><a href = "change-password.php"><img src="plugins/images/icon/36.png" width="35px;" height="35px;" alt="">  <span class="hide-menu"> Change Password </span></a></li>
<!--                        <li><a href="update_credit.php"><img src="plugins/images/icon/15.png" width="30px;" height="30px;" alt=""> Update Credit</a></li>-->
                    </ul>
                </li>
                <li class="dhh"> <a href="news.php" class="waves-effect"><img src="plugins/images/icon/30.png" width="30px;" height="30px;" alt=""> <span class="hide-menu">NEWS</span></a> </li>

<!--                <li> <a href="client-tree-view.php" class="waves-effect"><img src="plugins/images/icon/3.png" width=30px;" height="30px;" alt=""> <span class="hide-menu"> Client Tree View</span></a> </li>-->

                <li class="dhh"> <a href="contact.php" class="waves-effect"><img src="plugins/images/icon/1.png" width=30px;" height="30px;" alt=""> <span class="hide-menu"> CONTACT US</span></a> </li>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                 <div>
                 <li style="font-size:28px;height:70px;background-image: linear-gradient(rgb(255, 0, 149),rgb(0, 0, 0));font-family: 'Kalam', cursive;" <span class="hide-menu">Version-2.0</span></li>
                 </div>
                
                
                
                
                
                
                
                
               
    </div>
     <div class="scroll">
                <marquee height="100px" width="100%">this is next level techs</marquee>
                </div>
            </ul>
        </div>
    <!-- Left navbar-header end -->