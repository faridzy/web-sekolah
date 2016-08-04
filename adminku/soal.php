<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "
 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
?>
<!DOCTYPE html>
<html>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <title>Halaman Siswa</title>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />     
    <!-- Font Awesome Icons -->
     <link href="plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
     <link href="plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
     <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />



   <!-- DATATABLES -->
   <link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />   

   <link href="plugins/datatables/extensions/Responsive/css/responsive.dataTables.css" rel="stylesheet" type="text/css" />
     <!-- DATATABLES -->

   
    <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

   <link href="dist/css/ando_admin.css" rel="stylesheet" type="text/css" />

 <link href='plugins/jquery-ui-1.11.4/jquery-ui.min.css' rel='stylesheet' type='text/css'> 
     <link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload.css">
    <link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload-ui.css">
    <noscript>
        <link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload-noscript.css">
    </noscript>
    <noscript>
        <link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload-ui-noscript.css">
    </noscript>
      <link href="plugins/datepicker/datepicker.css" rel="stylesheet">  
 <style type="text/css">

 .btn {
  display: inline-block;
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px;
  font-size: 13px;
  line-height: 1.42857143;
  border-radius: 3px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}
.btn:focus {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}
.btn:hover,
.btn:focus {
  color: #333333;
  text-decoration: none;
}
.btn:active,
.btn.active {
  outline: 0;
  background-image: none;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.btn.disabled,
.btn[disabled],
fieldset[disabled] .btn {
  cursor: not-allowed;
  pointer-events: none;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
  box-shadow: none;
}
.btn-default {
  color: #333333;
  background-color: #ffffff;
  border-color: #cccccc;
}
</style>

    <script>$.noConflict();</script>
    <script>
var waktunya;
waktunya = <?php echo "$_POST[waktu]"; ?>;
var waktu;
var jalan = 0;
var habis = 0;
function init(){
    checkCookie()
    mulai();
}
function keluar(){
    if(habis==0){
        setCookie('waktux',waktu,365);
    }else{
        setCookie('waktux',0,-1);
    }
}
function mulai(){
    jam = Math.floor(waktu/3600);
    sisa = waktu%3600;
    menit = Math.floor(sisa/60);
    sisa2 = sisa%60
    detik = sisa2%60;
    if(detik<10){
        detikx = "0"+detik;
    }else{
        detikx = detik;
    }
    if(menit<10){
        menitx = "0"+menit;
    }else{
        menitx = menit;
    }
    if(jam<10){
        jamx = "0"+jam;
    }else{
        jamx = jam;
    }
    document.getElementById("divwaktu").innerHTML = jamx+" H : "+menitx+" M : "+detikx +" S";
    waktu --;
    if(waktu>0){
        t = setTimeout("mulai()",1000);
        jalan = 1;
    }else{
        if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
        document.getElementById("formulir").submit();
    }
}
function selesai(){    
    if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
    document.getElementById("formulir").submit();
}
function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}
function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}
function checkCookie(){
    waktuy=getCookie('waktux');
    if (waktuy!=null && waktuy!=""){
        waktu = waktuy;
    }else{
        waktu = waktunya;
        setCookie('waktux',waktunya,7);
    }
}
</script>
<script type="text/javascript">
    window.history.forward();
    function noBack(){ window.history.forward(); }
</script>
<script type="text/javascript">
function tombol()
{
document.getElementById("tombol").innerHTML= "<input type=button class='btn btn-success' value=Simpan onclick=selesai()>";
}
</script>
</head>

