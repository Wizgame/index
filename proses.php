<?php
$username=$_POST['username'];
$password=$_POST['password'];
if(!empty($username) and !empty($password))
{
include"core/config.php";
$level=$_POST['level'];
$perintah="select * from login where username='$username' && 
password='$password' && level='$level'";
$query=mysqli_query($con,$perintah);
$baris=mysqli_fetch_array($query);
if($baris['username']==$username and $baris['password']==$password and $baris['level']==$level)
{
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$level=$_SESSION['level'];
if($baris['level']=='admin')
{
header("location:index.php");
}
else
{
echo"tidak ada akun untuk level ini";
}
}
else{
echo"<script> alert('username/password salah'); window.history.go(-1); 

</script>";
}
}
?> 
