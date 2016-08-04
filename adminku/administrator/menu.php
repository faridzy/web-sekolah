              <?php
include "../configurasi/koneksi.php";
if ($_SESSION['leveluser']=='admin'){
	echo"   <li class='header'>Menu Utama</li>
  <li class='active'><a href='?module=home'><i class='fa fa-dashboard'></i> <span>Dashboard</span></a> </li>
  <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-book'></i>
                    <span>Menu Utama</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>";
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo " 
                <li><a href='$m[link]'><i class='fa fa-circle-o'></i><span class='title'>$m[nama_modul]</span></a></li> 
               ";          
  }
  echo"<li><a href='?module=admin&act=pengajar'><i class='fa fa-circle-o'></i><span class='title'>Manajemen Pengajar</span></a></li> 
  <li><a href='?module=admin'><i class='fa fa-circle-o'></i><span class='title'>Manajeman Administrator</span></a></li> 
   <li><a href='?module=modul'><i class='fa fa-circle-o'></i><span class='title'>Manajemen Modul</span></a></li> 


   </ul>
  </li>";  
  echo"<li class='header'>Content Web</li>
   <li><a href='?module=setting'><i class='fa fa-toggle-on'></i>Setting Web</a></li>
  <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-pencil-square'></i>
                    <span>Berita</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>             
	<li><a href='?module=kategoriberita'><i class='fa fa-circle-o'></i>Kategori Berita</a></li>
<li><a href='?module=berita'><i class='fa fa-circle-o'></i>Berita</a></li>
                </ul>
            </li>
            <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-camera'></i>
                    <span>Galeri</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>            
  <li><a href='?module=galeri'><i class='fa fa-circle-o'></i>Galeri</a></li>           
                </ul>
            </li>
            <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-trophy'></i>
                    <span>Prestasi</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>          
  <li><a href='?module=kategoriprestasi'><i class='fa fa-circle-o'></i>Kategori Prestasi</a></li>   
  <li><a href='?module=prestasi'><i class='fa fa-circle-o'></i>Prestasi</a></li>                  
                </ul>
            </li>
             <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-home'></i>
                    <span>Tentang</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>          
  <li><a href='?module=tentang'><i class='fa fa-circle-o'></i>Tentang</a></li>                 
                </ul>
            </li>
            <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-comments'></i>
                    <span>Komentar</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>          
  <li><a href='?module=komentar'><i class='fa fa-circle-o'></i>Komentar</a></li>                 
                </ul>
            </li>
            <li class='header'>Statistik Pengunjung</li>
  <li class='treeview'>
                <a href='#'>
                    <i class='fa fa-plane'></i>
                    <span>Statistik</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>             
  <li><a href='?module=statistik'><i class='fa fa-circle-o'></i>Statistik</a></li>
                </ul>
            </li>
           "; 
} 
elseif ($_SESSION['leveluser']=='pengajar'){
  echo" <li class='header'>Menu Utama</li>
  <li class='active'><a href='?module=home'><i class='fa fa-dashboard'></i> <span>Dashboard</span></a> </li>
  <li class='treeview'>
                <a href='#' class='active'>
                    <i class='fa fa-bullhorn'></i>
                    <span>Menu Utama</span><i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class='treeview-menu'>";
  $sql=mysql_query("select * from modul where status='pengajar' and aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li><a href='$m[link]'><i class='fa fa-circle-o'></i><span class='title'>$m[nama_modul]</span></a></li>";
  }
  echo " </ul>
            </li>";
}
?>

 

  