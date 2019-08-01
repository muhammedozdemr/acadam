<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Aç Adam!</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"> <a class="nav-link" href="index.php">Ana Sayfa</a> </li>
      <li class="nav-item active"> <a class="nav-link" href="index.php?sayfa=musteri-kayit">Müşteri Kayıt</a> </li>
      <li class="nav-item active"> <a class="nav-link" href="index.php?sayfa=esnaf-kayit">Esnaf Kayıt</a> </li>
      <li class="nav-item active"> <a class="nav-link" href="index.php?sayfa=iletisim-formu">İletişim Formu</a> </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Diğer Sayfalar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Sayfa 1</a>
          <a class="dropdown-item" href="#">Sayfa 2</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Sayfa 3</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Esnaf Ara" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara!</button>
    </form>
  </div>
</nav>
