<?php
function paginate_one($reload, $page, $tpages) {
	$keyword =mysql_real_escape_string($_GET['keyword']);
	$keyword = strtolower(str_replace(' ', '-', $keyword));
	$firstlabel = "&laquo;&nbsp;";
	$prevlabel  = "&lsaquo;&nbsp;";
	$nextlabel  = "&nbsp;&rsaquo;";
	$lastlabel  = "&nbsp;&raquo;";
	$out = "<center><ul class=\"pagination\">";
	if($page>1) {
		$out.= "<li><a href=".MY_PATH."berita/search/".$keyword.">" . $firstlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $firstlabel . "</span></li>";
	}
	if($page==1) {
		$out.= "<li><span>" . $prevlabel . "</span></li>";
	}
	elseif($page==2) {
		$out.= "<li><a href=".MY_PATH."berita/search/".$keyword.">" . $prevlabel . "</a></li>";
	}
	else {
		$out.= "<li><a href=\"" . $reload . "" . ($page-1) . "\">" . $prevlabel . "</a></li>";
	}
	$out.= "<li><span class=\"current\">Page " . $page . " of " . $tpages ."</span></li>";
	if($page<$tpages) {
		$out.= "<li><a href=\"" . $reload . "" .($page+1) . "\">" . $nextlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $nextlabel . "</span></li>";
	}
	
	if($page<$tpages) {
		$out.= "<li><a href=\"" . $reload . "" . $tpages . "\">" . $lastlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $lastlabel . "</span></li>";
	}	
	$out.= "</ul></center>";	
	return $out;
}
?>