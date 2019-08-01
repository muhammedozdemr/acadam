
<div class="row">
	<div class="col-md-12 my-4 text-center">
		<h2>Müşteri İletişim Formu</h2>
	</div>
</div>

<form id="IletisimFormu" autocomplete="off">

	<div class="row">

      <div class="col-md-6">
				<div class="form-group">Ad Soyad: <input class="form-control" required type="text" name="adiniz"></div>
			</div>
			<div class="col-md-6">
				<div class="form-group">ePosta:   <input class="form-control" required type="text" name="eposta"></div>
			</div>
			<div class="col-md-6">
				<div class="form-group">Telefon:  <input class="form-control" required type="text" name="telefon"></div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					Mesaj Konusu:
					<select class="form-control" required name="mesajkonusu">
						<option value="">Seçiniz</option>
						<option value="Şikayet">Şikayet</option>
						<option value="Teşekkür">Teşekkür</option>
						<option value="Öneri">Öneri</option>
						<option value="Diğer">Diğer</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">Mesajınız: <textarea class="form-control" required name="mesaj" rows="5"></textarea></div>
			</div>
			<div class="col-md-12 text-center">
				<input type="button" class="btn btn-success col-md-6" value="Mesajımı İlet!" onclick="FORMU_KAYDET()">
			</div>

	</div>

</form>

<script>
	function FORMU_KAYDET() {
		// Kaydetme modülünü çağıralım / Formu POST edelim

	   $.ajax({
	       url: "iletisim.formu.kaydet.php", // FORM, bu sayfaya gönderilecek.
	       type: 'POST',  // Form POST ile gönderilsin
	       dataType: 'JSON', // Gelen veri HTML tipinde olacak. (Diğer bir seçenek de JSON'dur)
	       data: $("#IletisimFormu").serialize(), // FORM öğesi içindeki tüm değişkenleri ve değerlerini göndermek üzere hazırla
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
							  text: 'Fikirlerinizi paylaştığınız için teşekkür ederiz.',
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
