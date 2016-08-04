<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 include ('config/config.php');?>
<?PHP $keyword =mysql_real_escape_string($_GET['keyword']);
$keyword = strtolower(str_replace(' ', '-', $keyword));
if (empty($keyword)){
$keyword = "news";}
header("location:".MY_PATH."berita/search/$keyword");
?>

