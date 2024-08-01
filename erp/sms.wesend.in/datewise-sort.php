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
if ($_SESSION['login_type'] == 'admin') {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}

$dbname = "submission";
$password = "Devendra1234#";
define("DB_USER", "submission");
define("DB_PASS", "Devendra1234#");

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


    $from_date  = $_POST["first_date"];
    $to_date = $_POST['second_date'];
    $parent_id = $_SESSION['login_id'];

//        $query = $conn->prepare("SELECT  * FROM  student_exam_login std_class on std_class.id = student_exam_login.std_class_id WHERE std_class_id= '$class_id'");
        $query = $conn->prepare("SELECT
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
                                            WHERE login_id = '$parent_id' and send_wp_msgs.sort_date_wise between  
                                            '$from_date' and '$to_date' 
                                            ORDER BY
                                               send_wp_msgs.id
                                            DESC");
        $query->execute();
        $row = $query->fetchAll();

//    $row = $query->fetchAll();
    ?>
    <table id="example3" class="table table-responsive table-bordered table-striped dataTable">
        <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Update Status</th>
            <th>Unique Id</th>
            <th>Caption</th>
            <th>Message</th>
            <th>Total Mob No.</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Created User Type</th>
            <th>Status</th>
            <th>Action</th>
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

                    <td><input type="radio" name="campaign_id" id="campaign_id"
                               class="form-control campaign_id"
                               value="<?php echo $r['id']; ?>"
                               style="width:23px;cursor:pointer;" required>
                    </td>
                    <td><?php echo $r['campaign_unique_id']; ?></td>
                    <td><b><?php echo stripcslashes($r['campaign_name']); ?></b></td>
                    <td style="word-wrap: break-word;max-width: 250px;"><?php echo stripcslashes($r['message']); ?></td>
                    <td><?php echo stripcslashes($r['number_count']); ?></td>
                    <td style="border:2px solid lightskyblue;"><?php echo date_format(date_create($r['created_at']), "d-m-Y h:s"); ?></td>
                    <td><?php echo $r['username']; ?></td>
                    <td><?php echo $r['user_type']; ?></td>
                    <td><?php if ($r['status'] != 'discard') { ?>
                            <span class="label label-success"
                                  style="text-transform: capitalize; font-size: 12px;"><?php echo $r['status']; ?></span>
                        <?php } else { ?>
                            <span class="label label-danger"
                                  style="text-transform: capitalize; font-size: 12px;"><?php echo $r['status']; ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href='deliveryapp1.php?action=view&unique_id=<?php echo $r['campaign_unique_id']; ?>'
                           class='btn btn-circle btn-info btn-sm'
                           title='View Details'><i
                                class='fa fa-eye'></i></a>
                        <a href='export-report.php?unique_id=<?php echo $r['campaign_unique_id']; ?>&username=<?php echo $r['username']; ?>'
                           class='btn btn-circle btn-warning btn-sm'
                           title='Download Excel' id="dl" ><i
                                class='fa fa-download'></i></a>
                    </td>
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
    <?php
}
?>