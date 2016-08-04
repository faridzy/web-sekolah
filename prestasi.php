<?php include "header.php" ?>
<?php include "menu.php" ?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">	
				<h1>Prestasi</h1>	
							<ol class="breadcrumb bc-3" >
						<li>
				<a href=""><i class="fa fa-home"></i> Home</a>
			</li>	
				<li class="active">
							<strong>Prestasi</strong>
					</li>
					</ol>			
			</div>		
		</div>	
	</div>
</section>
<section class="blog">
	
	<div class="container">
		
		<div class="row">
			
			<div class="col-sm-12">

				
				<div class="blog-posts">
					<?php
					error_reporting(0);
        include 'adminku/configurasi/paginationprestasi.php'; 
			$reload = "".MY_PATH."prestasi/page/";
            $sql =  "SELECT * FROM v_prestasi ORDER BY  id_prestasi DESC";
            $result = mysql_query($sql);
       
        $rpp = $pagpres; // jumlah record per halaman
        $page = intval($_GET["page"]);
        if($page<=0) $page = 1;  
        $tcount = mysql_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
          ?>
                    <?php
             while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $r = mysql_fetch_array($result);
                        $isi= substr($r['deskripsi'],0,500);
                        $tglpublish=tgl_indo($r['tgl_masuk']);
                        $link_article ="".MY_PATH."prestasi/". strip_tags(htmlentities($r['nama_prestasiseo'])).".html"; ?>
                    
					
					<div class='col-sm-4'> 
				 	<div class='xe-widget xe-single-news'>
						<div class='xe-image'>
							<?php echo"
							<img src='".MY_PATH."adminku/foto_berita/medium_$r[gambar]' class='img-rounded' />"; ?>
							<span class='xe-gradient'></span>
						</div>
						
						<div class='xe-details'>
							<div class='category'>
							<i class="entypo-tag"></i><?php echo $r['nama_katprestasi'] ?>
							</div>
							
							<h3>
								<?php echo "
								<a href=\"".$link_article."\">$r[nama_prestasi]</a>"; ?>
							</h3>
							
							<time><i class="entypo-calendar"></i> <?php echo $tglpublish ?></time>
						</div>
					</div>
					</div>
					<?php
					  $i++; 
                        $count++;   
                    }
                  ?>          

				</div>
				<?php echo paginate_one($reload, $page, $tpages); ?> 

			</div>
			
		</div>
		
	</div>
	
</section>	
<?php include "footer.php" ?>