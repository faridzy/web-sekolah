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
   echo "if (document.form_topik.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option mata pelajaran untuk masing-masing kelas
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
 $query = "SELECT * FROM kelas";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkelas = $data['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_topik.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option mata pelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM mata_pelajaran WHERE id_kelas = '$idkelas' AND id_pengajar ='$_SESSION[idpengajar]'";
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
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
   
   echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_quiz/aksi_quiz.php";

switch($_GET[act]){
  // Tampil topik quiz
  default:
      
      if ($_SESSION[leveluser]=='admin'){    
        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

        
          <input type=button class='btn btn-warning' value='Tambah Topik' onclick=\"window.location.href='?module=quiz&act=tambahtopikquiz';\">";

        echo "<div class='adv-table'>
        <br><br><table  id='example1' class='table table-bordered table-striped'><thead>
          
<tr><th>no</th><th>judul</th><th>kelas</th><th>pelajaran</th><th>tgl buat</th><th>pembuat</th><th>waktu</th><th>Info</th><th>terbit</th><th>aksi</th></tr>
          </thead>";
        
        $tampil_topik = mysql_query("SELECT * FROM topik_quiz ORDER BY id_kelas");
        
    $no=1;
    while ($r=mysql_fetch_array($tampil_topik)){
      $wpengerjaan = $r[waktu_pengerjaan] / 60;
      $tgl_buat   = tgl_indo($r[tgl_buat]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-info'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             $p=mysql_fetch_array($pelajaran);
             echo "<td><a href=?module=matapelajaran&act=detailpelajaran&id=$r[id_matapelajaran] title='Detail pelajaran' class='btn btn-warning'>$p[nama]</a></td>";
             }else{
                 echo"<td></td>";
             }
             echo"<td>$tgl_buat</td>";
             $pelajaran2 = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $p2=mysql_fetch_array($pelajaran2);
             $pembuat = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$p2[id_pengajar]'");
             $cek_pembuat = mysql_num_rows($pembuat);
             if (!empty($cek_pembuat)){
                 $data_pembuat = mysql_fetch_array($pembuat);
                 echo "<td><a href=?module=admin&act=detailpengajar&id=$data_pembuat[id_pengajar] title='Detail pengajar' class='btn btn-danger'>$data_pembuat[nama_lengkap]</a></td>";
             }else{                 
                 echo"<td>$r[pembuat]</td>";
             }
             echo"<td>$wpengerjaan menit</td>
             <td>$r[info]</td>
             <td><p align='center'>$r[terbit]</p></td>
             <td><p><a href='?module=quiz&act=edittopikquiz&id=$r[id_tq]' class='btn btn-default btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> | 
                 <a href=javascript:confirmdelete('$aksi?module=quiz&act=hapustopikquiz&id=$r[id_tq]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></p>
                 <p><a href=?module=buatquiz&act=buatquiz&id=$r[id_tq] class='btn btn-success'>Buat Quiz</a>
                 <a href=?module=daftarquiz&act=daftarquiz&id=$r[id_tq] class='btn btn-warning'>Daftar Quiz</a></p>
                 <a href=?module=quiz&act=daftarsiswayangtelahmengerjakan&id=$r[id_tq] class='btn btn-info'>Daftar Peserta & Koreksi</a></td></tr>";
      $no++;
    }
    echo "</table></div></div></div></div>";
    
    }    
    elseif ($_SESSION[leveluser]=='pengajar'){
    $tampil_topik = mysql_query("SELECT * FROM topik_quiz WHERE pembuat = '$_SESSION[idpengajar]'");
        echo "
 <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Daftar Topik/Quiz
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
            <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalTambah'>
                        Tambah Topik
                    </button>
        
          ";
        echo "<br><br><table class='table table-bordered table-striped table-condensed cf'><thead>
          <tr><th>No</th><th>Judul</th><th>Kelas</th><th>Pelajaran</th><th>Tgl Buat</th><th>Waktu</th><th>Info</th><th>Terbit</th><th>Aksi</th></tr></thead>";
        
        
        $no=1;
        while ($r=mysql_fetch_array($tampil_topik)){
        $wpengerjaan = $r[waktu_pengerjaan] / 60;
        $tgl_buat   = tgl_indo($r[tgl_buat]);
        echo "<tr><td>$no</td>
             <td>$r[judul]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas' class='btn btn-warning'>$k[nama]</td>";
             }
             }else{
                 echo "<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
             echo "<td><a href=?module=matapelajaran&act=detailpelajaran&id=$r[id_matapelajaran] title='Detail pelajaran' class='btn btn-info'>$p[nama]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo "<td>$tgl_buat</td>
             <td>$wpengerjaan menit</td>
             <td>$r[info]</td>
             <td><p align='center'>$r[terbit]</p></td>
             <td><a href='?module=quiz&act=edittopikquiz&id=$r[id_tq]' class='btn btn-default btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> | 
                         <a href=javascript:confirmdelete('$aksi?module=quiz&act=hapustopikquiz&id=$r[id_tq]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a><br><br>
                 <input type=button class='btn btn-primary' value='Buat Quiz' onclick=\"window.location.href='?module=buatquiz&act=buatquiz&id=$r[id_tq]';\"></input><br>
                <input type=button class='btn btn-success' value='Daftar Quiz' onclick=\"window.location.href='?module=daftarquiz&act=daftarquiz&id=$r[id_tq]';\"></input><br>
                <input type=button class='btn btn-warning' value='Peserta & koreksi' onclick=\"window.location.href='?module=quiz&act=daftarsiswayangtelahmengerjakan&id=$r[id_tq]';\"></input></td></tr>";
      $no++;
    }
    echo "</table></div></section>

<div class='modal fade' id='modalTambah'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <h4 class='modal-title'>Tambah File Materi</h4>
                  </div>
                  <div class='modal-body'>
                    <!-- Start form -->

                     <form name='form_topik' method=POST action='$aksi?module=quiz&act=input_topikquiz' class='form-horizontal form-groups-bordered'>
    
    <div class='form-group'>
          <div class='col-sm-2'><label>Judul</label></div>  <div class='col-sm-5'> <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='judul' size='50'></div></div>
    
    <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>      
                <div class='col-sm-4'> <select name='id_kelas' onChange='showpel_pengajar()' class='form-control'>
                                          <option value=''>-pilih-</option>";
                                          $pilih= mysql_query("SELECT DISTINCT id_kelas FROM mata_pelajaran WHERE id_pengajar ='$_SESSION[idpengajar]'");
                                          while($row=mysql_fetch_array($pilih)){
                                          $cari_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$row[id_kelas]'");
                                          while ($k=mysql_fetch_array($cari_kelas)){
                                          echo"<option value='".$k[id_kelas]."'>".$k[nama]."</option>";
                                          }
                                          }
                                          echo"</select></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Pelajaran</label></div><div class='col-sm-4'> <div id='pelajaran'></div></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Lama pengerjaan</label></div>   <div class='col-sm-2'> <input type=text name='waktu'  class='form-control' id='field-1' required='required' placeholder='Placeholder'size='10'><small>Dalam Menit</small></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Info Quiz</label></div>           
         <div class='col-sm-7'> <textarea name='info' class='form-control' id='field-1' required='required' placeholder='Placeholder'></textarea></div></div>
    <div class='form-group'>
          <div class='col-sm-2'><label>Terbit</label></div>             <div class='col-sm-3'> <label><input type=radio name='terbit' value='Y'>Y</input></label>
                                           <label><input type=radio name='terbit' value='N'>N</input></label></div></div>
   

          <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <p><input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p></div></div>

         </form>
                   







                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>






    ";      
    }
    elseif ($_SESSION[leveluser]=='siswa'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_SESSION[idsiswa]'");
        $data_siswa = mysql_fetch_array($siswa);
        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_kelas = '$data_siswa[id_kelas]'");
        $cek_mapel = mysql_num_rows($mapel);        
        if (!empty($cek_mapel)){
            echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Tugas/Quiz
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
            <table class='table table-bordered table-striped table-condensed cf'>
            <thead><tr><th>No</th><th>Mata Pelajaran</th><th>Aksi</th></tr></thead>";
            $no=1;
            while ($t=mysql_fetch_array($mapel)){                
                echo "<tr><td>$no</td>
                        <td>$t[nama]</td>";                   
                        
                        echo"<td><input type=button class='btn btn-info' value='Lihat Tugas / Quiz'
                       onclick=\"window.location.href='?module=quiz&act=daftartopik&id=$t[id_matapelajaran]&id_kelas=$data_siswa[id_kelas]';\"></td></tr>";
            $no++;
            }
            echo"</table></div></section>";
        }else{
            echo "<script>window.alert('Belum ada mata pelajaran di kelas anda.');
                    window.location=(href='media.php?module=home')</script>";
        }
    }
    break;


case "daftarsiswayangtelahmengerjakan":
    if ($_SESSION[leveluser]=='admin'){
        $siswa_yangmengerjakan = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        $cek_siswa= mysql_num_rows($siswa_yangmengerjakan);

        if (!empty($cek_siswa)){
        echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 


       ";
        echo "<br><div class='alert alert-info'>
         Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
        Hanya jawaban soal Essay yang bisa di koreksi.<br>
        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan.</div>";

        $siswa_yangmengerjakan2 = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        echo "<br><table id='example3' class='table table-bordered table-striped'><thead>
          <tr><th>No</th><th>Nama</th><th>Kelas</th><th>Status</th><th>Nilai Pilihan Ganda</th><th>Nilai Esay</th><th>aksi</th></tr></thead>";
        
        $no=1;
        while ($t=mysql_fetch_array($siswa_yangmengerjakan2)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$t[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$s[id_kelas]'");
            $k = mysql_fetch_array($kelas);
            $nilai = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq='$_GET[id]' AND id_siswa ='$t[id_siswa]'");
            $n = mysql_fetch_array($nilai);
            $nilai2 = mysql_query("SELECT * FROM nilai WHERE id_tq='$_GET[id]' AND id_siswa = '$t[id_siswa]'");
            $n2 = mysql_fetch_array($nilai2);
            echo "<tr><td>$no</td>                      
                      <td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail siswa'>$s[nama_lengkap]</a></td>
                      <td>$k[nama]</td>";
                      if ($t[dikoreksi]=='B'){
                          echo "<td><b>belum</b>
                                    </td><td>$n2[persentase]</td> <td>  0</td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id] class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete Siswa</a> |
                          <a href=?module=quiz&act=koreksi&id=$t[id_tq]&id_siswa=$s[id_siswa] class='btn btn-default btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Koreksi Soal Esay</a></td>";
                      }else{
                          echo "<td><b>sudah di koreksi</b><td> $n2[persentase]</td>
                                                         <td> $n[nilai]</td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id] class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete Siswa</a> |
                          <a href=?module=quiz&act=editkoreksi&id=$t[id_tq]&id_siswa=$s[id_siswa] class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit Koreksi
</a></td></tr>";
                      }
                      
            $no++;
        }
        echo "</table>";
        echo "<br><input class='btn btn-primary' type=button value=Kembali onclick=\"window.location.href='?module=quiz';\"></div></div></div>";
        
        }else{
            echo "<script>window.alert('Belum ada siswa yang mengikuti ujian.');
                    window.location=(href='media_admin.php?module=quiz')</script>";
        }
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $siswa_yangmengerjakan = mysql_query("SELECT id_siswa FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        $cek_siswa = mysql_num_rows($siswa_yangmengerjakan);

        if (!empty($cek_siswa)){

        $soal_pilganda = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq='$_GET[id]'");
        $pilganda = mysql_num_rows($soal_pilganda);
        $soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_GET[id]'");
        $esay = mysql_num_rows($soal_esay);
        if (!empty($pilganda) AND !empty($esay)){
        echo "
        <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Siswa yang mengikuti Ujian
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

    ";
         echo "<div class='col-sm-6'> <div class='alert alert-info'>
        Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
        Hanya jawaban soal Essay yang bisa di koreksi.<br>
        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan</div></div>";

        $siswa_yangmengerjakan2 = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        echo "<br><table id='example1' class='table table-bordered table-striped'><thead>
          <tr><th>No</th><th>Nis</th><th>Nama</th><th>Kelas</th><th>Status</th><th>Nilai Pilihan Ganda</th><th>Nilai Esay</th><th>Aksi</th></tr></thead>";
        $no=1;
        while ($t=mysql_fetch_array($siswa_yangmengerjakan2)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$t[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$s[id_kelas]'");
            $k = mysql_fetch_array($kelas);
            $nilai = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq='$_GET[id]' AND id_siswa ='$t[id_siswa]'");
            $n = mysql_fetch_array($nilai);
            $nilai2 = mysql_query("SELECT * FROM nilai WHERE id_tq='$_GET[id]' AND id_siswa = '$t[id_siswa]'");
            $n2 = mysql_fetch_array($nilai2);
            echo "<tr><td>$no</td>
                      <td>$s[nis]</td>
                      <td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail siswa'>$s[nama_lengkap]</a></td>
                      <td>$k[nama]</td>";
                      if ($t[dikoreksi]=='B'){
                          echo "<td>Jawaban soal essay <b>belum di koreksi</b></td>
                                     <td>$n2[persentase]</td><td>0</td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id]>Hapus Siswa</a> |
                          <a href=?module=quiz&act=koreksi&id=$t[id_tq]&id_siswa=$s[id_siswa]>Koreksi Jawaban Esay</a></td></tr>";
                      }else{
                          echo "<td>Jawaban soal essay <b>sudah di koreksi</b></td><td>$n2[persentase]</td>
                                                         <td> $n[nilai]</td>";
                          echo "
                          <td><a href=javascript:confirmdelete('$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id]') class='btn btn-red'>Hapus Siswa</a> |
                          <a href=?module=quiz&act=editkoreksi&id=$t[id_tq]&id_siswa=$s[id_siswa] class='btn btn-warning'>Edit Koreksi</a></td></tr>";
                      }
            $no++;
        }
        echo "</table>
              <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()></div></section>";
        }
        elseif (empty($pilganda) AND !empty($esay)){
         echo"
          <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Siswa yang telah mengikuti Ujian
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          ";
         echo "<br><div class='col-sm-6'><div class='alert alert-info'>
        Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
        Hanya jawaban soal Essay yang bisa di koreksi.<br>
        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan.</div></div>";

        $siswa_yangmengerjakan2 = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        echo "<br><table id='example1' class='table table-bordered table-striped'><thead>
          <tr><th>No</th><th>Nis</th><th>Nama</th><th>Kelas</th><th>Nilai Pilihan Ganda</th><th>Nilai Esay</th><th>Aksi</th></tr></thead>";
        $no=1;
        while ($t=mysql_fetch_array($siswa_yangmengerjakan2)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$t[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$s[id_kelas]'");
            $k = mysql_fetch_array($kelas);
            $nilai = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq='$_GET[id]' AND id_siswa ='$t[id_siswa]'");
            $n = mysql_fetch_array($nilai);
            echo "<tr><td>$no</td>
                      <td>$s[nis]</td>
                      <td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail siswa'>$s[nama_lengkap]</a></td>
                      <td>$k[nama]</td>";
                      if ($t[dikoreksi]=='B'){
                          echo "<td>0</td><td>Jawaban soal essay <b>belum di koreksi</b></td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id]  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete Siswa</a> |
                          <a href=?module=quiz&act=koreksi&id=$t[id_tq]&id_siswa=$s[id_siswa]>Koreksi Jawaban Esay</a></td></tr>";
                      }else{
                          echo "<td>0</td><td>$n[nilai]</td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id]  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete Siswa</a> |
                          <a href=?module=quiz&act=editkoreksi&id=$t[id_tq]&id_siswa=$s[id_siswa] class='btn btn-warning'>Edit Koreksi</a></td></tr>";
                      }
            $no++;
        }
        echo "</table>
        <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()></div></section>";
        }
        elseif (!empty($pilganda) AND empty($esay)){
         echo "
        <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Siswa Yang telah mengikuti Ujian
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
         ";
         echo "<br><div class='col-sm-6'><div class='alert alert-info'>
        Pilih Aksi <b>Hapus Siswa</b> jika ingin mereset Siswa yang telah mengikuti ujian.<br>
        Hanya jawaban soal Essay yang bisa di koreksi.<br>
        Penilaian Soal Pilihan Ganda Sistem yang mengerjakan.</div></div>";


        $siswa_yangmengerjakan2 = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        echo "<br><table class='table table-bordered table-striped'><thead>
          <tr><th>No</th><th>Nis</th><th>Nama</th><th>Kelas</th><th>Nilai Pilihan Ganda</th><th>Nilai Esay</th><th>Aksi</th></tr></thead>";
        $no=1;
        while ($t=mysql_fetch_array($siswa_yangmengerjakan2)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$t[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$s[id_kelas]'");
            $k = mysql_fetch_array($kelas);
            $nilai = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq='$_GET[id]' AND id_siswa ='$t[id_siswa]'");
            $n = mysql_fetch_array($nilai);
            $nilai2 = mysql_query("SELECT * FROM nilai WHERE id_tq='$_GET[id]' AND id_siswa = '$t[id_siswa]'");
            $n2 = mysql_fetch_array($nilai2);
            echo "<tr><td>$no</td>
                      <td>$s[nis]</td>
                      <td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail siswa'>$s[nama_lengkap]</a></td>
                      <td>$k[nama]</td>";
                      if ($t[dikoreksi]=='B'){
                          echo "<td>$n2[persentase]</td><td>0</td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id]  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete Siswa</a>
                          </td></tr>";
                      }else{
                          echo "<td>$n2[persentase]</td><td>$n[nilai]</td>";
                          echo "
                          <td><a href=$aksi?module=quiz&act=editsiswayangtelahmengerjakan&id=$t[id]&id_siswa=$s[id_siswa]&id_tq=$_GET[id]  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete Siswa</a>
                          </td></tr>";
                      }
            $no++;
        }
        echo "</table>
              <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()></div></section><section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Print Nilai Siswa
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
         ";
         echo "";


        $siswa_yangmengerjakan2 = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq = '$_GET[id]'");
        echo "<br><table id='example3' class='table table-bordered table-striped'><thead>
          <tr><th>No</th><th>Nis</th><th>Nama</th><th>Kelas</th><th>Nilai Pilihan Ganda</th><th>Nilai Esay</th></tr></thead>";
        $no=1;
        while ($t=mysql_fetch_array($siswa_yangmengerjakan2)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$t[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$s[id_kelas]'");
            $k = mysql_fetch_array($kelas);
            $nilai = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq='$_GET[id]' AND id_siswa ='$t[id_siswa]'");
            $n = mysql_fetch_array($nilai);
            $nilai2 = mysql_query("SELECT * FROM nilai WHERE id_tq='$_GET[id]' AND id_siswa = '$t[id_siswa]'");
            $n2 = mysql_fetch_array($nilai2);
            echo "<tr><td>$no</td>
                      <td>$s[nis]</td>
                      <td>$s[nama_lengkap]</td>
                      <td>$k[nama]</td>";
                      if ($t[dikoreksi]=='B'){
                          echo "<td>$n2[persentase]</td><td>0</td>";
                          echo "
                          </tr>";
                      }else{
                          echo "<td>$n2[persentase]</td><td>$n[nilai]</td>";
                          echo "
                          </tr>";
                      }
            $no++;
        }
        echo "</table>
              </div></section>";
        }
        elseif (empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Tidak Ada Soal.');
                    window.location=(href='media_admin.php?module=quiz')</script>";
        }
        }else{
            echo "<script>window.alert('Belum ada siswa yang mengikuti ujian.');
                    window.location=(href='media_admin.php?module=quiz')</script>";
        }
    }
    break;

case "koreksi":
    if ($_SESSION[leveluser]=='admin'){
        $cek = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_siswa='$_GET[id_siswa]'");
        $c = mysql_fetch_array($cek);
        if ($c[dikoreksi]=='B'){
        $soal_pilganda = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq='$_GET[id]'");
        $pilganda = mysql_num_rows($soal_pilganda);
        $soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_GET[id]'");
        $esay = mysql_num_rows($soal_esay);
        if (!empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "
                <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> ";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table id='table1' class='gtable sortable'>
                          <form method=POST action='?module=quiz&act=hasilkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;                 
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></div></div>";
            }else{
                 echo "<script>window.alert('Jawaban siswa kosong.');
                       window.location=(href='?module=quiz')</script>";
            }

        }
        elseif (empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "

               <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Jawaban Soal Essay Siswa <b>$s[nama_lengkap]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table id='table1' class='gtable sortable'>
                          <form method=POST action='?module=quiz&act=hasilkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
            }
            else{
                 echo "<script>window.alert('Jawaban siswa kosong.');
                        window.location=(href='?module=quiz')</script>";
            }
        }
        elseif (!empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Soal hanya pilihan ganda, sudah di koreksi oleh system.');
            window.location=(href='?module=quiz')</script>";
        }
        elseif (empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Tidak ada soal pilihan ganda atau essay.');
            window.location=(href='?module=quiz')</script>";
        }
    }
    elseif ($c[dikoreksi]=='S'){
         echo "<script>window.alert('Sudah Di Koreksi');
         window.location=(href='?module=quiz')</script>";
    }
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $cek = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_siswa='$_GET[id_siswa]'");
        $c = mysql_fetch_array($cek);
        if ($c[dikoreksi]=='B'){
        $soal_pilganda = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq='$_GET[id]'");
        $pilganda = mysql_num_rows($soal_pilganda);
        $soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_GET[id]'");
        $esay = mysql_num_rows($soal_esay);
        if (!empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Jawaban Soal Essay Siswa <b>$s[nama_lengkap]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table class='table table-bordered table-responsive'>
                          <form method=POST action='?module=quiz&act=hasilkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
            }else{
                 echo "<script>window.alert('Jawaban siswa kosong.');
                       window.location=(href='?module=quiz')</script>";
            }

        }
        elseif (empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Jawaban Soal Essay Siswa <b>$s[nama_lengkap]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table id='table1' class='gtable sortable'>
                          <form method=POST action='?module=quiz&act=hasilkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
            }
            else{
                 echo "<script>window.alert('Jawaban siswa kosong.');
                        window.location=(href='?module=quiz')</script>";
            }
        }
        elseif (!empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Soal hanya pilihan ganda, sudah di koreksi oleh system.');
            window.location=(href='?module=quiz')</script>";
        }
        elseif (empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Tidak ada soal pilihan ganda atau essay.');
            window.location=(href='?module=quiz')</script>";
        }
    }
    elseif ($c[dikoreksi]=='S'){
         echo "<script>window.alert('Sudah Di Koreksi');
         window.location=(href='?module=quiz')</script>";
    }
    }
    break;

case "editkoreksi":
    if ($_SESSION[leveluser]=='admin'){
        $soal_pilganda = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq='$_GET[id]'");
        $pilganda = mysql_num_rows($soal_pilganda);
        $soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_GET[id]'");
        $esay = mysql_num_rows($soal_esay);
        if (!empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

               ";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table class='table table-bordered table-responsive'>
                          <form method=POST action='?module=quiz&act=hasileditkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></div></div>";
            }
        }
        elseif (empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Edit Jawaban Soal Essay Siswa <b>$s[nama_lengkap]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table class='table table-bordered table-responsive'>
                          <form method=POST action='?module=quiz&act=hasileditkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
            }
        }
        elseif (!empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Soal hanya pilihan ganda, sudah di koreksi oleh system.');
            window.location=(href='?module=quiz')</script>";
        }
        elseif (empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Tidak ada soal pilihan ganda atau essay.');
            window.location=(href='?module=quiz')</script>";
        }
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $soal_pilganda = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq='$_GET[id]'");
        $pilganda = mysql_num_rows($soal_pilganda);
        $soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_GET[id]'");
        $esay = mysql_num_rows($soal_esay);
        if (!empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Edit Jawaban Soal Essay Siswa <b>$s[nama_lengkap]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
               ";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table class='table table-bordered table-responsive'>
                          <form method=POST action='?module=quiz&act=hasileditkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
            }
        }
        elseif (empty($pilganda) AND !empty($esay)){
            $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id_siswa]'");
            $s = mysql_fetch_array($siswa);
            $jawaban = mysql_query("SELECT * FROM jawaban WHERE id_tq='$_GET[id]' AND id_siswa='$_GET[id_siswa]'");
            $cek=mysql_num_rows($jawaban);
            if (!empty($cek)){
                echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Edit Jawaban Soal Essay Siswa <b>$s[nama_lengkap]
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>";
                $no=1;
                while ($j=mysql_fetch_array($jawaban)){
                    $soal_esay2 = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$j[id_tq]' AND id_quiz='$j[id_quiz]'");
                    $quiz = mysql_fetch_array($soal_esay2);
                    echo "<table id='table1' class='gtable sortable'>
                          <form method=POST action='?module=quiz&act=hasileditkoreksi'>";
                            if (!empty($quiz[gambar])){
                            echo "<tr><td rowspan=7><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><img src='../foto_soal/medium_$quiz[gambar]'></td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";

                            }
                            else{
                                echo "<tr><td rowspan=6><b>$no.</b></td><td><b>Pertanyaan :</b></td></tr>
                                  <tr><td>$quiz[pertanyaan]</td></tr>
                                  <tr><td><b>Jawaban:</b></td></tr>
                                  <tr><td>$j[jawaban]</td></tr>
                                  <tr><td><b>Nilai:</b></td></tr>
                                  <tr><td><input type=radio name='nilai".$no."' value='10'>10</input>
                                          <input type=radio name='nilai".$no."' value='20'>20</input>
                                          <input type=radio name='nilai".$no."' value='30'>30</input>
                                          <input type=radio name='nilai".$no."' value='40'>40</input>
                                          <input type=radio name='nilai".$no."' value='50'>50</input>
                                          <input type=radio name='nilai".$no."' value='60'>60</input>
                                          <input type=radio name='nilai".$no."' value='70'>70</input>
                                          <input type=radio name='nilai".$no."' value='80'>80</input>
                                          <input type=radio name='nilai".$no."' value='90'>90</input>
                                          <input type=radio name='nilai".$no."' value='100'>100</input></td></tr>
                                  <input type=hidden name='jawab".$no."' value='$j[jawaban]'>
                                  </table>";
                            }
                    $no++;
                }
                $jum = $no - 1;
                    echo "<input type=hidden name=jumlah_soal value='$jum'>
                          <input type=hidden name=id_topik value='$_GET[id]'>

                          <input type=hidden name=id_siswa value='$_GET[id_siswa]'>";
                echo "<br>
                          <input class='btn btn-success' type=submit value=Simpan>
                          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></div></section>";
            }
        }
        elseif (!empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Soal hanya pilihan ganda, sudah di koreksi oleh system.');
            window.location=(href='?module=quiz')</script>";
        }
        elseif (empty($pilganda) AND empty($esay)){
            echo "<script>window.alert('Tidak ada soal pilihan ganda atau essay.');
            window.location=(href='?module=quiz')</script>";
        }
    }
    break;


