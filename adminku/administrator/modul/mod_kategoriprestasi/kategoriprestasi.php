<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_kategoriprestasi/aksi_kategoriprestasi.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
         <p><a href='javascript:;' onclick=\"jQuery('#modal-6').modal('show', {backdrop: 'static',value:'$id'});\" class='btn btn-warning'>Tambah Kategori</a></p>
 
               <br/>
                  
                        <table class='table table-bordered table-striped table-condensed cf'>
					
                            <thead>
							 <tr>
                                    
									  <th>No</th>
                                    <th>Nama Kategori Prestasi</th>
                                    <th>Kategori SEO</th>
                                
								
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody>"; 
    $tampil=mysql_query("SELECT * FROM kategori_prestasi ORDER BY id_kategoriprestasi DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "
	   <td>$no</td>
             <td>$r[nama_katprestasi]</td>
			       <td>$r[kat_prestasiseo]</td>
		
             <td><a href=?module=kategoriprestasi&act=editkategori&id=$r[id_kategoriprestasi]><i style='cursor:pointer;' class='fa fa-edit'></i></a> | 
                 <a href=$aksi?module=kategoriprestasi&act=hapus&id=$r[id_kategoriprestasi]> <i style='cursor:pointer;color:red' class='fa fa-times-circle'></i></a>
             </td></tr>";
      $no++;
    }
    echo "</tbody>
                        </table>
                   </div></div>



                   </div></div>

                   <div class='modal fade' id='modal-6'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
          <h4 class='modal-title'>Tambah Kategori Prestasi</h4>
        </div>
        
        <div class='modal-body'>

    <form method=POST action='$aksi?module=kategoriprestasi&act=input' enctype='multipart/form-data'>

      <div class='row'>
            <div class='col-md-12'>
              
              <div class='form-group'>
                <label for='field-4' class='control-label'>Nama Kategori Prestasi</label>
                
                <input type='text' name='nama_katprestasi' class='form-control' required='required' id='field-4' placeholder='Nama Kategori'>
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
  </div>";
   break;

  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori_prestasi WHERE id_kategoriprestasi='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<div class='col-sm-6'>
    <div class='box box-warning'>
        <div class='box-header with-border'>
       
    <form method=POST enctype='multipart/form-data' action=$aksi?module=kategoriprestasia&act=update>
          
					<input type=hidden name=id value=$r[id_kategoriprestasi]>
                      <div class='form-group'><div class='col-sm-2'>
          <label>Nama Kategori</label></div><div class='col-sm-5'> 
                             <input type='text' name='nama_katprestasi' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$r[nama_katprestasi]'/></div>
                        </div> 
             
			<input type='submit' class='btn btn-success' value='Simpan'>
		  </form>
		</div>
</div>
</div>";
    break;  
}
}
?>
