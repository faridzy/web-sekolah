<?php
include "config/config.php";
$id_berita = $_GET['id_berita'];
$query = mysql_query("select * from komentar where id_berita=$id_berita");
while($q = mysql_fetch_array($query)){
    echo "<ul class='comments-list'>	
						<li>	
							<div class='comment'>
								<div class='comment-thumb'>
									<a href='#'>
										<img src='".MY_PATH."assets/images/avatar.png' class='img-circle' />
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
					</ul> ";}
			?>
