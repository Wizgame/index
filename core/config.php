<?php
session_start();
$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
if ($_SESSION['token']) {
function user($initial,$i){
$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
$initial = $initial;
$get = $i;
$q=mysqli_query($con,"SELECT $get FROM player WHERE initial='$initial'");
while ($fecth=mysqli_fetch_row($q)) {
	$data = $fecth[0];
}
return $data;
}
function online_status($initial){
$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
$time_now = date('Y-m-d H:i:s');
$initial=$_SESSION['token'];
$insert_time = mysqli_query($con,"UPDATE player SET time_active='$time_now' WHERE initial='$initial'");	
}
function check_status($initial){
$initial = $initial;
$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
$get_q = mysqli_query($con,"SELECT time_active FROM player WHERE initial='$initial'");
while ($stat_fecth=mysqli_fetch_row($get_q)) {
	$time_online = $stat_fecth[0];
}
$time_online = date_create("$time_online");
$time_now = date('Y-m-d H:i:s');
$time_now = date_create("$time_now");
$interval_dif = date_diff($time_now,$time_online);
$interval = $interval_dif->format('%i');
if ($interval=='0') {
	$interval = $interval_dif->format('%H');
	if ($interval=='0') {
		$interval = $interval_dif->format('%d');
		if ($interval=='0') {
			$interval = $interval_dif->format('%m');
			if ($interval=='0') {
				$interval = $interval_dif->format('%Y');
			}
		}
	}
}
if ($interval=='0') {
	$status='online';
}
else{
	$status="offline";
}
return $status;
}
function update_rank($category){
								$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
								$type=mysqli_real_escape_string($con,$category);
                                $lv_type="lv_".$type;
                                $exp_type="exp_".$type;
                                $q_type = mysqli_query($con,"SELECT * FROM player ORDER BY $lv_type DESC,$exp_type DESC");
                                if ($q_type==false) {
                                	echo "Terjadi Kesalahan";
                                }
                                else{

                                $n=1;
                                while ($f_type=mysqli_fetch_array($q_type)) {
                                	$p_initial = $f_type['initial'];
                                	$rank = "rank_".$type;
                                	$update = mysqli_query($con,"UPDATE player SET $rank='$n' WHERE initial='$p_initial' ");
                                	$n=$n+1;
                                }
}
}
function category_quiz($category_quiz){
	switch ($category_quiz) {
		case 'mtk':
			$category_quiz='Matematika';
			break;
		case 'fisika':
			$category_quiz='Fisika';
			break;
		case 'biologi':
			$category_quiz='Biologi';
			break;
		case 'Kimia':
			$category_quiz='Kimia';
			break;
		case 'komputer_informatika':
			$category_quiz='Ilmu Komputer dan Informatika';
			break;
		case 'sejarah':
			$category_quiz='Sejarah';
			break;
		case 'antropologi':
			$category_quiz='Antropologi';
			break;
		case 'ilmu_bumi':
			$category_quiz='Ilmu Bumi';
			break;
		case 'ekonomi':
			$category_quiz='Ekonomi';
			break;
		case 'ilmu_politik':
			$category_quiz='Ilmu Politik';
			break;
		case 'sosiologi':
			$category_quiz='Sosiologi';
			break;
		case 'psikologi':
			$category_quiz='Psikologi';
			break;
		case 'teknik_rekayasa':
			$category_quiz='Teknik & Rekayasa';
			break;
		default:
			$category_quiz='gagal';
			break;
			
	}
	return $category_quiz;
}
function check_level($initial,$lv_now,$lv_category,$exp,$exp_category){
	$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
	$to_lv = $lv_now+1;
	$exp_n = $to_lv*100;
	if ($exp>=$exp_n) {
		$exp = $exp-$exp_n;
	mysqli_query($con,"UPDATE player SET $exp_category='$exp',$lv_category='$to_lv' WHERE initial='$initial'");
	return true;
	}
	else{
		return false;
	}
}
function genRndString($length = 10, $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    if($length > 0)
    {
        $len_chars = (strlen($chars) - 1);
        $the_chars = $chars{rand(0, $len_chars)};
        for ($i = 1; $i < $length; $i = strlen($the_chars))
        {
            $r = $chars{rand(0, $len_chars)};
            if ($r != $the_chars{$i - 1}) $the_chars .=  $r;
        }

        return $the_chars;
    }
}
function age($birthday){
$hitunghari['awal'] = $birthday;
$hitunghari['akhir'] = date('Y-m-d');
$lahir=$hitunghari['awal'];
$selisih = time()-strtotime ($lahir);
$tahun = floor ($selisih / 31536000);
$bulan = floor (($selisih % 31536000) / 2592000);
foreach ($hitunghari as $key => $val)
{
$hitunghari[$key] = strtotime ($val);
}
$hitunghari['selisih'] = $hitunghari['akhir'] - $hitunghari['awal'];
$hitunghari['selisih'] = number_format ($hitunghari['selisih'] / 86400, 2) . 'hari';
return $tahun;
}
function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
$BulanIndo = array("Januari", "Februari", "Maret",
   "April", "Mei", "Juni",
   "Juli", "Agustus", "September",
   "Oktober", "November", "Desember");
$n_date=date_create("$date");
$d=$n_date->format('d');
$m=$n_date->format('m');
$Y=$n_date->format('Y');

$result = $d." ".$BulanIndo[(int)$m-1]." ".$Y;
return($result);
}
function time_interval($time){
	$time_str=$time;
	$time=date_create("$time");
	$time_now = date('Y-m-d H:i:s');
	$time_now = date_create("$time_now");
$interval_dif = date_diff($time,$time_now);
$interval_s = $interval_dif->format('%s');
$s = date('s',strtotime($time_str));
$interval_i = $interval_dif->format('%i');
$i = date('i',strtotime($time_str));
$interval_h = $interval_dif->format('%H');
$h = date('H',strtotime($time_str));
$interval_d = $interval_dif->format('%d');
$d = $time_now->format('%d');
$d = date('d',strtotime($time_str));
$interval_m = $interval_dif->format('%m');
$m = $time_now->format('%m');
$m = date('m',strtotime($time_str));
$interval_y = $interval_dif->format('%Y');
$y = date('Y',strtotime($time_str));
if ($interval_s<60&&$interval_i==0&&$interval_h==0&&$interval_d==0&&$interval_m==0&&$interval_y==0) {
	$interval = $interval_s.' detik yang lalu';
}
elseif ($interval_h<24&&$interval_d==0&&$interval_m==0&&$interval_y==0) {
	$interval="$h:$i";
}
elseif ($interval_d=='1'&&$interval_m==0&&$interval_y==0) {
	$interval='kemarin';
}
else{
	$interval="$d/$m/$y";
}
return $interval;
}
function home($initial,$get){
$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
$u = $initial;
$get = $get;
$q_home = mysqli_query($con,"SELECT house FROM house_occupant WHERE occupant='$u'");
if (mysqli_num_rows($q_home)==1) {
	while ($f_home=mysqli_fetch_row($q_home)) {
		$home_id=$f_home[0];
	}
	$q_h = mysqli_query($con,"SELECT $get FROM house WHERE id='$home_id'");
	while ($f_h=mysqli_fetch_row($q_h)) {
		$home_data =$f_h[0];
	}
}
else{
	$q_hostel = mysqli_query($con,"SELECT hostel FROM hostel_occupant WHERE occupant='$u'");
	while ($f_hostel=mysqli_fetch_row($q_hostel)) {
		$hostel_id = $f_hostel[0];
	}
	$q_hos = mysqli_query($con,"SELECT $get FROM hostel WHERE id='$hostel_id'");
	while ($f_hos=mysqli_fetch_row($q_hos)) {
		$home_data = $f_hos[0];
	}
}
return $home_data;
}
function insert_energy($initial){
	$energy = user($initial,'energy');
	$max_energy = user($initial,'max_energy');
	$home_energy = home($initial,'energy_per_hour');
	$add_energy	= $energy+$home_energy;
	if ($add_energy>$max_energy) {
		$add_energy=$max_energy;
	}
	$update_energy=mysqli_query($con,"UPDATE FROM player SET energy='$add_energy' WHERE initial='$initial' ");
}
online_status($initial);
}
function ava($i){
$con = mysqli_connect('localhost', 'root', '$login=m2a9s5u1997;', 'wizgame');
$initial=$i;
$get_ava = mysqli_query($con,"SELECT avatar_photo FROM player WHERE initial='$initial'");
while ($f_ava = mysqli_fetch_row($get_ava)) {
	$ava = $f_ava[0];
}
if (empty($ava)) {
	$ava='images/default_ava.jpg';
}
else{
	$ava="user_avatar/$ava";
}
return $ava;
}
?>