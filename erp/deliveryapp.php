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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
<!-- Page Content -->
<div  id="page-wrapper">
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

        <div  class="row">
            <div class="col-sm-12">
                <div style="border: 3px solid rgb(179,0,179);" class="white-box">
                    <div class="col-sm-8">
                        <form action="" method="">
                            <input type="date" class="datepicker" value="" name="startdate"
                                   placeholder="Please enter start date" required>
                            <input type="date" class="datepicker" value="" name="enddate"
                                   placeholder="Please enter end date" required>
                            <button style="background-image: linear-gradient(rgb(255, 0, 234),rgb(109, 0, 168));border-radius:5px" type="button" name="search_result" onclick="getResult()"
                                    class="btn btn-info">Search

                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div style="border: 3px solid rgb(179,0,179);" class="white-box" id="imge-popups">
                    <div class="table-responsive" style="display: none;">
                        <table id="d_table" class="table table-striped">
                            <thead>
                            <tr>
                                <th><b>Sr. No.</b></th>
                                <th><b>Unique Id</b></th>
                                <th><b>Campaign Name</b></th>
                                <th><b>Message</b></th>
                                <th><b>Total Mob No.</b></th>
                                <th><b>Created At</b></th>
                                <th><b>Created By</b></th>
                                <th><b>Created User Type</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php include_once 'db_config.php';
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
                                        <td><b><?php echo stripcslashes($campaign_name); ?></b></td>
                                        <td><?php echo stripcslashes($message); ?></td>
                                        <td><?php echo stripcslashes($number_count); ?></td>
                                        <td><?php echo date_format(date_create($created_at), "d-m-Y h:s"); ?></td>
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
<!--                    <input type="hidden" value="" name="startdate">-->
<!--                    <input type="hidden" value="" name="enddate">-->
                    <button style="background-image: linear-gradient(rgb(255, 0, 234),rgb(109, 0, 168));border-radius:5px" type="button" class="btn btn-warning pull-right download-excel" value="Download Excel">
                        <i style="background-image: linear-gradient(rgb(255, 0, 234),rgb(109, 0, 168))" class="fa fa-download"></i> Download
                    </button>

                    <br/>
<!--                    <form action="process-change-status.php" method="post">-->
<!--                        <div class="col-sm-5 offset-sm-3">-->
<!--                            <Select class="form-control" name="change-status" required>-->
<!--                                <option value="" selected disabled>---Change Status----</option>-->
<!--                                <option value="pending">Pending</option>-->
<!--                                <option value="process">Process</option>-->
<!--                                <option value="delivered">Delivered</option>-->
<!--                                <option value="discard">Discard</option>-->
<!--                            </Select>-->
<!--                            <br/>-->
<!--                            <button type="submit" name="submit-status" class="btn btn-success pull-right" value="">-->
<!--                                Submit-->
<!--                            </button>-->
<!--                            <br>-->
<!---->
<!--                        </div>-->
                        <h3 class="box-title m-b-0" id="fame" style="font-family: 'Josefin Sans', sans-serif;font-size:22px"> <b>LIST OF all Campaign Wise</b></h3>
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
                                     <th><b>Sr. No.</b></th>
                                <th><b>Unique Id</b></th>
                                <th><b>Campaign Name</b></th>
                                <th><b>Message</b></th>
                                <th><b>Total Mob No.</b></th>
                                <th><b>Created At</b></th>
                                <th><b>Created By</b></th>
                                <th><b>Created User Type</b></th>
                                </tr>
                                </thead>
                                <tbody style="color:black;">
                                <?php include_once 'db_config.php';
                                $parent_id = $_SESSION['login_id'];
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
                                            where send_wp_msgs.login_id =  '$parent_id' or logins.parent_id = $parent_id
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
                                            <td><b><p id="t<?php echo $inc; ?>"> 0h 0m 0s </p></b></td>
