<?php include "header.php" ?>
<?php include "menu.php"  ?>
<script>
function validasi(form){
  
  if (form.nama.value == ""){
      alert('Nama Masih Kosong!');
      form.nama.focus();
      return (false);
  }
  if (form.email.value == ""){
      alert('Email Masih Kosong!');
      form.email.focus();
      return (false);
  }
  pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!pola_email.test(form.email.value)){
        alert ('Penulisan Email tidak valid');
        form.email.focus();
        return false;
        }  
 
   return (true);
}
</script>
	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
function initialize()
{
	var mapDiv = document.getElementById('map');
	var map = new google.maps.Map(mapDiv, {
		center: new google.maps.LatLng(-7.8365705,111.4843782),
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false
	});	
	new google.maps.Marker({
		position: new google.maps.LatLng(-7.8365705,111.4843782),
		map: map
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>Contact</h1>
							<ol class="breadcrumb bc-3" >
						<li>
				<a href="<?PHP echo MY_PATH?>"><i class="fa fa-home"></i> Home</a>
			</li>
				<li class="active">
							<strong>Contact</strong>
					</li>
					</ol>			
			</div>
		</div>
	</div>
</section>
<div class="container">
<section class="contact-map" id="map"></section></div>
<section class="contact-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-7 sep">
								<div style='visibility: visible; animation-delay: 1s; animation-name: fadeInUp;' class='single_service wow fadeInUp animated' data-wow-delay='1s'>

				<h4>Get in touch with us, write us an e-mail!</h4>
				<p>
					To shewing another demands to. Marianne property cheerful informed at striking at. <br />
					Clothes parlors however by cottage on.
				</p>
				<form class="contact-form" role="form" method="post" action="" enctype="application/x-www-form-urlencoded" onSubmit="return validasi(this)">
					<div class="form-group">
						<input type="text" name="name" class="form-control" required="required" id="nama" placeholder="Name:" />
					</div>
					<div class="form-group">
						<input type="text" name="email" class="form-control" required="required" id="email" placeholder="E-mail:" />
					</div>
					<div class="form-group">
						<textarea class="form-control" name="message" required="required" placeholder="Message:" rows="6"></textarea>
					</div>
					<div class="form-group text-right">
						<button class="btn btn-primary" name="send">Send</button>
					</div>
				</form>
			</div>
			</div>
			<div class="col-sm-offset-1 col-sm-4">
								<div style='visibility: visible; animation-delay: 1s; animation-name: fadeInUp;' class='single_service wow fadeInUp animated' data-wow-delay='1s'>

				<div class="info-entry">
					<h4>Address</h4>
					<p>
						<?php echo $alamat ?>
					</p>
						<h4>Working Hours:</h4>
						<br />
					<p>
						07:00 - 13:00 <br />
						Monday to Saturday
						<br />
						<br />
					</p>
				</div>
				<div class="info-entry">
					<h4>Call Us</h4>
					<p>
						Phone: <?php echo $phone ?><br />
						Fax: +1 (22) 5138-219<br />
						<?php echo $email ?>
					</p>
					<ul class="social-networks">
						<li>
							<a href="<?php echo $wa ?>" target="a_blank">
								<div class="sosial-button sosial-whatsapp"></div>
							</a>
						</li>
						<li>
							<a href="<?php echo $twiiter ?>" target="a_blank">
							<div class="sosial-button sosial-twitter"></div>
							</a>
						</li>
						<li>
							<a href="<?php echo $fb ?>" target="a_blank">
								<div class="sosial-button sosial-facebook"></div>
							</a>
						</li>
					</ul>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>	
<?php include "footer.php" ?>
