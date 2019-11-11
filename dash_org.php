<!doctype html>
<html lang="en">
  <head>
<!-- Required meta tags -->
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
                }
                else{
                  $_SESSION['sign_in'] = "You are not logged in!";
                  header("location: login.php");
                }
                 ?></p> </a>
  <ul class="navbar-nav px-3">
  <li class="nav-item text-nowrap" style="display:inline;">
      <a class="nav-link" href="index.php" style="display:inline">Home</a>
    </li>
  
   
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " href="dash.php">
              <br>
              
              Profile <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item" >
            <a class="nav-link active" href="dash_org.php">
            
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
     
      

<div class="contact-page-wrap" >
        <div class="container">
        


        <div class="col-12 col-lg-7">
            <form class="contact-form" action="add_organizations.php" method="POST" enctype="multipart/form-data">
   <p  style="font-size:16pt; color:black;">Create New Organizations</p>
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
                        <span> Category/Type:</span>	<select name="type_id" class="type"> 
            <option value="1">Children</option>
            <option value="2">Educational</option>
            <option value="3">Health</option>
            <option value="4">Poverty</option>
            <option value="5">Community Service</option>
            <option value="6">Animals</option>
			<option value="7">Environmental</option>
		
		</select>
                        <input type="file" name="pic" placeholder="Add Image"  required>
                        <input type="text" name="description" placeholder="Give a short description" >
						 <input type="text" name="country" placeholder="Country" >
						 <input type="text" name="city" placeholder="City" >
					     <input type="text" name="contact" placeholder="Contact">
						 <input type="email" name="email" placeholder="Email">
                       
                        <span>
                       
                        <button class="btn gradient-bg" id="add_org" type="submit" name="add_org" >Submit details</button>
      
                        	
						</span>
						
                    </form><!-- .contact-form -->

                </div><!-- .col -->
<br><br>
                <div class="card border-warning mb-3" style="width: 100%;">
  <div class="card-header">My organizations</div>
    <div class="card-body">
            <?php
            include "connection.php";
            $sql="SELECT name,  description, country, city, contact, email FROM organizations where user_id = '".$_SESSION['uid']."'";
            $result = $conn->query($sql);

            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){
                     echo '<table class="table table-hover">';
                        echo "<tr>";
                            echo'<th scope="col">Name</th>';
                            echo'<th scope="col">description</th>';
                            echo'<th scope="col">country</th>';
                            echo'<th scope="col">city</th>';
                            echo'<th scope="col">contact</th>';
                            echo'<th scope="col">email</th>';

                        echo "</tr>";
                     while($row = mysqli_fetch_array($result)){
                     echo "<tr>";
                            echo '<td scope="row">' . $row['name'] . "</td>";
                            echo '<td scope="row">' . $row['description'] . "</td>";
                            echo '<td scope="row">' . $row['country'] . "</td>";
                            echo '<td scope="row">' . $row['city'] . "</td>";
                            echo '<td scope="row">' . $row['contact'] . "</td>";
                            echo '<td scope="row">' . $row['email'] . "</td>";

                        echo "</tr>";
                    // Free result set
                    }
                    echo "</table>";
                    mysqli_free_result($result);

                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
            $conn->close();
            ?>
  </div>
</div>


          
        </div><!-- .container -->
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
