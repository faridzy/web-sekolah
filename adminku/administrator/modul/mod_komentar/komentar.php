<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_komentar/aksi_komentar.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <br/>
                  
                        <table id='example1' class='table table-bordered table-striped'>
					
                            <thead>
							 <tr>
                                    
									  <th>No</th>
                                    <th>Nama</th>
                                    <th>Waktu</th>
                                    <th>Web</th>
                                
								
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody>"; 
    $tampil=mysql_query("SELECT * FROM komentar ORDER BY nomor DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "
	   <td>$no</td>
             <td>$r[oleh]</td>
			       <td>$r[waktu]</td>
              <td>$r[web]</td>
		
             <td>
	               <a href=$aksi?module=komentar&act=hapus&id=$r[nomor]><i style='cursor:pointer;color:red' class='fa fa-times-circle'></i></a>
             </td></tr>";
      $no++;
    }
    echo "</tbody>
                        </table>
                   </div></div>";
    break;
  
 
}
}
?>
