<?php
function enc($password){
	for ($i=1;$i<=2929;$i++) { 
	$password=md5($password);
	}
	return $password;
}
?> 
