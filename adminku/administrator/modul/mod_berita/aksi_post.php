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
include "../../../configurasi/fungsi_seo.php";
$module=$_GET[module];
$act=$_GET[act];
// Hapus produk
if ($module=='berita' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM berita WHERE id_berita='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
     unlink("../../../foto_berita/$_GET[namafile]");   
     unlink("../../../foto_berita/small_$_GET[namafile]");
     unlink("../../../foto_berita/medium_$_GET[namafile]");      
  }
  else{
     mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
  }
  header('location:../../media_admin.php?module='.$module);
  mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}
// Input produk
elseif ($module=='berita' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media_admin.php?module=berita)</script>";
    }
    else{
    UploadBerita($nama_file_unik);
     $namaberita_seo = seo_title($_POST['nama_berita']);
    mysql_query("INSERT INTO berita(nama_berita,
                                    nama_beritaseo,
                                    id_kategori,
                                    keyword,
                                    deskripsi,
                                    tgl_masuk,
                                    pembuat,
                                    gambar) 
                            VALUES('$_POST[nama_berita]',
                                    '$namaberita_seo',
                                    '$_POST[keyword]',
                                   '$_POST[id_kategori]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang',
                                   '$_POST[pembuat]',
                                   '$nama_file_unik')");
  header('location:../../media_admin.php?module='.$module);
  }
  }
  else{
   $namaberita_seo = seo_title($_POST['nama_berita']);
    mysql_query("INSERT INTO berita(nama_berita,
                                    nama_beritaseo,
                                    id_kategori,
                                    keyword,
                                    deskripsi,
                                    pembuat,
                                    tgl_posting) 
                            VALUES('$_POST[nama_berita]',
                                    '$namaberita_seo',
                                   '$_POST[id_kategori]',
                                    '$_POST[keyword]',

                                   '$_POST[deskripsi]',
                                    '$_POST[pembuat]',
                                   '$tgl_sekarang')");
  header('location:../../media_admin.php?module='.$module);
  }
}
// Update produk
elseif ($module=='berita' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 $namaberita_seo = seo_title($_POST['nama_berita']);
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE berita SET nama_berita = '$_POST[nama_berita]',
                                  nama_beritaseo= '$namaberita_seo',
                                   id_kategori = '$_POST[id_kategori]',
                                   keyword= '$_POST[keyword]', 
                                   pembuat=  '$_POST[pembuat]',  
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_berita   = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media_admin.php?module=berita)</script>";
    }
    else{
    UploadBerita($nama_file_unik);
    $namaberita_seo = seo_title($_POST['nama_berita']);
    mysql_query("UPDATE berita SET nama_berita = '$_POST[nama_berita]',
                                      nama_beritaseo='$namaberita_seo',
                                   id_kategori = '$_POST[id_kategori]',
                                   keyword= '$_POST[keyword]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   pembuat   = '$_POST[pembuat]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_berita  = '$_POST[id]'");
    header('location:../../media_admin.php?module='.$module);
    }
  }
}
}
?>
