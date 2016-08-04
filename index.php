<?php include "header.php" ?>
<?php include "menu.php" ?>
 <?php include "flex/slider.php" ?>
<section class="features-blocks">
   <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                   <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">
                        <i class="devicons devicons-illustrator" style="font-size: 40px;color:rgb(29, 92, 120);"></i>
                        <h2>Design</h2>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">
                        <i class="devicons devicons-sublime" style="font-size: 40px;color:rgb(29, 92, 120);"></i>
                        <h2>Development</h2>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                  <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">
                        <i class="devicons devicons-database" style="font-size: 40px;color:rgb(29, 92, 120);"></i>
                        <h2>Support</h2>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                  <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">
                        <i class="devicons devicons-zend" style="font-size: 40px;color:rgb(29, 92, 120);"></i>
                        <h2>Seo</h2>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    </div>
                </div>
            </div> 
            <hr>           
        </div>
  </section>
  <div class="section" id="populer">

            <div class="container">
                <div class="row" style="text-align: center">
                  <div style="visibility: visible; animation-name: fadeInDown;" class="sec-title artikel-populer-title text-center wow animated fadeInDown animated">
                           <h3>Artikel <span class="last-head">Populer</span></h3>
                        </div>
                 <?php  $ber=mysql_query("SELECT id_berita,nama_berita,gambar,nama_kat,tgl_masuk,nama_beritaseo,pembuat,deskripsi FROM v_berita ORDER BY dibaca DESC limit 4");
         while($r=mysql_fetch_array($ber)){
          $tgl=tgl_indo($r['tgl_masuk']);
           $isi= substr($r['deskripsi'],0,400);
            $isi2= substr($r['deskripsi'],0,100);
           $link_article ="".MY_PATH."news/". strip_tags(htmlentities($r['nama_beritaseo'])).".html"; ?>

                        

            <div style="visibility: visible; animation-name: bounceInUp;" class="col-sm-3 box-populer wow bounceInUp animated">
              <div class="hover_wrap">
                 <div class="social_area">
                <i class="fa fa-facebook-square"></i> <i class=""></i> <i class="fa fa-twitter-square"></i> <i class="fa fa-linkedin-square"></i>
                              </div>
            <div class="area"> <?php echo $isi ?>...</div>
                         <a href="<?php echo $link_article ?>" class="btn btn-effect btn-border baca-btn">More</a>     
                        </div><div class="item-box"><img class="" src="<?php echo "adminku/foto_berita/medium_$r[gambar]"; ?>" alt=" Cras molestie orci id lacus sodales hendrerit">
                        <span class="judul"><a href="<?php echo $link_article ?>">
                        <h4> <?php echo $r['nama_berita'] ?></h4></a></span>
                        <span class="info"><i class="fa fa-calendar"></i>&nbsp; <span class="jam"><?php echo $tgl ?></span><span class="author">
                            <i class="fa fa-user"></i> &nbsp; <?php echo $r['pembuat'] ?>
                        </span></span><span class="konten"> <?php echo $isi2 ?>...</span></div></div>
<?php
                           }

                     ?>   
                </div>
            </div>

         </div>

	
           

<section class="testimonials-container" id="specialist">
   <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">
			<center><h3 style="color:#fff">BIDANG KEAHLIAN</h3></center>
			<br/><br/>
      <div class='row'>
			<div class='container' style='visibility: visible; animation-delay: 4s; animation-name: fadeInUp;' class='single_service wow fadeInUp animated' data-wow-delay='1s'>
			<div class="language-wrap">
				<span class="devicons devicons-html5" style="font-size: 100px;"></span>
                        <div class="language-detail">HTML5</div>
                    </div>

				<div class="language-wrap">
                       <span class="devicons devicons-css3" style="font-size: 100px;"></span>
                       <div class="language-detail">CSS3</div>
                   </div>
                   <div class="language-wrap">
                       <span class="devicons devicons-laravel" style="font-size: 100px;"></span>
                        <div class="language-detail">LARAVEL</div>
                       </div>
                       <div class="language-wrap">
                       <span class="devicons devicons-javascript" style="font-size: 100px;"></span>
                        <div class="language-detail">JAVASCRIPT</div>
                       </div>
                       <div class="language-wrap">
                       <span class="devicons devicons-php" style="font-size: 100px;"></span>
                        <div class="language-detail">PHP</div>
                       </div>
                       <div class="language-wrap">
                       <span class="devicons devicons-codeigniter" style="font-size: 100px;"></span>
                        <div class="language-detail">CODEIGNITER</div>
                       </div>
                       <div class="language-wrap">
                       <span class="devicons devicons-angular" style="font-size: 100px;"></span>
                        <div class="language-detail">ANGULAR JS</div>
                       </div>
                       <div class="language-wrap">
                       <span class="devicons devicons-mysql" style="font-size: 100px;"></span>
                        <div class="language-detail">MYSQL</div>
                       </div>
                       <div class="language-wrap">
                       <span class="devicons devicons-java" style="font-size: 100px;"></span>
                        <div class="language-detail">JAVA</div>
                       </div>
               </div>   
               </div>     
		</div>
  </div>
</section>
<section class="clients-logos-container">
	<div class="container">
		<div class="row">	
			<div class="client-logos carousel slide" data-ride="carousel" data-interval="5000">
				<div class="carousel-inner">
					<div class="item active">
						<?php
						$galeri=mysql_query("SELECT gambar FROM v_kategori_foto ORDER BY id_galerifoto DESC limit 4");
						while($r=mysql_fetch_array($galeri)){ ?>
							<?php echo "<a href='#''>
							<img src='adminku/foto_galeri/medium_$r[gambar]'  class='img-rounded'> </a>"; ?>						
                         <?php
                         	} ?>
					</div>
					<div class="item">
							<?php
						$galeri=mysql_query("SELECT gambar FROM v_kategori_foto ORDER BY id_galerifoto ASC limit 4");
						while($r=mysql_fetch_array($galeri)){
							?>
							<?php echo "<a href='#''>
							<img src='adminku/foto_galeri/medium_$r[gambar]'  class='img-rounded'> </a>"; ?>
						<?php
					}
					?>							
					</div>
				</div>
			</div>	
		</div>
	</div>
</section>	
	<?php include "footer.php" ?>