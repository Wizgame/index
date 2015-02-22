<?php
require "core/config.php";
require "core/enc.php";
if (isset($_POST['initial'])&&isset($_POST['password'])) {
$input_initial = mysqli_real_escape_string($con,$_POST['initial']);
$input_password = mysqli_real_escape_string($con,$_POST['password']);
$input_password = enc($input_password);
$login = mysqli_query($con,"SELECT * FROM player WHERE initial='$input_initial' AND password='$input_password'");
$cek_login = mysqli_num_rows($login);
if ($cek_login==1) {
	session_start();
	$_SESSION['token']=$input_initial;
	header("location:dashboard.php");
}
elseif ($cek_login==0) {
	?>
	<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="style/login.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- -->
<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script>
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<a href="/"><img src="upload/logo.png" width="262" height="52"></a>
		 <div class="alert-close"> </div> 			
	</div>
		<form action="login.php" method="POST">
			<p style="color:red;">Inisial Atau Kata Sandi Salah</p>
			<li>
				<input name="initial" type="text" class="text" value="Inisial" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Inisial';}"><a href="#" class=" icon user"></a>
			</li>
				<div class="clear"> </div>
			<li>
				<input name="password" type="password" value="Kata Sandi" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Kata Sandi';}"> <a href="#" class="icon lock"></a>
			</li>
			<div class="clear"> </div>
			<div class="submit">
				<input type="submit" onclick="myFunction()" value="Masuk" >
						  <div class="clear">  </div>	
			</div>
				
		</form>
		</div>					
	</div>
	</div>
	<div class="clear"> </div>
</body>
</html> 

	<?php	
}
}
else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="style/login.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- -->
<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
<script src="js/jquery.min.js"></script>
<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script>
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<a href="/"><img src="upload/logo.png" width="262" height="52"></a>
		 <div class="alert-close"> </div> 			
	</div>
		<form action="login.php" method="POST">
			<li>
				<input name="initial" type="text" class="text" value="Inisial" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Inisial';}"><a href="#" class=" icon user"></a>
			</li>
				<div class="clear"> </div>
			<li>
				<input name="password" type="password" value="Kata Sandi" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Kata Sandi';}"> <a href="#" class="icon lock"></a>
			</li>
			<div class="clear"> </div>
			<div class="submit">
				<input type="submit" onclick="myFunction()" value="Masuk" >
						  <div class="clear">  </div>	
			</div>
				
		</form>
		</div>					
	</div>
	</div>
	<div class="clear"> </div>
</body>
</html> 
<?php
}
 ?>
