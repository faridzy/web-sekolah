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
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{



$aksi="modul/mod_siswa/aksi_siswa.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil Siswa
  default:
    if ($_SESSION[leveluser]=='admin'){

   

      $tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_kelas");
      echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

          <input class='btn btn-warning' type=button value='Tambah Siswa' onclick=\"window.location.href='?module=siswa&act=tambahsiswa';\">";
      echo "<br><br><div class='alert alert-info'>Siswa bisa di non aktifkan.</div>";
      echo "<br><table id='example1' class='table table-bordered table-striped'>
      <thead>
          
            <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>

            <th>Jenis Kelamin</th>
            <th>Blokir</th>
            <th>Aksi</th>
           
           </tr>
      </thead>";
      $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil_siswa)){
       echo "<tr><td>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-primary'>$k[nama]</a></td>";
             }
             echo"<td><p align='center'>$r[jenis_kelamin]</p></td>             
             <td><p align='center'>$r[blokir]</p></td>
             <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' class='btn btn-default btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=?module=detailsiswa&act=detailsiswa&id=$r[id_siswa]  class='btn btn-info btn-sm btn-icon icon-left'>
              <i class='entypo-info'></i>
              Profile</a>|
                  <a href=javascript:confirmdelete('$aksi?module=siswa&act=hapus&id=$r[id_siswa]') class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></td></tr>";
      $no++;
    }

    echo "</table></div></div></div>
<br/>
<br/>
<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'>";

          $tampil=mysql_query("SELECT nis,nama_lengkap,alamat,tempat_lahir,tgl_lahir,id_kelas,th_masuk,no_telp,jenis_kelamin FROM siswa");

echo "<table id='example3' class='table table-bordered table-striped'>
      <thead>
          
            <tr>
            <th>No</th>
            <th>nis</th>
            <th>Nama</th>
            <th>Kelas</th>
             <th>alamat</th>
              <th>Tempat Lahir</th>
               <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Tahun Masuk</th>
            <th>No Telp</th>
           
           </tr>
      </thead>";
        $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo"
      <tr><td>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td>$k[nama]</td>";
             }
             echo"            
             <td><p align='center'>$r[alamat]</p></td>
             <td>$r[tempat_lahir]</td>
             <td>$r[tgl_lahir]</td>
             <td>$r[jenis_kelamin]</td>
             <td>$r[th_masuk]</td>
             <td>$r[no_telp]</td>




             </tr>



      ";
         $no++;
    }
       echo"</table>   
       </div></div><div>



    "; 
    }
    elseif($_SESSION[leveluser]=='pengajar'){

   

      $tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_kelas");
      echo " <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Daftar Siswa
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        ";
      echo "";
      echo "<br><table id='example1' class='table table-bordered table-striped'>
      <thead>
          
            <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>

            <th>Jenis Kelamin</th>
            <th>Blokir</th>
            <th>Aksi</th>
           
           </tr>
      </thead>";
      $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil_siswa)){
       echo "<tr><td>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</a></td>";
             }
             echo"<td><p align='center'>$r[jenis_kelamin]</p></td>             
             <td><p align='center'>$r[blokir]</p></td>
             <td>
                 <a href=?module=detailsiswa&act=detailsiswa&id=$r[id_siswa]  class='btn btn-info btn-sm btn-icon icon-left'>
              <i class='entypo-info'></i>
              Profile</a>
                  </td></tr>";
      $no++;
    }

    echo "</table></div></section>
"; 
}  
    break;

case "lihatmurid":
    if ($_SESSION[leveluser]=='admin'){
   
    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap ");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
    echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <br><table id='example1' class='table table-bordered table-striped'><thead>
        
            <tr><th>No</th><th>Nis</th><th>Nama</th><th>Kelas</th><th>Jenis Kelamin</th>
            <th>Blokir</th><th>Aksi</th></tr></thead>";
     $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>
             ";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href='?module=kelas&act=detailkelas&id=$k[id_kelas]' class='btn btn-primary'>$k[nama]</a></td>";
             }
             echo "<td><p align='center'>$r[jenis_kelamin]</p></td>             
             <td><p align='center'>$r[blokir]</p></td>
             <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' class='btn btn-danger btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit
</a> |
                 <a href=?module=detailsiswa&act=detailsiswa&id=$r[id_siswa]  class='btn btn-info btn-sm btn-icon icon-left'>
              <i class='entypo-info'></i>
              Profile
