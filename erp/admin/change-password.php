<?php
session_start();
if (isset($_SESSION['login_status'])) {
    if (($_SESSION['login_status'] != 1)) {
        header("Location: process_login.php");
        exit();
    }
}
if (!isset($_SESSION['login_status'])) {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}
if($_SESSION['login_type'] != 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
?>

<head>
    <title>Change password</title>
</head>

<?php
include_once 'db_config.php';
include_once 'header.php'; ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Change Password</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Change Password</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php if(isset($_GET['success'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Password changed Successfully! </div>
                </div>
            </div>
        <?php }

        if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>Error. Please Try Again!
                    <?php if(isset($_SESSION['error'])){?>
                <ul class="error-ul">
                    <?php echo $_SESSION['error'];
                    ?>
                </ul>
                <?php
                unset($_SESSION['error']);
                } ?>
                </p>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Change Password</h3>
                    <br>
                    <form class="form" method="post" action="process-change-password.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="mobile" class="col-lg-3 col-form-label">Current Password  <span
                                        class="mandatory">*</span></label>
                            <div class="col-lg-4">
                                <input class="form-control" type="password"  placeholder="Old Password" name="old_password"
                                       id="current_pwd" value="" required>
                                <i id="eye-0" class="fa fa-eye"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-3 col-form-label">New Password <span
                                        class="mandatory">*</span></label>
                            <div class="col-lg-4">
                                <input class="form-control" type="password" placeholder="New Password" name="new_password"
                                       id="new_pwd" value="" required>
                                <i id="eye-1" class="fa fa-eye"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-lg-3 col-form-label">Confirm Password  <span
                                        class="mandatory">*</span></label>
                            <div class="col-lg-4">
                                <input class="form-control" type="password" placeholder="Confirm Password" name="confirm_new_password"
                                       id="conf_pwd" value="" required>
                                <i id="eye-2" class="fa fa-eye"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9">
                                <button type="submit" name="submit"
                                        class="btn btn-success waves-effect waves-light  pull-right">Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
    <script>
        $(document).ready(function(){
            const  password = $('#current_pwd');
            const  newpassword = $('#new_pwd');
            const  confpassword = $('#conf_pwd');

            $('#eye-0').click(function(){
                if(password.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    password.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    password.attr('type','password');
                }
            });
            $('#eye-1').click(function(){
                if(newpassword.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    newpassword.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    newpassword.attr('type','password');
                }
            });
            $('#eye-2').click(function(){
                if(confpassword.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    confpassword.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    confpassword.attr('type','password');
                }
            });
        });
    </script>