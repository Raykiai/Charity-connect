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

        <?php include ("services.php"); ?>

<header class="site-header">
  
<div class="top-header-bar">
        <div class="container">
            <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                  
                </div><!-- .col -->

                <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                    <div class="donate-btn">
                       
                        <a style="float: right;" href="dash.php"><?php 
				if (isset($_SESSION['user'])) :
					echo "Logged in : ".$_SESSION['user'];
				 ?></a>
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

 

    <div class="contact-page-wrap" >
	
	  <div class="container">
          
        <div class="container">
           
   
                <div class="col-12 col-lg-7">
                    <form class="contact-form" action="donation.php" method="post" >
                    



<h2 id="donate" style="font_size:17pt;"><ul>Add a donation to this cause.</ul></h2>



 <?php
include "connection.php";  
if($stmt = $conn->query("SELECT * from drives")){

          echo "<select id=name name=drives class='form-control' style='width:540px;'>";
          while ($row = $stmt->fetch_assoc()) {
          echo "<option value=$row[drive_id]>$row[name]</option>";
          }
          echo "</select>";
          }else{
          echo $connection->error;
          }
          ?>  
<?php
include"connection.php";
if(isset($_POST["donate"])) {

  $phone_no=$_POST["phone_no"];
  $total_amt = $_POST["amount"];
 
  $consumerKey = 'NKJ95zH9gOpQi0UFbcbs3wJDCUNg5ToQ'; //Fill with your app Consumer Key
  $consumerSecret = 'qFpnGZO3R6LwiZlo'; // Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  $myurl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $curl = curl_init($myurl);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;

  
  $stkurl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $stkurl);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
  $phone_no =ltrim($phone_no, '0');
  $localIP = getHostByName(getHostName());
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  $BusinessShortcode = '174379';
  $Timestamp = date('YmdHis');
  $PartyA = '254'.$phone_no;//25491278088
  $CallBackURL = 'http://'.$localIP.'/glob/admin/callback_url.php';
  $AccountReference =  'charity Organization ';
  $TransactionDesc =  'Transaction description ';
  $Amount = $total_amt;
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
  $Password = base64_encode($BusinessShortcode.$Passkey.$Timestamp);

  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

 
 
  $curl_post_data = array(
   'BusinessShortCode' => $BusinessShortcode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' =>$Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortcode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );
 
  $data_string = json_encode($curl_post_data);
 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
 
  $curl_response = curl_exec($curl);

 

$sql = "INSERT INTO donations (user_id, drive_id, amount, comment)
VALUES ('".$_SESSION['uid']."','".$_POST['drives']."', '".$_POST['amount']."', '".$_POST['comment']."')";

if ($conn->multi_query($sql) === TRUE) {
  echo '<script>alert("Thank you for donating!!")</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
     header("location: cause.php");
}
}

$conn->close();
?>
<br>
                       <input type="text" name="amount" placeholder="Enter amount to donate" required>
                       
                         <input type="text"  name="phone_no" placeholder="phone number" required>
                         <input type="text"  name="comment" placeholder="comment" required>
                           <span>
                            <input class="btn gradient-bg" type="submit" id="donate"  name="donate" value="Donate">
                        	
                        </span>
                        
						        </form><!-- .contact-form -->
	
                </div><!-- .col -->

               
          
        </div><!-- .container -->
    </div>
<br><br>
  
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