</a></td></tr>";
      $no++;
    }
    echo "</table>";
    
   
    echo "</div></div>
  </div>";
    }else{
        echo "<script>window.alert('Tidak ada siswa dikelas ini');
            window.location=(href='?module=kelas')</script>";
    }
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
    

    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap  ");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
    echo " <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Daftar Siswa
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'> ";
    echo "<table  id='example1' class='table table-bordered table-striped'>
      <thead>
         
            <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>

            <th>Jenis Kelamin</th>
            <th>Aksi</th>
           
           </tr>
      </thead>
      <tbody>";
     $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href=?module=kelas&act=detailkelas&id=$k[id_kelas]>$k[nama]</a></td>";
             }
             echo "<td><p align='center'>$r[jenis_kelamin]</p></td>                       
             <td><input type=button class='btn btn-info' value='Detail Siswa' onclick=\"window.location.href='?module=detailsiswapengajar&act=detailsiswa&id=$r[id_siswa]';\">";
      $no++;
    }
    echo "</tbody>
    
      </table>
  ";
   

    echo "
    </div></section>";
    }else{
        echo "<script>window.alert('Tidak ada siswa dikelas ini');
            window.location=(href='?module=kelas')</script>";
    }
    }
    else{
  

    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap ");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
    echo " <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Daftar Siswa
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
   <table  id='example1' class='table table-bordered table-striped'>
      <thead>
         
        
            <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Th Masuk</th>
           <th>Aksi</th>
           </tr>
      </thead>
     ";
     $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo " <tbody>
       <tr>
              <td>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>             
             <td>$r[jenis_kelamin]</td>
             <td>$r[th_masuk]</td>
             <td><a href='?module=siswa&act=detailsiswa&id=$r[id_siswa]' class='btn btn-info'>Detail Siswa</a></td>
        </tr>";
      $no++;
    }
    echo "</tbody>
   
      </table>
      <br/>
    
  
    ";
  

    echo "
          <hr/>
          <button type='button' class='btn btn-primary' value='Kembali'
          onclick=self.history.back()>Kembali</button></div></section>";
    }else{
        echo "<script>window.alert('Tidak ada siswa dikelas ini');
            window.location=(href='?module=kelas')</script>";
    }
    }
    break;

