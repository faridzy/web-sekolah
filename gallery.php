<?php include "header.php" ?>
<?php include "menu.php" ?>	
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>Gallery</h1>
				
							<ol class="breadcrumb bc-3" >
						<li>
				<a href="<?PHP echo MY_PATH?>"><i class="fa fa-home"></i>Home</a>
			</li>	
				<li class="active">
							<strong>Gallery</strong>
					</li>
					</ol>			
			</div>
		</div>	
	</div>	
</section>
<script type="text/javascript">
jQuery(document).ready(function($)
{
	$(".gallery-item .image").nivoLightbox();
});
</script>
<section class="gallery-container">
	<div class="container">
		<div class="row">
			<?php 
					error_reporting(0);
        include 'adminku/configurasi/paginationgal.php';
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
            $keyword=$_REQUEST['keyword'];
            $reload = "gallery.php?page&keyword=$keyword";
            $sql =  "SELECT * FROM v_galeri WHERE nama_foto LIKE '%$keyword%' OR nama_kat LIKE '%$keyword%' ORDER BY id_galerifoto";
            $result = mysql_query($sql);
        }else{
            $reload =  "".MY_PATH."gallery/pag/";
            $sql =  "SELECT * FROM v_galeri ORDER BY  id_galerifoto";
            $result = mysql_query($sql);
        }
        $rpp = $paggal; // jumlah record per halaman
        $page = intval($_GET["pag"]);
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
                        $data = mysql_fetch_array($result);   
                    ?>
			<div class="col-sm-3 col-xs-6">
				<div class="gallery-item">
					<?php echo "
					<a href='".MY_PATH."adminku/foto_galeri/$data[gambar]' data-lightbox-gallery='gallery1' class='image' title=''>
						<img src='".MY_PATH."adminku/foto_galeri/medium_$data[gambar]' class='img-rounded' />
						<span class='hover-zoom'></span>
						";
					?>
						<span class='title'><?php echo $data['nama_foto'] ?></span>
					</a>
				</div>
			</div>
                    <?php
					  $i++; 
                        $count++;
                       }
                    ?>
		</div>
		 <p><?php echo paginate_one($reload, $page, $tpages); ?> </p>
	</div>
</section>	
<?php include "footer.php" ?>