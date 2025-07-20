<?php

$host = "localhost";
$kullaniciAdi = "root";
$sifre = "latifcakmak";
$veritabani = "gl_mobilya";

// Bağlantıyı oluştur
$conn = mysqli_connect($host, $kullaniciAdi, $sifre, $veritabani);

// Karakter setini UTF-8 olarak ayarla
mysqli_set_charset($conn, "UTF8");

// Bağlantıyı kontrol et
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}
