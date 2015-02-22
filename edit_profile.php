<?php
session_start();
if (isset($_SESSION['token'])) {
require "core/config.php";
session_start();
$initial = $_SESSION['token'];
if (isset($_POST['name'])||isset($_POST['quote'])||isset($_POST['about'])||isset($_POST['show_info'])||isset($_POST['tanggal'])||isset($_POST['bulan'])||isset($_POST['tahun'])) {
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$quote = mysqli_real_escape_string($con,$_POST['quote']);
	$about = mysqli_real_escape_string($con,$_POST['about']);
	if (isset($_POST['show_info'])) {
		$show_info=1;
	}
	else{
		$show_info=0;
	}
	$tanggal = mysqli_real_escape_string($con,$_POST['tanggal']);
	$bulan = mysqli_real_escape_string($con,$_POST['bulan']);
	$tahun = mysqli_real_escape_string($con,$_POST['tahun']);
	$birthday = "$tahun-$bulan-$tanggal";
	$update = mysqli_query($con,"UPDATE player SET name='$name',quote='$quote',about='$about',birthday='$birthday',show_info='$show_info' WHERE initial='$initial'");
}
if (!empty($_FILES['avatar']['tmp_name'])) {
	$file_type = $_FILES['avatar']['type'];
	if($file_type=="image/jpeg" || $file_type=="image/jpg" || $file_type=="image/gif" || $file_type=="image/x-png"|| $file_type=="image/png") {
		$file_name = basename(genRndString());
		$location = "user_avatar/".$file_name;
		$upload = move_uploaded_file($_FILES['avatar']['tmp_name'], $location);
		if ($upload) {
			$update = mysqli_query($con,"UPDATE player SET avatar_photo='$file_name' WHERE initial='$initial'");
		}
	}
}

	?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ubah Profil</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
    <?php
include "navbar.php";
    ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
<?php
include "sidebar.php";
?>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <img class="img-circle" src="<?php echo ava($initial); ?>" style="width: 57px;display: inline-block;">
                    <h1 style="color: #FFF;display: inline-block;vertical-align: -6px;margin-left:5px;">
                        <?php 
                        echo user($initial,'initial');
                        ?>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable" style="width:100%;">
                                                    <!-- Chat box -->
                            <div class="box box-success">
                                   <div class="box-footer">
                                   <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
									<label>Gambar Avatar	:</label>
									<input name="avatar" type="file" accept="image/*">
									<br>        
                                	<label>Nama	:</label>
                                	<input name="name" style="width:100%;" class="form-control" value="<?php echo user($initial,'name'); ?>">
      								<br>
      								<label>Kutipan	:</label>
      								<textarea name="quote" class="form-control"><?php echo user($initial,'quote'); ?></textarea>
      								<br>
      								<label>Tentang	:</label>
      								<textarea name="about" class="form-control"><?php echo user($initial,'about'); ?></textarea>
                                    <br>
                                     <p>Tanggal Lahir : 
 <?php
 	$birthday = user($initial,'birthday');
 	$birthday = date_create("$birthday");
 	$tanggal = $birthday->format('d');
 	$bulan = $birthday->format('m');
 	$tahun = $birthday->format('Y');
 ?>
 <select name="tanggal" id="tanggal">
   <?
for($n=1; $n<=31; $n++){ #melakukan perulangan angka 1 s.d 31
if ($n==$tanggal) {
	echo "<option value='$n' selected>$n</option>";
}
else{
echo "<option value='$n'>$n</option>";	
}

?>
   <? } ?>
 </select>
  <select name="bulan" id="bulan">
   <?
$bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
for($n=0; $n<=11; $n++){
if ($n+1==$bulan) {
	$b=$n+1;
	$bulan = $bln[$n];
	echo "<option value='$b' selected>$bulan</option>";
}
else{
echo "<option value='$b' selected>$bulan</option>";	
}
?>
   <? } ?>
 </select>
  <select name="tahun" id="tahun">
   <?
  $year=date('Y');
  $year_min = $year-100;
for($n=$year; $n>=$year_min; $n--){ #melakukan perulangan angka 1920 s.d 2020
	if($n == $tahun){ #menunjuk 1990 sebagai default pilihan
?>
   <option value="<?=$n;?>" selected><?=$n;?></option>
   <?
	}else{
?>
   <option value="<?=$n;?>"><?=$n;?></option>
   <?	}
} 
?>
 </select>
 <br>
 <p>
<?php
$show_info=user($initial,'show_info');
if ($show_info==1) {
echo "<input name='show_info' value='1' type='checkbox' checked>";
}
else{
echo "<input name='show_info' value='1' type='checkbox'>";	
}
?>
  Perlihatkan info saya(nama,jenis kelamin,usia,tanggal lahir)</p>
                                    <button type="submit" class="btn btn-warning">Ubah</button>
                                    </form>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                      </div><!-- /.chat -->
                            </div><!-- /.box (chat box) -->


                        </section><!-- /.Left col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>        

    </body>
</html> 

	<?php
}
else{
	header("location:login.php");
}
?>
