

<link href="<?PHP echo MY_PATH?>flex/css/flexslider.css" rel="stylesheet" />

<link href="<?PHP echo MY_PATH?>flex/css/style.css" rel="stylesheet" />
 
	
	<section class="banner" id="home-slider">
	 
	<!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
               <?php $tam=mysql_query("SELECT deskripsi,tgl_masuk,nama_prestasi,id_prestasi,gambar,nama_prestasiseo FROM v_prestasi ORDER BY rand() limit 4");
          while($r=mysql_fetch_array($tam)){
            $isi= substr($r['deskripsi'],0,200);
            $tgl=tgl_indo($r['tgl_masuk']); 
             $link_article ="".MY_PATH."prestasi/". strip_tags(htmlentities($r['nama_prestasiseo'])).".html"; ?>
              <li>
               <?php echo "<img src='".MY_PATH."adminku/foto_berita/$r[gambar]' height='600px' />"; ?>
                <div class="flex-caption container">
                    <div class='col-sm-8'>
                    <h3><?php echo $r['nama_prestasi']; ?></h3>
                      <p><?php echo $isi ?></p> 
                        <?php echo "<a class='btn btn-blue btn-effect' href=\"".$link_article."\">READ MORE</a>"; ?>
         
                  </div>        
				
				
                </div>
              </li>
              <?php } ?>
            </ul>
        </div>
	<!-- end slider -->
 
	</section>
	
	


<script src="<?PHP echo MY_PATH?>flex/js/jquery.js"></script>
<script src="<?PHP echo MY_PATH?>flex/js/jquery.easing.1.3.js"></script>

<script src="<?PHP echo MY_PATH?>flex/js/jquery.fancybox.pack.js"></script>
<script src="<?PHP echo MY_PATH?>flex/js/jquery.fancybox-media.js"></script> 
<script src="<?PHP echo MY_PATH?>flex/js/jquery.flexslider.js"></script>
<script src="<?PHP echo MY_PATH?>flex/js/animate.js"></script>
<script src="<?PHP echo MY_PATH?>flex/js/custom.js"></script>
