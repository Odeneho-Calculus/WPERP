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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <title>WP-ERP - Admin Login</title>
    <!-- Bootstrap Core CSS -->
<!--     <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet"> -->
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- color CSS --><!-- 
    <link href="css/colors/blue.css" id="theme" rel="stylesheet"> -->
</head>

<body style="background: url('../assets/img/bg/erp1.jpg') no-repeat center center fixed; background-size: cover;">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <?php if(isset($_SESSION['er'])) { ?>
                <div class="alert alert-danger alert-dismissable" id="errorMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><?php if (isset($_SESSION['er'])){ ?>
                    <ul class="error-ul">
                        <?php echo $_SESSION['er']; ?>
                    </ul>
                    <?php
                    unset($_SESSION['er']);
                    } ?>
                    </p>
                </div>
                <?php } ?>

                <form class="form-horizontal form-material" id="loginform" action="process_login.php" method="post">
                   <div class="col-xs-12 text-center"><span class="logo-login-design"><img src="../assets/img/favicon.png" class="icon-border" alt="User Icon"></span></div>
                    <span></span>
                    <h3 class="box-title m-b-20 text-center"><b>Sign In</b></h3>
                    <div class="form-group col-sm-11">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope icon-border"></i>
                                </div>

                            <input class="form-control" type="email" required="" name="email" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-11">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-key icon-border"></i>
                                </div>

                            <input class="form-control" type="password" id="password" required="" name="upass" placeholder="Password">
                            <i id="eye" class="fa fa-eye eye-wrap"></i>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center">
                          <div class="form-check mb-0">
                            <input class="form-check-input" id="checkbox-signup" type="checkbox">
                            <label class="form-check-label" for="checkbox-signup"> Remember me </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                     <div class="reg-cont">
                      <p><b>New to WP ERP?</b></p>
                      <a href="register.php"><b>Create an account</b></a>
                    </div>
            </div>
        </div>
    </div>


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
    <script>
        $(document).ready(function(){
            const  password = $('#password');
            $('#eye').click(function(){
                if(password.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    password.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    password.attr('type','password');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#errorMsg').fadeOut('slow');
            }, 4000);
        });
    </script>
</body>
</html>
