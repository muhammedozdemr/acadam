<?php
  // Sistem genelinde kullanılacak ayarların bulunduğu değişkenleri alalım
  require("_ayarlar.php");

  // Sistem genelinde kullanılacak hazır fonksiyonları yükleyelim
  require("_kutuphane.php");

  // Veri tabanı bağlantısını kuralım
  require("_db.php");

  // Sayfanın ÜST kısmını alalım
  require("sayfa.ust.php");

  // Ana sayfayı çağıralım
  require("musteri.kayit.formu.php");

  //require("ana.sayfa.php");

  // Sayfanın alt kısmını alalım
  require("sayfa.alt.php");
?>
