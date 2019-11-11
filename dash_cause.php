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
            <a class="nav-link" href="dash_org.php">
            
              Organizations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="dash_cause.php">
           
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
            <form class="contact-form" action="services.php" method="POST" enctype="multipart/form-data">
   <p  style="font-size:16pt; color:black;">Create New Cause</p>
   <?php
                    if (isset($_SESSION['cause_con'])) {
                                echo " <div class=\"alert alert-success\" role=\"alert\" > ".$_SESSION['cause_con']. "</div>";
                                unset($_SESSION['cause_con']);
                    }
                                if (isset($_SESSION['cause_fail'])) {
                        echo  "<div class=\"alert alert-danger\" role=\"alert\"> "  .$_SESSION['cause_fail']. "</div>";
                        unset($_SESSION['cause_fail']);
                    } ?>

                    <input type="text" name="name" placeholder="Name of fund raiser ">
                    <span> Organization responsible:</span>	
                    <select name="organization_id" class="type"> 
                  <!-- Display organizations available under logged in user -->
                    <?php
                    if(isset($_SESSION['uid'])){
                
                        $user = $conn->query("SELECT * FROM organizations WHERE user_id = '".$_SESSION['uid']."'");
                        while($rowpick = $user->fetch_assoc()){
                       
                    ?> 
                   
                        <!--Disaplay name of organizations in options under this logged in user
                                while picking up organization_id as value -->
                       <option  value="<?php echo $rowpick['organization_id']; ?>" >
                           <?php 
                                 echo $rowpick['name'];  
                            ?>
                       </option>
                                            
                        <?php 
                        //end of while loop
                        }
                        $conn->close(); 
                                        }?>

                   </select>
                    
                    <input type="file" name="image" placeholder="Add Image" required>
                    <input type="text" name="goal" placeholder="Goal amount of this fund raiser">
                    <input type="text" name="description" placeholder="Give a short description">
                    <input type="text" name="contact" placeholder="Contact">
                    <input type="email" name="email" placeholder="Email">

                    <span>
                        <input class="btn gradient-bg" type="submit" id="signup" name="add_cause" value="Submit details">

                    </span>

                </form><!-- .contact-form -->
                <BR>
         </div><!-- .col -->

         <div class="card border-warning mb-3" style="width: 100%;">
  <div class="card-header">My drives</div>
    <div class="card-body">
 <?php
include "connection.php";

$sql="SELECT drive_id, name, goal, description FROM drives where user_id = '".$_SESSION['uid']."'";
$result = $conn->query($sql);
if (isset($_SESSION['del_cause'])) {
  echo "<p style='color:#6f42c1; font-size:16pt;'>".$_SESSION['del_con']."<p>";
  unset($_SESSION['del_con']);
  die();
}





$result = $conn->query("SELECT * FROM drives WHERE drive_id ");



if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){

       echo '<table class="table table-hover">';
            echo "<tr>";
                echo'<th scope="col">Name</th>';
                echo'<th scope="col">Goal</th>';
                echo'<th scope="col">Raised</th>';
                echo'<th scope="col">Description</th>';
            echo "</tr>";
         while($row = mysqli_fetch_array($result)){

  $grabb = $conn->query("SELECT SUM(amount) as amount FROM donations WHERE drive_id = '".$row['drive_id']."'");
    $don = $grabb->fetch_assoc();
    $total=0;
    $total = $total+ $don['amount'];




     echo '<tbody>';
         echo '<tr>';
                echo '<td scope="row">' . $row['name'] . "</td>";
                echo '<td scope="row">' . $row['goal'] . "</td>";
                echo '<td scope="row">' . $total . "</td>";
                echo '<td scope="row">' . $row['description'] . "</td>";
                echo  "<td '><a href='services.php?del_cause=".$row['drive_id']."'>REMOVE</a></td>";
                       
            echo "</tr>";
        // Free result set
        
        }
        echo "</table>";
        mysqli_free_result($result);

   } else{
        echo "No records matching your query were found.";
    }

} 



else{
    echo "There are no drives to display $sql. " . mysqli_error($conn);
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