case "hasilkoreksi":
    if ($_SESSION[leveluser]=='admin'){
        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

          <form method=POST action='$aksi?module=quiz&act=inputnilai'>";
        $jum_soal = $_POST['jumlah_soal'];
        
                    echo "<table class='table table-bordered table-responsive'><thead>
                          <input type=hidden name=id_tq value='$_POST[id_topik]'>
                          <input type=hidden name=id_siswa value='$_POST[id_siswa]'>";
                    echo "<tr><th>No Soal</th><th>Jawaban</th><th>Nilai</th></tr></thead>";
                    for ($i=1; $i<=$jum_soal; $i++){
                        $nilai = $_POST['nilai'.$i];
                        $jawaban = $_POST['jawab'.$i];
                        if (!empty($jawaban)){
                        echo "<tr><td>$i.</td><td>$jawaban</td><td>$nilai</td></tr>";
                        }else{
                            echo "<tr><td>$i.</td><td></td><td>$nilai</td></tr>";
                        }
                        
                    }
                    echo "</table>";
                    
                    $jumlah = 0;
                    for ($i=1; $i<=$jum_soal; $i++){                        
                        $bil = array($_POST['nilai'.$i]);
                        for ($j=0; $j<=count($bil)-1; $j++){
                        $jumlah = $jumlah + $bil[$j];
                        }                        
                    }                   
                    $nilai = $jumlah / 100;
                    $nilai2 = $nilai / $jum_soal;
                    $nilai3 = $nilai2 * 100;
                echo "<button class='btn btn-warning'>Nilai Keseluruhan = $nilai3</button>";
                echo "<input type=hidden name=nilai value='$nilai3'>";
                echo "
                      <input class='btn btn-success' type=submit value=Simpan>
                      <input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
                      ";
                    echo "</form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Koreksi Nilai
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

        <form method=POST action='$aksi?module=quiz&act=inputnilai'>
         
            ";
        $jum_soal = $_POST['jumlah_soal'];

                    echo "<table class='table table-bordered table-responsive'><thead>
                          <input type=hidden name=id_tq value='$_POST[id_topik]'>
                          <input type=hidden name=id_siswa value='$_POST[id_siswa]'>";
                    echo "<tr><th>No Soal</th><th>Jawaban</th><th>Nilai</th></tr></thead>";
                    for ($i=1; $i<=$jum_soal; $i++){
                        $nilai = $_POST['nilai'.$i];
                        $jawaban = $_POST['jawab'.$i];
                        if (!empty($jawaban)){
                        echo "<tr><td>$i.</td><td>$jawaban</td><td>$nilai</td></tr>";
                        }else{
                            echo "<tr><td>$i.</td><td></td><td>$nilai</td></tr>";
                        }

                    }
                    echo "</table>";

                    $jumlah = 0;
                    for ($i=1; $i<=$jum_soal; $i++){
                        $bil = array($_POST['nilai'.$i]);
                        for ($j=0; $j<=count($bil)-1; $j++){
                        $jumlah = $jumlah + $bil[$j];
                        }
                    }
                    $nilai = $jumlah / 100;
                    $nilai2 = $nilai / $jum_soal;
                    $nilai3 = $nilai2 * 100;
                echo "<p align='right'><button class='btn btn-warning'>Nilai Keseluruhan = $nilai3</button></p><br/>";
                echo "<input type=hidden name=nilai value='$nilai3'>";
                echo "
                      <input class='btn btn-success' type=submit value=Simpan>
                      <input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
                      ";
                    echo "</form></section>";
    }
    else{
        echo "anda tidak ber hak mengakses ini.";
    }
    break;

