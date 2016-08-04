<?php error_reporting(0);
 include "config/config.php" ?>
<?php include "adminku/configurasi/fungsi_indotgl.php" ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Sekolah,jurusan,IT" />
	<meta name="author" content="RPL SMK TI" />
	<title>
	<?php	
if (strpos($_SERVER['PHP_SELF'], 'index.php'))
    echo 'RPL|SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'about.php'))
    echo 'About| RPL SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'contact.php'))
    echo 'Contact| RPL SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'gallery.php'))
    echo 'Gallery| RPL SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'news.php'))
    echo 'News| RPL SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'datasiswa.php'))
    echo 'Datasiswa| RPL SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'alumni.php'))
    echo 'Alumni| RPL SMK TI Indonesia Global Ponorogo';
else if (strpos($_SERVER['PHP_SELF'], 'login_siswa.php'))
    echo 'Login E-Learning';
else if (strpos($_SERVER['PHP_SELF'], 'login_guru.php'))
    echo 'Login E-Learning';
else if (strpos($_SERVER['PHP_SELF'], 'registrasi.php'))
    echo 'Registrasi Siswa';
else if (strpos($_SERVER['PHP_SELF'], 'prestasi.php'))
    echo 'Prestasi';
?> 
</title>
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
</head>
<body id="body" class="blue-one-page">
