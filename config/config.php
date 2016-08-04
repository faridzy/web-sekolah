<?php
define('MY_PATH', 'http://localhost/web-sekolah/');
$domain = "http://localhost/web-sekolah/";
$url_share = $domain.$_SERVER['REQUEST_URI'];
$server= "localhost";
$username="root";
$pass="";
$db="db_rpl";

mysql_connect($server,$username,$pass) or die('Gagal Koneksi');
mysql_select_db($db) or die ('Database tidak ada');


$sql_setweb=mysql_query("select * from setting");
$datasetweb=mysql_fetch_array($sql_setweb);
$pagpres = strip_tags($datasetweb['paging_prestasi']);
$pagnews = strip_tags($datasetweb['paging_news']);
$paggal = strip_tags($datasetweb['paging_galeri']);
$deskripsi = strip_tags($datasetweb['deskripsi']);
$keyword= strip_tags($datasetweb['keyword']);
$logo = strip_tags($datasetweb['logo']);
$phone = strip_tags($datasetweb['phone']);
$email = strip_tags($datasetweb['email']);
$fb = strip_tags($datasetweb['facebook']);
$twitter = strip_tags($datasetweb['twitter']);
$linkedin = strip_tags($datasetweb['linkedin']);
$wa = strip_tags($datasetweb['whatshap']);
$google= strip_tags($datasetweb['google']);
$alamat = strip_tags($datasetweb['alamat']);



?>