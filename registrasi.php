<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="adminku/plugins/jquery-1.4.4.min.js"></script>
<script>
$(document).ready(function(){
   $("#nis").change(function(){
    // tampilkan animasi loading saat pengecekan ke database
    $('#pesan').html(' <img src="adminku/images/loading.gif" width="20" height="20"> checking ...');
    var nis = $("#nis").val();
    $.ajax({
     type:"POST",
     url:"adminku/checking_nis.php",
     data: "nis=" + nis,
     success: function(data){
       if(data==0){
          $("#pesan").html('<img src="adminku/images/tick.png">');
          $('#nis').css('border', '1px #090 solid');
       }
       else{
          $("#pesan").html('<img src="adminku/images/cross.png"> Nis sudah digunakan!');
          $('#nis').css('border', '1px #C33 solid');
                $("#nis").val('');
       }
     }
    });
  })
});
</script>
<script>
$(document).ready(function(){
   $("#email").change(function(){
    // tampilkan animasi loading saat pengecekan ke database
    $('#pesan_email').html(' <img src="adminku/images/loading.gif" width="20" height="20"> checking ...');
    var email = $("#email").val();
    $.ajax({
     type:'POST',
     url:'adminku/checking_email.php',
     data: 'email=' + email,
     success: function(data){
       if(data==0){
          $("#pesan_email").html('<img src="adminku/images/tick.png">');
          $('#email').css('border', '1px #090 solid');
       }
       else{
          $("#pesan_email").html('<img src="adminku/images/cross.png"> Email sudah digunakan!');
          $('#email').css('border', '1px #C33 solid');
                $("#email").val('');
       }
     }
    });
  })
});
</script>
<script language="javascript">
function check_radio(radio)
    {
  for (i = 0; i < radio.length; i++)
  {
    if (radio[i].checked === true)
    {
      return radio[i].value;
    }
  }
  return false;
    }   
function validasi(form){
  if (form.nis.value == ""){
      alert('Nis Masih Kosong!');
      form.nis.focus();
      return (false);
  }
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
  if (form.kelas.value == "pilih"){
      alert('Kelas Masih Kosong!');
      return (false);
  }
  if (form.alamat.value == ""){
      alert('Alamat Masih Kosong!');
      form.alamat.focus();
      return (false);
  }
  if (form.tempat_lahir.value == ""){
      alert('Tempat Lahir Masih Kosong!');
      form.tempat_lahir.focus();
      return (false);
  }
  var radio_val = check_radio(form.jk);
  if (radio_val === false)
  {
    alert("Anda belum memilih Jenis Kelamin!");
                return false;
  }
 
  if (form.agama.value == "pilih"){
      alert('Anda belum memilih Agama!');
      return (false);
  }
  if (form.nama_ayah.value == ""){
      alert('Nama Ayah/Wali Masih Kosong!');
      form.nama_ayah.focus();
      return (false);
  }
   return (true);
}
</script>
<?php include "header.php" ?>
<?php include "menu.php"  ?>
<section class="breadcrumb"> 
  <div class="container">  
    <div class="row"> 
      <div class="col-sm-12">
        <h1>Registrasi Siswa</h1>
              <ol class="breadcrumb bc-3" >
            <li>
        <a href="<?PHP echo MY_PATH?>"><i class="fa fa-home"></i>Home</a>
      </li>  
        <li class="active">
              <strong>Registrasi Siswa</strong>
          </li>
          </ol>      
      </div>
    </div> 
  </div>
