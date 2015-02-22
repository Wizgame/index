<!DOCTYPE html>
<html>
<head>
	<title>Pendaftaran anggota</title>
</head>
<body>
<h1>Pendaftaran Anggota</h1>
<form action="user_register_process.php" method="POST">
<input type="text" name="username" placeholder='Nama Pengguna'>
<br>
<input type="password" name="password" placeholder="Kata Sandi">
<br>
<input type="text" name="name" placeholder="Nama">
<br>
<input type="email" name="email" placeholder="E-mail">
<br>
<select name="gender">
	<option value="male">Laki-laki</option>
	<option value="female">Perempuan</option>
</select>
<br>
<label>Tanggal Lahir</label>
<br>Tanggal:<select name="bd_day">
<?php
for ($i=1; $i <= 31; $i++) { 
	echo "<option value='$i'>$i</option>";
}
?>
</select>
Bulan:<select name="bd_month">
<?php
for ($i=1; $i <= 12; $i++) { 
	switch ($i) {
		case '1':
			$m='Januari';
			break;
		case '2':
			$m='Febuari';
			break;
		case '3':
			$m='Maret';
			break;
		case '4':
			$m='April';
			break;
		case '5':
			$m='Mei';
			break;
		case '6':
			$m='Juni';
			break;
		case '7':
			$m='Juli';
			break;
		case '8':
			$m='Agustus';
			break;
		case '9':
			$m='September';
			break;
		case '10':
			$m='Oktober';
			break;
		case '11':
			$m='November';
			break;
		case '12':
			$m='Desember';
			break;
		
	}
	echo "<option value='$i'>$m</option>";
}
?>
</select>
Tahun:<select name="bd_year">
<?php
$year_n=date("Y");
$year_e=$year_n-100;
for ($i=$year_n; $i >= $year_e; $i--) { 
	echo "<option value='$i'>$i</option>";
}
?>
</select>
<br>
<input type="submit" value="Daftar">
</form>
</body>
</html> 
