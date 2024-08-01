<?php
session_start();
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
if ($_SESSION['login_type'] != 'admin') {
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
                <h4 class="page-title">Search Mobile No</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Search Mobile No</li>
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

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="col-sm-8">
                        <h3 class="box-title m-b-0">Find out Common Mobile no(Availble in both unique id)</h3>
                        <br/>
                        <form action="" method="">
                            <input type="text" class="col-sm-4" value="" name="first_unique_id"
                                   placeholder="First Unique Id" required>
                            <input type="text"  class="col-sm-4" value="" name="second_unique_id"
                                   placeholder="Second Unique Id" required>
                            <button type="button" name="search_result" onclick="getResult()"
                                    class="btn btn-info">Search
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                        <div id="loader_div" class="text-center">
                            <img id="loader">
                        </div>
                        <div class="card-body">
                            <div id="result_div">
                            </div>
                        </div>
                        <div id="all-empty" class="alert alert-danger" style="display: none;">Please Select Date for filter table
                        </div>
                </div>

        </div>
    </div>
</div>


<!-- /.container-fluid -->

<footer class="footer text-center"> Copyright &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved | Developed By <a href="https://divineinfosec.in/" target="_blank" rel="nofollow">Divine Infosec</a></footer>

<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/tether.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!-- Alertify Plugin JavaScript -->
<script src="../plugins/bower_components/alertify/alertify.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>

<!-- Magnific popup JavaScript -->
<script src="../plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="../plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/b64toBlob.js"></script>
<script src="js/custom.min.js"></script>
<script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/bower_components/summernote/dist/summernote.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.6/fabric.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- Select 2 -->
<script src="../plugins/bower_components/select2/dist/js/select2.min.js"></script>

<!--<script src="vendor/ckeditor/ckeditor.js"></script>-->
<!-- end - This is for export functionality only -->

<script>
    function getResult() {

        $("#loader_div").show();

        var first_unique = $("input[name='first_unique_id']").val();
        var second_unique = $("input[name='second_unique_id']").val();
        if (first_unique == "" && second_unique == "") {
            $("#all-empty").show();
        } else {
//           alert(first_unique);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    $("#result_div").show();
                    $("#loader_div").hide();
                    document.getElementById("result_div").innerHTML = xmlhttp.responseText;
                    $('#example4').DataTable(
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
                                title: 'Common-mobile-no-excel',
                                text: 'Download Excel',
                            }
                            ]
                        });
//                    $("#table-hide").css("display", "none");
                }
            };
            xmlhttp.open("POST", "unique-mobile-sort.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("&first_unique=" + first_unique + "&second_unique=" + second_unique + "&search_result");
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

