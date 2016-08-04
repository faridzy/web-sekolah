
<?php
include "../configurasi/koneksi.php";
include "../configurasi/library.php";
include "../configurasi/fungsi_indotgl.php";
include "../configurasi/fungsi_combobox.php";
$aksi_kelas="modul/mod_kelas/aksi_kelas.php";
$aksi_mapel="modul/mod_matapelajaran/aksi_matapelajaran.php";
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
    ?>
<section class="content">
  
<div class="row">
            <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_berita) AS JUMLAH FROM berita");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Artikel Tersimpan</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-edit"></i>
                </div>
                <a href="?module=berita" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">

                  <?php
 $tam=mysql_query("SELECT COUNT(id_modul) AS JUMLAH FROM modul");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Modul</p>
               
                <?php 
              } ?>  
                 
                </div>
                <div class="icon">
                  <i class="ion ion-ios-browsers"></i>
                </div>
                <a href="?module=modul" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_galerifoto) AS JUMLAH FROM galeri_foto");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                 <h3><?php echo $tot; ?></h3>
                  <p>Galeri Foto</p>
               
                <?php 
              } ?>     
                </div>
                <div class="icon">
                  <i class="ion ion-images"></i>
                </div>
                <a href="?module=galeri" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                   <?php
 $tam=mysql_query("SELECT COUNT(id_statistik) AS JUMLAH FROM statistik");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                 <h3><?php echo $tot; ?></h3>
                  <p>Pengunjung</p>
               
                <?php 
              } ?> 
              </div>    
                <div class="icon">
                  <i class="ion ion-android-contact"></i>
                </div>
                <a href="?module=statistik" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          Baru Posting
        </div>
        <div class="box-body">

          <table class="table table-striped">

             <tbody><?php $ber=mysql_query("SELECT nama_berita,pembuat,dibaca,id_berita FROM berita ORDER BY id_berita DESC limit 5");
            while ($r=mysql_fetch_array($ber)) {
              ?>
             
            <tr><td><span class="badge badge-primary"><?php echo $r['dibaca']?>  kali</span> <?php echo" <a href='?module=berita&act=editpost&id=$r[id_berita]' style=''>"; ?><strong><?php echo $r['nama_berita'] ?></strong></a>
             <br><span class="label pull-right label-warning"><?php echo $r['pembuat']; ?></span>

               </td></tr>
                
            <?php
            }
            ?>
            </tbody>
            
            </table>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
        Hit Materi
        </div>
        <div class="box-body">
          <table class="table table-striped"> <tbody>
            <?php $ber=mysql_query("SELECT * FROM file_materi ORDER BY id_file DESC limit 5");
            while ($r=mysql_fetch_array($ber)) {
              ?>
           <tr><td><span class="badge badge-info"><?php echo $r['hits']?> download</span> <a href="?module=materi" style=""><strong><?php echo $r['nama_file'] ?></strong></a> 

               <br><span class="label pull-right label-info"><?php echo $r['id_kelas'];?></span>

               </td></tr>    
               <?php } ?>
                     </tbody></table>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-rocket"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Kelas </span>
          <span class="info-box-number"><?php
 $tam=mysql_query("SELECT COUNT(id_kelas) AS JUMLAH FROM kelas");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                <span><?php echo $tot; ?></span>
                <?php 
              } ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pelajaran</span>
          <span class="info-box-number"><?php
 $tam=mysql_query("SELECT COUNT(id) AS JUMLAH FROM mata_pelajaran");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                <span><?php echo $tot; ?></span>
                <?php  
              } ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Siswa</span>
          <span class="info-box-number"> <?php
 $tam=mysql_query("SELECT COUNT(id_siswa) AS JUMLAH FROM siswa");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                <span><?php echo $tot; ?></span>
                <?php
              } ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user-md"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pengajar</span>
          <span class="info-box-number"><?php
 $tam=mysql_query("SELECT COUNT(id_pengajar) AS JUMLAH FROM pengajar");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                <span><?php echo $tot; ?></span>
                <?php 
              } ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
 

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="box box-danger">
        <div class="box-header with-border">
          Prestasi
        </div>
        <div class="box-body">

          <table class="table table-striped">

             <tbody><?php $ber=mysql_query("SELECT nama_prestasi,pembuat,dibaca,id_prestasi FROM prestasi ORDER BY id_prestasi DESC limit 5");
            while ($r=mysql_fetch_array($ber)) {
              ?>
             
            <tr><td><span class="badge badge-info"><?php echo $r['dibaca']?> kali</span><?php echo" <a href='?module=prestasi&act=editprestasi&id=$r[id_prestasi]' style=''>"; ?><strong><?php echo $r['nama_prestasi'] ?></strong></a> 
             <br><span class="label pull-right label-success"><?php echo $r['pembuat']; ?></span>

               </td></tr>
                
            <?php
            }
            ?>
            </tbody>
            
            </table>
        </div>
        <div class="box-footer"></div>
      </div>

    </div>
     <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="box box-warning">
        <div class="box-header with-border">
         Registrasi
        </div>
        <div class="box-body">
          <table class='table table-bordered table-striped table-condensed cf'>
          <thead>
          
          <tr><th>No</th><th>NIS</th><th>Nama Lengkap</th><th>Kelas</th></tr></thead>
          <?php
          $sql=mysql_query("SELECT * FROM registrasi_siswa ORDER BY id_registrasi limit 8");
           $no=1;
          while($r=mysql_fetch_array($sql)){
              echo "<tr><td>$no.</td>
                        <td>$r[nis]</td>
                        <td>$r[nama_lengkap]</td>
                        ";
                        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'");
                        $k=mysql_fetch_array($kelas);
                        echo "<td>$k[nama]</td>
                    </tr>";
          }
          echo "</table>";

          ?>
        </div>
        <div class="box-footer">
      <a href='?module=registrasi' class='btn btn-warning'>Selengkapnya</a>
    </div>


      </div>
    </div>

    


     <!-- Main content -->
       

    



  
        </section>
  <?php
  }
  elseif ($_SESSION['leveluser']=='pengajar'){
    ?>
    <section class="content">
      <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    Warning alert preview. This alert is dismissable.
                  </div>
  
<div class="row">
            <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_kelas) AS JUMLAH FROM kelas WHERE id_pengajar = '$_SESSION[idpengajar]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Kelas Yang Anda Ampu</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-bookmark"></i>
                </div>
                <a href="?module=kelas" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
             <div class="col-lg-3 col-xs-6">


              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id) AS JUMLAH FROM mata_pelajaran WHERE id_pengajar = '$_SESSION[idpengajar]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Mata Pelajaran</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-happy"></i>
                </div>
                <a href="?module=matapelajaran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
             <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_file) AS JUMLAH FROM file_materi WHERE pembuat = '$_SESSION[idpengajar]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Materi</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-camera"></i>
                </div>
                <a href="?module=materi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col --><!-- ./col -->
             <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                  <?php
 $tam=mysql_query("SELECT COUNT(id_tq) AS JUMLAH FROM  topik_quiz WHERE pembuat = '$_SESSION[idpengajar]'");
 $r=mysql_fetch_array($tam);
 $tot=$r['JUMLAH']; { ?>
                   <h3><?php echo $tot; ?></h3>
                  <p>Topik Quiz</p>
               
                <?php 
              } ?>  
                </div>
                <div class="icon">
                  <i class="ion ion-coffee"></i>
                </div>
                <a href="?module=quiz" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col --><!-- ./col -->
          </div>
        </section>

    <?php
     $detail_pengajar=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_SESSION[idpengajar]'");
          $r=mysql_fetch_array($detail_pengajar);
          $tgl_lahir   = tgl_indo($r[tgl_lahir]);
          echo
   " <div class='box-header with-border'>
         
           <div class='col-md-3'>
              <div class='box box-info'>
                <div class='box-body box-profile'>
                  <img class='profile-user-img img-responsive img-responsive' src='../foto_pengajar/medium_$r[foto]' alt='User profile picture'>
                  <h3 class='profile-username text-center'>$r[nama_lengkap]</h3>
                  <p class='text-muted text-center'>$r[jabatan]</p>

                  <ul class='list-group list-group-unbordered'>
                    <li class='list-group-item'>
                      <b>Tempat Lahir</b> <a class='pull-right'>$r[tempat_lahir]</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Tgl. Lahir</b> <a class='pull-right'>$tgl_lahir</a>
                    </li>
                    <li class='list-group-item'>
                      <b>Agama</b> <a class='pull-right'>$r[agama]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Email</b> <a href='mailto:$r[email]' class='pull-right'>$r[email]</a>
                    </li>
                     <li class='list-group-item'>
                      <b>Website</b> <a href='http://$r[website]' target='_blank' class='pull-right'>$r[website]</a>
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
                      <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['nip'] ?> readonly=''>
                      </div>
                    </div>
       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['username_login'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php echo $r['no_telp'] ?> readonly=''>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value=
                        <?php if ($r['jenis_kelamin']=='P'){
           echo " Perempuan";
            }
            else{
           echo "Laki-laki";
            } ?> readonly=''>
                      </div>
                    </div>
 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Blokir</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value=<?php   if ($r[blokir]=='N'){
           echo "Tidak";
            }
            else{
           echo "Ya";
            } ?> readonly=''>
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
                 <p> <strong><i class='fa fa-map-marker margin-r-5'></i></strong>&nbsp;<?php echo $r['alamat'] ?></p>
                </div>
              </div>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Profil</h3>
                </div>
                <div class='box-body'>
                  <?php echo "
                 <p><input class='btn btn-info' type=button value='Edit Profil' onclick=\"window.location.href='?module=admin&act=editpengajar';\"></p>"; ?>
                </div>
              </div>
            </div>


<?php echo "

          
      </div>




  ";
         //kelas yang diampu
        
   }

 }
// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}
elseif ($_GET['module']=='setting'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_setting/setting.php";
  }
}
elseif ($_GET['module']=='kategoriberita'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategoriberita/kategori.php";
  }
}
elseif ($_GET['module']=='berita'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_berita/post.php";
  }
}
elseif ($_GET['module']=='tentang'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_tentang/tentang.php";
  }
}
elseif ($_GET['module']=='statistik'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_statistik/statistik.php";
  }
}
elseif ($_GET['module']=='komentar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_komentar/komentar.php";
  }
}
elseif ($_GET['module']=='kategoriprestasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategoriprestasi/kategoriprestasi.php";
  }
}
elseif ($_GET['module']=='prestasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_prestasi/prestasi.php";
  }
}
elseif ($_GET['module']=='galeri'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_galeri/galeri.php";
  }
}
// Bagian user admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}
// Bagian user admin
elseif ($_GET['module']=='detailpengajar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}
// Bagian kelas
elseif ($_GET['module']=='kelas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kelas/kelas.php";
  }
  elseif ($_SESSION['leveluser']=='pengajar'){
      include "modul/mod_kelas/kelas.php";
  }
  elseif ($_SESSION['leveluser']=='siswa'){
      include "modul/mod_kelas/kelas.php";
  }

}

// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}
// Bagian siswa
elseif ($_GET['module']=='daftarsiswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='detailsiswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}
// Bagian siswa
elseif ($_GET['module']=='detailsiswapengajar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}
// Bagian mata pelajaran
elseif ($_GET['module']=='matapelajaran'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_matapelajaran/matapelajaran.php";
  }
  else{
      include "modul/mod_matapelajaran/matapelajaran.php";
  }
}
// Bagian materi
elseif ($_GET['module']=='materi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_materi/materi.php";
  }else{
      include "modul/mod_materi/materi.php";
  }
}
// Bagian topik soal
elseif ($_GET['module']=='quiz'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}
// Bagian topik soal
elseif ($_GET['module']=='buatquiz'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}
// Bagian topik soal
elseif ($_GET['module']=='buatquizesay'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='buatquizpilganda'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}
// Bagian topik soal
elseif ($_GET['module']=='daftarquiz'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}
// Bagian topik soal
elseif ($_GET['module']=='daftarquizesay'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}
// Bagian topik soal
elseif ($_GET['module']=='daftarquizpilganda'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}
// Bagian Templates
elseif ($_GET['module']=='registrasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_registrasi/registrasi.php";
  }
}
?>
