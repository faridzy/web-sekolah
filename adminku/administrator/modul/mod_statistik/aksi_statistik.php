<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
session_start();
include "../../../configurasi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus modul
if ($module=='statistik' AND $act=='hapus'){
  mysql_query("DELETE FROM statistik WHERE id_statistik='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}
}
?>
