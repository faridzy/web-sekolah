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
   $query2 = "SELECT * FROM mata_pelajaran WHERE id_kelas = '$idkelas'";
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

 function showpel_pengajar()
 {
 <?php

 // membaca semua kelas
 $query1 = "SELECT * FROM kelas";
 $hasil1 = mysql_query($query1);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data1 = mysql_fetch_array($hasil1))
 {
   $idkelas = $data1['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_materi_pengajar.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM mata_pelajaran WHERE  id_kelas = '$idkelas' AND id_pengajar ='$_SESSION[idpengajar]' ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran_pengajar').innerHTML = \"<select name='".id_matapelajaran."' class='form-control'>";
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
function fsize($file){
                            $a = array("B", "KB", "MB", "GB", "TB", "PB");
                            $pos = 0;
                            $size = filesize($file);
                            while ($size >= 1024)
                            {
                            $size /= 1024;
                            $pos++;
                            }
                            return round ($size,2)." ".$a[$pos];
                            }
?>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
 
  echo "<div class='alert alert-info'>Untuk mengakses Modul anda harus login.</div>";
}
else{



$aksi="modul/mod_materi/aksi_materi.php";
switch($_GET[act]){
  // Tampil kelas
  default:
    if ($_SESSION[leveluser]=='admin'){
                
        $tampil_materi = mysql_query("SELECT * FROM file_materi ORDER BY id_kelas");
        $cek_materi = mysql_num_rows($tampil_materi);
        if(!empty($cek_materi)){
        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit'>
                        Tambah File Materi
                    </button>

";
        echo "<br><br><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Judul</th><th>Kelas</th><th>Pelajaran</th><th>Nama File</th><th>Tgl Posting</th><th>Pembuat</th><th>Hits</th><th>Aksi</th></tr></thead>";
       $no=1;
    while ($r=mysql_fetch_array($tampil_materi)){
      $tgl_posting   = tgl_indo($r[tgl_posting]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-success'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=matapelajaran&act=detailpelajaran&id=$r[id_matapelajaran] title='Detail pelajaran' class='btn btn-primary'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td>$r[nama_file]</td>
             <td>$tgl_posting</td>";
             $pelajaran2 = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pengajar2 = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$p2[id_pengajar]'");
             $cek_pengajar2 = mysql_num_rows($pengajar2);
             if(!empty($cek_pengajar2)){
                 while ($p3= mysql_fetch_array($pengajar2)){
                 echo "<td><a href=?module=admin&act=detailpengajar&id=$p3[id_pengajar] title='Detail Pengajar' class='btn btn-info'>$p3[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td>$r[pembuat]</td>";
             }
             echo"<td>$r[hits]</td>
             <td><a href='?module=materi&act=editmateri&id=$r[id_file]' class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit
</a> |
                 <a href=javascript:confirmdelete('$aksi?module=materi&act=hapus&id=$r[id_file]') class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete
</a></td></tr>";
      $no++;
    }
    echo "</table></div></div></div>
    <div class='modal fade' id='modalEdit'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <h4 class='modal-title'>Tambah File Materi</h4>
                  </div>
                  <div class='modal-body'>
                    <!-- Start form -->
                   <form class='form-horizontal' name='form_materi' role='for' style='width:80%'' method='post' action='$aksi?module=materi&act=input_materi'>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Judul</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>
                           <input type=text name='judul' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=50>
                        </div>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Kelas </label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

 <select name='id_kelas' class='form-control' onChange='showpel()'>
                                          <option value=''>-pilih-</option>";                                          
                                          $cari_kelas = mysql_query("SELECT * FROM kelas ORDER BY nama");
                                          while ($k=mysql_fetch_array($cari_kelas)){
                                          echo"<option value='".$k[id_kelas]."'>".$k[nama]."</option>";
                                          }                                          
                                          echo"</select>                        
                        </div>
                        </div>
                      </div>
                       <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Pelajaran</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>
                          <div id='pelajaran'></div>
                        </div>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>File</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                         
<span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                         
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
 
    }else{
        echo "<script>window.alert('Tidak ada materi');
            window.location=(href='?module=home')</script>";
    }
    }
   
 elseif ($_SESSION[leveluser]=='pengajar'){        

    $cek_materi = mysql_query("SELECT * FROM file_materi WHERE pembuat = '$_SESSION[idpengajar]'");
    
     echo "
    <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Materi Yang Di Uploud
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalTambah'>
                        Tambah File Materi
                    </button>

         ";
     echo "<br><br/><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Judul</th><th>Kelas</th><th>Pelajaran</th><th>Nama File</th><th>Tgl Upload</th><th>Hits</th><th>Aksi</th></tr></thead>";

    $no=1;
    while ($r=mysql_fetch_array($cek_materi)){
      $tgl_posting   = tgl_indo($r[tgl_posting]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-success'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=matapelajaran&act=detailpelajaran&id=$r[id_matapelajaran] title='Detail pelajaran' class='btn btn-warning'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td>$r[nama_file]</td>
             <td>$tgl_posting</td>             
             <td>$r[hits]</td>
             <td><a href='?module=materi&act=editmateri&id=$r[id_file]' class='btn btn-default btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit
</a>  |
 <a href=javascript:confirmdelete('$aksi?module=materi&act=hapus&id=$r[id_file]') class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></td></tr>";
                 

     $no++;
    }
    echo"</table></div></section>
    <div class='modal fade' id='modalTambah'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <h4 class='modal-title'>Tambah File Materi</h4>
                  </div>
                  <div class='modal-body'>
                    <!-- Start form -->
                   <form name='form_materi_pengajar' method=POST action='$aksi?module=materi&act=input_materi' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
   
    <div class='form-group'>
          <div class='col-sm-2'>
          <label>Judul</label></div><div class='col-sm-5'><input type=text name='judul' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=50></div></div>
    <div class='form-group'>
          <div class='col-sm-2'>
          <label>Kelas</label></div>         
         <div class='col-sm-4'> <select name='id_kelas' onChange='showpel_pengajar()' class='form-control'>
                                          <option value='0' selected>-pilih-</option>";
                                          $pilih= mysql_query("SELECT DISTINCT id_kelas FROM mata_pelajaran WHERE id_pengajar ='$_SESSION[idpengajar]'");
                                          while($row=mysql_fetch_array($pilih)){
                                          $cari_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$row[id_kelas]'");
                                          while ($k=mysql_fetch_array($cari_kelas)){
                                          echo"<option value='".$k[id_kelas]."'>".$k[nama]."</option>";
                                          }
                                          }
                                          echo"</select></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Pelajaran</label></div>          <div class='col-sm-4'> <div id='pelajaran_pengajar'></div></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>File</label></div>       
         <div class='col-sm-7'> <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span></div></div>
    <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-6'><p><input class='btn btn-success' type=submit value=Simpan>
                      <input class='btn btn-primary' type=button value=Batal onclick=\"window.location.href='?module=materi';\"></p></div></div>
    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>




    ";   
    
    }
    
    else{
        echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Daftar Materi
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

        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_kelas = '$data_siswa[id_kelas]'");
       echo "<table class='table table-bordered table-striped table-condensed cf'>
          <thead><tr><th>No</th><th>Mata Pelajaran</th><th>Materi</th></tr></thead>";
        $no=1;
        while ($r=mysql_fetch_array($mapel)){
        echo "<tr><td>$no</td>
             <td>$r[nama]</td>";
             echo "<td><button class='btn btn-s-md btn-primary' value='Lihat File Materi'
                       onclick=\"window.location.href='?module=materi&act=daftarmateri&id=$r[id_matapelajaran]';\">Lihat File Materi</button></td></tr>";
        $no++;
        }
        echo "</table>
        </div>
        
        </section>";


    }
    break;


case "daftarmateri":
    if ($_SESSION[leveluser] == 'siswa'){
        
        
        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        $data_mapel = mysql_fetch_array($mapel);
        $materi = mysql_query("SELECT * FROM file_materi WHERE id_matapelajaran = '$_GET[id]'  ");
        $cek_materi = mysql_num_rows($materi);
        if (!empty($cek_materi)){
        echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Daftar File Materi $data_mapel[nama]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
        ";
        echo "<table class='table table-bordered table-striped table-condensed cf'>";
        $no=$posisi+1;
        while ($r=mysql_fetch_array($materi)){
        echo "<tr><td rowspan='5'>$no</td>";
             if (!empty($r[nama_file])){
             $pecah = explode(".", $r[nama_file]);
             $ekstensi = $pecah[1];
             if ($ekstensi == 'zip'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/zip.png'></div></td>";
             }
             elseif ($ekstensi == 'rar'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/rar.png'></div></td>";
             }
             elseif ($ekstensi == 'doc'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/doc.png'><div></td>";
             }
             elseif ($ekstensi == 'pdf'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/pdf.png'></div></td>";
             }
             elseif ($ekstensi == 'ppt'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/ppt.png'></div></td>";
             }
             elseif ($ekstensi == 'pptx'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/pptx.png'></div></td>";
             }
             elseif ($ekstensi == 'docx'){
                 echo "<td rowspan='5'><div class='wdgt-row'><img src='images/doc.png'></div></td>";
             }
             }else{
                 echo "<td rowspan='5'><img src='images/kosong.png'></td>";
             }
             echo "<td>Judul</td><td> $r[judul]</td></tr>
             <tr><td>Nama File</td><td> $r[nama_file]</td></tr>
             <tr><td>Ukuran</td>";
                            if (!empty($r[nama_file])){
                            $file = "files_materi/$r[nama_file]";                            
                            echo "<td> ". fsize($file)."</td></tr>";
                            }else{
                                echo "<td>: </td></tr>";
                            }
             echo"<tr><td>Tanggal Posting</td><td> $r[tgl_posting]</td></tr>
             <tr><td colspan=2><input type=button class='btn btn-danger' value='Download File'
                       onclick=\"window.location.href='downlot.php?file=$r[nama_file]';\">
                       <b class='judul'>Di download  $r[hits] kali</b></td></tr>";
        $no++;
        }
        echo "</table>";

        echo "<p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali'
          onclick=self.history.back()></div></section>";
    }
    else{
        echo "<script>window.alert('Tidak ada file materi di mata pelajaran ini?');
            window.location=(href='media.php?module=materi')</script>";
    }
    }
    break;



case "editmateri":
    if ($_SESSION[leveluser]=='admin'){
    $edit=mysql_query("SELECT * FROM file_materi WHERE id_file = '$_GET[id]'");
    $m=mysql_fetch_array($edit);
    $isikelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
    $k=mysql_fetch_array($isikelas);
    $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$m[id_matapelajaran]'");
    $p=mysql_fetch_array($pelajaran);

    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form name='form_materi' method=POST action='$aksi?module=materi&act=edit_materi' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
    <input type=hidden name=id value='$m[id_file]'>
    
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>Judul</label></div>             <div class='col-sm-5'>
          <input type=text name='judul' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$m[judul]'></div></div>
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>Kelas</label></div>               <div class='col-sm-2'>
          <select name='id_kelas' onChange='showpel()' class='form-control'>
                                          <option value='".$k[id_kelas]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kelas ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></div></div>
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pelajaran</label></div>           <div class='col-sm-2'>
          <select id='pelajaran' name='id_matapelajaran'  class='form-control'>
                                          <option value='".$p[id_matapelajaran]."' selected>".$p[nama]."</option>
                                          </select></div></div>
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>File</label></div>                <div class='col-sm-5'> $m[nama_file]</div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Ganti File</label></div>         <div class='col-sm-5'>
           <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                                     <small>Apabila file tidak diganti, di kosongkan saja</small></div></div>
   
 <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <p><input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p></div></div>

          </form></div></div></div>";
    }
    else{
    $edit=mysql_query("SELECT * FROM file_materi WHERE id_file = '$_GET[id]'");
    $m=mysql_fetch_array($edit);
    $isikelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
    $k=mysql_fetch_array($isikelas);
    $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$m[id_matapelajaran]'");
    $p=mysql_fetch_array($pelajaran);

    echo "
    <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Edit Materi
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          <form name='form_materi_pengajar' method=POST action='$aksi?module=materi&act=edit_materi' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
    <input type=hidden name=id value='$m[id_file]'>
   
    <div class='form-group'>
          <div class='col-sm-2'>
          <label>Judul</label></div>     
                   <div class='col-sm-5'>
<input type=text name='judul' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$m[judul]' ></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>              <div class='col-sm-2'>
           <select name='id_kelas' onChange='showpel_pengajar()' class='form-control'>
                                          <option value='".$k[id_kelas]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kelas WHERE id_pengajar = '$_SESSION[idpengajar]'";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Pelajaran</label></div>        
            <div class='col-sm-2'>
           <select id='pelajaran_pengajar' name='id_matapelajaran' class='form-control'>
                                          <option value='".$p[id_matapelajaran]."' selected>".$p[nama]."</option>
                                          </select></div></div>

    <div class='form-group'>
          <div class='col-sm-2'><label>File</label></div>              <div class='col-sm-7'> $m[nama_file]</div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Ganti File</label></div>        <div class='col-sm-6'>
          <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
    <small>Apabila file tidak diganti, di kosongkan saja</small></div></div>
     <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'><p><input class='btn btn-success' type=submit value=Simpan>
                      <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p></div></div>
    </form></div></section>";
    }
    break;

}
}
?>
