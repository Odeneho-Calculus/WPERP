<?php
session_start();

// Check login status
if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] != 1 || $_SESSION['login_type'] != 'admin') {
    header("Location: process_login.php");
    exit();
}
?>

<head>
    <title>Contact</title>
</head>

<?php
include_once 'db_config.php';
include_once 'header.php'; 

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch contact info
$stmt = $conn->prepare("SELECT mobile, email, description FROM contactus");
$stmt->execute();
$stmt->bind_result($mob_no, $email_id, $desc);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Contact Us</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Contact Us</li>
                </ol>
            </div>
        </div>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Deleted Successfully!
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error1'])): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error deleting image. Please try again!
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Stored Successfully!
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error adding store. Please try again!
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success2'])): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Edited Successfully!
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error2'])): ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error in editing. Please try again!
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <style>
            .formH{
                display: flex; justify-content: center; align-items: center;
            }

            .white-box{
                width: 50%; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); border-radius: 8px;

            }
            
        </style>

        <!-- Contact Form -->
        <div class="row">
            <div class="col-sm-12 formH">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Contact Us</h3>
                    <br>
                    <form class="form" method="post" action="process-contact-us.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="mobile" class="col-2 col-form-label">Mobile No</label>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Mobile" name="mobile"
                                       id="mobile" value="<?php echo htmlspecialchars($mob_no); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email Id</label>
                            <div class="col-6">
                                <input class="form-control" type="email" placeholder="Email" name="email"
                                       id="email" value="<?php echo htmlspecialchars($email_id); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-2 col-form-label">Description</label>
                            <div class="col-6">
                                <textarea name="description" id="description" class="form-control"
                                          placeholder="Description" cols="10" rows="2"><?php echo htmlspecialchars($desc); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-8">
                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
</div>
