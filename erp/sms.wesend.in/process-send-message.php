<?php
session_start();
ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '20M');
ini_set('max_input_time', '-1');
ini_set('max_execution_time', '0');
//set_time_limit(5000);
date_default_timezone_set('Asia/Kolkata');

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
function randomSalt($len = 8)
{
    $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $l = strlen($chars) - 1;
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $str .= $chars[rand(0, $l)];
    }
    return $str;
}

require_once 'db_config.php';
if (isset($_POST['send'])) {
    $_SESSION['error1'] = "";
    if (isset($_POST['headline']) && empty($_POST['headline'])) {
        $_SESSION['error1'] .= "<li>Headline should not be blank</li>";
    }
    if (empty($_SESSION['error1'])) {
        $created_at = date("Y-m-d h:i:s");
        $headline = $_POST['headline'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("update headlines set headline = ?, created_at = ?");
        $stmt->bind_param("ss", $headline, $created_at);
        $stmt->execute();
        $conn->close();

        $_SESSION['success1'] = "Stored Successfully!";
        unset($_SESSION['error1']);
        header("Location: sendwhatsapp.php");
        exit();
    } else {
        header("Location: sendwhatsapp.php");
        exit();
    }
}
if (isset($_POST['submit'])) {

    $_SESSION['error'] = "";
    $unique_id = $_SESSION['user_unique_id'];

    $conn2 = new mysqli($servername, $username, $password, $dbname);
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }
    $stmt2 = $conn2->prepare("Select credit from logins where logins.user_unique_id =? ");
    $stmt2->bind_param("s", $unique_id);
    $stmt2->execute();
    $stmt2->bind_result($credit);
    $stmt2->fetch();
    $conn2->close();

    if ($credit != 0 || !empty($credit)) {

//        if (isset($_POST['caption']) && empty($_POST['caption'])) {
//            $_SESSION['error'] .= "<li>Caption name should not be blank</li>";
//        }
//        if (isset($_POST['description']) && empty($_POST['description'])) {
//            $_SESSION['error'] .= "<li>Description should not be blank</li>";
//        }
        if (isset($_POST['numbercount']) && empty($_POST['numbercount'])) {
            $_SESSION['error'] .= "<li>Number Count should not be blank</li>";
        }
        if (isset($_POST['mobileno']) && empty($_POST['mobileno'])) {
            $_SESSION['error'] .= "<li>Component should be selected.</li>";
        }
        
        if (empty($_SESSION['error'])) {
            $login_id = $_POST['login_id'];
//            $caption = addslashes(trim($_POST['caption']));
            $caption = "";
            $description = trim($_POST['description']);
            //$description  =  substr($description,3,(strlen($description))-4);
           $description = str_replace( array( '\'', '<p>',
                '</p>','<p>'), '',  $description);

            $number_count = addslashes(trim($_POST['numbercount']));
            $mobile_no = explode("\n", $_POST['mobileno']);
            $unique_id = $_SESSION['user_unique_id'];
            
            $camp_unique_id = "WP-" . rand(11111111, 99999999);

            $created_date = date("Y-m-d H:i:s");
            $sort_date = date("Y-m-d");

            $conn1 = new mysqli($servername, $username, $password, $dbname);
            if ($conn1->connect_error) {
                die("Connection failed: " . $conn1->connect_error);
            }
            $stmt1 = $conn1->prepare("SELECT count(login_id) FROM `send_wp_msgs` WHERE `login_id` = ? and `sort_date_wise` = ?");
            $stmt1->bind_param("is", $login_id, $sort_date);
            $stmt1->execute();
            $stmt1->bind_result($today_total_cam_count);
            $stmt1->fetch();
            $conn1->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $mob = count($mobile_no);
            if ($credit >= $mob) {

                $tempmob = implode(",",$mobile_no);
                $nums =  str_replace("\r","",$tempmob);
                $message = nl2br($_POST['description']);
                $stmt = $conn->prepare("INSERT INTO `send_wp_msgs`(login_id,`campaign_unique_id`,`campaign_name`, `message`, `number_count`,`updated_at`,`created_at`,`sort_date_wise`) VALUES (?,?,?,?,?,?,?,?)");
                $stmt->bind_param("isssisss", $login_id, $camp_unique_id, $caption, $message, $number_count, $created_date, $created_date, $sort_date);
                if ($stmt->execute()) {
                    $wp_insert_id = $stmt->insert_id;

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $stmt = $conn->prepare("INSERT INTO `wp_mobile_listings`(`mobile_no`, `send_wp_msgs_id`, `created_at`, `sort_date`) VALUES (?,?,?,?)");
                    // echo count($component_name_array);
                    for ($i = 0; $i < count($mobile_no); $i++) {
                        $mobile_number = $mobile_no[$i];
                        $stmt->bind_param("siss", $mobile_number, $wp_insert_id, $created_date, $sort_date);
                        $stmt->execute();

                        $conn1 = new mysqli($servername, $username, $password, $dbname);
                        if ($conn1->connect_error) {
                            die("Connection failed: " . $conn1->connect_error);
                        }
                        $stmt1 = $conn1->prepare("update logins set credit = credit - 1 where logins.user_unique_id =? ");
                        $stmt1->bind_param("s", $unique_id);
                        $stmt1->execute();
                        $conn1->close();
                    }
                    $conn->close();
                    $_SESSION['hc_id'] = $wp_insert_id;
                    $_SESSION['success'] = " Submitted Successfully!";

                }
                //$conn->close();

                unset($_SESSION['error']);
                header("Location: sendwhatsapp.php");
                exit();
                    
            }
            $_SESSION['error'] = "Insufficient Balance.";
            header("Location: sendwhatsapp.php");
            exit();

        } else {
            header("Location: sendwhatsapp.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Insufficient Fund.";
        header("Location: sendwhatsapp.php");
        exit();
    }
}
?>
