<?php
session_start();
include "configurasi/koneksi.php";
function timer(){
	$time=2000;
	$_SESSION[timeout]=time()+$time;
}
function cek_login(){
	$timeout=$_SESSION[timeout];
	if(time()<$timeout){
		timer();
		return true;
	}else{
                mysql_query("UPDATE online SET online='T' WHERE id_siswa = '$_SESSION[idsiswa]'");
		unset($_SESSION[timeout]);
		return false;
	}
}
?>
