<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "
 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
include "configurasi/koneksi.php";
$soal = mysql_query("SELECT * FROM quiz_pilganda where id_tq='$_POST[id_topik]'");
$pilganda = mysql_num_rows($soal);
$soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_POST[id_topik]'");
$esay = mysql_num_rows($soal_esay);
//jika ada pilihan ganda dan ada esay
if (!empty($pilganda) AND !empty($esay)){
//jika ada inputan soal pilganda
if(!empty($_POST['soal_pilganda'])){
    $benar = 0;
    $salah = 0;
    foreach($_POST['soal_pilganda'] as $key => $value){
    $cek = mysql_query("SELECT * FROM quiz_pilganda WHERE id_quiz=$key");
    while($c = mysql_fetch_array($cek)){
        $jawaban = $c['kunci'];
    }
    if($value==$jawaban){
        $benar++;
    }else{
        $salah++;
    }
}
$jumlah = $_POST['jumlahsoalpilganda'];
$tidakjawab = $jumlah - $benar - $salah;
$persen = $benar / $jumlah;
$hasil = $persen * 100;
mysql_query("INSERT INTO nilai (id_tq, id_siswa, benar, salah, tidak_dikerjakan,persentase)
                           VALUES ('$_POST[id_topik]','$_SESSION[idsiswa]','$benar','$salah','$tidakjawab','$hasil')");

}
elseif (empty($_POST['soal_pilganda'])){
    $jumlah = $_POST['jumlahsoalpilganda'];
    mysql_query("INSERT INTO nilai (id_tq, id_siswa, benar, salah, tidak_dikerjakan,persentase)
                           VALUES ('$_POST[id_topik]','$_SESSION[idsiswa]','0','0','$jumlah','0')");
}
//jika ada inputan soal esay
if(!empty($_POST['soal_esay'])){
    foreach($_POST['soal_esay'] as $key2 => $value){
    $jawaban = $value;
    $cek = mysql_query("SELECT * FROM quiz_esay WHERE id_quiz=$key2");
    while($data = mysql_fetch_array($cek)){
        mysql_query("INSERT INTO jawaban(id_tq,id_quiz,id_siswa,jawaban)
                                 VALUES('$_POST[id_topik]','$data[id_quiz]','$_SESSION[idsiswa]','$jawaban')");
    }   
    }

}
elseif (empty($_POST['soal_esay'])){
    mysql_query("INSERT INTO jawaban(id_tq,id_quiz,id_siswa,jawaban)
                                 VALUES('$_POST[id_topik]','$data[id_quiz]','$_SESSION[idsiswa]','')");
}
header ('location:home');
}
//jika soal hanya esay
if (empty($pilganda) AND !empty($esay)){
    //jika ada inputan soal esay
if(!empty($_POST['soal_esay'])){
    foreach($_POST['soal_esay'] as $key2 => $value){
    $jawaban = $value;
    $cek = mysql_query("SELECT * FROM quiz_esay WHERE id_quiz=$key2");
    while($data = mysql_fetch_array($cek)){
        mysql_query("INSERT INTO jawaban(id_tq,id_quiz,id_siswa,jawaban)
                                 VALUES('$_POST[id_topik]','$data[id_quiz]','$_SESSION[idsiswa]','$jawaban')");
    }
    }
}
elseif (empty($_POST['soal_esay'])){
    mysql_query("INSERT INTO jawaban(id_tq,id_quiz,id_siswa,jawaban)
                                 VALUES('$_POST[id_topik]','$data[id_quiz]','$_SESSION[idsiswa]','')");
}
header ('location:home');
}
//jika soal hanya pilihan ganda
if (!empty($pilganda) AND empty($esay)){
    //jika ada inputan soal pilganda
if(!empty($_POST['soal_pilganda'])){
    $benar = 0;
    $salah = 0;
    foreach($_POST['soal_pilganda'] as $key => $value){
    $cek = mysql_query("SELECT * FROM quiz_pilganda WHERE id_quiz=$key");
    while($c = mysql_fetch_array($cek)){
        $jawaban = $c['kunci'];
    }
    if($value==$jawaban){
        $benar++;
    }else{
        $salah++;
    }
}
$jumlah = $_POST['jumlahsoalpilganda'];
$tidakjawab = $jumlah - $benar - $salah;
$persen = $benar / $jumlah;
$hasil = $persen * 100;

mysql_query("INSERT INTO nilai (id_tq, id_siswa, benar, salah, tidak_dikerjakan,persentase)
                           VALUES ('$_POST[id_topik]','$_SESSION[idsiswa]','$benar','$salah','$tidakjawab','$hasil')");
}
elseif (empty($_POST['soal_pilganda'])){
    $jumlah = $_POST['jumlahsoalpilganda'];
    mysql_query("INSERT INTO nilai (id_tq, id_siswa, benar, salah, tidak_dikerjakan,persentase)
                           VALUES ('$_POST[id_topik]','$_SESSION[idsiswa]','0','0','$jumlah','0')");
}
header ('location:home');
}
}
?>