<body class="skin-blue sidebar-mini" onload="init(),noBack();" onpageshow="if (event.persisted) noBack();" onunload="keluar()">
     <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>R</b>PL</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Siswa</b>RPL</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
             
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <?php 
                  echo "<img src='foto_siswa/medium_$_SESSION[foto]' class='user-image' alt='User Image'>";?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"> <?php echo "$_SESSION[namalengkap]";?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                  <?php 
                  echo "<img src='foto_siswa/medium_$_SESSION[foto]' class='img-circle' alt='User Image'>";?>
                    <p>
                      <?php echo "$_SESSION[namalengkap]";?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php echo "
                      <a href='media.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]' class='btn btn-default btn-flat'>Profile</a>
                    </div>
                    <div class='pull-right'>
                      <a href='logout.php' class='btn btn-default btn-flat'>Sign out</a>
                    </div>";
                    ?>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
  
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
             <?php 
                  echo "<img src='foto_siswa/medium_$_SESSION[foto]' class='img-circle' alt='User Image'>";?>
            </div>
            <div class="pull-left info">
              <p><?php echo "$_SESSION[namalengkap]";?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Menu Lerning</li>



            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="home"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
            

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Menu Utama</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                   <li>
                            <a href="media.php?module=kelas">
                                <i class='fa fa-circle-o'></i><span class="title">Kelas Kamu</span>
                            </a>
                        </li>
                        <li>
                            <a href="media.php?module=matapelajaran">
                               <i class='fa fa-circle-o'></i> <span class="title">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="media.php?module=materi">
                               <i class='fa fa-circle-o'></i> <span class="title">Materi</span>
                            </a>
                        </li>
                        <li>
                            <a href="media.php?module=quiz">
                                <i class='fa fa-circle-o'></i><span class="title">Tugas/Quiz</span>
                            </a>
                            
                        </li>
                        <li>
                            <a href="media.php?module=nilai">
                                <i class='fa fa-circle-o'></i><span class="title">Nilai</span>         
                            </a>
                     </li>
                </ul>
            </li>
          <li class="header">Account</li>
          <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Account Kamu</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                   <?php echo "
                        <li>
                            <a href='media.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]'>
                                 <i class='fa fa-circle-o'></i><span class='title'>Detail Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href='media.php?module=siswa&act=detailaccount'>
                                 <i class='fa fa-circle-o'></i><span class='title'>Edit Password</span>
                            </a>
                        </li>";
                        ?>
                </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
  <section class="content-header"><h1>
          Sisa Waktu
            <small><button class='btn btn-info'><div id='divwaktu'></div></button></small>
          </h1>
          </section>

        <!-- Main content -->
        <section class="content">

   

<div class='box box-primary'>
        <div class='box-header with-border'>
          <div class='col-md-12 col-xs-12'> 
