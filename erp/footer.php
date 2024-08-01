<footer class="footer text-center"> Copyright &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved.</footer>
</div>
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
<script language="javascript">

    document.onmousedown=disableclick;

    status="Right Click Not Allow";

    function disableclick(event)

    {

        if(event.button==2)

        {

            alert(status);

            return false;

        }

    }
</script>
<script>

//    $("#dl").on("click", function () {
//
//        table.button('.buttons-csv').trigger();
//    });
//    var table = $('#myTableMobile').DataTable();
//    var buttons = new $.fn.dataTable.Buttons(table, {
//        buttons: [
//            {
//                extend: 'csvHtml5',
//                title: 'Campaign-record-excel',
//                text: 'Download Excel',
//                download: 'open'
//            }
//        ]
//    });


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

    $(document).ready(function() {
        $("#d_table-1").DataTable();
        $('#myTable, #myTable2').DataTable();
        $('#myTableMobile').DataTable(
                {
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'csvHtml5',
                            title: 'mobile_no_excel',
                            text: 'Download',

                        }
                    ]
                }
            );

        $('#select_all').on('click',function(){
            if(this.checked) {
                $('.check').each(function () {
                    this.checked = true;
                });
            }else{
                $('.check').each(function(){
                    this.checked = false;
                });
            }
        });
        $('.check').on('click',function(){

            if($('.check:checked').length == $('.check').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
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
            $.ajax({ type: "POST", url: "api/get-cities.php",
                data: {
                    id: cn
                },
                cache: false,
                success: function(response){
                    console.warn(response);
                    if(response.success == true) {
                        $('.select-city').html(response.data);
                        //alertify.success('Unit of ' + vname +' Updated!');
                    }
                    else{
                        //alertify.error('Error updating unit of ' + vname + response);
                    }
                }
                /*loading:*/
            });
        });

// Show loader & then get content when modal is shown
        $modal.on('show.bs.modal', function(e) {
            var orderid = $(e.relatedTarget).data('orderid');
            var dborder = $(e.relatedTarget).data('dborder');
            //alert(paragraphs);
            $(this)
                .addClass('modal-scrollfix')
                .find('.modal-body')
                .html('loading...')
                .load('api/order-detail.php?id=' + dborder, function() {
                    // Use Bootstrap's built-in function to fix scrolling (to no avail)
                    $modal
                        .removeClass('modal-scrollfix')
                        .modal('handleUpdate');
                });

            $(this)
                .find('.modal-title')
                .html("<strong>Order: " + orderid + "</strong>");
        });
        alertify.set('notifier','position', 'bottom-left');
        $('.save-price').on('click', function () {
            //alert($('#'+$(this).attr('data-iid')).val());
            var new_price = $('#'+$(this).attr('data-iid')).val();
            var vid = $(this).attr('data-pid');
            var new_unit = $('#punit-' + vid).val();
            //alert(new_unit);
            var vname = $('#'+$(this).parent().parent().attr('id')+" .vname").html();
            //alert(new_price);
            //alert(vname);
            $.ajax({ type: "POST", url: "api/update-price.php",
                data: {
                    id: vid,
                    price: new_price,
                    unit: new_unit
                },
                cache: false,
                success: function(response){
                    if(response == 'success') {
                        alertify.success('Unit of ' + vname +' Updated!');
                    }
                    else{
                        alertify.error('Error updating unit of ' + vname + response);
                    }
                }
            });
        });
        $('.price-input').on('keyup', function () {
            //alert($(this).parent().parent().attr('id'));
            $('#'+$(this).parent().parent().attr('id')+" .save-btn-td .btn").prop('disabled',false).removeClass('disabled');
        });
        $('.update-unit').on('change', function () {
            //alert($(this).parent().parent().attr('id'));
            $('#'+$(this).parent().parent().attr('id')+" .save-btn-td .btn").prop('disabled',false).removeClass('disabled');
        });
        //alertify.success('Success message');
        setTimeout(function(){$('.alert').fadeOut(1000)}, 5000);
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
            if($(this).val() == 1){
                $('.hide-laminates').hide();
                $('.hide-laminates #sfile').removeAttr('required');
            }
            else if($(this).val() == 2){
                $('.hide-laminates #sfile').removeAttr('required');
            }
            else{
                $('.hide-laminates').show();
                $('.hide-laminates #sfile').attr('required','required');
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
