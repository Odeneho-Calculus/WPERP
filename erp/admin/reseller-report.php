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
include_once 'db_config.php';
include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Reseller</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Reseller</li>
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

        <?php if (isset($_GET['success'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Stored Successfully!
                    </div>
                </div>
            </div>
        <?php }

        if (isset($_GET['error'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error Adding Store. Please Try Again!
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (isset($_GET['edited'])) { ?>
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
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">

                <div class="white-box" id="imge-popups">

                    <h3 class="box-title m-b-0" id="fame">LIST OF all Reseller Credit Report</h3>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>User Unique Id</th>
                                <th>User Type</th>
                                <th>Username</th>
                                <th>No. of SMS</th>
                                <th>Per SMS Price</th>
                                <th>Old credit</th>
                                <th>Total credit</th>
                                <th>Description</th>
                                <th>Tax Status</th>
                                <th>Tax Percentage</th>
                                <th>Tax Amount</th>
                                <th>Txn Type</th>
                                <th>Total Amount</th>
                                <th>Created By</th>
                                <th>Created Usertype</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php include_once 'db_config.php';

                            $user_unique_id = $_SESSION['user_unique_id'];

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT
                                            transaction_logs.id,
                                            lg.username,
                                            transaction_logs.user_unique_id,
                                            transaction_logs.credit,
                                            `per_sms_price`,
                                            `old_credit`,
                                            `tax_status`,
                                            `tax_percentage`,
                                            `total_amount`,
                                            `tax_amount`,
                                            `txn_type`,
                                             description,
                                            lg.user_type,
                                            lgs.username,
                                            lgs.user_type,
                                            transaction_logs.created_at
                                        FROM
                                            `transaction_logs`
                                        LEFT JOIN logins as lg ON  lg.user_unique_id = transaction_logs.user_unique_id
                                        LEFT JOIN logins as lgs ON lgs.user_unique_id = transaction_logs.login_user_unique_id
                                        WHERE lg.user_type = 'reseller'  order by transaction_logs.id desc";

                            $stmt = $conn->prepare($sql);
                            if ($stmt->execute()) {
                                $stmt->bind_result($txn_id, $user_name, $reseller_unique_id, $no_of_sms, $per_sms_price, $old_credit, $tax_status, $tax_percentage, $total_amount, $tax_amount, $tax_type, $description, $user_type, $login_username, $login_user_type, $created_at);
                                $inc = 1;
                                while ($stmt->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $inc; ?></td>
                                        <td><b><?php echo $reseller_unique_id; ?></b></td>
                                        <td><span class="label label-info"
                                                              style='font-size: 12px;text-transform:capitalize;'><?php echo stripcslashes($user_type); ?></span>

                                        <td><b><?php echo $user_name; ?></b></td>
                                        <td><b><?php echo stripcslashes($no_of_sms); ?></b></td>
                                        <td><b><?php echo stripcslashes($per_sms_price); ?></b></td>
                                        <td><b><?php echo stripcslashes($old_credit); ?></b></td>
                                        <td><b><?php echo( $no_of_sms + $old_credit);?> </b></td>
                                        <td><b><?php echo stripcslashes($description); ?></b></td>
                                        <td><?php echo ($tax_status == "Yes") ? "<span class='label label-success' >Yes</span>" : "<span class='label label-warning'>No</span>" ?></td>
                                        <td><b><?php echo stripcslashes($tax_percentage). " %"; ?></b></td>
                                        <td><b><i class="fa fa-inr"></i> <?php echo ($tax_amount)/100; ?></b></td>
                                        <td><?php echo ($tax_type == "credit") ? "<span class='label label-success' >Credit</span>" : "<span class='label label-danger'>Debit</span>"
                                            ?></td>
                                        <td><b><i class="fa fa-inr"></i> <?php echo ($total_amount)/100; ?></b></td>
                                        <td><b><?php echo $login_username; ?></b></td>
                                        <td><b><?php echo $login_user_type; ?></b></td>
                                        <td><b><?php echo date_format(date_create($created_at), "d-m-Y h:i"); ?></b></td>
                                    </tr>
                                    <?php $inc++;
                                }
                            } else {

                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