<form action=nilai.php method=post id=formulir>
<?php
include "configurasi/koneksi.php";
$cek_siswa = mysql_query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_tq='$_POST[id]' AND id_siswa='$_SESSION[idsiswa]'");
$info_siswa = mysql_fetch_array($cek_siswa);
if ($info_siswa[hits]<= 0){
    mysql_query("INSERT INTO siswa_sudah_mengerjakan (id_tq,id_siswa,hits)
                                        VALUES ('$_POST[id]','$_SESSION[idsiswa]',hits+1)");
}
elseif ($info_siswa[hits] > 0){
}
$soal = mysql_query("SELECT * FROM quiz_pilganda where id_tq='$_POST[id]' ORDER BY rand()");
$pilganda = mysql_num_rows($soal);
$soal_esay = mysql_query("SELECT * FROM quiz_esay WHERE id_tq='$_POST[id]'");
$esay = mysql_num_rows($soal_esay);
if (!empty($pilganda) AND !empty($esay)){
echo "<br><b class='judul'>Daftar Soal Pilihan Ganda</b><br><p class='garisbawah'></p>
      <table class='table table-form' style='font-size: 16px'>
        <tbody>
            <input type=hidden name=id_topik value='$_POST[id]'>";
$no = 1;
while($s = mysql_fetch_array($soal)){
    if ($s[gambar]!=''){
    echo "<tr><td style='v-align: top'>$no.</td><td colspan='2'>".$s['pertanyaan']."</td>";
    echo "<td></td><td></td><img src='foto_soal_pilganda/medium_$s[gambar]' class='img-rounded'></td>";    
    echo "<td><p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='A'>A. ".$s['pil_a']."</p>";
    echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='B'>B. ".$s['pil_b']."</p>";
    echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='C'>C. ".$s['pil_c']."</p>";
    echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='D'>D. ".$s['pil_d']."</p>";
     echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='E'>E. ".$s['pil_e']."</p></td></tr>";
    }else{
        echo "<tr><td><h3>$no.</h3></td><td><h3>".$s['pertanyaan']."</h3></td>";        
        echo "<p><td><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='A'>A. ".$s['pil_a']."</p>";
        echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='B'>B. ".$s['pil_b']."</p>";
        echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='C'>C. ".$s['pil_c']."</p>";
        echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='D'>D. ".$s['pil_d']."</p>";
         echo "<p><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='E'>E. ".$s['pil_e']."</p></td></tr>";
    }
    $no++;
}
echo "</table>";
echo "<br><b class='judul'>Daftar Soal Essay</b><br><p class='garisbawah'></p>
    <table>";
$no2=1;
while($e=  mysql_fetch_array($soal_esay)){
    if (!empty($e[gambar])){
    echo "<tr><td rowspan=4><h3>$no2.</h3></td><td><h3>".$e['pertanyaan']."</h3></td></tr>";
    echo "<tr><td><img src='foto_soal/medium_$e[gambar]'></td></tr>";
    echo "<tr><td>Jawaban : </td></tr>";
    echo "<tr><td><textarea name=soal_esay[".$e['id_quiz']."]  class='form-control ckeditor' cols=95 rows=5></textarea></td></tr>";
    }else{
        echo "<tr><td rowspan=3><h3>$no2.</h3></td><td><h3>".$e['pertanyaan']."</h3></td></tr>";
        echo "<tr><td>Jawaban : </td></tr>";
        echo "<tr><td><textarea name=soal_esay[".$e['id_quiz']."] cols=95 rows=5></textarea></td></tr>";
    }
    $no2++;
}
echo "</table>";
$jumlahsoal = $no - 1;
echo "<input type=hidden name=jumlahsoalpilganda value=$jumlahsoal>";
}
elseif (!empty($pilganda) AND empty($esay)){
    echo "<br><b class='judul'>Daftar Soal Pilihan Ganda</b><br><p class='garisbawah'></p>
      <table class='table table-form' style='font-size: 16px'>
        <tbody>
        <input type=hidden name=id_topik value='$_POST[id]'>";
$no = 1;
while($s = mysql_fetch_array($soal)){
    if ($s[gambar]!=''){
     echo "<tr><td style='v-align: top'>$no.</td><td colspan='2'>".$s['pertanyaan']."</td></tr>";
    echo "<tr><td width='1%'></td> <td></td><td><img src='foto_soal_pilganda/medium_$s[gambar]' class='imh-rounded'></td></tr>";
    echo "<tr><td width='1%'>A</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='A'></td><td> ".$s['pil_a']."</td></tr>";
    echo "<tr><td width='1%'>B</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='B'></td><td> ".$s['pil_b']."</td></tr>";
    echo "<tr><td width='1%'>C</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='C'></td><td> ".$s['pil_c']."</td></tr>";
    echo "<tr><td width='1%'>D</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='D'></td><td> ".$s['pil_d']."</td></tr>";
     echo "<tr><td width='1%'>E</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='E'></td><td> ".$s['pil_e']."</td></tr>";
    }else{
        echo "<tr><td style='v-align: top'>$no.</td><td colspan='2'>".$s['pertanyaan']."</td></tr>";
        echo "<tr><td width='1%'>A</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='A'></td><td> ".$s['pil_a']."</td></tr>";
        echo "<tr><td width='1%'>B</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='B'></td><td> ".$s['pil_b']."</td></tr>";
        echo "<tr><td width='1%'>C</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='C'></td><td> ".$s['pil_c']."</td></tr>";
        echo "<tr><td width='1%'>D</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='D'></td><td> ".$s['pil_d']."</td></tr>";
         echo "<tr><td width='1%'>E</td><td width='1%'><input type=radio name=soal_pilganda[".$s['id_quiz']."] value='E'></td><td> ".$s['pil_e']."</td></tr>";
    }
    $no++;
}
echo "</table>";
$jumlahsoal = $no - 1;
echo "<input type=hidden name=jumlahsoalpilganda value=$jumlahsoal>";
}
elseif (empty($pilganda) AND !empty($esay)){
    echo "<br><b class='judul'>Daftar Soal Essay</b><br><p class='garisbawah'></p>
    <table><input type=hidden name=id_topik value='$_POST[id]'>";
$no2=1;
while($e=  mysql_fetch_array($soal_esay)){
    if (!empty($e[gambar])){
    echo "<tr><td rowspan=4><h3>$no2.</h3></td><td><h3>".$e['pertanyaan']."</h3></td></tr>";
    echo "<tr><td><img src='foto_soal/medium_$e[gambar]'></td></tr>";
    echo "<tr><td>Jawaban : </td></tr>";
    echo "<tr><td><textarea name=soal_esay[".$e['id_quiz']."]  class='form-control ckeditor' cols=95 rows=10></textarea></td></tr>";
    }else{
        echo "<tr><td rowspan=3><h3>$no2.</h3></td><td><h3>".$e['pertanyaan']."</h3></td></tr>";
        echo "<tr><td>Jawaban : </td></tr>";
        echo "<tr><td><textarea name=soal_esay[".$e['id_quiz']."]   class='form-control ckeditor'cols=95 rows=10></textarea></td></tr>";
    }
    $no2++;
}
echo "</table>";
}
elseif (empty($pilganda) AND empty($esay)){
    echo "<script>window.alert('Maaf belum ada soal di Topik Ini.');
            window.location=(href='media.php?module=home')</script>";
}
?>
    <br/>
    <br/>
<p><h3>Apakah anda sudah yakin dengan jawaban anda dan ingin menyimpannya?  <button type=button class='btn btn-warning' onclick="tombol()">Ya</button></h3>
<h3 id="tombol"></h3></p>
</form>
</div></div></div>




        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Version 1.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">RPL SMK TI Ponorogo</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->











<script src="plugins/jQuery/jquery-1.12.0.min.js"></script> 


<script src="plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script> 
<script src="plugins/jquery.ui.touch-punch.min.js"></script> 

    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

  <!-- DATATABLES -->
    <script src="plugins/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/extensions/Responsive/js/responsive.bootstrap.js" type="text/javascript"></script>
  <!-- DATATABLES -->

  <!--isotope-->
    <script src="plugins/isotope.pkgd.min.js" type="text/javascript"></script>
    <script src="plugins/imagesloaded.pkgd.min.js" type="text/javascript"></script>
  <!--isotope-->
    <script src="plugins/isotope.pkgd.min.js" type="text/javascript"></script>
    <script src="plugins/chartJs/Chart.min.js" type="text/javascript"></script>
    <script src="plugins/chartJs/Chart.Bar.js" type="text/javascript"></script>
    <script src="dist/js/ando_admin.js" type="text/javascript"></script>
   <script src="dist/js/mosaicflow.min.js" type="text/javascript"></script>
<script src="plugins/file-uploader/js/vendor/jquery.ui.widget.js"></script>
<script src="plugins/file-uploader/js/jquery.fileupload.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.min.js"></script>
<script  src="plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script  src="plugins/ckeditor/adapters/jquery.js" type="text/javascript"></script>
 <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
</body>
</html>

<?php
}
?>