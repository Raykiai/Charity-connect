<?php 
include ("connection.php");
                        $res = $conn->query("SELECT 
                        donations.amount AS amount,
                        category.type AS type,
                        organizations.organization_id AS organization_id, organizations.name AS organization_name,
                        drives.drive_id AS drive_id, drives.name AS drive_name,drives.image AS image, drives.goal AS goal,
                        drives.description AS description, drives.date_created AS date_created,
                        donations.amount AS amount
                        FROM donations
                        JOIN drives ON donations.drive_id = drives.drive_id
                        JOIN organizations ON organizations.organization_id = drives.organization_id
                        JOIN category ON category.type_id=organizations.type_id
                        WHERE organizations.organization_id='".$_GET['id']."'");
                        
                       
                        // var_dump($res->fetch_array());
                        //  $row_id= $res->fetch_array();
                        //  while () {
                            $row = $res->fetch_array();
                            var_dump($row);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hello World</title>

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
</head>
<body class="single-page causes-page">
<?php 
include ("connection.php");
include ("services.php");	 ?>
    <header class="site-header">


    <div class="top-header-bar">
        <div class="container">
            <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                    <div class="header-bar-email">
                      
                    </div><!-- .header-bar-email -->

                    <div class="header-bar-text">
                       
                    </div><!-- .header-bar-text -->
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
                        <a class="d-block" href="index.html" rel="home"><img class="d-block" src="images/logo.png" alt="logo"></a>
                    </div><!-- .site-branding -->

                    <nav class="site-navigation d-flex justify-content-end align-items-center">
                       <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About us</a></li>
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


<!--picks up the organization session and displays drives of that session -->

  <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>
                    <?php 
                        $res = $conn->query("SELECT 
                        category.type AS type,
                        organizations.organization_id AS organization_id, organizations.name AS organization_name,
                        drives.drive_id AS drive_id, drives.name AS drive_name,drives.image AS image, drives.goal AS goal,
                        drives.description AS description, drives.date_created AS date_created,
                        donations.amount AS amount
                        FROM organizations
                        JOIN category ON category.type_id=organizations.type_id
                        JOIN drives ON drives.organization_id = organizations.organization_id
                        JOIN donations ON drives.drive_id = donations.drive_id
                        WHERE organizations.organization_id='".$_GET['id']."'");
                       
                        // var_dump($res->fetch_array());
                        //  $row_id= $res->fetch_array();
                        //  while () {
                            $row = $res->fetch_array();
                            foreach ($row as $key => $value) {
                                var_dump($row[$key]['organization_name']);
                            
                         $grab = $conn->query("SELECT * FROM drives WHERE organization_id = '".$_GET['id']."'");
                        //  echo   $row['organization_name'];
                     ?>
                 </h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="featured-cause">
        <div class="container">
            
            <div class="row">
            <?php
                    
                        // $grabb = $conn->query("SELECT SUM(amount) as amount FROM donations WHERE drive_id = '".$_GET['id']."'");
                        // while ($don = $grabb->fetch_assoc()) {
                            $total=0;
                        $total = $total+ $row['amount'];
                        $perc = round(($row['amount'] / $row["goal"]) * 100);
                        echo '
                        <div class="col-12 col-lg-6">
                        <div class="cause-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                            <img height="200" width="200" src="http://localhost/thecharity/uploads/'.$row['image'].'"/>
                            </figure>
    
                            <div class="cause-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a >'.$row["drive_name"].'</a></h3>
    
                                    <div class="posted-date">
                                        <a >Active from: '.$row["date_created"].'</a>
                                    </div><!-- .posted-date -->
    
                                    <div class="cats-links">
                                        <a >Category:
                                         <!--display name of organization in session -->   
                                            '.$row['type'].'
                                            </a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->
    
                                <div class="entry-content">
                                    <p class="m-0">'.$row["description"].'</p>
                                </div><!-- .entry-content -->
    
                                <div class="entry-footer mt-5">
                                    <a href="donation.php" class="btn gradient-bg mr-2">Donate Now</a>
                                </div><!-- .entry-footer -->
                            </div><!-- .cause-content-wrap -->
    
                            <div class="fund-raised w-100">
                                <div class="featured-fund-raised-bar barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div><!-- .tipWrap -->
    
                                    <span class="fill" data-percentage="<?php echo $perc; ?>">
    
    
                                    </span>
                                </div><!-- .fund-raised-bar -->
    
                                <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="fund-raised-total mt-4">
                                            echo $total;	
                                    </div><!-- .fund-raised-total -->
    
                                    <div class="fund-raised-goal mt-4">
                                        Goal: Ksh <?php echo $row["goal"]; ?>
                                    </div><!-- .fund-raised-goal -->
                                </div><!-- .fund-raised-details -->
                            </div><!-- .fund-raised -->
                        </div><!-- .cause-wrap -->
                    </div><!-- .col -->
                        ';
                        }
                        
                    // }
                  



                ?>
			
               
                </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .featured-cause -->

                
                
                
                <?php
 
 

$conn->close();
?>
             				
				 
				
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
                            <li><a href="organizations.php">Learn about different organizations</a></li>
                            <li><a href="events.php">Become  a Volunteer</a></li>
                            <li><a href="causes.php">Donate to a cause</a></li>
                           
                            <li><a href="account.php">Manage your account</a></li>
                            
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