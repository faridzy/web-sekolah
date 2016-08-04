-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Apr 2016 pada 14.02
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rpl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT 'administrator',
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `level`, `alamat`, `no_telp`, `email`, `blokir`, `id_session`) VALUES
(1, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'Totok Rantoni', 'admin', 'Jln Gatotkaca,Ponorogo', '085228482669', 'totok@ymail.com', 'N', '6ko5nruqvnqmcei05gf81tbbb4'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Ervina Nurhayati', 'admin', 'Jeruksing,Siman', '085228482669', 'ervina@gmail.com', 'N', 'bemevnvtckl0maqvi9raqqkco4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `id` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `angkatan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alumni`
--

INSERT INTO `alumni` (`id`, `nis`, `nama`, `jurusan`, `alamat`, `angkatan`) VALUES
(1, '001/001.070', 'Achmad Khoirul Fajri', 'Rekayasa Perangkat Lunak', 'Sukomoro,Magetan', 2016),
(2, '002/002.070', 'Bryan Rosid', 'Rekayasa Perangkat Lunak', 'Sumoroto', 2016),
(3, '003/003.070', 'Dinda Ayu Bertha K', 'Rekayasa Perangkat Lunak', 'Sukorejo', 2016),
(4, '004/004.070', 'Ervan Prayogo', 'Rekayasa Perangkat Lunak', 'Magetan', 2016),
(5, '005/005.070', 'Ferdinan Dwi Yudha', 'Rekayasa Perangkat Lunak', 'Parang,Magetan', 2016),
(6, '006/006.070', 'Iren intani', 'Rekayasa Perangkat Lunak', 'Walikukun,Sukorejo', 2016),
(7, '008/008.070', 'Muhammad Farid Habiburrohim', 'Rekayasa Perangkat Lunak', 'Gandu,Mlarak', 2016),
(8, '009/009.070', 'Novi Nur Anifah', 'Rekayasa Perangkat Lunak', 'Sumoroto', 2016),
(9, '010/010.070', 'Nur Alim Mufid', 'Rekayasa Perangkat Lunak', 'Pulung', 2016),
(10, '011/011.070', 'Putri Nur Fitriani', 'Rekayasa Perangkat Lunak', 'Jenengan', 2016),
(11, '012/012.070', 'Ringgia Widananta Fikar', 'Rekayasa Perangkat Lunak', 'Sawoo', 2016),
(12, '013/013.070', 'Rio Ayatullah Muhammad Nur Salam', 'Rekayasa Perangkat Lunak', 'Tajug', 2016),
(13, '014/014.070', 'Saipuji Galih Rianto', 'Rekayasa Perangkat Lunak', 'Slahung', 2016),
(14, '015/015.070', 'Tintya P', 'Rekayasa Perangkat Lunak', 'Parang,Magetan', 2016),
(15, '016/016.070', 'Allysa Nurmaida Maharani', 'Rekayasa Perangkat Lunak', 'Jenes', 2016);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_berita` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_beritaseo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `komentar` int(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `nama_berita`, `nama_beritaseo`, `deskripsi`, `tgl_masuk`, `gambar`, `pembuat`, `komentar`) VALUES
(54, 20, 'Teknologi Otomotif Berperan dalam Hemat BBM dan Lingkungan ', 'teknologi-otomotif-berperan-dalam-hemat-bbm-dan-lingkungan-', '<p>Konsumsi energi di sektor transportasi dewasa ini didominasi permintaan minyak untuk menghasilkan bensin dan solar. Produk minyak tersebut digunakan untuk transportasi darat, kereta api, laut, dan udara. Pada 2006 konsumsi energi untuk transportasi tercatat lebih dari 96% berupa minyak. Selain minyak, permintaan biofuel juga meningkat meskipun kecil, disertai penggunaan gas untuk transportasi, dan listrik untuk kereta api.</p>\r\n\r\n<p>Eropa diperkirakan akan meningkatkan listrik sebagai energi transportasi darat, didukung peningkatan peran biofuel bagi sektor transportasi darat dan bahkan mungkin transportasi udara. Tren ini lebih didorong oleh pertimbangan perubahan iklim, bukan ketahanan energi. Namun demikian, tren ini juga akan berdampak positif bagi ketahanan energi.</p>\r\n\r\n<p>Peningkatan efisiensi energi transportasi darat dapat dicapai melalui beberapa cara, antara lain adalah melalui teknologi. Penerapan teknologi diperlukan untuk mengurangi konsumsi energi per kilometer jarak tempuh.</p>\r\n\r\n<p>Efisiensi kendaraan dapat ditingkatkan secara signifikan melalui penerapan teknologi untuk mesin dan bagian lain kendaraan. Beberapa teknologi ini sudah diterapkan pada kendaraan penumpang berdasarkan kesepakatan ACEA (European Automobile Manufacturers&rsquo; Association), JAMA (Japan Automobile Manufacturers Association), KAMA (Korea Automobile Manufacturers Association), Komisi Eropa. Kesepakatan tersebut bertujuan mengurangi emisi CO2 dari kendaraan.</p>\r\n\r\n<p>Alternatif teknologi yang dikembangkan untuk kendaraan penumpang meliputi desain mesin bensin dan solar. Desain yang fokus pada peningkatan efisiensi konsumsi bahan bakar antara lain direct injection otto-cycle, teknologi variable valve, dan ukuran mesin lebih kecil. Teknologi lain adalah stop-start untuk efisiensi penggunaan mesin jika mobil dalam keadaan stasioner, serta beragam teknologi hibrida-elektrik (micro-hybrid, mild hybrid, dan full hybrid). Sebagian besar teknologi tersebut dapat juga digunakan bagi kendaraan niaga ringan.</p>\r\n\r\n<p>Selain pengembangan teknologi, efisiensi energi transportasi darat juga dapat dicapai oleh adanya kendaraan dengan konsumsi energi rendah. Selain itu dapat juga dicapai dengan teknis operasional untuk mengurangi konsumsi energi per kilometer jarak tempuh.</p>\r\n', '2016-04-13', '63Mobil-Hybrid.jpg', 'Ervina Nurhayati', 0),
(58, 20, 'Hampir Satu Juta Pengunjung di Pameran Mobil Frankfurt', 'hampir-satu-juta-pengunjung-di-pameran-mobil-frankfurt', '<p>FRANKFURT&mdash; Pameran mobil kelas dunia Internationale Automobil-Ausstellung (IIA) yang ke-66 berlangsung di Frankfurt (Jerman) berhasil menarik minat 931.700 pengunjung. IAA berlangsung selama 11 hari hingga 27 September 2015 di arena pameran Frankfurt am Main. Pameran ini mengangkat tema &ldquo;Mobility connects&rdquo; yang mengedepankan aplikasi teknologi internet dan otomatisasi pada produk-produk mobil yang dipamerkan.</p>\r\n\r\n<p>&ldquo;Capaian IAA ke-66 tahun ini jauh melebihi yang kami harapkan. Cuaca sangat bagus sepanjang akhir pekan di saat menjelang penutupan pameran membuat public tak segan hadir ke pameran,&rdquo; kata Matthias Wissmann, President Asosiasi Industri Otomotif Jerman (VDA).</p>\r\n\r\n<p>Jumlah pengunjung pada IAA ke-66 tahu ini naik 50 ribu dari IAA sebelumnya. Ini merupakan jumlah pengunjung terbesar IAA dalam delapan tahun terakhir. Data lain menunjukkan, IAA tahun ini berhasil menghadirkan lebih banyak pengunjung usia lebih muda, rata-rata 34 tahun. Beberapa IAA sebelum ini pengunjung terbanyak dari kalangan usia sekitar 37 tahun.</p>\r\n\r\n<p>Seperti di Indonesia yang pameran otomotifnya (GAIKINDO Indonesia International Auto Show, GIIAS) yang diselenggarkan langsung oleh GAIKINDO, maka pameran mobil IAA di Frankfurt ini juga langsung diselenggarakan oleh VDA. IAA ke-66 kali ini diikuti 1.103 peserta pameran yang datang dari 39 negara. Dan selama penyelenggaraannya terdapat 219 premiere (peluncuran perdana produk). IAA ke-66 diliput oleh 11 ribu wartawan dari 106 negara.</p>\r\n', '2016-04-14', '80frankfurtmshow15.jpg', 'Ervina Nurhayati', 0),
(55, 20, 'Hino Produksi Kembali CNG Bus ', 'hino-produksi-kembali-cng-bus-', '<p>PURWAKARTA&mdash; PT Hino Motors Manufacturing Indonesia (HMMI) meresmikan kembali produksi bus berbahan bakar gas alam terkompresi (compressed natural gas, CNG). Persemian berlangsung di pabrik Hino, Kawasan Kota Bukit Indah, Purwakarta (Jawa Barat) 27 November 2015.</p>\r\n\r\n<p>Produksi kembali bus Hino CNG ini diresmikan I Gusti Putu Suryawirawan, Dirjen Industri Logam, Mesin, Alat Transportasi, dan Elektronika, Kementerian Perindustrian. Di situ hadir Toshiro Mizutani (Presiden Komisaris HMMI), Soebronto Laras (Komisaris HMMI), Kazushi Ehara (Presiden Direktur HMMI), Hiroo Kayanoki (Presiden Direktur PT Hino Motors Sales Indonesia, HMSI), dan jajaran direksi Hino dan tamu undangan lainnya.</p>\r\n\r\n<p>Kazushi Ehara mengatakan, merupakan produsen bus pertama dan satu-satunya yang berhasil memproduksi bus CNG di Indonesia. Ia berharap bus Hino CNG menjadi solusi dalam membantu pemerintah dalam menghadirkan transportasi massal yang nyaman bagi warga. &ldquo;Produksi ulang bus Hino CNG juga dukungan Hino dalam membantu program pemerintah menciptakan langit yang biru dengan memberikan kendaraan ramah lingkungan,&rdquo; katanya.</p>\r\n\r\n<p>Sebelumnya, Hino sudah pernah memproduksi bus CNG untuk armada Transjakarta sejak 2007. Hino memiliki pengalaman dan teknologi yang mumpuni untuk menghasilkan Bus CNG yang aman, nyaman dengan daya angkut penumpang yang cukup besar. Bus ini mempunyai spesifikasi yang sesuai dengan regulasi pemerintah. Di samping itu, Hino memberikan layanan purna jual yang berkualitas demi memberikan kepuasan bagi pelanggan.</p>\r\n\r\n<p>&ldquo;Kami siap kembali melayani permintaan dan memenuhi kebutuhan dari instasi pemerintah maupun swasta. Selain itu kami juga memiliki layanan purna jual yang sepenuhnya mendukung kelancaran operasional bus Hino CNG ini,&rdquo; kata Hiroo Kayanoki.</p>\r\n\r\n<p>Total Kapasitas produksi pabrik Hino mencapai 75.000 unit tiap tahun. Hasil produksinya dipergunakan untuk memenuhi kebutuhan pasar domestik dan juga ekspor ke beberapa negara di kawasan ASEAN dan Amerika Latin.</p>\r\n\r\n<p>Bus Hino CNG yang diproduksi ialah tipe RK CNG dengan kapasitas 80 penumpang. Bus ini memiliki mesin 6 silinder 7.961 ccdilengkapi turbocharger dan intercooler yang mampu melahirkan tenaga 260 PS dan menghasilkan suara yang lembut dan getaran yang halus.</p>\r\n\r\n<p>Spesifikasi mesinnya memastikan bahwa gas buang yang dihasilkan ramah lingkungan. Bus bermesin belakang ini disematkan transmisi otomatis 6 percepatan sehingga mengurangi kelelahan bagi pengemudi dan lebih nyaman dikendarai dan tentunya lincah bermanuver di jalan perkotaan.</p>\r\n', '2016-04-13', '27hino-cng.jpg', 'Ervina Nurhayati', 0),
(56, 20, 'Truk Masa Depan makin Penuh Teknologi ', 'truk-masa-depan-makin-penuh-teknologi-', '<p>Tahun 2015 ditandai dengan arah baru keselamatan bagi truk di Amerika Serikat (AS). Badan Keselamatan Transportasi Nasional AS (NTSB) minta agar perusahaan-perusahan makin fokus perhatiannya pada soal keselamatan truk. Itu termasuk teknologi anti-tabrakan, pembatasan jam menyetir bagi para sopir truk, serta pengetatan peraturan terhadap perusahaan angkutan yang armada truknya sering terlibat kecelakaan.</p>\r\n\r\n<p>Seperti di Indonesia, bisnis armada angkutan barang di AS juga memainkan peran penting dalam urat nadi ekonomi. Namun demikian angka kecelakaan yang melibatkan truk juga meningkat. Pada 2013, sekitar 3.900 orang tewas dalam kecelakaan yang melibatkan truk.</p>\r\n\r\n<p>Lembaga survey Frost &amp; Sullivan mencatat, pada 2020 diperkirakan aka nada 917,069 sistem keselamatan truk, meingkat dari 409,417 pada 2013. Sistem keselamatan truk tersebut mencakup Driver Information Warning Systems (DIWS), Active Chassis Control Systems (ACCS), dan Integrated Safety Systems (ISS).</p>\r\n\r\n<p>Riset dilakukan oleh Lakshmi Narayanan, seorang peneliti senior otomotif dan transportasi kendaraan niaga Frost &amp; Sullivan. Menurutnya, hingga tahun 2010 pasar truk di masa datang salah satunya akan ditentukan oleh beberapa hal menyangkut keselamatan. Itu misalnya meningkatnya pemahaman pentingnya keselamatan di kalangan perusahaan angkutan, kian ketatnya peraturan, tuntutan perusahaan angkutan untuk menurunkan ongkos, serta makin berperannya sistem keselamatan transportasi.</p>\r\n\r\n<p>&ldquo;Beberapa sistem keselamatan seperti Integrated Safety Systems, Lane Departure Warning, and Blind Spot Detection diperkirakan akan berkembang pesat karena sangat membantu pengemudi menghindari kecelakaan, dan itu merupakan keuntungan bagi perusahaan angkutan,&rdquo; kata Narayanan.</p>\r\n', '2016-04-13', '38truck_callouts-145x100.jpg', 'Ervina Nurhayati', 0),
(57, 13, 'URL Cantik Menggunakan Htaccess', 'url-cantik-menggunakan-htaccess', '<p>Make up, cosmetic, baju bermerek, Louis Vuitton, Prada, Rolex. Tampil indah, sesuatu yang diinginkan semua orang. Memang merek dan tampilan bukanlah segalanya. Tetapi merek dan tampilan dapat menghasilkan sesuatu yang tidak bisa didapatkan dengan cara lain. Status. Hal ini tidak terkecuali dengan website. Anda ingin URL yang tampil secara indah. Tetapi URL yang indah tidaklah &ldquo;murah&rdquo;.</p>\r\n\r\n<p>Bila anda mendengar kata URL Rewriting, hal pertama yang di bayangkan adalah .htaccess. Beberapa server menampilkan URL secara berbeda dan beberapa bahasa coding dan framework seperti Ruby on Rails misalnya juga memiliki aturan yang berbeda. Tetapi dalam article ini, kita akan membahas metode URL Rewriting yang paling umum yaitu dengan menggunakan file .htaccess yang sering digunakan bersamaan dengan bahasa coding PHP.</p>\r\n\r\n<p>Mungkin anda bertanya, apakah saya memerlukan teknologi ini? Sebuah pengetahuan umum adalah bahwa .htaccess merupakan teknologi yang hebat tetapi menjengkelkan. Hampir tidak ada tutorial yang jelas dan mudah dimengerti mengenai topik ini. Tanpa teknologi ini, aplikasi web anda dapat berjalan dengan lancar. Kesulitan yang harus dihadapi dengan .htaccess merupakan mahal harga yang perlu dibayar untuk membeli merek ini.</p>\r\n\r\n<p>Sama seperti Louis Vuitton, anda tidak memerlukannya tetapi merek ini akan merefleksikan sebuah status. Facebook saat baru diluncurkan menampilkan halaman profilenya tanpa menggunakan URL Rewriting. Halaman profile Facebook akan tampil seperti <em>facebook.com?profile=123143414325</em> dimana angka acak tersebut merupakan id profile anda. Setelah Facebook dipakai jutaan orang di dunia, Facebook memerlukan sesuatu yang dapat merefleksikan status yang sekarang Facebook miliki. Sekarang profile anda bertulis <em>facebook.com/john.smith</em> dimana nama John Smith merupakan sebuah contoh yang nanti akan bertulis nama anda saat saya mengunjungi profile Facebook anda. Tampilan yang cantik dan &ldquo;mahal&rdquo; ini akan memberikan status kepada website dan aplikasi web anda.</p>\r\n\r\n<p>Kabar gembira, teknologi ini tidak &ldquo;mahal&rdquo; dalam hal moneter melainkan &ldquo;mahal&rdquo; dalam hal ilmu dan ini bisa anda dapatkan bila anda memiliki kesabaran, latihan dan tentunya sebuah niat.</p>\r\n\r\n<h2>The Fundemental</h2>\r\n\r\n<p>Metode URL Rewriting yang kita gunakan menggunakan sebuah fitur yang disediakan server yang menjalankan Apache. Artinya bila anda menggunakan Windows anda memerlukan WAMP atau XAMP nyala dan bila anda menggunakan OSX anda memerlukan MAMP atau XAMP nyala. Untungnya hampir semua host server memiliki support bagi Apache.</p>\r\n\r\n<p>Cara memulai adalah dengan membuat sebuah file bernama .htaccess dan file ini harus disimpan di root dari folder website anda. Ingat <strong>nama file hanya .htaccess</strong> tanpa ada format file apapun. Hati-hati juga karena terkadang file <strong>.htaccess</strong> akan dihide secara otomatis dan anda perlu melakukan setting di komputer anda agar anda dapat melihat hidden files.</p>\r\n\r\n<p>.htaccess sendiri merupakan sebuah file konfigurasi milik Apache dimana kita dapat memberikan rules dan command pilihan kita sendiri yang nantinya akan diaplikasikan ke semua file dan sub-folder di dalam folder dimana file .htaccess berada. Didalam .htaccess sendiri kita menggunakan sebuah modul milik Apache bernama <code>mod_rewrite</code>. Sebelum melakukan metode ini, pastikan anda memiliki modul <code>mod_rewrite</code>. Tetapi tidak perlu dipusingkan karena hampir semua virtual server dan web host memiliki modul ini.</p>\r\n\r\n<h2>Memulai Dengan htAccess</h2>\r\n\r\n<p>Untuk memulai, tulis command ini di baris pertama di dalam file .htaccess anda:</p>\r\n\r\n<pre>\r\n<code>RewriteEngine On</code></pre>\r\n\r\n<p>Baris command ini akan memulai modul <code>mod_rewrite</code>. Di bawah baris ini kita bisa menulis semua rule dari URL rewrite yang kita perlukan. Rule dari URL rewrite dasarnya adalah seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule URL/yang/ingin/di/cocokan URL/yang/digunakan/bila/cocok [option]</code></pre>\r\n\r\n<p>Contohnya adalah seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^about/me$ /about/index.html [L]</code></pre>\r\n\r\n<p>Rule di atas mengartikan kalau bila pengunjung membuka halaman <em>example.com/about/me</em>, maka akan ditampilkan halaman dari <em>example.com/about/index.html</em>. <code>[L]</code> sendiri merupakan sebuah option yang akan dibahas lebih dalam nantinya.</p>\r\n\r\n<h3>Rewriting</h3>\r\n\r\n<p>Code yang dicontohkan tadi merupakan sebuah contoh dari rewriting. Hal ini berbeda dengan redirects.</p>\r\n\r\n<p>Secara default, web server akan membuat sebuah URL kepada setiap file yang anda upload. Misalkan anda ingin mengakses <em>example.com/about/index.html</em> maka server akan mengarahkan ke folder root <em>example.com</em>, masuk ke folder <em>about</em> dan akan menampilkan halaman <em>index.html</em>.</p>\r\n\r\n<p><strong>Redirect berbeda dengan Rewrite</strong>. Misalkan <em>example.com/about/index.html</em> diredirect ke <em>example.com/contact/index.html</em>. Saat mengunjungi <em>example.com/about/index.html</em>, server akan membuka folder <em>about</em> dan ingin menampilkan file <em>index.html</em>. Tetapi saat server ingin menampilkan <em>index.html</em>, server membaca redirect rule yang digunakan dan hasilnya, server akan kembali menavigasi ulang ke <em>example.com</em>, membuka folder <em>contact</em> dan akhirnya menampilkan file <em>index.html</em> yang berada di dalam folder <em>contact</em>. URL anda pun akan berubah sesuai dengan URL yang dituju oleh redirect.</p>\r\n\r\n<p>Untuk rewrite, cara web server menavigasikan URL file sedikit berbeda. Setelah menulis sebuah rewrite rule, saat ada request untuk <em>example.com/about/me</em>, server akan menggunakan file <em>index.html</em> yang berada di dalam folder <em>about</em>. Dengan begitu, anda memberikan URL baru kepada file <em>index.html</em>.</p>\r\n\r\n<p>Dengan metode ini, akan dapat memberikan berbagai macam URL cantik bagi semua halaman website anda. Ingat, rules dasarnya adalah seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^untuk/url/ini/$ /gunakan/file/ini.php [L]</code></pre>\r\n\r\n<h2>Matching Patterns</h2>\r\n\r\n<p>Bila anda melihat rule di atas, ada beberapa character asing seperti <code>^</code> dan <code>$</code>. Kedua character ini merupakan bagian dari pattern yang harus di gunakan saat melakukan URL matching. Ada sebuah alasan mengapa kita harus menggunakan sebuah pattern. Contoh di atas, kita mengarahkan sebuah link absolute ke sebuah link absolute lainnya. Walaupun cara ini berkerja, bayangkan bila website anda memiliki banyak sekali halaman. Anda tidak mungkin membuat sebuah rule khusus untuk setiap halaman. Tambah lagi website yang dynamis dengan content yang terus bertambah. Anda tidak mungkin membuat sebuah rule secara manual saat ada content yang baru dirilis. Membuat sebuah web app dengan URL cantik menjadi tidak memungkinkan. Oleh karena itu kita menggunakan pattern dimana bilah link yang direquest cocok dengan pattern yang kita tentukan, server akan menampilkan file sesuai dengan aturan dari pattern yang sudah kita tentukan.</p>\r\n\r\n<p>Perlu diketahui, pattern yang digunakan oleh modul <code>mod_rewrite</code> diketahui dengan nama Perl Compatible Regular Expression (PCRE) atau singkatnya juga diketahui dengan nama <em>regex</em> atau <em>regexp</em>. Regex bisa anda pelajari sendiri juga. Berbeda dengan htaccess yang jumlah tutorialnya sedikit, ada <a href="http://regexone.com/" target="_blank">banyak tutorial</a> mengenai regex. Untuk lebih banyak tutorial anda juga dapat mencari di Google dengan kata kunci regex atau regexp.</p>\r\n\r\n<p><strong>Disclaimer:</strong> Perlu saya peringati, agar lebih gampang mengartikan cara <code>mod_rewrite</code> menyamakan pattern, ada baiknya anda mengetahui dasar bahasa programming secara umum dikarenakan consep dasar seperti apa itu string dan variable akan digunakan. Lebih baik lagi bila anda memiliki sedikit pengetahuan mengenai dasar dari bahasa coding PHP, terutama konsep <code>$_GET</code>.</p>\r\n\r\n<p>Kita sudah mengetahui dua regex character.</p>\r\n\r\n<p><code>^</code> &ndash; Mencocokan awal sebuah string.<br />\r\n<code>$</code> &ndash; Mencocokan akhir dari sebuah string.</p>\r\n\r\n<p>Character <code>^</code> dan <code>$</code> harus digunakan agar kita yakin kalau URL yang dicocokan merupakan URL itu sepenuhnya dari awal sampai akhir dan bukan hanya sebagian dari URL.</p>\r\n\r\n<p><code>[0-9]</code> &ndash; Mencocokan angka 0 sampai 9. <code>[1-4]</code> akan mencocokan angka 1 sampai 4.<br />\r\n<code>[a-z]</code> &ndash; Mencocokan huruf kecil a sampai z.<br />\r\n<code>[A-Z]</code> &ndash; Mencocokan huruf besar A sampai Z.<br />\r\n<code>[a-z0-9]</code> &ndash; Aturan-aturan di atas bisa digabungkan. Aturan ini mencocokan huruf kecil a sampai z dan angka 0 sampai 9.</p>\r\n\r\n<p>Rules diatas adalah pattern yang kita sebut sebagai character group. Rules ini akan mencocokan semua character yang sesuai dengan huruf atau angka yang ada di dalam bracket. Anda dapat menggunakan character apapun dengan jarak sesuai yang ditunjukan di atas di dalam bracket.</p>\r\n\r\n<p>Tetapi rules di atas hanya mencocokan satu character. <code>[0-9]</code> akan mencocokan angka 5 tetapi tidak akan mencocokan angka 54. Untuk mencocokan angka 54 kita harus menggunakan <code>[0-9]</code> dua kali.</p>\r\n\r\n<pre>\r\n<code>[0-9][0-9]</code></pre>\r\n\r\n<p>Untuk mencocokan 2014 kita dapat melakukan ini:</p>\r\n\r\n<pre>\r\n<code>[0-9][0-9][0-9][0-9]</code></pre>\r\n\r\n<p>Tapi ini menjadi melelahkan maka kita dapat melakukan ini:</p>\r\n\r\n<pre>\r\n<code>[0-9]{4}</code></pre>\r\n\r\n<p>Tetapi sering kali kita tidak tahu berapa jumlah angka yang ingin kita cocokan. Contohnya ID dari sebuah article. Oleh karena itu kita dapat menggunakan character <code>+</code> yang berarti satu kali atau lebih.</p>\r\n\r\n<pre>\r\n<code>[0-9]+</code></pre>\r\n\r\n<p>Sekarang kita dapat mencocokan angka 123456 dan juga 123456789.</p>\r\n\r\n<h2>Mempraktekan htAccess</h2>\r\n\r\n<p>Kita ingin mencocokan URL untuk article di website kita dan di rewrite dengan halaman <em>article.php</em>. URLnya akan memiliki pattern seperti ini:</p>\r\n\r\n<pre>\r\n<code>2014/judul-article/</code></pre>\r\n\r\n<p>URL yang ingin dicocokan di awali dengan empat angka yang menyatakan tahun, diikuti dengan garis miring, diikuti lagi dengan <em>slug</em> dari judul article dan di akhiri dengan sebuah garis miring lagi. Dengan begitu kita dapat menulis aturan regex untuk dicocokan seperti ini:</p>\r\n\r\n<pre>\r\n<code>^[0-9]{4}/[a-z0-9-]+/$</code></pre>\r\n\r\n<p>Mari kita perhatikan aturan regex di atas. Pertama kita memulai sebuah string dengan <code>^</code> dan kita akhiri stringnya juga dengan <code>$</code> agar dipastikan kalau URL yang dicocokan dibaca secara keseluruhan. URL diawali dengan empat angka <code>[0-9]{4}</code>. Lalu diikuti oleh sebuah garis miring. Setelah itu kita dapat mencocokan character apapun yang berhuruf kecil dari a sampai z atau angka 0 sampai 9 atau sebuah dash <code>[a-z0-9-]</code>. Karena jumlah character dari sebuah slug selalu berbeda, kita gunakan juga character <code>+</code>. Mengikuti URL yang ingin dicocokan, kita akhiri dengan garis miring dan seperti yang dikatakan tadi string ini harus diakhiri dengan <code>$</code>. Oleh karena itu URL diakhiri dengan <code>/$</code>.</p>\r\n\r\n<p>Menulis rewrite rule ini secara sepenuhnya, kita memiliki rule seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^[0-9]{4}/[a-z0-9-]+/$ /article.php</code></pre>\r\n\r\n<p>Kita hampir selesai. Kita sudah dapat mencocokan URL apapun yang sesuai dengan pattern yang kita buat untuk menggunakan file <em>article.php</em>. Sekarang kita tinggal memastikan kalau <em>article.php</em> menampilkan halaman yang benar.</p>\r\n\r\n<h2>Capturing groups, and replacements</h2>\r\n\r\n<p>Saat menulis sebuah halaman dengan PHP menggunakan metode <code>$_GET</code>, kita memerlukan data dari URL. Biasanya bagian dari URL diambil dan dibaca sebagai <em>query string</em>. Contohnya kita ingin menampilkan sebuah article di halaman <em>article.php</em>. URL yang digunakan bentuknya biasanya seperti ini:</p>\r\n\r\n<pre>\r\n<code>/article.php?year=2014&amp;slug=judul-article</code></pre>\r\n\r\n<p>Oleh karena itu saat mencocokan URL, kita harus tetap bisa melempar data penting dari URL ke file yang ingin kita tampilkan. Caranya adalah dengan menerapkan tanda kurung di pattern yang ingin digunakan. Ini disebut dengan <em>capturing group</em>. Bila anda mengerti bahasa coding, konsepnya mirip dengan konsep variable.</p>\r\n\r\n<p>Pattern yang kita buat tadi setelah diberi tanda kurung akan menjadi seperti ini:</p>\r\n\r\n<pre>\r\n<code>^([0-9]{4})/([a-z0-9-]+)/$</code></pre>\r\n\r\n<p>Untuk menerapkan capturing groups ke file yang ingin kita tampilkan kita gunakan symbol <code>$</code> diikuti dengan nomor dari group yang kita ingin gunakan. Nomor akan otomatis berurut dari capturing group pertama. Berarti capturing group <code>$1</code> akan menampilkan bagian URL yang cocok dengan pattern <code>[0-9]{4}</code> dan seterusnya. Sekarang URL kita akan menjadi seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^([0-9]{4})/([a-z0-9-]+)/$ /article.php?year=$1&amp;slug=$2</code></pre>\r\n\r\n<p>Di sini, capturing group <code>$1</code> akan menangkap dan melempar tahun dari URL kepada file <em>article.php</em>. Capturing group <code>$2</code> akan menangkap dan melempar slug dari judul article. Bila ada group ketiga, group tersebut akan menjadi <code>$3</code>. Dalam bahasa regex, ini juga disebut sebagai <em>back-references</em>.</p>\r\n\r\n<h2>Options</h2>\r\n\r\n<p>Dalam <code>mod_rewrite</code> kita juga dapat menampilkan sesuatu yagn disebut sebagai <em>option</em>. Option juga disebeut sebagai <em>flags</em>. <a href="http://httpd.apache.org/docs/current/rewrite/flags.html" target="_blank">Ada banyak option yang bisa digunakan</a>. Option digunakan untuk merubah bagaimana cara rules yang kita tulis diprocess oleh system.</p>\r\n\r\n<p><code>L</code> &ndash; Rule ini berarti Last. Bila rule yang bersangkutan cocok, system akan berhenti mencoba mencocokan rules lain.<br />\r\n<code>R=301</code> &ndash; Akan melakukan HTTP 301 redirect untuk mengirim browser user ke URL baru. Status 301 berarti file yang ingin dituju oleh URL sudah hilang secara permanen dan ini merupakan cara baik untuk meredirect user ke URL baru dan juga mengijnkan search engines untuk mengupdate indexes mereka.</p>\r\n\r\n<p>Options digunakan dengan cara mengenakan tanda kurung kotak disekitar option yang ingin digunakan. Anda dapat menggunakan lebih dari satu option dengan memisahkannya dengan koma.</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^([0-9]{4})/([a-z0-9-]+)/$ /article.php?year=$1&amp;slug=$2 [L]</code></pre>\r\n\r\n<p>atau</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^([0-9]{4})/([a-z0-9-]+)/$ /article.php?year=$1&amp;slug=$2 [R=301,L]</code></pre>\r\n\r\n<h2>Yang Tidak Berkerja Untuk Saya</h2>\r\n\r\n<p>Jujur saja, rewrite rules bukanlah sesuatu yang mudah. Bermain dengan .htaccess sangatlah menjengkelkan. Terturama dengan minimnya resources yang dapat mengajarkan cara menerapkan teknologi ini dengan jelas. Code diatas secara teori benar tetapi saat saya mencobanya, saya menemukan error dan rukes yang dicontohkan di atas tidak berkerja untuk saya. Mungkin saat anda mencoba rules di atas langsung berkerja untuk anda dan itu sangatlah bagus.</p>\r\n\r\n<p>Dengan begitu saya mencoba sebuah <em>workaround</em>. Dara pada mencocokan jenis character secara spesifik seperti <code>[a-z0-9-]</code> saya menggunakan sebuah pattern dari regex yang berbeda.</p>\r\n\r\n<p><code>[^/.]+</code> &ndash; Mencocokan character apapun, angka, huruf, titik maupun symbol. <code>+</code> yang digunakan akan mencocokan string dengan panjang apapun.</p>\r\n\r\n<p>Mungkin bila melihat sisi security hal ini tidak seaman rules yang dicontohkan di atas. Tetapi bila anda sudah jengkel, ini bisa menjadi sebuah alternatik. Dengan begitu rules yang saya gunakan adalah:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^([^/.]+)/([^/.]+)/$ /article.php?year=$1&amp;slug=$2 [L]</code></pre>\r\n\r\n<h2>Common Pitfalls</h2>\r\n\r\n<p>Ada beberapa &ldquo;pitfalls&rdquo; yang perlu anda perhatikan. Hal-hal ini penting karena akan mempengaruhi apa rules yang anda tulis berkerja atau tidak.</p>\r\n\r\n<h3>Kadang Tidak Berkerja Di Localhost</h3>\r\n\r\n<p>Terkadang rewrite rules tidak berkerja di localhost. Mungkin ini karena anda tidak memiliki modul <code>mod_rewrite</code> atau mungkin modul ini tidak aktif. Satu cara untuk membenarkan ini adalah dengan menginstall ulang web server yang anda gunakan.</p>\r\n\r\n<p>Cara yang saya gunakan adalah dengan mengabaikan localhost sepenuhnya. Saat dilocalhost saya menggunakan URL biasa dan saya akan mendesign rewrite rule agar berkerja saat saya upload ke host. <strong>Ingat, file .htaccess harus di upload ke host bersamaan dengan file-file lain.</strong> Cara ini sedikit susah dan tidak nyaman tetapi merupakan sebuah solusi dimana anda tidak perlu mengutak-atik komputer anda. Saya sendiri masih mencari solusi yang lebih pasti. Artinya saya tidak bisa bernavigasi secara offline.</p>\r\n\r\n<h3>Gunakan Absolute Link</h3>\r\n\r\n<p>Sebuah karakteristik rewrite rules yang menjengkelkan adalah rules tidak hanya diterapkan ke file yang dituju tetapi juga semua link yang ada didalam file tersebut.</p>\r\n\r\n<p>Berarti, bila anda menggunakan relative link untuk link CSS, JS, navigasi dan gambar, semua link ini akan dipengaruhi oleh rewrite rule. Biasanya hasilnya, style dan gambar di halaman anda tidak tampil dan anda tidak bisa bernavigasi ke halaman lain. Oleh karena itu gunakan absolute link sebisa mungkin.</p>\r\n\r\n<h2>Useful Snippets</h2>\r\n\r\n<h3>Menghilangkan File Extentions</h3>\r\n\r\n<p>Kadang untuk menampilkan URL yang rapih kita ingin menghilangkan extension dari file. URL <em>/about.php</em> ini kita jadikan <em>/about</em>. Caranya adalah dengan menggunakan rule ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^([^/.]+)$ /$1.php [L]</code></pre>\r\n\r\n<h3>Metode Get Masih Berkerja</h3>\r\n\r\n<p>Kita sudah menghilangkan file extentions. Tetapi kadang anda masih ingin menggunakan metode <code>$_GET</code> secara traditional. Ini masih bisa dilakukan tanpa perlu menulis rules tambahan apapun. Jadi <em>/about?section=mission</em> masih akan melemparkan value <code>mission</code> ke variable get <code>section</code>.</p>\r\n\r\n<h3>Mengecualikan Sebuah Directory</h3>\r\n\r\n<p>Kadang mengecualikan sebuah directory merupakan sesuatu yang menguntungkan. Contohnya adalah folder dimana file admin berada. Kita tidak memerlukan URL cantik untuk admin. Oleh karena itu dari pada admin kita memiliki banyak error yang dikarenakan oleh pitfalls yang tadi dijelaskan, lebih baik kita kecualikan dari aturan rewrite rules.</p>\r\n\r\n<p>Contohnya file yang ingin dikecualikan ada di dalam folder bernama <em>source</em>. Rule kita menjadi seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^source - [L]</code></pre>\r\n\r\n<p>Dash setelah nama folder berarti rules tidak akan melakukan apapun ke folder ini berserta isinya. Bila ingin mengecualikan folder admin, ganti <em>source</em> ke nama folder dimana file admin berada. Contohnya seperti ini:</p>\r\n\r\n<pre>\r\n<code>RewriteRule ^admin - [L]</code></pre>\r\n\r\n<h3>Rules Yang Saya Gunakan Untuk Website Ini</h3>\r\n\r\n<p>Sebagai referensi, ini adalah semua rules yang digunakan untuk website ini.</p>\r\n\r\n<pre>\r\n<code>RewriteEngine On\r\nRewriteRule ^admin - [L]\r\nRewriteRule ^article/([^/.]+)/?$ /post.php?slug=$1 [L]\r\nRewriteRule ^articles/([^/.]+)/?$ /articles.php?page=$1 [L]\r\nRewriteRule ^([^/.]+)/?$ /$1.php [L]</code></pre>\r\n\r\n<p>Seperti yang anda lihat, website ini mengecualikan folder admin dimana system website ini berada. Rules ini diikuti oleh beberapa rules lain yang akan mempercantik setiap halaman article. Ditemukan juga rules yang menghilangkan extensi file.</p>\r\n\r\n<p>.htAccess, terutama <code>mod_rewrite</code>, bukanlah sebuah teknologi yang gampang dimengerti dan diterapkan. Tetapi terlihat keuntungan yang didapatkan dari teknologi ini dan saya rasa ini sepadan dengan kesulitan yang akan dialami saat mempelajarinya.</p>\r\n\r\n<p><em>Beberapa resources dan contoh dari article ini diambil dari article <a href="http://24ways.org/2013/url-rewriting-for-the-fearful/" target="_blank">URL Rewriting for the Fearful</a> oleh Drew McLellan.</em></p>\r\n', '2016-04-13', '35Untitled.jpg', 'Ervina Nurhayati', 0),
(59, 13, 'Membuat Kop Surat dengan FPDF', 'membuat-kop-surat-dengan-fpdf', '<p>Sebagai catatan, setelah lumayan pening bagi pemula untuk belajar FPDF. untuk membuat sebuah Kop yang digenerate menjadi PDF pada browser.</p>\r\n\r\n<p>langkah pertama silahkan download FPDF <a href="http://www.fpdf.org/en/download.php" target="_blank">disini</a>. Selanjutnya siapkan gambar yang akan dijadikan logo pada kop yang akan digunakan. Selajutnya kita buat listing sebagai berikut:</p>\r\n\r\n<p><strong>&lt;?php</strong><br />\r\n<strong>//include master file</strong><br />\r\n<strong>require(&lsquo;fpdf.php&rsquo;);</strong></p>\r\n\r\n<p>Tujuan perintah di atas untuk memasukkan file inti dari FPDF. Selanjutnya kita membuat turunan dengan menggunakan&nbsp;<strong>extends</strong></p>\r\n\r\n<p><strong>class pdf extends FPDF{</strong><br />\r\n<strong>function letak($gambar){</strong><br />\r\n<strong>//memasukkan gambar untuk header</strong><br />\r\n<strong>$this-&gt;Image($gambar,10,10,20,25);</strong><br />\r\n<strong>//menggeser posisi sekarang</strong><br />\r\n<strong>}</strong></p>\r\n\r\n<p>fungsi letak digunakan untuk memasukkan gambar pada lembar PDF yang akan dibuat, perintah&nbsp;<strong>Image</strong> merupakan methed untuk memanggila gambar yang akan dimasukan dengan&nbsp;<strong>$gambar&nbsp;</strong>sebagai variabel yang akan menyimpan&nbsp;<strong>path directory</strong> dimana gambar tersimpan. angka&nbsp;<strong>10, 10, 20, 25&nbsp;</strong>&nbsp;untuk mengatur letak y absis dari gambar tersebut dengan nilai 10 dan lebar dan tinggi gambar dengan ukuran 20 dan 25.</p>\r\n\r\n<p>untuk memasukkan teks disamping gambar gunakan code dibawh ini:</p>\r\n\r\n<p><strong>function judul($teks1, $teks2, $teks3, $teks4, $teks5){</strong><br />\r\n<strong>$this-&gt;Cell(25);</strong><br />\r\n<strong>$this-&gt;SetFont(&lsquo;Times&rsquo;,&rsquo;B&rsquo;,&rsquo;12&rsquo;);</strong><br />\r\n<strong>$this-&gt;Cell(0,5,$teks1,0,1,&rsquo;C&rsquo;);</strong><br />\r\n<strong>$this-&gt;Cell(25);</strong><br />\r\n<strong>$this-&gt;Cell(0,5,$teks2,0,1,&rsquo;C&rsquo;);</strong><br />\r\n<strong>$this-&gt;Cell(25);</strong><br />\r\n<strong>$this-&gt;SetFont(&lsquo;Times&rsquo;,&rsquo;B&rsquo;,&rsquo;15&rsquo;);</strong><br />\r\n<strong>$this-&gt;Cell(0,5,$teks3,0,1,&rsquo;C&rsquo;);</strong><br />\r\n<strong>$this-&gt;Cell(25);</strong><br />\r\n<strong>$this-&gt;SetFont(&lsquo;Times&rsquo;,&rsquo;I&rsquo;,&rsquo;8&prime;);</strong><br />\r\n<strong>$this-&gt;Cell(0,5,$teks4,0,1,&rsquo;C&rsquo;);</strong><br />\r\n<strong>$this-&gt;Cell(25);</strong><br />\r\n<strong>$this-&gt;Cell(0,2,$teks5,0,1,&rsquo;C&rsquo;);</strong><br />\r\n<strong>}</strong></p>\r\n\r\n<p>Perintah Cell untuk menggeser posisi sumbu X ke titik 25. Sedangkan untuk Cell yang bernilai 0, mengatur lebar teks sesuai ukuran kertas yang digunakan, nilai 5 sebagai tinggi baris dan variabel&nbsp;<strong>$teks</strong> sebagai isi dari tulisan kop yang akan digunakan. Nilai 0 artinya tidak menggunakan bingkai dan angka 1 pindah baris. Huruf C dalam arti center.</p>\r\n\r\n<p>selanjutnya membuat gari double dibawah dengan code dibawah ini</p>\r\n\r\n<p><strong>function garis(){</strong><br />\r\n<strong>$this-&gt;SetLineWidth(1);</strong><br />\r\n<strong>$this-&gt;Line(10,36,138,36);</strong><br />\r\n<strong>$this-&gt;SetLineWidth(0);</strong><br />\r\n<strong>$this-&gt;Line(10,37,138,37);</strong><br />\r\n<strong>}</strong></p>\r\n\r\n<p>Perintah SetLineWidth untuk mengatur lebar baris. Akhiri perintah seluruhnya dengan code dibawah ini</p>\r\n\r\n<p><strong>//instantisasi objek</strong><br />\r\n<strong>$pdf=new pdf();</strong></p>\r\n\r\n<p><strong>//Mulai dokumen</strong><br />\r\n<strong>$pdf-&gt;AddPage(&lsquo;P&rsquo;, &lsquo;A5&rsquo;);</strong><br />\r\n<strong>//meletakkan gambar</strong><br />\r\n<strong>$pdf-&gt;letak(&lsquo;image/logo.png&rsquo;);</strong><br />\r\n<strong>//meletakkan judul disamping logo diatas</strong><br />\r\n<strong>$pdf-&gt;judul(&lsquo;PEMERINTAH KOTA PAGAR ALAM&rsquo;, &lsquo;DINAS PENDIDIKAN&rsquo;,&rsquo;SEKOLAH MENENGAH ATAS NEGERI 4&prime;,&rsquo;Jambat Balo Pagar Alam Selatan Kota Pagar Alam Telp. (0730)622442&prime;, &lsquo;Website: <a href="http://sman4pagaralam.sch.id/">http://sman4pagaralam.sch.id</a> | E-Mail: <a href="mailto:smanegeri4pagaralam@gmail.com">smanegeri4pagaralam@gmail.com</a>&rsquo;);</strong><br />\r\n<strong>//membuat garis ganda tebal dan tipis</strong><br />\r\n<strong>$pdf-&gt;garis();</strong></p>\r\n\r\n<p><strong>$pdf-&gt;Output(&lsquo;hasilunsman4pga.pdf&rsquo;,&rsquo;I&rsquo;);</strong></p>\r\n', '2016-04-14', '96test.jpg', 'Ervina Nurhayati', 0),
(60, 14, 'Membuat Autocomplete Menggunakan jQuery, PHP, MySQL ', 'membuat-autocomplete-menggunakan-jquery-php-mysql-', '<p>Tutorial saya kali ini adalah membuat fitur <em>Autocomplete menggunakan jQuery, PHP, dan MySQL</em>. Fitur Autocomplete adalah suatu fitur dari jQuery UI yang akan memberikan saran pencarian suatu data dalam elemen <em>textbox</em> HTML.<br />\r\n<br />\r\nJadi misalnya Anda mencari suatu string kata misalnya mencari nama kota di seluruh dunia dan Anda memasukan kata &quot;<em>Band</em>&quot; maka dari kata itu, fitur Autocomplete akan menampilkan nama-nama kota di seluruh dunia yang diawali kata tersebut.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>jQuery, jQuery UI, dan jQuery UI CSS</strong><br />\r\nFitur <a href="http://jqueryui.com/autocomplete/">Autocomplete</a> ini berasal dari <em>JavaScript Framework</em> khusus untuk interaksi dan efek tampilan yakni <a href="http://jqueryui.com/autocomplete/">jQuery UI</a>. Agar bisa berjalan, jQuery UI membutuhkan <a href="http://jquery.com/">jQuery</a>. Untuk itu Anda perlu mendownload file <a href="http://jqueryui.com/download/">jQuery UI</a> dan <a href="http://jquery.com/download/">jQuery</a>.<br />\r\n<br />\r\nKarena file jQuery UI membutuhkan fungsi atau interface yang ada di dalam file jQuery, maka saat menuliskan penyertaan filenya di dalam kode program, file jQuery dituliskan terlebih dahulu baru kemudian file jQuery UI-nya. Urutan penulisan kode program sangat berpengaruh di sini.<br />\r\n<br />\r\nContoh potongan skripnya dengan urutan yang benar:</p>\r\n\r\n<pre>\r\n&lt;script type=&quot;text/javascript&quot; src=&quot;jquery.js&quot;&gt;&lt;/script&gt;\r\n&lt;script type=&quot;text/javascript&quot; src=&quot;jquery-ui.js&quot;&gt;&lt;/script&gt;</pre>\r\n\r\n<p><br />\r\nTanpa file CSS, fitur Autocomplete ini terlihat aneh dan kurang nyaman dipandang. Untuk itu file CSS untuk jQuery UI diperlukan. File CSS untuk jQUery UI sudah disediakan oleh pengembangnya dan ada beberapa <a href="http://jqueryui.com/themeroller">themes</a> yang bisa Anda pakai. Untuk keperluan contoh ini, saya menggunakan file CSS: <a href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">jquery-ui.css</a>. Tambahkan file CSS tersebut ke dalam file web Autocomplete Anda.<br />\r\n<br />\r\n<strong>Membuat jQuery UI Autocomplete</strong><br />\r\nUntuk menggunakan fitur Autocomplete pada elemen textbox, cukup sertakan kode berikut:</p>\r\n\r\n<pre>\r\n&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n    &lt;title&gt;husnanlabs.blogspot.com&lt;/title&gt;\r\n    &lt;meta charset=&quot;utf-8&quot; /&gt;\r\n    &lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;style.css&quot; /&gt;\r\n    &lt;script type=&quot;text/javascript&quot; src=&quot;jquery.js&quot;&gt;&lt;/script&gt;\r\n    &lt;script type=&quot;text/javascript&quot; src=&quot;jquery-ui.js&quot;&gt;&lt;/script&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;div class=&quot;ui-widget&quot;&gt;\r\n    Kota: &lt;input type=&quot;text&quot; id=&quot;txtNamaKota&quot; name=&quot;txtNamaKota&quot; /&gt;\r\n    &lt;/div&gt;\r\n    &lt;script&gt;\r\n      var arrNamaKota = [&quot;Jakarta&quot;, &quot;Bandung&quot;, &quot;Semarang&quot;, &quot;Yogyakarta&quot;, &quot;Surabaya&quot;];\r\n      $(document).ready(function() { \r\n        $(&quot;#txtNamaKota&quot;).autocomplete({\r\n          source: arrNamaKota\r\n        });\r\n      });\r\n    &lt;/script&gt;\r\n  &lt;/body&gt;  \r\n&lt;/html&gt;</pre>\r\n\r\n<p><br />\r\nSekarang simpan file tersebut dalam sebuah file HTML kemudian jalankan melalui browser. Jika tidak ada masalah sekarang lanjut mengintegrasikannya dengan PHP dan MySQL.<br />\r\n<br />\r\n<strong>jQuery UI Autocomplete Menggunakan PHP dan MySQL</strong><br />\r\nSesuai dengan judul artikel saya ini, kita akan membuat sebuah contoh penggunaan fitur Autocomplete di dalam halaman web PHP dan database server MySQL.<br />\r\n<br />\r\nSebelum melangkah lebih lanjut, pastikan kode PHP Anda telah berhasil dihubungkan dengan database MySQL. Untuk keperluan contoh ini, saya memakai database yang disediakan oleh website MySQL yakni database <a href="http://downloads.mysql.com/docs/world_innodb.sql.zip">World</a>.<br />\r\n<br />\r\nModifikasi kode diatas dengan menambahkan script atau kode untuk menghubungkan ke database server MySQL. Pada contoh ini saya telah mendefinisikan scriptnya dalam file tersendiri yakni file <em>koneksi.php</em>, sehingga saya menuliskan scriptnya seperti ini:</p>\r\n\r\n<pre>\r\n&lt;?php\r\n  require_once &quot;koneksi.php&quot;;\r\n?&gt;</pre>\r\n\r\n<p><br />\r\nSelanjutnya tulislah script atau kode PHP berikut ke dalam file autocomplete yang Anda buat tadi. Dalam contoh ini saya menuliskannya di atas sendiri setelah script untuk proses koneksi ke database.</p>\r\n\r\n<pre>\r\n&lt;?php\r\n  $sql = &quot;SELECT Name FROM City&quot;;\r\n  $arrNamaKota = array();\r\n        \r\n  try {\r\n    $query = $koneksi-&gt;prepare($sql);\r\n    $query-&gt;execute();\r\n    while($data = $query-&gt;fetch()) {\r\n      $arrNamaKota[] = $data[&quot;Name&quot;];\r\n    }\r\n  }\r\n  catch (PDOException $e) {\r\n    echo $e-&gt;getMessage();\r\n  }\r\n?&gt;</pre>\r\n\r\n<p><br />\r\nKarena proses yang terjadi melibatkan pengambilan sejumlah data dari database MySQL, maka diperlukan perintah SQL: <code>SELECT</code>. Kemudian diperlukan juga sebuah variabel array PHP yang fungsinya untuk menampung semua data hasil query <code>SELECT</code>. Dalam contoh ini variabel <code>$arrNamaKota</code> akan menampung semua kota yang didapat dari query <code>SELECT</code>.<br />\r\n<br />\r\nDalam contoh ini saya menggunakan <a href="http://php.net/PDO">PDO</a> (PHP Data Object) untuk mengambil data dari database server MySQL. Anda dapat menggunakan perintah prosedural seperti fungsi <a href="http://php.net/manual/en/function.mysql-query.php">mysql_query()</a> namun penggunaan fungsi-fungsi prosedural tersebut tidak diajurkan lagi karena statusnya <em>deprecated</em> yang artinya sudah tidak dikembangkan lagi dan suatu saat fungsi-fungsi tersebut akan ditiadakan.<br />\r\n<br />\r\nSetelah data diambil dan dimasukkan ke dalam variabel array, data tersebut nantinya akan dimasukan ke dalam variabel array JavaScript melalui fungsi PHP <a href="http://php.net/manual/en/function.json-encode.php">json_encode()</a>. Untuk itu ganti definisi isian variabel JavaScript <code>arrNamaKota</code> untuk merujuk data yang diambil dari kode PHP melalui fungsi <code>json_encode()</code> ini. Untuk lebih jelasnya lihat proses pergantiannya melalui potongan kode berikut:</p>\r\n\r\n<pre>\r\nvar arrNamaKota = [&quot;Jakarta&quot;, &quot;Bandung&quot;, &quot;Semarang&quot;, &quot;Yogyakarta&quot;, &quot;Surabaya&quot;];</pre>\r\n\r\n<p><br />\r\nKode di atas diubah menjadi:</p>\r\n\r\n<pre>\r\nvar arrNamaKota = &lt;?php echo json_encode($arrNamaKota); ?&gt;;</pre>\r\n\r\n<p><br />\r\nUntuk memperjelas semuanya, berikut kode lengkap dari penggunaan jQuery UI Autocomplete yang diintegrasikan dengan PHP dan MySQL:</p>\r\n\r\n<pre>\r\n&lt;?php\r\n  require_once &quot;koneksi.php&quot;;\r\n\r\n  $sql = &quot;SELECT Name FROM City&quot;;\r\n  $arrNamaKota = array();\r\n        \r\n  try {\r\n    $query = $koneksi-&gt;prepare($sql);\r\n    $query-&gt;execute();\r\n    while($data = $query-&gt;fetch()) {\r\n      $arrNamaKota[] = $data[&quot;Name&quot;];\r\n    }\r\n  }\r\n  catch (PDOException $e) {\r\n    echo $e-&gt;getMessage();\r\n  }\r\n?&gt;\r\n\r\n&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n  &lt;head&gt;\r\n    &lt;title&gt;husnanlabs.blogspot.com&lt;/title&gt;\r\n    &lt;meta charset=&quot;utf-8&quot; /&gt;\r\n    &lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;style.css&quot; /&gt;\r\n    &lt;script type=&quot;text/javascript&quot; src=&quot;jquery.js&quot;&gt;&lt;/script&gt;\r\n    &lt;script type=&quot;text/javascript&quot; src=&quot;jquery-ui.js&quot;&gt;&lt;/script&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;div class=&quot;ui-widget&quot;&gt;\r\n    Kota: &lt;input type=&quot;text&quot; id=&quot;txtNamaKota&quot; name=&quot;txtNamaKota&quot; /&gt;\r\n    &lt;/div&gt;\r\n    &lt;script&gt;\r\n      var arrNamaKota = &lt;?php echo json_encode($arrNamaKota); ?&gt;;\r\n      $(document).ready(function() { \r\n        $(&quot;#txtNamaKota&quot;).autocomplete({\r\n          source: arrNamaKota\r\n        });\r\n      });\r\n    &lt;/script&gt;\r\n  &lt;/body&gt;  \r\n&lt;/html&gt;  </pre>\r\n', '2016-04-14', '6autocomplete-jquery-php-mysql.jpg', 'Ervina Nurhayati', 0),
(63, 21, 'Pengertian Linux â€“ Sistem Operasi Linux', 'pengertian-linux-â€“-sistem-operasi-linux', '<p>Pengguna komputer di indonesia saat ini kebanyakan menggunakan sistem operasi buatan dari microsoft, yaitu microsoft windows. hal itu wajar saja terjadi, karena sistem operasi windows lebih dulu hadir di Indonesia ketimbang sistem operasi linux.</p>\r\n\r\n<p>mungkin anda semua yang telah mengerti tentang komputer, sudah memahami bahwa sistem operasi windows bukanlah software yang bebas disebarluaskan, anda harus mengeluarkan biaya lisensi untuk bisa menginstal secara legal di komputer anda, tapi jika anda tidak mengeluarkan biaya lisensi, berarti bisa dikatakan windows yang anda gunakan adalah bajakan.</p>\r\n\r\n<p>pada tulisan ini saya akan membahas sedikit tentang&nbsp;<strong>Pengertian Linux</strong>.&nbsp;<em>Pengertian linux adalah</em>&nbsp;software sistem&nbsp;operasi open source yang gratis untuk disebarluaskan di bawah lisensi GNU. jadi anda diijinkan untuk menginstal pada komputer anda ataupun mengkopi dan menyebarluaskannya tanpa harus membayar. linux merupakan turunan dari unix dan dapat bekerja pada berbagai macam perangkat keras koputer mulai dari intel x86 sampai dengan RISC. Dengan lisensi GNU (Gnu Not Unix) Anda dapat memperoleh program, lengkap dengan kode sumbernya (source code). Tidak hanya itu, Anda diberikan hak untuk mengkopi sebanyak Anda mau, atau bahkan mengubah kode sumbernya.Dan itu semua legal dibawah lisensi. Meskipun gratis, lisensi GNU memperbolehkan pihak yang ingin menarik biaya untuk penggandaan maupun pengiriman program.</p>\r\n\r\n<p>Kebebasan yang paling penting dari Linux, terutama bagi programmer dan administrator jaringan, adalah kebebasan untuk memperoleh kode sumber (source code) dan kebebasan untuk mengubahnya. Ini berimplikasi pada beberapa hal penting. Pertama keamanan, yang kedua dinamika.</p>\r\n\r\n<p>Jika perangkat lunak komersial tidak memperkenankan Anda untuk mengetahui kode sumbernya maka Anda tidak akan pernah tahu apakah program yang Anda beli dari mereka itu aman atau tidak (sering disebut security by obscurity). Hidup Anda di tangan para vendor. Dan jika ada pemberitahuan tentang bug dari perangkat lunak komersial tersebut, seringkali sudah terlambat. Dengan Linux, Anda dapat meneliti kode sumbernya langsung, bersama dengan pengguna Linux lainnya. Berkembangnya pengguna Linux sebagai komunitas yang terbuka, membuat bug akan cepat diketahui, dan secepat itu pula para programmer akan memperbaiki programnya. Anda sendiri juga yang menentukan kode yang cocok sesuai dengan perangkat keras maupun kebutuhan dasar perangkat lunak lainnya untuk dapat diimplementasikan. Ibarat sebuah mobil, Anda bisa memodifikasi sesukanya, bahkan hingga mesin sekalipun, untuk memperoleh bentuk yang diinginkan.</p>\r\n\r\n<p>Keterbukaan kode sumber juga memungkinkan sistem operasi berkembang dengan pesat. Jika sebuah program dengan sistem tertutup dan hanya dikembangkan oleh vendor tertentu, paling banyak sekitar seribu hingga lima ribu orang. Sedangkan Linux, dengan keterbukaan kode sumbernya, dikembangkan oleh sukarelawan seluruh dunia. Bug lebih cepat diketahui dan program penambalnya (patch) lebih cepat tersedia. Pendekatan pengembangan sistem operasi ini disebut Bazaar. Kebalikannya sistem Chatedraal sangat tertutup dan hanya berpusat pada satu atau dua pengembang saja.</p>\r\n\r\n<p>linux saat ini telah berkembang menjadi banyak distro (distribusi linux), misalnya adalah distro Redhat, Debian, Suse. saat ini distro linux yang sangat populer di gunakan di indonesia adalah distro Ubuntu yang merupakan turunan dari Debian.</p>\r\n', '2016-04-14', '43aja.jpg', 'Ervina Nurhayati', 0),
(64, 17, 'Pengenalan Pemrograman Java', 'pengenalan-pemrograman-java', '<p><strong>Java Development Kit</strong></p>\r\n\r\n<p>Java Development Kit merupakan perangkat lunak yang digunakan untuk melakukan proses kompilasi dari kode Java menjadi <em>bytecode</em> yang dapat dimengerti dan dapat dijalankan oleh Java Runtime Environtment.</p>\r\n\r\n<p>Java Development Kit wajib terinstall pada komputer yang akan melakukan proses pembuatan aplikasi berbasis Java. Namun Java Development Kit tidak wajib terinstall di komputer yang akan menjalankan aplikasi yang dibangun menggunakan Java.</p>\r\n\r\n<p><strong>Java Runtime Environtment</strong></p>\r\n\r\n<p>Java Runtime Environtment merupakan perangkat lunak yang digunakan untuk menjalankan aplikasi yang dibangun menggunakan java. Versi JRE harus sama atau lebih tinggi dari JDK yang digunakan untuk membangun aplikasi agar aplikasi dapat berjalan sesuai dengan yang diharapkan.</p>\r\n\r\n<h2>NetBeans IDE</h2>\r\n\r\n<p>NetBeans IDE merupakan perangkat lunak yang digunakan untuk membangun perangkat lunak yang lain. NetBeans IDE dapat digunakan untuk membangun perangkat lunak berbasis Java Standard Edition, Java Enterprise Edition, Java Micro Edition, JavaFX, PHP, C/C++, Ruby, Groovy dan Python.</p>\r\n', '2016-04-14', '57mmm.jpg', 'Ervina Nurhayati', 5);
INSERT INTO `berita` (`id_berita`, `id_kategori`, `nama_berita`, `nama_beritaseo`, `deskripsi`, `tgl_masuk`, `gambar`, `pembuat`, `komentar`) VALUES
(65, 21, 'Macam-macam Operating System', 'macammacam-operating-system', '<p><em>Operating system</em> atau <em>OS</em> adalah <a href="http://id.wikipedia.org/wiki/Perangkat_lunak_sistem">p</a><a href="http://id.wikipedia.org/wiki/Perangkat_lunak_sistem">e</a>rangkaat lunak sistem yang bertugas untuk melakukan kontrol dan manajemen perangkat keras serta operasi-operasi dasar sistem, termasuk menjalankan software aplikasi seperti program-program pengolah kata dan browser web.</p>\r\n\r\n<ul>\r\n	<li>UNIX\r\n	<ul>\r\n		<li>Termasuk sistem operasi yang paling awal ada untuk komputer. Merupakan induk dari sistem operasi linux.</li>\r\n	</ul>\r\n	</li>\r\n	<li>DOS\r\n	<ul>\r\n		<li>Sistem operasi yang merupakan cikal bakal dari Microsoft Windows. Ciri khasnya yaitu berupa teks putih dengan latar belakang hitam. Kalau mau mencobanya bisa lewat Start Windows &ndash; Run, lalu ketik cmd.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Novell Operating Sistem\r\n	<ul>\r\n		<li>Dibuat oleh Novell Corporation. Sistem operasi yang dulu pernaha digunakan oleh Fakultas MIPA UGM untuk Entry Key-In KRS mahasiswa.</li>\r\n	</ul>\r\n	</li>\r\n	<li>&nbsp;Microsoft Windows\r\n	<ul>\r\n		<li>Merupakan sistem operasi yang paling populer. Hampir semua orang pernah memakainya. Beberapa versi Microsoft Windows yang terkenal: Microsoft Windows 98, 2000, Me, XP, Vista, dan yang paling terbaru Windows 7. 5 . Apple Machintos.</li>\r\n		<li>System operasi yang unggul dalam hal grafik. Memerlukan hardware khusus sehingga tidak dapat diinstall di computer biasa. Versinya antara lain Mac OS X (Tiger), Leopard.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Linux\r\n	<ul>\r\n		<li>Pertama kali dikembangkan oleh Linus Torvald. Merupakan sistem operasi open source artinya bisa dikembangkan oleh semua orang dengan bebas. Turunan linux atau yang dikenal dengan distro linux banyak sekali macamnya. Mungkin linux merupakan sistem operasi yang paling banyak. Beberapa di antaranya yaitu: Debian, Suse, Red Hat (Fedora), Slackware, Ubuntu, Backtrack, dan lain-lain 7 . Solaris</li>\r\n		<li>Dikembangkan oleh Sun Microsystem. Lebih banyak digunakan untuk perusahaan.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Free BSD\r\n	<ul>\r\n		<li>Dibuat oleh Universitas Berkeley. Hampir sama seperti linux.Selain itu juga terdapat OS untuk handphone yaitu antara lain:\r\n		<ul>\r\n			<li>Symbian\r\n			<ul>\r\n				<li>Sistem operasi yang populer di kalangan para pengguna handphone. Kebanyakan handphone nokia menggunakan symbian sebagai sistem operasi. Versinya antara lain S40, S60, S9</li>\r\n			</ul>\r\n			</li>\r\n			<li>Microsoft Windows Mobile\r\n			<ul>\r\n				<li>Sistem operasi yang dikeluarkan oleh Microsoft untuk smartphone dan PDA. Tampilannya hampir sama dengan Windows pada komputer.</li>\r\n			</ul>\r\n			</li>\r\n			<li>Palm OS\r\n			<ul>\r\n				<li>Sistem operasi yang digunakan pada PDA keluaran PALM.</li>\r\n			</ul>\r\n			</li>\r\n			<li>Android\r\n			<ul>\r\n				<li>Sistem operasi untuk handphone yang akan diluncurkan Google. Android berbasis Linux sehingga termasuk open source.</li>\r\n			</ul>\r\n			</li>\r\n		</ul>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n', '2016-04-14', '91OS.jpg', 'Ervina Nurhayati', 0),
(62, 15, 'Pengenalan css', 'pengenalan-css', '<p>CSS adalah standar pembuatan dan pemakaian style (font, warna, jarak baris, dll) untuk dokumen terstruktur.CSS memisahkan presentation sebuah dokumen dari content dokumen itu sendiri.CSS memudahkan pembuatan dan pemeliharaan dokumen webSetiap User Agent mempunyai default style sheet.Pendefinisian rule CSS pada sebuah dokumen akan menimpa rule pada default style sheet.CSS sendiri dalam dunia Pemrograman sangat diperlukan untuk membuat interface yang menarik.</p>\r\n\r\n<ul>\r\n	<li>Spesifikasi CSS1, http://www.w3.org/TR/REC-CSS1</li>\r\n	<li>Spesifikasi CSS2, http://www.w3.org/TR/REC-CSS2</li>\r\n</ul>\r\n\r\n<p><strong>Sintaks Rule</strong></p>\r\n\r\n<p>Style sheet didefinisikan dalam bentuk rule, terdiri dari:</p>\r\n\r\n<ul>\r\n	<li>Selector</li>\r\n	<li>Declaration : property &amp; value</li>\r\n</ul>\r\n\r\n<p>Contoh rule :</p>\r\n\r\n<p>h1 { color: blue }</p>\r\n\r\n<p>Keterangan:</p>\r\n\r\n<ul>\r\n	<li>Selector : h1</li>\r\n	<li>Property : color</li>\r\n	<li>Value : blue</li>\r\n</ul>\r\n\r\n<p>Seluruh elemen (tag) HTML dapat digunakan sebagai selector.</p>\r\n\r\n<p><strong>Kategori Style Sheet</strong></p>\r\n\r\n<ul>\r\n	<li>Inline Style Sheet (di dalam elemen HTML)\r\n	<ul>\r\n		<li>\r\n		<p>&nbsp;</p>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n	<li>Embedded Style Sheet (di dalam dokumen HTML)</li>\r\n</ul>\r\n\r\n<blockquote>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li>Linked Style Sheet (di file eksternal)</li>\r\n</ul>\r\n\r\n<blockquote>\r\n<p>&nbsp;</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp; Isi file eksternal sama dengan kode di antara tag</p>\r\n\r\n<ul>\r\n	<li>Default Style Sheet (style default dari browser)</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', '2016-04-14', '94hal soal.jpg', 'Ervina Nurhayati', 0),
(66, 14, 'Pengenalan AJAX ', 'pengenalan-ajax-', '<p>AJAX adalah singkatan dari Asynchronous JavaScript and XML.</p>\r\n\r\n<p>AJAX, terdiri dari HTML, Javascript, DHTML dan DOM yang kemudian digabungkan dengan bahasa pemograman web di sisi server seperti PHP dan ASP, sehingga membentuk suatu aplikasi berbasis web yang interaktif.</p>\r\n\r\n<p>AJAX bukanlah bahasa pemograman baru, tetapi adalah teknik baru untuk membuat aplikasi web lebih baik, lebih cepat dan lebih interaktif.&nbsp;</p>\r\n\r\n<p>Dengan AJAX, Javascript dapat langsung berkomunikasi dengan server dengan menggunakan objek XMLHttpRequest. Dengan objek ini, javascript dapat melakukan transaksi data denga server web, tanpa harus me-reloading halaman web tersebut secara keseluruhan.</p>\r\n\r\n<p>Berikut adalah teknologi yang termasuk dalam aplikasi AJAX :</p>\r\n\r\n<ul>\r\n	<li>HTML yang digunakan untuk membuat Web forms dan mengindentifikasikan filed-field yang akan anda gunakan dalam aplikasi.</li>\r\n	<li>JavaScript adalah kode inti untuk menjalankanaplikasi Ajax dan untuk membantu memfasilitasi komunikasi dengan aplikasi .</li>\r\n	<li>DHTML, atau Dynamic HTML, membantu anda untuk membuat form atau web anda dinamis. Anda akan menggunakan &lt;div&gt;, &lt;span&gt; dan elemen HTML dinamis lainya.</li>\r\n	<li>DOM, Document Object Model, akan digunakan (melalui kode JavaScript) untuk bekerja dengan kedua struktur dari HTML dan XML anda yang dalam beberapa kasus berasal dari server.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>XMLHttpRequest</strong>&nbsp;</p>\r\n\r\n<p>Objek pertama yang harus anda mengerti adalah XMLHttpRequest, mungkin bagi anda terdengar sesuatu yang baru. Ini adalah objek javascript dan membuatnya sederhana seperti ditunjukkan di kode 1 di bawah ini :</p>\r\n\r\n<p>Kode 1. Membuat objek XMLHttpRequest.</p>\r\n\r\n<table border="" cellpadding="0" cellspacing="0" style="width:593px">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:593px">\r\n			<p>&lt;script language=&quot;javascript&quot; type=&quot;text/javascript&quot;&gt; var xmlHttp = new XMLHttpRequest();</p>\r\n\r\n			<p>&lt;/script&gt;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Untuk mendapatkan dan mengirim data dari/ke suatu database atau file di server menggunakan javascript tradisional, maka anda harus membuat HTML Form. Dan user harus mengklik tombol &ldquo;submit&rdquo; untuk mengirim/mendapatkan informasi, menunggu respon dari server, kemudian halaman yang baru berupa hasilnya akan di-load. Karena server selalu memberikan halaman baru setiap user tekan tombol submit, aplikasi web sederhana akan berjalan lambat dan akan kurang user-friendly.</p>\r\n\r\n<p>Dengan Ajax, javascript akan berkomunikasi secara langsung dengan server melalui objek javascript yaitu XMLHttpRequest tersebut.</p>\r\n\r\n<p>Dengan objek XMLHttpRequest, suatu halaman web dapat membuat request ke, dan mendapatkan respon dari server web tanpa me-reload halaman secara keseluruhan. User akan selalu tetap dengan halaman yang sama. Bahkan user tidak akan tahu kalau ada data yang dikirim dan diterima dari server, karena javascript melakukan transaksi data di balik layar.&nbsp;</p>\r\n\r\n<p>Bagusnya lagi permintaan dikirim asynchronous, yang berarti bahwa kode JavaScript (dan pengguna) tidak menunggu pada server untuk merespon. Sehingga pengguna dapat terus memasukkan data, bergulir sekitar, dan menggunakan aplikasi.</p>\r\n\r\n<p>Kode JavaScript bahkan bisa mendapatkan data, melakukan perhitungan, dan mengirim permintaan lain, semua tanpa campur tangan pengguna! Ini adalah kekuatan dari</p>\r\n\r\n<p>XMLHttpRequest. Hal ini dapat bicara bolak-balik dengan server semua yang diinginkan, tanpa pernah tahu pengguna tentang apa yang sebenarnya terjadi. Hasilnya adalah, dinamis responsif, pengalaman yang sangat interaktif seperti aplikasi desktop, tapi dengan semua kekuatan Internet di belakangnya.</p>\r\n\r\n<p>Objek XMLHttpRequest disupport hampir semua browser (Internet Explorer, Firefox, Chrome, Opera, dan Safari).</p>\r\n\r\n<p>Untuk membuat objek XMLHttpRequest supaya bisa didukung oleh beberapa browser adalah sebagai berikut :</p>\r\n\r\n<p>Kode 2. Membuat objek XMLHttpRequest untuk beberapa browser.</p>\r\n\r\n<table border="" cellpadding="0" cellspacing="0" style="width:593px">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:593px">\r\n			<p>if (window.XMLHttpRequest)</p>\r\n\r\n			<p>&nbsp; {</p>\r\n\r\n			<p>&nbsp; // kode untuk IE7+, Firefox, Chrome, Opera, Safari&nbsp;&nbsp; return new XMLHttpRequest();</p>\r\n\r\n			<p>&nbsp; } if (window.ActiveXObject)</p>\r\n\r\n			<p>&nbsp; {</p>\r\n\r\n			<p>&nbsp; // kode untuk IE6, IE5&nbsp;&nbsp; return new ActiveXObject(&quot;Microsoft.XMLHTTP&quot;);&nbsp;&nbsp; }</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2016-04-15', '73Untitled.jpg', 'Totok Rantoni', 0),
(67, 13, 'Membuat Framework Class dengan OOP PHP â€“ bagian 1', 'membuat-framework-class-dengan-oop-php-â€“-bagian-1', '<h1>Pendahuluan</h1>\r\n\r\n<p>Pada sesi bagian dua ini kita akan mempelajari tentang bagaimana sebuah session bekerja pada setiap pengunjung web. Pada saat web kita dikunjungi oleh para pengguna internet, secara otomatis php akan menginisialisasi identitas komputer pengunjung dengan membuat cookies di browser bernama PHPSESSID. Nama cookies &ldquo;PHPSESSID&rdquo; ini dapat anda rubah sendiri di file php.ini bagian session jika anda ingin menggunakan nama yang lain. Fungsi dari cookies ini adalah untuk proses mengidentifikasi browser pengunjung dan mensynchronize data-data input yang dikirimkan pengunjung dengan file session yang tersimpan pada server, dimana isi dari cookie PHPSESSID ini adalah berupa karakter hash (finger print ID) yang biasanya berupa output karakter dari hasil MD5. Sebenarnya PHP sendiri memberikan kebebasan kepada kita untuk memodifikasi fungsi session bawaan dari PHP.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Isi</h1>\r\n\r\n<p>Di class session tersebut anda dapat melihat 3 macam mode session yaitu dengan menggunakan default session dari PHP, file session yang dibuat sendiri, dan yang ketiga session yang diletakkan di database server (note : untuk yang didatabase server blm sempat saya buat). Pada artikel ini yang akan saya bahas adalah cara membuat session yang diletakkan pada file sendiri (mode kedua). Pertama-tama dalam membuat session, kita harus membuat tanda pada browser pengunjung dengan meletakkan cookie dibrowsernya. Identitas session ID ini dapat di generate dengan mengambil variable environment yang didapat dari identitas pengunjung kemudian dari kumpulan identitas tersebut kita bundle jadi satu dan kita buat string signature dengan MD5.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>$this-&gt;directory = ROOT_DIR.SESS_TMP_DIR; // didapat dari configuration file config.ini.php $cookie = $this-&gt;_getCookie($this-&gt;sess_name); // check apakah cookie PHPSESSID sudah ada if(!empty($cookie)) $this-&gt;id = $cookie; if(!USE_PHP_DEFAULT_HANDLER) { // didapat dari configuration file config.ini.php&nbsp;&nbsp;&nbsp; if(empty($cookie)&amp;&amp;($this-&gt;type==SESS_TYPE_FILE)) $this-&gt;generate_id();&nbsp;&nbsp;&nbsp; else $this-&gt;sess_file = $this-&gt;directory. &quot;/sess_&quot; .$cookie; }</p>\r\n\r\n<p>// fungsi untuk membuat cookie signature identity pada browser pengunjung <strong>function</strong> _generate_id() {</p>\r\n\r\n<p>&nbsp;&nbsp; $this-&gt;id= md5(microtime()<strong>.</strong>getenv(&#39;HTTP_ACCEPT_CHARSET&#39;)<strong>.</strong>getenv(&#39;HTTP_ACCEPT_ENCODING&#39;)<strong>.</strong>getenv(&#39;HTTP_A CCEPT_LANGUAGE&#39;)<strong>.</strong>getenv(&#39;REMOTE_ADDR&#39;)<strong>.</strong>getenv(&#39;HTTP_USER_AGENT&#39;)<strong>.</strong>getenv(&#39;REMOTE_HOST&#39;).get env(&#39;REMOTE_PORT&#39;));&nbsp;&nbsp;&nbsp; return $this-&gt;id;</p>\r\n\r\n<p>}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Fungsi _generate_id() diatas dapat kita lihat, semua isi dari variable environment diambil dari identitas browser pengunjung, kemudian untuk lebih uniknya kita tambahkan waktu aksesnya yaitu microtime(), mungkin ada yang bertanya-tanya kenapa tidak menggunakan fungsi time() karena fungsi microtime lebih detail (micro seconds). Harap diperhatikan untuk class session yang kita buat ini, fungsi session_start() bawaan dari PHP tidak akan digunakan karena fungsi tersebut hanya berlaku jika kita set jenis sessionnya adalah session default PHP, jadi yang kita buat diatas adalah fungsi pengganti dari session_start().</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Setelah kita membuat cookies pada browser pengguna langkah berikutnya adalah kita membuat file temporary yang digunakan untuk menampung variabel-variabel session dari pengunjung.</p>\r\n\r\n<p>File temporary ini dibuat pada saat kita meregisterkan variable-variable session ke server, perintah register variable ini kemudian akan mengecek apakah file bernama sess_[md5_session_id] ada di dalam direktori tempat session temp (lihat di file config), jika ada simpan variabel-variabel session ke file tersebut. <strong>function</strong> register($name) {</p>\r\n\r\n<p>&nbsp;&nbsp; if($this-&gt;type==SESS_TYPE_FILE) {</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp; $fid = fopen($this-&gt;directory<strong> .</strong> &quot;/sess_&quot; <strong>.</strong> $this-&gt;_getCookie($this-&gt;sess_name), &quot;w&quot;);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if(!$fid) { fwrite($fid, serialize($GLOBALS[$this-&gt;_varname]));</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp; }</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp; fclose($fid);</p>\r\n\r\n<p>&nbsp;&nbsp; }</p>\r\n\r\n<p>}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Fungsi register diatas adalah versi simplenya jika kita membuat temporary file session, untuk yang ada di file session.lib.php fungsi register session sudah memiliki data type filtering, jadi setiap tipe data berupa array atau objek dapat di simpan ke dalam file session dengan mengkonversi data dengan perintah serialize. Dan yang terakhir apabila pengunjung tersebut logout maka class session akan menghapus file sess_xxxxxxxxxx dari temporary directory.</p>\r\n\r\n<p>Dari penjelasan ini mungkin anda sudah bisa menangkap bagaimana sebuah session bekerja pada suatu website. Mungkin dari class-class yang saya jelaskan disini hanya untuk sebuah gambaran tentang bagaimana pemrograman berorientasi objek akan sangat membantu kita dalam mengurangi kegiatan coding terhadap prosedur-prosedur database yang monoton. Agar kita lebih dapat berkonsentrasi pada business processnya saja dan fungsionalitas web.&nbsp;</p>\r\n\r\n<p>Mengenai class-class framework yang lainnya saya tidak akan mengulas lagi disini, anda dapat mendownload contoh frameworknya dari code2art.com, framework ini terbuka bagi siapa saja yang ingin menambahkan fungsi di framework classnya. Mungkin sebelumnya mohon maaf jika website tersebut masih kosong pada saat anda membaca tulisan ini, karena saya masih belum mempunyai waktu untuk membuat pagenya. Trims&hellip;.. Salam Developer.</p>\r\n\r\n<h1>Penutup</h1>\r\n\r\n<blockquote>\r\n<p>Tidak ada gading yang tak retak, apabila anda masih belum mengerti mengenai penjelasan saya, anda dapat bertanya melalui email. Tetapi tidak ada sesuatu yang dapat dikuasai tanpa memerlukan proses pembelajaran (learning by doing), ketekunan dan kesabaran. Anda pasti bisa karena anda adalah manusia juga seperti saya, dan semuanya memerlukan suatu proses yang disebut dengan waktu. Ingatlah bahwa hidup tidak hanya didepan komputer, tetapi hidup tidak akan bervariasi tanpa pengetahuan. Selamat belajar.</p>\r\n</blockquote>\r\n', '2016-04-15', '76oop.jpg', 'Ervina Nurhayati', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_materi`
--

CREATE TABLE IF NOT EXISTS `file_materi` (
  `id_file` int(7) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_matapelajaran` varchar(5) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tgl_posting` date NOT NULL,
  `pembuat` varchar(50) NOT NULL,
  `hits` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_materi`
--

INSERT INTO `file_materi` (`id_file`, `judul`, `id_kelas`, `id_matapelajaran`, `nama_file`, `tgl_posting`, `pembuat`, `hits`) VALUES
(92, 'Contoh CV', '11rpl', 'BI2', 'CV Muhammad Farid H.doc', '2016-04-12', '6', 0),
(87, 'Materi Untuk Kelas X', '10rpl', 'BI1', 'latihan-b-indo-un-smk.pdf', '2016-04-12', '6', 0),
(89, 'Pembahasan', '10rpl', 'BI1', 'RPL_A_PEMBAHASAN.pdf', '2016-04-12', '6', 0),
(91, 'Kunci', '11rpl', 'BI2', 'KUNCI JAWABAN BAHASA INDOESIA SMK TIPE B.docx', '2016-04-12', '6', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_foto`
--

CREATE TABLE IF NOT EXISTS `galeri_foto` (
  `id_galerifoto` int(11) NOT NULL,
  `nama_foto` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galeri_foto`
--

INSERT INTO `galeri_foto` (`id_galerifoto`, `nama_foto`, `gambar`) VALUES
(14, 'Suasana di Pantai Tanah Lot', '4486IMG_8284.JPG'),
(15, 'Cibi Cibi', '246IMG_8257.JPG'),
(16, 'Salah Satu Siswi RPL', '4035_MG_8995.JPG'),
(17, 'Penyerahan Cindera mata di Stikom Bali', '7263_MG_8636.JPG'),
(18, 'Suasana di Penginapan saat Tour de Bali', '8735IMG-20151129-WA0003.jpg'),
(19, 'Di Laboratorium Stikom Bali', '8133_MG_8655.JPG'),
(20, 'Kebersamaan di Restourant saat Tour', '3962IMG_8180.JPG'),
(21, 'Kecerian di Tanjung Benoa', '142_MG_8450.JPG'),
(22, 'Kebersamaan RPL', '3268_MG_8931.JPG'),
(23, 'Temi Community', '7477IMG_20150806_134841.jpg'),
(24, 'Pondok Romadhon di As Sakinah', '6338IMG-20150624-WA0001.jpg'),
(25, 'Pondok Romadhon di As Sakinah Putri', '26IMG-20150624-WA0003.jpg'),
(26, 'Kunjungan Industri di Graha Pena dan JTV', '16IMG_4529.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
  `id` int(50) NOT NULL,
  `id_tq` int(50) NOT NULL,
  `id_quiz` int(50) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id`, `id_tq`, `id_quiz`, `id_siswa`, `jawaban`) VALUES
(5, 28, 77, 5, 'persamaan kata'),
(6, 28, 78, 5, 'perlawanan kata'),
(7, 29, 79, 5, 'persamaan kata'),
(8, 29, 80, 5, 'pelawanaan kata'),
(9, 29, 79, 7, 'persamaan kata atau makna seperti tabah dan tegar'),
(10, 29, 80, 7, 'perlawanan makna kata seperti baik buruk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_berita`
--

CREATE TABLE IF NOT EXISTS `kategori_berita` (
  `id_kategori` int(5) NOT NULL,
  `nama_kat` varchar(20) NOT NULL,
  `katberita_seo` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_berita`
--

INSERT INTO `kategori_berita` (`id_kategori`, `nama_kat`, `katberita_seo`) VALUES
(13, 'PHP', 'php'),
(14, 'JavaScript', 'javascript'),
(15, 'CSS', 'css'),
(16, 'HTML', 'html'),
(17, 'Java', 'java'),
(19, 'Wordpress', 'wordpress'),
(20, 'Teknologi', 'teknologi'),
(21, 'OS', 'os');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_prestasi`
--

CREATE TABLE IF NOT EXISTS `kategori_prestasi` (
  `id_kategoriprestasi` int(11) NOT NULL,
  `nama_katprestasi` varchar(50) NOT NULL,
  `kat_prestasiseo` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_prestasi`
--

INSERT INTO `kategori_prestasi` (`id_kategoriprestasi`, `nama_katprestasi`, `kat_prestasiseo`) VALUES
(2, 'Akademik', 'akademik'),
(3, 'Non Akademik', 'non-akademik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(5) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pengajar` int(9) NOT NULL,
  `id_siswa` int(9) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `id_kelas`, `nama`, `id_pengajar`, `id_siswa`) VALUES
(28, '11rpl', 'XI-RPL', 7, 5),
(29, '12rpl', 'XII-RPL', 1, 7),
(30, '10rpl', 'X-RPL', 2, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `nomor` int(10) NOT NULL,
  `id_berita` int(5) DEFAULT NULL,
  `oleh` varchar(100) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `komentar` text
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`nomor`, `id_berita`, `oleh`, `waktu`, `email`, `web`, `komentar`) VALUES
(6, 64, 'akaka', '15:53 14 Apr 2016', 'gabenk@yahoo.com', 'aaa.com', 'keren'),
(7, 64, 'hahaha', '16:05 14 Apr 2016', 'defita0922@gmail.com', 'ell.com', 'keren bingit'),
(8, 64, 'wwjwjwj', '16:06 14 Apr 2016', 'defita0922@gmail.com', 'm.com', 'hahahaha'),
(9, 64, 'Rio Ayatullah', '03:36 15 Apr 2016', 'defita0922@gmail.com', 'kingdevil.com', 'Makasih Tutornya'),
(10, 64, 'Alim', '08:39 15 Apr 2016', 'defita0922@gmail.com', 'alim.com', 'Keren');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id` int(5) NOT NULL,
  `id_matapelajaran` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_pengajar` int(9) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `id_matapelajaran`, `nama`, `id_kelas`, `id_pengajar`, `deskripsi`) VALUES
(11, 'BI1', 'Bahasa Indonesia', '10rpl', 6, 'Bahasa Indonesia Kelas X'),
(10, 'AD1', 'Aplikasi Dekstop', '11rpl', 1, 'msmsms'),
(12, 'B1', 'Bahasa Inggris', '10rpl', 8, 'Bahasa Inggris Kelas X-RPL'),
(16, 'PKN1', 'PKN', '10rpl', 7, 'mama'),
(17, 'BD1', 'Basis Data X', '10rpl', 2, 'Basis Data Dasar'),
(18, 'BD2', 'Basis Data XI', '11rpl', 2, 'Basis Data Untuk Kelas 2'),
(19, 'BI2', 'Bahasa Indonesia XI', '11rpl', 6, 'Bahasa Indonesia kelas XI'),
(20, 'B2', 'Bahasa Inggris XI', '11rpl', 8, 'Untuk Kelas XI'),
(21, 'WBD2', 'Web Dinamis Tingkat Lanjut', '11rpl', 9, 'Untuk Kelas XI'),
(22, 'PKN2', 'PKN', '11rpl', 7, 'PKN Kelas 2'),
(23, 'PKN3', 'PKN', '12rpl', 7, 'PKN Kelas 3'),
(24, 'IPS1', 'IPS', '10rpl', 10, 'Untuk Kelas 1'),
(25, 'IPS2', 'IPS', '11rpl', 10, 'Untuk Kelas 2'),
(26, 'IPS2', 'IPS', '12rpl', 10, 'Untuk Kelas 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('pengajar','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen Admin', '?module=admin', '', '', 'N', 'admin', 'N', 2, ''),
(18, 'Materi', '?module=materi', '', '', 'N', 'pengajar', 'Y', 6, 'semua-berita.html'),
(37, 'Manajemen Siswa', '?module=siswa', '', 'gedungku.jpg', 'Y', 'admin', 'Y', 3, 'profil-kami.html'),
(10, 'Manajemen Modul', '?module=modul', '', '', 'N', 'admin', 'N', 1, ''),
(31, 'Mata Pelajaran', '?module=matapelajaran', '', '', 'Y', 'pengajar', 'Y', 5, ''),
(63, 'Manajemen Quiz', '?module=quiz', '', '', 'N', 'pengajar', 'Y', 7, ''),
(41, 'Manajemen Kelas', ' ?module=kelas', '', '', 'N', 'pengajar', 'Y', 4, 'semua-agenda.html'),
(65, 'Registrasi Siswa', '?module=registrasi', '', '', 'Y', 'admin', 'Y', 8, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(50) NOT NULL,
  `id_tq` int(50) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `benar` int(10) NOT NULL,
  `salah` int(10) NOT NULL,
  `tidak_dikerjakan` int(50) NOT NULL,
  `persentase` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `id_tq`, `id_siswa`, `benar`, `salah`, `tidak_dikerjakan`, `persentase`) VALUES
(1, 29, 5, 2, 0, 0, 100),
(2, 30, 7, 4, 1, 0, 80),
(3, 31, 7, 0, 2, 0, 0),
(4, 29, 7, 2, 0, 0, 100),
(5, 32, 7, 1, 0, 0, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_soal_esay`
--

CREATE TABLE IF NOT EXISTS `nilai_soal_esay` (
  `id` int(50) NOT NULL,
  `id_tq` int(50) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_soal_esay`
--

INSERT INTO `nilai_soal_esay` (`id`, `id_tq`, `id_siswa`, `nilai`) VALUES
(14, 29, 5, '75'),
(15, 29, 7, '100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `ip` varchar(20) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `online` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `online`
--

INSERT INTO `online` (`ip`, `id_siswa`, `tanggal`, `online`) VALUES
('::1', 7, '2016-04-10', 'T'),
('127.0.0.1', 5, '2011-07-14', 'T'),
('::1', 9, '2011-12-28', 'T'),
('::1', 8, '2016-04-13', 'T'),
('::1', 10, '2016-04-14', 'T'),
('::1', 11, '2016-04-14', 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajar`
--

CREATE TABLE IF NOT EXISTS `pengajar` (
  `id_pengajar` int(9) NOT NULL,
  `nip` char(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(100) NOT NULL,
  `password_login` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'pengajar',
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `jabatan` varchar(200) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `nip`, `nama_lengkap`, `username_login`, `password_login`, `level`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_telp`, `email`, `foto`, `website`, `jabatan`, `blokir`, `id_session`) VALUES
(1, '10101010102', 'Dwi Cahyono S.Kom', 'cahyono', '92afb435ceb16630e9827f54330c59c9', 'pengajar', 'Perumahan Kertosari,Babadan', 'Ponorogo', '1972-10-23', 'L', 'Islam', '085228482669', 'dwicahyono@gmail.com', '11695031_928528593855455_7045242766738052089_n.jpg', 'www.dwi.wordpress.com', 'Kapala Prodi RPL ', 'N', 'vqvjbc3np8cocetpoeatdtoc21'),
(2, '121212121212', 'Mubayinatu Yafina', 'Yafina', '0958a24f6a72f5b3155eb8ac0d53856d', 'pengajar', 'Jambon', 'Ponorogo', '1990-10-10', 'P', 'Islam', '0852', 'yafina@gmail.com', '06112009087.jpg', 'www.yafina.com', 'Guru Basis Data dan C++', 'N', 'fvcnsttre99ej0b0is9bu08ho6'),
(7, '1230569694', 'Vaola Arisandi', 'vaola', '04aff729f7d8dfc00bf210289eaf14c1', 'pengajar', 'Sumoroto', 'Ponorogo', '1988-04-11', 'P', 'Islam', '089757577372', 'vaola@gmail.com', '11218064_933717216682252_7084064112245806767_n.jpg', 'http://vaoala.com', 'Guru PKN', 'N', 'vom0i6n90prlp0210p8jirjcf4'),
(6, '1234567891', 'Tanti Pri Asmorowati', 'Tanti', 'b78f24e219214b7cdd15f9d547074a81', 'pengajar', 'jl.veteran', 'tangerang', '1990-08-10', 'P', 'Islam', '0000', 'asd', '7610_1556714547899407_2423780974851016039_n.jpg', 'asdf', 'Guru Bahasa Indonesia ', 'N', 'l1q6r59jnv8on8li0kak6aqhc5'),
(8, '1203495960', 'Elsa Dyasa', 'elsa', '783833680e6da5cf6cd7481a44d8fa4c', 'pengajar', 'Ponorogo', 'Ponorogo', '1990-04-11', 'P', 'Islam', '089795858383', 'elsa@gmail.com', 'Ponorogoberkah.jpg', 'http://elsa.com', 'Guru Bahasa Inggris', 'N', '1203495960'),
(9, '12030304', 'Totok Rantoni', 'totok', '6f0193cec743d209f04845041b96e322', 'pengajar', 'Jln Gatotkaca,Ponorogo', 'Sleman', '1980-04-12', 'L', 'Islam', '08976432019', 'totok@ymail.com', 'Winterscape.jpg', 'http://totok.com', 'Guru Web Dinamis', 'N', 'rkr2890sam253t4qof8g0eoea4'),
(10, '030402010', 'Ika Mayningsih', 'ika', '7965c82127bd8517d2495e8efb12702c', 'pengajar', 'Sukorejo', 'Ponorogo', '1987-04-13', 'P', 'Islam', '085765432623', 'ika@gmail.com', '12345387_212306962434210_1382513184501873929_n.jpg', 'http://ika.com', 'Guru IPS', 'N', '030402010');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_esay`
--

CREATE TABLE IF NOT EXISTS `quiz_esay` (
  `id_quiz` int(9) NOT NULL,
  `id_tq` int(9) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tgl_buat` date NOT NULL,
  `jenis_soal` varchar(50) NOT NULL DEFAULT 'esay'
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_pilganda`
--

CREATE TABLE IF NOT EXISTS `quiz_pilganda` (
  `id_quiz` int(10) NOT NULL,
  `id_tq` int(9) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pil_a` text NOT NULL,
  `pil_b` text NOT NULL,
  `pil_c` text NOT NULL,
  `pil_d` text NOT NULL,
  `pil_e` text NOT NULL,
  `kunci` varchar(1) NOT NULL,
  `tgl_buat` date NOT NULL,
  `jenis_soal` varchar(50) NOT NULL DEFAULT 'pilganda'
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `quiz_pilganda`
--

INSERT INTO `quiz_pilganda` (`id_quiz`, `id_tq`, `pertanyaan`, `gambar`, `pil_a`, `pil_b`, `pil_c`, `pil_d`, `pil_e`, `kunci`, `tgl_buat`, `jenis_soal`) VALUES
(218, 33, '<p>Indonesia berkomitmen menurunkan emisi hingga 29%&nbsp; [...] 2030 dan akan diterapkan di sektor kehutanan, energi, dan maritim. Untuk itu harus ada komitmen kuat [...] seluruh negara agar tujuan bersama dapat tercapai.Keterlibatan masyarakat secara aktif dalam menjaga alam, sangatlah diperlukan.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Kata depan yang tepat untuk melengkapi paragraf rumpang tersebut adalah ....</p>\r\n', '', '<p>dari, ke</p>\r\n', '<p>ke, dari</p>\r\n', '<p>di, dari</p>\r\n', '<p>pada, dari</p>\r\n', '<p>ke,pada</p>\r\n', 'D', '2016-04-13', 'pilganda'),
(217, 33, '<p>Cermatilah paragraf berikut!</p>\r\n\r\n<p>(1) Zaman terus berkembang pesat. (2) Manusia semakin dituntut pintar dan mampu mengembangkan diri dalam berbagai hal. (3) Setiap keluarga juga memiliki tuntutan yang berbeda. (4) Salah satunya adalah kemampuan menggunakan teknologi informasi.(5).Ya,karena diera sekarang teknologi sangat berkembang pesat.</p>\r\n\r\n<p>Kalimat sumbang yang terdapat pada teks tersebut ditandai dengan nomor ....</p>\r\n', '', '<p>(1)<br />\r\n&nbsp;</p>\r\n', '<p>(2)</p>\r\n', '<p>(3)<br />\r\n&nbsp;</p>\r\n', '<p>(4)</p>\r\n', '<p>(5)</p>\r\n', 'C', '2016-04-13', 'pilganda'),
(214, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>Saat ini perempuan harus mampu berperan sebagai ibu untuk turut mendidik anak-anaknya dalam keluarga. Selain itu, perempuan juga berperan penting dalam pembangunan. Merekamemilikipotensi yang dapatdirefleksikandalampembangunan. Mereka merupakan aset sekaligus sumber daya manusia yang harus mendapat perhatian pemerintah. Keberhasilanperanperempuandalamkeluargaakanturutmenentukankeberhasilansuatubangsa.</p>\r\n\r\n<p>Simpulan paragraf tersebut adalah ... .</p>\r\n', '', '<p>Pembangunan Indonesia memerlukan peran orang tua.</p>\r\n', '<p>Peran ibu dalam keluarga adalah mendidik anak-anak.</p>\r\n', '<p>Peran ganda perempuan dalam keluarga dan pembangunan.</p>\r\n', '<p>Perempuan memiliki potensi yang selalu dapat dikembangkan.</p>\r\n', '<p>Perempuan garda terdepan pembangunan</p>\r\n', 'C', '2016-04-13', 'pilganda'),
(215, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>KementerianDesa Pembangunan Daerah TertinggaldanTransmigrasimenerapkanpolapengembanganseperti yang diterapkan Korea Selatan. Pola yang dimaksud adalah <em>saemaul undong. </em>Pola ini menerapkan gerakan mental &lsquo;desa membangun&rsquo; yang melibatkan partisipasi masyarakat secara luas. Pola<em>saemaulundong</em>telahdiakuibadan PBB, UNESCO, sebagai model pengembanganekonomi yang berbasispadapemberdayaanmasyarakat.</p>\r\n\r\n<p>Gagasan pokok paragraf tersebut adalah ... .</p>\r\n', '', '<p>pemberdayaan masyarakat Indonesia</p>\r\n', '<p>pola <em>saemaul undong </em>di Indonesia</p>\r\n', '<p>pengembangan berbasis ekonomi Indonesia</p>\r\n', '<p>pola pengembangan desa di Indonesia</p>\r\n', '', 'D', '2016-04-10', 'pilganda'),
(216, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>Nama lengkapnya Donald Trump, alias Donald John Trump. Ia adalah seorang pengusaha, pakar, dan penulis. Lahir di New York City, AmerikaSerikat,14 Juni 1946. Ibunya bernama Mary Anne, dan ayah Fred Trump, ahli pembangunan dan pemasaran real estate di New York. Ia adalah raja bisnis Amerika, ketua dan presiden The Trump Organization dan pendiri Trump Entertainment Resort. Tahun 1964, ia lulus akademi militer New York. Memiliki pemikiran bahwa real estate adalah bisnis yang lebih baik sehingga ia masuk Wharton School of University of Pensylvannia dan lulus pada tahun 1968, ia resmi bergabung dengan perusahaan ayahnya. Iadiberikendalipenguasaanperusahaanpada 1971 dankemudianmenamainya The Trump Organization.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pernyataan yang sesuai dengan isi biografi tersebut adalah ... .</p>\r\n', '', '<p>Donald Trump pernahmenjadidosen di Wharton School of University of Pensylvannia.</p>\r\n', '<p>Donald Trump lulus akademimiliter New York dalamusia 18 tahun.</p>\r\n', '<p>Donald Trump adalahseorangpengusaha, pakar, peneliti, danpenulis.</p>\r\n', '<p>Tahun 1964 Donald Trump mendirikan Trump Entertainment Resort.</p>\r\n', '<p>Donalt Trump akan menjadi Presidan Amerika</p>\r\n', 'B', '2016-04-13', 'pilganda'),
(219, 33, '<p>Cermatilah paragraf berikut!</p>\r\n\r\n<p>Reformasi birokrasi yang selama ini kita inginkan belum berjalan dengan baik. Penyebabnya antara lain ketiadaan peran masyarakat ketika sebuah kebijakan akan diakuisisi ke dalam bentuk program. Padahal seharusnya kesempatan masyarakat untuk terlibat dan memberikan masukan terhadap suatu kebijakan, sudah terbuka peluangnya.</p>\r\n\r\n<p>Makna istilah <em>diakuisisi </em>pada paragraf tersebut adalah ....</p>\r\n', '', '<p>dijajarkan</p>\r\n', '<p>disamakan</p>\r\n', '<p>dialihkan</p>\r\n', '<p>diutamakan</p>\r\n', '<p>diposisikan</p>\r\n', 'C', '2016-04-13', 'pilganda'),
(220, 33, '<p>Cermatilah paragraf berikut!</p>\r\n\r\n<p>Pengaspalan yang dilakukan pemerintah provinsi DKI Jakarta diberbagai jalan di ibukota merupakan hal yang menyenangkan. Hal ini dilakukan sebab di sejumlah jalan banyak yang berlubang. Namun, dibeberapa tempat pengaspalan jalan itu semakin meninggikan permukaan jalan. Akibatnya, separator yang menjadi pemisah menjadi sejajar dengan permukaan jalan. Kondisi ini, membuat banyak kendaraan berputar arah semaunya. Warga Jakarta umumnya tidak cukup diberi himbauan untuk taat terhadap aturan lalu lintas.[...] Bagi masyarakat, biasanya pemaksaan lebih ampuh dibandingkan dengan aturan, yang ada hanya secara tertulis.</p>\r\n\r\n<p>Kalimat yang sesuai untuk melengkapi paragraf rumpang tersebut adalah....</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', '<p>Aturan lalu lintas yang berlaku tidak sesuai dengan harapan masyarakat.</p>\r\n', '<p>Harus ada unsur pemaksaan agar mereka taat dan tidak membuat aturan sendiri.</p>\r\n', '<p>Lalu lintas yang digunakan saat ini belum disosialisasikan pemerintah.</p>\r\n', '<p>Himbauan Pemprov. DKI itu selalu mendapat respons positif dari masyarakat.</p>\r\n', '<p>Adanya penilangan yang tegas<br />\r\n&nbsp;</p>\r\n', 'B', '2016-04-13', 'pilganda'),
(221, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>(1) Pola asuh anak adalah merupakan cara orangtua memperlakukan anak dengan aturan-aturan tertentu. (2) Ada lima pola asuh yang dapat diterapkan para orangtua, yaitu otoriter, demokratis, temporizer, appeasers, dan permisif. (3) Pola asuh terbaik yang dapat diterapkan adalah demokratis. (4) Polainiditunjukkandengan berbagai sikap-sikap orang tua yang mau mendengarkan keluhan anak dengan terbuka. (5) Namun, masih banyak orang tua yang menggunakan pola asuh diktator atau otoriter.</p>\r\n\r\n<p>Kalimat<strong> tidak </strong>efektif pada teks tersebut ditandai dengan nomor ....</p>\r\n', '', '<p>(1),(4)</p>\r\n', '<p>(2),(5)</p>\r\n', '<p>(3),(4)</p>\r\n', '<p>(1),(5)<br />\r\n&nbsp;</p>\r\n', '<p>(1),(2)</p>\r\n', 'A', '2016-04-13', 'pilganda'),
(222, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>Pemerintah akan melakukan pemutihan bagi petani peserta Kredit Usaha Tani (KUT) tahun ini. Dalam melaksanakan pemutihan tersebut, pemerintah tidak akan menggunakan mekanisme yang merugikan debitur maupun kreditur. [....] Mekanisme pertama, pemerintah membayar kewajiban para debitur dan kedua, menggunakan mekanisme administrasi antara pembukuan pemerintah dan perbankan. Dengan mekanisme ini, para petani diharapkan terbantu.</p>\r\n\r\n<p>Kalimat yang tepat untuk melengkapi paragraf rumpang tersebut adalah ... .</p>\r\n', '', '<p>Debitur membantu petani melakukan pemutihan KUT sesuai kemampuan.</p>\r\n', '<p>Pemerintah menggunakan beberapa peraturan perbankan yang berlaku.</p>\r\n', '<p>Dalam melaksanakan pemutihan KUT, pemerintah memilki dua mekanisme.</p>\r\n', '<p>Debitur membantu petani melakukan pemutihan KUT sesuai kemampuan.</p>\r\n', '<p>pemutihan KUT dilakukan oleh Debitur</p>\r\n', 'C', '2016-04-13', 'pilganda'),
(223, 33, '<p>Cermatilah paragraf berikut!</p>\r\n\r\n<p>Implementasi Prolegnas (Program Legislasi Nasional)</p>\r\n\r\n<p>Periode 2010 - 2014</p>\r\n\r\n<table align="left" border="" cellpadding="0" cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td style="height:34px; width:73px">\r\n			<p><strong>TAHUN</strong></p>\r\n			</td>\r\n			<td style="height:34px; width:113px">\r\n			<p><strong>TARGET RUU</strong></p>\r\n			</td>\r\n			<td style="height:34px; width:95px">\r\n			<p><strong>CAPAIAN</strong></p>\r\n			</td>\r\n			<td style="height:34px; width:81px">\r\n			<p><strong>%</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:73px">\r\n			<p>2010</p>\r\n			</td>\r\n			<td style="width:113px">\r\n			<p>70</p>\r\n			</td>\r\n			<td style="width:95px">\r\n			<p>8</p>\r\n			</td>\r\n			<td style="width:81px">\r\n			<p>11,4</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:73px">\r\n			<p>2011</p>\r\n			</td>\r\n			<td style="width:113px">\r\n			<p>70</p>\r\n			</td>\r\n			<td style="width:95px">\r\n			<p>12</p>\r\n			</td>\r\n			<td style="width:81px">\r\n			<p>17,1</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:73px">\r\n			<p>2012</p>\r\n			</td>\r\n			<td style="width:113px">\r\n			<p>64</p>\r\n			</td>\r\n			<td style="width:95px">\r\n			<p>10</p>\r\n			</td>\r\n			<td style="width:81px">\r\n			<p>15,6</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:73px">\r\n			<p>2013</p>\r\n			</td>\r\n			<td style="width:113px">\r\n			<p>70</p>\r\n			</td>\r\n			<td style="width:95px">\r\n			<p>12</p>\r\n			</td>\r\n			<td style="width:81px">\r\n			<p>17,1</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:73px">\r\n			<p>2014</p>\r\n			</td>\r\n			<td style="width:113px">\r\n			<p>69</p>\r\n			</td>\r\n			<td style="width:95px">\r\n			<p>17</p>\r\n			</td>\r\n			<td style="width:81px">\r\n			<p>24,6</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Pernyataan yang sesuai dengan isi tabel tersebut adalah ....</p>\r\n', '', '<pre>\r\nTahun 2014 implementasi prolegnas paling banyak dicapai.</pre>\r\n', '<p>Selama 3 tahun terakhir, capaian RUU kurang dari 20%.</p>\r\n', '<pre>\r\nSejak 2011 target RUU selalu lebih dari 70 program.</pre>\r\n', '<pre>\r\nTarget RUU paling sedikit diprogramkan pada 2010.</pre>\r\n', '<p>Target sudah tercapai<br />\r\n&nbsp;</p>\r\n', 'A', '2016-04-13', 'pilganda'),
(224, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>Amiru melihat sekeliling. Hanya dia sendiri yang bersepeda seperti itu. Tibalah gilirannya, tetapi dia ragu mendekat ke meja pendaftaran. Pembalap lain ingin cepat-cepat, dia minggir.Amiru menatap para pembalap yang mengambil nomor lomba. Setelah agak sepi, dia memberanikan diri untuk mendaftar karena dia harus menebus radio ayahnya, dia memerlukan biaya untuk ibunya.</p>\r\n\r\n<p><em>Ayah</em>: Andrea Hirata</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tahapan alur kutipan novel tersebut adalah... .</p>\r\n', '', '<p>Penyelesaian</p>\r\n', '<p>Puncak konflik (klimaks)</p>\r\n', '<p>Pengenalan situasi</p>\r\n', '<p>Pengungkapan peristiwa</p>\r\n', '<p>klimaks</p>\r\n', 'D', '2016-04-13', 'pilganda'),
(225, 33, '<p>Cermati Paragraf Berikut !</p>\r\n\r\n<p>Tuan Razak ingin sekali Markoni mengikuti jejaknya di bidang maritim. Markoni dinamai begitu agar menjadi seorang markonis kapal.</p>\r\n\r\n<p>&ldquo;Markonis adalah orang terpandang, perwira di kapal. Atasan markonis satu-satunya hanya nakhoda,&rdquo; ayahnya menyemangati Markoni.</p>\r\n\r\n<p>Tuan Razak mengimpikan orang-orang memanggil anak sulungnya, <em>Spark</em>, satu panggilan keren untuk seorang <em>radio officer</em>. Namun, baru kelas satu SMP dia sudah merokok. Dengan baju yang sudah pendek digulung tinggi-tinggi. Potongan rambut bersurai panjang pada bagian belakang. Bolos sekolahadalahhobinya.</p>\r\n', '', '<p>tema</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>amanat</p>\r\n', '<p>penokohan</p>\r\n', '<p>latar</p>\r\n', '<p>suasana</p>\r\n', 'C', '2016-04-13', 'pilganda'),
(226, 33, '<p>Cermati Paragraf Berikut</p>\r\n\r\n<table border="1" cellpadding="1" cellspacing="1" style="width:500px">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Menyadar ipentingnya menciptakan iklim investasi yang [...] untuk memacu pertumbuhan ekonomi Indonesia, akhir tahun ini pemerintah kembali meluncurkan kebijakan ekonomi paket VIII.</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Kata yang tepat untuk melengkapi kalimat rumpang tersebut adalah ....</p>\r\n', '', '<p>progesif</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>selektif</p>\r\n', '<p>produktif</p>\r\n', '<p>kondusif</p>\r\n', '<p>implikatif</p>\r\n', 'D', '2016-04-13', 'pilganda'),
(227, 33, '<p>Setiap gergaji melengking mengatasi</p>\r\n\r\n<p>bunyi satwa, merintihlah hutan ke angkasa</p>\r\n\r\n<p>Pohon-pohon dan semak saling bicara</p>\r\n\r\n<p>kapan gilirannya mengalirkan darah</p>\r\n\r\n<p>rebah ke lantai lumpur yang basah</p>\r\n\r\n<p>langit turun mendekap dan menampung air mata</p>\r\n\r\n<p>ditumpahkan menjadi hujan dan bencana bumi,</p>\r\n\r\n<p>prahara atau banjir menjalar sepanjang lembah-lembah ini.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Slamet Sukirmanto</p>\r\n\r\n<p>Tema puisi tersebut adalah ....</p>\r\n', '', '<p>kerusakan hutan</p>\r\n', '<p>kesedihan para satwa</p>\r\n', '<p>doa penghuni hutan</p>\r\n', '<p>hutan berlumpur</p>\r\n', '<p>hutanku</p>\r\n', 'A', '2016-04-13', 'pilganda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi_siswa`
--

CREATE TABLE IF NOT EXISTS `registrasi_siswa` (
  `id_registrasi` int(9) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa'
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(9) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa'
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_lengkap`, `username_login`, `password_login`, `id_kelas`, `jabatan`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `nama_ayah`, `nama_ibu`, `th_masuk`, `email`, `no_telp`, `foto`, `blokir`, `id_session`, `id_session_soal`, `level`) VALUES
(7, '034/034.070', 'Dicky', 'siswa1', '013f0f67779f3b1686c604db150d12ea', '12rpl', 'Ketua Kelas', 'Jedah,Siman', 'Ponorogo', '1996-08-10', 'L', 'Islam', 'Wakadir', 'Watini', '2010', 'pranaandypal@yahoo.com', '090909', '3aa.jpg', 'N', '034/034.070', '034/034.070', 'siswa'),
(5, '90909', 'El faruq harisal aji', 'almazary', '0f0484d5239cbdeee629258b816785d3', '11rpl', 'Ketua Kelas', 'Jl.KHA DAHLAN unit 2 rimbo bujang', 'rimbo bujang', '1990-08-10', 'L', 'Islam', 'wagimin', 'sri ngatini', '2008', 'almazary@gmail.com', '085228482669', 'Untitled-1.jpg', 'N', '90909', '90909', 'siswa'),
(8, '080800', 'yogi', 'yogi', '938e14c074c45c62eb15cc05a6f36d79', '10rpl', 'siswa', 'jl.gajah', 'kisaran', '1989-05-15', 'L', 'Islam', 'emboh', 'emboh', '2009', 'yogizeger@yahoo.com', '0000', '12241286_205349899796583_7077285851609688335_n.jpg', 'N', '8nlj31mjg1u8dmh26dn34f40q1', '080800', 'siswa'),
(11, '013/013.070', 'Rio Ayatullah', 'rio', 'd5ed38fdbf28bc4e58be142cf5a17cf5', '12rpl', 'siswa', 'RIo          ', 'Ponorogo', '1997-04-13', 'L', 'islam', 'Kadirun', 'Watini', '2013', 'rio@gmail.com', '089757577372', 'Folder.jpg', 'N', '7lib45fg1urf4iq6r0ak61ec95', '013/013.070', 'siswa'),
(10, '9090909', 'ali', 'ali', '86318e52f5ed4801abe1d13d509443de', '11rpl', 'siswa', 'alamat', 'Ponorogo', '1996-03-10', 'L', 'islam', 'asd', 'asdfgas', '2012', 'admin@admin.com', '6070707', '12278748_210216469309926_7115825229146990081_n.jpg', 'N', 'em92ju8p8p3ho957r6bbs4ojs7', '9090909', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_sudah_mengerjakan`
--

CREATE TABLE IF NOT EXISTS `siswa_sudah_mengerjakan` (
  `id` int(20) NOT NULL,
  `id_tq` int(20) NOT NULL,
  `id_siswa` varchar(200) NOT NULL,
  `dikoreksi` varchar(1) NOT NULL DEFAULT 'B',
  `hits` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa_sudah_mengerjakan`
--

INSERT INTO `siswa_sudah_mengerjakan` (`id`, `id_tq`, `id_siswa`, `dikoreksi`, `hits`) VALUES
(1, 29, '5', 'S', 1),
(2, 30, '7', 'B', 1),
(6, 31, '7', 'B', 1),
(8, 29, '7', 'S', 1),
(9, 32, '7', 'B', 1),
(11, 33, '8', 'B', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id_templates` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `templates`
--

INSERT INTO `templates` (`id_templates`, `judul`, `pembuat`, `folder`, `aktif`) VALUES
(4, 'Standar', 'Almazari', 'templates/almazari', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topik_quiz`
--

CREATE TABLE IF NOT EXISTS `topik_quiz` (
  `id_tq` int(9) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_matapelajaran` varchar(10) NOT NULL,
  `tgl_buat` date NOT NULL,
  `pembuat` varchar(100) NOT NULL,
  `waktu_pengerjaan` int(50) NOT NULL,
  `info` text NOT NULL,
  `terbit` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `topik_quiz`
--

INSERT INTO `topik_quiz` (`id_tq`, `judul`, `id_kelas`, `id_matapelajaran`, `tgl_buat`, `pembuat`, `waktu_pengerjaan`, `info`, `terbit`) VALUES
(33, 'Soal Latihan Bahasa Indonesia', '10rpl', 'BI1', '2016-04-10', '6', 7200, '<p>Kerjakan dengan teliti</p>\r\n', 'Y');

-- --------------------------------------------------------

--
-- Stand-in structure for view `t_alumni`
--
CREATE TABLE IF NOT EXISTS `t_alumni` (
`nis` varchar(30)
,`nama` varchar(50)
,`jurusan` varchar(40)
,`alamat` text
,`angkatan` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_berita`
--
CREATE TABLE IF NOT EXISTS `v_berita` (
`id_berita` int(5)
,`nama_kat` varchar(20)
,`katberita_seo` varchar(100)
,`nama_berita` varchar(100)
,`nama_beritaseo` varchar(100)
,`deskripsi` text
,`tgl_masuk` date
,`gambar` varchar(100)
,`pembuat` varchar(50)
,`komentar` int(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kategori`
--
CREATE TABLE IF NOT EXISTS `v_kategori` (
`nama_kat` varchar(20)
,`katberita_seo` varchar(100)
,`id_kategori` int(5)
,`jml` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_siswa`
--
CREATE TABLE IF NOT EXISTS `v_siswa` (
`nis` varchar(50)
,`nama_lengkap` varchar(100)
,`id_kelas` varchar(5)
,`alamat` varchar(150)
,`nama` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `t_alumni`
--
DROP TABLE IF EXISTS `t_alumni`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `t_alumni` AS select `alumni`.`nis` AS `nis`,`alumni`.`nama` AS `nama`,`alumni`.`jurusan` AS `jurusan`,`alumni`.`alamat` AS `alamat`,`alumni`.`angkatan` AS `angkatan` from `alumni`;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_berita`
--
DROP TABLE IF EXISTS `v_berita`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_berita` AS select `berita`.`id_berita` AS `id_berita`,`kategori_berita`.`nama_kat` AS `nama_kat`,`kategori_berita`.`katberita_seo` AS `katberita_seo`,`berita`.`nama_berita` AS `nama_berita`,`berita`.`nama_beritaseo` AS `nama_beritaseo`,`berita`.`deskripsi` AS `deskripsi`,`berita`.`tgl_masuk` AS `tgl_masuk`,`berita`.`gambar` AS `gambar`,`berita`.`pembuat` AS `pembuat`,`berita`.`komentar` AS `komentar` from (`berita` join `kategori_berita`) where (`kategori_berita`.`id_kategori` = `berita`.`id_kategori`);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_kategori`
--
DROP TABLE IF EXISTS `v_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kategori` AS select `kategori_berita`.`nama_kat` AS `nama_kat`,`kategori_berita`.`katberita_seo` AS `katberita_seo`,`kategori_berita`.`id_kategori` AS `id_kategori`,count(`berita`.`id_berita`) AS `jml` from (`kategori_berita` left join `berita` on((`berita`.`id_kategori` = `kategori_berita`.`id_kategori`))) group by `kategori_berita`.`nama_kat`;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_siswa`
--
DROP TABLE IF EXISTS `v_siswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siswa` AS select `siswa`.`nis` AS `nis`,`siswa`.`nama_lengkap` AS `nama_lengkap`,`siswa`.`id_kelas` AS `id_kelas`,`siswa`.`alamat` AS `alamat`,`kelas`.`nama` AS `nama` from (`siswa` join `kelas`) where (`kelas`.`id_kelas` = `siswa`.`id_kelas`) order by `siswa`.`id_kelas`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `file_materi`
--
ALTER TABLE `file_materi`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `galeri_foto`
--
ALTER TABLE `galeri_foto`
  ADD PRIMARY KEY (`id_galerifoto`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_prestasi`
--
ALTER TABLE `kategori_prestasi`
  ADD PRIMARY KEY (`id_kategoriprestasi`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_soal_esay`
--
ALTER TABLE `nilai_soal_esay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- Indexes for table `quiz_esay`
--
ALTER TABLE `quiz_esay`
  ADD PRIMARY KEY (`id_quiz`);

--
-- Indexes for table `quiz_pilganda`
--
ALTER TABLE `quiz_pilganda`
  ADD PRIMARY KEY (`id_quiz`);

--
-- Indexes for table `registrasi_siswa`
--
ALTER TABLE `registrasi_siswa`
  ADD PRIMARY KEY (`id_registrasi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `siswa_sudah_mengerjakan`
--
ALTER TABLE `siswa_sudah_mengerjakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id_templates`);

--
-- Indexes for table `topik_quiz`
--
ALTER TABLE `topik_quiz`
  ADD PRIMARY KEY (`id_tq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `file_materi`
--
ALTER TABLE `file_materi`
  MODIFY `id_file` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `galeri_foto`
--
ALTER TABLE `galeri_foto`
  MODIFY `id_galerifoto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `kategori_prestasi`
--
ALTER TABLE `kategori_prestasi`
  MODIFY `id_kategoriprestasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `nomor` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nilai_soal_esay`
--
ALTER TABLE `nilai_soal_esay`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id_pengajar` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `quiz_esay`
--
ALTER TABLE `quiz_esay`
  MODIFY `id_quiz` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `quiz_pilganda`
--
ALTER TABLE `quiz_pilganda`
  MODIFY `id_quiz` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `registrasi_siswa`
--
ALTER TABLE `registrasi_siswa`
  MODIFY `id_registrasi` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `siswa_sudah_mengerjakan`
--
ALTER TABLE `siswa_sudah_mengerjakan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id_templates` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `topik_quiz`
--
ALTER TABLE `topik_quiz`
  MODIFY `id_tq` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
