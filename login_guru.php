<?php include "header.php" ?>
<?php include "menu.php"  ?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">	
			<div class="col-sm-12">
				<h1>Login</h1>
							<ol class="breadcrumb bc-3" >
						<li>
				<a href="<?PHP echo MY_PATH?>"><i class="fa fa-home"></i>Home</a>
			</li>	
				<li class="active">
							<strong>Login</strong>
					</li>
					</ol>			
			</div>
		</div>	
	</div>
</section>
<section class="contact-container">
	<div class="container">	
		<div class="row">		
			<div class="col-sm-7 sep">
				<div style='visibility: visible; animation-delay: 1s; animation-name: fadeInUp;' class='single_service wow fadeInUp animated' data-wow-delay='1s'>
				<h3 align="center">Form Login </h3>
				<hr/>			
				<h4>Silahkan Masukkan Password untuk masuk ke halaman E-Learning</h4>
				<p>
					Jika belum menerima password kontak administrator <br />				
				</p>
				<form method="post" role="form" id="form_login" action="adminku/administrator/cek_loginguru.php">	
				<div class="form-group">
				 <?php 
                        if (isset($_GET['log']) == 2) {
                            echo "<div class='alert alert-danger'><strong>Login gagal, Silahkan coba kembali.</strong></div>";
                        }
                         ?>		
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>	
						<input type="text" class="form-control"  name="username" id="username" required="required" placeholder="Username" autocomplete="off" />
					</div>
				</div>
				<div class="form-group">	
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>	
						<input type="password" class="form-control" name="password" id="password" required="required" placeholder="Password" autocomplete="off" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3"><button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login
					</button>
				</div>
				</div>
			</form>	
		</div>
			</div>
			<div class="col-sm-offset-1 col-sm-4">
				<div style='visibility: visible; animation-delay: 1s; animation-name: fadeInUp;' class='single_service wow fadeInUp animated' data-wow-delay='1s'>
				<div class="info-entry">	
					<h4>Keterangan</h4>
					<p>
						E-Learning adalah suatu cara untuk mengatasi solusi <br />
						Ketika para siswa sedang prakerin,dan di kondisi lain <br />
						<br />
						<br />
						<h4>Keuntungan Siswa</h4>
						<P>
						Dapat memperoleh informasi secara tepat dan cepat <br />
						<br/>
					</p>
				</div>
				<div class="info-entry">
					<h4>Keuntungan Guru</h4>
					<p>
						Meminalisir waktu dan efisiensi dalam pengajaran<br />
					</p>	
				</div>
			</div>
			</div>
		</div>
	</div>
</section>	
<?php include "footer.php" ?>