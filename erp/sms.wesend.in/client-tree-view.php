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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robot" content="nofollow,noindex">
    <!--    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">-->
    <!--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">-->
    <title>WESEND - Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css"/>

    <link href="plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-- Popup CSS -->
    <link href="plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- summernotes CSS -->
    <link href="plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet"/>
    <!-- Alertify CSS -->
    <link href="plugins/bower_components/alertify/css/alertify.min.css" rel="stylesheet"/>
    <link href="plugins/bower_components/alertify/css/themes/semantic.min.css" rel="stylesheet"/>
    <!-- animation CSS -->
    <link href="admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->

    <link href="admin/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- Select 2 -->
    <link href="plugins/bower_components/select2/dist/css/select2.min.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9] -->
    <!--[endif]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body class="fix-sidebar">

<?php
include_once 'db_config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_unique_id = $_SESSION['user_unique_id'];
$stmt = $conn->prepare("SELECT `username`,  `profilepic`  FROM `logins` WHERE user_unique_id = ?");
$stmt->bind_param("s", $user_unique_id);
$stmt->execute();
$stmt->bind_result($u_username, $profile_pic);
$stmt->fetch();
$conn->close();
?>
<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part"><a class="logo" href="index.php"><span class="hidden-xs"><strong>WESEND</strong></span></a></div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="hidden-xs waves-effect waves-light"> ADMIN PANEL </a></li>
            </ul>
            <!--            <ul class="nav navbar-top-links navbar-right pull-right">-->
            <!--<li><a href="login.html"><i class="ti-settings"></i> Settings</a></li>-->
            <!--                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>-->
            <!--            </ul>-->

            <button class ="btn dropdown-toggle pull-right profile" type = "button" data-toggle="dropdown">
                <?php if (!empty($profile_pic)){ ?>
                    <img src="admin/img/upload/<?php echo $profile_pic; ?>"  width="40px;" height="40px;" alt="user_image">
                <?php } else { ?>
                    <img src="admin/img/upload/user.png"  width="40px;" height="40px;" alt="user_image">
                <?php } ?><?php echo !empty($u_username)? $u_username : ""; ?> <i class="ti-angle-down p-2"></i><span class = "caret"></span></button>
            <ul class = "dropdown-menu dropdown-menu-right profile-wth">
                <li><a href = "login-profile.php"><img src="plugins/images/icon/14.png" width="30px;" height="30px;" alt=""> Profile</a></li>
                <li><a href = "change-password.php"><img src="plugins/images/icon/17.png" width="25px;" height="25px;" alt=""> Change Password</a></li>
                <li><a href="logout.php"><img src="plugins/images/icon/18.png" width="30px;" height="30px;" alt=""> Logout</a></li>
            </ul>
        </div>

        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">
                <li> <a href="index.php" class="waves-effect"><img src="plugins/images/icon/11.png" width="35px;" height="35px;" alt=""> <span class="hide-menu">Dashboard</span></a> </li>


                <!--<li> <a href="add-gallery.php" class="waves-effect"><i class="ti-plus p-r-10"></i> <span class="hide-menu">Add Gallery</span></a> </li>-->
                <li> <a href="sendwhatsapp.php" class="waves-effect"><img src="plugins/images/icon/6.png" width="30px;" height="30px;" alt=""> <span class="hide-menu">Send Whatsapp SMS</span></a> </li>
                <li> <a href="filter.php" class="waves-effect"><img src="plugins/images/icon/12.png" width="30px;" height="30px;" alt=""><span class="hide-menu">Filter Whatsapp No.</span></a> </li>
                <?php if($_SESSION['login_type'] == 'reseller') { ?>
                <li> <a href="reseller.php" class="waves-effect"><img src="plugins/images/icon/10.png" width="30px;" height="30px;" alt=""> <span class="hide-menu"> Manage Reseller</span></a> </li>
                <?php } ?>
                <li> <a href="user.php" class="waves-effect"><img src="plugins/images/icon/7.png" width="30px;" height="40px;" alt=""> <span class="hide-menu">Manage User</span></a> </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/4.png" width="30px;" height="30px;" alt=""> <span class="hide-menu">Credit Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <?php if($_SESSION['login_type'] == 'reseller') { ?>
                        <li><a href="reseller-report.php"><img src="plugins/images/icon/9.png" width="30px;" height="30px;" alt=""> Reseller Report</a></li>
                        <?php } ?>
                        <li><a href="user-report.php"><img src="plugins/images/icon/9.png" width="30px;" height="30px;" alt=""> User Report</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/16.png" width=30px;" height="30px;" alt=""> <span class="hide-menu">Whatsapp Report <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="deliveryapp.php"><img src="plugins/images/icon/2.png" width="30px;" height="30px;" alt=""> Campaign Wise</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img src="plugins/images/icon/13.png" width="30px;" height="30px;" alt=""> <span class="hide-menu">Settings <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="login-profile.php"><img src="plugins/images/icon/14.png" width="30px;" height="30px;" alt=""> Update Profile</a></li>
                        <li><a href="change-password.php"><img src="plugins/images/icon/15.png" width="30px;" height="30px;" alt=""> Update Credit</a></li>
                    </ul>
                </li>
<!--                <li> <a href="news.php" class="waves-effect"><img src="plugins/images/icon/5.png" width="30px;" height="30px;" alt=""> <span class="hide-menu">News</span></a> </li>-->
                <li> <a href="client-tree-view.php" class="waves-effect"><img src="plugins/images/icon/3.png" width=30px;" height="30px;" alt=""> <span class="hide-menu"> Client Tree View</span></a> </li>
                <li> <a href="contact.php" class="waves-effect"><img src="plugins/images/icon/1.png" width=30px;" height="30px;" alt=""> <span class="hide-menu"> Contact Us</span></a> </li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->
    <div class="row">
        <div class="container col-lg-12">
            <div class="white-box pull-right tree-view">
                <h3 class="box-title m-b-0">Client Tree View </h3>
                <br/>
                <div id="treeview"></div>
            </div>
        </div>
    </div>
</body>
</html>

<footer class="footer text-center">
    <script>document.write(new Date().getFullYear())</script> &copy; All Rights Reserved
        </a></footer>
</div>
<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
<!-- jQuery -->
<!--<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>-->
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
    $(document).ready(function () {
        $.ajax({
            url: "fetch.php",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('#treeview').treeview({data: data, enableLinks: true});
            }
        });
    });
</script>
<script>

    $(document).ready(function () {


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

        $('#myTable, #myTable2').DataTable();
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
</script>
</body>
</html>
