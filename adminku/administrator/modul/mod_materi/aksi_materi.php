<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND empty($_SESSION['leveluser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/library.php";
include "../../../configurasi/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='materi' AND $act=='input_materi'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $direktori_file = "../../../files_materi/$nama_file";

  $extensionList = array("zip", "rar", "doc", "docx", "ppt", "pptx", "pdf");
  $pecah = explode(".", $nama_file);
  $ekstensi = $pecah[1];


  //cari pembuat
  $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_POST[id_matapelajaran]'");
  $data_mapel = mysql_fetch_array($pelajaran);
  $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$data_mapel[id_pengajar]'");
  $cek_pengajar = mysql_num_rows($pengajar);
  if(!empty($cek_pengajar)){
  // Apabila ada file yang diupload
  if (!empty($lokasi_file)){
  
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=materi&act=tambahmateri')</script>";
            }
      elseif (!in_array($ekstensi, $extensionList)){
               
                echo "<script>window.alert('Tipe file tidak diijinkan');
                window.location=('../../media_admin.php?module=materi&act=tambahmateri')</script>";
        }
        else{
                    UploadFile($nama_file);
                    mysql_query("INSERT INTO file_materi(judul,
                                    id_kelas,
                                    id_matapelajaran,
                                    nama_file,
                                    tgl_posting,
                                    pembuat)
                            VALUES('$_POST[judul]',
                                   '$_POST[id_kelas]',
                                   '$_POST[id_matapelajaran]',
                                   '$nama_file',
                                   '$tgl_sekarang',
                                    '$data_mapel[id_pengajar]')");
                    header('location:../../media_admin.php?module='.$module);
            }

    }
  else{
    mysql_query("INSERT INTO file_materi(judul,                                    
                                    id_kelas,
                                    id_matapelajaran,
                                    tgl_posting,
                                    pembuat)
                            VALUES('$_POST[judul]',                                   
                                   '$_POST[id_kelas]',
                                   '$_POST[id_matapelajaran]',
                                   '$tgl_sekarang',
                                    '$data_mapel[id_pengajar]')");
  header('location:../../media_admin.php?module='.$module);
  }
  }else{
      // Apabila ada file yang diupload
  if (!empty($lokasi_file)){

      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=materi&act=tambahmateri')</script>";
            }
      elseif (!in_array($ekstensi, $extensionList)){

                echo "<script>window.alert('Tipe file tidak diijinkan');
                window.location=('../../media_admin.php?module=materi&act=tambahmateri')</script>";
        }
        else{
                    UploadFile($nama_file);
                    mysql_query("INSERT INTO file_materi(judul,
                                    id_kelas,
                                    id_matapelajaran,
                                    nama_file,
                                    tgl_posting,
                                    pembuat)
                            VALUES('$_POST[judul]',
                                   '$_POST[id_kelas]',
                                   '$_POST[id_matapelajaran]',
                                   '$nama_file',
                                   '$tgl_sekarang',
                                   '$_SESSION[leveluser]')");
                    header('location:../../media_admin.php?module='.$module);
            }

    }
  else{
    mysql_query("INSERT INTO file_materi(judul,
                                    id_kelas,
                                    id_matapelajaran,
                                    tgl_posting,
                                    pembuat)
                            VALUES('$_POST[judul]',
                                   '$_POST[id_kelas]',
                                   '$_POST[id_matapelajaran]',
                                   '$tgl_sekarang',
                                   '$_SESSION[leveluser]')");
  header('location:../../media_admin.php?module='.$module);
  }
}
}

