
<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'>
          <p><button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalEdit'>
                        Tambah Modul
                    </button> </p>
                    <br/>
          <div class='alert alert-info'>
          Apabila Publish = Y, maka Modul ditampilkan di halaman pengunjung.<br>
          Apabila Aktif = Y, maka Modul ditampilkan di halaman administrator pada daftar menu yang berada di bagian kiri.</div>

          <br><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Nama Modul</th><th>Link</th><th>Publish</th><th>Aktif</th><th>Status</th><th>Aksi</th></tr></thead>";
    $tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$r[urutan]</td>
            <td>$r[nama_modul]</td>
            <td><a href=$r[link]>$r[link]</a></td>
            <td align=center>$r[publish]</td>
            <td align=center>$r[aktif]</td>";
            if ($r[status]=='admin'){
                echo "<td>Administrator</td>";
            }else{
                echo "<td>Teacher</td>";
            }
            echo"<td><a href='?module=modul&act=editmodul&id=$r[id_modul]'><i style='cursor:pointer;' class='fa fa-edit'></i></a> |
                <a href=javascript:confirmdelete('$aksi?module=modul&act=hapus&id=$r[id_modul]')><i style='cursor:pointer;color:red' class='fa fa-times-circle'></i>
</a>
            </td></tr>";
    }
    echo "</table></div></div></div>
    <div class='modal fade' id='modalEdit'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <h4 class='modal-title'>Tambah Modul</h4>
                  </div>
                  <div class='modal-body'>
                    <!-- Start form -->
                   <form class='form-horizontal' role='for' style='width:80%'' method='post' action='$aksi?module=modul&act=input'>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Judul</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>
                       <input type=text  class='form-control' id='field-1' required='required' placeholder='Placeholder' name='nama_modul'>
                        </div>
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Link</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='input-group-addon'>
                            <i class='fa fa-laptop'></i>
                          </div>

<input type=text  class='form-control' id='field-1' required='required' placeholder='Placeholder' name='link' size=30>                         
                        </div>
                        </div>
                      </div>
                       <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Publish</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                          <div class='col-sm-1'></div>

<label><input type=radio name='publish' value='Y' checked>Y </label>
                                                    <label><input type=radio name='publish' value='N'> N</label>
                         
                        </div>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Aktif</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                         <div class='col-sm-1'></div>

  <label><input type=radio name='aktif' value='Y' checked>Y</label>
                                                    <label><input type=radio name='aktif' value='N'> N</label>
                         
                        </div>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-sm-2' for='IP'>Status</label>
                        <div class='col-sm-10'>
                        <div class='input-group'>
                        <div class='col-sm-1'></div>
                          

                                                   <input type=radio name='status' value='admin' checked>Administrator</label>
                                                    <label><input type=radio name='status' value='pengajar'>Pengajar</label>
                         
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
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
        echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

  
  case "editmodul":
    if ($_SESSION[leveluser]=='admin'){
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form class='form-horizontal form-groups-bordered' method='POST' action='$aksi?module=modul&act=update'>
          <input type=hidden name=id value='$r[id_modul]'>
         
 <div class='form-group'>
          <div class='col-sm-2'>
          <label>Nama Modul</label></div>    
           <div class='col-sm-5'>
           <input type=text name='nama_modul' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$r[nama_modul]'></div></div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Link</label></div>
          <div class='col-sm-5'>
      <input type=text name='link'  class='form-control' id='field-1' required='required' placeholder='Placeholder' size=30 value='$r[link]'></div></div>";
    if ($r[publish]=='Y'){
      echo " <div class='form-group'>
          <div class='col-sm-2'><label>Publish</label></div> 
                <div class='col-sm-5'> <label><input type=radio name='publish' value='Y' checked>Y</label>
                                                        <label><input type=radio name='publish' value='N'> N</label>
                                                 </div></div>";
    }
    else{
      echo " <div class='form-group'>
          <div class='col-sm-2'><label>Publish</label></div>     <div class='col-sm-5'> <label><input type=radio name='publish' value='Y'>Y</label>
                                                        <label><input type=radio name='publish' value='N' checked> N</label>
                                                 </div></div>";
    }
    if ($r[aktif]=='Y'){
      echo " <div class='form-group'>
          <div class='col-sm-2'><label>Aktif</label></div>
                   <div class='col-sm-5'><lebel><input type=radio name='aktif' value='Y' checked>Y</label>
                                                        <label><input type=radio name='aktif' value='N'> N</label>
                                                 </div></div>";
    }
    else{
       echo " <div class='form-group'>
          <div class='col-sm-2'>
          <label>Aktif</label></div>        <div class='col-sm-5'> <lebel><input type=radio name='aktif' value='Y'>Y</label>
                                                        <label><input type=radio name='aktif' value='N' checked> N</label>
                                                 </div></div>";
    }
    if ($r[status]=='pengajar'){
      echo " <div class='form-group'>
          <div class='col-sm-2'>
          <label>Status</label></div>       <div class='col-sm-5'>  <label><input type=radio name='status' value='pengajar' checked>Pengajar</label>
                                                        <label><input type=radio name='status' value='admin'> Administrator</label>
                                                 </div></div>";
    }
    else{
      echo " <div class='form-group'>
          <div class='col-sm-2'>
          <label>Status</label></div>       <div class='col-sm-5'><label><input type=radio name='status' value='pengajar'>Pengajar</label>
                                                        <label><input type=radio name='status' value='admin' checked>Administrator</label>
                                                 </div></div>";
    }
    echo " <div class='form-group'>
          <div class='col-sm-2'>
          <label>Order</label></div>         <div class='col-sm-5'><input type=text name='urutan' size=1 value='$r[urutan]'></div></div>
          
        <div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></div></div>";
    }else{
      
        echo "<div class='alert alert-info'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;  
}
}
?>
