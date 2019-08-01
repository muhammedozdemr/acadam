<?php

  // FORM Kayıt için gönderilmişse gerekli işlemi yapalım
  if(isset( $_POST["adi_soyadi"] )) {

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
                kapanis_saati = '%s'   ",

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
                $_POST["min_siparis_tutari"],
                $_POST["acilis_saati"],
                $_POST["kapanis_saati"]

                 );

        // Kontrol için SQL'i yazdıralım...
        // dd($SQL);

        $ISLEM_SONUCU = 0; // 0: Başarısız, 1: Başarılı
        if( count($MESAJ) == 0 ) {
          // KAYIT için hazırız. Veritabanına ekleyelim
          $rows = mysqli_query($db, $SQL);
          $ISLEM_SONUCU = 1;
          die("<H1>ESNAF KAYIT BAŞARILI</H1>");
          // Yönlendirme???
          // Yönlendirme???
          // Yönlendirme???
        } else {
          // Hatalar var, kayıt yapamıyoruz...
          $ISLEM_SONUCU = 0;
        }
  }


    ################### Şehir adlarını hazırlayalım...
    ################### Şehir adlarını hazırlayalım...

    // Tabloda iller tekrar ediyor. Bu nedenle DISTINCT ile alıyorum ki tekil olarak gelsinler
    $SQL  = "SELECT DISTINCT il_kodu, il_adi FROM ref_il_ilce ORDER BY il_adi";
    $rows = mysqli_query($db, $SQL);

    $optionsIller = "<option value=''>*** SEÇİNİZ ***</option> \n"; // İl COMBO'muz bizi SEÇİNİZ ifadesi ile karşılasın
    while($row = mysqli_fetch_assoc($rows)) { // Kayıt adedince dönelim
      // Her bir il adı ve kodunun COMBO içinde olması gereken halini hazırlayalım
      $optionsIller .= sprintf("<option value='%s'>%s</option> \n", $row["il_kodu"], $row["il_adi"]);
    } // while

    ################### Ana Faaliyet Sahası bilgisini hazırlayalım...
    ################### Ana Faaliyet Sahası bilgisini hazırlayalım...

    // Faaliyet sahasını getirecek sorguyu yazalım
    $SQL  = "SELECT faaliyet_id, faaliyet_adi FROM ref_faaliyet_alanlari ORDER BY siralama ";
    $rows = mysqli_query($db, $SQL);

    $optionsFaaliyetAlanlari = "<option value=''>*** SEÇİNİZ ***</option> \n"; // İl COMBO'muz bizi SEÇİNİZ ifadesi ile karşılasın
    while($row = mysqli_fetch_assoc($rows)) { // Kayıt adedince dönelim
      // Her faaliyet adının COMBO içinde olması gereken halini hazırlayalım
      $optionsFaaliyetAlanlari .= sprintf("<option value='%s'>%s</option> \n", $row["faaliyet_id"], $row["faaliyet_adi"]);
    } // while



