<?php
  // Sistem genelinde kullanılacak ayarların bulunduğu değişkenleri alalım
  require("_ayarlar.php");

  // Sistem genelinde kullanılacak hazır fonksiyonları yükleyelim
  require("_kutuphane.php");

  // Veri tabanı bağlantısını kuralım
  require("_db.php");

  // Sayfanın ÜST kısmını alalım
  require("sayfa.ust.php");


  ####################### HANGİ SAYFANIN GÖSTERİLECEĞİNİN AYARLANMASI
  ####################### HANGİ SAYFANIN GÖSTERİLECEĞİNİN AYARLANMASI
  ####################### HANGİ SAYFANIN GÖSTERİLECEĞİNİN AYARLANMASI

      $SAYFA = $GENEL_VarsayilanSayfa; // Gösterilecek varsayılan sayfayı ilk değer olarak atayalım.

      if( isset($_GET["sayfa"]) ) $SAYFA = $_GET["sayfa"]; // Varsa, URL'den gelen değişkeni al

      if( isset($GENEL_arrSAYFALAR[$SAYFA]) ) { // Tanımlı sayfalarda bu sayfa var mı?
        require($GENEL_arrSAYFALAR[$SAYFA]); // Bu sayfa varsa, içeriğini göster
      } else {
        require($GENEL_VarsayilanSayfa); // Yoksa, varsayılan sayfayı gösterelim.
      }



  // Sayfanın alt kısmını alalım
  require("sayfa.alt.php");
?>
