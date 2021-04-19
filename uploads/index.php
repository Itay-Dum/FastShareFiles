<?php
include_once '../php/includes/db.inc.php';
include_once '../php/includes/uploads.inc.php';

$uploads = new Uploads();
$uploads->verifyID();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>FileShare</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-sc">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-sc">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/png">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="../assets/css/slick.css">
        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="../assets/css/LineIcons.css">
        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="../assets/css/animate.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="../assets/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Table Stuff -->

    <link rel="stylesheet" href="../assets/perfect-scrollbar/perfect-scrollbar.css">

    <link rel="stylesheet" href="../assets/perfect-scrollbar/main.css">

    <link rel="stylesheet" href="../assets/perfect-scrollbar/animate.css">

 
</head>

<body>
 
    <!--====== HEADER PART START ======-->
    

    <header class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
        
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav m-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#service">Contribute</a>
                                    </li>
                                    
                                </ul>
                            </div> 
                            
                           
                        </nav> 
                    </div>
                </div> 
            </div> 
        </div> 
        <!-- <div id="alert-area"></div> -->

        <div id="home" class="upload-hero" style="background-image: url(../assets/images/header-hero.jpg)">
            <br><br><br>
            <div class="header-shape">
                <img src="../assets/images/shape/header-shape.png" alt="shape">
            </div>
            <div id="alert-area"></div>
        </div> <!-- header hero -->

    </header>


   
    <section id="blog" class="blog-area pt-115 pb-120">
        <div class="container">
            <div class="header-hero-content text-center">
                <h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">Download Files</h1>
                <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">Copy the link to these files <svg id="copy-btn" style="cursor:pointer;" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
  <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
</svg></h4>
                <br>
                <div id="files-download-area">
                    <?php $uploads->RenderFileNames();?>
                </div>
                <br>
                <a class="main-btn" id="upload" href="#">Download All</a>
            </div>
        <br>
            
        </div> -->
        </div> <!-- header hero content -->  
        </div> 
    </section>

    <footer id="footer" class="footer-area bg_cover" style="background-image: url(../assets/images/footer-bg.jpg)">
        <div class="footer-shape">
            <img src="../assets/images/shape/footer-shape.png" alt="footer shape">
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
    



    <!--====== Jquery js ======-->
    <script src="../assets/js/vendor/jqu.12.4.min.js"></script>
    <script src="../assets/js/vendor/modernizr-.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    
    
    <!--====== Counter Up js ======-->
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    
    <!--====== WOW js ======-->
    <script src="../assets/js/wow.min.js"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/scrolling-nav.js"></script>
    
    <!--====== Scroll It js ======-->
    <script src="../assets/js/scrollIt.min.js"></script>
    
    <script src="../js/index.js"></script>
    <!--====== Main js ======-->
    <script src="../assets/js/main.js"></script>
    
</body>

</html>
