
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Organizations</title>

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
<body class="single-page about-page">
	<?php include ("services.php");	 ?>
<header class="site-header"><div class="top-header-bar">
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
                    echo "No User Logged in";
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
                        <a class="d-block" href="index.php" rel="home"><img class="d-block" src="images/logo.png" alt="logo"></a>
                    </div><!-- .site-branding -->

                    <nav class="site-navigation d-flex justify-content-end align-items-center">
                       <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <li><a href="index.php">Home</a></li>
                                <li href="about.php"><a>About us</a></li>
								 <li class="current-menu-item"><a href="organizations.php">Organizations</a></li>
                                <li><a href="causes.php">Causes</a></li>
								 <li><a href="events.php">Events</a></li>
                                
                                <li><a href="account.php">Account</a></li>
			
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
                    <h1><?php echo $row[name] ?></h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

  
    <?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mycharity";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT name, type, pic, description, country, city, contact, email description FROM organizations";

									
$result = $conn->query($sql);

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){

            
?>




                <div class="">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                           
<img class="card-img rounded-0" src=" <?php echo $row["pic"] ?>. ">
						 
                            </div>

                            <div class="blog_details" >
							
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2><?php echo $row["name"]; ?></h2>
                                </a>
								 <p>Type: <?php echo $row["type"]; ?></p>
                                <p><?php echo $row["description"]; ?></p>
                                <ul class="blog-info-link">
                                     <li><a><i class="far fa-user"></i><?php echo $row["country"]; ?></a></li>
									
                                    <li><a ><i class="far fa-user"></i><?php echo $row["city"]; ?></a></li>
									     <li><a ><i class="far fa-user"></i><?php echo $row["contact"]; ?></a></li>
										      <li><a ><i class="far fa-user"></i><?php echo $row["email"]; ?></a></li>
                                    
                                </ul>
                            </div>
                        </article>


                       
                       

                      
                    </div>
                </div>
							
                      </div>
                      <?php

}        mysqli_free_result($result);

   } else{
      
       echo '<div class="sorry" > <img src="images/g.jpg" alt=""/>
       <h2 style="align:right;">Sorry. There are currently no Organizations to Display.</h2> </div> ';
      
   }
} else{
   echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}


$conn->close();
?>

  
<footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="#"><img src="images/foot-logo.png" alt=""></a></h2>
<p>You can contact us any time from Mon-Sat. Feel free to make any donations,share your stories, take part in charity 
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