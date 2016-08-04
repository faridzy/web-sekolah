<?php 
error_reporting(0); 
include "config/config.php";
     include "adminku/configurasi/fungsi_indotgl.php"; ?>
     <?php                  $id = mysql_real_escape_string($_GET['news']);    
						$sql=mysql_query("select * from v_berita where nama_beritaseo='$id'");
						$r=mysql_fetch_array($sql);
$title = strip_tags( $r['nama_berita']);
$keyword =strip_tags(time( $r['keyword']));
$admin =htmlentities(strip_tags($r['pembuat']));
$gambar=$r['gambar'];

						?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $keyword; ?>" />
	<meta name="keywords" content="<?PHP echo $keyword;?>" />
	<meta name="author" content="<?php echo $admin; ?>" />
	<title><?php echo $title; ?></title>
	<meta property="og:title" content="<?PHP echo $title?> | RPL SMK TI">
<meta property="og:type" content="news">
<meta property="og:url" content="http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>">
<meta property="og:image" content="<?PHP echo "adminku/foto_berita/small_$gambar;"?>">
<meta property="og:site_name" content="<?PHP echo $title;?>">
<meta property="og:description" content="<?PHP echo $keyword;?>">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/css/style.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/css/neon.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/js/nivo-lightbox/nivo-lightbox.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/js/nivo-lightbox/themes/default/default.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/js/select2/select2.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/css/devicons/css/devicons.min.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/css/devicons/css/devicons.css">
	<link rel="stylesheet" href="<?PHP echo MY_PATH?>assets/animate.css">
	 <link href="<?PHP echo MY_PATH?>adminku/plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?PHP echo MY_PATH?>assets/images/index.png">
	<script src="<?PHP echo MY_PATH?>assets/js/jquery-1.11.0.min.js"></script>
	<script>$.noConflict();</script>
	<script src="<?PHP echo MY_PATH?>assets/js/jquery-transit.js"></script>
<script type="text/javascript">
              jQuery(function() {
                var pulsate = function() {
                  jQuery('#spinbox').transition({ perspective: '0px', rotateY: '0deg',duration: '2000ms' })
				  .transition({ perspective: '180px', rotateY: '360deg',duration: '2000ms',delay:1500}, pulsate);
                };
                pulsate();
              });
</script> 
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56f357ea5059d7b7"></script>
<script>
var show = "hilang";
var iddiv;
var iddivkomen;
var idsebelumnya = "";
var drz;
var idnama;
var idweb;
var idkomen;
function muncul(id){
    if(id!=idsebelumnya){
        show = "hilang";
    }
    iddiv = "inputkomentar"+id;
    iddivkomen = "komentar"+id;
    idsebelumnya = id;
    if(show=="hilang"){
        document.getElementById(iddiv).style.display = "block";
        document.getElementById(iddivkomen).style.display = "block";
        show = "muncul";
        ambil(id);
    }else{
        document.getElementById(iddiv).style.display = "none";
        document.getElementById(iddivkomen).style.display = "none";
        show = "hilang";
    }
}
function ambil(id){
    iddivkomen = "komentar"+id;
    idnama = "nama"+id;
    idweb = "web"+id;
    idkomen = "komen"+id;
    munculloading();
    drz = buatajax();
    var url="<?PHP echo MY_PATH?>ambilkomentar.php";
    url=url+"?id_berita="+id;
    url=url+"&sid="+Math.random();
    drz.onreadystatechange=stateChanged;
    drz.open("GET",url,true);
    drz.send(null);
}
function kirim(id){
    iddivkomen = "komentar"+id;
    idnama = "nama"+id;
    idweb = "web"+id;
    idkomen = "komen"+id;
    namax = document.getElementById(idnama).value;
    web = document.getElementById(idweb).value;
    komen = document.getElementById(idkomen).value;
    if(namax.length > 0 && komen.length > 2){
        munculloading();
        drz = buatajax();
        var url="<?PHP echo MY_PATH?>komentar.php";
        url=url+"?id_berita="+id;
        url=url+"&nama="+namax;
        url=url+"&web="+web;
        url=url+"&komentar="+komen;
        url=url+"&sid="+Math.random();
        drz.onreadystatechange=stateChanged;
        drz.open("GET",url,true);
        drz.send(null);
    }
}
function buatajax(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}
function stateChanged(){
var data;
    if (drz.readyState==4){
        data=drz.responseText;
        hilangloading();
        document.getElementById(iddivkomen).innerHTML = data;
        document.getElementById(idnama).value = "";
        document.getElementById(idweb).value = "";
        document.getElementById(idkomen).value = "";

    }
}
function munculloading(){
var dsocleft=document.body.scrollLeft;
var dsoctop=document.body.scrollTop;
document.getElementById("msgloading").style.top = parseInt(dsoctop) + 300;
document.getElementById("msgloading").style.display = "block";
}
function hilangloading(){
    document.getElementById("msgloading").style.display = "none";
}
</script>
<style>
#msgloading{position:absolute;z-index:1000;top:300;left:200;
width:200;height:80;background-color:#648BFF;border:#003FFB 1px solid;display:none}
div.inputkomen{display:none}</style> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56f357ea5059d7b7"></script>
</head>
<body>
<?php include "menu.php" ?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1><?php 
				$id = mysql_real_escape_string($_GET['news']);  
						$sql=mysql_query("select * from v_berita where nama_beritaseo='$id'");
						while($s=mysql_fetch_array($sql)){
						?>
						<?php echo $s['nama_berita'];?> 
						<?php } ?></h1>			
					<ol class="breadcrumb bc-3" >
						<li>
				<a href="<?PHP echo MY_PATH?>"<i class="fa fa-home"></i>Home</a>
			</li>
					<li>
							<i class="fa fa-newspaper"></i><a href="news">News</a>
					</li>
				<li class="active">
							<strong><?php
							$id = mysql_real_escape_string($_GET['news']);
						$sql=mysql_query("select * from v_berita where nama_beritaseo='$id'");
						while($s=mysql_fetch_array($sql)){
						?>
						<?php echo $s['nama_kat'];?> 
						<?php } ?>
					</strong>
					</li>
					<li class="active">
							<strong><?php
							$id = mysql_real_escape_string($_GET['news']);
						$sql=mysql_query("select * from v_berita where nama_beritaseo='$id'");
						while($s=mysql_fetch_array($sql)){
						?>
						<?php echo $s['nama_berita'];?> 
						<?php } ?>
					</strong>
					</li>
					</ol>		
			</div>
		</div>
	</div>
