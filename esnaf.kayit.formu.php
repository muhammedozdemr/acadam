<?php

################### FORM içinde kullanılan COMBO'ların değerlerinin hazırlanması
################### FORM içinde kullanılan COMBO'ların değerlerinin hazırlanması
################### FORM içinde kullanılan COMBO'ların değerlerinin hazırlanması

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
    <div class="col-md-12 my-4 text-center">
      <h2>Esnaf Kayıt Formu</h2>
      <?php
        if( isset($MESAJ) and count($MESAJ) > 0 ) {
          echo "<div style='color:red'>";
          foreach ($MESAJ as $key => $value) { echo "$value <br />"; }
          echo "</div>";
        }
      ?>
    </div>
  </div>

  <form id="EsnafKayitFormu" autocomplete="off">
    <div class="row">
        <div class="col-md-6">
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

        <div class="col-md-6">
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

        </div>

        <div class="col-md-12 text-center">
          <input class="btn btn-success" type="button" value="Esnaf Kayıt Başvurusunu Gönder !" onclick="FORMU_KAYDET()">
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



<script>
	function FORMU_KAYDET() {
		// Kaydetme modülünü çağıralım / Formu POST edelim

	   $.ajax({
	       url: "esnaf.kayit.formu.kaydet.php", // FORM, bu sayfaya gönderilecek.
	       type: 'POST',  // Form POST ile gönderilsin
	       dataType: 'JSON', // Gelen veri HTML tipinde olacak. (Diğer bir seçenek de JSON'dur)
	       data: $("#EsnafKayitFormu").serialize(), // FORM öğesi içindeki tüm değişkenleri ve değerlerini göndermek üzere hazırla
	       success: function(AjaxJSONCevap){
	       		// Buraya geldiğinde çağrılan sayfanın işi tamamlanmıştır

	       		if(AjaxJSONCevap.ISLEM_SONUCU == "TAMAM") {
       				// Hata yoksa teşekkür mesajı gösterelim
       				// alert("Mesajınız alındı. Teşekkür ederiz!");

       				// Teşekkür mesajını https://sweetalert2.github.io/ kullanarak verelim
							Swal.fire({
							  type: 'success',
							  title: 'Teşekkürler !',
							  confirmButtonText: 'Tamam',
							  text: 'Başvuru formunuz onay sürecine alındı. Müşteri temsilcilerimiz sizi arayacaktır.',
								onClose: () => {	SayfayaGit('index.php');	}
							})

       			} else {
					// Hata varsa ekrana gösterelim
					// alert( AjaxHTMLCevap )

					Swal.fire({
					  type: 'error',
					  title: 'Eksik veri girişi',
					  confirmButtonText: 'Tamam',
					  text: AjaxJSONCevap.HATAMESAJI
					})


				}
	   		} // success
	   }); // ajax

	} // FORMU_KAYDET

</script>
