<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showpel()
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
   echo "if (document.form_materi.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM mata_pelajaran WHERE id_kelas = '$idkelas' AND id_pengajar = '0'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran').innerHTML = \"<select name='".id_matapelajaran."' class='form-control'>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_matapelajaran']."'>".$data2['nama']."</option>";
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

$aksi="modul/mod_matapelajaran/aksi_matapelajaran.php";
switch($_GET[act]){
// Tampil Mata Pelajaran
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_pelajaran = mysql_query("SELECT * FROM mata_pelajaran ORDER BY id_kelas");
      echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit'>
                        Tambah Mapel
                    </button>";
          echo "<br><br><table id='example1' class='table table-bordered table-striped'>
          <thead>
          
          <tr><th>No</th><th>Id Mapel</th><th>Nama</th><th>Kelas</th><th>Pengajar</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pelajaran)){
       echo "<tr><td>$no</td>
             <td>$r[id_matapelajaran]</td>
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek = mysql_num_rows($kelas);
             if(!empty($cek)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-success'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar' class='btn btn-info'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' class='btn btn-info btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></td></tr>";
      $no++;
    }
    echo "</table></div></div></div>
    <div class='modal fade' id='modalEdit'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <h4 class='modal-title'>Tambah Mata Pelajaran</h4>
                  </div>
                  <div class='modal-body'>
                    <!-- Start form -->
                   <form class='form-horizontal' role='for' style='width:80%'' method='post' action='$aksi?module=matapelajaran&act=input_matapelajaran'>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>ID Mata Pelajaran</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <input type=text name='id_matapelajaran' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=10>
                        </div>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Nama </label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <input type=text name='nama'class='form-control' id='field-1' required='required' placeholder='Placeholder' size=30>                         
                        </div>
                        </div>
                      </div>
                       <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Kelas</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>
                           <select name='id_kelas' class='form-control'>
                                                  <option value=0 selected>--pilih--</option>";
                                                  $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama");
                                                  while($r=mysql_fetch_array($tampil)){
                                                  echo "<option value=$r[id_kelas]>$r[nama]</option>";
                                                  }echo "</select>
                        </div>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Pengajar</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <select name='id_pengajar' class='form-control'>
                                                  <option value=0 selected>--pilih--</option>";
                                                  $tampil_pengajar=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                                  while($p=mysql_fetch_array($tampil_pengajar)){
                                                  echo "<option value=$p[id_pengajar]>$p[nama_lengkap]</option>";
                                                  }echo "</select>
                         
                        </div>
                        </div>
                      </div>
                     
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Deskripsi</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
        <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

<textarea name='deskripsi'  class='form-control' required='required' placeholder='Placeholder' ></textarea>        
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
     //mata pelajaran

  $tampil_pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_pengajar = '$_SESSION[idpengajar]'");
  $cek_mapel = mysql_num_rows($tampil_pelajaran);
  if (!empty($cek_mapel)){
    echo" <section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Mata Pelajaran yang Anda Ajar
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
    echo "<br><br>
    <table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Nama</th><th>Kelas</th><th>Pengajar</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pelajaran)){
       echo "<tr><td>$no</td>             
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek = mysql_num_rows($kelas);
             if(!empty($cek)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-success' >$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar' class='btn btn-info'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' class='btn btn-danger btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a>";
      $no++;
    }
    echo "</table></div></section>";
        }else{
            echo "<script>window.alert('Tidak ada mata pelajaran yang anda ampu, Kembali ke home untuk menambah mata pelajaran yang diampu');
            window.location=(href='?module=home')</script>";
        }
    }
    elseif ($_SESSION[leveluser]=='siswa'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = $_SESSION[idsiswa]");
        $data_siswa = mysql_fetch_array($siswa);
        $tampil_pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_kelas = '$data_siswa[id_kelas]'");
        echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Mata Pelajaran Di Kelas Anda
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

       ";
        echo "<table class='table table-bordered table-striped table-condensed cf'>
          <thead><tr><th>No</th><th>Nama</th><th>Pengajar</th><th>Deskripsi</th></tr></thead>";
        $no=1;
        while ($r=mysql_fetch_array($tampil_pelajaran)){
        echo "<tr><td>$no</td>
             <td>$r[nama]</td>";             
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar' class='btn btn-info'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>";
        $no++;
        }
        echo "</table>

        </div>

          
      
      
      </section>";
    }
    break;