case "hasileditkoreksi":
    if ($_SESSION[leveluser]=='admin'){
        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <form method=POST action='$aksi?module=quiz&act=inputeditnilai'><fieldset>
              ";
        $jum_soal = $_POST['jumlah_soal'];

                    echo "<table class='table table-bordered table-responsive'><thead>
                          <input type=hidden name=id_tq value='$_POST[id_topik]'>
                          <input type=hidden name=id_siswa value='$_POST[id_siswa]'>";
                    echo "<tr><th>No Soal</th><th>Jawaban</th><th>Nilai</th></tr></thead>";
                    for ($i=1; $i<=$jum_soal; $i++){
                        $nilai = $_POST['nilai'.$i];
                        $jawaban = $_POST['jawab'.$i];
                        if (!empty($jawaban)){
                        echo "<tr><td>$i</td><td>$jawaban</td><td>$nilai</td></tr>";
                        }else{
                            echo "<tr><td>$i</td><td></td><td>$nilai</td></tr>";
                        }

                    }
                    echo "</table>";
                    $jumlah = 0;
                    for ($i=1; $i<=$jum_soal; $i++){
                        $bil = array($_POST['nilai'.$i]);
                        for ($j=0; $j<=count($bil)-1; $j++){
                        $jumlah = $jumlah + $bil[$j];
                        }
                    }
                    $nilai = $jumlah / 100;
                    $nilai2 = $nilai / $jum_soal;
                    $nilai3 = $nilai2 * 100;
                echo "<p align='right'><button class='btn btn-warning'>Nilai Keseluruhan = $nilai3</button></p>";
                echo "<input type=hidden name=nilai value='$nilai3'>";
                echo "
                            <input class='btn btn-success' type=submit value=Simpan>
                            <input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
                            ";
                    echo " </form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
         echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                           Hasil  Koreksi Nilai
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

         <form method=POST action='$aksi?module=quiz&act=inputeditnilai'>";
        $jum_soal = $_POST['jumlah_soal'];

                    echo "<table class='table table-bordered table-responsive'><thead>
                          <input type=hidden name=id_tq value='$_POST[id_topik]'>
                          <input type=hidden name=id_siswa value='$_POST[id_siswa]'>";
                    echo "<tr><th>No Soal</th><th>Jawaban</th><th>Nilai</th></tr></thead>";
                    for ($i=1; $i<=$jum_soal; $i++){
                        $nilai = $_POST['nilai'.$i];
                        $jawaban = $_POST['jawab'.$i];
                        if (!empty($jawaban)){
                        echo "<tr><td>$i</td><td>$jawaban</td><td>$nilai</td></tr>";
                        }else{
                            echo "<tr><td>$i</td><td></td><td>$nilai</td></tr>";
                        }

                    }
                    echo "</table>";
                    $jumlah = 0;
                    for ($i=1; $i<=$jum_soal; $i++){
                        $bil = array($_POST['nilai'.$i]);
                        for ($j=0; $j<=count($bil)-1; $j++){
                        $jumlah = $jumlah + $bil[$j];
                        }
                    }
                    $nilai = $jumlah / 100;
                    $nilai2 = $nilai / $jum_soal;
                    $nilai3 = $nilai2 * 100;
                echo "<p align='right'><button class='btn btn-warning'>Nilai Keseluruhan = $nilai3</button></p><br>";
                echo "<input type=hidden name=nilai value='$nilai3'>";
                echo "
                            <input class='btn btn-success' type=submit value=Simpan>
                            <input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
                            ";
                    echo " </form></div></section>";
    }
    break;