</section>
<section class="contact-container">  
  <div class="container">    
    <div class="row">     
     <div class='col-sm-12'>
      <h3 align="center">Registrasi Siswa </h3>
      <hr/>       
      <section class='panel panel-success'>
                        <header class='panel-heading'>
                          <b> Silahkan di Isi</b>
                    <span class='tools pull-right'>
                                <a href='javascript:;' class='fa fa-chevron-down'></a>
                                <a href='javascript:;' class='fa fa-cog'></a>
                                <a href='javascript:;' class='fa fa-times'></a>
                            </span>
                        </header>   
          <div class='panel-body'>    
   <form method="POST" action="adminku/input_registrasi.php" class="form-horizontal" onSubmit="return validasi(this)">
      <table class="table table-bordered responsive">
        <tr><td><b>NIS(Nomor Induk Siswa)</b></td>
        <td><div class="col-sm-6"><input type="text" class="form-control" id="nis" required="required" placeholder="nis" name="nis" size="20" id="nis"/></div><span id="pesan"></span></td></tr>
    <tr> <td><b>Nama Lengkap </b></td>
<td><div class="col-sm-5"><input type="text" class="form-control" id="nama" required="required" placeholder="nama lengkap" name="nama" size="40"/></div></td></tr>        
        <tr><td><b>Email </b></td>
          <td><div class="col-sm-5"><input type="text" name="email" class="form-control" data-validate="email"  required="required" placeholder="email" size="40" id="email"/></div><span id="pesan_email"></span></td></tr>                     
         <tr><td><b>Kelas </b></td>
                              <td><?php
                                include "adminku/configurasi/koneksi.php";
                                $kelas = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
                                echo "<div class='col-sm-2'><select name='kelas' class='form-control'>
                                      <option value='pilih' selected>--Pilih--</option>";
                                while ($k=mysql_fetch_array($kelas)){
                                     echo "<option value='$k[id_kelas]'>$k[nama]</option>";
                                }
                                echo "</select></div>";
                                ?>
                              </td></tr>                       
         <tr><td><b>Alamat </b></td><td><div class="col-sm-7">
            <textarea name="alamat"class="form-control" id="field-1" required="required" cols="43" rows="3"></textarea>
          </div></td></tr>                      
        <tr><td><b>Tempat Lahir </b></td>
        <td><div class="col-sm-5"><input type="text" name="tempat_lahir"class="form-control" id="field-1" required="required" placeholder="tempat lahir" size="40"/>
          </td> </tr>                      
         <tr><td><b>Tanggal Lahir </b></td>
           <td><div class="col-sm-8">
          <?php
              include "adminku/configurasi/fungsi_combobox2.php";
              include "adminku/configurasi/library.php";
              combotgl(1,31,'tgl_lahir',$tgl_skrg);combonamabln(1,12,'bln_lahir',$bln_sekarang);combothn(1950,$thn_sekarang,'thn_lahir',$thn_sekarang);?></td></tr>                    
         <tr><td><b>Jenis Kelamin </b></td>                             
                         <td> <div class="col-sm-4"><input type="radio" name="jk" value="L">Laki - Laki
                                    <input type="radio" name="jk" value="P">Perempuan</td></tr>
         <tr><td>
          <b>Agama </b></td><td><div class="col-sm-2"><select name="agama" class="form-control">
                                        <option value="pilih" selected>--Pilih--</option>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="katolik">Katolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option><select></td></tr>                      
         <tr><td><b>Nama Ayah </b></td>
        <td><div class="col-sm-5"><input type="text" class="form-control" id="nama_ayah" required="required" placeholder="nama ayah" name="nama_ayah" size="40"/></td></tr>
         <tr><td><b>Nama Ibu </b></td><td><div class="col-sm-5"><input type="text" name="nama_ibu" class="form-control" id="nama_ibu" required="required" placeholder="nama ibu" size="40"/></td></tr>                     
         <tr><td><b>Tahun Masuk </b></td><td><?php combothn(2000,$thn_sekarang,'thn_masuk',$thn_sekarang);?></td></tr>                     
                               </table> 
     <div class="form-group"><div class="col-sm-3"></div>
     <div class="col-sm-6"><input type="submit" class="btn btn-success" value="Daftar"></input>
                                <?php echo "<button type='button' class='btn btn-primary' onclick=\"window.location.href='login_siswa.php';\" > Batal</button>";?>
      </div></div></form></div></section></div></div> </div></section>  
<?php include "footer.php" ?>