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
                <h4 class="page-title">Send News</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">News</li>
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
                        deleted Successfully! </div>
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
                         News Send Successfully! </div>
                </div>
            </div>
        <?php }

        if(isset($_GET['error'])){ ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error Adding  Store. Please Try Again! </div>
                </div>
            </div>
        <?php } ?>
        <?php if(isset($_GET['success2'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Edited Successfully! </div>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Send News </h3>
                    <br>
                    <form class="form" method="post" action="process-news.php" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="title" class="col-2 col-form-label">Heading</label>
                            <div class="col-10">
                                <input class="form-control" type="text" placeholder="Heading" name="heading"
                                       id="heading" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <textarea name="message" id="" class="form-control" placeholder="Description" cols="10" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Submit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box" id="imge-popups">
                    <h3 class="box-title m-b-0" id="fame">LIST OF all News</h3>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php include_once 'db_config.php';
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql="SELECT `id`, `heading`, `description`, `created_at` FROM `news` order by id DESC";
                            //$sql = "SELECT medical_store.id, centre_name, cities.name, states.name, centre_address, contact_nos, photo FROM medical_store, cities, states WHERE medical_store.centre_state = states.id AND medical_store.centre_city = cities.id";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $stmt->bind_result($id, $title, $description, $created_date);
                                $inc=1;
                                while ($stmt->fetch()){ ?>
                                    <tr>
                                        <td><?php echo $inc; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td><?php  echo date_format(date_create($created_date),'d-m-Y h:i'); ?></td>
                                        <td>
                                            <a title="Delete Entry" href="delete-news.php?id=<?php echo $id; ?>" class="btn btn-danger btn-circle" onclick="if(!confirm('Are you sure to delete this entry?')){return false;}"><i class="fa fa-trash"></i> </a></td>
                                    </tr>
                                    <?php $inc++; }
                            }
                            else{

                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