case "tambahtopikquiz":
    if ($_SESSION[leveluser]=='admin'){
    echo "
   <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
    <form name='form_topik' method=POST action='$aksi?module=quiz&act=input_topikquiz' class='form-horizontal form-groups-bordered'>
    
     <div class='form-group'>
          <div class='col-sm-2'><label>Judul</label></div>              <div class='col-sm-5'> <input type=text name='judul' size='50' class='form-control' id='field-1' required='required' placeholder='Placeholder'></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>              <div class='col-sm-2'> <select name='id_kelas'  class='form-control' onChange='showpel()'>
                                          <option value=''>-pilih-</option>";
                                          $pilih="SELECT * FROM kelas ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Pelajaran</label></div>          <div class='col-sm-2'> <div id='pelajaran'></div></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Waktu pengerjaan</label></div>   <div class='col-sm-2'> <input type=text name='waktu' class='form-control' id='field-1' required='required' placeholder='Placeholder' size='10'>
                                                    <small>Dalam Menit</small></div></div>
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>Info</label></div>              <div class='col-sm-7'> <textarea name='info' id='wysiwyg' class='form-control' id='field-1' required='required' placeholder='Placeholder'  rows='6'></textarea></div></div>
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>Terbit</label></div>            <div class='col-sm-5'> <label><input type=radio name='terbit' value='Y'>Y</input></label>
                                              <label><input type=radio name='terbit' value='N'>N</input></label></div></div>
  
<div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <p><input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p>
</div></div>
         </form></div></div></div>";
    }
    else{
      echo"tidak diijinkan";
    }
    
case "edittopikquiz":
    if ($_SESSION[leveluser]=='admin'){

    $edit=mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
    $t=mysql_fetch_array($edit);
    $isikelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$t[id_kelas]'");
    $k=mysql_fetch_array($isikelas);
    $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$t[id_matapelajaran]'");
    $p=mysql_fetch_array($pelajaran);

    $waktu = $t['waktu_pengerjaan']/60;

    echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

    <form name='form_topik' method=POST action='$aksi?module=quiz&act=edit_topikquiz' class='form-horizontal form-groups-bordered'>
    <input type=hidden name=id value='$t[id_tq]'>
   
     <div class='form-group'>
          <div class='col-sm-2'>
          <label>Judul</label></div>              <div class='col-sm-5'><input type=text name='judul' value='$t[judul]' class='form-control' id='field-1' required='required' placeholder='Placeholder' size='50'></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>            <div class='col-sm-2'>
    <select name='id_kelas' onChange='showpel()' class='form-control'>
                                          <option value='".$k[id_kelas]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kelas ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Pelajaran</label></div>         <div class='col-sm-2'> <select id='pelajaran' name='id_matapelajaran' class='form-control'>
                                          <option value='".$p[id_matapelajaran]."' selected>".$p[nama]."</option>
                                          </select></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Waktu Pengerjaan</label></div>   <div class='col-sm-2'>
          <input type=text name='waktu' size='10' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$waktu'>
                                                     <small>Dalam Menit</small></div></div>
     <div class='form-group'>
          <div class='col-sm-2'><label>Info Quiz</label></div>               <div class='col-sm-7'> <textarea name='info'  class='form-control ckeditor'  required='required' placeholder='Placeholder' rows='6'>$t[info]</textarea></div></div>";
    if ($t[terbit]=='N'){
      echo " <div class='form-group'>
          <div class='col-sm-2'><label>Terbit</label></div>     <div class='col-sm-5'> <label><input type=radio name='terbit' value='Y'> Y</label>
                                           <label><input type=radio name='terbit' value='N' checked> N </label></div></div>";
    }
    else{
      echo " <div class='form-group'>
          <div class='col-sm-2'><label>Terbit</label></div>     <div class='col-sm-5'> <label><input type=radio name='terbit' value='Y' checked> Y</label>
                                          <label><input type=radio name='terbit' value='N'> N </label></div></div>";
    }
    echo "
 <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <p><input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p></div></div>

          </form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
    $edit=mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
    $t=mysql_fetch_array($edit);
    $isikelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$t[id_kelas]'");
    $k=mysql_fetch_array($isikelas);
    $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$t[id_matapelajaran]'");
    $p=mysql_fetch_array($pelajaran);

    $waktu = $t['waktu_pengerjaan']/60;

    echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Edit Topik
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

<form name='form_topik' method=POST action='$aksi?module=quiz&act=edit_topikquiz' class='form-horizontal form-groups-bordered'>
    <input type=hidden name=id value='$t[id_tq]'>
    
    <div class='form-group'>
          <div class='col-sm-2'><label>Judul</label></div>             
           <div class='col-sm-5'> <input type=text name='judul' class='form-control' id='field-1' required='required' placeholder='Placeholder' value='$t[judul]' size='50'></div></div>
    <div class='form-group'>
    <div class='col-sm-2'>  
    <label>Kelas</label></div>               <div class='col-sm-2'><select name='id_kelas' class='form-control' onChange='showpel_pengajar()'>
                                          <option value='".$k[id_kelas]."' selected>".$k[nama]."</option>";
                                          $pilih= mysql_query("SELECT DISTINCT id_kelas FROM mata_pelajaran WHERE id_pengajar ='$_SESSION[idpengajar]'");
                                          while($row=mysql_fetch_array($pilih)){
                                          $cari_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$row[id_kelas]'");
                                          while ($k=mysql_fetch_array($cari_kelas)){
                                          echo"<option value='".$k[id_kelas]."'>".$k[nama]."</option>";
                                          }
                                          }
    
                                          echo"</select></div></div>
                                          <div class='form-group'>
    <div class='col-sm-2'>  
    <label>Pelajaran</label></div>           <div class='col-sm-2'> <select id='pelajaran' class='form-control' name='id_matapelajaran'>
                                          <option value='".$p[id_matapelajaran]."' selected>".$p[nama]."</option>
                                          </select></div></div>
       <div class='form-group'>
    <div class='col-sm-2'>  
    <label>Lama Pengerjaan</label></div>    <div class='col-sm-2'>
     <input type=text class='form-control' id='field-1' required='required' placeholder='Placeholder' name='waktu' size='10' value='$waktu'>
     <small>Dalam Menit</small></div></div>
       <div class='form-group'>
    <div class='col-sm-2'>  <label>Info Quiz</label></div>               
     <div class='col-sm-10'> <textarea name='info' required='required' class='form-control ckeditor'  rows='6'>$t[info]</textarea></div></div>";
    if ($t[terbit]=='N'){
      echo "   <div class='form-group'>
    <div class='col-sm-2'>  <label>Terbit</label></div>      <div class='col-sm-3'>  <label><input type=radio name='terbit' value='Y'> Y</label>
                                           <label><input type=radio name='terbit' value='N' checked> N </label></div></div>";
    }
    else{
      echo "   <div class='form-group'>
    <div class='col-sm-2'>  <label>Terbit</label></div>      <div class='col-sm-3'>  <label><input type=radio name='terbit' value='Y' checked> Y</label>
                                          <label><input type=radio name='terbit' value='N'> N </label></div></div>";
    }
    echo "   <div class='form-group'>
    <div class='col-sm-5'>  

          <p align=center><input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()></p></div>

          </form></section>";
    }
    break;

case "daftartopik":
    if ($_SESSION[leveluser]=='siswa'){
        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        $data_mapel = mysql_fetch_array($mapel);
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_kelas = '$_GET[id_kelas]' AND id_matapelajaran = '$_GET[id]' AND terbit='Y'");
        $cek_topik = mysql_num_rows($topik);

        if (!empty($cek_topik)){
            echo"
            <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Daftar Tugas / Quiz Mata Pelajaran $data_mapel[nama]
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>


              <table class='table table-bordered table-striped table-condensed cf'>
              <thead><tr><th>No</th><th colspan=2>Deskripsi Tugas/Quiz </th></tr></thead>";
              $no=1;
              while($t=mysql_fetch_array($topik)){
                  $tgl_posting   = tgl_indo($t[tgl_buat]);
                  $pengajar =  mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$t[pembuat]'");
                  $cek_pengajar = mysql_num_rows($pengajar);
                  $waktu = $t[waktu_pengerjaan] / 60;
                  echo"<tr><td rowspan=6>$no</td><td><b>Judul</b></td><td><b> $t[judul]</b></td></tr>
                       <tr><td><b>Tanggal Posting</b></td><td><b> $tgl_posting</b></td></tr>";
                       if(!empty($cek_pengajar)){

                       $p = mysql_fetch_array($pengajar);
                       echo"<tr><td><b>Pembuat</b></td><td><b> $p[nama_lengkap]</b></td></tr>";
                       }else{
                           echo"<tr><td><b>Pembuat</b></td><td><b> $t[pembuat]</b></td></tr>";
                       }
                       echo"<tr><td><b>Waktu Pengerjaan</b></td><td><b> $waktu menit</b></td></tr>
                            <tr><td><b>Info Soal/Quiz</b></td><td><b> $t[info]</b></td></tr>
                            <tr><td></td><td><input type=button class='btn btn-success' value='Kerjakan Tugas/Quiz'
                       onclick=\"window.location.href='?module=quiz&act=infokerjakan&id=$t[id_tq]';\"></td></tr>";
              $no++;
              }
              echo"</table>
                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()></div></section>";
        }else{
            echo "<script>window.alert('Belum ada Tugas atau Quiz di mata pelajaran ini.');
                    window.location=(href='media.php?module=quiz')</script>";
        }
    }
    break;

