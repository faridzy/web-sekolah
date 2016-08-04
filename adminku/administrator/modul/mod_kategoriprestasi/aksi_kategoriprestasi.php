<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='kategoriprestasi' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori_prestasi WHERE id_kategoriprestasi='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

// Input kategori
elseif ($module=='kategoriprestasi' AND $act=='input'){
	  $katprestasi_seo = seo_title($_POST['nama_katprestasi']);

  mysql_query("INSERT INTO kategori_prestasi(nama_katprestasi,kat_prestasiseo) VALUES('$_POST[nama_katprestasi]','$katprestasi_seo')");
  header('location:../../media_admin.php?module='.$module);
}

// Update kategori
elseif ($module=='kategoriprestasi' AND $act=='update'){
		  $katprestasi_seo = seo_title($_POST['nama_katprestasi']);

  mysql_query("UPDATE kategori_prestasi SET nama_katprestasi = '$_POST[nama_katprestasi]', kat_prestasiseo='$katprestasi_seo' WHERE id_kategoriprestasi = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}
}
?>
