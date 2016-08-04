<?php include "header.php" ?>
<?php include"menu.php" ?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>About Us</h1>
				
							<ol class="breadcrumb bc-3" >
						<li>
				<a href="<?PHP echo MY_PATH?>"><i class="fa fa-home"></i> Home</a>
			</li>	
				<li class="active">
							<strong>About</strong>
					</li>
					</ol>		
			</div>
		</div>
	</div>
</section>
<section class="content-section">
	<div class="container">
		<div class="row">
				<?php
				$tampil=mysql_query("SELECT * FROM v_tentang");
				while ($r=mysql_fetch_array($tampil)) {
					echo"
					<div class='col-sm-7'><h3>$r[judul]</h3>
					$r[deskripsi]
				<br />
				</div>
			<div class='col-sm-5'>
				<img src='adminku/foto_galeri/$r[gambar]' width='300' height='250' class='img-rounded' />
			</div>";
			}

				 ?>
		</div>
	</div>
</section>
<section class="content-section bg-gray">
	
	<div class="container">
		
		<div class="row">
			
			<div class="col-md-6">
				
				<h5>Web Programming</h5>
				
				<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" style="width: 88%">
										<span class="sr-only">40% Complete (success)</span>
									</div>
								</div>
				
				
				<h5>Dekstop Programming </h5>
				<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
										<span class="sr-only">40% Complete (success)</span>
									</div>
								</div>
				
				
				<h5>Other</h5>
				
				<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 55%">
										<span class="sr-only">40% Complete (success)</span>
									</div>
								</div>
				
			</div>
			
			<div class="col-sm-6">
				<h5>&nbsp;</h5>
				
				<p>In entirely be to at settling felicity. Fruit two match men you seven share. Needed as or is enough points. Miles at smart ﻿no marry whole linen mr. Income joy nor can wisdom summer. Extremely depending he gentleman improving intention rapturous as.</p>
				
				<p>Advantage old had otherwise sincerity dependent additions. It in adapted natural hastily is justice. Six draw you him full not mean evil. Prepare garrets it expense windows shewing do an.</p>
			</div>
			
		</div>
		
	</div>

	
</section>
<section class="content-section">
	<div class="container">
		<div class="row">
			<?php
			$pengajar=mysql_query("SELECT * FROM v_pengajar");
			while ($p=mysql_fetch_array($pengajar)) {
				echo"
				<div class='col-sm-4'>
			<div style='visibility: visible; animation-duration: 1000ms; animation-delay: 500ms; animation-name: flipInY;' class='team-member wow flipInY animated' data-wow-duration='1000ms' data-wow-delay='500ms'>
				<div class='staff-member'>
					<a class='image' href='#'>
						<img src='adminku/foto_pengajar/$p[foto]' width='200px' height='200px' class='img-circle' />
					</a>
					<h4>
						<a href='#'>$p[nama_lengkap]</a>
						<small>$p[jabatan]</small>
					</h4>
					<p>$p[alamat]</p>
					<ul class='social-networks'>
						<li>
							<a href='$p[email]'>
								<div class='sosial-button sosial-google'></div>
							</a>
						</li>
						<li>
							<a href='$p[website]'>
							<div class='sosial-button sosial-wordpress'></div>
							</a>
						</li>
						<li>
							<a href='$p[no_telp]'>
								<div class='sosial-button sosial-whatsapp'></div>
							</a>
						</li>
					</ul>
				</div>
				</div>
			</div>

				";
				
			}
			?>
		</div>
	</div>
</section>	
<?php include "footer.php" ?>