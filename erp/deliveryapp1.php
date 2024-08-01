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
                <h4 class="page-title">Whatsapp Report</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Whatsapp Report</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <?php if (isset($_GET['deleted'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        deleted Successfully!
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($_GET['error1'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error deleting image.Please Try Again!
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['success'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                </div>
            </div>
        <?php }

        if (isset($_SESSION['error'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                </div>
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

        <?php

        if (isset($_GET['action'])) {
        if (($_GET['action']) == 'view' && ($_GET['unique_id'])) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT
                                                send_wp_msgs.id,
                                                `campaign_unique_id`,
                                                `campaign_name`,
                                                `message`,
                                                `image-1`,
                                                `image-2`,
                                                `image-3`,
                                                `image-4`,
                                                `upload_pdf`,
                                                `send_audio`,
                                                `send_video`,
                                                `dp_image`,
                                                 send_wp_msgs.status,
                                                send_wp_msgs.created_at,
                                                logins.username,
                                                logins.user_type
                                            FROM
                                                `send_wp_msgs`
                                            Left Join logins on logins.id = send_wp_msgs.login_id    
                                            WHERE
                                                campaign_unique_id = ?");
        $stmt->bind_param("s", $_GET['unique_id']);
        $stmt->execute();
        $stmt->bind_result($camp_id, $camp_unique_id, $camp_name, $camp_msg, $photo1, $photo2, $photo3, $photo4, $up_pdf, $audio, $video, $dp_image, $camp_status, $camp_created_at, $created_by, $created_user_type);
        $stmt->fetch();
        $conn->close();
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="col-md-12"><a href="deliveryapp.php"
                                              class="btn btn-info pull-right">Back</a></div>
                    <h3 class="box-title m-b-0">Campaign Wise Details</h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label " for="userName">Caption </label>
                        <div class="col-lg-10"><?php echo stripcslashes($camp_name); ?></div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label " for="userName">Message </label>
                        <div class="col-lg-10"><?php echo stripcslashes($camp_msg); ?></div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <?php if (!empty($photo1)) { ?>
                            <label class="col-lg-1 control-label " for="userName">Image-1</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo1; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo1; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo1; ?>" class="btn btn-outline-warning"
                                   title="Download" download><i class="fa fa-download"></i> Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($photo2)) { ?>
                            <label class="col-lg-1 control-label " for="userName">Image-2</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo2; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo2; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo2; ?>" title="Download"
                                   class="btn btn-outline-warning" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($photo3)) { ?>
                            <label class="col-lg-1 control-label " for="userName">Image-3</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo3; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo3; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo3; ?>" title="Download"
                                   class="btn btn-outline-warning" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($photo4)) { ?>
                            <label class="col-lg-1 control-label " for="userName">Image-4</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo4; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo4; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo4; ?>" title="Download"
                                   class="btn btn-outline-warning" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group row">
                        <?php if (!empty($up_pdf)) { ?>
                            <label class="col-lg-1 control-label" for="confirm">Pdf </label>
                            <div class="col-lg-2"><a href="admin/img/upload/pdf/<?php echo $up_pdf; ?>"
                                                     target="_blank" title="Download"
                                                     class="btn btn-outline-warning"><i
                                            class="fa fa-download"></i> Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($audio)) { ?>
                            <label class="col-lg-1 control-label" for="confirm">Audio </label>
                            <div class="col-lg-2"><a href="admin/img/upload/audio/<?php echo $audio; ?>"
                                                     title="Download" target="_blank"
                                                     class="btn btn-outline-warning"><i
                                            class="fa fa-download"></i> Download</a></div>
                        <?php } ?>
                        <?php if (!empty($video)) { ?>
                            <label class="col-lg-1 control-label" for="confirm">Video </label>
                            <div class="col-lg-2"><a href="admin/img/upload/video/<?php echo $video; ?>"
                                                     title="Download"
                                                     class="btn btn-outline-warning" download><i
                                            class="fa fa-download"></i> Download</a></div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">

                        <?php if (!empty($dp_image)) { ?>
                            <label class="col-lg-1 control-label" for="Dp Image">Dp Image</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $dp_image; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $dp_image; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $dp_image; ?>" title="Download"
                                   class="btn btn-outline-warning" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="Created At">Created At </label>
                        <div class="col-lg-10"><span class="label label-info"
                                                     style="font-size:12px;"><?php echo date_format(date_create($camp_created_at), "d-m-Y h:i"); ?></span>
                        </div>
                        <label class="col-lg-2 control-label " for="Created By">Created By </label>
                        <div class="col-lg-10"><?php echo $created_by; ?></div>
                        <label class="col-lg-2 control-label" for="Created User Type">Created User Type </label>
                        <div class="col-lg-10"><?php echo $created_user_type; ?></div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label " for="userName">Unique Id</label>
                        <div class="col-lg-4"><?php echo $camp_unique_id; ?></div>

                    </div>
                    <hr>

<!--                    <h4 class="col-lg-12 box-title m-b-0">Change Status</h4>-->
                    <button type="button" class="btn btn-warning pull-right download-excel-mobile" value="Download Excel">
                        <i class="fa fa-download"></i> Download
                    </button>
                    <br/><br/>
<!--                    <form action="process-change-status.php" method="post">-->
<!--                        <div class="form-group row">&emsp;-->
<!--                            <label class="checkbox-inline col-lg-2 col-form-label">&emsp;<input type="checkbox"-->
<!--                                                                                                name="select_all"-->
<!--                                                                                                value=""-->
<!--                                                                                                id="select_all"-->
<!--                                                                                                style="width:18px;height:18px;">&emsp;Check-->
<!--                                All&emsp;</label>-->
<!--                            <Select class="col-lg-3 form-control" name="chg-status" required>-->
<!--                                <option value="" selected disabled>---Change Status----</option>-->
<!--                                <option value="pending">Pending</option>-->
<!--                                <option value="process">Process</option>-->
<!--                                <option value="delivered">Delivered</option>-->
<!--                                <option value="discard">Discard</option>-->
<!--                            </Select>-->
<!--                            <button type="submit" name="submit"-->
<!--                                    class="btn btn-success col-lg-2 waves-effect waves-light m-l-10 m-r-5">Submit-->
<!--                            </button>-->
<!--                        </div>-->

                        <div class="table-responsive" style="display: none;">
                            <table id="myTableMobile" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Unique Id</th>
                                    <th>Mobile No.</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include_once 'db_config.php';
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT wp_mobile_listings.id, `mobile_no`, wp_mobile_listings.status, send_wp_msgs_id, wp_mobile_listings.created_at FROM `wp_mobile_listings` 
                                            Left Join  send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                            where send_wp_msgs.campaign_unique_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $_GET['unique_id']);
                                if ($stmt->execute()) {
                                    $stmt->bind_result($wp_id, $mobile_no, $wp_status, $camp_id , $wp_created_at);
                                    $inc = 1;
                                    while ($stmt->fetch()) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                            </td>
                                            <td><?php echo $_GET['unique_id']; ?></td>
                                            <td><?php echo $created_by; ?></td>
                                            <td><?php echo $mobile_no; ?></td>
                                            <td><?php if ($wp_status != 'discard') { ?>
                                                    <span class="label label-success"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } else { ?>
                                                    <span class="label label-danger"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo date_format(date_create($wp_created_at), "d-m-Y h:i"); ?></td>
                                        </tr>
                                        <?php $inc++;
                                    }
                                } else {

                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Mobile No.</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include_once 'db_config.php';
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT wp_mobile_listings.id, `mobile_no`, wp_mobile_listings.status, send_wp_msgs_id FROM `wp_mobile_listings` 
                                            Left Join  send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                            where send_wp_msgs.campaign_unique_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $_GET['unique_id']);
                                if ($stmt->execute()) {
                                    $stmt->bind_result($wp_id, $mobile_no, $wp_status, $camp_id);
                                    $inc = 1;
                                    while ($stmt->fetch()) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
<!--                                                <input type="hidden" name="campaign_id" value="--><?php //echo $camp_id; ?><!--">-->
<!--                                                <input type="checkbox" name="check[]" class="check"-->
<!--                                                       value="--><?php //echo $wp_id; ?><!--"-->
<!--                                                       style="width:18px;height:18px;">-->
                                            </td>

                                            <td><?php echo $mobile_no; ?></td>
                                            <td><?php echo $created_by; ?></td>
                                            <td><?php if ($wp_status != 'discard') { ?>
                                                    <span class="label label-success"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } else { ?>
                                                    <span class="label label-danger"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $inc++;
                                    }
                                } else {

                                }
                                ?>
                                </tbody>
                            </table>
<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Edit -->
    <?php }
    } else {
        if (isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['unique_id']) && !empty($_GET['unique_id'])) { ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Mobile No.</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include_once 'db_config.php';
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT wp_mobile_listings.id, `mobile_no`, wp_mobile_listings.status, send_wp_msgs_id FROM `wp_mobile_listings` 
                                            Left Join  send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                            where send_wp_msgs.campaign_unique_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $_GET['unique_id']);
                                if ($stmt->execute()) {
                                    $stmt->bind_result($wp_id, $mobile_no, $wp_status, $camp_id);
                                    $inc = 1;
                                    while ($stmt->fetch()) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                                <input type="hidden" name="campaign_id" value="<?php echo $camp_id; ?>">
                                                <input type="checkbox" name="check[]" class="check"
                                                       value="<?php echo $wp_id; ?>"
                                                       style="width:18px;height:18px;">
                                            </td>

                                            <td><?php echo $mobile_no; ?></td>
                                            <td><?php echo $_GET['unique_id']; ?></td>
                                            <td><?php if ($wp_status != 'discard') { ?>
                                                    <span class="label label-success"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } else { ?>
                                                    <span class="label label-danger"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } ?>
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
        <?php } ?>
    <?php }
    ?>
</div>
<!-- /.container-fluid -->

<!-- /.container-fluid -->

<footer class="footer text-center">
    <script>document.write(new Date().getFullYear())</script> &copy; All rights reserved.</footer>

<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
<!-- jQuery -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="admin/bootstrap/dist/js/tether.min.js"></script>
<script src="admin/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!-- Alertify Plugin JavaScript -->
<script src="plugins/bower_components/alertify/alertify.min.js"></script>
<!--slimscroll JavaScript -->
<script src="admin/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="admin/js/waves.js"></script>

<!-- Magnific popup JavaScript -->
<script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!-- Custom Theme JavaScript -->
<script src="admin/js/b64toBlob.js"></script>
<script src="admin/js/custom.min.js"></script>
<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/bower_components/summernote/dist/summernote.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.6/fabric.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="admin/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="admin/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="admin/https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="admin/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="admin/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="admin/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="admin/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- Select 2 -->
<script src="plugins/bower_components/select2/dist/js/select2.min.js"></script>

<!--<script src="vendor/ckeditor/ckeditor.js"></script>-->
<!-- end - This is for export functionality only -->

<script>

    $(".download-excel-mobile").on("click", function () {
        table.button('.buttons-csv').trigger();
    });
    var table = $('#myTableMobile').DataTable();
    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'csvHtml5',
                title: 'mobile_no_excel',
                text: 'Download',

            }
        ]
    });

    $(document).ready(function () {
        $("#myTable").DataTable();

//        $('.download-excel').on('click',function() {
//            $('#myTable1').DataTable(
//                {
//                    dom: 'Bfrtip',
//                    buttons: [
//                        {
//                            extend: 'csvHtml5',
//                            title: 'Excel'
//                        }
//                    ]
//                }
//            );
//        });


        $('#select_all').on('click', function () {
            if (this.checked) {
                $('.check').each(function () {
                    this.checked = true;
                });
            } else {
                $('.check').each(function () {
                    this.checked = false;
                });
            }
        });
        $('.check').on('click', function () {

            if ($('.check:checked').length == $('.check').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
        $(".campaign_id").on('change', function () {
            //event.preventDefault();
            var settle = $(this).val();
            $('#camp_id').val(settle);
        });

        var $modal = $('.modal');

        /*GET Cities*/
        $('.select-state').on('change', function () {
            //alert($('#'+$(this).attr('data-iid')).val());
            $('.select-city').html("<option value=''>Loading .....</option>");
            var cn = $(this).val();
            $.ajax({
                type: "POST", url: "api/get-cities.php",
                data: {
                    id: cn
                },
                cache: false,
                success: function (response) {
                    console.warn(response);
                    if (response.success == true) {
                        $('.select-city').html(response.data);
                        //alertify.success('Unit of ' + vname +' Updated!');
                    }
                    else {
                        //alertify.error('Error updating unit of ' + vname + response);
                    }
                }
                /*loading:*/
            });
        });

// Show loader & then get content when modal is shown
        $modal.on('show.bs.modal', function (e) {
            var orderid = $(e.relatedTarget).data('orderid');
            var dborder = $(e.relatedTarget).data('dborder');
            //alert(paragraphs);
            $(this)
                .addClass('modal-scrollfix')
                .find('.modal-body')
                .html('loading...')
                .load('api/order-detail.php?id=' + dborder, function () {
                    // Use Bootstrap's built-in function to fix scrolling (to no avail)
                    $modal
                        .removeClass('modal-scrollfix')
                        .modal('handleUpdate');
                });

            $(this)
                .find('.modal-title')
                .html("<strong>Order: " + orderid + "</strong>");
        });
        alertify.set('notifier', 'position', 'bottom-left');
        $('.save-price').on('click', function () {
            //alert($('#'+$(this).attr('data-iid')).val());
            var new_price = $('#' + $(this).attr('data-iid')).val();
            var vid = $(this).attr('data-pid');
            var new_unit = $('#punit-' + vid).val();
            //alert(new_unit);
            var vname = $('#' + $(this).parent().parent().attr('id') + " .vname").html();
            //alert(new_price);
            //alert(vname);
            $.ajax({
                type: "POST", url: "api/update-price.php",
                data: {
                    id: vid,
                    price: new_price,
                    unit: new_unit
                },
                cache: false,
                success: function (response) {
                    if (response == 'success') {
                        alertify.success('Unit of ' + vname + ' Updated!');
                    }
                    else {
                        alertify.error('Error updating unit of ' + vname + response);
                    }
                }
            });
        });
        $('.price-input').on('keyup', function () {
            //alert($(this).parent().parent().attr('id'));
            $('#' + $(this).parent().parent().attr('id') + " .save-btn-td .btn").prop('disabled', false).removeClass('disabled');
        });
        $('.update-unit').on('change', function () {
            //alert($(this).parent().parent().attr('id'));
            $('#' + $(this).parent().parent().attr('id') + " .save-btn-td .btn").prop('disabled', false).removeClass('disabled');
        });
        //alertify.success('Success message');
        setTimeout(function () {
            $('.alert').fadeOut(1000)
        }, 5000);
        $('.zoom-mp-img').magnificPopup({
            type: 'image'
            // other options
        });


        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
        $('#cat').on('change', function () {
            if ($(this).val() == 1) {
                $('.hide-laminates').hide();
                $('.hide-laminates #sfile').removeAttr('required');
            }
            else if ($(this).val() == 2) {
                $('.hide-laminates #sfile').removeAttr('required');
            }
            else {
                $('.hide-laminates').show();
                $('.hide-laminates #sfile').attr('required', 'required');
            }
        });
    });
    $(document).ready(function () {
        $('.select-multiple').select2();
        $('.select-multiple').select2({
            placeholder: 'Select an options'
        });
    });
    //    CKEDITOR.replace( 'description' );

    function countline() {
        var length = $('#mobileno').val().split("\n").length;
        document.getElementById("numbercount").value = length;
    }
</script>
</body>
</html>


