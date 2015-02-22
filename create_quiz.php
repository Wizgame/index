<?php
session_start();
if (isset($_SESSION['token'])) {
require "core/config.php";
session_start();
$initial = $_SESSION['token'];
if (isset($_POST['quiz_type'])&&isset($_POST['quest'])&&isset($_POST['answer'])) {
$quiz_type = $_POST['quiz_type'];
$quest = $_POST['quest'];
$answer = $_POST['answer'];
$create_by = $initial;
$datetime = date('Y-m-d H:i:s');
$create = mysqli_query($con,"INSERT INTO quest(category,quest,answer,created_by,datetime) VALUES('$quiz_type','$quest','$answer','$create_by','$datetime')");
if ($create) {
	header("location:quiz.php");
}
}
	?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buat Kuis</title>
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
                    <img src="images/quiz-white.png" style="width: 57px;display: inline-block;">
                    <h1 style="color: #FFF;display: inline-block;vertical-align: -6px;">
                     Kuis
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
                                <div class="box-header">
                                    <h3 style="margin-left:10px;">Buat Kuis</h3>
                                </div>
                                   <div class="box-footer">
                                   <form action="create_quiz.php" method="POST">
                                    <div class="input-group">
                                        <label>Type Soal :</label>
                                        <select name="quiz_type" class="form-control">
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
                                        <label>Pertanyaan	:</label>
                                        <textarea name="quest" class="form-control" placeholder="Masukan Pertanyaan...">
                                        </textarea>
                                        <label>Jawaban	:</label>
                                        <input name="answer" type="text" class="form-control" placeholder="masukan jawaban"/>
                                        <br>
                                        <br>
                                        <div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-info"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Perhatian!</b><br> - Pembuat kuis akan mendapatkan exp dan gold setelah kuis terjawab oleh pemain lain.
                                        <br>- Semakin banyak pemain yang salah menjawab kuis anda semakin besar pula exp yang anda dapatkan.
                                    </div>
                                     <button type="submit" class="btn btn-primary">Buat</button>
                                    </div>
                                    </form>
                                </div>


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
 
