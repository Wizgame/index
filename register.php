<?php
require "core/config.php";
require "core/enc.php";
if (isset($_POST['initial'])&&isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password'])) {
	$input_initial = mysqli_real_escape_string($con,$_POST['initial']);
	$input_name = mysqli_real_escape_string($con,$_POST['name']);
	$input_gender = mysqli_real_escape_string($con,$_POST['gender']);
	$input_email = mysqli_real_escape_string($con,$_POST['email']);
	$input_password = enc($_POST['password']);
	$date_created = date('d-m-Y H:i');
	$check_initial = mysqli_query($con,"SELECT initial FROM player WHERE initial = '$input_initial' LIMIT 1");
	if (mysqli_num_rows($check_initial) == 0) {
		$insert_user = mysqli_query($con,"INSERT INTO player(initial,email,gender,password,name,date_created) VALUES('$input_initial','$input_email','$input_gender','$input_password','$input_name','$date_created')");
		if ($insert_user) {
			$check_hostel = mysqli_query($con,"SELECT * FROM hostel WHERE total_occupants <= 30");
			if (mysqli_num_rows($check_hostel)==0) {
				mysqli_query($con,"INSERT INTO hostel VALUES('','100','0','30')");
			}
			$hostel_q = mysqli_query($con,"SELECT * FROM hostel WHERE total_occupants <=30 LIMIT 1");
			while ($hostel_f = mysqli_fetch_assoc($hostel_q)) {
			$hostel = $hostel_f['id'];
			$hostel_name = "Asrama Nomor ".$hostel;
			$occupants = $hostel_f['total_occupants'];
			$occupants = $occupants+1;
			$save_hostel = mysqli_query($con,"INSERT INTO hostel_occupant VALUES('','$input_initial','$hostel')");
			$edit_hostel = mysqli_query($con,"UPDATE hostel SET total_occupants=$occupants,name='$hostel_name' WHERE id ='$hostel'");
			}
			?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pendaftaran Selesai</title>
<link href="style/form.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
<div class="main">
<div class="logo">
           <a href="/">
            <img src="upload/logo.png" width="262" height="52">
            </a>
                </div><!-- logo -->
                <p style="font-size: 38px;">Anda Sudah Terdaftar</p>
			  <br>
			  <a href="login.php"><input style="cursor:pointer;" type="submit" onclick="window.location='login.php';" value="Masuk" ></a>
		<!-----//end-main---->
		</div>
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
<meta charset="utf-8">
<title>Daftar Wizgame</title>
<link href="style/form.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/messages_id.js"></script>
<script>$(document).ready(function() {
        $("form").validate();
      });
</script>
</head>
<body>
<div class="main">
<div class="logo">
           <a href="/">
            <img src="upload/logo.png" width="262" height="52">
            </a>
                </div><!-- logo -->
		<form action="register.php" method="post">
		<p style="color: #F00;
font-size: 20px;">Inisial "<?php echo $input_initial; ?>" sudah ada yang menggunakanya,coba yang lain!</p>
		<div class="lable">
		        <input class="required" name="initial" type="text" class="text" value="Inisial " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Inisial ';}">
		        <input class="required" name="name" type="text" class="text" value="Nama Lengkap " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nama Lengkap ';}">
		        <select name="gender" style="font-size:20px;">
		       <option value="male">Laki-laki</option>
		       <option value="female">Wanita</option> 	
		        </select>
		   </div>
		   <div class="lable-2">
		        <input class="required" name="email" type="email" class="text" value="Email " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email ';}">
		        <input class="required" name="password" type="password" class="text" value="Kata Sandi " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Kata Sandi ';}">
		   </div>
		   <div class="submit">
			  <input type="submit" onclick="myFunction()" value="Daftar" >
		   </div>
		   <div class="clear"> </div>
		</form>
		<!-----//end-main---->
		</div>
		 <!-----start-copyright---->
   		<div class="copy-right">
			<p>Copyright &copy; 2014 wizgame</p> 
		</div>
				<!-----//end-copyright---->
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
<meta charset="utf-8">
<title>Daftar Wizgame</title>
<link href="style/form.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/messages_id.js"></script>
<script>$(document).ready(function() {
        $("form").validate();
      });
</script>
</head>
<body>
<div class="main">
<div class="logo">
           <a href="/">
            <img src="upload/logo.png" width="262" height="52">
            </a>
                </div><!-- logo -->
		<form action="register.php" method="post">
		<div class="lable">
		        <input class="required" name="initial" type="text" class="text" value="Inisial " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Inisial ';}">
		        <input class="required" name="name" type="text" class="text" value="Nama Lengkap " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nama Lengkap ';}">
		        <select name="gender" style="font-size:20px;">
		       <option value="male">Laki-laki</option>
		       <option value="female">Wanita</option> 	
		        </select>
		   </div>
		   <div class="lable-2">
		        <input class="required" name="email" type="email" class="text" value="Email " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email ';}">
		        <input class="required" name="password" type="password" class="text" value="Kata Sandi " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Kata Sandi ';}">
		   </div>
		   <div class="submit">
			  <input type="submit" onclick="myFunction()" value="Daftar" >
		   </div>
		   <div class="clear"> </div>
		</form>
		<!-----//end-main---->
		</div>
		 <!-----start-copyright---->
   		<div class="copy-right">
			<p>Copyright &copy; 2014 wizgame</p> 
		</div>
				<!-----//end-copyright---->
</body>
</html>
<?php
}
?>