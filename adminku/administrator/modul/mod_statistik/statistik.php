
<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_statistik/aksi_statistik.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'>
         
                
          <br><table id='example1' class='table table-bordered table-striped'><thead>
          <tr><th>No</th><th>IP Address</th><th>OS</th><th>Browser</th><th>Waktu</th><th>Aksi</th></tr></thead>";
    $tampil=mysql_query("SELECT * FROM statistik");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
            <td>$r[ip]</td>
            <td>$r[os]</td>
            <td>$r[browser]</td>
            <td>$r[date_create]</td>";
            echo"<td>
                <a href=javascript:confirmdelete('$aksi?module=statistik&act=hapus&id=$r[id_statistik]')><i style='cursor:pointer;color:red' class='fa fa-times-circle'></i>
</a>
            </td></tr>";
             $no++;
    }
    echo "</table></div></div></div>
    ";
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
        echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;
}
}
?>
