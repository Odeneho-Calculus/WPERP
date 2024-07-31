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
if($_SESSION['login_type'] != 'admin'){
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
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
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

        $current_date = date("Y-m-d");

        $conn2 = new mysqli($servername, $username, $password, $dbname);
        if ($conn2->connect_error) {
            die("Connection failed: " . $conn1->connect_error);
        }
        $stmt2 = $conn2->prepare("SELECT count(send_wp_msgs.login_id) FROM `logins` 
                                    Left Join send_wp_msgs on send_wp_msgs.login_id = logins.id
                                    WHERE send_wp_msgs.sort_date_wise = '$current_date'");
        $stmt2->execute();
        $stmt2->bind_result($total_campaign);
        $stmt2->fetch();
        $conn2->close();


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
                                        wp_mobile_listings.sort_date = '$current_date'");
        $stmt3->execute();
        $stmt3->bind_result($today_total_mob_all_cam);
        $stmt3->fetch();
        $conn3->close();

        ?>
        <!-- <div class="row">

                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                    <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                        <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Reseller</h3>
                        <div class="text-left">
                            <a href="reseller.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                            src="../plugins/images/icon/25.png" width="50px;" height="50px;"  alt="reseller_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_reseller_id)? 0 : $total_reseller_id); ?></h1></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                    <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                        <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Users</h3>
                        <div class="text-left">
                            <a href="user.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                            src="../plugins/images/icon/26.png" width="50px;" height="50px;"  alt="user_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_user_id)? 0 : $total_user_id); ?></h1></a>
                        </div>
                    </div>
                </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Campaign</h3>
                    <div class="text-left">
                        <a href="deliveryapp.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/28.png" width="50px;" height="50px;"  alt="campaign_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_campaign)? 0 : $total_campaign); ?></h1></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                    <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total No. (Today's)</h3>
                    <div class="text-left">
                        <a href="deliveryapp.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                        src="../plugins/images/icon/33.png" width="50px;" height="50px;"  alt="campaign_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($today_total_mob_all_cam)? 0 : $today_total_mob_all_cam); ?></h1></a>
                    </div>
                </div>
            </div>
        </div> -->
        <style>
            .card {
                border: none;
                border-radius: 10px; /* Adjust to 4px if preferred */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Stronger shadow */
                transition: transform 0.3s, box-shadow 0.3s;
                height: 100%;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Enhanced hover effect */
            }

            /* Card Body */
            .card-body {
                padding: 20px;
            }

            /* Card Icon */
            .card-icon {
                background-color: #fff;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Icon shadow for depth */
            }

            /* Card Titles and Values */
            .card-title {
                font-size: 18px;
                font-weight: bold;
                color: #333; /* Use #fff for light backgrounds */
            }

            .card-value {
                font-size: 28px;
                font-weight: bold;
                color: #444; /* Use #fff for light backgrounds */
                text-decoration: none;
            }

            /* Specific Card Styles */
            .card-reseller {
                background-color: #feb207;
            }

            .card-users {
                background-color: #F97D4D;
            }

            .card-campaign {
                background-color: #20b2aa;
            }

            .card-todays {
                background-color: #4682b4;
            }

            /* Responsive Adjustments */
            @media (max-width: 991px) {
                .card-title {
                    font-size: 16px;
                }

                .card-value {
                    font-size: 20px;
                }
            }
        </style>
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                    <div class="card card-reseller h-100">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="../plugins/images/icon/25.png" alt="Reseller Icon" width="30">
                            </div>
                            <h3 class="card-title">Total Reseller</h3>
                            <div class="text-left">
                                <a href="reseller.php" class="card-value"><?php echo (empty($total_reseller_id) ? 0 : $total_reseller_id); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                    <div class="card card-users h-100">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="../plugins/images/icon/26.png" alt="User Icon" width="30">
                            </div>
                            <h3 class="card-title">Total Users</h3>
                            <div class="text-left">
                                <a href="user.php" class="card-value"><?php echo (empty($total_user_id) ? 0 : $total_user_id); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                    <div class="card card-campaign h-100">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="../plugins/images/icon/28.png" alt="Campaign Icon" width="30">
                            </div>
                            <h3 class="card-title">Total Campaign</h3>
                            <div class="text-left">
                                <a href="deliveryapp.php" class="card-value"><?php echo (empty($total_campaign) ? 0 : $total_campaign); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                    <div class="card card-todays h-100">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="../plugins/images/icon/33.png" alt="Today's Total Icon" width="30">
                            </div>
                            <h3 class="card-title">Total No. (Today's)</h3>
                            <div class="text-left">
                                <a href="deliveryapp.php" class="card-value"><?php echo (empty($today_total_mob_all_cam) ? 0 : $today_total_mob_all_cam); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- <link href="css/styles.css" rel="stylesheet"> -->
<?php include_once 'footer.php'; ?>
