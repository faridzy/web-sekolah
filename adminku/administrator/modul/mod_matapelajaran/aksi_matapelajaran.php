<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input mapel
if ($module=='matapelajaran' AND $act=='input_matapelajaran'){
    mysql_query("INSERT INTO mata_pelajaran(id_matapelajaran,
                                 nama,
                                 id_kelas,
                                 id_pengajar,
                                 deskripsi)
	                       VALUES('$_POST[id_matapelajaran]',
                                '$_POST[nama]',
                                '$_POST[id_kelas]',
                                '$_POST[id_pengajar]',
                                '$_POST[deskripsi]')");
  header('location:../../media_admin.php?module='.$module);
}

// Input mapel
elseif ($module=='matapelajaran' AND $act=='input_matapelajaran_pengajar'){
    $cek = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_POST[id_matapelajaran]'");
    $ada = mysql_fetch_array($cek);
    mysql_query("UPDATE mata_pelajaran SET id_pengajar         = '$_SESSION[idpengajar]',
                                         deskripsi         = '$_POST[deskripsi]'
                                         WHERE  id     = '$ada[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='matapelajaran' AND $act=='update_matapelajaran'){
   mysql_query("UPDATE mata_pelajaran SET id_matapelajaran  = '$_POST[id_matapelajaran]',
                                                    nama   = '$_POST[nama]',
                                                  id_kelas = '$_POST[id_kelas]',
                                               id_pengajar         = '$_POST[id_pengajar]',
                                         deskripsi         = '$_POST[deskripsi]'
                                         WHERE  id     = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='matapelajaran' AND $act=='update_matapelajaran_pengajar'){
   $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id = '$_POST[id]'");
   $data = mysql_fetch_array($pelajaran);
   $pelajaran2 = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_POST[id_matapelajaran]'");
   $data2 = mysql_fetch_array($pelajaran2);

   if ($_POST['id_matapelajaran'] == $data['id_matapelajaran']){
        mysql_query("UPDATE mata_pelajaran SET deskripsi  = '$_POST[deskripsi]'
                                         WHERE  id     = '$_POST[id]'");
   }else{
       mysql_query("UPDATE mata_pelajaran SET id_pengajar         = '0',
                                         deskripsi         = ''
                                         WHERE  id     = '$data[id]'");

       mysql_query("UPDATE mata_pelajaran SET id_pengajar         = '$_SESSION[idpengajar]',
                                         deskripsi         = '$_POST[deskripsi]'
                                         WHERE  id     = '$data2[id]'");
   }
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='matapelajaran' AND $act=='hapus'){
  mysql_query("DELETE FROM mata_pelajaran WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='matapelajaran' AND $act=='hapus_mapel_pengajar'){
  mysql_query("UPDATE mata_pelajaran SET id_pengajar   = '0',
                                         deskripsi     = ''
                                         WHERE  id     = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

}
?>
