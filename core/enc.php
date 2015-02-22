<?php
function enc($password){
	for ($i=0; $i < 2929; $i++) { 
		$input_password = md5($password);
		return $input_password;
	}
} 
?>