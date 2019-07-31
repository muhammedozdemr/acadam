<?php
  // Sistem genelinde kullanılacak ayarların bulunduğu değişkenleri alalım
  require("ayarlar.php");

  // Sistem genelinde kullanılacak hazır fonksiyonları yükleyelim
  require("kutuphane.php");

  // Veri tabanı bağlantısını kuralım
  require("db.php");

  // Sayfanın ÜST kısmını alalım
  require("sayfa.ust.php");

  // Ana sayfayı çağıralım
  require("musteri.kayit.formu.php");

  //require("ana.sayfa.php");

  // Sayfanın alt kısmını alalım
  require("sayfa.alt.php");
?>
