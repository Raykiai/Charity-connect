<?php
if (isset($_POST['login'])) {
	$sql="SELECT * FROM users WHERE uname='".$_POST['uname']."'";
	$grab = $conn->query($sql);
	if ($grab != TRUE) {
			$_SESSION['sign_in'] = "Invalid credentials!";
			header("location: login.php");
			die();
	}

	$data=$grab->fetch_assoc();
	$user=$data['type'];
	$pass=$data['pass'];
	if (isset($_POST['pass']) && $_POST['pass'] == $pass) {
		if ($user == "Admin") {
			$_SESSION['uid'] = $data['id_no'];
			$_SESSION['user'] = $data['uname'];
			$_SESSION['type'] = $user;
			header("location: admin.php");
			die();
		}
		else{
			$_SESSION['user'] = $data['uname'];
			$_SESSION['type'] = $user;
			$_SESSION['uid'] = $data['id_no'];
			header("location: home.php");
			die();
		}
	} else{
		$_SESSION['sign_in'] = "Invalid credentials!";
		header("location: login.php");
	}
	$conn->close();
	
}
?>