</section>
<div class="container">
		
</div>
<section class="blog blog-single">
	<div class="container">
		<div class="row">
			<div class="col-sm-11">
				<div class="blog-post-single">
					<?php
					$id = mysql_real_escape_string($_GET['news']);
					$update=mysql_query("UPDATE  berita SET dibaca=dibaca+1  WHERE nama_beritaseo='$id'"); 

					?>
					<?php
					$id = mysql_real_escape_string($_GET['news']);
							$sql=mysql_query("select * from v_berita where nama_beritaseo='$id'");
						while($s=mysql_fetch_array($sql)){
							$tglpublish=tgl_indo($s['tgl_masuk']);
						?>                               
					<?php echo "<a href='#' class='image'>
						<img src='".MY_PATH."adminku/foto_berita/$s[gambar]' class='img-responsive img-rounded' />
					</a>";?>
					<div class="post-details">
						<h3>
							<?php echo $s['nama_berita'];?>
						</h3>
						<div class="post-meta">
							<div class="meta-info">
								<i class="entypo-calendar"></i> <?php echo $tglpublish ?>					</div>
							<div class="meta-info">
								<i class="entypo-comment"></i>
								<?php echo $s['komentar']; ?> Comments
							</div>
							<div class="meta-info">
								<i class="entypo-tag"></i>
							<?php echo $s ['nama_kat']; ?>	
							</div>
							<div class="meta-info">
									<i class="entypo-eye"></i>
									<?php echo $s ['dibaca']; ?> kali
								</div>	
							<div class="meta-info">
								<i class="entypo-user"></i>
							<?php echo $s ['pembuat']; ?>	
							</div>
						</div>
					</div>
					<div class="addthis_sharing_toolbox"></div>	
					<div class="post-content">
						<?php echo  $s['deskripsi']?>


					</div>
					<br/>
					<div class='col-sm-12'>
						
<div id='msgloading'>
</div>
<?php
    echo "<br/>
          <a href=javascript:(muncul($s[id_berita])) class='entypo-comment'>Komentar ($s[komentar])</a>
          <div id=komentar$s[id_berita]>
          </div>
          <div id=inputkomentar$s[id_berita] class=inputkomen>
          <div class='form-group'>
							<input type='text' class='form-control' required='required' name='nama' id=nama$s[id_berita] placeholder='Name' />
						</div>
          <div class='form-group'>
							<input type='text' class='form-control' name='email' id=web$s[id_berita] placeholder='web' />
						</div>     
          <div class='form-group'>
							<textarea class='form-control' id=komen$s[id_berita] name=komen$s[id_berita] placeholder='Message:' rows='6'></textarea>
						</div>
          <button class='btn btn-primary pull-right' onclick=kirim($s[id_berita])>Input</button>
          </div><br/><br/><br/><br/><hr/>";?>
						<?php	
						}
				?>	
				</div>	
				<hr/>	
					<br/>
					<br/>
					<hr/>


					
								<h3><span>Artikel Lainnya</span></h3>
						<?php 
						$artikel=mysql_query("SELECT * From v_berita ORDER BY rand() DESC limit 4");
						while ($r=mysql_fetch_array($artikel)) {
								$tgl=tgl_indo($r['tgl_masuk']);
							  $link_article ="".MY_PATH."news/". strip_tags(htmlentities($r['nama_beritaseo'])).".html";
							  $link_tags ="".MY_PATH."news/kategori/".$r['katberita_seo']."";

							echo"

	<div class='col-sm-3'> 
				 	<div class='xe-widget xe-single-news'>
						<div class='xe-image'>
							<img src='".MY_PATH."adminku/foto_berita/medium_$r[gambar]' class='img-rounded' />
							<span class='xe-gradient'></span>
						</div>
						
						<div class='xe-details'>
							<div class='category'>
								<a href='$link_tags'>$r[nama_kat]</a>
							</div>
							
							<h3>
								<a href=\"".$link_article."\">$r[nama_berita]</a>
							</h3>
							
							<time>$tgl</time>
						</div>
					</div>
					</div>
	";
						}	?>	
					</div>
					<br/>
					
			</div>
		</div></div>		
			</div>
		</div>
	</div>
</section>	
<?php include "footer.php" ?>