<script>
function validasi(form){
  
  if (form.nama.value == ""){
      alert('Nama Masih Kosong!');
      form.nama.focus();
      return (false);
  }
  if (form.email.value == ""){
      alert('Email Masih Kosong!');
      form.email.focus();
      return (false);
  }
  pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!pola_email.test(form.email.value)){
        alert ('Penulisan Email tidak valid');
        form.email.focus();
        return false;
        }  
 
   return (true);
}
</script>
<?php
session_start();

 if(empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<div class='alert alert-info'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_admin/aksi_admin.php";
switch($_GET[act]){
  // Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_admin = mysql_query("SELECT * FROM admin ORDER BY username");      
      echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <input class='btn btn-danger' type=button value='Tambah Administrator' onclick=\"window.location.href='?module=admin&act=tambahadmin';\">";
          echo "<br/><br/><div class='alert alert-info'>Account administrator tidak bisa di hapus, tapi bisa di non aktifkan.</div>";
          echo "<br><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Username</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telp/HP</th><th>Blokir</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_admin)){
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
             <td>$r[alamat]</td>
		         <td><a href=mailto:$r[email]>$r[email]</a></td>
		         <td>$r[no_telp]</td>
		         <td align=center>$r[blokir]</td>
             <td><a href='?module=admin&act=editadmin&id=$r[id_session]'class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a></td></tr>";
      $no++;
    }
    echo "</table></div></div></div>";
    }
    else{
      echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;
  case "pengajar":
  if ($_SESSION[leveluser]=='admin'){
      $tampil_pengajar = mysql_query("SELECT * FROM pengajar ORDER BY username_login");
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <input class='btn btn-warning' type=button value='Tambah Pengajar' onclick=\"window.location.href='?module=admin&act=tambahpengajar';\">";
          echo "<br><br><table  id='example1' class='table table-bordered table-striped'>
      <thead>    
          <tr>
          <th>No</th><th>Nip</th><th>Username</th><th>Nama</th><th>Blokir</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pengajar)){
       echo "<tr><td>$no</td>
             <td>$r[nip]</td>
             <td>$r[username_login]</td>
             <td>$r[nama_lengkap]</td>             
		         <td align=center>$r[blokir]</td>
             <td><a href='?module=admin&act=editpengajar&id=$r[id_pengajar]'class='btn btn-primary btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=?module=detailpengajar&act=detailpengajar&id=$r[id_pengajar] class='btn btn-info btn-sm btn-icon icon-left'>
              <i class='entypo-info'></i>
              Profile</a>|
                  <a href='$aksi?module=admin&act=hapus&id=$r[id_pengajar]' class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></a></td></tr>";
      $no++;
    }
    echo "</table></div></div></div>";
  }else{     
        echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
  }
  break;
  case "tambahadmin":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <form method=POST action='$aksi?module=admin&act=input_admin' class='form-horizontal form-groups-bordered' onSubmit='return validasi(this)'>
          <div class='form-group'>
          <div class='col-sm-2'><label>Username</label></div>     
          <div class='col-sm-5'> 
           <input type=text name='username' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>  
          <div class='form-group'>
          <div class='col-sm-2'><label>Password</label></div>    
          <div class='col-sm-5'> 
           <input type=text name='password' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama</label></div> <div class='col-sm-5'> 
         <input type=text name='nama_lengkap' size=30 class='form-control' id='nama' required='required' placeholder='Placeholder'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Alamat</label></div>        
          <div class='col-sm-5'>
          <input type=text name='alamat' size=70 class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>E-mail</label></div>     
            <div class='col-sm-5'>
            <input type=text name='email' size=30 class='form-control' id='email' required='required' placeholder='Placeholder'></div></div>
             ";?>
      <div class="form-group">
                  <div class='col-sm-2'> <label>No HP</label></div>
                  <div class='col-sm-5'>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input class="form-control" type="text" name='no_telp' data-inputmask='"mask": "+62-###-####-####"' data-mask>
                    </div>
                  </div><!-- /.input group -->
                  </div>

         <?php echo
    "
        <div class='form-group'>
          <div class='col-sm-2'>
        <label>Blokir</label></div>       <div class='col-sm-3'><input type=radio name='blokir' value='Y'> Y
                                           <input type=radio name='blokir' value='N' checked> N </div></div> 
          <div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
          </form></div></div></div>";
    }
    else{
    
      echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;
  case "tambahpengajar":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form method=POST action='$aksi?module=admin&act=input_pengajar' enctype='multipart/form-data' class='form-horizontal form-groups-bordered' onSubmit='return validasi(this)'>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nip</label></div>         
           <div class='col-sm-5'>
           <input type=text name='nip' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
         <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Lengkap</label></div>    
          <div class='col-sm-5'>
          <input type=text name='nama_lengkap' size=30 class='form-control' id='nama' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Username</label></div>
          <div class='col-sm-5'>
          <input type=text name='username' class='form-control' id='nama' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Password</label></div>
          <div class='col-sm-5'>
          <input type=text name='password' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Alamat</label></div>      <div class='col-sm-8'>
          <input type=text name='alamat' size=70 class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tempat lahir</label></div>
          <div class='col-sm-5'>
          <input type=text name='tempat_lahir' size=50 class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'><label>Tanggal Lahir</label></div><div class='col-sm-9'> : ";
          combotgl(1,31,'tgl',$tgl_skrg);
          combonamabln(1,12,'bln',$bln_sekarang);
          combothn(1950,$thn_sekarang,'thn',$thn_sekarang);
          echo "</div></div>";
    echo "
       <div class='form-group'>
          <div class='col-sm-2'>
          <label>Jenis Kelamin</label></div> <div class='col-sm-5'>
          <label><input type=radio name='jk' value=L>Laki-laki</input></label>
                                             <label><input type=radio name='jk' value=P>Perempuan</input></label></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Agama</label></div>        <div class='col-sm-2'>
          <select name='agama' id='select1'  size='1' class='form-control'>

                                                           <option value='0' selected>-- Pilih --</option>
                                                           <option value='Islam'>Islam</option>
                                                           <option value='Kristen'>Kristen</option>
                                                           <option value='Katolik'>Katolik</option>
                                                           <option value='Hindu'>Hindu</option>
                                                           <option value='Buddha'>Buddha</option>
                                                           </select></div></div>
        
          ";?>
      <div class="form-group">
                  <div class='col-sm-2'> <label>No HP</label></div>
                  <div class='col-sm-5'>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input class="form-control" type="text" name='no_telp' data-inputmask='"mask": "+62-###-####-####"' data-mask>
                    </div>
                  </div><!-- /.input group -->
                  </div>

         <?php echo
    "
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>E-mail</label></div> <div class='col-sm-5'> 
          <input type=text name='email' size=30 class='form-control' id='email' required='required' placeholder='Placeholder'></div></div>
       <div class='form-group'>
          <div class='col-sm-2'>
          <label>Website</label></div>
          <div class='col-sm-5'>
          <input type=text name='website' size=30 value='http://' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Foto</label></div>      
          <div class='col-sm-5'>   <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                                      <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Jabatan</label></div>      <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='jabatan' size=30></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Blokir</label></div>       
          <div class='col-sm-5'><label><input type=radio name='blokir' value='Y'> Y</label>
                                                      <label><input type=radio name='blokir' value='N' checked> N </label></div></div>
          <div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
          </form></div></div></div>";
    }
    else{
      echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;
  case "editadmin":
    $edit=mysql_query("SELECT * FROM admin WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    if ($_SESSION[leveluser]=='admin'){
    echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form method=POST class='form-horizontal form-groups-bordered' onSubmit='return validasi(this)' action=$aksi?module=admin&act=update_admin>
          <input type=hidden name=id value='$r[id_session]'>     
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Username</label></div>    
           <div class='col-sm-5'>
<input type=text class='form-control' id='nama' required='required' placeholder='Placeholder' name='username' value='$r[username]'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Password</label></div>
      <div class='col-sm-5'><input type=text class='form-control' id='field-1'  placeholder='Placeholder' name='password'>
                                                      <small>Apabila password tidak diubah, dikosongkan saja.</small>
                                               </div></div>
       <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama</label></div> <div class='col-sm-5'>
  <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='nama_lengkap' size=30  value='$r[nama_lengkap]'></div></div>
       <div class='form-group'>
          <div class='col-sm-2'>
          <label>Alamat</label></div>       <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='alamat' size=70  value='$r[alamat]'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'><label>E-mail</label></div>       <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='email' size=30 value='$r[email]'></div></div>
          ";?>
      <div class="form-group">
                  <div class='col-sm-2'> <label>No HP</label></div>
                  <div class='col-sm-5'>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input class="form-control" type="text" name='no_telp' value=<?php echo $r['no_telp'] ?> data-inputmask='"mask": "+62-###-####-####"' data-mask>
                    </div>
                  </div><!-- /.input group -->
                  </div>

         <?php echo
    "";
    if ($r[blokir]=='N'){
      echo " <div class='form-group'>
          <div class='col-sm-2'>
          <label>Blokir</label></div>     <div class='col-sm-5'> <input type=radio name='blokir' value='Y'> Y
                                                      <input type=radio name='blokir' value='N' checked> N </div></div>";
    }
    else{
       echo " <div class='form-group'>
          <div class='col-sm-2'>
          <label>Blokir</label></div>     <div class='col-sm-5'><input type=radio name='blokir' value='Y' checked> Y
                                                       <input type=radio name='blokir' value='N'> N </div></div>"; } 
    echo "
           <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></div></div>";
    }
    else{  
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;
 case "editpengajar":
    $edit=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form method=POST action=$aksi?module=admin&act=update_pengajar enctype='multipart/form-data' role='form' onSubmit=\"return validasi(this)\" class='form-horizontal form-groups-bordered'>
          <input type=hidden name=id value='$r[id_pengajar]'>
          <div class='form-group'>
          <div class='col-sm-2'><label>Nip</label></div>
                    <div class='col-sm-5'>
           <input type=text name='nip' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$r[nip]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Lengkap</label></div> <div class='col-sm-5'>
       <input type=text name='nama_lengkap' class='form-control' id='nama' required='required' placeholder='Placeholder' size=30 value='$r[nama_lengkap]'></div></div>
      <div class='form-group'>
          <div class='col-sm-2'>
  <label>Username</label></div><div class='col-sm-5'>
<input type=text name='username' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$r[username_login]'></div></div>
  <div class='form-group'>
          <div class='col-sm-2'>
          <label>Password</label></div>     
          <div class='col-sm-5'>
          <input type=text name='password' class='form-control' id='field-1' placeholder='Placeholder'> 
                                                      <small>Apabila password tidak diubah, dikosongkan saja</small>
                                               </div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Alamat</label></div>       <div class='col-sm-5'> 
<input type=text name='alamat' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=70 value='$r[alamat]'></div></div>
<div class='form-group'>
          <div class='col-sm-2'>
<label>Tempat Lahir</label></div> 
<div class='col-sm-5'>
<input type=text name='tempat_lahir' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=60 value='$r[tempat_lahir]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tanggal Lahir</label></div>
          <div class='col-sm-9'> ";
          $get_tgl=substr("$r[tgl_lahir]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_lahir]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_lahir]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);
    echo "</div></div>";
          if ($r[jenis_kelamin]=='L'){
              echo "
              <div class='form-group'>
          <div class='col-sm-2'>
          <label>Jenis Kelamin</label></div><div class='col-sm-5'><label><input type=radio name='jk' value='L' checked>Laki - Laki</label>
                                                                <label><input type=radio name='jk' value='P'>Perempuan</label></div></div>";
          }else{
              echo "<div class='form-group'>
          <div class='col-sm-2'>
          <label>Jenis Kelamin</label></div> <div class='col-sm-5'><label><input type=radio name='jk' value='L'>Laki - Laki</label>
                                           <label><input type=radio name='jk' value='P' checked>Perempuan</label></div></div>";
          }
     echo"<div class='form-group'>
          <div class='col-sm-2'>
          <label>Agama</label></div>        <div class='col-sm-2'><select name=agama class='form-control'>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></div></div>
                   <div class='form-group'>
                  <div class='col-sm-2'> <label>No Telp</label></div>
                  <div class='col-sm-5'>
                    <div class='input-group'>
                      <div class='input-group-addon'>
                        <i class='fa fa-phone'></i>
                      </div>";?>
                      <input class='form-control' type='text' name='no_telp' value=<?php echo $r['no_telp'] ?> data-inputmask='"mask": "+62-###-####-####"' data-mask>
                   
                 </div>
                  </div><!-- /.input group -->
                  </div>
   
 <?php echo "<div class='form-group'>
          <div class='col-sm-2'>
          <label>E-mail</label></div>       <div class='col-sm-5'>  
        <input type=text name='email' class='form-control' id='email' required='required' placeholder='Placeholder' value='$r[email]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Website</label></div>      <div class='col-sm-5'>  <input type=text name='website' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=30 value='$r[website]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Foto</label></div>         <div class='col-sm-5'>  ";
                                if ($r[foto]!=''){
              echo "<div class='wdgt-row'>
                    <img src='../foto_pengajar/medium_$r[foto]'></div>
                    ";
          }echo "</div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Jabatan</label></div>          
          <div class='col-sm-5'> <input type=text name='jabatan' value='$r[jabatan]' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=50></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Ganti Foto</label></div>
          <div class='col-sm-5'>  <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                           <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
                                           <small>Apabila foto tidak diubah, dikosongkan saja</small></div></div>";
          if ($r[blokir]=='N'){

           echo "<div class='form-group'>
          <div class='col-sm-2'><label>Blokir</label></div>     <div class='col-sm-5'> 
           <label><input type=radio name='blokir' value='Y'> Y<label>
                                           <label><input type=radio name='blokir' value='N' checked> N <label></div></div>";
            }
            else{
           echo "<div class='form-group'>
          <div class='col-sm-2'>
          <label>Blokir</label></div>     <div class='col-sm-5'>
          <label><input type=radio name='blokir' value='Y' checked> Y<label>
                                          <label><input type=radio name='blokir' value='N'> N <label></div></div>";
            }
          echo "<div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
          </form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $edit=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_SESSION[idpengajar]'");
        $r=mysql_fetch_array($edit);
     echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Edit Profil
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
     <form method=POST action=$aksi?module=admin&act=update_pengajar2 enctype='multipart/form-data' role='form' class='form-horizontal form-groups-bordered' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_pengajar]'>          
          <div class='form-group'>
          <div class='col-sm-3'>
          <label>Nip</label></div>          <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='nip' value='$r[nip]'></div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <dt><label>Nama Lengkap</label></div>   <div class='col-sm-5'><input type=text class='form-control' id='nama' required='required' placeholder='Placeholder' name='nama_lengkap' size=30 value='$r[nama_lengkap]'></div>
          </div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Username</label></div>     <div class='col-sm-5'>  <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='username' value='$r[username_login]'></div>
          </div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Password</label></div>     <div class='col-sm-5'>  <input type=text class='form-control' id='field-1'  placeholder='Placeholder' name='password'>
                                                      <small>Apabila password tidak diubah, dikosongkan saja</small>
                                               </div>
                                               </div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Alamat</label></div>       <div class='col-sm-8'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='alamat' size=70 value='$r[alamat]'></div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Tempat Lahir</label></div> 
          <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='tempat_lahir' size=60 value='$r[tempat_lahir]'></div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Tanggal Lahir</label></div><div class='col-sm-9'> : ";
          $get_tgl=substr("$r[tgl_lahir]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_lahir]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_lahir]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);
    echo "</div></div>";
          if ($r[jenis_kelamin]=='L'){
              echo " <div class='form-group'>
          <div class='col-sm-3'><label>Jenis Kelamin</label></div>  <div class='col-sm-5'>
          <label><input type=radio name='jk' value='L' checked>Laki - Laki</label>
               <label><input type=radio name='jk' value='P'>Perempuan</label></div></div>";
          }else{
              echo "<div class='form-group'>
          <div class='col-sm-3'>
          <label>Jenis Kelamin</label></div> <div class='col-sm-5'> <label><input type=radio name='jk' value='L'>Laki - Laki</label>
                                           <label><input type=radio name='jk' value='P' checked>Perempuan</label></div></div>";
          }
     echo"<div class='form-group'>
          <div class='col-sm-3'>
          <label>Agama</label></div>        <div class='col-sm-2'> <select name=agama class='form-control'>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></div></div>
          <div class='form-group'>
          <div class='col-sm-3'><label>No.Telp/HP</label></div>  
           <div class='col-sm-5'>
          ";?>
   <input class='form-control' type='text' name='no_telp' value=<?php echo $r['no_telp'] ?> data-inputmask='"mask": "+62-###-####-####"' data-mask>
                   
<?php echo "
       </div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>E-mail</label></div
           <div class='col-sm-5'>  <input type=text class='form-control' id='email' required='required' placeholder='Placeholder' name='email' size=30 value='$r[email]'></div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Website</label></div>      <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='website' size=30 value='$r[website]'></div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Foto</label></div>         <div class='col-sm-5'> : ";
                                if ($r[foto]!=''){
              echo "<div class='wdgt-row'>
                    <img src='../foto_pengajar/medium_$r[foto]'></div>                    
                   ";
          }echo "</div></div>
           <div class='form-group'>
          <div class='col-sm-3'>
          <label>Jabatan</label></div>          <div class='col-sm-5'>  <input type=text  readonly='readonly' class='form-control' id='field-1' required='required' placeholder='Placeholder' name='jabatan' value='$r[jabatan]' size=50></div></div>
          
          <div class='form-group'>
          <div class='col-sm-3'>
          <label>Ganti Foto</label></div>       <div class='col-sm-5'> 
          <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
           <br/>
                                           <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
                                           <small>Apabila foto tidak diubah, dikosongkan saja</small></div></div>";
          if ($r[blokir]=='N'){

           echo " <div class='form-group'>
          <div class='col-sm-3'><label>Blokir</label></div>     
          <div>  <label><input type=radio name='blokir' value='Y' readonly='readonly'> Y<label>
                                           <label><input type=radio name='blokir' value='N' readonly='readonly' checked> N <label></div></div>";
            }
            else{
           echo " <div class='form-group'>
          <div class='col-sm-3'><label>Blokir</label></div>     <div> <label><input type=radio name='blokir' value='Y' readonly='readonly' checked> Y<label>
                                          <label><input type=radio name='blokir' readonly='readonly' value='N'> N <label></div></div>";
            }
          echo " <div class='form-group'>
          <div class='col-sm-3'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form>
          </div></section>";
    }
    break;
case "detailpengajar":
    $detail=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_GET[id]'");
    $r=mysql_fetch_array($detail);
    $tgl_lahir   = tgl_indo($r[tgl_lahir]);

    if ($_SESSION[leveluser]=='admin'){
    echo "
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-4'>
              <div class='box box-warning'>
                <div class='box-body box-profile'>
                  <center><img class='profile-user-img img-responsive img-rounded' src='../foto_pengajar/medium_$r[foto]' alt='User profile picture'></center>
                  <h3 class='profile-username text-center'>$r[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$r[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$r[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tgl. Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$r[agama]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$r[email]' class='pull-right'>$r[email]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Website</b> <a href='http://$r[website]' target='_blank' class='pull-right'>$r[website]</a>
                    </li>
                  </ul>

                  <a href='#' class='btn btn-warning btn-block'><b>Follow</b></a>
                </div>
              </div>
            </div>
            "; ?>
             <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['nip'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['no_telp'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($r['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Blokir</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php   if ($r[blokir]=='N'){
           echo "Tidak";
            }
            else{
           echo "Ya";
            } ?> readonly=''>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                </form>
              </div>
              <div class='box box-warning'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Alamat</h3>
                </div>
                <div class='box-body'>
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $r['alamat'] ?></p>
                </div>
              </div>
            </div><?php echo "  
       </div></div>";
          
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        echo "<div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-3'>
              <div class='box box-info'>
                <div class='box-body box-profile'>
                  <img class='profile-user-img img-responsive img-rounded' src='../foto_pengajar/medium_$r[foto]' alt='User profile picture'>
                  <h3 class='profile-username text-center'>$r[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$r[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$r[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tgl. Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$r[agama]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$r[email]' class='pull-right'>$r[email]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Website</b> <a href='http://$r[website]' target='_blank' class='pull-right'>$r[website]</a>
                    </li>
                  </ul>

                  <a href='#' class='btn btn-primary btn-block'><b>Follow</b></a>
                </div>
              </div>
            </div>";?>

<div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['nip'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['no_telp'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($r['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Blokir</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php   if ($r[blokir]=='N'){
           echo "Tidak";
            }
            else{
           echo "Ya";
            } ?> readonly=''>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                </form>
              </div>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Alamat</h3>
                </div>
                <div class='box-body'>
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $r['alamat'] ?></p>
                </div>
              </div>
            </div>
          </div></div>
            <?php
    }else{
        echo"<div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-3'>
              <div class='box box-info'>
                <div class='box-body box-profile'>
                  <img class='profile-user-img img-responsive img-rounded' src='foto_pengajar/medium_$r[foto]' alt='User profile picture'>
                  <h3 class='profile-username text-center'>$r[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$r[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$r[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tanggal Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$r[agama]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$r[email]' class='pull-right'>$r[email]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Website</b> <a href='http://$r[website]' target='_blank' class='pull-right'>$r[website]</a>
                    </li>
                  </ul>

                  <a href='#' class='btn btn-primary btn-block'><b>Follow</b></a>
                </div>
              </div>
            </div>"; ?>
            <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['nip'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['no_telp'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($r['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Blokir</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php   if ($r[blokir]=='N'){
           echo "Tidak";
            }
            else{
           echo "Ya";
            } ?> readonly=''>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                </form>
              </div>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Alamat</h3>
                </div>
                <div class='box-body'>
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $r['alamat'] ?></p>
                </div>
              </div>
            </div>
          </div></div>




            <?php 
    }
    break;
}
}
?>
