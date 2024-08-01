<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robot" content="nofollow,noindex">
<!--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">-->
<!--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">-->
    <title>WESEND- Dashboard</title>
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
<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part"><a class="logo" href="index.php"><span class="hidden-xs"><strong>WE SEND </strong></span></a></div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="hidden-xs waves-effect waves-light"> ADMIN PANEL </a></li>
            </ul>
<!--            <ul class="nav navbar-top-links navbar-right pull-right">-->
                <!--<li><a href="login.html"><i class="ti-settings"></i> Settings</a></li>-->
<!--                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>-->
<!--            </ul>-->

                <button class ="btn dropdown-toggle pull-right profile" type = "button" data-toggle="dropdown"> <i class="ti-user p-r-10"></i>Companies <i class="ti-angle-down p-2"></i><span class = "caret"></span></button>
                <ul class = "dropdown-menu dropdown-menu-right profile-wth">

                    <li><a href = "profile.php"><i class="fa fa-user"></i>&emsp;Profile</a></li>
                    <li><a href = "profile.php"><i class="fa fa-shield"></i>&emsp;Change Password</a></li>
                    <li><a href="logout.php"><i class="fa fa-power-off"></i>&emsp;Logout</a></li>
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
                <li> <a href="index.php" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>


                  <!--<li> <a href="add-gallery.php" class="waves-effect"><i class="ti-plus p-r-10"></i> <span class="hide-menu">Add Gallery</span></a> </li>-->
                <li> <a href="sendwhatsapp.php" class="waves-effect"><i class="ti-email p-r-10"></i> <span class="hide-menu">Send Whatsapp SMS</span></a> </li>
                <li> <a href="reseller.php" class="waves-effect"><i class="ti-tag p-r-10"></i> <span class="hide-menu">Manage Reseller</span></a> </li>
                <li> <a href="user.php" class="waves-effect"><i class="ti-user p-r-10"></i> <span class="hide-menu">Manage User</span></a> </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="O"></i> <span class="hide-menu">Credit Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="reseller-report.php"><i class="ti-clipboard p-r-10"></i>Reseller Report</a></li>
                        <li><a href="user-report.php"><i class="ti-id-badge p-r-10"></i>User Report</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="O"></i> <span class="hide-menu">Whatsapp Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="deliveryapp.php"><i class="ti-list p-r-10"></i>Campaign Wise</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="6"></i> <span class="hide-menu">Settings <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="login-profile.php"><i class="ti-user p-r-10"></i>Update Profile</a></li>
                        <li><a href="change-password.php"><i class="ti-user p-r-10"></i>Update Credit</a></li>
                    </ul>
                </li>
                <li> <a href="news.php" class="waves-effect"><i class="ti-pencil-alt p-r-10"></i> <span class="hide-menu">News&emsp;<i class="fa fa-bell"><sup>0</sup></i></span></a> </li>
                <li> <a href="client-tree-view.php" class="waves-effect"><i class="fa fa-tree"></i> <span class="hide-menu"> Client Tree View</span></a> </li>


            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->