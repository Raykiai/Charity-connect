<?php 

include ("connection.php");
session_start();

#REGISTER CODE...

if (isset($_POST['signup'])) {
	$passwd= $_POST['pass'];
	$confirm= $_POST['confirm_pass'];

	if ($passwd == $confirm) {
		$sql= "INSERT INTO users (fname, lname, uname, pic, email, contact, pass)
		 VALUES ('".$_POST['fname']."','".$_POST['lname']."','".$_POST['uname']."','".$_POST['pic']."','".$_POST['email']."','".$_POST['contact']."','".$passwd."')";

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
	
	if (isset($_POST['pass']) && $_POST['pass'] == $pass) {
			$_SESSION['user'] = $data['uname'];
			$_SESSION['uid'] = $data['user_id'];
			header("location: organizations.php");
			die();
		
	}else{
		$_SESSION['sign_in'] = "Invalid credentials!";
		header("location: signup.php");
	}
	$conn->close();
	
}

#LOGOUT CODE...

if (isset($_GET['out'])) {
	unset($_SESSION['user']);

	header("location: login.php");
}

#ADD ORGANIZATION
$result = $conn->query("SELECT * FROM users WHERE user_id");

if (isset($_POST["add_org"])) {
$sql = "INSERT INTO organizations (user_id, name, type, pic, description, country, city, contact, email) 
VALUES ('".$_SESSION['uid']."', '".$_POST['name']."', '".$_POST['type']."', '".$_POST['pic']."', '".$_POST['description']."', '".$_POST['country']."', '".$_POST['city']."', '".$_POST['contact']."', '".$_POST['email']."' )";

if ($conn->multi_query($sql) === TRUE) {
    $_SESSION['update_con'] = "organization added successfully";
    header("location: add_organizations.php");
    die();
} else{
    $_SESSION['update_fail'] = "Sorry. There was an error";
    header("location: add_organizations.php");
    die();
}

$conn->close();
}


#PRESENT ORGANIZATION DATA IN ORGANIZATION_VIEW
$org = $conn->query("SELECT * FROM organizations WHERE organization_id");
		$gain = $org->fetch_assoc();
		$id= $gain['organization_id'];
$_SESSION['organization'] = $gain['organization_id'];


if (isset($_GET['org_view'])) {
	if (isset($_GET['organization_id']) && $_GET['organization_id'] == $_SESSION['organization']) {
		
header("location: organization_view.php");
die();
	}
	else{
		$_SESSION['display_fail']="Error occurred!";
		header("location: organizations.php");
		die();
	}
	$conn->close();
}




?>