<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/fungsi_thumb.php";
include "../../../configurasi/library.php";
$module=$_GET[module];
$act=$_GET[act];
if ($module=='admin' AND $act=='hapus'){
  mysql_query("DELETE FROM pengajar WHERE id_pengajar = '$_GET[id]'");
  if ($data['foto']!=''){
     mysql_query("DELETE FROM pengajar WHERE id_pengajar='$_GET[id]'");
     unlink("../../../foto_pengajar/$_GET[namafile]");   
     unlink("../../../foto_pengajar/small_$_GET[namafile]");
     unlink("../../../foto_pengajar/medium_$_GET[namafile]");      
  }
  else{
     mysql_query("DELETE FROM pengajar WHERE id_pengajar='$_GET[id]'");
  }
  header('location:../../media_admin.php?module='.$module);
  mysql_query("DELETE FROM pengajar WHERE id_pengajar'$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}
elseif ($module=='admin' AND $act=='input_admin'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO admin(username,
                                 password,
                                 nama_lengkap,
                                 alamat,
                                 email, 
                                 no_telp,
                                 blokir,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[alamat]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                '$_POST[blokir]',
                                '$pass')");
  header('location:../../media_admin.php?module='.$module);
}
elseif ($module=='admin' AND $act=='input_pengajar'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_pengajar/$nama_file";
  $pass=md5($_POST[password]);
  $cek_nip = mysql_query("SELECT * FROM pengajar WHERE nip='$_POST[nip]'");
  $ketemu=mysql_num_rows($cek_nip);
  if (empty($ketemu)){
        if (!empty($lokasi_file)){
            if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=admin&act=tambahpengajar')</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                $tipe_file != "image/jpg"
                ){
                echo "<script>window.alert('Tipe File tidak di ijinkan.');
                window.location=(href='../../media_admin.php?module=admin&act=tambahpengajar')</script>";
                }else{
                UploadImage($nama_file);
                $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];
                mysql_query("INSERT INTO pengajar(nip,
                                 nama_lengkap,
                                 username_login,
                                 password_login,
                                 alamat,
                                 tempat_lahir,
                                 tgl_lahir,
                                 jenis_kelamin,
                                 agama,
                                 no_telp,
                                 email,
                                 website,
                                 foto,
                                 jabatan,
                                 blokir,
                                 id_session)
	                       VALUES('$_POST[nip]',
                                '$_POST[nama_lengkap]',
                                '$_POST[username]',
                                '$pass',
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$tgl_lahir',
                                '$_POST[jk]',
                                '$_POST[agama]',
                                '$_POST[no_telp]',
                                '$_POST[email]',
                                '$_POST[website]',
                                '$nama_file',
                                '$_POST[jabatan]',
                                '$_POST[blokir]',
                                '$_POST[nip]')");
                    }
             }
        }
        else {
        $pass=md5($_POST[password]);
        $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];
        mysql_query("INSERT INTO pengajar(nip,
                                 nama_lengkap,
                                 username_login,
                                 password_login,
                                 alamat,
                                 tempat_lahir,
                                 tgl_lahir,
                                 jenis_kelamin,
                                 agama,
                                 no_telp,
                                 email,
                                 website,
                                 jabatan,
                                 blokir,
                                 id_session)
	                       VALUES('$_POST[nip]',
                                '$_POST[nama_lengkap]',
                                '$_POST[username]',
                                '$pass',
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$tgl_lahir',
                                '$_POST[jk]',
                                '$_POST[agama]',
                                '$_POST[no_telp]',
                                '$_POST[email]',
                                '$_POST[website]',
                                '$_POST[jabatan]',
                                '$_POST[blokir]',
                                '$_POST[nip]')");
        }
        header('location:../../media_admin.php?module='.$module);
  }else{
      echo "<script>window.alert('Nip sudah digunakan.');
                window.location=(href='../../media_admin.php?module=admin&act=tambahpengajar')</script>";
  }
  
}
//upadate pengajar
elseif ($module=='admin' AND $act=='update_pengajar'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_pengajar/$nama_file";
  $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];
  $cek_nip = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
  $ketemu=mysql_fetch_array($cek_nip);
  if($_POST['nip']==$ketemu['nip']){
  //apabila foto tidak diubah dan password tidak di ubah
  if (empty($lokasi_file) AND empty($_POST[password])){
      mysql_query("UPDATE pengajar SET
                                  nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
  }
  //apabila foto diubah dan password tidak diubah
  elseif(!empty($lokasi_file) AND empty($_POST[password])){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=admin&act=pengajar')</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                    $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=admin&act=pengajar')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);
                UploadImage($nama_file);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
  }
  //apabila foto tidak diubah dan password diubah
  elseif(empty($lokasi_file) AND !empty($_POST[password])){
      $pass=md5($_POST[password]);
      mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
  }else{
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=admin&act=pengajar)</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=admin&act=pengajar')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);
                UploadImage($nama_file);
                $pass=md5($_POST[password]);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    $pass=md5($_POST[password]);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
  }
    header('location:../../media_admin.php?module=admin&act=pengajar');
  }
  elseif($_POST['nip']!= $ketemu['nip']){
      $cek_nip = mysql_query("SELECT * FROM pengajar WHERE nip = '$_POST[nip]'");
      $c = mysql_num_rows($cek_nip);
      //apabila nip tersedia
      if(empty($c)){
          //apabila foto tidak diubah dan password tidak di ubah
        if (empty($lokasi_file) AND empty($_POST[password])){
        mysql_query("UPDATE pengajar SET
                                  nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
        }
        //apabila foto diubah dan password tidak diubah
        elseif(!empty($lokasi_file) AND empty($_POST[password])){
             if (file_exists($direktori_file)){
                    echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
                    window.location=(href='../../media_admin.php?module=admin&act=pengajar')</script>";
             }else{
                if($tipe_file != "image/jpeg" AND
                    $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=admin&act=pengajar')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);

                UploadImage($nama_file);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
        }
        //apabila foto tidak diubah dan password diubah
        elseif(empty($lokasi_file) AND !empty($_POST[password])){
            $pass=md5($_POST[password]);
            mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
       }else{
        if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=admin&act=pengajar)</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=admin&act=pengajar')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);
                UploadImage($nama_file);
                $pass=md5($_POST[password]);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    $pass=md5($_POST[password]);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]',
                                  blokir         = '$_POST[blokir]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
        }
        header('location:../../media_admin.php?module=admin&act=pengajar');
      }
      else{
        echo "<script>window.alert('Nip sudah pernah digunakan.');
        window.location=(href='../../media_admin.php?module=admin')</script>";
      }
  }
}

