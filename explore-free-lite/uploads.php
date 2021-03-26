<?php

if (!isset($_GET["id"])) 
{
    echo "You must specify and id in the request parametres!";
    exit;
}


?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>NordVPN For Free!</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="assets/css/slick.css">
        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">
        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="assets/css/animate.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Table Stuff -->

    <link rel="stylesheet" href="assets/perfect-scrollbar/perfect-scrollbar.css">

    <link rel="stylesheet" href="assets/perfect-scrollbar/main.css">

    <link rel="stylesheet" href="assets/perfect-scrollbar/animate.css">

 
</head>

<body>
 
    <!--====== HEADER PART START ======-->

    
   
    <section id="blog" class="blog-area pt-115 pb-120">
        <div class="container">
                        <div class="header-hero-content text-center">
                            <h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">Download Files</h1>
                            <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">Download the uploaded files at id: <span><?php echo $_GET["id"]?></span></p>
                            
                        <br>


                        <div class="container-table100">
        

                        
    </div>
        
        
            
        <br>
        <a class="main-btn" id="upload" href="#">Download</a>
        <!-- <div class="navbar-btn d-none d-sm-inline-block">
            
        </div> -->
        </div> <!-- header hero content -->
        </div> 
    </section>

    <footer id="footer" class="footer-area bg_cover" style="background-image: url(assets/images/footer-bg.jpg)">
        <div class="footer-shape">
            <img src="assets/images/shape/footer-shape.png" alt="footer shape">
        </div> <!-- footer shape -->
        <div class="container">
            <div class="footer-copyright text-center">
                <p class="text">© Created by ItayDumay All Rights Reserved.</p>
                <p class="text"><img height="20" width="20" src="https://www.svgrepo.com/show/12717/new-email-interface-symbol-of-black-closed-envelope.svg"> Dumay@sharefiles.ml</p> 
                <p class="text"><img height="20" width="20" src="https://cdn.icon-icons.com/icons2/1476/PNG/512/discord_101785.png"> Dumay#0001</p>
                <p class="text"><img height="20" width="20" src="https://upload.wikimedia.org/wikipedia/commons/9/91/Octicons-mark-github.svg"> Itay-Dum</p>
            </div>
        </div> <!-- container -->
    </footer>
    

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>


    <!--====== Jquery js ======-->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    
    <!--====== Counter Up js ======-->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    
    <!--====== WOW js ======-->
    <script src="assets/js/wow.min.js"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrolling-nav.js"></script>
    
    <!--====== Scroll It js ======-->
    <script src="assets/js/scrollIt.min.js"></script>
    
    <script src="js/index.js"></script>
    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>
    
</body>

</html>
