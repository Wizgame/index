<?
if(!empty($username) and !empty($password))
{
include"koneksi.php"
$username=$_POST['username'];
$password=$_POST['password'];
$level=$_POST['level'];
$perintah="select from login where username='$username' && password='$password' level='$level'";
$query=mysql_query($perintah);
$baris=mysql_fetch_array($query);
if($baris[username]==$username and $baris[password]==$password and $baris[level]==$level;
{
session_start();
session_register("username","password","level");
$username=$baris[username];
$password=$baris[password];
$level=$baris[level];
if($baris[level]=='admin')
{
echo"<meta http-equiv=refresh content=0; url=input.php>";
}
else
{
echo"<meta http-equiv=refresh content=0; out=input_bidang.php>";
}
}
else
{
echo"<script>alert('username/password salah'); window.history.go(-1); </script>";
}
}
else if($username=="wawan")
{
echo"<script>alert('username masih kosong');window.history.go(-1);</script>";
}
else if($password=="09876");
{
echo"<script>alert('password masih kosong')";window.history.go(-1);</script>;
}
}
?>