// Update admin
elseif ($module=='admin' AND $act=='update_admin'){
  if (empty($_POST[password])) {
    mysql_query("UPDATE admin SET username       = '$_POST[username]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  alamat         = '$_POST[alamat]',
                                  email          = '$_POST[email]',
                                  no_telp        = '$_POST[no_telp]',
                                  blokir         = '$_POST[blokir]'                  
                           WHERE  id_session     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE admin SET username        = '$_POST[username]',
                                  password        = '$pass',
                                  nama_lengkap    = '$_POST[nama_lengkap]',
                                  alamat          = '$_POST[alamat]',
                                  email           = '$_POST[email]',
                                  no_telp         = '$_POST[no_telp]',
                                  blokir          = '$_POST[blokir]'
                           WHERE id_session      = '$_POST[id]'");
  }
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='admin' AND $act=='update_pengajar2'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_pengajar/$nama_file";
  $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];

  $cek_nip = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
  $ketemu=mysql_fetch_array($cek_nip);

  if($_POST['nip']==$ketemu['nip']){

  //apabila foto tidak diubah dan password tidak di ubah
  if (empty($lokasi_file) AND empty($_POST[password])){
      mysql_query("UPDATE pengajar SET
                                  nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
  }
  //apabila foto diubah dan password tidak diubah
  elseif(!empty($lokasi_file) AND empty($_POST[password])){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=home')</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                    $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=home')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);

                UploadImage($nama_file);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
  }
  //apabila foto tidak diubah dan password diubah
  elseif(empty($lokasi_file) AND !empty($_POST[password])){
      $pass=md5($_POST[password]);
      mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
  }else{
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=home)</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=home')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);
                UploadImage($nama_file);
                $pass=md5($_POST[password]);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    $pass=md5($_POST[password]);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
  }
    header('location:../../media_admin.php?module=home');
  }
  elseif($_POST['nip']!= $ketemu['nip']){
      $cek_nip2 = mysql_query("SELECT * FROM pengajar WHERE nip = '$_POST[nip]'");
      $c = mysql_num_rows($cek_nip2);
      //apabila nip tersedia
      if(empty($c)){
          //apabila foto tidak diubah dan password tidak di ubah
        if (empty($lokasi_file) AND empty($_POST[password])){
        mysql_query("UPDATE pengajar SET
                                  nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
        header('location:../../media_admin.php?module=home');
        }
        //apabila foto diubah dan password tidak diubah
        elseif(!empty($lokasi_file) AND empty($_POST[password])){
             if (file_exists($direktori_file)){
                    echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
                    window.location=(href='../../media_admin.php?module=home')</script>";
             }else{
                if($tipe_file != "image/jpeg" AND
                    $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=home')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);

                UploadImage($nama_file);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
        }
        //apabila foto tidak diubah dan password diubah
        elseif(empty($lokasi_file) AND !empty($_POST[password])){
            $pass=md5($_POST[password]);
            mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
       }else{
        if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=home)</script>";
            }else{
                if($tipe_file != "image/jpeg" AND
                $tipe_file != "image/jpg"
                ){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=home')</script>";
                }else{
                $cek = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_POST[id]'");
                $r = mysql_fetch_array($cek);
                if(!empty($r[foto])){
                $img = "../../../foto_pengajar/$r[foto]";
                unlink($img);
                $img2 = "../../../foto_pengajar/medium_$r[foto]";
                unlink($img2);
                $img3 = "../../../foto_pengajar/small_$r[foto]";
                unlink($img3);
                UploadImage($nama_file);
                $pass=md5($_POST[password]);
                mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }else{
                    UploadImage($nama_file);
                    $pass=md5($_POST[password]);
                    mysql_query("UPDATE pengajar SET nip  = '$_POST[nip]',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  username_login = '$_POST[username]',
                                  password_login = '$pass',
                                  alamat         = '$_POST[alamat]',
                                  tempat_lahir   = '$_POST[tempat_lahir]',
                                  tgl_lahir      = '$tgl_lahir',
                                  jenis_kelamin  = '$_POST[jk]',
                                  agama          = '$_POST[agama]',
                                  no_telp        = '$_POST[no_telp]',
                                  email          = '$_POST[email]',
                                  website        = '$_POST[website]',
                                  foto           = '$nama_file',
                                  jabatan        = '$_POST[jabatan]'
                           WHERE  id_pengajar     = '$_POST[id]'");
                }
                }
            }
        }
        header('location:../../media_admin.php?module=home');
      }
      else{
        echo "<script>window.alert('Nip sudah pernah digunakan.');
        window.location=(href='../../media_admin.php?module=home')</script>";
      }
  }
}
}
?>
