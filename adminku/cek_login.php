<?php
include "configurasi/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));
// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "Access not allowed";
}
else{
$login=mysql_query("SELECT * FROM siswa WHERE username_login='$username' AND password_login='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  include "timeout.php";
 setcookie($_SESSION[namauser]     = $r[username_login]);
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password_login];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[idsiswa]      = $r[id_siswa];
   $_SESSION[kelas]      = $r[id_kelas];
  $_SESSION[foto]      = $r[foto];
  // session timeout
  $_SESSION[login] = 1;
  timer();
	$sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();
  mysql_query("UPDATE siswa SET id_session='$sid_baru' WHERE username_login='$username'");
  $user = mysql_query("SELECT * FROM online WHERE id_siswa='$_SESSION[idsiswa]'");
  if (mysql_num_rows($user)== 0){
              $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
              $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
              $waktu   = time("U"); //
      mysql_query("INSERT INTO online (ip,id_siswa,tanggal,online)
                               VALUES ('$ip','$_SESSION[idsiswa]','$tanggal','Y')");
  }
  else{
     $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
     $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
     $waktu   = time("U"); //
     mysql_query("UPDATE online SET ip='$ip',tanggal='$tanggal',online='Y' WHERE id_siswa = '$_SESSION[idsiswa]'");
  }
  header('location:home');
}
else{
  header("location:../login_siswa.php?&log=2");
}
}
?>
