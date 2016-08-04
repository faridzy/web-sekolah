<?php include "header.php" ?>
<?php  include "menu.php"  ?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<h1>Data Siswa</h1>
							<ol class="breadcrumb bc-3" >
						<li>
				<a href="home.html"><i class="fa fa-home"></i> Home</a>
			</li>
				<li class="active">
							<strong>Data Siswa</strong>
					</li>
					</ol>		
			</div>
			<div class="col-sm-3">
				<h2 class="text-muted text-right">X,XI,XII RPL</h2>
			</div>
		</div>
	</div>
</section>
<section class="gallery-container">

 
 <div class='container'>
          <div class="row">
          	<h3 align="center">Daftar Siswa Jurusan RPL SMK TI Indonesia Global Ponorogo</h3>
          	<br />
		<hr/>
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Kelas X RPL</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Kelas XI RPL</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Kelas XII RPL</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  	<table class="table table-bordered datatable" id="table-3">
			<thead>
				<tr class="replace-inputs">
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kelas</th>
					
				</tr>
				<tr>
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kelas</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
			$sql=mysql_query("SELECT * FROM v_siswa Where id_kelas='10rpl' ");
			 while ($r=mysql_fetch_array($sql)){
	$nis = $r['nis'];
	$nama = $r['nama_lengkap'];
	$al= $r['alamat'];
	$jurusan = $r['nama'];
	echo "
	<tr class='odd gradeX'>
    <td>$nis</td>
    <td>$nama</td>
    <td>$al</td>
    <td>$jurusan</td>
	</tr>";}?>
			</tbody>
		</table>
                    
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                   <table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr class="replace-inputs">
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kelas</th>
					
				</tr>
				<tr>
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kelas</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
			$sql=mysql_query("SELECT * FROM v_siswa Where id_kelas='11rpl'  ");
			 while ($r=mysql_fetch_array($sql)){
	$nis = $r['nis'];
	$nama = $r['nama_lengkap'];
	$al= $r['alamat'];
	$jurusan = $r['nama'];
	echo "
	<tr class='odd gradeX'>
    <td>$nis</td>
    <td>$nama</td>
    <td>$al</td>
    <td>$jurusan</td>
	</tr>";}?>
			</tbody>
		</table>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    <table class="table table-bordered datatable" id="table-2">
			<thead>
				<tr class="replace-inputs">
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kelas</th>
					
				</tr>
				<tr>
					<th>NIS</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Kelas</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
			$sql=mysql_query("SELECT * FROM v_siswa Where id_kelas='12rpl' ");
			 while ($r=mysql_fetch_array($sql)){
	$nis = $r['nis'];
	$nama = $r['nama_lengkap'];
	$al= $r['alamat'];
	$jurusan = $r['nama'];
	echo "
	<tr class='odd gradeX'>
    <td>$nis</td>
    <td>$nama</td>
    <td>$al</td>
    <td>$jurusan</td>
	</tr>";}?>
			</tbody>
		</table>
		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				var table = $("#table-3").dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true,
					"sDOM":'T<clear>lfrtip',
					"oTableTools":{
						"sSwfPath":"swf/copy_csv_xls_pdf.swf"
					}

				});

				
				table.columnFilter({
					"sPlaceHolder" : "head:after"
				});
			});
			jQuery(document).ready(function($)
			{
				var table = $("#table-1").dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true,
					"sDOM":'T<clear>lfrtip',
					"oTableTools":{
						"sSwfPath":"swf/copy_csv_xls_pdf.swf"
					}

				});

				
				table.columnFilter({
					"sPlaceHolder" : "head:after"
				});
			});
			jQuery(document).ready(function($)
			{
				var table = $("#table-2").dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true,
					"sDOM":'T<clear>lfrtip',
					"oTableTools":{
						"sSwfPath":"swf/copy_csv_xls_pdf.swf"
					}

				});

				
				table.columnFilter({
					"sPlaceHolder" : "head:after"
				});
			});
		</script>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
        </div>
    </section>

           
         
<?php include "footer.php" ?>