<?php
if (isset($_POST['pen_name'])||isset($_POST['password'])||isset($_POST['name'])||isset($_POST['email'])||isset($_POST['gender'])) {
	require "core/config.php";
	require "core/enc.php";
	$pen_name=mysqli_real_escape_string($con,$_POST['pen_name']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$password=enc($password);
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$gender=mysqli_real_escape_string($con,$_POST['gender']);
	$bd_day=mysqli_real_escape_string($con,$_POST['bd_day']);
	$bd_month=mysqli_real_escape_string($con,$_POST['bd_month']);
	$bd_year=mysqli_real_escape_string($con,$_POST['bd_year']);
	$date_created=date("Y-m-d");
	$birthday="$bd_year-$bd_month-$bd_day";
	$input=mysqli_query($con,"INSERT INTO author(pen_name,password,name,email,gender,birthday,date_created) VALUES('$pen_name','$password','$name','$email','$gender','$birthday','$date_created')");
}
?> 
 
