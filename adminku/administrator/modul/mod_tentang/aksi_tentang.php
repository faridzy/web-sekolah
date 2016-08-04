<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/library.php";
include "../../../configurasi/fungsi_thumb.php";
$module=$_GET[module];
$act=$_GET[act];
// Hapus produk
if ($module=='tentang' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM tentang  WHERE id_tentang='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM tentang WHERE id_tentang='$_GET[id]'");
     unlink("../../../foto_galeri/$_GET[namafile]");   
     unlink("../../../foto_galeri/small_$_GET[namafile]");
     unlink("../../../foto_galeri/medium_$_GET[namafile]");      
  }
  else{
     mysql_query("DELETE FROM tentang WHERE id_tentang='$_GET[id]'");
  }
  header('location:../../media_admin.php?module='.$module);
  mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}
// Input produk
elseif ($module=='tentang' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media_admin.php?module=tentang)</script>";
    }
    else{
    UploadTentang($nama_file_unik);
    mysql_query("INSERT INTO tentang(judul, 
                                    deskripsi,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[deskripsi]',
                                   '$nama_file_unik')");
  header('location:../../media_admin.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO tentang(judul,
                                    deskripsi) 
                            VALUES('$_POST[judul]',
                                   '$_POST[deskripsi]')");
  header('location:../../media_admin.php?module='.$module);
  }
}
// Update produk
elseif ($module=='tentang' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE tentang SET judul = '$_POST[judul]',                       
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_tentang  = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media_admin.php?module=tentang)</script>";
    }
    else{
    UploadTentang($nama_file_unik);
    mysql_query("UPDATE tentang SET judul = '$_POST[judul]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_tentang  = '$_POST[id]'");
    header('location:../../media_admin.php?module='.$module);
    }
  }
}
}
?>
