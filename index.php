<?php
session_start();
if ($_SESSION['token']) {
    header('location:dashboard.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Wizgame</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="style/style.css">
    <!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body class="no-js">
    <section class="main">
        <header>
            <div class="wrap">
                <div class="logo">
                    <a href="/">
                        <img src="upload/logo.png" width="262" height="52">
                    </a>
                </div><!-- logo -->
                <!-- wrap -->
        </header>
        <section class="promo">
            <div class="wrap">
                <div class="promo-text">
                    <div class="promo-title">JADILAH YANG PALING JENIUS</div>
                    <p>Wizgame adalah web based MMORPG di mana anda mengandalkan pengetahuan dan kecerdasan anda</p>
                    <p><a class="promo-button" href="login.php">MASUK</a> <a class="promo-button" href="register.php">DAFTAR</a></p>
                </div><!-- promo-text -->
                <img src="upload/promo.png" width="533" height="551" alt="">
            </div><!-- wrap -->
        </section><!-- promo -->
        <section class="simple">
            <div class="wrap">
                <h1>Latih pengetahuan dan kecerdasan anda</h1>
                <p>Naikan level anda,bergabunglah dengan organisasi,buat dan jawablah pertanyaan</p>
            </div><!-- wrap -->
        </section><!-- simple -->
        <section class="features">
            <div class="wrap">
                <div class="features-columns clearfix">
                    <div class="feature">
                        <img src="images/room.png" width="150" height="150">
                        <h4>Room</h4>
                        <p>Sebuah tempat untuk mengatur profil,menyimpan foto,item,mengisi energi.</p>
                    </div><!-- feature -->
                    <div class="feature">
                        <img src="images/organization.png" width="150" height="150">
                        <h4>Organisai</h4>
                        <p>Bergabung dengan organisasi dan dapatkan tambahan energi.Anda juga dapat bergaul dengan rekan organisasi anda</p>
                    </div><!-- feature -->
                    <div class="feature">
                        <img src="images/question.png" width="150" height="150">
                        <h4>Buat Dan Jawab Pertanyaan</h4>
                        <p>Dengan menjawab dan membuat pertanyaan anda dapat mendapatkan gold dan exp</p>
                    </div><!-- feature -->
                </div><!-- features-columns -->
            </div><!-- wrap -->
        </section><!-- features -->
        <footer>
            <div class="wrap">
                <div class="logo">
                    <a href="#">
                        <img src="upload/logo-min.png" width="100" height="100" alt="Wizgame">
                    </a>
                </div><!-- logo -->
                <div class="copy">
                    <p>Copyright &copy; <?php echo date('Y') ?> wizgame</p>
                </div><!-- copy -->
                <div class="social">
                    <ul class="clearfix">
                        <li><a class="social-facebook" href="#" title="facebook">facebook</a></li>
                        <li><a class="social-twitter" href="#" title="twitter">twitter</a></li>
                        <li><a class="social-googleplus" href="#" title="google plus">google plus</a></li>
                    </ul>
                </div><!--social -->
            </div><!-- wrap -->
        </footer>
    </section><!-- main -->
    <script src="js/jquery.js"></script>
    <script src="js/library.js"></script>
    <script src="js/script.js"></script>
    <script src="js/retina.js"></script>
</body>
</html>