<?php
//fetch.php
session_start();
header('Content-Type: application/json');
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
$connect = mysqli_connect("localhost", "submission", "Devendra1234#", "submission");
$query = "SELECT * FROM logins";
$result = mysqli_query($connect, $query);
//$output = array();
while ($row = mysqli_fetch_array($result)) {
    $sub_data["id"] = $row["id"];
    $sub_data["name"] = $row["username"];
    $sub_data["text"] = $row["username"];
    $sub_data["parent_id"] = $row["parent_id"];
    $sub_data["href"] = "client-tree-details.php?id=".$row["user_unique_id"];
    $data[] = $sub_data;
}
foreach ($data as $key => &$value) {
    $output[$value["id"]] = &$value;
}
foreach ($data as $key => &$value) {
    if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
        $output[$value["parent_id"]]["nodes"][] = &$value;
    }
}
foreach ($data as $key => &$value) {
    if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
        unset($data[$key]);
    }
}
echo json_encode($data);
//echo '<pre>';
//print_r($data);
//echo '</pre>';

?>