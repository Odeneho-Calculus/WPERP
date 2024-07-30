<?php
session_start();

if (isset($_POST['uname']) || isset($_POST['upass'])) {
    include_once 'db_config.php';
    
    $_SESSION['er'] = "";
    $email_id = trim($_POST['email']);
    $upass = trim($_POST['upass']);

    // Create a new mysqli object
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        $_SESSION['er'] .= "<h4>Database connection failed: " . $conn->connect_error . "</h4>";
        header("Location: login.php");
        exit();
    }

    // Prepare the SQL statement
    $sql = "SELECT id, user_unique_id, username, pwd FROM logins WHERE user_type = 'admin' AND email_id = ?";
    $stmt = $conn->prepare($sql);

    // Check if prepare was successful
    if ($stmt === false) {
        $_SESSION['er'] .= "<h4>Prepare failed: " . $conn->error . "</h4>";
        $conn->close();
        header("Location: login.php");
        exit();
    }

    // Bind parameters and execute statement
    $stmt->bind_param("s", $email_id);
    $stmt->execute();

    // Bind results and fetch
    $stmt->bind_result($user_id, $user_unique_id, $uname, $db_upass);
    $stmt->fetch();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Debugging: Output fetched values
    // echo "<pre>";
    // echo "Fetched values: ";
    // print_r(array($user_id, $user_unique_id, $uname, $db_upass));
    // echo "</pre>";

    // Check if any result was fetched
    if ($db_upass === null) {
        $_SESSION['er'] .= "<h4>No user found with the provided email.</h4>";
        header("Location: login.php");
        exit();
    }

    // Verify password
    if ($upass === $db_upass) {
        $_SESSION['login_status'] = 1;
        $_SESSION['login_id'] = $user_id;
        $_SESSION['user_unique_id'] = $user_unique_id;
        $_SESSION['login_user'] = $uname;
        $_SESSION['login_type'] = 'admin';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['er'] .= "<h4>Incorrect Email or Password.</h4><p>Please check for valid Email and password and try again!</p>";
        header("Location: login.php");
        exit();
    }
} else {
    if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == 1) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: logout.php");
        exit();
    }
}