case "daftarnilai":
    if ($_SESSION[leveluser]=='siswa'){
        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        $data_mapel = mysql_fetch_array($mapel);
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_kelas = '$_GET[id_kelas]' AND id_matapelajaran = '$_GET[id]' AND terbit='Y'");
        $cek_topik = mysql_num_rows($topik);
        
        if (!empty($cek_topik)){
            echo" <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Daftar Tugas / Quiz Mata Pelajaran $data_mapel[nama]
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
              <thead><tr><th>No</th><th>Deskripsi Tugas/Quiz </th><th></th></tr></thead>";
              $no=1;
               while($t=mysql_fetch_array($topik)){
                  $tgl_posting   = tgl_indo($t[tgl_buat]);
                  $pengajar =  mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$t[pembuat]'");
                  $cek_pengajar = mysql_num_rows($pengajar);
                  $waktu = $t[waktu_pengerjaan] / 60;
                  echo"<tr><td rowspan=6>$no</td><td><b>Judul</b></td><td><b>$t[judul]</b></td></tr>
                       <tr><td><b>Tanggal Posting</b></td><td><b>$tgl_posting</b></td></tr>";
                       if(!empty($cek_pengajar)){

                       $p = mysql_fetch_array($pengajar);
                       echo"<tr><td><b>Pembuat</b></td><td><b>$p[nama_lengkap]</b></td></tr>";
                       }else{
                           echo"<tr><td><b>Pembuat</b></td><td><b> $t[pembuat]</b></td></tr>";
                       }
                       echo"<tr><td><b>Waktu Pengerjaan</b></td><td><b> $waktu menit</b></td></tr>
                            <tr><td><b>Info Soal/Quiz</b></td><td><b> $t[info]</b></td></tr>
                            <tr><td></td><td><input type=button class='btn btn-danger' value='Lihat Nilai'
                       onclick=\"window.location.href='?module=quiz&act=nilaisiswa&id_topik=$t[id_tq]';\"></td></tr>";
                       
              $no++;
              }
              echo"</table>
                <input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()></div></section>  
                ";

		}
		else{
            echo "<script>window.alert('Belum ada Tugas atau Quiz di mata pelajaran ini, jadi tidak ada nilai.');
                    window.location=(href='media.php?module=nilai')</script>";
        }
	}
    break;

case "nilaisiswa":
    if ($_SESSION[leveluser]=='siswa'){
        $quiz_pilganda = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq = '$_GET[id_topik]'");
        $quiz_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq = '$_GET[id_topik]'");
        $c_pilganda = mysql_num_rows($quiz_pilganda);
        $c_esay = mysql_num_rows($quiz_esay);

        if (!empty($c_pilganda) AND !empty($c_esay)){
        $pilganda = mysql_query("SELECT * FROM nilai WHERE id_tq = '$_GET[id_topik]' AND id_siswa = '$_SESSION[idsiswa]'");
        $cek_pilganda = mysql_num_rows($pilganda);
        $esay = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq = '$_GET[id_topik]' AND id_siswa = '$_SESSION[idsiswa]'");
        $cek_esay = mysql_num_rows($esay);

                if (!empty($cek_pilganda) AND !empty($cek_esay)){
                    echo" <section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Nilai Anda
                            <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                     
                      <thead><tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr></thead>";
                      $n_pilganda = mysql_fetch_array($pilganda);
                      $n_esay = mysql_fetch_array($esay);
                      echo "<tr><td>Tugas Pilihan Ganda</td><td>$n_pilganda[persentase]</td></tr>
                            <tr><td>Tugas Essay</td><td>$n_esay[nilai]</td></tr>
                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                            </div></section>
                            <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <table id='example1' class='table table-bordered table-striped'>
              <thead><tr><th>No</th><th>Pertanyaan</th><th>jawaban</th></tr></thead>

                ";
         $no=1;
                $tam=mysql_query("SELECT pertanyaan,kunci FROM quiz_pilganda WHERE id_tq='$_GET[id_topik]' ");
                 while($r=mysql_fetch_array($tam)){

                  echo"<tr><td></td><td>$r[pertanyaan]</td><td>$r[kunci]</td></tr>";
                 
          $no++;
         }
                 echo"</table><div></div></div>";
                }
                elseif (empty($cek_pilganda) AND !empty($cek_esay)){
                    echo" <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                      
                      <tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr>";
                      $n_pilganda = mysql_fetch_array($pilganda);
                      $n_esay = mysql_fetch_array($esay);
                      echo "<tr><td>Tugas Pilihan Ganda</td><td>Anda belum mengerjakan</td></tr>
                            <tr><td>Tugas Essay</td><td>$n_esay[nilai]</td></tr>
                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                            </div></section>";
                }
                elseif (!empty($cek_pilganda) AND empty($cek_esay)){
                    echo" section class='panel panel-primary'>
                        <header class='panel-heading'>
                            Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                     <thead> <tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr></thead>";
                      $n_pilganda = mysql_fetch_array($pilganda);
                      $n_esay = mysql_fetch_array($esay);
                      echo "<tr><td>Tugas Pilihan Ganda</td><td>$n_pilganda[persentase]</td></tr>
                            <tr><td>Tugas Essay</td><td>Belum di koreksi</td></tr>
                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                            </div></section>
                            <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <table id='example1' class='table table-bordered table-striped'>
              <thead><tr><th>No</th><th>Pertanyaan</th><th>jawaban</th></tr></thead>

                ";
         $no=1;
                $tam=mysql_query("SELECT pertanyaan,kunci FROM quiz_pilganda WHERE id_tq='$_GET[id_topik]' ");
                 while($r=mysql_fetch_array($tam)){

                  echo"<tr><td></td><td>$r[pertanyaan]</td><td>$r[kunci]</td></tr>";
                 
          $no++;
         }
                 echo"</table><div></div></div>";
                }
                elseif (empty($cek_pilganda) AND empty($cek_esay)){
                    echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                      <thead><tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr></thead>";
                      $n_pilganda = mysql_fetch_array($pilganda);
                      $n_esay = mysql_fetch_array($esay);
                      echo "<tr><td>Tugas Pilihan Ganda</td><td>Anda Belum mengerjakan</td></tr>
                            <tr><td>Tugas Essay</td><td>Anda Belum mengerjakan</td></tr>
                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                            </div></section>";
                }

        }
        elseif (empty($c_pilganda) AND !empty($c_esay)){
        $esay = mysql_query("SELECT * FROM nilai_soal_esay WHERE id_tq = '$_GET[id_topik]' AND id_siswa = '$_SESSION[idsiswa]'");
        $cek_esay = mysql_num_rows($esay);
                //jika nilai tidak kosong
                if (!empty($cek_esay)){
                    
                          echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                          <tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr>";
                          $n_esay = mysql_fetch_array($esay);
                          echo "<tr><td>Tugas Essay</td><td>$n_esay[nilai]</td></tr>
                          </table>
                                <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                                </div></section>";
                        
                }
                elseif (empty($cek_esay)) {
                    $kerjakan = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq='$_GET[id_topik]' AND id_siswa = '$_SESSION[idsiswa]'");
                    $c_kerjakan = mysql_num_rows($kerjakan);
                    if (!empty($c_kerjakan)){
                        $cek_kerjakan = mysql_fetch_array($kerjakan);
                        if ($cek_kerjakan['dikoreksi']=='B'){
                        echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                          <thead><tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr></thead>";
                          echo "<tr><td>Tugas Essay</td><td>Belum Dikoreksi</td></tr>
                          </table>
                                <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                                </div></section>";

                    }
                    elseif (empty($c_kerjakan)){
                            echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
              <table class='table table-bordered table-striped table-condensed cf'>
                              <thead><tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr></thead>";
                              echo "<tr><td>Tugas Essay</td><td>Anda belum mengerjakan</td></tr>
                              </table>
                                    <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                                    </div></section>";


                    }
                    }
                }
                
        }
        elseif (!empty($c_pilganda) AND empty($c_esay)){
        $pilganda = mysql_query("SELECT * FROM nilai WHERE id_tq = '$_GET[id_topik]' AND id_siswa = '$_SESSION[idsiswa]'");
        $cek_pilganda = mysql_num_rows($pilganda);
                if (!empty($cek_pilganda)){
                    echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                      <thead><tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr></thead>";
                      $n_pilganda = mysql_fetch_array($pilganda);
                      echo "<tr><td>Tugas Pilihan Ganda</td><td>$n_pilganda[persentase]</td></tr>
                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                            </section>
                             <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <table id='example1' class='table table-bordered table-striped'>
              <thead><tr><th>No</th><th>Pertanyaan</th><th>jawaban</th></tr></thead>

                ";
         $no=1;
                $tam=mysql_query("SELECT pertanyaan,kunci FROM quiz_pilganda WHERE id_tq='$_GET[id_topik]' ");
                 while($r=mysql_fetch_array($tam)){

                  echo"<tr><td></td><td>$r[pertanyaan]</td><td>$r[kunci]</td></tr>";
                 
          $no++;
         }
                 echo"</table><div></div></div>";
                }
                else {
                    echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Nilai Anda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        
              <table class='table table-bordered table-striped table-condensed cf'>
                      <tr><th>Deskripsi Tugas/Quiz </th><th>Nilai</th></tr>";
                      $n_pilganda = mysql_fetch_array($pilganda);
                      echo "<tr><td>Tugas Pilihan Ganda</td><td>Anda Belum mengerjakan</td></tr>
                            </table>
                            <p class='garisbawah'></p><input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
                            </section>
                             ";
                }
        }
        elseif (!empty($c_pilganda) AND !empty($c_esay)){
            echo "<script>window.alert('Belum ada Nilai di tugas/quiz ini.');
            window.location=(href='?module=nilai')</script>";
        }
    }
    break;

case "infokerjakan":
    if ($_SESSION[leveluser]=='siswa'){
        $cek = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq='$_GET[id]' AND id_siswa = '$_SESSION[idsiswa]'");
        $data = mysql_fetch_array($cek);
        
        if ($data[hits]<=0){
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
        $t = mysql_fetch_array($topik);

        echo"
        <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Informasi
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        <br>
            <form method=POST action='soal.php?' target='_blank'>
            <input type=hidden name='waktu' value='$t[waktu_pengerjaan]'>
            <input type=hidden name='id' value='$_GET[id]'>
            <h3>Baca dengan seksama dan teliti sebelum mengerjakan Tugas / Quiz<p class='garisbawah'></p><b>
            1. Pastikan koneksi anda terjamin dan bagus, misalnya Warnet.<br>
            2. Jika menggunakan Modem, pastikan menggunakan operator yang handal.<br>
            3. Pilih browser yang suport dengan Elearning RPL SMK TI yaitu Mozilla Firefox.<br>
            4. Jika mati lampu hubungi Pengajar Mata Pelajaran terkait untuk bisa Ujian Kembali.</h3><br>";
        echo"<p class='garisbawah'></p>
            <input type=submit class='btn btn-danger' value='Mulai Mengerjakan' onclick='window.location.reload()'>
            <input type=button class='btn btn-primary' value='Kembali' onclick=self.history.back()>
            </div></section>";
        }
        elseif ($data[hits] >= 1){
            echo"<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Informasi
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          
      
          <div class='panel-body'>";
            echo "<div class='alert alert-warning alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4>  <i class='icon fa fa-check'></i> Pengumuman</h4>
                    Anda Sudah mengerjakan tugas / Quiz ini
                  </div>
            ";
            echo "<p class='garisbawah'></p>
                <input type=button class='btn btn-primary' value='Kembali'
                onclick=self.history.back()> </div></section>";
        }
    }
    break;