case "editmatapelajaran":
    if ($_SESSION[leveluser]=='admin'){
        $mapel=mysql_query("SELECT * FROM mata_pelajaran WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($mapel);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
        $k = mysql_fetch_array($kelas);
        $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$m[id_pengajar]'");
        $d = mysql_fetch_array($pengajar);
        
        echo "
       <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <form method=POST action='$aksi?module=matapelajaran&act=update_matapelajaran' class='form-horizontal form-groups-bordered'>
          <input type=hidden name=id value='$m[id]'>
         
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Id Matapelajaran</label></div>     <div class='col-sm-1'><input type=text name='id_matapelajaran' size=10 value='$m[id_matapelajaran]' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'><label>Nama</label></div>   <div class='col-sm-5'> <input type=text name='nama' size=30 value='$m[nama]' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>   <div class='col-sm-2'>
          <select name='id_kelas' class='form-control'>
                                                  <option value='$k[id_kelas]' selected>$k[nama]</option>";
                                                  $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama");
                                                  while($r=mysql_fetch_array($tampil)){
                                                  echo "<option value=$r[id_kelas]>$r[nama]</option>";
                                                  }echo "</select></div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Pengajar</label></div>              <div class='col-sm-2'>
          <select name='id_pengajar' class='form-control'>
                                                  <option value='$d[id_pengajar]' selected>$d[nama_lengkap]</option>";
                                                  $tampil_pengajar=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                                  while($p=mysql_fetch_array($tampil_pengajar)){
                                                  echo "<option value=$p[id_pengajar]>$p[nama_lengkap]</option>";
                                                  }echo "</select></div></div>
         <div class='form-group'>
          <div class='col-sm-2'><label>Deskripsi</label></div>            <div class='col-sm-7'> <textarea name='deskripsi'   class='form-control' id='field-1' required='required' placeholder='Placeholder' rows='6'>$m[deskripsi]</textarea></div></div>
       
          <div class='form-group'>
          <div class='col-sm-2'></div> <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></div></div>";
    }else{
        $mapel=mysql_query("SELECT * FROM mata_pelajaran WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($mapel);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
        $k = mysql_fetch_array($kelas);
        $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$m[id_pengajar]'");
        $d = mysql_fetch_array($pengajar);

        echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Edit Mata Pelajaran yang Anda Ampu
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
         
        <form method=POST name='form_materi' action='$aksi?module=matapelajaran&act=update_matapelajaran_pengajar' class='form-horizontal form-groups-bordered'>
          <input type=hidden name=id value='$m[id]'>
          <div class='form-group'>
          <div class='col-sm-2'><label>Kelas </label></div> <div class='col-sm-2'><select name='id_kelas' onChange='showpel()' class='form-control'>
                                          <option value='$k[id_kelas]' selected>$k[nama]</option>";
                                          $pilih="SELECT * FROM kelas ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></div></div>
           <div class='form-group'>
          <div class='col-sm-2'><label>Pelajaran </label></div>         <div class='col-sm-2'><select id='pelajaran' name='id_matapelajaran' class='form-control'>
                                          <option value='".$m[id_matapelajaran]."' selected>".$m[nama]."</option>
                                          </select></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Deskripsi </label></div>         <div class='col-sm-7'>
          <textarea name='deskripsi' class='form-control' id='field-1' required='required' placeholder='Placeholder'>$m[deskripsi]</textarea></div></div>
          <p>
          <br/> <div class='col-sm-2'></div><input class='btn btn-success' type=submit value=Simpan>
                      <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p>
          </form></div></section>";
    }
    break;
case "detailpelajaran":
    if ($_SESSION[leveluser]=='admin'){
        $detail =mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        echo "
<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
       
          <br><table  class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Id Mapel</th><th>Nama</th><th>Kelas</th><th>Pengajar</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
        $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr><td>$no</td>
             <td>$r[id_matapelajaran]</td>
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]')   
             class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></td></tr>";
      $no++;
    }
    echo "</table>
   
    <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
    </div></div></div>";
    }else{
      $detail =mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Detail Mata Pelajaran 
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          <table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>no</th><th>nama</th><th>kelas</th><th>pengajar</th><th>deskripsi</th></tr></thead>";
                    $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr><td>$no</td>             
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-success'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar' class='btn btn-warning'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td></tr>";
             
      $no++;
    }
    echo "</table>
    <input type=button class='btn btn-primary' value=Kembali onclick=self.history.back()></div></section>";
    }
    break;
}
}
?>
