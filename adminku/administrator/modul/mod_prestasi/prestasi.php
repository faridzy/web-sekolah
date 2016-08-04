<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_prestasi/aksi_prestasi.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
    
          <p align='left'><a href='?module=prestasi&act=tambahprestasi' role='button' class='btn btn-warning'>Tambah Prestasi</a></p>
                       <table  id='example1' class='table table-bordered table-striped'>
                            <thead>
							 <tr>                 
									  <th>No</th>
                                    <th>Nama Prestasi</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody> ";
    $tampil = mysql_query("SELECT * FROM prestasi ORDER BY id_prestasi DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo " <tr>
	               <td>$no</td>
                <td>$r[nama_prestasi]</td>
                <td>$r[tgl_masuk]</td>
		            <td><a href=?module=prestasi&act=editprestasi&id=$r[id_prestasi]><i style='cursor:pointer;' class='fa fa-edit'></i>
</a> | 
		                <a href='$aksi?module=prestasi&act=hapus&id=$r[id_prestasi]&namafile=$r[gambar]'><i style='cursor:pointer;color:red' class='fa fa-times-circle'></i></a></td>
		        </tr>";
      $no++;
    }
    echo "</tbody>
                  </table>
                  </div>
                  </div>
                 ";
 
    break;
  case "tambahprestasi":
    echo "

     <div class='box box-warning'>
        <div class='box-header with-border'>

    
        <form method=POST action='$aksi?module=prestasi&act=input' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
        <div class='col-md-12 col-xs-12'> 
                      <div class='form-group'>
          <label>
          Nama Prestasi</label>
          <input type='text' name='nama_prestasi' class='form-control' id='field-1' required='required' placeholder='Placeholder'/>
                      
                        </div>					 
					  <div class='form-group'>
          <label>Kategori Prestasi</label>
                           
							<select name='id_kategoriprestasi' class='form-control'>
								  <option value=0 selected>- Pilih Kategori -</option>";
										$tampil=mysql_query("SELECT * FROM kategori_prestasi ORDER BY nama_katprestasi");
										while($r=mysql_fetch_array($tampil)){
										  echo "<option value=$r[id_kategoriprestasi]>$r[nama_katprestasi]</option>";
										}                               
                       echo"</select>
							</div>
               					
					 <div class='form-group'>
          <label>
                            Tanggal Masuk</label>
                          <input type='text' class='form-control date-picker' name='tgl_masuk' id='id-date-picker-1'  data-date-format='yyyy-mm-dd'/>
                            
                    </div>					
					 <div class='form-group'>
          <label>
          Deskripsi</label>
                            <textarea class='form-control ckeditor' id='post' name='deskripsi'></textarea>
                           
                    </div>
                  
                      <div class='form-group'>
          <label>
          Keyword</label>
          <input type='text' name='keyword' class='form-control' id='field-1' required='required' placeholder='Placeholder'/>
                      
                        </div>      			
					 <div class='form-group'>
          <div class='col-sm-2'>
          Gambar</div>
                            <div class='col-sm-5'> <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
							<br>
							*) Apabila gambar tidak diubah, dikosongkan saja.
							</div>
                    </div>
          <div class='form-group'>
          <label>
          Nama Pembuat</label>
<input type='text' name='pembuat' value='$_SESSION[namalengkap]' readonly='readonly' class='form-control' id='field-1' required='required' placeholder='Placeholder'/>
                       
                        </div>
                       		
							 <div class='form-group'>
        
          <div class='col-sm-5'>
			<input type='submit' class='btn btn-success' value='Simpan'>
       <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
      </div>
      </div>
      </form>
      </div></div>
	";
     break;    
  case "editprestasi":
    $edit = mysql_query("SELECT * FROM prestasi WHERE id_prestasi='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "  <div class='box box-warning'>
        <div class='box-header with-border'>
    
          <form method=POST enctype='multipart/form-data' class='form-horizontal form-groups-bordered' action=$aksi?module=prestasi&act=update>
           <div class='col-md-12 col-xs-12'> 
					<input type=hidden name=id value=$r[id_prestasi]>                     
                    <div class='form-group'>
          <label>
              Nama Prestasi</label>
                           
        <input type='text' name='nama_prestasi' value='$r[nama_prestasi]' class='form-control' id='field-1' required='required' placeholder='Placeholder'  /></div>
                      						 
					   <div class='form-group'>
          <label>Kategori Prestasi</label>
                           
							<select name='id_kategoriprestasi' class='form-control'>";
								  $tampil=mysql_query("SELECT * FROM kategori_prestasi ORDER BY nama_katprestasi");
								  if ($r[id_kat_sewa]==0){
									echo "<option value=0 selected>- Pilih Kategori -</option>";
								  }   								  
                                  while($w=mysql_fetch_array($tampil)){
									if ($r[id_kategori]==$w[id_kategori]){
									  echo "<option value=$w[id_kategoriprestasi] selected>$w[nama_katprestasi]</option>";
									}
									else{
									  echo "<option value=$w[id_kategoriprestasi]>$w[nama_katprestasi]</option>";
									}
								  }                                 
                       echo"</select>
                        </div>						
					 <div class='form-group'>
          <label>Tanggal Masuk</label>
                            <input type='text' class='form-control date-picker' id='id-date-picker-1'  data-date-format='yyyy-mm-dd' name='tgl_masuk' value='$r[tgl_masuk]' /></div>
                  					
					 <div class='form-group'>
          <label>Deskripsi</label>
                            
                             <textarea  name='deskripsi' class='form-control ckeditor' id='post'> $r[deskripsi]</textarea></div>
							 				    <div class='form-group'>
          <label>
              Keyword</label>
                           
        <input type='text' name='keyword' value='$r[keyword]' class='form-control' id='field-1' required='required' placeholder='Placeholder'  /></div>
					<div class='form-group'>
          <div class='col-sm-2'>FIle Gambar
          </div><div class='col-sm-5'>
          <img src='../foto_berita/small_$r[gambar]'></div>
					 </div>				 
					 <div class='form-group'>
          <div class='col-sm-2'>Gambar</div>
                            <div class='col-sm-5'>
                             <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
							<br>
							*) Apabila gambar tidak diubah, dikosongkan saja.
							</div>
                    </div>
          <div class='form-group'>
          <label>
          Nama Pembuat</label>
<input type='text' name='pembuat' value='$_SESSION[namalengkap]' readonly='readonly' class='form-control' id='field-1' required='required' placeholder='Placeholder'/>
                     </div>		
							<div class='form-group'>
           <div class='col-sm-5'>       
			<input type='submit' class='btn btn-success' value='Simpan'>
       <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
       </div>
       </div>
		  </form>
		</div>
</div>";
    break;  
}
}
?>
