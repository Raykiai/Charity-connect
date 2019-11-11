<!doctype html>
<html lang="en">
  <head>
<!-- Required meta tags -->
  
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="dash.css">
  <link rel="stylesheet" href="css/style2.css">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>User Dashboard</title>


    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
  <?php 
include ("connection.php");
include ("services.php");
	 ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow   nav-top">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" ><p style="color:antiquewhite;">  <?php 
				if (isset($_SESSION['user'])) {
                    echo $_SESSION['user'];
                    $_SESSION['uid'];
                }
                else{
                  $_SESSION['sign_in'] = "You are not logged in!";
                  header("location: login.php");
                }
                 ?></p> </a>
  <ul class="navbar-nav px-3">
  <li class="nav-item text-nowrap" >
      <a class="nav-link" href="index.php" >Home</a>
    </li>
  
   
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="dash.php">
              <br>
            
              Profile <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dash_org.php">
       
              Organizations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dash_cause.php">
           
              Causes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dash_event.php">
          
              Events
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.php?out=y">
          
              Log Out
            </a>
          </li>      
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Profile</h1>
        
      </div>
      <div class="col-12 col-lg-6">
      <?php 

      
$sql="SELECT  fname, location, country, uname, email, contact, date_created FROM users WHERE user_id = '".$_SESSION['uid']."' ";
$user = $conn->query($sql);
$row = $user->fetch_assoc();
    
    
    
?>
    
      
<div class="profile">
<div class="text-center">
<BR><BR>
<div class="content"><label> User Name:</label>   <span class="user" ><?php echo $row['uname'] ?></span></div>
<div class="content"><label> Location:</label>   <span class="user" ><?php echo $row['location'] ?></span></div>
<div class="content"><label> Email:</label>   <span class="user" ><?php echo $row['email'] ?></span></div>
<div class="content"><label> Contact:</label>   <span class="user" ><?php echo $row['contact'] ?></span></div>
<div class="content"><label> Date of account creation:</label>   <span class="user" ><?php echo $row['date_created'] ?></span></div>

</div>
<div class="user_info" >


</div>
    
              </div>
    </main>
  </div>
</div>
<script src="./js/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="./js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="./js/dashboard.js"></script></body>
</html>
