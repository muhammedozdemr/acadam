<?php
  // Ajax sayfalarda olması gereken ön hazırlığımızı yapalım
  require_once("ajax.on.hazirlik.php");

  // Hangi ile ait olan ilçeleri seçeceğimiz değişkeni dolduralım
  $ILKODU = $_GET["il_kodu"];

  // Şimdi, ilçeleri veritabanından çekelim
  $SQL = "SELECT DISTINCT ilce_kodu, ilce_adi FROM ref_il_ilce WHERE il_kodu='$ILKODU' ORDER BY ilce_adi";
  $rows = mysqli_query($db, $SQL);

  $arrIlceler = array(); // İlçe adları için boş bir dizi hazırlayalım
  $arrIlceler[0] = "*** SEÇİNİZ ***"; // İlçe seçiminde İLK elemanın değeri SEÇİNİZ olsun.
  while($row = mysqli_fetch_assoc($rows)) { // Kayıt adedince dönelim
    $arrIlceler[ $row["ilce_kodu"] ] = $row["ilce_adi"];
  } // while

  // AJAX ile döndüreceğimiz ana değişkenimize yüklememizi yapalım
  $SONUC["ILCELER"] = $arrIlceler;


  // Şimdi, JSON formatında SONUÇ dizimine döndürelim
  echo json_encode($SONUC);
