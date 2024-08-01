<?php
session_start();
if(isset($_SESSION['login_status'])){
    if(($_SESSION['login_status'] != 1)){
        header("Location: process_login.php");
        exit();
    }
}
if(!isset($_SESSION['login_status'])){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
if($_SESSION['login_type'] == 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4>
                <span>Welcome to WESEND admin panel !</span>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">WESEND</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
		<?php if(isset($_GET['deleted'])){ ?>
			<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        image deleted Successfully! </div>
                </div>
            </div>
		<?php } ?>
		
		<?php if(isset($_GET['error1'])){ ?>
			<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error deleting image.Please Try Again!</div>
                </div>
            </div>
		<?php } ?>
		
        <?php if(isset($_GET['success'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        New image Store Successfully! </div>
                </div>
            </div>
        <?php }

        if(isset($_GET['error'])){ ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error Adding image Store. Please Try Again! </div>
                </div>
            </div>
        <?php } ?>


        <?php
        require_once 'db_config.php';

        $login_id = $_SESSION['login_id'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT count(parent_id) FROM logins where user_type = 'reseller' and parent_id ='$login_id'");
        $stmt->execute();
        $stmt->bind_result($total_reseller_id);
        $stmt->fetch();
        $conn->close();

        $conn1 = new mysqli($servername, $username, $password, $dbname);
        if ($conn1->connect_error) {
            die("Connection failed: " . $conn1->connect_error);
        }
        $stmt1 = $conn1->prepare("SELECT count(parent_id) FROM logins where user_type = 'user' and parent_id ='$login_id'");
        $stmt1->execute();
        $stmt1->bind_result($total_user_id);
        $stmt1->fetch();
        $conn1->close();

        $conn2 = new mysqli($servername, $username, $password, $dbname);
        if ($conn2->connect_error) {
            die("Connection failed: " . $conn2->connect_error);
        }
        $stmt2 = $conn2->prepare("SELECT count(send_wp_msgs.login_id) FROM `logins` 
                                    Left Join send_wp_msgs on send_wp_msgs.login_id = logins.id
                                    WHERE login_id = '$login_id'");
        $stmt2->execute();
        $stmt2->bind_result($total_campaign);
        $stmt2->fetch();
        $conn2->close();

        $current_date = date("Y-m-d");
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        if ($conn3->connect_error) {
            die("Connection failed: " . $conn3->connect_error);
        }
        $stmt3 = $conn3->prepare("SELECT
                                        COUNT(wp_mobile_listings.mobile_no)
                                    FROM
                                        wp_mobile_listings
                                        Left Join send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                        Left join logins on logins.id = send_wp_msgs.login_id
                                    WHERE
                                        wp_mobile_listings.sort_date = '$current_date' AND logins.id = '$login_id'");
        $stmt3->execute();
        $stmt3->bind_result($today_total_mob_all_cam);
        $stmt3->fetch();
        $conn3->close();

        $conn4 = new mysqli($servername, $username, $password, $dbname);
        $sql4= "SELECT logins.rollback FROM logins WHERE logins.id = '$login_id' and status = 'Active'";
        $stmt4 = $conn4->prepare($sql4);
        $stmt4->execute();
        $stmt4->bind_result($rollback);
        $stmt4->fetch();
        $conn4->close();

       ?>
        <div class="row">
        <?php if($user_type == 'reseller') { ?>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Reseller</h3>
                    <div class="text-left">
                        <a href="reseller.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/25.png" width="50px;" height="50px;"  alt="reseller_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_reseller_id)? 0 : $total_reseller_id); ?></h1></a>
<!--                        <span class="" ><a href="add-blog.php#blog" style="font-size: 14px;color: white;"> VIEW All LIST</a></span>-->
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #59adf1;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Users</h3>
                    <div class="text-left">
                        <a href="user.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/26.png" width="50px;" height="50px;"  alt="user_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_user_id)? 0 : $total_user_id); ?></h1></a>
<!--                        <span class="" ><a href="add-blog.php#blog" style="font-size: 14px;color: white;"> VIEW All LIST</a></span>-->
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Credit</h3>
                    <div class="text-left">
                        <h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/37.png" width="50px;" height="50px;"  alt="campaign_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($credit)? 0 : $credit); ?></h1>
<!--                        <span class="" ><a href="add-blog.php#blog" style="font-size: 14px;color: white;"> VIEW All LIST</a></span>-->
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Campaign</h3>
                    <div class="text-left">
                        <a href="deliveryapp.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/28.png" width="50px;" height="50px;"  alt="campaign_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_campaign)? 0 : $total_campaign); ?></h1></a>
                        <!--                        <span class="" ><a href="add-blog.php#blog" style="font-size: 14px;color: white;"> VIEW All LIST</a></span>-->
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total No. (Today's)</h3>
                    <div class="text-left">
                        <a href="deliveryapp.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/33.png" width="50px;" height="50px;"  alt="campaign_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($today_total_mob_all_cam)? 0 : $today_total_mob_all_cam); ?></h1></a>
                        <!--                        <span class="" ><a href="add-blog.php#blog" style="font-size: 14px;color: white;"> VIEW All LIST</a></span>-->
                    </div>
                </div>
            </div>
            <?php if($rollback == 'Enable'){ ?>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Rollback</h3>
                    <div class="text-left">
                        <a href="deliveryapp.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><i class="fa fa-refresh"></i>&emsp;<?php echo $rollback; ?></h1></a>
                        <!--                        <span class="" ><a href="add-blog.php#blog" style="font-size: 14px;color: white;"> VIEW All LIST</a></span>-->
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box" id="imge-popups">
                    <div class="table-responsive" style="display: none;">
                        <table id="d_table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Unique Id</th>
                                <!--                                <th>Campaign Name</th>-->
                                <!--th>Message</th-->
                                <th>Total Mob No.</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Created User Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php include_once 'db_config.php';
                            $curr_date = date("Y-m-d");
                            $parent_id1 = $_SESSION['login_id'];
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT
                                                send_wp_msgs.id,
                                                `campaign_unique_id`,
                                                `campaign_name`,
                                                `message`,
                                                `number_count`,
                                                send_wp_msgs.status,
                                                send_wp_msgs.created_at,
                                                logins.username,
                                                logins.user_type
                                            FROM
                                                `send_wp_msgs`
                                            LEFT JOIN logins ON logins.id = send_wp_msgs.login_id
                                            where send_wp_msgs.login_id =  '$parent_id1' and `sort_date_wise` = '$curr_date'
                                            ORDER BY
                                               send_wp_msgs.id
                                            DESC";
                            $stmt = $conn->prepare($sql);
                            if ($stmt->execute()) {
                                $stmt->bind_result($campaign_id, $campaign_unique_id, $campaign_name, $message, $number_count, $status, $created_at, $login_created_by, $login_user_type);
                                $inc = 1;
                                while ($stmt->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $inc; ?></td>
                                        <td><?php echo $campaign_unique_id; ?></td>
                                        <!--                                        <td><b>--><?php //echo stripcslashes($campaign_name); ?><!--</b></td>-->
                                        <!--td><?php /* echo stripcslashes($message); */ ?></td-->
                                        <td><?php echo stripcslashes($number_count); ?></td>
                                        <td><?php echo date_format(date_create($created_at), "d-m-Y H:i"); ?></td>
                                        <td><?php echo $login_created_by; ?></td>
                                        <td><?php echo $login_user_type; ?></td>
                                    </tr>
                                    <?php $inc++;
                                }
                            } else {

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--                    <input type="hidden" value="" name="startdate">-->
                    <!--                    <input type="hidden" value="" name="enddate">-->
                    <button type="button" class="btn btn-warning pull-right download-excel" value="Download Excel">
                        <i class="fa fa-download"></i> Download
                    </button>

                    <br/>
                    <!--                    <form action="process-change-status.php" method="post">-->
                    <!--                        <div class="col-sm-5 offset-sm-3">-->
                    <!--                            <Select class="form-control" name="change-status" required>-->
                    <!--                                <option value="" selected disabled>---Change Status----</option>-->
                    <!--                                <option value="pending">Pending</option>-->
                    <!--                                <option value="process">Process</option>-->
                    <!--                                <option value="delivered">Delivered</option>-->
                    <!--                                <option value="discard">Discard</option>-->
                    <!--                            </Select>-->
                    <!--                            <br/>-->
                    <!--                            <button type="submit" name="submit-status" class="btn btn-success pull-right" value="">-->
                    <!--                                Submit-->
                    <!--                            </button>-->
                    <!--                            <br>-->
                    <!---->
                    <!--                        </div>-->
                    <h3 class="box-title m-b-0" id="fame">LIST OF all Campaign Wise</h3>
                    <div id="loader_div" class="text-center">
                        <img id="loader">
                    </div>
                    <div class="card-body">
                        <div id="result_div">
                        </div>
                    </div>
                    <div id="all-empty" class="alert alert-danger" style="display: none;">Please Select Date for filter table
                    </div>
                    <div class="table-responsive" id="table-hide">
                        <table id="d_table-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <!--                                <th>Estimate Time</th>-->
                                <!--                                    <th>Update Status</th>-->
                                <th>Unique Id</th>
                                <!--                                <th>Caption</th>-->
                                <!--th>Message</th-->
                                <th>Total Mob No.</th>
                                <th>Created By</th>
                                <th>Created User Type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php include_once 'db_config.php';
                            $parent_id = $_SESSION['login_id'];
                            $curr_date1 = date("Y-m-d");
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT
                                                send_wp_msgs.id,
                                                `campaign_unique_id`,
                                                `campaign_name`,
                                                `message`,
                                                `number_count`,
                                                send_wp_msgs.status,
                                                send_wp_msgs.created_at,
                                                logins.username,
                                                logins.user_type
                                            FROM
                                                `send_wp_msgs`
                                            LEFT JOIN logins ON logins.id = send_wp_msgs.login_id
                                            where send_wp_msgs.login_id =  '$parent_id' and `sort_date_wise` = '$curr_date1'
                                            ORDER BY
                                               send_wp_msgs.id
                                            DESC";
                            $stmt = $conn->prepare($sql);
                            if ($stmt->execute()) {
                                $stmt->bind_result($campaign_id, $campaign_unique_id, $campaign_name, $message, $number_count, $status, $created_at, $login_created_by, $login_user_type);
                                $inc = 1;
                                while ($stmt->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $inc; ?></td>
                                        <!--                                        <td><b><p id="t--><?php //echo $inc; ?><!--"> 0h 0m 0s </p></b></td>-->
                                        <!--                                            <td><input type="radio" name="campaign_id" id="campaign_id"-->
                                        <!--                                                       class="form-control campaign_id"-->
                                        <!--                                                       value="--><?php //echo $campaign_id; ?><!--"-->
                                        <!--                                                       style="width:23px;cursor:pointer;" required>-->
                                        <!--                                            </td>-->
                                        <td><?php echo $campaign_unique_id; ?></td>
                                        <!--                                        <td><b>--><?php //echo stripcslashes($campaign_name); ?><!--</b></td>-->
                                        <!--td style="word-wrap: break-word;max-width: 250px;"><?php /* echo stripcslashes($message); */ ?></td-->
                                        <td><?php echo stripcslashes($number_count); ?></td>

                                        <td><?php echo $login_created_by; ?></td>
                                        <td><?php echo $login_user_type; ?></td>
                                        <td><?php if ($status != 'discard') { ?>
                                                <span class="label label-success"
                                                      style="text-transform: capitalize; font-size: 12px;"><?php echo $status; ?></span>
                                            <?php } else { ?>
                                                <span class="label label-danger"
                                                      style="text-transform: capitalize; font-size: 12px;"><?php echo $status; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo date_format(date_create($created_at), "d-m-Y H:i"); ?></td>
                                        <td>
                                            <!--                                            <a href='deliveryapp1.php?action=view&unique_id=--><?php //echo $campaign_unique_id; ?><!--'-->
                                            <!--                                               class='btn btn-circle btn-info btn-sm'-->
                                            <!--                                               title='View Details'><i-->
                                            <!--                                                        class='fa fa-eye'></i></a>-->
                                            <a href='export-report.php?unique_id=<?php echo $campaign_unique_id; ?>&username=<?php echo $login_created_by; ?>'
                                               class='btn btn-circle btn-warning btn-sm'
                                               title='Download Excel' id="dl" ><i
                                                        class='fa fa-download'></i></a>
                                        </td>
                                    </tr>
                                    <?php $inc++;
                                }
                            } else {

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<?php include_once 'footer.php'; ?>
