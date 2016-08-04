<?php
// Upload foto untuk pengajar
function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_pengajar/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  

  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}

// Upload foto untuk siswa
function UploadImage_siswa($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_siswa/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 50;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);


  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}

// Upload foto soal
function UploadImage_soal($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_soal/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im2);

}

// Upload foto soal pilganda
function UploadImage_soal_pilganda($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_soal_pilganda/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im2);
}

function UploadBanner($fupload_name){
  //direktori banner
  $vdir_upload = "../../../foto_banner/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}


// Upload file untuk file materi
function UploadFile($fupload_name){
  //direktori file
  $vdir_upload = "../../../files_materi/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}


// Upload gambar untuk album galeri foto
function UploadAlbum($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../img_album/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 120 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 120;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


// Upload gambar untuk galeri foto
function UploadGallery($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../img_galeri/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 100 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 100;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


// Upload gambar untuk sekilas info
function UploadLogo($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../setting_web/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 54 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 54;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


// Upload gambar untuk berita
function UploadBerita($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_berita/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height =90;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  

  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = 200;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}

function UploadGaleri($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_galeri/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  

  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = 200;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}

function UploadTentang($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_galeri/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 110;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  

  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 270;
  $dst_height2 = 200;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}


?>
