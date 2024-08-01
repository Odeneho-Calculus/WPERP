
<!--footer-->
<div class="footer">
    <div class="footer-grids">
        <div class="container">
            <div class="col-md-4 footer-grid ">
                <div class="footer-grid1">
                    <div class="con-ic">
                        <i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
                    </div>

                    <h4>Address</h4>
                    <p>Near Chandra Agro, Ring Road No. 1,<span>Kushalpur, Raipur</span> </p>

                </div>
            </div>
            <div class="col-md-4 footer-grid ">
                <div class="footer-grid1">
                    <div class="con-ic">
                        <i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
                    </div>
                    <h4>Call Us</h4>
                    <p>+91-94791-50238</p>

                </div>
            </div>
            <div class="col-md-4 footer-grid ">
                <div class="footer-grid1">
                    <div class="con-ic">
                        <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
                    </div>
                    <h4>Email</h4>
                    <p><a href="mailto:dineshpatel.vst@gmail.com">dineshpatel.vst@gmail.com</a></p>

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <img src="images/logo.png" alt="">
            <div class="top-ar">
                <h2><a href="#top" class="scroll"><img  src="images/ar.png" alt="" /></a></h2>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="copy">
                <p class="footer-gri" >© 2017 Agriconic. All rights reserved | Design by  <a href="http://hopegroup.in/" target="_blank">Hope Group</a> </p>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<!-- for bootstrap working -->
<script src="js/bootstrap.min.js"></script>
<!-- //for bootstrap working -->
<script>

jQuery(document).ready(function() {
    $('ul.nav li.dropdown .dropdown-menu').hover(function() {
        $('ul.nav li.dropdown').removeClass("open");
        $(this).parent().addClass("open");
    });
    $('ul.nav li.dropdown .dropdown-menu ').on('mouseleave',function() {
        $(this).parent().removeClass("open");
    });
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(500);
    });
});

</script>
</body>
</html>