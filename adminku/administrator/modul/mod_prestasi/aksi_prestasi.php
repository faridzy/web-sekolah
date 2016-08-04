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
if ($module=='prestasi' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM prestasi WHERE id_prestasi='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM prestasi WHERE id_prestasi='$_GET[id]'");
     unlink("../../../foto_berita/$_GET[namafile]");   
     unlink("../../../foto_berita/small_$_GET[namafile]");
     unlink("../../../foto_berita/medium_$_GET[namafile]");      
  }
  else{
     mysql_query("DELETE FROM prestasi WHERE id_prestasi='$_GET[id]'");
  }
  header('location:../../media_admin.php?module='.$module);
  mysql_query("DELETE FROM prestasi WHERE id_prestasi='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}
// Input produk
elseif ($module=='prestasi' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media_admin.php?module=prestasi)</script>";
    }
    else{
    UploadBerita($nama_file_unik);
     $namaprestasi_seo = seo_title($_POST['nama_prestasi']);
    mysql_query("INSERT INTO prestasi(nama_prestasi,
                                    nama_prestasiseo,
                                    id_kategoriprestasi,
                                    keyword,
                                    deskripsi,
                                    tgl_masuk,
                                    pembuat,
                                    gambar) 
                            VALUES('$_POST[nama_prestasi]',
                                    '$namaprestasi_seo',
                                   '$_POST[id_kategoriprestasi]',
                                    '$_POST[keyword]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang',
                                   '$_POST[pembuat]',
                                   '$nama_file_unik')");
  header('location:../../media_admin.php?module='.$module);
  }
  }
  else{
   $namaprestasi_seo = seo_title($_POST['nama_prestasi']);
    mysql_query("INSERT INTO prestasi(nama_prestasi,
                                    nama_prestasiseo,
                                    id_kategoriprestasi,
                                    keyword,
                                    deskripsi,
                                    pembuat,
                                    tgl_posting) 
                            VALUES('$_POST[nama_prestasi]',
                                    '$namaprestasi_seo',
                                   '$_POST[id_kategoriprestasi]',
                                    '$_POST[keyword]',

                                   '$_POST[deskripsi]',
                                    '$_POST[pembuat]',
                                   '$tgl_sekarang')");
  header('location:../../media_admin.php?module='.$module);
  }
}
// Update produk
elseif ($module=='prestasi' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 $namaprestasi_seo = seo_title($_POST['nama_prestasi']);
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE prestasi SET nama_prestasi = '$_POST[nama_prestasi]',
                                  nama_prestasiseo= '$namaprestasi_seo',
                                   id_kategoriprestasi = '$_POST[id_kategoriprestasi]', 
                                   keyword= '$_POST[keyword]',
                                   pembuat=  '$_POST[pembuat]',  
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_prestasi  = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media_admin.php?module=prestasi)</script>";
    }
    else{
    UploadBerita($nama_file_unik);
    $namaprestasi_seo = seo_title($_POST['nama_prestasi']);
    mysql_query("UPDATE prestasi SET nama_prestasi = '$_POST[nama_prestasi]',
                                      nama_prestasiseo='$namaprestasi_seo',
                                   id_kategoriprestasi = '$_POST[id_kategoriprestasi]',
                                   keyword ='$_POST[keyword]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   pembuat   = '$_POST[pembuat]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_prestasi  = '$_POST[id]'");
    header('location:../../media_admin.php?module='.$module);
    }
  }
}
}
?>
