<?php
session_start();
if (isset($_SESSION['token'])) {
require "core/config.php";
session_start();
$initial = $_SESSION['token'];
if (isset($_POST['post_content'])) {
	$post_content=mysqli_real_escape_string($con,$_POST['post_content']);
	$post_by=mysqli_real_escape_string($con,$initial);
	$home_type=home($initial,'type');
	$home_id=home($initial,'id');
	$date=date('Y-m-d H:i:s');
	$submit=mysqli_query($con,"INSERT INTO home_chat VALUES('','$post_by','$post_content','$home_type','$home_id','$date')");
}
	?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
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
                    <img src="images/hostel.png" style="width: 57px;display: inline-block;">
                    <h1 style="color: #FFF;display: inline-block;vertical-align: -6px;">
                        <?php 
                        echo home($initial,'name');
                        ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i><?php echo home($initial,'energy_per_hour') ?><img style="opacity:0,6;" src="images/energy-white.png" width="18"></i>/Jam</a></li>
                    </ol>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-comments-o"></i> Obrolan</h3>
                                </div>
                                   <div class="box-footer">
                                   <form action="dashboard.php" method="POST">
                                    <div class="input-group">
                                        <input name="post_content" class="form-control" placeholder="Katakan Sesuatu..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                <?php
                                $home_type = home($initial,'type');
                                $home_id = home($initial,'id');
                                $q_chat=mysqli_query($con,"SELECT * FROM home_chat WHERE home_type='$home_type' AND home_id='$home_id' ORDER BY id DESC");	
                                while ($f_chat=mysqli_fetch_array($q_chat)) {
                                	$initial_chat = $f_chat['by'];
                                	$content_chat = $f_chat['content'];
                                	$time_chat = $f_chat['date'];
                                	$time_chat = time_interval($time_chat);
                                	echo "
                                <div class='item'>
                                        <img src='".ava($initial_chat)."' alt='user image' class=".check_status($initial_chat)."/>
                                        <p class='message'>
                                            <a href='profile.php?initial=$initial_chat' class='name'>
                                                <small class='text-muted pull-right'><i class='fa fa-clock-o'></i> $time_chat</small>
                                                ".user($initial_chat,'initial')."
                                            </a>
                                            $content_chat
                                    </div>";
                                }
                                ?>
                                      </div><!-- /.chat -->
                            </div><!-- /.box (chat box) -->


                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">



                               <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i><img src="images/people.png" style="width: 25px;opacity: 0.7;"></i> Penghuni</h3>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                <?php
                                $home_type = home($initial,'type');
                                if ($home_type==1) {
                                $q_on=mysqli_query($con,"SELECT * FROM house_occupant WHERE house='$home_id'");
                                while ($f_on=mysqli_fetch_array($q_on)) {
                                		$p_initial=$f_on['occupant']; 
                                		$q_p=mysqli_query($con,"SELECT * FROM player WHERE initial='$p_initial'");
                            $check_status = check_status($p_initial);
                            if ($check_status=='online') {
                            	echo "<div class='item'>
                                        <img src='".ava($p_initial)."' alt='user image' class='online'/>
                                        <p class='message'>
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
                            	echo "<div class='item'>
                                        <img src='".ava($p_initial)."' alt='user image' class='offline'/>
                                        <p class='message'>
                                            <a href='profile.php?initial=$p_initial' class='name'>
                                                ".user($p_initial,'initial')."
                                            </a>
                                           ";
                            	?>
                            	<a href="#"><i style="color:rgba(65, 41, 41, 1)" class="fa fa-circle text-success"></i> Offline</a>
                            	<?php
                            }
                             echo  "</div>";
                                	}	
                                }
                                elseif ($home_type==0) {
                                $q_on=mysqli_query($con,"SELECT * FROM hostel_occupant WHERE hostel='$home_id'");
                                while ($f_on=mysqli_fetch_array($q_on)) {
                                		$p_initial=$f_on['occupant']; 
                                		$q_p=mysqli_query($con,"SELECT * FROM player WHERE initial='$p_initial'");
                            $check_status = check_status($p_initial);
                            if ($check_status=='online') {
                            	echo "<div class='item'>
                                        <img src='".ava($p_initial)."' alt='user image' class='online'/>
                                        <p class='message'>
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
                            	echo "<div class='item'>
                                        <img src='".ava($p_initial)."' alt='user image' class='offline'/>
                                        <p class='message'>
                                            <a href='profile.php?initial=$p_initial' class='name'>
                                                ".user($p_initial,'initial')."
                                            </a>
                                            ";
                            	?>
                            	<a href="#"><i style="color:rgba(65, 41, 41, 1)" class="fa fa-circle text-success"></i> Offline</a>
                            	<?php
                            }
                                 echo   "</div>";
                                	}
                                }
                                ?>
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
else{
	header("location:login.php");
}
?>
