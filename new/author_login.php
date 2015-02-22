<?php
require "core/config.php";
require "core/enc.php";
if (isset($_POST['pen_name'])||isset($_POST['password'])) {
	$pen_name=mysqli_real_escape_string($con,$_POST['pen_name']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$password=enc($password);
	$check_login=mysqli_query($con,"SELECT * FROM author WHERE pen_name='$pen_name' AND password='$password'");
	if (mysqli_num_rows($check_login)>0) {
		session_start();
		$_SESSION['pen_name']=$pen_name;
		echo "<meta http-equiv='refresh' content='0;url=author_dashboard.php' />";
	}
	else{
	?>
	<!DOCTYPE html>
<html>
<head>
	<title>Login Pengarang</title>
</head>
<body>
<center>
<h1>Login Pengarang</h1>
<h3 style="color:red;">Nama Pena atau password tidak cocok</h3>
<form action="author_login.php" method="post">
	<input type="text" name="pen_name" placeholder="Masukan Nama Pena" >
	<br>
	<input type="password" name="password" placeholder="Masukan Kata Sandi">
	<br>
	<input type="submit" value="Masuk">
</form>
</center>
</body>
</html> 
	<?php		
	}
}
else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pengarang</title>
</head>
<body>
<center>
<h1>Login Pengarang</h1>
<form action="author_login.php" method="post">
	<input type="text" name="pen_name" placeholder="Masukan Nama Pena" >
	<br>
	<input type="password" name="password" placeholder="Masukan Kata Sandi">
	<br>
	<input type="submit" value="Masuk">
</form>
</center>
</body>
</html> 
<?php
}
?>