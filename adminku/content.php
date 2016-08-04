<?php
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='siswa'){
    ?>
    <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i>Pemberitahuan</h4>
                   <p>Cek apakah anda sudah mengerjakan tugas atau belum dan kerjakan dengan teliti <a href='media.php?module=quiz'> Cek disini</a></p>
                   
               
      
                  </div>
    <div class="row">
      <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id) AS JUMLAH FROM mata_pelajaran WHERE id_kelas='$_SESSION[kelas]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Mata Pelajaran</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-bookmark"></i>
                </div>
                <a href="media.php?module=matapelajaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-orange">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_file) AS JUMLAH FROM file_materi WHERE id_kelas='$_SESSION[kelas]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>File Materi</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-camera"></i>
                </div>
                <a href="media.php?module=materi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_siswa) AS JUMLAH FROM siswa WHERE id_kelas='$_SESSION[kelas]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Teman</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-compass"></i>
                </div>
                <a href="media.php?module=kelas" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id) AS JUMLAH FROM mata_pelajaran WHERE id_kelas='$_SESSION[kelas]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Guru Pengajar</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-bookmark"></i>
                </div>
                <a href="media.php?module=matapelajaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
    <div class="col-md-6">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Seputar E LEarning</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div style="display: block;" class="box-body">
                  <ul><p>E-Laerning RPL SMK TI versi Pertama</p></ul>
<ul><p>Anda bisa mengganti password dan username</p></ul>
<ul><p>Kerjakan Soal dengan teliti</b></ul>
                 
                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div>
                    <!-- ./col -->
    <div class="col-md-6">

              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Tujuan E-Learning</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div style="display: block;" class="box-body">
                  <ul><p>E-Learning adalah suatu cara untuk mengatasi solusi
Ketika para siswa sedang prakerin,dan di kondisi lain.</p></ul>
<ul><p>Dapat memperoleh informasi secara tepat dan cepat..</p></ul>
<ul><p>Meminalisir waktu dan efisiensi dalam pengajaran</b></ul>
                 
                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div>
             
          </div>

            <?php
  }
}
// Bagian kelas
elseif ($_GET['module']=='kelas'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_kelas/kelas.php";
  }
}
// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_siswa/siswa.php";
  }
}
// Bagian admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_admin/admin.php";
  }
}
// Bagian mapel
elseif ($_GET['module']=='matapelajaran'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_matapelajaran/matapelajaran.php";
  }
}
// Bagian materi
elseif ($_GET['module']=='materi'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_materi/materi.php";
  }
}
// Bagian materi
elseif ($_GET['module']=='quiz'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_quiz/quiz.php";
  }
}
// Bagian materi
elseif ($_GET['module']=='kerjakan_quiz'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_quiz/soal.php";
  }
}
// Bagian materi
elseif ($_GET['module']=='nilai'){
  if ($_SESSION['leveluser']=='siswa'){
      include "daftarnilai.php";
  }
}
?>
