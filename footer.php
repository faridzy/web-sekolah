<section class="footer-widgets">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				   <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">

				<a href="#">
					<?php echo "<img src='".MY_PATH."adminku/setting_web/$logo' class='img-rounded' height='100' /> ";?>
				</a>
				<p><?php echo $deskripsi?></p>
				</div>	
			</div>
			<div class="col-sm-3">
				   <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">

				<h5></i>Address</h5>
				<?php echo $alamat ?>
			</div>
			</div>
			<div class="col-sm-3">
				   <div style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;" class="single_service wow fadeInUp animated" data-wow-delay="1s">
				<h5>Contact</h5>
				<p>
					<i class="entypo-mobile"></i><?php echo $phone ?><br />
						<i class="entypo-inbox"></i>Fax: +1 (22) 5138-219<br />
						<i class="entypo-mail"></i><?php echo $email ?>
				</p>
			</div>
			</div>
		</div>
	</div>
</section>
<footer class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<a href="">Copyright &copy; RPL SMK TI Ponorogo - All Rights Reserved.</a> 
			</div>
			<div class="col-sm-6">
				<ul class="social-networks text-right">
					<li>
						<a href="<?php echo $twitter ?> " target='a_blank'>
							<div class="sosial-button sosial-twitter"></div>
						</a>
					</li>
					<li>
						<a href="<?php echo $fb ?>" target="a_blank">
							<div class="sosial-button sosial-facebook"></div>
						</a>
					</li>
					<li>
						<a href="<?php echo $linkedin ?>" target="a_blank">
							<div class="sosial-button sosial-linkedin"></div>
						</a>
					</li>
					<li>
						<a href="<?php echo $google ?>" target="a_blank">
							<div class="sosial-button sosial-google"></div>							
						</a>
					</li>
					<li>
						<a href="<?php echo $wa ?>" target="a_blank">
							<div class="sosial-button sosial-whatsapp"></div>							
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>	
</div>
<?php
// Menyisipkan file Koneksi ke database
// File ini diperlukan saat berinteraksi dengan database Seperti INSERT, UPDATE, DELETE dan SELECT
require 'config/config.php';
error_reporting(0);

// Menyisipkan file functions.php agar function yang kita buat dapat dipakai dihalaman ini
require 'config/function.php';

/**
 * Test
 * echo ip_user();
 * echo "<br/>";
 * echo browser_user();
 * echo "<br/>";
 * echo os_user();
 */

// rekam data user yang sudah mengakses website kita
$ip      = ip_user();
$browser = browser_user();
$os      = os_user();

// Check bila sebelumnya data pengunjung sudah terrekam
if (!isset($_COOKIE['VISITOR'])) {

    // Masa akan direkam kembali
    // Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
    // Cookie akan disimpan selama 24 jam
    $duration = time()+60*60*24;

    // simpan kedalam cookie browser
    setcookie('VISITOR',$browser,$duration);

    // SQL Command atau perintah SQL INSERT
    $sql=mysql_query("INSERT INTO statistik (ip, os, browser) VALUES ('$ip', '$os', '$browser')");

    // variabel { $db } adalah perwakilan dari koneksi database lihat config.php
}else{
	echo "hahahahah";
}


?>

	<script src="<?PHP echo MY_PATH?>assets/js/bootstrap.min.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/joinable.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/resizeable.js"></script>
	
	<script src="<?PHP echo MY_PATH?>assets/js/jquery.validate.min.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/nivo-lightbox/nivo-lightbox.min.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
	<script src="<?PHP echo MY_PATH?>assets/js/select2/select2.min.js"></script>	
</body>
</html>