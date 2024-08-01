<?php
session_start();
include("admin/simple-php-captcha/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
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
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>WESEND- Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="admin/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
 <style>
.div1{
    
    
    height: 20px;
    width: 20px;
 margin-top: 25px;
 margin-left: 420px;
    position: absolute;
 animation-name: moving;
 animation-duration: 5s;
 animation-delay: 1s;
 animation-iteration-count: infinite;


}
.div1 .img{
    height: 70px;
    width: 70px;
    border-radius: 50%;
    
}
@keyframes moving{
    0%{margin-top: 25px;
                      margin-left: 500px;}
     25%{margin-top: 20px;
                 margin-left: 600px;}   
 50%{margin-top: 230px;
                margin-left: 600px;}      

   75%{margin-top: 230px;
 margin-left: 420px;}             
}

.div2{
    background-color: bisque;
    height: 300px;
    width: 300px;
    margin-top: 4px;
 margin-left: 400px;
 border-radius: 50px;
 
}
.div2 .img1{
    height: 100px;
    margin-left: 95px;
    margin-top: 100px;
    
}
.div2 .img1:hover{
    height: 200px;
}


.div{
    margin-left: -400px;
    margin-top: 250px;
    padding: 0%;
    position: absolute;
}
#ru{
    margin-top: -93px;
    margin-left: 40px;
}
        </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
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
<!--                --><?php //if(isset($_GET['error'])){ ?>
<!--                    <div class="alert alert-danger">-->
<!--                        <h4>Incorrect Username or Password.</h4>-->
<!--                        <p class="">Please check for valid username and password and try again.</p>-->
<!--                    </div>-->
<!--                --><?php //} ?>
                <form class="form-horizontal form-material" id="loginform" action="process_login.php" method="post">
                    <div class="col-xs-12 text-center"><span class="logo-login-design"><i class="fa-solid fa-user"></i></span></span></div>
                    <span></span>
                    <h3 class="box-title m-b-20 text-center"><b>Sign In Your WE SEND AC</b></h3>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>

                                <input class="form-control" type="email" required="" name="email" placeholder="Email" style="padding: 0 10px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </div>

                                <input class="form-control" type="password" required="" name="upass" placeholder="Password" style="padding: 0 10px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 row">
                            <label for="form_captcha" class="col-sm-2">Capcha<span class="mandatory">*</span></label>&emsp;

                            <input type="text" name="form_captcha" class="form-control col-10 col-sm-9" id="form_captcha" value="" autocomplete="off" placeholder="Enter Captcha Code"
                                   data-fv-notempty="true"
                                   data-fv-notempty-message="Captcha is required and cannot be empty" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="offset-sm-2 col-xs-9">
                            <?php
                            echo '<img style="max-height:52px;" src="admin/' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
                            ?>
                        </div>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <div class="col-md-12">-->
<!--                            <div class="checkbox checkbox-primary pull-left p-t-0">-->
<!--                                <input id="checkbox-signup" type="checkbox">-->
<!--                                <label for="checkbox-signup"> Remember me </label>-->
<!--                            </div></div>-->
<!--                    </div>-->
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
<!--                    <small><b>For any query:</b></small>-->
<!--                    <br/>-->
<!--                    --><?php
//                    include_once 'db_config.php';
//                    $conn = new mysqli($servername, $username, $password, $dbname);
//                    if ($conn->connect_error) {
//                        die("Connection failed: " . $conn->connect_error);
//                    }
//                    $stmt = $conn->prepare("select mobile from contactus");
//                    $stmt->execute();
//                    $stmt->bind_result($mob_no);
//                    $stmt->fetch();
//                    $conn->close();
//                    ?>
<!--                    <span>--><?php //echo $mob_no; ?><!--</span>-->

<!--                    <a href="register.php"><b>Click Here To Register</b></a>-->
            </div>
        </div>
         
         
         <div id="ru">
            <div class="div">

        <div class="div1"><img src="https://www.shutterstock.com/image-vector/24-hours-7-days-week-260nw-1426474208.jpg" alt="" class="img"> 
        </div>

            <div class="div2">
         <img src="https://www.wesend.com/images/rslider/LogoWeSendRondBlanc200.png" alt="not inserted" height="40px" class="img1">
           <div class="div"></div>
        </div>
    </div>
    </div>
    </section>
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="admin/bootstrap/dist/js/tether.min.js"></script>
    <script src="admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="admin/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="admin/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#errorMsg').fadeOut('slow');
            }, 4000);
        });
    </script>
</body>
</html>
