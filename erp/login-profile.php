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
if ($_SESSION['login_type'] == 'admin') {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}
include_once 'db_config.php';
include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Update Profile</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Update Profile</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <?php if (isset($_GET['deleted'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        deleted Successfully!
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($_GET['error1'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error deleting image.Please Try Again!
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($_GET['update'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Updated Successfully!
                    </div>
                </div>
            </div>
        <?php }

        if (isset($_GET['error'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error in update. Please Try Again!
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (isset($_GET['success2'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Edited Successfully!
                    </div>
                </div>
            </div>
        <?php }

        if (isset($_GET['error2'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error in Editing. Please Try Again!
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php

        $user_unique_id = $_SESSION['user_unique_id'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("select full_name, username, email_id, profilepic, mobile, company from logins Where user_unique_id = ?");
        $stmt->bind_param("s", $user_unique_id);
        $stmt->execute();
        $stmt->bind_result($full_name, $u_name, $email_id, $profile, $mob_no, $company);
        $stmt->fetch();
        $conn->close();
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Update Profile</h3>
                    <br>
                    <form class="form" method="post" action="process-login-profile.php" enctype="multipart/form-data">
                        <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $user_unique_id; ?>">
                        <div class="form-group row">
                            <label for="mobile" class="col-2 col-form-label">Username <span
                                        class="mandatory">*</span></label>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Username" name="username"
                                       id="username" value="<?php echo $u_name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email Id <span
                                        class="mandatory">*</span></label>
                            <div class="col-6">
                                <input class="form-control" type="email" placeholder="Email" name="email"
                                       id="email" value="<?php echo $email_id; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-2 col-form-label">Fullname <span
                                        class="mandatory">*</span></label>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Fullname" name="fullname"
                                       id="full_name" value="<?php echo $full_name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-lg-2 col-form-label">Profilepic
                                <small>(300 x 300px)</small>
                            </label>

                            <div class="col-6">
                                <?php if (!empty($profile)) { ?>
                                    <a href="admin/img/upload/<?php echo $profile; ?>"
                                       class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                        <img src="admin/img/upload/<?php echo $profile; ?>"
                                             style="width:60px; height:60px;">
                                    </a>
                                <?php } else { ?>
                                    <a href="admin/img/upload/user.png"
                                       class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                        <img src="admin/img/upload/user.png"
                                             style="width:60px; height:60px;">
                                    </a>
                                <?php } ?>
                                <input type="file" id="photo" name="photo" class="form-control"
                                       accept="image/png,image/jpeg">
                                <p class="help-block text-danger">
                                    <small>Photo should be smaller than 500 KB. Only JPG and PNG are
                                        allowed.
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-2 col-form-label">Mobile No. <span class="mandatory">*</span></label>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Mobile" name="mobile"
                                       id="mobile" value="<?php echo $mob_no; ?>" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile" class="col-2 col-form-label">Company <span
                                        class="mandatory">*</span></label>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Company" name="company"
                                       id="company" value="<?php echo $company; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-8">
                                <button type="submit" name="submit"
                                        class="btn btn-success waves-effect waves-light pull-right">Update
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
