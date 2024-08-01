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
if ($_SESSION['login_type'] == 'admin') {
    $_SESSION['login_status'] = 0;
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
        <?php if (isset($_GET['added'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Updated Successfully!
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($_GET['error1'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error in adding credit.Please Try Again!
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

        if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p><?php if (isset($_SESSION['error'])){ ?>
                <ul class="error-ul">
                    <?php echo $_SESSION['error'];
                    ?>
                </ul>
                <?php
                unset($_SESSION['error']);
                } ?>
                </p>
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

                <?php
                if (isset($_GET['action'])) {
                    // Add
                    if (($_GET['action']) == 'add') { ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="col-md-12"><a href="reseller.php"
                                                              class="btn btn-info pull-right">Back</a></div>
                                    <h3 class="box-title m-b-0">Add New Reseller</h3>
                                    <span class="mandatory"><small>(Note: All * fields are mandatory)</small></span>
                                    <br/><br/>
                                    <form class="form" method="post" action="process-add-reseller.php"
                                          enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <label for="title" class="col-lg-2 col-form-label">Fullname <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Fullname"
                                                       name="rslr_fullname"
                                                       id="rslr_fullname" required>
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Username <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Username"
                                                       name="rslr_username"
                                                       id="username" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="title" class="col-lg-2 col-form-label">Email Id <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="email" placeholder="Email"
                                                       name="rslr_email"
                                                       id="rslr_email" required>
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Company </label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Company"
                                                       name="rslr_company"
                                                       id="rslr_company">
                                            </div>
<!--                                            <label for="title" class="col-lg-2 col-form-label">Password <span-->
<!--                                                        class="mandatory">*</span></label>-->
<!--                                            <div class="col-lg-4">-->
<!--                                                <input class="form-control" type="text" placeholder="Password"-->
<!--                                                       name="rslr_pwd"-->
<!--                                                       id="reseller_pwd" required>-->
<!--                                            </div>-->
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-2 col-form-label">Mobile <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" placeholder="Mobile"
                                                       name="rslr_mobile"
                                                       id="rslr_mobile">
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Status </label>
                                            <div class="col-lg-4">
                                                <select name="status" id="" class="form-control">
                                                    <option value="Active" class="">Active</option>
                                                    <option value="Inactive" class="">Inactive</option>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <label for="photo" class="col-lg-2 col-form-label">Profilepic
                                                <small>(300 x 300px)</small>
                                            </label>
                                            <div class="col-lg-4">
                                                <input type="file" id="photo" name="photo" class="form-control"
                                                       accept="image/png,image/jpeg">
                                                <p class="help-block text-danger">
                                                    <small>Photo should be smaller than 500 KB. Only JPG and PNG are
                                                        allowed.
                                                    </small>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <button type="submit" name="submit"
                                                        class="btn btn-success waves-effect waves-light m-r-10 pull-right">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- View -->
                    <?php } elseif (($_GET['action']) == 'view' && ($_GET['unique_id'])) {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $stmt = $conn->prepare("SELECT `id`, `full_name` ,`username`, `email_id`, `pwd`, `company`, profilepic,  `mobile`, `credit`, `status` FROM `logins` WHERE  user_unique_id = ?");
                        $stmt->bind_param("s", $_GET['unique_id']);
                        $stmt->execute();
                        $stmt->bind_result($r_id, $r_fullname, $r_username, $r_email_id, $r_pwd, $r_company, $r_profile, $r_mobile, $credit, $status);
                        $stmt->fetch();
                        $conn->close();
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="col-md-12"><a href="reseller.php"
                                                              class="btn btn-info pull-right">Back</a></div>
                                    <h3 class="box-title m-b-0">View Reseller Details</h3>

                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">Fullname <span
                                                    class="mandatory">*</span></label>
                                        <div class="col-lg-4"><?php echo $r_fullname; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">User Name <span
                                                    class="mandatory">*</span></label>
                                        <div class="col-lg-4"><?php echo $r_username; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">Email Id <span
                                                    class="mandatory">*</span></label>
                                        <div class="col-lg-4"><?php echo $r_email_id; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">Password <span
                                                    class="mandatory">*</span></label>
                                        <div class="col-lg-4"><?php echo $r_pwd; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">mobileno <span
                                                    class="mandatory">*</span></label>
                                        <div class="col-lg-4"><?php echo $r_mobile; ?></div>
                                        <label class="col-lg-2 control-label " for="userName">company </label>
                                        <div class="col-lg-4"><?php echo $r_company; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="userName">profilepic </label>
                                        <div class="col-lg-4">
                                            <?php if (!empty($r_profile)) { ?>
                                                <a href="../admin/img/upload/<?php echo $r_profile; ?>"
                                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                                    <img src="../admin/img/upload/<?php echo $r_profile; ?>"
                                                         style="width:60px; height:60px;">
                                                </a>
                                            <?php } else { ?>
                                                <a href="../admin/img/upload/user.png"
                                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                                    <img src="../admin/img/upload/user.png"
                                                         style="width:60px; height:60px;">
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <label class="col-lg-2 control-label " for="userName">Create By </label>
                                        <div class="col-lg-4"> <?php echo $_SESSION['login_user']; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="confirm">Status</label>
                                        <div class="col-lg-4">
                                            <?php
                                            if ($status == 'Active') {
                                                ?>
                                                <strong style="color:green;">Active</strong>
                                            <?php } else { ?>
                                                <strong style="color:red;">Inactive</strong>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Edit -->
                    <?php } elseif (($_GET['action']) == 'edit' && ($_GET['unique_id']) && ($_GET['rollback'])) {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $stmt = $conn->prepare("SELECT `id`, `full_name` ,`username`, `email_id`, `pwd`, `company`, `profilepic`, `mobile`, `credit`,`status`, `rollback`  FROM `logins` WHERE 	user_unique_id = ?");
                        $stmt->bind_param("s", $_GET['unique_id']);
                        $stmt->execute();
                        $stmt->bind_result($r_id, $r_fullname, $r_username, $r_email_id, $r_pwd, $r_company, $r_profile, $r_mobile, $credit, $status, $rollback_status);
                        $stmt->fetch();
                        $conn->close();
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="col-md-12"><a href="reseller.php"
                                                              class="btn btn-info pull-right">Back</a></div>
                                    <h3 class="box-title m-b-0">Edit Reseller Details</h3>
                                    <span class="mandatory"><small>(Note: All * fields are mandatory)</small></span>
                                    <br/><br/>
                                    <form class="form" method="post" action="process-edit-reseller.php"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="usr_unique_id" id="usr_unique_id"
                                               value="<?php echo $_GET['unique_id']; ?>">
                                        <div class="form-group row">
                                            <label for="title" class="col-lg-2 col-form-label">Fullname <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Fullname"
                                                       name="rslr_fullname"
                                                       id="rslr_fullname" value="<?php echo $r_fullname; ?>" required>
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Username <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Username"
                                                       name="rslr_username"
                                                       id="username" value="<?php echo $r_username; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="title" class="col-lg-2 col-form-label">Email Id <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="email" placeholder="Email"
                                                       name="rslr_email"
                                                       id="rslr_email" value="<?php echo $r_email_id; ?>" required>
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Password <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Password"
                                                       name="rslr_pwd"
                                                       id="reseller_pwd" value="<?php echo $r_pwd; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-lg-2 col-form-label">Mobile <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Mobile"
                                                       name="rslr_mobile"
                                                       id="rslr_mobile" value="<?php echo $r_mobile; ?>">
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Company <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" placeholder="Company"
                                                       name="rslr_company"
                                                       id="rslr_company" value="<?php echo $r_company; ?>" required>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="photo" class="col-lg-2 col-form-label">Profilepic
                                                <small>(300 x 300px)</small>
                                            </label>
                                            <div class="col-lg-4">
                                                <?php if (!empty($r_profile)) { ?>
                                                    <a href="../admin/img/upload/<?php echo $r_profile; ?>"
                                                       class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                                        <img src="../admin/img/upload/<?php echo $r_profile; ?>"
                                                             style="width:60px; height:60px;">
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="../admin/img/upload/user.png"
                                                       class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                                        <img src="../admin/img/upload/user.png"
                                                             style="width:60px; height:60px;">
                                                    </a>
                                                <?php } ?>
                                                <input type="file" id="photo" name="photo" class="form-control"
                                                       accept="image/png,image/jpeg">
                                                <p class="help-block text-danger">
                                                    <small>Photo should be smaller than 500 KB. Only JPG and PNG are
                                                        allowed.
                                                    </small>
                                                </p>
                                            </div>
                                            <label for="title" class="col-lg-2 col-form-label">Status <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-4">
                                                <select name="status" id="" class="form-control">
                                                    <?php if ($status == 'Active') { ?>
                                                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                        <option value="Inactive">Inactive</option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                        <option value="Active">Active</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!---- rollback---------->

                                        <?php if($_GET['rollback'] == "Enable"){ ?>

                                        <label for="title" class="col-lg-2 col-form-label">Rollback </label>

                                        <input type="radio" name="rollback" value="enable"
                                               style="width:22px; height:22px;"
                                            <?php if ($rollback_status == "Enable") {
                                                echo "checked";
                                            }?>>&emsp;Enable

                                        &nbsp; <input type="radio" name="rollback" value="disable"
                                                      style="width:22px; height:22px;"
                                            <?php if ($rollback_status == "Disable") {
                                                echo "checked";
                                            }?>>&emsp;Disable

                                       <?php } ?>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <button type="submit" name="submit"
                                                        class="btn btn-success waves-effect waves-light m-r-10 pull-right">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Credit -->
                    <?php } elseif (($_GET['action']) == 'credit' && ($_GET['unique_id'])) { ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="col-md-12"><a href="reseller.php"
                                                              class="btn btn-info pull-right">Back</a></div>
                                    <h3 class="box-title m-b-0">Add Credit </h3>
                                    <span class="mandatory"><small>(Note: All * fields are mandatory)</small></span>
                                    <br/><br/>
                                    <form class="form" method="post" action="process-add-credit.php"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
                                        <input type="hidden" name="unique_id" value="<?php echo $_GET['unique_id']; ?>">
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="userName">No of SMS <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control required" id="no_of_sms"
                                                       name="no_of_sms" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="userName">Per SMS price <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control required" id="per_sms_price"
                                                       name="per_sms_price" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="userName">Tax Included </label>
                                            <div class="col-lg-6">
                                                <input type="checkbox" class="form-control required" id="is_tax"
                                                       name="is_tax" value="Yes">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="description">Description <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control required" id="description"
                                                          name="description" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8">
                                                <button type="submit" name="submit"
                                                        class="btn btn-success pull-right">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Remove Credit -->
                    <?php } elseif (($_GET['action']) == 'debit' && ($_GET['unique_id'])) { ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="col-md-12"><a href="reseller.php"
                                                              class="btn btn-info pull-right">Back</a></div>
                                    <h3 class="box-title m-b-0">Subtract Credit</h3>
                                    <span class="mandatory"><small>(Note: All * fields are mandatory)</small></span>
                                    <br/><br/>
                                    <form class="form" method="post" action="process-remove-reseller-credit.php"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
                                        <input type="hidden" name="unique_id" value="<?php echo $_GET['unique_id']; ?>">
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="userName">No of SMS <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="no_of_sms"
                                                       name="no_of_sms" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="userName">Description <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control required" id="description"
                                                          name="description" rows="4" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8">
                                                <button type="submit" name="submit"
                                                        class="btn btn-success pull-right">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php }
                } else { ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box" id="imge-popups">
                                <div class="col-md-12"><a href="reseller.php?action=add"
                                                          class="btn btn-info pull-right">Add New Reseller</a></div>

                                <h3 class="box-title m-b-0" id="fame">LIST OF all Reseller</h3>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>User Type</th>
                                            <th>Fullname</th>
                                            <th>Username</th>
                                            <th>Email Id</th>
                                            <th>Credit</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php include_once 'db_config.php';
                                        $parent_id = $_SESSION['login_id'];
                                        $reseller_rollback = $_SESSION['rollback'];
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
                                        $sql = "SELECT `id`, `user_type` ,`user_unique_id`, `full_name` ,`username`, `email_id`, `mobile`, `credit`,`status` FROM `logins` WHERE `user_type`= 'reseller' and parent_id = '$parent_id' order by id desc";
                                        $stmt = $conn->prepare($sql);
                                        if ($stmt->execute()) {
                                            $stmt->bind_result($id, $user_type, $unique_id, $full_name, $username, $email_id, $mobile, $credit, $status);
                                            $inc = 1;
                                            while ($stmt->fetch()) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $inc; ?></td>
                                                    <td>
                                                        <span class="label label-info"
                                                              style='font-size: 12px;text-transform:capitalize;'><?php echo stripcslashes($user_type); ?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo stripcslashes($full_name); ?></td>
                                                    <td><?php echo stripcslashes($username); ?></td>
                                                    <td><?php echo stripcslashes($email_id); ?></td>

                                                    <td><b><?php echo stripcslashes($credit); ?></b></td>
                                                    <td><?php echo ($status == "Active") ? "<span class='label label-success' >Active</span>" : "<span class='label label-danger'>Inactive</span>"
                                                        ?></td>
                                                    <td>
                                                        <a href='reseller.php?action=view&unique_id=<?php echo $unique_id; ?>'
                                                           class='btn btn-circle btn-info btn-sm'
                                                           title='View Details'><i
                                                                    class='fa fa-eye'></i></a>
                                                        <a href='reseller.php?action=edit&unique_id=<?php echo $unique_id; ?>&rollback=<?php echo $reseller_rollback; ?>'
                                                           class='btn btn-circle btn-success btn-sm'
                                                           title='Edit Details'><i
                                                                    class='fa fa-pencil'></i></a>
                                                        <a href='reseller.php?action=credit&unique_id=<?php echo $unique_id; ?>'
                                                           class='btn btn-circle btn-warning btn-sm'
                                                           title='Fill Credit'><i
                                                                    class='fa fa-bank'></i></a>
                                                        <a title="Remove Credit"
                                                           href="reseller.php?action=debit&unique_id=<?php echo $unique_id; ?>"
                                                           class="btn btn-danger btn-circle"><i
                                                                    class="fa fa-eraser"></i> </a></td>
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
                <?php } ?>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
