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
if ($_SESSION['login_type'] != 'admin') {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}
?>

<head>
    <title>Client details</title>
</head>

<?php
include_once 'db_config.php';
include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Client Tree Details</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Client Tree Details</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (isset($_GET['id'])) {
                    if (!empty($_GET['id'])) {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $stmt = $conn->prepare("SELECT `id`, user_unique_id, user_type, `full_name` ,`username`, `email_id`, `pwd`, `company`, profilepic,  `mobile`, `credit`, `status` FROM `logins` WHERE  user_unique_id = ?");
                        $stmt->bind_param("s", $_GET['id']);
                        $stmt->execute();
                        $stmt->bind_result($r_id, $user_unique_id, $user_type, $r_fullname, $r_username, $r_email_id, $r_pwd, $r_company, $r_profile, $r_mobile, $credit, $status);
                        $stmt->fetch();
                        $conn->close();
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="col-md-12"><a href="client-tree-view.php"
                                                              class="btn btn-info pull-right">Back</a></div>
                                    <h3 class="box-title m-b-0">View client Details</h3>

                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="userName">Unique Id </label>
                                        <div class="col-lg-2"><?php echo $user_unique_id; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">User Type </label>
                                        <div class="col-lg-3"><span class="label label-info" style="font-size:14px;"><?php echo $user_type; ?></span></div>
                                        <label class="col-lg-1 control-label " for="userName">Total Credit  </label>
                                        <div class="col-lg-2"><span class="label label-success" style="font-size:14px;"><?php echo $credit; ?></span></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">User Name </label>
                                        <div class="col-lg-4"><?php echo $r_username; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">Fullname </label>
                                        <div class="col-lg-4"><?php echo $r_fullname; ?></div>

                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">Email Id </label>
                                        <div class="col-lg-4"><?php echo $r_email_id; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">Password </label>
                                        <div class="col-lg-4"><?php echo $r_pwd; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">mobileno </label>
                                        <div class="col-lg-4"><?php echo $r_mobile; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">company </label>
                                        <div class="col-lg-4"><?php echo $r_company; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">profilepic </label>
                                        <div class="col-lg-4">
                                            <?php if (!empty($r_profile)) { ?>
                                                <a href="img/upload/<?php echo $r_profile; ?>"
                                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                                    <img src="img/upload/<?php echo $r_profile; ?>"
                                                         style="width:40px; height:40px;">
                                                </a>
                                            <?php } else { ?>
                                                <a href="img/upload/user.png"
                                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                                    <img src="img/upload/user.png"
                                                         style="width:40px; height:40px;">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <label class="col-lg-2 control-label " for="userName">Create By </label>
                                        <div class="col-lg-4"> PROMOTUP</div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="confirm">Status </label>
                                        <div class="col-lg-4">
                                            <?php
                                            if ($status == 'Active') {
                                                ?>
                                                <strong style="color:green;">Active</strong>
                                            <?php } else { ?>
                                                <strong style="color:red;">Inactive</strong>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Edit -->
                    <?php }
                }?>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
    <?php include_once 'footer.php'; ?>
