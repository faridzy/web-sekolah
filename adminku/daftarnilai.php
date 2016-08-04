<?php
include "configurasi/koneksi.php";
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>
 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_SESSION[idsiswa]'");
        $data_siswa = mysql_fetch_array($siswa);
        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_kelas = '$data_siswa[id_kelas]'");
        $cek_mapel = mysql_num_rows($mapel);
        if (!empty($cek_mapel)){
            echo"
            <section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Lihat Nilai
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>    
          <div class='panel-body'>
            <table class='table table-bordered table-striped table-condensed cf'> 
            <thead><tr><th>No</th><th>Mata Pelajaran</th><th>Aksi</th></tr></thead>";
            $no=1;
            while ($t=mysql_fetch_array($mapel)){
                echo "<tr><td>$no</td>
                        <td>$t[nama]</td>";

                        echo"<td><input type=button class='btn btn-info' value='Lihat Nilai'
                       onclick=\"window.location.href='?module=quiz&act=daftarnilai&id=$t[id_matapelajaran]&id_kelas=$data_siswa[id_kelas]';\"></td></tr>";
            $no++;
            }
            echo"</table></div></section>";
        }else{
            echo "<script>window.alert('Belum ada mata pelajaran di kelas anda.');
                    window.location=(href='media.php?module=home')</script>";
        }
    
}
?>