case "tambahsiswa":
    if ($_SESSION[leveluser]=='admin'){
        $tampil = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_GET[id]'");
       
        echo "
    <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <form method=POST action='$aksi?module=siswa&act=input_siswa' enctype='multipart/form-data' class='form-horizontal form-groups-bordered' onSubmit='return validasi(this)'>
          
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nis</label></div>
          <div class='col-sm-5'>
          <input type=text name='nis' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Lengkap</label></div> 
          <div class='col-sm-5'>
          <input type=text name='nama_lengkap' class='form-control' id='nama' required='required' placeholder='Placeholder' size=30></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Username Login</label></div>   
            <div class='col-sm-5'>
            <input type=text name='username' class='form-control' id='nama' required='required' placeholder='Placeholder'></div></div>
        <div class='form-group'>
          <div class='col-sm-2'>
          <label>Password Login</label></div>     <div class='col-sm-5'>
          <input type=text name='password' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Kelas</label></div>        <div class='col-sm-2'><select name='id_kelas' class='form-control'>
                                           <option value=0 selected>--pilih--</option>";
                                           $tampil=mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
                                           while($r=mysql_fetch_array($tampil)){
                                           echo "<option value=$r[id_kelas]>$r[nama]</option>";
                                           }echo "</select></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Level </label></div>     <div class='col-sm-5'>
           <input type=text name='jabatan' class='form-control' id='field-1' value='siswa' readonly='' required='required' placeholder='Placeholder' size=50></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Alamat</label></div>       <div class='col-sm-8'>
          <input type=text name='alamat'class='form-control' id='field-1' required='required' placeholder='Placeholder' size=70></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tempat Lahir</label></div> <div class='col-sm-5'>
          <input type=text name='tempat_lahir' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=50></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tanggal Lahir</label></div><div class='col-sm-9'> : ";
          combotgl(1,31,'tgl',$tgl_skrg);
          combonamabln(1,12,'bln',$bln_sekarang);
          combothn(1950,$thn_sekarang,'thn',$thn_sekarang);

    echo "</div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Jenis Kelamin</label></div><div class='col-sm-5'>
           <label><input type=radio name='jk' value='L'>Laki - Laki</input></label>
                                           <label><input type=radio name='jk' value='P'>Perempuan</input></label></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Agama</label></div>        <div class='col-sm-2'><select name=agama class='form-control'>
                                           <option value='0' selected>--pilih--</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Ayah/Wali</label></div> 
          <div class='col-sm-5'>
          <input type=text name='nama_ayah' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=30></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Ibu</label></div>   
            <div class='col-sm-5'>
            <input type=text name='nama_ibu' class='form-control' id='field-1' required='required' placeholder='Placeholder' size=30></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tahun Masuk</label></div>  <div class='col-sm-7'>"; combothn(2000,$thn_sekarang,'th_masuk',$thn_sekarang); echo "</div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Email</label></div>        <div class='col-sm-5'><input type=text name='email' class='form-control' id='email' required='required' placeholder='Placeholder' size=30></div></div>
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
          <label>Foto</label></div>       
          <div class='col-sm-5'> <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                           <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Blokir</label></div>       <div class='col-sm-5'>
          <label><input type=radio name='blokir' value='Y'> Y</label>
                                           <label><input type=radio name='blokir' value='N' checked> N </label></div></div>
         
          <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div>
          </form></div></div></div>";
    }
    break;

  case "nis_ada":
     if ($_SESSION[leveluser]=='admin'){
         echo "<span class='judulhead'><p class='garisbawah'>NIS SUDAH PERNAH DIGUNAKAN<br>
               <input type=button value=Kembali onclick=self.history.back()></p></span>";
     }
     break;

  case "editsiswa":
    $edit=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
    $kelas = mysql_fetch_array($get_kelas);

    if ($_SESSION[leveluser]=='admin'){
    echo "
    <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form method=POST action=$aksi?module=siswa&act=update_siswa enctype='multipart/form-data' class='form-horizontal form-groups-bordered' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_siswa]'>
          
          
          <div class='form-group'>
          <div class='col-sm-2'><label>Nis</label></div>
  <div class='col-sm-5'>
  <input type=text name=nis value='$r[nis]' class='form-control' required='required' id='field-1' placeholder='Placeholder'></div></div>
  <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama</label></div>     
          <div class='col-sm-5'>
