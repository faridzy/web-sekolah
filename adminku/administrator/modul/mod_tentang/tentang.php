<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_tentang/aksi_tentang.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
                       <table class='table table-bordered table-striped table-condensed cf'>
                            <thead>
							 <tr>                 
									  <th>No</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody> ";
    $tampil = mysql_query("SELECT * FROM tentang ORDER BY id_tentang DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo " <tr>
	               <td>$no</td>
                <td>$r[judul]</td>
		            <td><a href=?module=tentang&act=edittentang&id=$r[id_tentang]><i style='cursor:pointer;' class='fa fa-edit'></i></a> 
		                </td>
		        </tr>";
      $no++;
    }
    echo "</tbody>
                  </table>
                  </div>
                  </div>
                  ";
 
    break;
  case "tambahtentang":
    echo "
  <div class='box box-warning'>
        <div class='box-header with-border'>
        <form method=POST action='$aksi?module=tentang&act=input' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'> 
                     
                      <div class='col-md-12 col-xs-12'> 
                       <div class='form-group'>
          <label>
          Judul</label>
<input type='text' name='judul' class='form-control' id='field-1' required='required' placeholder='Placeholder'/>
                       
                        </div>					 
						
					
					 <div class='form-group'>
          <label>
          Deskripsi</label>
                             <textarea class='form-control ckeditor' id='post' name='deskripsi'></textarea>
                           
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
         
          <div class='col-sm-5'>
			<input type='submit' class='btn btn-success' value='Simpan'>
       <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
      </div></div>
		  </form>
		</div>
</div>";
     break;    
  case "edittentang":
    $edit = mysql_query("SELECT * FROM tentang WHERE id_tentang='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <form method=POST enctype='multipart/form-data' class='form-horizontal form-groups-bordered' action=$aksi?module=tentang&act=update>
           <div class='col-md-12 col-xs-12'> 
					<input type=hidden name=id value=$r[id_tentang]>                     
                    <div class='form-group'>
          <label>
              Judul</label>
                            
                            <input type='text' name='judul' value='$r[judul]' class='form-control' id='field-1' required='required' placeholder='Placeholder'  /></div>				
					 <div class='form-group'>
          <label>Deskripsi</label>
                            
                             <textarea  name='deskripsi' class='form-control ckeditor' id='post'> $r[deskripsi]</textarea></div>
										
					<div class='form-group'>
          <div class='col-sm-2'>File Gambar
          </div><div class='col-sm-5'>
          <img src='../foto_galeri/medium_$r[gambar]'></div>
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
          <div class='col-sm-2'></div>
       
			<input type='submit' class='btn btn-success' value='Simpan'>
       <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
       </div>
		  </form>
		</div>
</div>";
    break;  
}
}
?>
