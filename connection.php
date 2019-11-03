<?php 

$conn = mysqli_connect("localhost", "root", "", "mycharity");
	if ($conn -> connect_error) {
		die("No connection:". $conn-> connect_error);
	}

 ?>