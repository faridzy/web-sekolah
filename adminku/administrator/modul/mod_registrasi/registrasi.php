<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_registrasi/aksi_registrasi.php";
switch($_GET[act]){
// Tampil Mata Pelajaran
  default:
    if ($_SESSION[leveluser]=='admin'){
         echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> ";
          echo "<table class='table table-bordered table-striped table-condensed cf'>
          <thead>
          
          <tr><th>No</th><th>Nis</th><th>Nama</th><th>Kelas</th><th>Nama Ayah</th><th>Aksi</th></tr></thead>";

          $registrasi = mysql_query("SELECT * FROM registrasi_siswa ORDER BY id_registrasi");
          $no=1;
          while ($r=mysql_fetch_array($registrasi)){
              echo "<tr><td>$no.</td>
                        <td>$r[nis]</td>
                        <td>$r[nama_lengkap]</td>
                        ";
                        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'");
                        $k=mysql_fetch_array($kelas);
                        echo "<td>$k[nama]</td>
                        <td>$r[nama_ayah]</td>
                        <td><a href=javascript:confirmdelete('$aksi?module=registrasi&act=hapus&id=$r[id_registrasi]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a> |
                        <a href=?module=registrasi&act=detail&id=$r[id_registrasi] class='btn btn-info'>Detail</a></td></tr>";
          }
          echo "</table></div></div></div>";
    }
    break;

    case "detail":
        if ($_SESSION[leveluser]=='admin'){
            $registrasi = mysql_query("SELECT * FROM registrasi_siswa WHERE id_registrasi = '$_GET[id]'");
            $r=mysql_fetch_array($registrasi);
            $tgl_lahir = tgl_indo($r[tgl_lahir]);
            echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> ";
            echo"<table class='table table-bordered table-responsive'>
                 <tr><td><b>Nis</b></td><td>$r[nis]</td><tr>
                 <tr><td><b>Nama Lengkap</b></td><td>$r[nama_lengkap]</td><tr>
                 <tr><td><b>Kelas</b></td>";
                    $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'");
                    $k=mysql_fetch_array($kelas);
                 echo "<td>$k[nama]</td></tr>
                 <tr><td><b>Alamat</b></td><td>$r[alamat]</td><tr>
                 <tr><td><b>Tempat Lahir</b></td><td>$r[tempat_lahir]</td><tr>
                 <tr><td><b>Tanggal Lahir</b></td><td>$tgl_lahir</td><tr>
                 <tr><td><b>Jenis Kelamin</b></td>";
                    if ($r[jenis_kelamin]=='L'){
                        echo "<td>Laki - Laki</td></tr>";
                    }else{
                        echo "<td>Perempuan</td></tr>";
                    }
                 echo "<tr><td><b>Agama</b></td><td>$r[agama]</td><tr>
                 <tr><td><b>Nama Ayah</b></td><td>$r[nama_ayah]</td><tr>
                 <tr><td><b>Nama Ibu</b></td><td>$r[nama_ibu]</td><tr>
                 <tr><td><b>Tahun Masuk</b></td><td>$r[th_masuk]</td><tr>
                 <tr><td><b>Email</b></td><td>$r[email]</td><tr>
                 <tr><td><b>Aksi</b></td><td><input type=button class='btn btn-success' value='Terima' onclick=\"window.location.href='$aksi?module=registrasi&act=terima&id=$r[id_registrasi]';\">
                                         <input type=button class='btn btn-primary' value='Kembali' onclick=\"window.location.href='?module=registrasi';\"></td><tr>
                 </table></div></div></div>";
        }

}
}
?>
