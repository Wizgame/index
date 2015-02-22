<?php
if (empty($_SESSION['token'])) {
	header("location:login.php");
}
?>
