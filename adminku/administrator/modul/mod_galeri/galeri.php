<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_galeri/aksi_galeri.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
         <p align='left'><a href='javascript:;' onclick=\"jQuery('#modal-6').modal('show', {backdrop: 'static'});\" class='btn btn-warning'>Tambah Kategori</a></p>
                       <table   id='example1' class='table table-bordered table-striped'>					
                            <thead>
							 <tr>                                   
									  <th>No</th>
                                    <th>Nama Foto</th>
                                    <th>Gambar</th>                                								
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody> ";
    $tampil = mysql_query("SELECT * FROM galeri_foto ORDER BY id_galerifoto DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo " <tr>
	  <td>$no</td>
                <td>$r[nama_foto]</td>
                <td>$r[gambar]</td>
		            <td><a href=?module=galeri&act=editgaleri&id=$r[id_galerifoto]><i style='cursor:pointer;' class='fa fa-edit'></i>
</a> | 
		                <a href='$aksi?module=galeri&act=hapus&id=$r[id_galerifoto]&namafile=$r[gambar]'><i style='cursor:pointer;color:red' class='fa fa-times-circle'></i></a></td>
		        </tr>";
      $no++;
    }
    echo "</tbody>
                        </table>
                    </div>
                </div> 




                   <div class='modal fade' id='modal-6'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
          <h4 class='modal-title'>Tambah Galeri Foto</h4>
        </div>
        
        <div class='modal-body'>

    <form method=POST action='$aksi?module=galeri&act=input' enctype='multipart/form-data'>

      <div class='row'>
            <div class='col-md-12'>
              
              <div class='form-group'>
                <label for='field-4' class='control-label'>Nama Foto</label>
                
                <input type='text' name='nama_foto' class='form-control' required='required' id='field-4' placeholder='Nama Kategori'>
              </div>  
              
            </div>
            <div class='col-md-12'>
              
              <div class='form-group'>
                <label for='field-4' class='control-label'>Gambar</label>
                
                <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
              <br>
              *) Apabila gambar tidak diubah, dikosongkan saja.
<br/>
               *) Harus Berformat .jpeg/jpg
              </div>  
              
            </div>
          </div> 
      </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
          <button type='submit' class='btn btn-info'>Save changes</button>
        </div>
         </form>
      </div>
    </div>
  </div>                               
            ";



    break;
  case "editgaleri":
    $edit = mysql_query("SELECT * FROM galeri_foto WHERE id_galerifoto='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "
    <div class='col-sm-8'>
    <div class='box box-warning'>
        <div class='box-header with-border'>

          <form method=POST enctype='multipart/form-data'class='form-horizontal form-groups-bordered'  action=$aksi?module=galeri&act=update>  
					<input type=hidden name=id value=$r[id_galerifoto]>
                      <div class='form-group'>
          <div class='col-sm-2'>Nama Foto</div>
                            <div class='col-sm-5'><input type='text' class='form-control' id='field-1' required='required' placeholder='Placeholder' name='nama_foto' value='$r[nama_foto]'/></div>
                        </div>
					<div class='form-group'>
          <div class='col-sm-2'>Foto</div><div class='col-sm-5'>
          <img src='../foto_galeri/small_$r[gambar]'>
          </div>
					 </div>
					              <div class='form-group'>
          <div class='col-sm-2'>Gambar</div>
                            <div class='col-sm-5'> <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
							<br>
							*) Apabila gambar tidak diubah, dikosongkan saja.
<br/>
  *) Harus Berformat .jpeg/jpg
							</div>
                    </div>
			<input type='submit' class='btn btn-success' value='Simpan'>
		  </form>
		</div>
</div></div>";
    break;  
}
}
?>
