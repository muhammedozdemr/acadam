<?php
  // Bu sayfada, Ajax sayfalarda olması gereken ön hazırlığımız yapılıyor

  // Sistem genelinde kullanılacak ayarların bulunduğu değişkenleri alalım
  require_once("_ayarlar.php");

  // Veri tabanı bağlantısını kuralım
  require_once("_db.php");

  // AJAX ile çağrılan sayfaların her biri şu ön kodu içermeli
  header('Content-Type: application/json');

  // AJAX ile dönecek her değeri $SONUC adlı dizide tutacağız.
  // Bu nedenle bu diziyi hazırlayalım
  $SONUC = array();
