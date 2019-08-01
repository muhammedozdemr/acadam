<?php

// Veritabanına bağlantı yapalım
require("ajax.on.hazirlik.php");

	// BU SAYFADA, İLETİŞİM FORMUNDAN GELEN BİLGİLER KAYIT EDİLECEK
	// echo "ad sahası doldurulmalıdır";

	$HataMesaji = "";
	if($_POST["adiniz"] == "")      $HataMesaji .= "Ad sahası dolu olmalıdır! ";
	if($_POST["eposta"] == "")      $HataMesaji .= "ePosta sahası dolu olmalıdır! ";
	if($_POST["telefon"] == "")     $HataMesaji .= "Telefon sahası dolu olmalıdır! ";
	if($_POST["mesajkonusu"] == "") $HataMesaji .= "Mesaj Konusu seçmelisiniz! ";
	if($_POST["mesaj"] == "")       $HataMesaji .= "Mesaj sahasını yazmalısınız! ";


	// Mesajın tabloya kaydedilebilmesi için SQL hazırlayalım
	$SQL = sprintf("
			INSERT INTO
				iletisim_formu_mesajlari
			SET
				adiniz      = '%s',
				eposta      = '%s',
				telefon     = '%s',
				mesajkonusu = '%s',
				mesaj       = '%s'   ",
			$_POST["adiniz"],
			$_POST["eposta"],
			$_POST["telefon"],
			$_POST["mesajkonusu"],
			$_POST["mesaj"]  );

	// JSON İLE DÖNECEK DÖNÜŞ DEĞİŞKENLERİNE İLK DEĞERLERİNİ VERELİM
	$SONUC["ISLEM_SONUCU"] = "";
	$SONUC["HATAMESAJI"]   = "";

	if($HataMesaji == "") {
		// Sorun yok, her şey normal

		// SQL komutunu MySQL veritabanı üzerinde çalıştır!
		$rows  = mysqli_query($db, $SQL);

		$SONUC["ISLEM_SONUCU"] = "TAMAM";
		$SONUC["HATAMESAJI"]   = "";
	} else {
		// Hata mesajını DÖNELİM
		$SONUC["ISLEM_SONUCU"] = "";
		$SONUC["HATAMESAJI"]   = $HataMesaji;
	}

  echo json_encode($SONUC); // $SONUC değişkeni içindeki değerleri JSON formatına dönüştür ve gönder
