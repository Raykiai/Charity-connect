<!DOCTYPE html>
<html lang="en">
<head>
    <title>Our Causes</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
	
	<link rel="stylesheet" href="css/style2.css">
</head>
<body class="single-page causes-page">
<?php 
include ("connection.php");
include ("services.php");
	 ?>
    <header class="site-header">
    <div class="top-header-bar">
        <div class="container">
            <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                  
                </div><!-- .col -->

                <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                    <div class="donate-btn">
                       
                    <a style="float: right;" href="dash.php"><?php 
				if (isset($_SESSION['user'])) {
                    echo "Logged in : ".$_SESSION['user'];
                  
                }
                else{
                    echo "Log in";
                  }
                 ?></a>
               
                    </div><!-- .donate-btn -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .top-header-bar -->

    <div class="nav-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="site-branding d-flex align-items-center">
                        <a class="d-block" href="index.html" rel="home"><img class="d-block" src="images/logo.png" alt="logo"></a>
                    </div><!-- .site-branding -->

                    <nav class="site-navigation d-flex justify-content-end align-items-center">
                        <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About us</a></li>
								 <li><a href="organizations.php">Organizations</a></li>
                                <li class="current-menu-item"><a href="causes.php">Causes</a></li>
								 <li><a href="events.php">Events</a></li>
                          
                               
                        </ul>
                    </nav><!-- .site-navigation -->

                    <div class="hamburger-menu d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div><!-- .hamburger-menu -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .nav-bar -->
</header><!-- .site-header -->

<div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Our Causes</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!--  .page-header -->

    
    <div class="featured-cause">
        <div class="container">
                        <div class="row">
<?php 

$result = $conn->query("SELECT * FROM drives WHERE drive_id ");
while ($myrow = $result->fetch_assoc()){
    $grab = $conn->query("SELECT * FROM drives WHERE drive_id='".$myrow['drive_id']."'");
    $row = $grab->fetch_assoc();
    
    while($therow = $myrow){
        $grabb = $conn->query("SELECT SUM(amount) as amount FROM donations WHERE drive_id = '".$therow['drive_id']."'");
    $don = $grabb->fetch_assoc();
    $total=0;
    $total = $total+ $don['amount'];
    $perc = round(($don['amount'] / $row["goal"]) * 100);
 

    
?>
                <div class="col-12 col-lg-6">
                    <div class="cause-wrap d-flex flex-wrap justify-content-between">
                        <figure class="m-0">
                    <!--    <img src="images/g.jpg" alt=""/> -->
                  <?php echo ' <img src="http://localhost/thecharity/uploads/'.$row['image'].'">;' ?>
                 
                        </figure>
                    
                        <div class="cause-content-wrap">
                            <header class="entry-header d-flex flex-wrap align-items-center">
                                <h3 class="entry-title w-100 m-0"><a href="#"><?php echo $row["name"]; ?></a></h3>

                                <div class="posted-date">
                                    <a > Active from: <?php echo $row["date_created"]; ?></a>
                                </div><!-- .posted-date -->
                                    
                             
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <p class="m-0"><?php echo $row["description"]; ?></p>
                            </div><!-- .entry-content -->
                         
                           
                        </div><!-- .cause-content-wrap -->
                        <div >
                                     <ul class="tabs-nav d-flex" style="height:100px; " >
                                    <li class="tab-nav d-flex justify-content-center align-items-center" data-target="#tab_1"  style=><?php echo $perc; ?>%</li>
                                    </ul>                
    </div>

                        <div class="fund-raised w-100">
                           
                                   
                                   

                            <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fund-raised-total mt-4">
                                    Raised:
                                    <?php
									
                                         echo "<tr><th colspan='2'> </th><th>Ksh ".$total."</th><tr>";	
                                   break;
                                        }

                                         ?>
                            </div><!-- .fund-raised-total -->

                                <div class="fund-raised-goal mt-4">
                                    Goal: Ksh <?php echo $row["goal"]; ?>

                                    
                                </div><!-- .fund-raised-goal -->
                                
                            </div><!-- .fund-raised-details --> <div class="entry-footer mt-5">
                               
                                <a class="btn gradient-bg mr-2" href="services.php?donate=<?php echo $row['drive_id'] ?>">Donate</a>
                            </div><!-- .entry-footer -->
                        </div><!-- .fund-raised -->
                    </div><!-- .cause-wrap -->
                </div><!-- .col -->
				 <?php
}
$conn->close();
      


?>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .featured-cause -->

 
   
		
        </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .featured-cause -->
	
	
    </div><!-- .highlighted-cause -->

		   </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->
	
	
	
<footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="#"><img src="images/foot-logo.png" alt=""></a></h2>
<p>Feel free to make any donations,share your stories, take part in charity 
activities and sharing our causes with others.</p>
                            <ul class="d-flex flex-wrap align-items-center">
                                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <h2>Useful Links</h2>

                        <ul>
                            <li><a href="#">Privacy Polticy</a></li>
                            <li><a href="events.php">Become  a Volunteer</a></li>
                            <li><a href="causes.php">Donate</a></li>
                           
                            <li><a href="organizations.php">view organizations</a></li>
                            
                        </ul>
                    </div><!-- .col -->

                   

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact</h2>

                            <ul>
                            <li><a href="organizations.php">Learn about different organizations</a></li>
                            <li><a href="events.php">Become  a Volunteer</a></li>
                            <li><a href="causes.php">Donate to a cause</a></li>
                           
                            <li><a href="account.php">Manage your account</a></li>
                            
                        </ul>
                        </div><!-- .foot-contact -->

                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-widgets -->

       
    </footer><!-- .site-footer -->


    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>

</body>
</html>