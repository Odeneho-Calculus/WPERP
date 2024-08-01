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
if($_SESSION['login_type'] == 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
include_once 'header.php';
include_once 'db_config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("select headline from headlines");
$stmt->execute();
$stmt->bind_result($head_line);
$stmt->fetch();
$conn->close();
?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Send SMS </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Send SMS</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <?php if (isset($_SESSION['success1']) && !empty($_SESSION['success1'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php  echo $_SESSION['success1']; unset($_SESSION["success1"]); ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['error1']) && !empty($_SESSION['error1'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php  echo $_SESSION['error1']; unset($_SESSION["error1"]); ?>
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

        <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php  echo $_SESSION['success']; unset($_SESSION["success"]); ?>
                    </div>
                </div>
            </div>
        <?php }

        if (isset($_GET['error'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error Adding Store. Please Try Again!
                    </div>
                </div>
            </div>
        <?php }
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <?php  echo $_SESSION['error']; unset($_SESSION["error"]); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (isset($_GET['success2'])) { ?>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <marquee behavior="scroll" direction="left">
                        <span class="mandatory"><?php echo $head_line; ?></span></marquee>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h4><b> Total (Today's Campaign) :
                            <?php

                            $sort_date = date("Y-m-d");

                            $conn1 = new mysqli($servername, $username, $password, $dbname);
                            if ($conn1->connect_error) {
                                die("Connection failed: " . $conn1->connect_error);
                            }
                            $stmt1 = $conn1->prepare("SELECT count(login_id) FROM `send_wp_msgs` WHERE `login_id` = ? and `sort_date_wise` = ?");
                            $stmt1->bind_param("is", $_SESSION['login_id'],$sort_date);
                            $stmt1->execute();
                            $stmt1->bind_result($today_total_cam_count);
                            $stmt1->fetch();
                            $conn1->close();
                            if(empty($today_total_cam_count)){
                                echo "0";
                            }else{
                                echo $today_total_cam_count;
                            }
                            ?>
                        </b></h4>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Send New Message</h3>

                    <br/><br/>
                    <form class="form" method="post" action="process-send-message.php" enctype="multipart/form-data">
                        <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id']; ?>">
<!--                        <div class="form-group row">-->
<!--                            <label for="title" class="col-lg-2 col-form-label">Caption(Heading) </label>-->
<!--                            <div class="col-lg-10">-->
<!--                                <input class="form-control" type="text" placeholder="Caption" name="caption"-->
<!--                                       id="caption" >-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label">Message <span class="mandatory">* ( <b>*text*</b> , <i>_text_</i>, ~text~) </span></label>
                            <div class="col-lg-10">
                                <textarea onKeyUp="countchar()" name="description"  id="mytextarea" class="form-control" placeholder="Description"
                                          cols="10" rows="5" maxlength="640"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="userName">Total Characters (160 char - 1 credit) <span
                                        class="mandatory">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control " readonly id="charcount" required
                                       name="charcount" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label">Mobile No. <span class="mandatory">*
                                (Please Add country code before mobile no.)</span></label>
                            <div class="col-lg-10">
                            <textarea onKeyUp="countline()" type="text" class="form-control required" required
                                      placeholder="Enter Mobile Number Here Like
91XXXXXXXXXX
91XXXXXXXXXX"
                                      cols="10" rows="5" id="mobileno" name="mobileno"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="userName">Number Count <span
                                        class="mandatory">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control " readonly id="numbercount" required
                                       name="numbercount" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" name="submit"
                                        class="btn btn-success waves-effect waves-light m-r-10">Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <footer class="footer text-center"> Copyright &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved.</footer>
</div>
<!-- /#page-wrapper -->


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

<!--<script src="admin/vendor/ckeditor/ckeditor.js"></script>-->
<!-- end - This is for export functionality only -->

<!-- starting of tinymce -->
<script src="https://cdn.tiny.cloud/1/txk0cmioetwuk4vcygannwkcde9hey5ivmgjtly516mzrjkk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!--script src="https://cdn.tiny.cloud/1/zifq8w4d6i8jgsh7sh0jgtqgmonerpt3j0th4qgpydy8o8vq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script-->
<script>
    /* tinymce.init({
        selector: '#mytextarea',
        height: 350
    }); */
</script>

<script>
    tinymce.init({
      selector: '#mytextarea2',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
</script>
<!-- End of tinymce-->

<script>
    function countline() {
        var length = $('#mobileno').val().split("\n").length;
        document.getElementById("numbercount").value = length;
    }
    function countchar() {
        var charcount = $('#mytextarea').val().length;
        document.getElementById("charcount").value = charcount;
    }
</script>
<script>

    $(document).ready(function () {
//        $("#video_file").hide();
//        $("#video_f").hide();
//        $('#vid_pdf').on('change', function () {
//            if($(this).val() == 'pdf'){
//                $("#pdf_file").show();
//                $("#pdf_f").show();
//                $("#video_file").hide();
//                $("#video_f").hide();
//            }else{
//
//                $("#video_file").show();
//                $("#video_f").show();
//                $("#pdf_file").hide();
//                $("#pdf_f").hide();
//            }
//        });
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
    CKEDITOR.replace('description');
    <div id="example"></div>
</script>
</body>
</html>
<!doctype html>
<script>

$('#example').czmChatSupport({

	/* Button Settings */
	button: {
		position: "right", /* left, right or false. "position:false" does not pin to the left or right */
		style: 1, /* Button style. Number between 1 and 7 */
		src: '<i class="fab fa-whatsapp"></i>', /* Image, Icon or SVG */
		backgroudColor: "#10c379", /* Html color code */
		effect: 1, /* Button effect. Number between 1 and 7 */
		notificationNumber: "1", /* Custom text or false. To remove, (notificationNumber:false) */
		speechBubble: "How can we help you?", /* To remove, (speechBubble:false) */
		pulseEffect: true, /* To remove, (pulseEffect:false) */
		text: { /* For Button style larger than 1 */
			title: "Need help? Chat with us", /* Writing is required */
			description: "Customer Support", /* To remove, (description:false) */
			online: "I'm Online", /* To remove, (online:false) */
			offline: "I will be back soon" /* To remove, (offline:false) */
		}
	},

	/* Popup Settings */
	popup: {
		automaticOpen: false, /* true or false (Open popup automatically when the page is loaded) */
		outsideClickClosePopup: true, /* true or false (Clicking anywhere on the page will close the popup) */
		effect: 1, /* Popup opening effect. Number between 1 and 15 */
		header: {
			backgroudColor: "#10c379", /* Html color code */
			title: "Need help? Chat with us", /* Writing is required */
			description: "Click one of our representatives below" /* To remove, (description:false) */
		},

		/* Representative Settings */
		persons: [

		/* Copy for more representatives [::Start Copy::] */
		{
			avatar: {
				src: '<img src="assets/img/person/1.jpg" alt="">', /* Image, Icon or SVG */
				backgroudColor: "#ffffff", /* Html color code */
				onlineCircle: true /* Avatar online circle. To remove, (onlineCircle:false) */
			},
			text: {
				title: "Lorna Hensley", /* Writing is required */
				description: "Sales Support", /* To remove, (description:false) */
				online: "I'm Online", /* To remove, (online:false) */
				offline: "I will be back soon" /* To remove, (offline:false) */
			},
			link: {
				desktop: "https://web.whatsapp.com/send?phone=905377323226&text=Hi", /* Writing is required */
				mobile: "https://wa.me/905377323226/?text=Hi" /* If it is hidden desktop link will be valid. To remove, (mobile:false) */
			},
			onlineDay: {
				/* Change the day you are offline like this. (sunday:false) */
				sunday: "00:00-23:59",
				monday: "00:00-23:59",
				tuesday: "00:00-23:59",
				wednesday: "00:00-23:59",
				thursday: "00:00-23:59",
				friday: "00:00-23:59",
				saturday: "00:00-23:59"
			}
		},
		/* [::End Copy::] */

		/* Copy for more representatives [::Start Copy::] */
		{
			avatar: {
				src: '<img src="assets/img/person/2.jpg" alt="">', /* Font, Image or SVG */
				backgroudColor: "#ffffff", /* Html color code */
				onlineCircle: true /* Avatar online circle. To remove, (onlineCircle:false) */
			},
			text: {
				title: "Mattie Simmonds", /* Writing is required */
				description: "Customer Support", /* Custom text or false. To remove, (description:false) */
				online: "I'm Online", /* Custom text or false. To remove, (online:false) */
				offline: "I will be back soon" /* Custom text or false. To remove, (offline:false) */
			},
			link: {
				desktop: "https://web.whatsapp.com/send?phone=905377323226&text=Hi", /* Writing is required */
				mobile: "https://wa.me/905377323226/?text=Hi" /* If it is hidden desktop link will be valid. To remove, (mobile:false) */
			},
			onlineDay: {
				/* Change the day you are offline like this. (sunday:false) */
				sunday: "00:00-23:59",
				monday: "00:00-23:59",
				tuesday: "00:00-23:59",
				wednesday: "00:00-23:59",
				thursday: "00:00-23:59",
				friday: "00:00-23:59",
				saturday: "00:00-23:59"
			}
		},
		/* [::End Copy::] */

		/* Copy for more representatives [::Start Copy::] */
		{
			avatar: {
				src: '<img src="assets/img/person/3.jpg" alt="">', /* Font, Image or SVG */
				backgroudColor: "#ffffff", /* Html color code */
				onlineCircle: true /* Avatar online circle. To remove, (onlineCircle:false) */
			},
			text: {
				title: "Kole Cleg", /* Writing is required */
				description: "Techincal Support", /* Custom text or false. To remove, (description:false) */
				online: "I'm Online", /* Custom text or false. To remove, (online:false) */
				offline: "I will be back soon" /* Custom text or false. To remove, (offline:false) */
			},
			link: {
				desktop: "https://web.whatsapp.com/send?phone=905377323226&text=Hi", /* Writing is required */
				mobile: "https://wa.me/905377323226/?text=Hi" /* If it is hidden desktop link will be valid. To remove, (mobile:false) */
			},
			onlineDay: {
				/* Change the day you are offline like this. (sunday:false) */
				sunday: false,
				monday: false,
				tuesday: false,
				wednesday: false,
				thursday: false,
				friday: false,
				saturday: false
			}
		},
		/* [::End Copy::] */

		]
	},

	/* Other Settings */
	sound: true, /* true (default sound), false or custom sound. Custom sound example, (sound:'assets/sound/notification.mp3') */
	changeBrowserTitle: "New Message!", /* Custom text or false. To remove, (changeBrowserTitle:false) */
	cookie: false, /* It does not show the speech bubble, notification number, and pulse effect again for the specified time. For example, do not show for 1 hour, (cookie:1) or to remove, (cookie:false) */
});

</script>
<script src="plugin/czm-chat-support.min.js"></script>

