<?php
session_start();
if (isset($_SESSION['pen_name'])) {
	$pen_name=$_SESSION['pen_name'];
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Dashboard</title>
	</head>
	<body>
	<center>
		<h1>Dashboard</h1>
		<br>
		<a href="myopus.php?author='<?php echo $pen_name; ?>'"/>Karya ku</a>
		<br>
		<a href="create_opus.php">Buat Karya</a>
	</center>
	</body>
	</html>
	<?php
}
else{
	header('location:author_login.php');
}

?>