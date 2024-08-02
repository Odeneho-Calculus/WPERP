<?php
session_start();
include("admin/simple-php-captcha/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
if (isset($_SESSION['login_status'])) {
    if (($_SESSION['login_status'] == 1)) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>WESEND - Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="admin/css/style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="admin/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            background: url('./plugins/images/login-register.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .white-box {
            width: 100%;
            max-width: 450px;
            background: white;
            /* background: rgba(255, 255, 255, 0.9); */
            /* Transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 40px 30px;
            text-align: center;
        }

        .logo-login-design {
            font-size: 40px;
            color: #3498db;
            margin-bottom: 20px;
        }

        .box-title {
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            height: 45px;
            padding: 10px;
            font-size: 15px;
        }

        .input-group-addon {
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px 0 0 5px;
        }

        .btn {
            background: #3498db;
            border: none;
            height: 45px;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #2980b9;
        }

        .alert {
            margin-bottom: 20px;
        }

        /* Custom styles for the captcha */
        .form-group label {
            font-weight: bold;
            color: #666;
        }

        .form-group img {
            max-height: 52px;
            margin-top: 10px;
        }

        .error-ul {
            list-style-type: none;
            padding: 0;
            color: red;
        }
    </style>
</head>

<body>
    <div class="white-box">
        <?php if (isset($_SESSION['er'])) { ?>
            <div class="alert alert-danger alert-dismissable" id="errorMsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>
                    <?php if (isset($_SESSION['er'])) { ?>
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
            <div class="col-xs-12 text-center">
                <span class="logo-login-design"><i class="fa fa-user"></i></span>
            </div>
            <h3 class="box-title m-b-20 text-center"><b>Sign In to Your WE SEND Account</b></h3>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input class="form-control" type="email" required="" name="email" placeholder="Email"
                            aria-label="Email" style="padding: 0 10px;">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key"></i>
                        </div>
                        <input class="form-control" type="password" required="" name="upass" placeholder="Password"
                            aria-label="Password" style="padding: 0 10px;">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 row">
                    <label for="form_captcha" class="col-sm-3">Captcha <span class="mandatory">*</span></label>
                    <input type="text" name="form_captcha" class="form-control col-sm-9" id="form_captcha" value=""
                        autocomplete="off" placeholder="Enter Captcha Code" data-fv-notempty="true"
                        data-fv-notempty-message="Captcha is required and cannot be empty" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <?php
                    echo '<img src="admin/' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
                    ?>
                </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                        type="submit">Log In</button>
                </div>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="admin/bootstrap/dist/js/tether.min.js"></script>
    <script src="admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!-- Slimscroll JavaScript -->
    <script src="admin/js/jquery.slimscroll.js"></script>
    <!-- Wave Effects -->
    <script src="admin/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="admin/js/custom.min.js"></script>
    <!-- Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#errorMsg').fadeOut('slow');
            }, 4000);
        });
    </script>
</body>

</html>
