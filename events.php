<!DOCTYPE html>
<html lang="en">
<head>
    <title>Events</title>

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
<?php include ("services.php");	 ?>

<body class="single-page news-page">
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
                                <li><a href="causes.php">Causes</a></li>
								 <li class="current-menu-item"><a href="events.php">Events</a></li>
                               
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
                    <h1>Events</h1>
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


$sql="SELECT name, image, description, country, city, location, date_event, email FROM events";

									
$result = $conn->query($sql);

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){

            
?>

    <div class="news-wrap">
        <div class="container">
            <div class="row">
               <div style="max-width:700px; min-width:600px;">
                    <div class="news-content">
                       <?php echo ' <img style=" max-height:350px; min-height:270px; " src="http://localhost/thecharity/uploads/'.$row['image'].'">;' ?>
       
                        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="header-elements">
                                <div class="posted-date" style="font-size:13pt;"><?php echo $row["date_event"]; ?></div>
                  

                                <h2 class="entry-title" style="font-size:20pt;"><a ><?php echo $row["name"]; ?></a></h2>

                                <div class="post-metas d-flex flex-wrap align-items-center">
                                    <span class="post-author"> <a style="font-size:13pt;"><?php echo $row["country"]; ?></a></span>
                                    <span class="post-comments"><a style="font-size:13pt;"><?php echo $row["city"]; ?></a></span>
                                    <span class="post-comments"><a style="font-size:13pt;">Location <?php echo $row['location'];?></a></span>
                                    <span class="post-comments"> <a style="font-size:13pt;">Contact: <?php echo $row["email"]; ?></a></span>
                                </div>
                            </div>

                         
                        </header>

                        <div class="entry-content">
                    <p style="font-size:14pt; color:black;" ><?php echo $row["description"]; ?></p>       
                    </div>
                  
                    <?php

}        mysqli_free_result($result);

} else{

    echo '<div class="sorry" ><div class="pic33"> <img src="images/g.jpg" alt=""/></div>

    <div class="alerter" > <div class="alert alert-primary" role="alert">
     Sorry. There are currently no Events!!
 </div></div>
  </div> ';
}
} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}


$conn->close();
?>

                       
             

                                    </div><!-- .col -->
</div>
        </div>
    </div>

   

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