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
include_once 'db_config.php';
include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Update Credit</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Update Credit</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php if (isset($_GET['success'])) { ?>
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
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>Error. Please Try Again!
                    <?php if (isset($_SESSION['error'])){ ?>
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
        <?php

        $user_unique_id = $_SESSION['user_unique_id'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("select credit from logins Where user_unique_id = ?");
        $stmt->bind_param("s", $user_unique_id);
        $stmt->execute();
        $stmt->bind_result($credit);
        $stmt->fetch();
        $conn->close();
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box"><h3 class="box-title m-b-0">Total Credit :&emsp;<?php echo $credit; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Update Credit</h3>
                    <br>
                    <form class="form" method="post" action="process-update-credit.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="mobile" class="col-lg-1 col-form-label">Credit <span
                                        class="mandatory">*</span></label>
                            <div class="col-lg-4">
                                <input class="form-control" type="number" placeholder=""
                                       name="admin_credit"
                                       id="admin_credit" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-5">
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
