<?php

// Bağlantı ile ilgili değişkenler ayarlar.php sayfası içinde tanımlandı

// Veritabanı bağlantısının oluşturulması
$db = mysqli_connect($SunucuAdi, $KullaniciAdi, $Parola, $VeritabaniAdi);
// Varsa, bağlantı hatasının ekrana yazdırılarak programın sonlandırılması
if (!$db) { die("Hata oluştu: " . mysqli_connect_error()); }
//echo "Bağlantı tamam!";

// Oluşabilecek Türkçe karakter gösterimi sorunlarını giderelim...
mysqli_query($db, "set names 'utf8'");
