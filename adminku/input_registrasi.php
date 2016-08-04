<?php
error_reporting(0);
include "configurasi/koneksi.php";
if (!empty($_POST['nis']) AND !empty($_POST['email'])){
	$nis=$_POST['nis'];
	$nama_lengkap=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$tempat=$_POST['tempat_lahir'];
	$email=$_POST['email'];
	$ibu=$_POST['nama_ibu'];
	$ayah=$_POST['nama_ayah'];
    $nis=htmlspecialchars($nis);
    $nama_lengkap=htmlspecialchars($nama_lengkap);
    $alamat=htmlspecialchars($alamat);
    $tempat=htmlspecialchars($tempat);
    $email=htmlspecialchars($email);
    $ibu=htmlspecialchars($ibu);
    $ayah=htmlspecialchars($ayah);
    $tgl_lahir = $_POST[thn_lahir].'-'.$_POST[bln_lahir].'-'.$_POST[tgl_lahir];
    mysql_query("INSERT INTO registrasi_siswa(nis,nama_lengkap,id_kelas,alamat,tempat_lahir,tgl_lahir,jenis_kelamin,agama,nama_ayah,
                                              nama_ibu,th_masuk,email)
                             VALUES ('$nis','$nama_lengkap','$_POST[kelas]','$alamat',
                                     '$tempat','$tgl_lahir','$_POST[jk]','$_POST[agama]','$ayah',
                                     '$ibu','$_POST[thn_masuk]','$ibu')");
    echo "<script>window.alert('Terimakasih telah mendaftarkan diri anda, silahkan tunggu konfirmasi email dari admin.');
            window.location=(href='../registrasi.php')</script>";
}else{
    header('location:../registrasi.php');
}
?>
