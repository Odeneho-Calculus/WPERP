<?php
session_start();
if(isset($_SESSION['login_status'])){
    if(($_SESSION['login_status'] == 1)){
        header("Location: index.php");
        exit();
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <title>WP-ERP - Admin Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">


    <style>
        .login-box {
            margin: 5% auto 0 !important;
        }
    </style>
</head>

<body style="background: url('../assets/img/bg/erp1.jpg') no-repeat center center fixed; background-size: cover;">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <?php if(isset($_GET['error'])){ ?>
                    <div class="alert alert-danger">
                        <h4>Incorrect Username or Password.</h4>
                        <p class="">Please check for valid username and password and try again.</p>
                    </div>
                <?php } ?>
                <form class="form-horizontal form-material" id="loginform" action="process_login.php" method="post">
                    <h3 class="box-title m-b-20">Sign Up</h3>

                    <div class="form-group row">
                        <label for="" class="col-3">Full Name</label>
                        <div class="col-9">
                            <input class="form-control" type="text" required="" name="uname" placeholder="Fullname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Email Id</label>
                        <div class="col-9">
                            <input class="form-control" type="email" required="" name="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Mobile</label>
                        <div class="col-9">
                            <input class="form-control" type="text" required="" name="mobile" placeholder="Enter Mobile">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Company</label>
                        <div class="col-9">
                            <input class="form-control" type="text" required="" name="Company" placeholder="Enter Company">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                        </div>
                    </div>
                    <a href="login.php"><b>Click Here To Login</b></a>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