?>
  <div class="row">
    <div class="col-md-8 offset-md-2 my-5 text-center">
      <h1>Esnaf Kayıt Formu</h1>
      <?php
        if( isset($MESAJ) and count($MESAJ) > 0 ) {
          echo "<div style='color:red'>";
          foreach ($MESAJ as $key => $value) { echo "$value <br />"; }
          echo "</div>";
        }
      ?>
    </div>
  </div>

  <form id="FormEsnafKayit" method="POST" autocomplete="off">
    <div class="row">
        <div class="col-md-5 offset-md-1">
          <div class="form-group">Adınız Soyadınız *<input required type="text" name="adi_soyadi" class="form-control" value="<?php echo $_POST["adi_soyadi"];?>" placeholder="Adınız soyadınız"></div>
          <div class="form-group">Telefonunuz *<input required type="text" name="telefonu" class="form-control" value="<?php echo $_POST["telefonu"];?>" placeholder="Telefon numaranız"></div>
          <div class="form-group">ePosta Adresi *<input required type="email" name="eposta" class="form-control" value="<?php echo $_POST["eposta"];?>" placeholder="ePosta adresiniz"></div>
          <div class="form-group">Parolanız *<input required type="password" name="parola" class="form-control" value="" placeholder="Giriş için parolanız"></div>
          <div class="form-group">Parolanız (tekrar)*<input required type="password" name="parola2" class="form-control" value="" placeholder="Parolanız (tekrar)"></div>
          <div class="form-group">Şehir * <select required name="il_kodu" id="il_kodu" onchange="IlceleriDoldur()" class="form-control" >> <?php echo $optionsIller; ?> </select> </div>
          <div class="form-group">İlçe * <select required name="ilce_kodu" id="ilce_kodu" class="form-control" ></select> </div>
          <div class="form-group">Mahalle <input type="text" name="mahalle" class="form-control" value="<?php echo $_POST["mahalle"];?>" placeholder="Mahalle adı"></div>
          <div class="form-group">Cadde <input type="text" name="cadde" class="form-control" value="<?php echo $_POST["cadde"];?>" placeholder="Cadde adı"></div>
          <div class="form-group">Sokak <input type="text" name="sokak" class="form-control" value="<?php echo $_POST["sokak"];?>" placeholder="Sokak adı"></div>
          <div class="form-group">Bina/Site Adı <input type="text" name="bina_adi" class="form-control" value="<?php echo $_POST["bina_adi"];?>" placeholder="Bina/Site adı"></div>
          <div class="form-group">Bina No <input type="text" name="bina_no" class="form-control" value="<?php echo $_POST["bina_no"];?>" placeholder="Bina No"></div>
          <div class="form-group">Kapı No <input type="text" name="kapi_no" class="form-control" value="<?php echo $_POST["kapi_no"];?>" placeholder="Kapı No"></div>
        </div>

        <div class="col-md-5">
          <div class="form-group">Adres Tarifi <input type="text" name="adres_tarifi" class="form-control" value="<?php echo $_POST["adres_tarifi"];?>" placeholder="Adres tarifiniz"></div>
          <div class="form-group">İşletme Adı *<input required type="text" name="isletme_adi" class="form-control" value="<?php echo $_POST["isletme_adi"];?>" placeholder="isletme_adi"></div>
          <div class="form-group">İşletmenin Tam Adı *<input required type="text" name="isletme_tam_adi" class="form-control" value="<?php echo $_POST["isletme_tam_adi"];?>" placeholder="isletme_tam_adi"></div>
          <div class="form-group">Vergi Dairesi *<input required type="text" name="vergi_dairesi" class="form-control" value="<?php echo $_POST["vergi_dairesi"];?>" placeholder="vergi_dairesi"></div>
          <div class="form-group">Vergi Numarası *<input required type="text" name="vergi_no" class="form-control" value="<?php echo $_POST["vergi_no"];?>" placeholder="vergi_no"></div>
          <div class="form-group">İşletme Sahibi/Yönetisicisi Adı Soyadı *<input required type="text" name="yonetici_adi_soyadi" class="form-control" value="<?php echo $_POST["yonetici_adi_soyadi"];?>" placeholder="yonetici_adi_soyadi"></div>
          <div class="form-group">işletme Sahibi/Yönetisicisi Telefonu *<input required type="text" name="yonetici_telefonu" class="form-control" value="<?php echo $_POST["yonetici_telefonu"];?>" placeholder="yonetici_telefonu"></div>
          <div class="form-group">Harita Enlem bilgisi *<input required type="text" name="enlem" class="form-control" value="<?php echo $_POST["enlem"];?>" placeholder="enlem"></div>
          <div class="form-group">Harita Boylam bilgisi *<input required type="text" name="boylam" class="form-control" value="<?php echo $_POST["boylam"];?>" placeholder="boylam"></div>
          <div class="form-group">Minimum Sipariş Tutarı *<input required type="text" name="min_siparis_tutari" class="form-control" value="<?php echo $_POST["min_siparis_tutari"];?>" placeholder="min_siparis_tutari"></div>
          <div class="form-group">Açılış Saati *<input required type="text" name="acilis_saati" class="form-control" value="<?php echo $_POST["acilis_saati"];?>" placeholder="acilis_saati"></div>
          <div class="form-group">Kapanış Saati *<input required type="text" name="kapanis_saati" class="form-control" value="<?php echo $_POST["kapanis_saati"];?>" placeholder="kapanis_saati"></div>
          <div class="form-group">Ana Faaliye Alanı * <select required name="ana_faaliyet_alani" id="ana_faaliyet_alani" class="form-control" >> <?php echo $optionsFaaliyetAlanlari; ?> </select> </div>

          <input class="btn btn-success" type="submit" value="İşletme İçin Kayıt Başvurusunu Gönder !">
        </div>
    </div>
  </form>

<script type="text/javascript">
    function IlceleriDoldur() {
      $.getJSON("ajax.ilceleri.hazirla.php", "il_kodu=" + $("#il_kodu").val(), function(data) {
        $("#ilce_kodu option").remove();
        $.each(data.ILCELER, function(key, val) {
            $("#ilce_kodu").append($("<option />").val(key).text(val));
        });
      });
    } // IlceleriDoldur()
</script>
