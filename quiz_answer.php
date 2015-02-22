<?php
session_start();
if (isset($_SESSION['token'])) {
require "core/config.php";
session_start();
$initial = $_SESSION['token'];
	?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kuis</title>
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
                                </div>
                                   <div class="box-footer">
                                </div>
                                <div class="box-body chat" id="chat-box">
                                <?php
                                $home_type = home($initial,'type');
                                $home_id = home($initial,'id');
                                if (isset($_POST['answer'])) {
								$quiz_id = mysqli_real_escape_string($con,$_GET['id']);
								$answer = mysqli_real_escape_string($con,$_POST['answer']);
                                    $q_quiz=mysqli_query($con,"SELECT * FROM quest WHERE id='$quiz_id' AND winner='' ORDER BY id DESC");
                                if (mysqli_num_rows($q_quiz)==0) {
                                	echo "<div class='item'>
                                    <h3>Pertanyaan sudah terjawab oleh pemain lain</h3>
                                    <a href='quiz_answer.php?id=$quiz_id'><div class='btn btn-success btn-lg'>Jawab Lagi</div></a>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
                                    ";
                                }
                                else{
                                while ($f_quiz=mysqli_fetch_array($q_quiz)) {
                                	$create_by_initial = $f_quiz['created_by'];
                                	$quiz_id = $f_quiz['id'];
                                	$exp = $f_quiz['exp'];
                                    $quest = $f_quiz['quest'];
                                	$time_quiz = $f_quiz['datetime'];
                                	$time_quiz = time_interval($time_quiz);
                                	$category = $f_quiz['category'];
                                    $category = category_quiz($category);
                                    $wrong = $f_quiz['wrong'];
                                    $gold = $f_quiz['gold'];
                                    $quiz_answer = $f_quiz['answer'];
                                    $quiz_energy = $f_quiz['energy'];
                                    $user_energy = user($initial,'energy');
                                    $user_gold = user($initial,'gold');
                                    $exp_category = 'exp_'.$f_quiz['category'];
                                    $user_exp = user($initial,$exp_category);
                                    $energy = $user_energy-$quiz_energy;
                                    if ($wrong>0) {
                                        $exp = $exp*$wrong;
                                        $quiz_energy = $wrong*$quiz_energy;
                                    }
                                    
                                    if ($answer==$quiz_answer&&$energy>=0) {
                                    	$gold = $gold+$user_gold;
                                    	$exp = $exp+$user_exp;
                                    	$exp_category = 'exp_'.$f_quiz['category'];
                                    	mysqli_query($con,"UPDATE player SET energy='$energy',gold='$gold',$exp_category='$exp' WHERE initial='$initial'");
                                    	mysqli_query($con,"UPDATE quest SET winner='$initial' WHERE id='$quiz_id'");
                                    $lv_now = user($initial,'lv_'.$f_quiz['category']);
                                    $lv_to = $lv_now+1;
                                    $check_lv = check_level($initial,$lv_now,'lv_'.$f_quiz['category'],$exp,$exp_category);
                                    if ($check_lv) {
                                    echo "<div class='item'>
                                    <h3>Selamat! Jawaban Anda Benar dan level $category anda naik ke level $lv_to</h3>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
     
                                    ";	
                                    }
                                    else{
                                    echo "<div class='item'>
                                    <h3>Selamat! Jawaban Anda Benar</h3>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
     
                                    ";
                                }
                                    }
                                    elseif ($energy<0) {
                                    echo "<div class='item'>
                                    <h3>Energy anda tidak cukup</h3>
                                    <a href='quiz_answer.php?id=$quiz_id'><div class='btn btn-success btn-lg'>Jawab Lagi</div></a>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
     
                                    ";	
                                    }
                                    elseif ($answer!=$quiz_answer) {
                                    if ($wrong>=1) {
                                    	$wrong=$wrong+1;
                                    }
                                    else{
                                    	$wrong=1;
                                    }
                                    mysqli_query($con,"UPDATE quest SET wrong='$wrong' WHERE id='$quiz_id'");
                                    mysqli_query($con,"UPDATE player SET energy='$energy' WHERE initial='$initial'");
                                    echo "<div class='item'>
                                    <h3>Jawaban anda salah</h3>
                                    <a href='quiz_answer.php?id=$quiz_id'><div class='btn btn-success btn-lg'>Jawab Lagi</div></a>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
     
                                    ";
                                    }
                                    else{
                                    mysqli_query($con,"UPDATE player SET energy='$energy' WHERE initial='$initial'");
                                    echo "<div class='item'>
                                    <h3>Jawaban anda salah</h3>
                                    <a href='quiz_answer.php?id=$quiz_id'><div class='btn btn-success btn-lg'>Jawab Lagi</div></a>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
     
                                    ";
                                    }
                                    }
                                }
                                }
                                else{
                                $quiz_id=mysqli_real_escape_string($con,$_GET['id']);
                                $q_quiz=mysqli_query($con,"SELECT * FROM quest WHERE id='$quiz_id' AND winner='' ORDER BY id DESC");
                                if (mysqli_num_rows($q_quiz)==0) {
                                	echo "<div class='item'>
                                    <h3>Pertanyaan sudah terjawab oleh pemain lain</h3>
                                    <a href='quiz_answer.php?id=$quiz_id'><div class='btn btn-success btn-lg'>Jawab Lagi</div></a>
                                    <a href='quiz.php'><div class='btn btn-primary btn-lg'>Cari Pertanyaan Lain</div></a>
     
                                    ";
                                }
                                else{
                                while ($f_quiz=mysqli_fetch_array($q_quiz)) {
                                	$create_by_initial = $f_quiz['created_by'];
                                	$quiz_id = $f_quiz['id'];
                                    $quest = $f_quiz['quest'];
                                    $exp = $f_quiz['exp'];
                                	$time_quiz = $f_quiz['datetime'];
                                	$time_quiz = time_interval($time_quiz);
                                	$category = $f_quiz['category'];
                                    $category = category_quiz($category);
                                    $wrong = $f_quiz['wrong'];
                                    $gold = $f_quiz['gold'];
                                    $quiz_energy = $f_quiz['energy'];
                                    if ($wrong>0) {
                                        $exp = $exp*$wrong;
                                        $quiz_energy = $wrong*$quiz_energy;
                                        $wrong."  orang salah menjawab pertanyaan ini";
                                    }
                                    echo "
                                <div class='item'>
                                        <img src='".ava($create_by_initial)."' alt='user image' class=".check_status($create_by_initial)."/>
                                        <p class='message'>
                                            <a href='#' class='name'>
                                                <small class='text-muted pull-right'><i class='fa fa-clock-o'></i> $time_quiz</small>
                                                ".user($create_by_initial,'initial')."
                                            </a>
                                            <p style='opacity: 0.8;margin-left: 55px;margin-top: -10px;'>$category</p>
                                            </p>
                                            $quest
                                            <div id=notice style='margin-top:10px;'>$notice</div>
                                            <div id='reward'>Hadiah :<div id='exp' style='display: inline-block;margin: 10px;'>Exp  :$exp</div><div id='gold' style='display: inline-block;margin: 10px;'><img src='images/wizgold.png' width='18' height='18'>$gold</div></div>
                                    </div>
                                    <form action='quiz_answer.php?id=$quiz_id' method='post'>
                                    <input name='answer' type='text' class='form-control' placeholder='Masukan Jawaban...' class='col-xs-5'/>
                                    <input type='submit' class='btn btn-primary btn-sm' value='Jawab'>
                                    <div id='gold' style='display: inline-block;margin: 10px;'><img src='images/energy.png' width='18' height='18'>$quiz_energy</div>
                                    </form>
                                    ";
                                }
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
	header("location:login.php");
}
?>
 
