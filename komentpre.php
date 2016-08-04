<?php
include "config/config.php";
date_default_timezone_set('Asia/Jakarta'); 
$waktu = date("H:i d M Y");
$email ="defita0922@gmail.com";
$id_prestasi = $_GET['id_prestasi'];
$nama = $_GET['nama'];
$komentar = $_GET['komentar'];
$web = $_GET['web'];
$nama = htmlspecialchars($nama);
$email = htmlspecialchars($email);
$web = htmlspecialchars($web);
$komentar = htmlspecialchars($komentar);
$isi = mysql_query("insert into komentar values(
    null,null,'$id_prestasi','$nama','$waktu','$email','$web','$komentar')");
$isi = mysql_query("update prestasi set komentar=komentar+1 where id_prestasi=$id_prestasi");
$query = mysql_query("select * from komentar where id_prestasi=$id_prestasi");
while($q = mysql_fetch_array($query)){
    echo "<ul class='comments-list'>	
						<li>
							<div class='comment'>
								<div class='comment-thumb'>
									<a href='#'>
										<img src='assets/images/avatar.png' class='img-circle' />
									</a>
								</div>
								<div class='comment-content'>
									<div class='comment-author'>
										<a href='#'>$q[oleh]</a>
										<div class='comment-info'>
											<span class='time'>$q[waktu]</span>
										</div>
									</div>
									<div class='comment-text'>
										$q[komentar]
									</div>
								</div>
							</div>
						</li>
					</ul>";
}
?>