case "buatquiz":
    if ($_SESSION[leveluser]=='admin'){
        $topik=mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
        $t=mysql_fetch_array($topik);
        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 


          <p align=center'>
          <input class='btn btn-warning' type=button value='Buat Quiz Esay' onclick=\"window.location.href='?module=buatquizesay&act=buatquizesay&id=$t[id_tq]';\">
          <input class='btn btn-danger' type=button value='Buat Quiz Pilihan Ganda' onclick=\"window.location.href='?module=buatquizpilganda&act=buatquizpilganda&id=$t[id_tq]';\">
          </p>
          <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
         </form></div></div></div>";
    }
    else{
        $topik=mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
        $t=mysql_fetch_array($topik);
        echo " <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Jenis Kuis
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
        <form class='form-horizontal form-groups-bordered'>
        <div class='form-group'>
          <div class='col-sm-5'>
          <p align=center'>
          <input class='btn btn-warning' type=button value='Buat Quiz Esay' onclick=\"window.location.href='?module=buatquizesay&act=buatquizesay&id=$t[id_tq]';\">
          <input class='btn btn-danger' type=button value='Buat Quiz Pilihan Ganda' onclick=\"window.location.href='?module=buatquizpilganda&act=buatquizpilganda&id=$t[id_tq]';\">
          </p>
          </div></div>
          <br><input class='btn btn-primary' type=button value=Kembali onclick=self.history.back()>
          </form></div></section>";
    }
    break;

