<?php

// Veritabanına bağlantı yapalım
require("ajax.on.hazirlik.php");

    // Hata mesajları için bir dizi tanımlayalım
    $MESAJ = array();

    if($_POST["parola"] <> $_POST["parola2"]) {
      $MESAJ[] = "Parola ve tekrarı aynı değil";
    }

    if($_POST["ilce_kodu"] == 0) {
      $MESAJ[] = "İlçe seçimi yapılmadı";
    }


    // INSERT için SQL hazırlayalım...
    $SQL = sprintf("INSERT INTO esnaflar SET
                adi_soyadi = '%s',
                telefonu = '%s',
                eposta = '%s',
                parola = '%s',
                il_kodu = '%s',
                ilce_kodu = '%s',
                mahalle = '%s',
                cadde = '%s',
                sokak = '%s',
                bina_adi = '%s',
                bina_no = '%s',
                kapi_no = '%s',
                adres_tarifi = '%s',

                isletme_adi = '%s',
                isletme_tam_adi = '%s',
                vergi_dairesi = '%s',
                vergi_no = '%s',
                yonetici_adi_soyadi = '%s',
                yonetici_telefonu = '%s',
                enlem = '%s',
                boylam = '%s',
                min_siparis_tutari = '%s',
                acilis_saati = '%s',
                kapanis_saati = '%s',
                ana_faaliyet_alani = '%s'           ",

                $_POST["adi_soyadi"],
                $_POST["telefonu"],
                $_POST["eposta"],
                $_POST["parola"],
                $_POST["il_kodu"],
                $_POST["ilce_kodu"],
                $_POST["mahalle"],
                $_POST["cadde"],
                $_POST["sokak"],
                $_POST["bina_adi"],
                $_POST["bina_no"],
                $_POST["kapi_no"],
                $_POST["adres_tarifi"],

                $_POST["isletme_adi"],
                $_POST["isletme_tam_adi"],
                $_POST["vergi_dairesi"],
                $_POST["vergi_no"],
                $_POST["yonetici_adi_soyadi"],
                $_POST["yonetici_telefonu"],
                $_POST["enlem"],
                $_POST["boylam"],
                intval($_POST["min_siparis_tutari"]),
                $_POST["acilis_saati"],
                $_POST["kapanis_saati"],
                intval($_POST["ana_faaliyet_alani"])

                 );

    // JSON İLE DÖNECEK DÖNÜŞ DEĞİŞKENLERİNE İLK DEĞERLERİNİ VERELİM
  	$SONUC["HATAMESAJI"]   = "";
  	$SONUC["ISLEM_SONUCU"] = "";

    if( count($MESAJ) == 0 ) {
      // KAYIT için hazırız. Veritabanına ekleyelim
      $rows = mysqli_query($db, $SQL);

      // JSON İLE DÖNECEK DÖNÜŞ DEĞİŞKENLERİ DOLDURALIM
      $SONUC["ISLEM_SONUCU"] = "TAMAM";
    	$SONUC["HATAMESAJI"]   = "";
    } else {
      // Hatalar var, kayıt yapamıyoruz...
      $SONUC["ISLEM_SONUCU"] = "";
      $SONUC["HATAMESAJI"]   = implode("\n", $MESAJ);
    }

    echo json_encode($SONUC); // $SONUC değişkeni içindeki değerleri JSON formatına dönüştür ve gönder