<input type=text name='nama' value='$r[nama_lengkap]' class='form-control' required='required' id='nama' placeholder='Placeholder' size=70></div></div>
        <div class='form-group'>
          <div class='col-sm-2'>
          <label>Username Login</label></div>     <div class='col-sm-5'> 
          <input type=text name='username' value='$r[username_login]' class='form-control' required='required' id='field-1' placeholder='Placeholder'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Password Login</label></div> 
          <div class='col-sm-5'>
  <input type=text name='password' class='form-control'id='field-1' placeholder='Placeholder' size=30>
  <small>Apabila password tidak diubah, dikosongkan saja</small>
  </div></div>
         
          <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>        
          <div class='col-sm-2'> <select name='id_kelas' class='form-control'>
                                           <option value=$kelas[id_kelas] selected>$kelas[nama]</option>";
                                           $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama");
                                           while($k=mysql_fetch_array($tampil)){
                                           echo "<option value=$k[id_kelas]>$k[nama]</option>";
                                           }echo "</select></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Jabatan</label></div>      <div class='col-sm-5'>  <input type=text name='jabatan' class='form-control' required='required' id='field-1' placeholder='Placeholder' readonly='' size=50 value='$r[jabatan]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Alamat</label></div>       <div class='col-sm-10'>  <input type=text name='alamat' class='form-control' required='required' id='field-1' placeholder='Placeholder' size=70 value='$r[alamat]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tempat Lahir</label></div> <div class='col-sm-5'><input type=text name='tempat_lahir' class='form-control' required='required' id='field-1' placeholder='Placeholder' size=50 value='$r[tempat_lahir]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Tanggal Lahir</label></div><div class='col-sm-10'>  ";
          $get_tgl=substr("$r[tgl_lahir]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_lahir]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_lahir]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);

    echo "</div></div>";
          if ($r[jenis_kelamin]=='L'){
              echo "<div class='form-group'>
          <div class='col-sm-2'><label>Jenis Kelamin</label></div>
      <div class='col-sm-5'><label><input type=radio name='jk' value='L' checked>Laki - Laki</label>
                                           <label><input type=radio name='jk' value='P'>Perempuan</label></div></div>";
          }else{
              echo "<div class='form-group'>
          <div class='col-sm-2'>
          <label>Jenis Kelamin</label></div>
          <div class='col-sm-5'>
          <label><input type=radio name='jk' value='L'>Laki - Laki</label>
                                           <label><input type=radio name='jk' value='P' checked>Perempuan</label></div></div>";
          }      
          echo "<div class='form-group'>
          <div class='col-sm-2'>
          <label>Agama</label></div>        
          <div class='col-sm-2'><select name=agama class='form-control'>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></div></div>
  <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Ayah/Wali</label></div> 
          <div class='col-sm-5'>
    <input type=text name='nama_ayah' class='form-control' required='required' id='field-1' placeholder='Placeholder' size=30 value='$r[nama_ayah]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Ibu</label></div>     <div class='col-sm-5'><input type=text name='nama_ibu' class='form-control' required='required' id='field-1' placeholder='Placeholder' size=30 value='$r[nama_ibu]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Tahun Masuk</label></div>  <div class='col-sm-7'>";  
          $get_thn=substr("$r[th_masuk]",0,4);
          combothn(2000,$thn_sekarang,'th_masuk',$get_thn);
          echo "</div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Email</label></div>        <div class='col-sm-5'><input type=text name='email' class='form-control' required='required' id='email' placeholder='Placeholder' size=30 value='$r[email]'></div></div>
         ";?>
      <div class="form-group">
                  <div class='col-sm-2'> <label>No HP</label></div>
                  <div class='col-sm-5'>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input class="form-control" type="text" name='no_telp' value=<?php echo $r['no_telp']?> data-inputmask='"mask": "+62-###-####-####"' data-mask>
                    </div>
                  </div><!-- /.input group -->
                  </div>

         <?php echo
    "
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Foto</label></div>   <div class='col-sm-5'> : ";
            if ($r[foto]!=''){
              echo "
                    <img src='../foto_siswa/medium_$r[foto]'>
                  ";
          }echo "</div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Ganti Foto</label></div>       <div class='col-sm-5'>  <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                                <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
                                                <small>Apabila foto tidak diganti, dikosongkan saja</small></div></div>";
    if ($r[blokir]=='N'){
      echo "<div class='form-group'>
          <div class='col-sm-2'>
          <label>Blokir</label></div>     <div class='col-sm-5'>   <label><input type=radio name='blokir' value='Y'> Y</label>
                                           <label><input type=radio name='blokir' value='N' checked> N </label></div></div>";
    }
    else{
      echo "<div class='form-group'>
          <div class='col-sm-2'><label>Blokir</label></div><div class='col-sm-5'><label><input type=radio name='blokir' value='Y' checked> Y</label>
                                          <label><input type=radio name='blokir' value='N'> N </label></div></div>";
    }

    echo "
          <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='siswa') {
     echo" <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Edit Profil
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              ";
     echo"<form method=POST action=$aksi_siswa?module=siswa&act=update_profil_siswa enctype='multipart/form-data' class='form-horizontal form-groups-bordered'  onSubmit='return validasi(this)'>
          <input type=hidden name=id value='$r[id_siswa]'>
          
          <div class='form-group'>
          <div class='col-sm-2'><label>Nis</label></div>
  <div class='col-sm-5'><input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name=nis value='$r[nis]'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Nama</label></div>
  <div class='col-sm-5'>
  <input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name='nama' value='$r[nama_lengkap]' ></div></div>          
      <div class='form-group'>
          <div class='col-sm-2'><label>Alamat</label></div>
  <div class='col-sm-9'>
  <input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name='alamat' size=80 value='$r[alamat]'></div>
           </div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Tempat Lahir</label></div>
  <div class='col-sm-5'><input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name='tempat_lahir' size=80 value='$r[tempat_lahir]'></div>
         </div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Tanggal Lahir</label></div>
  <div class='col-sm-10'>";
          $get_tgl=substr("$r[tgl_lahir]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_lahir]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_lahir]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);

    echo "</div></div>";
          if ($r[jenis_kelamin]=='L'){
              echo "<div class='form-group'>
          <div class='col-sm-2'><label>Jenis Kelamin</label></div>
  <div class='col-sm-5'><input type=radio name='jk' value='L'  checked>Laki - Laki
                                           <input type=radio name='jk' value='P' >Perempuan</div></div>";
          }else{
              echo "<div class='form-group'>
          <div class='col-sm-2'><label>Jenis Kelamin</label></div>
  <div class='col-sm-5'><input type=radio name='jk' value='L' >Laki - Laki
                                           <input type=radio name='jk' value='P'  checked>Perempuan</div></div>";
          }
          echo "<div class='form-group'>
          <div class='col-sm-2'><label>Agama</label></div>
  <div class='col-sm-5'><select name=agama class='form-control'>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Nama Ayah</label></div>
  <div class='col-sm-5'>
  <input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name='nama_ayah' size=80 value='$r[nama_ayah]'></div> 
         </div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Nama Ibu</label></div>
  <div class='col-sm-5'>
  <input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name='nama_ibu' size=80 value='$r[nama_ibu]'></div>
  </div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Tahun Masuk</label></div>
  <div class='col-sm-10'>";
           $get_thn=substr("$r[th_masuk]",0,4);
          combothn(1950,$thn_sekarang,'th_masuk',$get_thn);
          echo "
           *) Harus Angka</div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Email</label></div>
  <div class='col-sm-5'>
  <input class='form-control' required='required' id='field-1' placeholder='Placeholder' type='text' name='email' size=80 value='$r[email]'></div></div>
          ";?>
          <div class="form-group">
                  <div class='col-sm-2'> <label>No HP</label></div>
                  <div class='col-sm-5'>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input class="form-control" type="text" name='no_telp' value=<?php echo $r['no_telp']?> data-inputmask='"mask": "+62-###-####-####"' data-mask>
                    </div>
                  </div><!-- /.input group -->
                  </div>


          <?php 
          echo
         "
          <div class='form-group'>
          <div class='col-sm-2'><labelFoto</label></div>
  <div class='col-sm-5'> ";
            if ($r[foto]!=''){
              echo "<div class='wdgt-row'><img src='foto_siswa/medium_$r[foto]'></div>";
          }echo "</div></div>
          <div class='form-group'>
          <div class='col-sm-2'><label>Ganti Foto</label></div>
  <div class='col-sm-5'><span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
        
                                           <br>**) Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px<br>
                                                ***) Apabila foto tidak diganti, dikosongkan saja</div></div>";   

    echo "<div class='form-group'>
          <div class='col-sm-2'><label>Jabatan</label></div>
  <div class='col-sm-5'>
  <input type=text  class='form-control' required='required' id='field-1' placeholder='Placeholder' name='jabatan' size=70 value='$r[jabatan]' readonly='readonly'></div></div>
          <div class='form-group'>
          <div class='col-sm-2'></div>
  <div class='col-sm-5'><input type=submit class='btn btn-success' value='Update'>
                            <input type=button class='btn btn-primary' value='Batal'
                            onclick=self.history.back()>
                            </div></div>
          </table></form></div></section>";
    }
    break;

    
 case "detailsiswa":
    if ($_SESSION[leveluser]=='admin'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);
       
       echo "<div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-4'>
              <div class='box box-warning'>
                <div class='box-body box-profile'>
                 <center> <img class='profile-user-img img-responsive img-rounded' src='../foto_siswa/medium_$siswa[foto]' alt='User profile picture'></center>
                  <h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$siswa[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$siswa[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tanggal Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$siswa[agama]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$siswa[email]' class='pull-right'>$siswa[email]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Kelas</b> <a href='?module=kelas&act=detailkelas&id=$siswa[id_kelas]' class='pull-right'>$kelas[nama]</a>
                    </li>
                  </ul>

                  <a href='#' class='btn btn-warning btn-block'><b>Follow</b></a>
                </div>
              </div>
            </div>";?>

            <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NIS</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nis'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($siswa['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ayah</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ayah'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ibu'] ?> readonly=''>
                      </div>
                    </div>
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tahun Masuk</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['th_masuk'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['no_telp'] ?> readonly=''>
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
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $siswa['alamat'] ?></p>
                </div>
              </div>
              </div>
            </div></div>
            <?php 
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

       echo " <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-3'>
              <div class='box box-info'>
                <div class='box-body box-profile'>
                  <img class='profile-user-img img-responsive img-rounded' src='../foto_siswa/medium_$siswa[foto]' alt='User profile picture'>
                  <h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$siswa[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$siswa[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tanggal Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$siswa[agama]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$siswa[email]' class='pull-right'>$siswa[email]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Kelas</b> <a href='?module=kelas&act=detailkelas&id=$siswa[id_kelas]' class='pull-right'>$kelas[nama]</a>
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
                      <label for="inputEmail3" class="col-sm-2 control-label">NIS</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nis'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($siswa['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ayah</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ayah'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ibu'] ?> readonly=''>
                      </div>
                    </div>
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tahun Masuk</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['th_masuk'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['no_telp'] ?> readonly=''>
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
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $siswa['alamat'] ?></p>
                </div>
              </div>
              </div>
            </div></div>
            <?php
    }
    elseif ($_SESSION[leveluser]=='siswa'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

      echo" <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-3'>
              <div class='box box-info'>
                <div class='box-body box-profile'>
                  <img class='profile-user-img img-responsive img-rounded' src='foto_siswa/medium_$siswa[foto]' alt='User profile picture'>
                  <h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$siswa[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$siswa[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tgl Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$siswa[agama]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$siswa[email]' class='pull-right'>$siswa[email]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Kelas</b> <a href='?module=kelas&act=detailkelas&id=$siswa[id_kelas]' class='pull-right'>$kelas[nama]</a>
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
                      <label for="inputEmail3" class="col-sm-2 control-label">NIS</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nis'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($siswa['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ayah</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ayah'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ibu'] ?> readonly=''>
                      </div>
                    </div>
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tahun Masuk</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['th_masuk'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['no_telp'] ?> readonly=''>
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
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $siswa['alamat'] ?></p>
                </div>
              </div>
              </div>
            </div></div>


            <?php
    }
    break;

case "detailprofilsiswa":
    if ($_SESSION[leveluser]=='siswa'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

echo "<div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <div class='col-md-4'>
              <div class='box box-info'>
                <div class='box-body box-profile'>
                  <img class='profile-user-img img-responsive img-rounded' src='foto_siswa/medium_$siswa[foto]' alt='User profile picture'>
                  <h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$siswa[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$siswa[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tgl Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$siswa[agama]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$siswa[email]' class='pull-right'>$siswa[email]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Kelas</b> <a href='?module=kelas&act=detailkelas&id=$siswa[id_kelas]' class='pull-right'>$kelas[nama]</a>
                    </li>
                  </ul>
                  <a href='#' class='btn btn-primary btn-block'><b>Follow</b></a>
                </div>
              </div>
            </div>";?>
            <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NIS</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nis'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($siswa['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ayah</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ayah'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['nama_ibu'] ?> readonly=''>
                      </div>
                    </div>
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tahun Masuk</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['th_masuk'] ?> readonly=''>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $siswa['no_telp'] ?> readonly=''>
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
                   <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $siswa['alamat'] ?></p>
                 </div>
              </div>
               <div class='box box-info'>
                   <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Profil</h3>
                     </div>
                   <div class='box-body'>
                    <?php echo "
     <p><input type=button class='btn btn-warning' value='Edit Profil' onclick=\"window.location.href='?module=siswa&act=editsiswa&id=$siswa[id_siswa]';\"></p>"; ?>
                 </div>
              </div>
              </div>
            </div></div>
 <?php  
     }
    break;

case "detailaccount":
    if ($_SESSION[leveluser]=='siswa'){
        $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
        $siswa=mysql_fetch_array($detail);
        echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Detail Account
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
         

        <form method=POST action=$aksi_siswa?module=siswa&act=update_account_siswa class='form-horizontal form-groups-bordered'>";
        echo"
        
        <div class='form-group'>
        <div class='col-sm-2'>Username</div>
        <div class='col-sm-6'><input type=text name='username' size='40' class='form-control' required='required' id='field-1' placeholder='Placeholder'></div>
        </div>
        <div class='form-group'><div class='col-sm-2'>Password</div>
        <div class='col-sm-6'><input type=password name='password' size='40' class='form-control' required='required' id='field-1' placeholder='Placeholder'></div></div>
        <div class='form-group'><div class='col-sm-2'></div>
        <div class='col-sm-6'>
        *) Apabila Username tidak diubah di kosongkan saja.<br/>
        **) Apabila Password tidak diubah di kosongkan saja.</br/>
        <input type=submit class='btn btn-success' value='Update'></div>
        </form></div></section>";
    }
    break;
}
}
?>
