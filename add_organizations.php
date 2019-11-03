
<!DOCTYPE html>
<html >
<head>
    <title>Account</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFsonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="single-page contact-page">
    <?php
include("connection.php");
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
                       
               
               </div>
               

               <div class="donate-btn " style="flex-grow:1; ">
                     <!--   <a style="float: left;" href="server.php?out=y">logout</a> -->
                        
                       <a style="float: right;" href="dash.php"><?php 
                   if (isset($_SESSION['user'])) :
                       echo "Logged in : ".$_SESSION['user'];
                      
                   
                   ?>
                    
                </a>
                <?php endif; ?>
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
                                <li ><a href="index.php">Home</a></li>
                                <li ><a href="about.php">About us</a></li>
								 <li><a href="organizations.php">Organizations</a></li>
                                <li><a href="causes.php">Causes</a></li>
								 <li><a href="events.php">Events</a></li>
                               
                                
								
                                <li class="current-menu-item"><a href="account.php">Account</a></li>
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
                    <h1>Add organization</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="contact-page-wrap" >
        <div class="container">

        <?php
        $result = $conn->query("SELECT * FROM users WHERE user_id");

        if (isset($_POST["add_org"])) {
        $sql = "INSERT INTO organizations (user_id, name, type, pic, description, country, city, contact, email) 
        VALUES ('".$_SESSION['uid']."', '".$_POST['name']."', '".$_POST['type']."', '".$_POST['pic']."', '".$_POST['description']."', '".$_POST['country']."', '".$_POST['city']."', '".$_POST['contact']."', '".$_POST['email']."' )";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['update_con'] = "organization added successfully";
           
            die();
        } else{
            $_SESSION['update_fail'] = "Sorry. There was an error";
            
            die();
        }
        
        $conn->close();
        }
        
        ?>




                <div class="col-12 col-lg-7">
                    <form class="contact-form" action="add_organizations.php" method="POST" >
 
<?php
 if (isset($_SESSION['update_con'])) {
            echo " <div class=\"alert alert-success\" role=\"alert\" > ".$_SESSION['update_con']. "</div>";
            unset($_SESSION['update_con']);
}
            if (isset($_SESSION['update_fail'])) {
    echo  "<div class=\"alert alert-danger\" role=\"alert\"> "  .$_SESSION['update_fail']. "</div>";
    unset($_SESSION['update_fail']);
} ?>

                        <input type="text" name="name" placeholder="Create Name ">
                        <label> Category/Type:</label>	<select name="type" class="type"> 
            <option >Children</option>
            <option >Educational</option>
            <option >Health</option>
            <option >Poverty</option>
            <option >Community Service</option>
            <option >Animals</option>
			<option >Environmental</option>
			<option></option>
		</select>
                        <input type="file" name="pic" placeholder="Add Image"  required>
                        <input type="text" name="description" placeholder="Give a short description" >
						 <input type="text" name="country" placeholder="Country" >
						 <input type="text" name="city" placeholder="City" >
					     <input type="text" name="contact" placeholder="Contact">
						 <input type="email" name="email" placeholder="Email">
                       
                        <span>
                       
                        <button class="btn gradient-bg" id="add_org" name="add_org" >Submit details</button>
      
                        	
						</span>
						
                    </form><!-- .contact-form -->

                </div><!-- .col -->

               
          
        </div><!-- .container -->
    </div>

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
                                <li><i class="fa fa-phone"></i><span>+254 720633085</span></li>
                                <li><i class="fa fa-envelope"></i><span>global_Aid@gmail.com</span></li>
                                <li><i class="fa fa-map-marker"></i><span>Nairobi Kenya.</span></li>
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