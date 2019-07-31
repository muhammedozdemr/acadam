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
    $SQL = sprintf("INSERT INTO musteriler SET
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
                adres_tarifi = '%s'",
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
                $_POST["adres_tarifi"]   );

        // Kontrol için SQL'i yazdıralım...
        // dd($SQL);

        $ISLEM_SONUCU = 0; // 0: Başarısız, 1: Başarılı
        if( count($MESAJ) == 0 ) {
          // KAYIT için hazırız. Veritabanına ekleyelim
          $rows = mysqli_query($db, $SQL);
          $ISLEM_SONUCU = 1;
          die("<H1>MÜŞTERİ KAYIT BAŞARILI</H1>");
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



?>
<div class="row">

  <div class="col-md-8 offset-md-2 py-5">

    <h1>Müşteri Kayıt Formu</h1>

    <?php
      if( isset($MESAJ) and count($MESAJ) > 0 ) {
        echo "<div style='color:red'>";
        foreach ($MESAJ as $key => $value) {
          echo "$value <br />";
        }
        echo "</div>";
      }
    ?>

    <form id="FormMusteriKayit" method="POST" autocomplete="off">
      <div class="controls">

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
      <div class="form-group">Adres Tarifi <input type="text" name="adres_tarifi" class="form-control" value="<?php echo $_POST["adres_tarifi"];?>" placeholder="Adres tarifiniz"></div>

      <input class="btn btn-success" type="submit" value="Kaydet !">

      </div>
    </form>

  </div> <!-- Form Sutunu -->
</div> <!-- Form Satırı -->

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