elseif($module=='materi' AND $act=='edit_materi'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $direktori_file = "../../../files_materi/$nama_file";

  $extensionList = array("zip", "rar", "doc", "docx", "ppt", "pptx", "pdf");
  $pecah = explode(".", $nama_file);
  $ekstensi = $pecah[1];


  //cari pembuat
  $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_POST[id_matapelajaran]'");
  $data_mapel = mysql_fetch_array($pelajaran);
  $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$data_mapel[id_pengajar]'");
  $cek_pengajar = mysql_num_rows($pengajar);
  if(!empty($cek_pengajar)){
  // Apabila ada file yang diupload
  if (!empty($lokasi_file)){

    if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=materi')</script>";}
            else{
                if(!in_array($ekstensi, $extensionList)){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=materi')</script>";
                }else{
                    $cek = mysql_query("SELECT * FROM file_materi WHERE id_file = '$_POST[id]'");
                    $r = mysql_fetch_array($cek);
                    if(!empty($r[nama_file])){
                    $file = "../../../files_materi/$r[nama_file]";
                    unlink($file);

                    UploadFile($nama_file);
                    mysql_query("UPDATE file_materi SET judul = '$_POST[judul]',
                                    id_kelas = '$_POST[id_kelas]',
                                    id_matapelajaran = '$_POST[id_matapelajaran]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$data_mapel[id_pengajar]'
                            WHERE id_file = '$_POST[id]'");
                    header('location:../../media_admin.php?module='.$module);
                    }else{
                        UploadFile($nama_file);
                        mysql_query("UPDATE file_materi SET judul = '$_POST[judul]',
                                    id_kelas = '$_POST[id_kelas]',
                                    id_matapelajaran = '$_POST[id_matapelajaran]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$data_mapel[id_pengajar]'
                            WHERE id_file = '$_POST[id]'");
                        header('location:../../media_admin.php?module='.$module);
                    }
                }

    }

  }
  else{
    mysql_query("UPDATE file_materi SET judul = '$_POST[judul]',
                                    id_kelas = '$_POST[id_kelas]',
                                    id_matapelajaran = '$_POST[id_matapelajaran]',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$data_mapel[id_pengajar]'
                            WHERE id_file = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }
  }else{
        // Apabila ada file yang diupload
  if (!empty($lokasi_file)){

    if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=materi')</script>";}
            else{
                if(!in_array($ekstensi, $extensionList)){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=materi')</script>";
                }else{
                    $cek = mysql_query("SELECT * FROM file_materi WHERE id_file = '$_POST[id]'");
                    $r = mysql_fetch_array($cek);
                    if(!empty($r[nama_file])){
                    $file = "../../../files_materi/$r[nama_file]";
                    unlink($file);

                    UploadFile($nama_file);
                    mysql_query("UPDATE file_materi SET judul = '$_POST[judul]',
                                    id_kelas = '$_POST[id_kelas]',
                                    id_matapelajaran = '$_POST[id_matapelajaran]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$_SESSION[leveluser]'
                            WHERE id_file = '$_POST[id]'");
                    header('location:../../media_admin.php?module='.$module);
                    }else{
                        UploadFile($nama_file);
                        mysql_query("UPDATE file_materi SET judul = '$_POST[judul]',
                                    id_kelas = '$_POST[id_kelas]',
                                    id_matapelajaran = '$_POST[id_matapelajaran]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$_SESSION[leveluser]'
                            WHERE id_file = '$_POST[id]'");
                        header('location:../../media_admin.php?module='.$module);
                    }
                }

    }

  }
  else{
    mysql_query("UPDATE file_materi SET judul = '$_POST[judul]',
                                    id_kelas = '$_POST[id_kelas]',
                                    id_matapelajaran = '$_POST[id_matapelajaran]',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$_SESSION[leveluser]'
                            WHERE id_file = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }

  }
}


elseif($module=='materi' AND $act=='hapus'){
  $cek = mysql_query("SELECT * FROM file_materi WHERE id_file = '$_GET[id]'");
                    $r = mysql_fetch_array($cek);
                    if(!empty($r[nama_file])){
                    $file = "../../../files_materi/$r[nama_file]";
                    unlink($file);
                    
                    mysql_query("DELETE FROM file_materi WHERE id_file = '$_GET[id]'");
                    }
                    else{
                        mysql_query("DELETE FROM file_materi WHERE id_file = '$_GET[id]'");
                    }
  header('location:../../media_admin.php?module='.$module);

}
}
?>
