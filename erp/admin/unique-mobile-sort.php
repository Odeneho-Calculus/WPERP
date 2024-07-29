<?php
date_default_timezone_set('Asia/Kolkata');
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

$dbname = "mnuqwqzytq";
define("DB_USER", "mnuqwqzytq");
define("DB_PASS", "XgF72weMEr");

$servername = "localhost";
define("DB_DSN", "mysql:host=$servername;dbname=$dbname;charset=utf8mb4");
define("DB_NAME", $dbname);

try {
    $conn = new PDO(DB_DSN, DB_USER, DB_PASS);
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed!!" . $e->getMessage();
}



if (isset($_POST["search_result"])) {


    $first_unique_id  = trim($_POST["first_unique"]);
    $second_unique_id  = trim($_POST['second_unique']);
    $data= [];
    $conn1 = new mysqli($servername, $username, $password, $dbname);
    if ($conn1->connect_error) {
        die("Connection failed: " . $conn1->connect_error);
    }
    $stmt1 = $conn1->prepare("SELECT id FROM `send_wp_msgs` where campaign_unique_id IN ('$first_unique_id', '$second_unique_id') ");
    $stmt1->execute();
    $stmt1->bind_result($unique_id);
    while($stmt1->fetch()){
            $data[] = array(
                    "unique_id" => $unique_id
            );
    }
    $conn1->close();
    if(!empty($data) && isset($data[0]['unique_id']) && isset($data[1]['unique_id'])) {
            $first_uni_id = $data[0]['unique_id'];
            $second_uni_id = $data[1]['unique_id'];
    }else{
        $first_uni_id = "";
        $second_uni_id = "";
    }

//        $query = $conn->prepare("SELECT  * FROM  student_exam_login std_class on std_class.id = student_exam_login.std_class_id WHERE std_class_id= '$class_id'");
                $query = $conn->prepare("SELECT
                                                mobile_no,
                                                status,
                                                created_at
                                            FROM
                                                `wp_mobile_listings`
                                            WHERE send_wp_msgs_id IN ('$first_uni_id', '$second_uni_id')
                                            GROUP BY
                                                mobile_no
                                            HAVING
                                                COUNT(*) > 1");
        $query->execute();
        $row = $query->fetchAll();

//    $row = $query->fetchAll();
    ?>
    <div class="white-box" id="imge-popups">
    <h3 class="box-title m-b-0" id="fame">LIST OF all Mobile No</h3>
    <table id="example4" class="table  table-responsive table-bordered table-striped dataTable">
        <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Mobile No.</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($row)) {
            $i = 0;
            foreach ($row as $r) {
                $i++;
                ?>
                <tr>
                    <td>
                        <?php echo $i; ?></td>
                    <td><?php echo $r['mobile_no']; ?></td>
                    <td><?php if ($r['status'] != 'discard') { ?>
                            <span class="label label-success"
                                  style="text-transform: capitalize; font-size: 12px;"><?php echo $r['status']; ?></span>
                        <?php } else { ?>
                            <span class="label label-danger"
                                  style="text-transform: capitalize; font-size: 12px;"><?php echo $r['status']; ?></span>
                        <?php } ?>
                    </td>
                    <td><?php echo date_format(date_create($r['created_at']), "d-m-Y"); ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No records found</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    </div>
    <?php
}
?>