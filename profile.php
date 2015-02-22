<?php
session_start();
if (isset($_SESSION['token'])) {
require "core/config.php";
session_start();
$initial = $_SESSION['token'];
if (isset($_GET['initial'])) {
$profile_initial = mysqli_real_escape_string($con,$_GET['initial']);
$check=mysqli_query($con,"SELECT * FROM player WHERE initial='$profile_initial'");
if (mysqli_num_rows($check)<1) {
	echo "tidak ada pemain dengan inisial itu";
}
else{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $profile_initial; ?></title>
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
                    <img class="img-circle" src="<?php echo ava($profile_initial); ?>" style="width: 57px;display: inline-block;">
                    <h1 style="color: #FFF;display: inline-block;vertical-align: -6px;margin-left:5px;">
                        <?php 
                        echo user($profile_initial,'initial');
                        ?>
                    </h1>
                    <?php
                    if ($profile_initial==$initial) {
                    	echo "<a href='edit_profile.php' style='float:right;'><div class='btn btn-warning' id='edit_profile_btn'>Ubah Profil</div></a>";
                    }

                    ?>
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
                        <section class="col-lg-6 connectedSortable">
                                                    <!-- Chat box -->
                             <?php
                             $show_info = user($profile_initial,'show_info');
                             if ($show_info==1) {
                             	?>
                             	<div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i><img src="images/about.png" width="25" height="25"></i> Info</h3>
                                </div>
                                <div class="box-body">
                                <?php
                                $name = user($profile_initial,'name');
                                $gender = user($profile_initial,'gender');
                                if ($gender=='male') {
                                		$gender='Laki-laki';
                                	}
                                elseif ($gender=='female') {
                                			$gender='Perempuan';
                                		}
                                $birthday=user($profile_initial,'birthday');
                                $age=age($birthday);	
                                $n_birthday=DateToIndo($birthday);

                                 ?>
                                 <label>Nama	: </label><?php echo " ".$name; ?>
                                 <br>
                                 <label>Jenis Kelamin	: </label><?php echo " ".$gender; ?>
                                 <br>
                                 <label>Usia	: </label><?php echo " ".$age." Tahun"; ?>
                                 <br>
                                 <label>Tanggal Lahir	: </label><?php echo " ".$n_birthday; ?>
                                      </div><!-- /.chat -->
                                
                            </div><!-- /.box (chat box) -->
                             	<?php
                             }

                             ?>

                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i><img src="images/quote.png" width="25" height="25"></i> Kutipan</h3>
                                </div>
                                <div class="box-body">
                                <?php
                                $quote = user($profile_initial,'quote');
                                if ($quote=='') {
                                	echo "Belum ada kutipan";
                                }
                                else{
                                	echo $quote;
                                }	
                                 ?>
                                      </div><!-- /.chat -->
                                
                            </div><!-- /.box (chat box) -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i><img src="images/about.png" width="25" height="25"></i> Tentang</h3>
                                </div>
                                <div class="box-body">
                                <?php
                                $about = user($profile_initial,'about');
                                if ($about=='') {
                                	echo "Belum di ketahui";
                                }
                                else{
                                	echo $about;
                                }	
                                 ?>
                                      </div><!-- /.chat -->
                                
                            </div><!-- /.box (chat box) -->


                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">



                               <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i style="font-size:20px;"><b>Lv</b></i> Level</h3>
                                </div>
                                <div class="box-body chat" id="chat-box" style="padding-top:0px;">
                                <div class="lv_content">
                                <h4>Level <?php echo user($profile_initial,'lv_mtk'); ?> Matematika</h4>
                                <label>Exp	: <?php 
                                $exp_mtk = user($profile_initial,'exp_mtk');
                                $lv_mtk = user($profile_initial,'lv_mtk');
                                $lv_mtk_n = $lv_mtk+1;
                                $exp_n = $lv_mtk_n*100;
                                $exp_percent = $exp_mtk/$exp_n*100;
                                echo "$exp_mtk/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_fisika'); ?> Fisika</h4>
                                <label>Exp	: <?php 
                                $exp_fisika = user($profile_initial,'exp_fisika');
                                $lv_fisika = user($profile_initial,'lv_fisika');
                                $lv_fisika_n = $lv_fisika+1;
                                $exp_n = $lv_fisika_n*100;
                                $exp_percent = $exp_fisika/$exp_n*100;
                                echo "$exp_mtk/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_biologi'); ?> Biologi</h4>
                                <label>Exp	: <?php 
                                $exp_biologi = user($profile_initial,'exp_biologi');
                                $lv_biologi = user($profile_initial,'lv_biologi');
                                $lv_biologi_n = $lv_biologi+1;
                                $exp_n = $lv_biologi_n*100;
                                $exp_percent = $exp_biologi/$exp_n*100;
                                echo "$exp_biologi/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_komputer_informatika'); ?> Komputer Dan Informatika</h4>
                                <label>Exp	: <?php 
                                $exp_komputer_informatika = user($profile_initial,'exp_komputer_informatika');
                                $lv_komputer_informatika = user($profile_initial,'lv_komputer_informatika');
                                $lv_komputer_informatika_n = $lv_komputer_informatika+1;
                                $exp_n = $lv_komputer_informatika_n*100;
                                $exp_percent = $exp_komputer_informatika/$exp_n*100;
                                echo "$exp_komputer_informatika/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_sejarah'); ?> Sejarah</h4>
                                <label>Exp	: <?php 
                                $exp_sejarah = user($profile_initial,'exp_sejarah');
                                $lv_sejarah = user($profile_initial,'lv_sejarah');
                                $lv_sejarah_n = $lv_sejarah+1;
                                $exp_n = $lv_sejarah_n*100;
                                $exp_percent = $exp_sejarah/$exp_n*100;
                                echo "$exp_sejarah/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_kimia'); ?> Kimia</h4>
                                <label>Exp	: <?php 
                                $exp_kimia = user($profile_initial,'exp_kimia');
                                $lv_kimia = user($profile_initial,'lv_kimia');
                                $lv_kimia_n = $lv_kimia+1;
                                $exp_n = $lv_kimia_n*100;
                                $exp_percent = $exp_kimia/$exp_n*100;
                                echo "$exp_kimia/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_antropologi'); ?> Antropologi</h4>
                                <label>Exp	: <?php 
                                $exp_antropologi = user($profile_initial,'exp_antropologi');
                                $lv_antropologi = user($profile_initial,'lv_antropologi');
                                $lv_antropologi_n = $lv_antropologi+1;
                                $exp_n = $lv_antropologi_n*100;
                                $exp_percent = $exp_antropologi/$exp_n*100;
                                echo "$exp_antropologi/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_ilmu_bumi'); ?> Ilmu Bumi</h4>
                                <label>Exp	: <?php 
                                $exp_ilmu_bumi = user($profile_initial,'exp_ilmu_bumi');
                                $lv_ilmu_bumi = user($profile_initial,'lv_ilmu_bumi');
                                $lv_ilmu_bumi_n = $lv_ilmu_bumi+1;
                                $exp_n = $lv_ilmu_bumi_n*100;
                                $exp_percent = $exp_ilmu_bumi/$exp_n*100;
                                echo "$exp_ilmu_bumi/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_ekonomi'); ?> Ekonomi</h4>
                                <label>Exp	: <?php 
                                $exp_ekonomi = user($profile_initial,'exp_ekonomi');
                                $lv_ekonomi = user($profile_initial,'lv_ekonomi');
                                $lv_ekonomi_n = $lv_ekonomi+1;
                                $exp_n = $lv_ekonomi_n*100;
                                $exp_percent = $exp_ekonomi/$exp_n*100;
                                echo "$exp_ekonomi/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_ilmu_politik'); ?> Ilmu Politik</h4>
                                <label>Exp	: <?php 
                                $exp_ilmu_politik = user($profile_initial,'exp_ilmu_politik');
                                $lv_ilmu_politik = user($profile_initial,'lv_ilmu_politik');
                                $lv_ilmu_politik_n = $lv_ilmu_politik+1;
                                $exp_n = $lv_ilmu_politik_n*100;
                                $exp_percent = $exp_ilmu_politik/$exp_n*100;
                                echo "$exp_ilmu_politik/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_sosiologi'); ?> Sosiologi</h4>
                                <label>Exp	: <?php 
                                $exp_sosiologi = user($profile_initial,'exp_sosiologi');
                                $lv_sosiologi = user($profile_initial,'lv_sosiologi');
                                $lv_sosiologi_n = $lv_sosiologi+1;
                                $exp_n = $lv_sosiologi_n*100;
                                $exp_percent = $exp_sosiologi/$exp_n*100;
                                echo "$exp_sosiologi/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_psikologi'); ?> Psikologi</h4>
                                <label>Exp	: <?php 
                                $exp_psikologi = user($profile_initial,'exp_psikologi');
                                $lv_psikologi = user($profile_initial,'lv_psikologi');
                                $lv_psikologi_n = $lv_psikologi+1;
                                $exp_n = $lv_psikologi_n*100;
                                $exp_percent = $exp_psikologi/$exp_n*100;
                                echo "$exp_psikologi/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                       <div class="lv_content" style="margin-top: 8%;">
                                <h4>Level <?php echo user($profile_initial,'lv_teknik_rekayasa'); ?> Teknik Dan Rekayasa</h4>
                                <label>Exp	: <?php 
                                $exp_teknik_rekayasa = user($profile_initial,'exp_teknik_rekayasa');
                                $lv_teknik_rekayasa = user($profile_initial,'lv_teknik_rekayasa');
                                $lv_teknik_rekayasa_n = $lv_teknik_rekayasa+1;
                                $exp_n = $lv_teknik_rekayasa_n*100;
                                $exp_percent = $exp_teknik_rekayasa/$exp_n*100;
                                echo "$exp_teknik_rekayasa/$exp_n";
                                ?></label>
                                <div style="background-color: rgba(233, 233, 233, 1);height: 20px;width: 100%;" id="status">
                                                         	<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $exp_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_percent; ?>%;background-color: rgba(86, 84, 84, 1);">
                                            <span class="sr-only"></span>
    
                           </div>
                       </div>
                       </div>
                                      </div><!-- /.chat -->
                            </div><!-- /.box (chat box) -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
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
	?>


	<?php
}
}
else{
	header("location:login.php");
}
?>
 
