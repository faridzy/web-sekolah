<?php
  include "configurasi/koneksi.php";
  session_start();
  mysql_query("UPDATE online SET online='T' WHERE id_siswa = '$_SESSION[idsiswa]'");
  session_destroy();
  header ('location:../index.php');
?>
