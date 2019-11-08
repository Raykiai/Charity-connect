<?php 

include ("connection.php");
session_start();

#REGISTER CODE USERS...

if (isset($_POST['signup'])) {
	$passwd= $_POST['pass'];
	$confirm= $_POST['confirm_pass'];

	$sql = "SELECT user_id FROM users WHERE username == '".$_POST['uname']."'";
       
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "s", $param_username);
	   
		// Set parameters
		$param_username = trim($_POST["uname"]);
	   
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			/* store result */
			mysqli_stmt_store_result($stmt);
		   
			if(mysqli_stmt_num_rows($stmt) == 1){
				$_SESSION['ACC'] = "This username is already taken.";
			} else{
				$username = trim($_POST["uname"]);
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
	}




	if ($passwd == $confirm) {
		$sql= "INSERT INTO users (fname, lname, uname, pic, email, contact, pass)
		 VALUES (".$_POST['fname']."','".$_POST['lname']."','".$_POST['uname']."','".$_POST['pic']."','".$_POST['email']."','".$_POST['contact']."','".$passwd."')";

		if ($conn->query($sql) == TRUE) {
			$_SESSION['register_con'] = "Successful Proceed to Login! ";
			header("location: signup.php");
		
			die();
		}
	}
	else{
		$_SESSION['register_fail'] = "Passwords don't match!";
		header("location: signup.php");
		die();
	}
	$conn-> close();
	   
}

#LOGIN CODE...

if (isset($_POST['login'])) {
	$sql="SELECT * FROM users WHERE uname='".$_POST['uname']."'";
	$grab = $conn->query($sql);
	if ($grab != TRUE) {
			$_SESSION['sign_in'] = "Invalid credentials!";
			header("location: login.php");
			die();
	}

	

	$data=$grab->fetch_assoc();
	$pass=$data['pass'];
	$user=$data['role_id'];
	if (isset($_POST['pass']) && $_POST['pass'] == $pass) {
		if($user == "1"){
			$_SESSION['user'] = $data['uname'];
			$_SESSION['uid'] = $data['user_id'];
			$_SESSION['role_id'] = $user;
			header("location: admin_dashboard.php");
			die();
		}
		else{
			$_SESSION['user'] = $data['uname'];
			$_SESSION['uid'] = $data['user_id'];
			$_SESSION['role_id'] = $user;
			
			header("location: organizations.php");
			die();

		}
	} else{

		$_SESSION['sign_in'] = "Invalid entries. Please try!";
		header("location: login.php");
	}
	$conn->close();
	
}

#LOGOUT CODE...

if (isset($_GET['out'])) {
	unset($_SESSION['user']);
unset($_SESSION['role_id']);
	header("location: login.php");
}

#ADD ORGANIZATION

if (isset($_POST["add_org"])) {
// Get image name
 $image = $_FILES['pic']['name'];
 // image file directory
 $target = "uploads/".basename($image);
 

 $sql = "INSERT INTO organizations (user_id, name, type_id, pic, description, country, city, contact, email) 
 VALUES ('".$_SESSION['uid']."', '".$_POST['name']."', '".$_POST['type_id']."', '".$_FILES['pic']['name']."', '".$_POST['description']."', '".$_POST['country']."', '".$_POST['city']."', '".$_POST['contact']."', '".$_POST['email']."' )";

if ($conn->multi_query($sql) === TRUE) {
	if (move_uploaded_file($_FILES['pic']['tmp_name'], $target)) {
		        $msg = "Image uploaded successfully";
				$_SESSION['update_con'] = "organization added successfully";
				$_SESSION['update_con'] = "organization added successfully";
				header("location: dash_org.php");
		    }else{
				$_SESSION['update_fail'] = "Image Upload Failed";
				header("location: dash_org.php");
		    }
} 

$conn->close();	

}


#ADD EVENT

if (isset($_POST["add_event"])) {
	
	 $image = $_FILES['image']['name'];
	 // image file directory
	 $target = "uploads/".basename($image);

	  $sql = "SELECT id FROM users WHERE username = ?";
       
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
           
            // Set parameters
            $param_username = trim($_POST["username"]);
           
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
               
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }


	 
	



	 $sql = "INSERT INTO events (user_id, organization_id, name, image, description, country, city, location, date_event, email) 
	 VALUES ('".$_SESSION['uid']."','".$_POST['organization_id']."', '".$_POST['name']."','".$_FILES['image']['name']."', '".$_POST['description']."', '".$_POST['country']."', '".$_POST['city']."', '".$_POST['location']."', '".$_POST['date_event']."', '".$_POST['email']."' )";
	
	if ($conn->multi_query($sql) === TRUE) {
		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
					$msg = "Image uploaded successfully";
					
					$_SESSION['event_con'] = "organization added successfully";
					header("location: dash_event.php");
				}else{
					$_SESSION['event_fail'] = "Image was not uploaded";
					$_SESSION['event_fail'] = "Sorry. There was an error";
					header("location: dash_event.php");
				}
	} 

	else{
		$_SESSION['sign_in'] = "You are not logged in!";
		header("location: login.php");
	}
	
	$conn->close();
	}
	

#ADD CAUSE

if (isset($_POST["add_cause"])) {
	
	$image = $_FILES['image']['name'];
	// image file directory
	$target = "uploads/".basename($image);
	
   
	$sql = "INSERT INTO drives (user_id, organization_id, name, image, goal, description ) 
	VALUES ('".$_SESSION['uid']."','".$_POST['organization_id']."', '".$_POST['name']."','".$_FILES['image']['name']."', '".$_POST['goal']."', '".$_POST['description']."')";
   
   if ($conn->multi_query($sql) === TRUE) {
	   if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				   $msg = "Image uploaded successfully";
				   $_SESSION['cause_con'] = "Event added successfully";
				  
				   header("location: dash_cause.php");
			   }else{
				   $_SESSION['cuase_fail'] = "Image was not uploaded";
				   header("location: dash_cause.php");
			   }
   } else{
	   $_SESSION['cause_fail'] = "Sorry. There was an error";
	   header("location: dash_cause.php");
   }
   
   $conn->close();
   }




#PRESENT ORGANIZATION DATA IN ORGANIZATION_VIEW
$org = $conn->query("SELECT * FROM organizations WHERE organization_id");
		$gain = $org->fetch_assoc();
		$id= $gain['organization_id'];
$_SESSION['organization'] = $gain['organization_id'];


// if (isset($_GET['organization_id'])) {
// 	if (isset($_GET['organization_id']) && $_GET['organization_id'] == $_SESSION['organization']) {
		
// header("location: organization_view.php");
// die();
// 	}
// 	else{
// 		$_SESSION['display_fail']="Error occurred!";
// 		header("location: organizations.php");
// 		die();
// 	}
// 	$conn->close();
// }

#CO


?>