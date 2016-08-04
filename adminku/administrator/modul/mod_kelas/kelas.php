<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showsiswa()
 {
 <?php

 // membaca semua kelas
 $query = "SELECT * FROM kelas";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkelas = $data['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_kelas.kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM siswa WHERE id_kelas = '$idkelas'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('siswa').innerHTML = \"<select name='ketua' class='form-control'><option value='0' selected>--Pilih--</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_siswa']."'>".$data2['nama_lengkap']."</option>";
   }
   $content .= "</select>\";";
   echo $content;
   echo "}\n";
 }

 ?>
 }
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_kelas/aksi_kelas.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil kelas
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");

      echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 


<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit'>
                        Tambah Kelas
                    </button>";
      echo "<br><br><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Id kelas</th><th>Kelas</th><th>Wali Kelas</th><th>Ketua Kelas</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr><td>$no</td>
             <td>$r[id_kelas]</td>
             <td>$r[nama]</td>";
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas' class='btn btn-info'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]]'");
                    $ada_siswa = mysql_num_rows($siswa);
                    if(!empty($ada_siswa)){
                    while ($s=mysql_fetch_array($siswa)){
                            echo"<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'  class='btn btn-warning'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
             echo "<td><a href='?module=kelas&act=editkelas&id=$r[id]' class='btn btn-default btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit

              </a> |
                 <a href=javascript:confirmdelete('$aksi?module=kelas&act=hapuskelas&id=$r[id]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a> |
                 <a href=?module=daftarsiswa&act=lihatmurid&id=$r[id_kelas]  class='btn btn-info btn-sm btn-icon icon-left'>
              <i class='entypo-info'></i>
              Profile</a></td></tr>";
      $no++;
      
    }
    echo "</table></div></div></div>
    <div class='modal fade' id='modalEdit'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <h4 class='modal-title'>Tambah Kelas</h4>
                  </div>
                  <div class='modal-body'>
                    <!-- Start form -->
                   <form class='form-horizontal' role='for' style='width:80%'' method='post' action='$aksi?module=kelas&act=input_kelas'>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>ID Kelas</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>


                          <input type=text name='id_kelas' class='form-control' id='field-1' required='required' placeholder='Placeholder'>
                        </div>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Nama Kelas</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <input type=text name='nama' class='form-control' id='field-1' required='required' placeholder='Placeholder'>
                         
                        </div>
                        </div>
                      </div>
                       <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Wali Kelas</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <select name='id_pengajar' class='form-control'>
                                      <option value=0 selected>-- Pilih Pengajar --</option>";
                                      $tampil=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                      while($r=mysql_fetch_array($tampil)){
                                      echo "<option value=$r[id_pengajar]>$r[nama_lengkap]</option>";
                                      }echo "</select>
                         
                        </div>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Ketua Kelas</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <select name='id_siswa' class='form-control'>
                                      <option value=0 selected>-- Pilih Siswa --</option>";
                                      $tampil_siswa=mysql_query("SELECT * FROM siswa,kelas WHERE siswa.id_siswa=kelas.id_siswa  ORDER BY nama_lengkap");
                                      while($s=mysql_fetch_array($tampil_siswa)){
                                      echo "<option value=$s[id_siswa]>$s[nama_lengkap]</option>";
                                      }echo "</select>
                         
                        </div>
                        </div>
                      </div>
                     
                     
                      
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-danger pull-left' data-dismiss='modal'>Close</button>
                    <button type='submit' class='btn btn-primary'>Save changes</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>


                   

                   ";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
         echo"
        <section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Kelas Yang Anda Ampu
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";

         $tampil_kelas = mysql_query("SELECT * FROM kelas WHERE id_pengajar = '$_SESSION[idpengajar]'");
         $ketemu=mysql_num_rows($tampil_kelas);
         if (!empty($ketemu)){
                echo "<br/>
                <br/><table class='table table-bordered table-striped table-condensed cf'><thead>
                <tr><th>No</th><th>Kelas</th><th>Wali Kelas</th><th>Ketua Kelas</th><th>Aksi</th></tr></thead>";

                $no=1;
                while ($r=mysql_fetch_array($tampil_kelas)){
                    echo "<tr>
                    <td>$no</td>
                    <td>$r[nama]</td>";

                    $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_SESSION[idpengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas' class='btn btn-success'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
                    $ada_siswa = mysql_num_rows($siswa);
                    if(!empty($ada_siswa)){
                    while ($s=mysql_fetch_array($siswa)){
                            echo"<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa' class='btn btn-info'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
                    echo "<td><a href='?module=kelas&act=editkelas&id=$r[id]'class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a>|
                        <a href=javascript:confirmdelete('$aksi_kelas?module=kelas&act=hapuswalikelas&id=$r[id]') class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a> |
             
                       <input class='btn btn-info btn-sm btn-icon icon-left' type=button value='Lihat Siswa' onclick=\"window.location.href='?module=daftarsiswa&act=lihatmurid&id=$r[id_kelas]';\">
          </td></tr>";
                $no++;
                }
                echo "</table><br/></div></section>";
                }else{
                    echo "<script>window.alert('Tidak ada kelas yang anda ampu,kembali ke home untuk menambah');
                    window.location=(href='?module=home')</script>";
                }
    }
    elseif ($_SESSION[leveluser]=='siswa'){
        echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Kelas Kamu
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

          
      ";
        $ambil_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_SESSION[idsiswa]'");
        $data_siswa = mysql_fetch_array($ambil_siswa);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$data_siswa[id_kelas]'");

        echo "<table class='table table-bordered table-striped table-condensed cf'>
          <thead class='cf'><tr><th>No</th><th>Kelas</th><th>Wali Kelas</th><th>Ketua Kelas</th><th>Aksi</th></tr></thead><tbody>";
        $no=1;
        while ($r=mysql_fetch_array($kelas)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama]</td>";
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas' class='btn btn-danger'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]]'");
                    $ada_siswa = mysql_num_rows($siswa);
                    if(!empty($ada_siswa)){
                    while ($s=mysql_fetch_array($siswa)){
                            echo"<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa' class='btn btn-info'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
             echo "<td>
              <a href='?module=siswa&act=lihatmurid&id=$r[id_kelas]' class='btn btn-primary'>Lihat Teman</a>

            
          </td></tr>";
      $no++;
    }
    echo "</tbody></table>
    </div>
     </section>";
    }
    break;
    
    
    case "editkelas":
    if ($_SESSION[leveluser]=='admin'){
    $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
    $getnip = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
    $nipp = mysql_fetch_array($getnip);
    $getnis = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
    $niss = mysql_fetch_array($getnis);
    
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> <form method=POST action='$aksi?module=kelas&act=update_kelas' class='form-horizontal form-groups-bordered'>
          <input type=hidden name=id value='$r[id]'>
         
          <div class ='form-group'>
         <div class='col-sm-2'>
         <label>Id Kelas</label></div>       <div class='col-sm-5'><input type=text name='id_kelas' value='$r[id_kelas]' class='form-control' id='field-1' required='required' placeholder='Placeholder'> </div></div>
        <div class ='form-group'>
         <div class='col-sm-2'><label>Nama Kelas</label></div> <div class='col-sm-5'> <input type=text name='nama' value='$r[nama]' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
            <div class ='form-group'>
         <div class='col-sm-2'><label>Wali Kelas</label></div>     <div class='col-sm-2'>
          <select name='id_pengajar' class='form-control'>";
                                 
                                      echo "<option value='$nipp[id_pengajar]' selected>$nipp[nama_lengkap]</option>";
                                      $tampil=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                      while($p=mysql_fetch_array($tampil)){
                                      echo "<option value=$p[id_pengajar]>$p[nama_lengkap]</option>";
                                      }echo "</select></div></div>
            <div class ='form-group'>
         <div class='col-sm-2'>
         <label>Ketua Kelas</label></div>    <div class='col-sm-2'><select name='id_siswa' class='form-control'>
                                      <option value='$niss[id_siswa]' selected>$niss[nama_lengkap]</option>";
                                      $tampil_siswa=mysql_query("SELECT * FROM siswa ORDER BY nama_lengkap");
                                      while($s=mysql_fetch_array($tampil_siswa)){
                                      echo "<option value=$s[id_siswa]>$s[nama_lengkap]</option>";
                                      }echo "</select></div></div>
          
            <div class ='form-group'>
         <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
        </form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
    $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
     echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Edit Kelas
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
      

     <form method=POST action='$aksi?module=kelas&act=update_walikelas' class='form-horizontal form-groups-bordered'>
    <input type=hidden name=id value='$r[id]'>
         <div class ='form-group'>
         <div class='col-sm-3'> <label>Kelas </label> </div>  <div class='col-sm-2'>
         <select name='kelas' class='form-control' onChange='showsiswa()'>
                                      <option value='$r[id_kelas]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM kelas WHERE id_pengajar ='0' ORDER BY id_kelas");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_kelas]>$t[nama]</option>";
                                      }echo"</select></div>
                                      </div>
        <div class ='form-group'> <div class='col-sm-3'> <label>Ketua Kelas </label> </div> 
        <div class='col-sm-2'> 
        <select name='ketua' class='form-control'>";
                                      $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
                                      $ceks=mysql_num_rows($siswa);
                                      if ($ceks != 0){
                                      $data = mysql_fetch_array($siswa);
                                      echo"<option value='$data[id_siswa]' selected>$data[nama_lengkap]</option>";
                                      }else{
                                          echo "<option value='0' selected>--Pilih--</option>";
                                      }
                                      $tampil_siswa = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$r[id_kelas]'");
                                      while($s=mysql_fetch_array($tampil_siswa)){
                                          echo "<option value=$s[id_siswa]>$s[nama_lengkap]</option>";
                                      }echo"</select></div></div>
         <p><input type=submit class='btn btn-success' value=Simpan>
                            <input type=button class='btn btn-primary' value=Batal onclick=self.history.back()></p>
         </form></div></section>";
    }
    /*elseif ($_SESSION[leveluser]=='siswa'){
         echo"<br><b class='judul'>Edit Kelas</b><br><p class='garisbawah'></p>
         <form method=POST action='$aksi_siswa?module=siswa&act=update_kelas_siswa'>";
         $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
         $r = mysql_fetch_array($tampil);
         echo "<table>
          <tr><td>Kelas </td>   <td>: <select name='id_kelas'>
                                      <option value='$r[id_kelas]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_kelas]>$t[nama]</option>";
                                      }echo"</select></td></tr>
        <tr><td colspan=2><input type=submit class='btn btn-success' value='Update'>
                          <input type=button class='btn btn-primary' value='Batal'
                          onclick=self.history.back()></td></tr>
        </form></table></div></section>";
    }*/
    break;


case "detailkelas":
    $detail=mysql_query("SELECT * FROM kelas WHERE id_kelas='$_GET[id]'");
   
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
      ";
    echo "<br><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>Id Kelas</th><th>Kelas</th><th>Wali Kelas</th><th>Ketua Kelas</th><th>Aksi</th></tr></thead>";

    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$r[id_kelas]</td>
             <td>$r[nama]</td>";
             $getpengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek = mysql_num_rows($getpengajar);
             if (!empty($cek)){
             while($p=mysql_fetch_array($getpengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas' class='btn btn-info'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             $getsiswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
             $cek_siswa = mysql_num_rows($getsiswa);
             if (!empty($cek_siswa)){
             while($s=mysql_fetch_array($getsiswa)){
             echo "<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa' class='btn btn-success'>$s[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo"<td><a href='?module=kelas&act=editkelas&id=$r[id]' class='btn btn-warning'>Edit</a> |
                 <a href=javascript:confirmdelete('$aksi?module=kelas&act=hapuskelas&id=$r[id]') class='btn btn-danger'>Hapus</a> |
                 <a href=?module=siswa&act=lihatmurid&id=$r[id_kelas] class='btn btn-info'>Lihat Siswa</a></td></tr>";
      }
    echo "</table>
          <div class='buttons'>
          <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
          </div></div></div>";
    }else{
        echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Detail Kelas
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
    echo "<table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Kelas</th><th>Wali Kelas</th><th>Ketua Kelas</th><th>Aksi</th></tr></thead>";
    $no = 1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama]</td>";
             $getpengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek = mysql_num_rows($getpengajar);
             if (!empty($cek)){
             while($p=mysql_fetch_array($getpengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas' class='btn btn-success'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             $getsiswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
             $cek_siswa = mysql_num_rows($getsiswa);
             if (!empty($cek_siswa)){
             while($s=mysql_fetch_array($getsiswa)){
             echo "<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa' class='btn btn-info'>$s[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo"<td>
                      <input type=button class='btn btn-info' value='Lihat Siswa' onclick=\"window.location.href='?module=siswa&act=lihatmurid&id=$r[id_kelas]';\">";
       $no++;
      }
    echo "</table>
    <br> <input type=button class='btn btn-primary' value=Kembali onclick=self.history.back()></div></section>";
    }

    break;

 
}
}
?>
