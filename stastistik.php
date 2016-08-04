<?php
// Menyisipkan file Koneksi ke database
// File ini diperlukan saat berinteraksi dengan database Seperti INSERT, UPDATE, DELETE dan SELECT
require 'config/config.php';

// Menyisipkan file functions.php agar function yang kita buat dapat dipakai dihalaman ini
require 'config/function.php';

/**
 * Test
 * echo ip_user();
 * echo "<br/>";
 * echo browser_user();
 * echo "<br/>";
 * echo os_user();
 */

// rekam data user yang sudah mengakses website kita
$ip      = ip_user();
$browser = browser_user();
$os      = os_user();

// Check bila sebelumnya data pengunjung sudah terrekam
if (!isset($_COOKIE['VISITOR'])) {

    // Masa akan direkam kembali
    // Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
    // Cookie akan disimpan selama 24 jam
    $duration = time()+60*60*24;

    // simpan kedalam cookie browser
    setcookie('VISITOR',$browser,$duration);

    // SQL Command atau perintah SQL INSERT
    $sql=mysql_query("INSERT INTO statistik (ip, os, browser) VALUES ('$ip', '$os', '$browser')");

    // variabel { $db } adalah perwakilan dari koneksi database lihat config.php
}


?>