<!--                                            <td><input type="radio" name="campaign_id" id="campaign_id"-->
<!--                                                       class="form-control campaign_id"-->
<!--                                                       value="--><?php //echo $campaign_id; ?><!--"-->
<!--                                                       style="width:23px;cursor:pointer;" required>-->
<!--                                            </td>-->
                                            <td><?php echo $campaign_unique_id; ?></td>
<!--                                            <td><b>--><?php //echo stripcslashes($campaign_name); ?><!--</b></td>-->
                                            <td style="word-wrap: break-word;max-width: 250px;"><?php echo stripcslashes($message); ?></td>
                                            <td><?php echo stripcslashes($number_count); ?></td>
                                            <td><?php echo date_format(date_create($created_at), "d-m-Y H:i"); ?></td>
                                            <td><?php echo $login_created_by; ?></td>
                                            <td><?php echo $login_user_type; ?></td>
<!--                                            <td>--><?php //if ($status != 'discard') { ?>
<!--                                                    <span class="label label-success"-->
<!--                                                          style="text-transform: capitalize; font-size: 12px;">--><?php //echo $status; ?><!--</span>-->
<!--                                                --><?php //} else { ?>
<!--                                                    <span class="label label-danger"-->
<!--                                                          style="text-transform: capitalize; font-size: 12px;">--><?php //echo $status; ?><!--</span>-->
<!--                                                --><?php //} ?>
<!--                                            </td>-->
                                            <td>
                                                <a href='deliveryapp1.php?action=view&unique_id=<?php echo $campaign_unique_id; ?>'
                                                   class='btn btn-circle btn-info btn-sm'
                                                   title='View Details'><i
                                                            class='fa fa-eye'></i></a>
                                                <a href='export-report.php?unique_id=<?php echo $campaign_unique_id; ?>&username=<?php echo $login_created_by; ?>'
                                                   class='btn btn-circle btn-warning btn-sm'
                                                   title='Download Excel' id="dl" ><i
                                                            class='fa fa-download'></i></a>
                                                <a href="../admin/updated/<?= $campaign_unique_id;?>.xlsx" target="_blank" class="btn btn-success"><i
                                                            class='fa fa-file-excel-o'></i></a>
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

<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.container-fluid -->

<footer class="footer text-center"> Copyright &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved.</footer>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="admin/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="admin/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="admin/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="admin/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- Select 2 -->
<script src="plugins/bower_components/select2/dist/js/select2.min.js"></script>

<!--<script src="vendor/ckeditor/ckeditor.js"></script>-->
<!-- end - This is for export functionality only -->
<script>
    setInterval(function () {

        get_timer();

    }, 1000);

    function get_timer()
    {
        $.getJSON("countdown1.php", function(data) {
            $.each(data, function(index) {
                $('#t'+data[index].id).text(data[index].time1);
            });
        });
    }
</script>
<script>
    function getResult() {

        $("#loader_div").show();

        var first_date = $("input[name='startdate']").val();
        var second_date = $("input[name='enddate']").val();
        if (first_date == "" && second_date == "") {
            $("#all-empty").show();
        } else {
           /* alert(first_date);*/
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    $("#result_div").show();
                    $("#loader_div").hide();
                    document.getElementById("result_div").innerHTML = xmlhttp.responseText;
                    $('#example3').DataTable(
                        {   "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                            dom: 'Bfrtip',
                            buttons: [{
                                extend: 'csvHtml5',
                                title: 'Campaign-record-excel',
                                text: 'Download Excel',
                            }
                            ]
                        });
                    $("#table-hide").css("display", "none");
                }
            };
            xmlhttp.open("POST", "datewise-sort.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("&first_date=" + first_date + "&second_date=" + second_date + "&search_result");
        }
    }
</script>
<script>

    $(".download-excel").on("click", function () {
        table.button('.buttons-csv').trigger();
    });
    var table = $('#d_table').DataTable();
    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'csvHtml5',
                title: 'Campaign-record-excel',
                text: 'Download Excel',
            }
        ]
    });

    $(document).ready(function () {
        $("#d_table-1").DataTable();

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

