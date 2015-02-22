<?php
session_start();
if (isset($_SESSION['token'])) {
require "core/config.php";
session_start();
$initial = $_SESSION['token'];
if (isset($_GET['type'])) {
	?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Peringkat</title>
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
                    <img src="images/ranking-white.png" style="width: 57px;display: inline-block;">
                    <h1 style="color: #FFF;display: inline-block;vertical-align: -6px;">
                     <?php
                     $category = mysqli_real_escape_string($con,$_GET['type']);
                     $category = category_quiz("$category");
                     ?>

                     Peringkat <?php echo $category; ?>
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
                                                                      <div class="box-footer">
                                   <form action="ranking.php" method="GET">
                                    <div class="input-group">
                                        <select class="form-control" name="type">
                                        <option value="">--Tipe--</option>
                                        <option value="mtk">Matematika</option>
                                            <option value="fisika">Fisika</option>
                                            <option value="biologi">Biologi</option>
                                            <option value="Kimia">Kimia</option>
                                            <option value="komputer_informatika">Ilmu Komputer dan Informatika</option>
                                            <option value="sejarah">Sejarah</option>
                                            <option value="antropologi">Antropologi</option>
                                            <option value="ilmu_bumi">Ilmu Bumi</option>
                                            <option value="ekonomi">Ekonomi</option>
                                            <option value="ilmu_politik">Ilmu Politik</option>
                                            <option value="sosiologi">Sosiologi</option>
                                            <option value="psikologi">Psikologi</option>
                                            <option value="teknik_rekayasa">Teknik & Rekayasa</option>
                                        </select>
                                        <div class="input-group-btn">
                                            <button type="submit" value="Ubah" class="btn btn-success">Ubah</i></button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                <?php
                                $type=mysqli_real_escape_string($con,$_GET['type']);
                                update_rank($type);
                                $lv_type="lv_".$type;
                                $exp_type="exp_".$type;
                                $rank_type="rank_".$type;
                                $q_type = mysqli_query($con,"SELECT * FROM player ORDER BY $lv_type DESC,$exp_type DESC");
                                if ($q_type==false) {
                                	echo "<br>Terjadi kesalahan";
                                }
                                else{
                                $n=1;
                                while ($f_type=mysqli_fetch_array($q_type)) {
                                	$p_initial=$f_type['initial']; 
                                	$p_rank = $f_type["$rank_type"];
                                		$q_p=mysqli_query($con,"SELECT * FROM player WHERE initial='$p_initial'");
                            $check_status = check_status($p_initial);
                            if ($check_status=='online') {
                            	echo "
                            	<div class='item'>
                                        <h2 style='display: inline;vertical-align: middle;'>#$p_rank</h2>
                                        <img src='".ava($p_initial)."' alt='user image' class='online'/>
                                        <p style='margin-left:95px;' class='message'>
                                            <a href='profile.php?initial=$p_initial' class='name'>
                                                ".user($p_initial,'initial')."
                                            </a>
                                           ";
                            	?>
                            	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                            	<?php
                            }
                            else
                            {
                            	echo "
                                <div class='item'>
                                        <h2 style='display: inline;vertical-align: middle;'>#$p_rank</h2>
                                        <img src='".ava($p_initial)."' alt='user image' class='online'/>
                                        <p style='margin-left:95px;' class='message'>
                                            <a href='profile.php?initial=$p_initial' class='name'>
                                                ".user($p_initial,'initial')."
                                            </a>
                                           ";
                                ?>
                            	<a href="#"><i style="color:rgba(65, 41, 41, 1)" class="fa fa-circle text-success"></i> Offline</a>
                            	<?php
                            }
                            $n=$n+1;
                             echo  "</div>";
                                }
                            }
                                ?>
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
	header("location:dashboard.php");
}
}
else{
	header("location:login.php");
}
?>
 
 
