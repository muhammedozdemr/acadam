<h1>Müşteri Kayıt Formu</h1>

<form id="FormMusteriKayit" method="POST">

<div class="">Adınız Soyadınız *<input required type="text" name="adi_soyadi"  placeholder="Adınız soyadınız"></div>
<div class="">Telefonunuz *<input required type="text" name="telefonu"  placeholder="Telefon numaranız"></div>
<div class="">ePosta Adresi *<input required type="email" name="eposta"  placeholder="ePosta adresiniz"></div>
<div class="">Parolanız *<input required type="password" name="parola"  placeholder="Giriş için parolanız"></div>
<div class="">Parolanız (tekrar)*<input required type="password" name="parola"  placeholder="Parolanız (tekrar)"></div>
<div class="">Şehir * <select name="il_kodu"> <?php echo $optionsIller; ?> </select> </div>
<div class="">İlçe * <select name="ilce_kodu"></select> </div>
<div class="">Mahalle <input type="text" name="mahalle"  placeholder="Mahalle adı"></div>
<div class="">Cadde <input type="text" name="cadde"  placeholder="Cadde adı"></div>
<div class="">Sokak <input type="text" name="sokak"  placeholder="Sokak adı"></div>
<div class="">Bina/Site Adı <input type="text" name="bina_adi"  placeholder="Bina/Site adı"></div>
<div class="">Bina No <input type="text" name="bina_no"  placeholder="Bina No"></div>
<div class="">Kapı No <input type="text" name="kapi_no"  placeholder="Kapı No"></div>
<div class="">Adres Tarifi <input required type="text" name="adres_tarifi"  placeholder="Adres tarifiniz"></div>


</form>
