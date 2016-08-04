
<script type="text/javascript">
//mendeklarasikan variabel
var pijaronline;

//membuat fungsi
function waktu() {
   pijaronline = setTimeout( "waktu()", 1000 );
   waktuku = new Date();
   
   // Mengambil Nilai Waktu
   jam   = waktuku.getHours();
   menit = waktuku.getMinutes();
   detik = waktuku.getSeconds();
   
   // Mengatur format waktu
   if (jam < 10)   jam   = "0" + jam;
   if (menit < 10) menit = "0" + menit;
   if (detik < 10) detik = "0" + detik;
   
   // Mengatur variabel isi/content
   document.getElementById("ell").innerHTML = jam+":"+menit+":"+detik; 
   }
</script>

<body onLoad="waktu();">
        
		<font face="Times New Roman" id="ell" ></font>
	
</body>