case "buatquizesay":
    if ($_SESSION[leveluser]=='admin'){
        $jum = mysql_query("SELECT COUNT(quiz_esay.id_quiz) as jml FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $j = mysql_fetch_array($jum);
        $jumlah = $j[jml] + 1;
        
        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

          <form method=POST action='$aksi?module=quiz&act=input_quizesay' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>        
        <input type=hidden name=id value='$_GET[id]'>
       
         <div class='form-group'>
          <div class='col-sm-2'><label>Pertanyaan ".$jumlah." </label></div>
           <div class='col-sm-10'><textarea name='pertanyaan' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>
         <div class='form-group'>
          <div class='col-sm-2'><label>Gambar </label></div>                 <div class='col-sm-5'>
          <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                                            <small>Jika tidak ada gambar dikosongkann saja.</small>
        <small>Tipe yang di ijinkan JPG dan JPEG</small>
        <small>Jumlah soal esay di database :";
                    if ($j[jml] == 0){
                        echo "<a href='?module=quiz&act=daftarquizesay&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> 0</blink></a></small>";
                    }else{
                        echo "<a href='?module=quiz&act=daftarquizesay&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> $j[jml]</blink></a></small>";
                    }
        echo"</div></div>
     
          <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'> 
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></div></div>";
    }
    else{
        $jum = mysql_query("SELECT COUNT(quiz_esay.id_quiz) as jml FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $j = mysql_fetch_array($jum);
        $jumlah = $j[jml] + 1;

        echo "
         <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Buat  Kuis Esay
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          <form method=POST action='$aksi?module=quiz&act=input_quizesay' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
        <input type=hidden name=id value='$_GET[id]'>
         <div class='form-group'>
          <div class='col-sm-2'>
      <label>Pertanyaan ".$jumlah." </label></div> <div class='col-sm-10'>
      <textarea name='pertanyaan' required='required' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>
       <div class='form-group'>
          <div class='col-sm-2'><label>Gambar </label></div>             
              <div class='col-sm-9'><span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span><br/>
                                                            <small>Jika tidak ada gambar dikosongkann saja.</small>
        <small>Tipe yang di ijinkan JPG dan JPEG</small>
        <small>Jumlah soal esay di database ";
                    if ($j[jml] == 0){
                        echo "<a href='?module=quiz&act=daftarquizesay&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> 0</blink></a></small>";
                    }else{
                        echo "<a href='?module=quiz&act=daftarquizesay&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> $j[jml]</blink></a></small>";
                    }
        echo"</div></div>
       
          <div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div>
          </div>
        </form></section>";
    }
    break;

case "buatquizpilganda":
    if ($_SESSION[leveluser]=='admin'){
        $jum = mysql_query("SELECT COUNT(quiz_pilganda.id_quiz) as jml FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $j = mysql_fetch_array($jum);
        $jumlah = $j[jml] + 1;
        echo"
      <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <form method=POST action='$aksi?module=quiz&act=input_quizpilganda' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>";
        echo" 
        <div class='form-group'>
          <div class='col-sm-2'>
             <label>Pertanyaan ".$jumlah." </label></div> 
             <div class='col-sm-10'>
             <textarea name='pertanyaan' required='required' class='form-control ckeditor' rows='3'></textarea></div></div>
            

             <div class='form-group'>
          <div class='col-sm-2'>
          <label>Gambar Pertanyaan</label></div> <div class='col-sm-5'>
          <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                                                     <small>Apabila tidak ada gambar pertanyaan, di kosongkan saja</small>
                                                                     <small>Tipe gambar yang di ijinkan JPG dan JPEG</small>
                                                                     </div></div>
             <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan A </label></div>        <div class='col-sm-10'>
          <textarea name='pila' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>
             
             <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pilihan B </label></div>        <div class='col-sm-10'>
          <textarea name='pilb' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>
             
             <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pilihan C </label></div>        <div class='col-sm-10'>
          <textarea name='pilc' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>
             
             <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pilihan D </label></div>        <div class='col-sm-10'>
          <textarea name='pild' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>

           <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan E </label></div>       
           <div class='col-sm-10'><textarea name='pile' required='required' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>
             
             <div class='form-group'>
          <div class='col-sm-2'><label>Kunci Jawaban</label></div>  <div class='col-sm-5'>
          <label><input type=radio name='kunci' value=A>A</input><label>
                                            <label><input type=radio name='kunci' value=B>B</input><label>
                                            <label><input type=radio name='kunci' value=C>C</input><label>
                                            <label><input type=radio name='kunci' value=D>D</input><label>
                                             <label><input type=radio name='kunci' value=E>E</input><label>

             <small>Jumlah soal pilihan ganda di database :";
                    if ($j[jml] == 0){
                        echo "<a href='?module=quiz&act=daftarquizpilganda&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> 0</blink></a></small>";
                    }else{
                        echo "<a href='?module=quiz&act=daftarquizpilganda&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> $j[jml]</blink></a></small>";
                    }
        echo"</div></div><input type=hidden name=id value='$_GET[id]'>
         
           <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
          </form></div></div></div>";
    }
    else{
        $jum = mysql_query("SELECT COUNT(quiz_pilganda.id_quiz) as jml FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $j = mysql_fetch_array($jum);
        $jumlah = $j[jml] + 1;
  
        echo"

         <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Buat Kuis Pilihan Ganda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          <form method=POST action='$aksi?module=quiz&act=input_quizpilganda' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>";
        echo"<div class='form-group'>
          <div class='col-sm-2'>
             <label>Pertanyaan ".$jumlah." </label></div> <div class='col-sm-10'>
             <textarea name='pertanyaan' class='form-control ckeditor' required='required' cols='75' rows='3'></textarea></div></div>
             <div class='form-group'>
          <div class='col-sm-2'>
          <label>Gambar Pertanyaan</label></div> <div col-sm-8> 
          <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
                                                                     <small>Apabila tidak ada gambar pertanyaan, di kosongkan saja</small>
                                                                     <small>Tipe gambar yang di ijinkan JPG dan JPEG</small></div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pilihan A </label></div>        <div class='col-sm-10'>
          <textarea name='pila' class='form-control ckeditor' required='required' cols='75' rows='3'></textarea></div></div>

             <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan B </label></div>        
          <div class='col-sm-10'><textarea name='pilb' required='required' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>

            <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan C </label></div>        
          <div class='col-sm-10'><textarea name='pilc' required='required' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>

          <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan D </label></div>       
           <div class='col-sm-10'><textarea name='pild' required='required' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>

            <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan E </label></div>       
           <div class='col-sm-10'><textarea name='pile' required='required' class='form-control ckeditor' cols='75' rows='3'></textarea></div></div>

          <div class='form-group'>
          <div class='col-sm-2'><label>Kunci Jawaban</label></div>  
          <div class='col-sm-5'> <label><input type=radio name='kunci' value=A>A</input></label>
                                            <label><input type=radio name='kunci' value=B>B</input></label>
                                            <label><input type=radio name='kunci' value=C>C</input></label>
                                            <label><input type=radio name='kunci' value=D>D</input></label>
                                             <label><input type=radio name='kunci' value=E>E</input></label>

             <small>Jumlah soal pilihan ganda di database";
                    if ($j[jml] == 0){
                        echo "<a href='?module=quiz&act=daftarquizpilganda&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> 0</blink></a></small>";
                    }else{
                        echo "<a href='?module=quiz&act=daftarquizpilganda&id=$_GET[id]' target='_blank' title='Lihat Daftar Soal' class='btn btn-info'><blink> $j[jml]</blink></a></small>";
                    }
        echo"</div</div></div> <div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'><input type=hidden name=id value='$_GET[id]'></div></div>
        
          <div class='form-group'>
          <div class='col-sm-2'></div>
          <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
          </form></section>";
    }
    break;

case "daftarquiz":
    if ($_SESSION[leveluser]=='admin'){
        $topik=mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
        $t=mysql_fetch_array($topik);
        echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
          <div class='col-sm-5'>
          <p align=center'>
          <input type=button class='btn btn-danger' value='Daftar Quiz Esay' onclick=\"window.location.href='?module=daftarquizesay&act=daftarquizesay&id=$t[id_tq]';\"> 
          <input type=button class='btn btn-warning' value='Daftar Quiz Pilihan Ganda' onclick=\"window.location.href='?module=daftarquizpilganda&act=daftarquizpilganda&id=$t[id_tq]';\">
          </p>
          <br><input type=button class='btn btn-primary' value=Kembali onclick=self.history.back()>
          </div></div></div>";
    }
    else{
        $topik=mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$_GET[id]'");
        $t=mysql_fetch_array($topik);
        echo " <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Daftar Quiz
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
           <div class='col-sm-8'>
          <p align=center'>
          <input class='btn btn-danger' type=button value='Daftar Quiz Esay' onclick=\"window.location.href='?module=daftarquizesay&act=daftarquizesay&id=$t[id_tq]';\">
          <input class='btn btn-warning' type=button value='Daftar Quiz Pilihan Ganda' onclick=\"window.location.href='?module=daftarquizpilganda&act=daftarquizpilganda&id=$t[id_tq]';\">
          </p>
  <br><input type=button class='btn btn-primary' value=Kembali onclick=self.history.back()></div></section>
          ";
    }
    break;

case "daftarquizesay":
    if ($_SESSION[leveluser]=='admin'){
        $cek = mysql_query("SELECT COUNT(quiz_esay.id_quiz) as jml FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $c = mysql_fetch_array($cek);
        if ($c[jml] != 0){
        $quiz=mysql_query("SELECT * FROM quiz_esay WHERE id_tq = '$_GET[id]'");        
        $jquiz = mysql_query("SELECT * FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $jq = mysql_fetch_array($jquiz);
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$jq[id_tq]'");
        $t=mysql_fetch_array($topik);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$t[id_kelas]'");
        $k=mysql_fetch_array($kelas);
        $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$t[id_matapelajaran]'");
        $p = mysql_fetch_array($pelajaran);

        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
            <form class='form-horizontal form-groups-bordered'>
              <div class='form-group'>
          <div class='col-sm-2'><label>Judul</label></div>           <div class='col-sm-5'> $t[judul]</div></div>
             <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>           <div class='col-sm-5'> $k[nama]</div></div>
               <div class='form-group'>
          <div class='col-sm-2'><label>Mata Pelajaran</label></div>  <div class='col-sm-5'> $p[nama]</div></div>
              ";
        echo " <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'><input class='btn btn-danger' type=button value='Tambah Quiz Esay' onclick=\"window.location.href='?module=quiz&act=buatquizesay&id=$jq[id_tq]';\">
              <input class='btn btn-primary' type=button value=Kembali onclick=\"window.location.href='?module=quiz';\"></div></div></form>";

        echo "<br><br><table class='table table-bordered table-responsive'><thead>
          <tr><th>No</th><th>Pertanyaan</th><th>Gambar</th><th>Tgl Buat</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($q=mysql_fetch_array($quiz)){
       $tgl_buat   = tgl_indo($q[tgl_buat]);
       echo "<tr><td>$no</td>
             <td>$q[pertanyaan]</td>
             <td>$q[gambar]</td>
             <td>$tgl_buat</td>
             <td><a href='?module=quiz&act=editquizesay&id=$q[id_quiz]&id_topik=$q[id_tq]' class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=javascript:confirmdelete('$aksi?module=quiz&act=hapusquizesay&id=$q[id_quiz]&id_topik=$q[id_tq]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a>
                 </td></tr>";
      $no++;
    }
    echo "</table></div></div></div>";
        }else{
            echo "<script>window.alert('Quiz esay masih kosong');
            window.location=(href='?module=quiz')</script>";
        }
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $cek = mysql_query("SELECT COUNT(quiz_esay.id_quiz) as jml FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $c = mysql_fetch_array($cek);
        if ($c[jml] != 0){
        $quiz=mysql_query("SELECT * FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $jquiz = mysql_query("SELECT * FROM quiz_esay WHERE id_tq = '$_GET[id]'");
        $jq = mysql_fetch_array($jquiz);
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$jq[id_tq]'");
        $t=mysql_fetch_array($topik);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$t[id_kelas]'");
        $k=mysql_fetch_array($kelas);
        $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$t[id_matapelajaran]'");
        $p = mysql_fetch_array($pelajaran);

        echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Daftar Quiz Esay
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          
      <form class='form-horizontal form-groups-bordered'>
         
<div class='form-group'>
          <div class='col-sm-2'>
              <label>Judul</label></div>           <div class='col-sm-5'>: $t[judul]</div></div>
              <div class='form-group'>
          <div class='col-sm-2'>
          <label>Kelas</label></div>           <div class='col-sm-5'>: $k[nama]</div></div>
             <div class='form-group'>
          <div class='col-sm-2'><label>Mata Pelajaran</label></div>  <div class='col-sm-5'>: $p[nama]</div></div>
              </form>";
        echo "<input class='btn btn-danger' type=button value='Tambah Quiz Esay' onclick=\"window.location.href='?module=buatquizesay&act=buatquizesay&id=$jq[id_tq]';\">
              <input class='btn btn-primary' type=button value=Kembali onclick=\"window.location.href='?module=quiz';\">";

        echo "<br><br><table class='table table-bordered table-responsive'><thead>
          <tr><th>No</th><th>Pertanyaan</th><th>Gambar</th><th>Tgl Buat</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($q=mysql_fetch_array($quiz)){
       $tgl_buat   = tgl_indo($q[tgl_buat]);
       echo "<tr><td>$no.</td>
             <td>$q[pertanyaan]</td>
             <td>$q[gambar]</td>
             <td>$tgl_buat</td>
             <td><a href='?module=quiz&act=editquizesay&id=$q[id_quiz]&id_topik=$q[id_tq]' class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=javascript:confirmdelete('$aksi?module=quiz&act=hapusquizesay&id=$q[id_quiz]&id_topik=$q[id_tq]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a>
                 </td></tr>";
      $no++;
    }
    echo "</table></div></section>";
        }else{
            echo "<script>window.alert('Quiz esay masih kosong');
            window.location=(href='?module=quiz')</script>";
        }
    }
    break;

case "daftarquizpilganda":
    if ($_SESSION[leveluser]=='admin'){
        $cek = mysql_query("SELECT COUNT(quiz_pilganda.id_quiz) as jml FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $c = mysql_fetch_array($cek);
        if ($c[jml] != 0){
        $quiz=mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $jquiz = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $jq = mysql_fetch_array($jquiz);
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$jq[id_tq]'");
        $t=mysql_fetch_array($topik);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$t[id_kelas]'");
        $k=mysql_fetch_array($kelas);
        $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$t[id_matapelajaran]'");
        $p = mysql_fetch_array($pelajaran);

        echo "<div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
           <form class='form-horizontal form-groups-bordered'>
              <div class='form-group'>
          <div class='col-sm-2'><label>Judul</label></div>          <div class='col-sm-5'> $t[judul]</div></div>
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Kelas</label></div>          <div class='col-sm-5'> $k[nama]</div></div>
              
              <div class='form-group'>
          <div class='col-sm-2'>
          <label>Mata Pelajaran</label></div> <div class='col-sm-5'>$p[nama]</div></div>";
        echo "<div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'><input type=button class='btn btn-danger' value='Tambah Quiz Pilihan ganda' onclick=\"window.location.href='?module=quiz&act=buatquizpilganda&id=$jq[id_tq]';\">
              <input type=button class='btn btn-primary' value=Kembali onclick=\"window.location.href='?module=quiz';\"></div></div></form>";
    echo "<br><br><table  id='example1' class='table table-bordered table-striped'>
    <thead>
    
    <tr>
    <th>No</th>
    <th>Pertanyaan</th>
    <th>Gambar</th>
    <th>Aksi</th>
    </tr>
    </thead>";
    $no=1;
    while ($q=mysql_fetch_array($quiz)){
       echo "<tr><td><b>$no.</b></td>
             <td>$q[pertanyaan]</td>";
             if (empty($q[gambar])){
                 echo "<td> Tidak ada gambar.</td>";
             }else{
                 echo "<td>
                    <img src='../foto_soal_pilganda/medium_$q[gambar]'>
                   
		  </td>";
             }
             echo"
             <td><a href='?module=quiz&act=editquizpilganda&id=$q[id_quiz]&id_topik=$q[id_tq]' class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit
</a> |
                 <a href=javascript:confirmdelete('$aksi?module=quiz&act=hapusquizpilganda&id=$q[id_quiz]&id_topik=$q[id_tq]') class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></td></tr>
             ";
      $no++;
    }
    echo "</table>";
    echo "</div></div></div>";
    }else{
            echo "<script>window.alert('Quiz pilihan ganda masih kosong');
            window.location=(href='?module=quiz')</script>";
        }
    }
    else{
        $cek = mysql_query("SELECT COUNT(quiz_pilganda.id_quiz) as jml FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $c = mysql_fetch_array($cek);
        if ($c[jml] != 0){
        $quiz=mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $jquiz = mysql_query("SELECT * FROM quiz_pilganda WHERE id_tq = '$_GET[id]'");
        $jq = mysql_fetch_array($jquiz);
        $topik = mysql_query("SELECT * FROM topik_quiz WHERE id_tq = '$jq[id_tq]'");
        $t=mysql_fetch_array($topik);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$t[id_kelas]'");
        $k=mysql_fetch_array($kelas);
        $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$t[id_matapelajaran]'");
        $p = mysql_fetch_array($pelajaran);

        echo "<section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Daftar Quiz Pilihan Ganda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
            <form class='form-horizontal form-groups-bordered'>
              <div class='form-group'>
          <div class='col-sm-2'><label>Judul</label></div>          <div class='col-sm-5'> $t[judul]</div></div>
              <div class='form-group'>
          <div class='col-sm-2'><label>Kelas</label></div>          <div class='col-sm-5'> $k[nama]</div></div>
              <div class='form-group'>
          <div class='col-sm-2'><label>Mata Pelajaran</label></div> <div class='col-sm-5'> $p[nama]</div></div>";
        echo "<div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'><input type=button class='btn btn-danger' value='Tambah Quiz Pilihan ganda' onclick=\"window.location.href='?module=quiz&act=buatquizpilganda&id=$jq[id_tq]';\">
              <input type=button class='btn btn-primary' value=Kembali onclick=\"window.location.href='?module=quiz';\"></div></div></form>";

       echo "<br><br><table  id='example1' class='table table-bordered table-striped'>
    <thead>
   
    <tr>
    <th>No</th>
    <th>Pertanyaan</th>
    <th>Gambar</th>
    <th>Aksi</th>
    </tr>
    </thead>";
    $no=1;
    while ($q=mysql_fetch_array($quiz)){
       echo "<tr><td><b>$no.</b></td>
             <td>$q[pertanyaan]</td>";
             if (empty($q[gambar])){
                 echo "<td>Tidak ada gambar</td>";
             }else{
                 echo "<td>
                    
                    <img src='../foto_soal_pilganda/medium_$q[gambar]'>
                  </td>";
             }
             echo"
             <td><a href='?module=quiz&act=editquizpilganda&id=$q[id_quiz]&id_topik=$q[id_tq]' class='btn btn-warning btn-sm btn-icon icon-left' title='Edit'><i class='entypo-pencil'></i>
              Edit</a> |
                 <a href=javascript:confirmdelete('$aksi?module=quiz&act=hapusquizpilganda&id=$q[id_quiz]&id_topik=$q[id_tq]')  class='btn btn-danger btn-sm btn-icon icon-left'
              title='Hapus'> <i class='entypo-cancel'></i>
              Delete</a></td></tr>
             ";
      $no++;
    }
    echo "</table></div></section>";
    }else{
            echo "<script>window.alert('Quiz pilihan ganda masih kosong');
            window.location=(href='?module=quiz')</script>";
        }
    }
    break;

case "editquizesay":
    if ($_SESSION[leveluser]=='admin'){
        $quiz=mysql_query("SELECT * FROM quiz_esay WHERE id_quiz = '$_GET[id]'");
        $q = mysql_fetch_array($quiz);     

        echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

        <form method=POST action='$aksi?module=quiz&act=edit_quizesay' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
        <input type=hidden name=id value='$q[id_quiz]'>
        <input type=hidden name=topik value='$_GET[id_topik]'>
       
          <div class='form-group'>
          <div class='col-sm-2'><label>Pertanyaan</label></div> 
          <div class='col-sm-10'><textarea name='pertanyaan' class='form-control ckeditor' cols=75 rows=3>$q[pertanyaan]</textarea></div></div>
          
          <div class='form-group'>
          <div class='col-sm-2'>
          <label>Gambar</label></div>     <div class='col-sm-5'>";
                    if ($q[gambar]!=''){
                        echo "
                    <img src='../foto_soal/medium_$q[gambar]'></div>
                    ";
                    }else{
                        echo "Tidak Ada Gambar</div>";
                    }
          echo"</div><div class='form-group'>
          <div class='col-sm-2'><label>Ganti Gambar</label></div> <div class='col-sm-5'> 
           <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
          <small>Jika gambar tidak diganti, dikosongkan saja.</small>
          <small>Tipe yang di ijinkan JPG dan JPEG</small></div></div>
         
         <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
          </form></div></div></div>";
    }
    else{
        $quiz=mysql_query("SELECT * FROM quiz_esay WHERE id_quiz = '$_GET[id]'");
        $q = mysql_fetch_array($quiz);

       echo "
      <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Edit Quiz Esay
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>
          
     
         
          <form method=POST action='$aksi?module=quiz&act=edit_quizesay' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
        <input type=hidden name=id value='$q[id_quiz]'>
        <input type=hidden name=topik value='$_GET[id_topik]'>
       
         <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pertanyaan</label></div> 
          <div class='col-sm-5'><textarea name='pertanyaan' class='form-control ckeditor' cols=75 rows=3>$q[pertanyaan]</textarea></div></div>
         <div class='form-group'>
          <div class='col-sm-2'>
          <label>Gambar</label></div>     <div class='col-sm-5'>";
                    if ($q[gambar]!=''){
                        echo "
                  
                    <img src='../foto_soal/medium_$q[gambar]'>
                    
                   </div>";
                    }else{
                        echo "Tidak Ada Gambar</div>";
                    }
          echo"</div>
           <div class='form-group'>
          <div class='col-sm-2'>
          <label>Ganti Gambar</label></div> 
          <div class='col-sm-5'>  <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
          <small>Jika gambar tidak diganti, dikosongkan saja.</small>
          <small>Tipe yang di ijinkan JPG dan JPEG</small>
          </div></div>
        <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Simpan>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></section>";
    }
    break;

case "editquizpilganda":
    if ($_SESSION[leveluser]=='admin'){
        $quiz=mysql_query("SELECT * FROM quiz_pilganda WHERE id_quiz = '$_GET[id]'");
        $q = mysql_fetch_array($quiz);
        echo " <div class='box box-warning'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 

          <form method=POST action='$aksi?module=quiz&act=edit_quizpilganda' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
        <input type=hidden name=id value='$q[id_quiz]'>
        <input type=hidden name=topik value='$_GET[id_topik]'>
      
       <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pertanyaan </label></div> 
          <div class='col-sm-10'>
          <textarea name='pertanyaan' class='form-control ckeditor' rows='3'>$q[pertanyaan]</textarea></div></div>
              <div class='form-group'>
          <div class='col-sm-2'><label>Gambar</label></div>  <div class='col-sm-5'>";
                    if ($q[gambar]!=''){
              echo "
                    <img src='../foto_soal_pilganda/medium_$q[gambar]'>
                   ";
             }else{
                 echo "Tidak ada gambar.";
             }
             echo "</div></div>
              <div class='form-group'>
          <div class='col-sm-2'><label>Ganti Gambar</label></div>            <div clas='col-sm-5'><
         <span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
             <small>Apabila gambar pertanyaan tidak diganti, di kosongkan saja</small>
             <small>Tipe gambar jang di ijinkan JPG dan JPEG</small></div></div>

              <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan A </label></div>        <div class='col-sm-8'><textarea name='pila' class='form-control ckeditor' cols='75' rows='3'>$q[pil_a]</textarea></div></div>

              <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan B </label></div>        <div class='col-sm-8'><textarea name='pilb' class='form-control ckeditor' cols='75' rows='3'>$q[pil_b]</textarea></div></div>

              <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan C </label></div>        <div class='col-sm-8'><textarea name='pilc' class='form-control ckeditor' cols='75' rows='3'>$q[pil_c]</textarea></div></div>

              <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan D </label></div>        <div class='col-sm-8'><textarea name='pild' class='form-control ckeditor' cols='75' rows='3'>$q[pil_d]</textarea></div></div>

              <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan D </label></div>        <div class='col-sm-8'><textarea name='pile' class='form-control ckeditor' cols='75' rows='3'>$q[pil_e]</textarea></div></div>
              <div class='form-group'>
          <div class='col-sm-2'><label>Kunci     </label></div>        <div class='col-sm-5'> ";
                    if($q[kunci]=='A'){
                        echo"<label><input type=radio name='kunci' value=A checked>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                              <label><input type=radio name='kunci' value=E>E</input></label></div></div>";
                    }
                    elseif($q[kunci]=='B'){
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B checked>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                              <label><input type=radio name='kunci' value=E>E</input></label>
                             </div></div>";
                    }
                    elseif($q[kunci]=='C'){
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C checked>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                              <label><input type=radio name='kunci' value=E>E</input></label></div></div>";
                    }
                    elseif($q[kunci]=='D'){
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D checked>D</input></label>
                              <label><input type=radio name='kunci' value=E>E</input></label></div></div>";
                    }

                     else{
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D >D</input></label>
                              <label><input type=radio name='kunci' value=E checked>E</input></label></div></div>";
                    }
          echo "
           <div class='form-group'>
          <div class='col-sm-2'></div> <div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div></div>
         </form></div></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
         $quiz=mysql_query("SELECT * FROM quiz_pilganda WHERE id_quiz = '$_GET[id]'");
        $q = mysql_fetch_array($quiz);
        echo "
        <section class='panel panel-primary'>
                        <header class='panel-heading'>
                          Edit Quiz Pilihan Ganda
                                                <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;'' class='fa fa-times'></a>
                            </span>
                        </header>
      
          <div class='panel-body'>

        <form method=POST action='$aksi?module=quiz&act=edit_quizpilganda' enctype='multipart/form-data' class='form-horizontal form-groups-bordered'>
        <input type=hidden name=id value='$q[id_quiz]'>
        <input type=hidden name=topik value='$_GET[id_topik]'>
       
             <div class='form-group'>
          <div class='col-sm-2'><label>Pertanyaan </label></div> <div class='col-sm-10'>
          <textarea name='pertanyaan'class='form-control ckeditor' required='required' cols='75' rows='3'>$q[pertanyaan]</textarea></div></div>
             <div class='form-group'>
          <div class='col-sm-2'><label>Gambar</label></div>  <div class='col-sm-5'>";
                    if ($q[gambar]!=''){
              echo "
                    <img src='../foto_soal_pilganda/medium_$q[gambar]'>
          
                    ";
             }else{
                 echo "Tidak ada gambar.";
             }
             echo "</div></div>
             <div class='form-group'>
          <div class='col-sm-2'><label>Ganti Gambar</label></div>           
           <div class='col-sm-5'><span class='btn btn-success fileinput-button'>
                                    <i class='glyphicon glyphicon-plus'></i>
                                    <span> Add Files..</span>
                                    <input type='file' name='fupload' multiple size=70>
                                    </span>
             <small>Apabila gambar pertanyaan tidak diganti, di kosongkan saja</small>
             <small>Tipe gambar jang di ijinkan JPG dan JPEG</small></div></div>

             <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan A </label></div>       
           <div class='col-sm-8'><textarea name='pila' class='form-control ckeditor' required='required' cols='75' rows='3'>$q[pil_a]</textarea></div></div>

             <div class='form-group'>
          <div class='col-sm-2'>
          <label>Pilihan B </label></div>        <div class='col-sm-8'>
          <textarea name='pilb' class='form-control ckeditor' required='required' cols='75' rows='3'>$q[pil_b]</textarea></div></div>

      <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan C </label></div>       
           <div class='col-sm-8'><textarea name='pilc' class='form-control ckeditor' required='required' cols='75' rows='3'>$q[pil_c]</textarea></div></div>

  <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan D </label></div>       
          <div class='col-sm-8'>
          <textarea name='pild' class='form-control ckeditor' required='required' cols='75' rows='3'>$q[pil_d]</textarea></div></div>

          <div class='form-group'>
          <div class='col-sm-2'><label>Pilihan E </label></div>       
          <div class='col-sm-8'>
          <textarea name='pile' class='form-control ckeditor' required='required' cols='75' rows='3'>$q[pil_e]</textarea></div></div>

            <div class='form-group'>
          <div class='col-sm-2'><label>Kunci     </label></div>        <div class='col-sm-5'>: ";
                    if($q[kunci]=='A'){
                        echo"<label><input type=radio name='kunci' value=A checked>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                             <label><input type=radio name='kunci' value=E>E</input></label></div>";
                    }
                    elseif($q[kunci]=='B'){
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B checked>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                             <label><input type=radio name='kunci' value=E>E</input></label></div>";
                    }
                    elseif($q[kunci]=='C'){
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C checked>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                             <label><input type=radio name='kunci' value=E>E</input></label></div>";
                    }
                    elseif($q[kunci]=='D'){
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D checked>D</input></label>
                             <label><input type=radio name='kunci' value=E>E</input></label></div>";
                    }
                    else{
                        echo"<label><input type=radio name='kunci' value=A>A</input></label>
                             <label><input type=radio name='kunci' value=B>B</input></label>
                             <label><input type=radio name='kunci' value=C>C</input></label>
                             <label><input type=radio name='kunci' value=D>D</input></label>
                             <label><input type=radio name='kunci' value=E checked>E</input></label></div>";
                    }
          echo "</div>
        <div class='form-group'>
          <div class='col-sm-2'></div><div class='col-sm-5'>
          <input class='btn btn-success' type=submit value=Update>
          <input class='btn btn-primary' type=button value=Batal onclick=self.history.back()>
          </div</div>
          </form></div></section>";
    }
    break;

}
}
?>
