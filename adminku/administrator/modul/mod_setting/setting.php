<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_setting/aksi_setting.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
    
        
                       <table  id='example1' class='table table-bordered table-striped'>
                            <thead>
							 <tr>                 
									  <th>No</th>
                                    <th>Keyword</th>
                                    <th>Deskrpisi</th>
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody> ";
    $tampil = mysql_query("SELECT * FROM setting ORDER BY id_setting DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo " <tr>
	               <td>$no</td>
                <td>$r[keyword]</td>
                <td>$r[deskripsi]</td>
		            <td><a href=?module=setting&act=editsetting&id=$r[id_setting]><i style='cursor:pointer;' class='fa fa-edit'></i></a> | 
		                <a href='$aksi?module=setting&act=hapus&id=$r[id_setting]&namafile=$r[logo]'><i style='cursor:pointer;color:red' class='fa fa-times-circle'></i></a></td>
		        </tr>";
      $no++;
    }
    echo "</tbody>
                  </table>
                  </div>
                  </div>
                 ";
 
    break;
  
  case "editsetting":
    $edit = mysql_query("SELECT * FROM setting WHERE id_setting='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "  <div class='box box-warning'>
        <div class='box-header with-border'>
    
          <form method=POST enctype='multipart/form-data' class='form-horizontal form-groups-bordered' action=$aksi?module=setting&act=update>
           <div class='col-md-12 col-xs-12'> 
					<input type=hidden name=id value=$r[id_setting]>                     
                   


<div class='col-md-12 col-xs-12'> 
                      <div class='form-group'>
          <label>
          Keyword</label>
          <input type='text' name='keyword' class='form-control' id='field-1' required='required' value='$r[keyword]' placeholder='Placeholder'/>
                      
                        </div>           
                
           <div class='form-group'>
          <label>
          Deskripsi</label>
                            <textarea class='form-control ckeditor' id='post' name='deskripsi' value='$r[deskripsi]'>
                            $r[deskripsi]
                            </textarea>
                           
                    </div> 
                    
                     <div class='form-group'>
          <label>
          Twitter</label>
<input type='text' name='twitter' class='form-control' id='field-1' required='required' value='$r[twitter]' placeholder='Placeholder'/>
                       
                        </div>  
                         <div class='form-group'>
          <label>
          Facebook</label>
<input type='text' name='facebook' class='form-control' id='field-1' required='required' value='$r[facebook]' placeholder='Placeholder'/>
                       
                        </div>    
                         <div class='form-group'>
          <label>
          Google+</label>
<input type='text' name='google' class='form-control' id='field-1' required='required' value='$r[google]' placeholder='Placeholder'/>
                       
                        </div>    
                         <div class='form-group'>
          <label>
          Whatsapp</label>
<input type='text' name='whatshap' class='form-control' id='field-1' required='required' value='$r[whatshap]' placeholder='Placeholder'/>
                       
                        </div>
                         <div class='form-group'>
          <label>
          Linkedin</label>
<input type='text' name='linkedin' class='form-control' id='field-1' required='required' value='$r[linkedin]' placeholder='Placeholder'/>
                       
                        </div> 
                         <div class='form-group'>
          <label>
          Paging News</label>
<input type='number' name='paging_news' class='form-control' id='field-1' required='required' value='$r[paging_news]' placeholder='Placeholder'/>
                       
                        </div>    
                         <div class='form-group'>
          <label>
          Paging Galeri</label>
<input type='number' name='paging_galeri' class='form-control' id='field-1' required='required' value='$r[paging_galeri]' placeholder='Placeholder'/>
                       
                        </div>    
                         <div class='form-group'>
          <label>
          Paging Prestasi</label>
<input type='number' name='paging_prestasi' class='form-control' id='field-1' required='required' value='$r[paging_prestasi]' placeholder='Placeholder'/>
                       
                        </div>    
                         <div class='form-group'>
          <label>
          Phone</label>
<input type='text' name='phone' class='form-control' id='field-1' required='required' value='$r[phone]' placeholder='Placeholder'/>
                       
                        </div>    
                         <div class='form-group'>
          <label>
          Email</label>
<input type='text' name='email' class='form-control' id='field-1' required='required' value='$r[email]' placeholder='Placeholder'/>
                       
                        </div> 
                        <div class='form-group'>
          <label>
          Alamat</label>
                            <textarea class='form-control ckeditor' id='post' name='alamat' value='$r[alamat]'> $r[alamat]</textarea>
                           
                    </div>             





					<div class='form-group'>
          <div class='col-sm-2'>FIle Logo
          </div><div class='col-sm-5'>
          <img src='../setting_web/$r[logo]'></div>
					 </div>				 
					 <div class='form-group'>
          <div class='col-sm-2'>Logo</div>
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
