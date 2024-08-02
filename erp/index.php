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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4>
                <span>Welcome to WESEND User panel !</span>
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
       <style>
        .container{
                margin-top: 100px;
                margin-left:50px;
                margin-right: 50px;
            }
       
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            background-image: linear-gradient(rgb(34, 200, 197), rgb(0, 0, 0));
            border-radius: 9px;
            color: white;
            padding: 16px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Card Body */
        .card-body {
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        /* Card Icon */
        .card-icon {
            background-color: #EDF1F5;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Card Titles and Values */
        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        .card-value {
            font-size: 28px;
            font-weight: bold;
            color: #e0e0e0;
            text-decoration: none;
        }

        /* Specific Card Styles */
        .card-credit {
            border-top: 4px solid #22C8C5; /* Teal top border */
        }

        .card-campaign {
            border-top: 4px solid #20B2AA; /* Light sea green top border */
        }

        .card-todays {
            border-top: 4px solid #4682B4; /* Steel blue top border */
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
       
       
        <div class="row container">
            <?php if($user_type == 'reseller') { ?>
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
                    <div class="white-box" style="background-color: #59adf1;color: white; padding:16px; !important;">
                        <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Total Users</h3>
                        <div class="text-left">
                            <a href="user.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><img
                                            src="../plugins/images/icon/26.png" width="50px;" height="50px;"  alt="user_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">&emsp;<?php echo (empty($total_user_id)? 0 : $total_user_id); ?></h1></a>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card card-credit">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="./plugins/images/icon/37.png" width="50px" height="50px" alt="credit_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">
                            </div>
                            <h3 class="card-title">Total Credit</h3>
                            <div class="card-value">
                                <?php echo (empty($credit) ? 0 : $credit); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card card-campaign">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="./plugins/images/icon/28.png" width="50px" height="50px" alt="campaign_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">
                            </div>
                            <h3 class="card-title">Total Campaign</h3>
                            <a href="deliveryapp.php" class="card-value">
                                <?php echo (empty($total_campaign) ? 0 : $total_campaign); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card card-todays">
                        <div class="card-body">
                            <div class="card-icon">
                                <img src="./plugins/images/icon/33.png" width="50px" height="50px" alt="today_img" style="background: #FFFFFF;border-radius:20%;padding:2px;">
                            </div>
                            <h3 class="card-title">Total No. (Today's)</h3>
                            <a href="deliveryapp.php" class="card-value">
                                <?php echo (empty($today_total_mob_all_cam) ? 0 : $today_total_mob_all_cam); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <?php if($rollback == 'Enable'){ ?>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                    <div class="white-box" style="background-color: #feb207;color: white; padding:16px; !important;">
                        <h3 class="box-title" style="color: white;font-size: 16px;font-weight: bold;">Rollback</h3>
                        <div class="text-left">
                            <a href="deliveryapp.php"><h1 style="color: white;font-size: 25px;font-weight: bold;"><i class="fa fa-refresh"></i>&emsp;<?php echo $rollback; ?></h1></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>

        <style>
            .white-box-override {
              background: #fff;
              padding: 25px;
              margin-bottom: 15px;
              width: 90%;
              margin-left: auto;
              margin-right: auto;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
              border-radius: 8px;
            }
        </style>

        <div class="row">
            <div class="col-sm-12 mt-5">
                <div class="white-box-override" id="imge-popups">
                    <div class="table-responsive" style="display: none;">
                        <table class="table table-striped">
                            <thead >
                            <tr border="2">
                                <th>Sr. No.</th>
                                <th>Unique Id</th>
                         
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
                    <button type="button" class="btn btn-warning pull-right download-excel" value="Download Excel" style="background-image: linear-gradient(rgb(255, 0, 234),rgb(109, 0, 168));border-radius:5px">
                        <i style="background-image: linear-gradient(rgb(255, 0, 234),rgb(109, 0, 168))" class="fa fa-download"></i> Download
                    </button>

                    <br/>
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
                      
                                <th>Unique Id</th>
                               
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
                                       
                                        <td><?php echo $campaign_unique_id; ?></td>
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
                                            <a style="background-image: linear-gradient(rgb(255, 0, 234),rgb(109, 0, 168))" href='export-report.php?unique_id=<?php echo $campaign_unique_id; ?>&username=<?php echo $login_created_by; ?>'
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

                    
                    
                    
                </div>
            </div>
        </div> 
    </div>
    </div>


<!--     <div style="height:60px;width:100%;background-image:linear-gradient(green,black,green);position:absolute;top:39pc;">
        <h1 style="color:white;margin-left:34%;font-family: 'Josefin Sans', sans-serif;">OUR PREMIUM CUSTOMERS</h1>
    </div> -->
<!--       <div style="height:16pc;width:100%;background-color:white;color:white;position:absolute;top:43pc" class="scroll">
                <marquee scrollamount="17"> <img style="margin-top:60px" src="https://www.oruspoon.com/wp-content/uploads/2021/05/Logo-1.png"> 
                <img style="width:190px;height:190px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5x6MaGkMkmr7TQjLhZuv2-6N8GQUA-SJex4lTFpzkWg&s">
                <img src="https://tse2.mm.bing.net/th?id=OIP.7qoAWUJ_cpKpWnoivGYQFQHaDV&pid=Api&P=0&h=180">
                <img src="https://tse2.mm.bing.net/th?id=OIP.EirCodKxAA5F0tKEkXaF9gHaC1&pid=Api&P=0&h=180">
                <img src="https://tse4.mm.bing.net/th?id=OIP.i6f4FAa_Rr5F5vmTobirrwHaEK&pid=Api&P=0&h=180">
                <img src=https://tse4.mm.bing.net/th?id=OIP.CgNs3GIinNZmAbAL9_i0vAHaEM&pid=Api&P=0&h=180>
                <img style="width:320px;height:180px;" src="https://lh3.googleusercontent.com/p/AF1QipO71N7qPdi1Q-e1U85EgLm4nEIk3aGoP3pQRFz4=w1080-h608-p-no-v0">
                <img style="width:320px;height:180px;" src="https://f4.bcbits.com/img/a1173465411_10.jpg">
                <img style="width:320px;height:180px;" src="https://i.ytimg.com/vi/1wkCyQpkxbQ/maxresdefault.jpg">
                <img src="https://www.schoolmykids.com/smk-media/2018/11/Akshara-International-School-AS-Rao-Nagar-Hyderabad.png">
                <img style="width:320px;height:180px;" src="https://media.licdn.com/dms/image/C4D03AQEvcHiREaiE9A/profile-displayphoto-shrink_800_800/0/1661402548574?e=2147483647&v=beta&t=AbojZ7sCXvipdG-VFByzDhzp36wF6IGByFOXIe9zPq0">
                <img style="width:320px;height:180px;" src="https://skynetonline.co.in/images/sky-1.png">
                <img style="width:220px;height:180px;" src="https://play-lh.googleusercontent.com/Zsd6jnQIXYDTn1cWumuUFjwY-_RknxHulnMswV1qlTi8-TWjOthhuEWcLcOVj2XrQ0LD">
                <img src="./microtech.jpeg">
                <img style="width:220px;height:140px;" src="./fpl.jpeg">
                <img style="width:220px;height:140px;" src="./jayam.jpeg">
                <img style="width:220px;height:100px;" src="./kl.jpeg">
                <img style="width:220px;height:140px;" src="./johnrealestate.jpeg">
                <img style="width:220px;height:160px;" src="./milkyway (2).jpeg">
                <img style="width:290px;height:170px;" src="./orbito.jpeg">
                <img style="width:290px;height:190px;" src="./oruspoon.jpeg">
                <img style="width:290px;height:190px;" src="./talk.jpeg">
                <img style="width:290px;height:190px;" src="./urmil.jpeg">
                <img style="width:290px;height:190px;" src="./senthamarai.jpeg">
                <img style="width:290px;height:190px;" src="./neettaitech.jpeg">
                <img style="width:290px;height:190px;" src="./milkyway.jpeg">
                <img style="width:250px;height:190px" src="./sriram.jpeg">
                </marquee>
                </div> -->
        <!-- <div style="height:5px;width:100%;background-image:linear-gradient(green,black,green);position:absolute;top:59pc;">
        <h1 style="color:white;margin-left:34%;font-family: 'Josefin Sans', sans-serif;"></h1>
    </div> -->
            </ul>
        </div>
    <!-- /.container-fluid -->
</div>
<?php include_once 'footer.php'; ?>
