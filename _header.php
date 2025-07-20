<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="images/gl-logo-2.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/profile.css" rel="stylesheet">
  <title>GL Mobilya | <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Varsayılan Başlık'; ?></title>

  <style>
    .alert {
      text-align: center;
    }

    .profile-icon {
      font-size: 115%;
      cursor: pointer;
      color: #fff;
    }

    .auth-links a {
      color: #fff;
      text-decoration: none;
    }
  </style>

</head>

<body>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (isset($_SESSION["basariMesaj"])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION["basariMesaj"] . '</div>';
    unset($_SESSION["basariMesaj"]);
  }
  if (isset($_SESSION["hataMesaj"])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["hataMesaj"] . '</div>';
    unset($_SESSION["hataMesaj"]);
  }
  if (isset($_SESSION["hataliSifre"])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["hataliSifre"] . '</div>';
    unset($_SESSION["hataliSifre"]);
  }
  if (isset($_SESSION["hataliEposta"])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["hataliEposta"] . '</div>';
    unset($_SESSION["hataliEposta"]);
  }
  ?>

  <!-- Start Header/Navigation -->
  <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img style="width:25%" src="images/gl-logo.png" alt="logo">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="<?php echo ($activePage == 'home') ? 'nav-item active' : ''; ?>">
            <a class="nav-link" href="index.php">Anasayfa</a>
          </li>
          <li class="<?php echo ($activePage == 'shop') ? 'nav-item active' : ''; ?>"><a class="nav-link" href="shop.php">Alışveriş</a></li>
          <li class="<?php echo ($activePage == 'about') ? 'nav-item active' : ''; ?>"><a class="nav-link" href="about.php">Hakkımızda</a></li>
          <li class="<?php echo ($activePage == 'services') ? 'nav-item active' : ''; ?>"><a class="nav-link" href="services.php">Servisler</a></li>
          <li class="<?php echo ($activePage == 'blog') ? 'nav-item active' : ''; ?>"><a class="nav-link" href="blog.php">Blog</a></li>
          <li class="<?php echo ($activePage == 'contact') ? 'nav-item active' : ''; ?>"><a class="nav-link" href="contact.php">İletişim</a></li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
          <?php if (isset($_SESSION['kullanici_id'])): ?>
            <li class="nav-item">
              <a href="profile.php" class="nav-link">
                <div class="profile-icon">
                  <i class="fa-regular fa-user"></i>
                </div>
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link mx-md-4 active" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Giriş Yap / Üye Ol</a>
            </li>
          <?php endif; ?>
          <li class="<?php echo ($activePage == 'cart') ? 'nav-item active' : ''; ?>"><a class="nav-link" href="cart.php"><img src="images/cart.svg" style="width: 77%;"></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="tabs-listing mt-4">
            <nav>
              <div class="nav nav-tabs d-flex justify-content-center border-0" id="nav-tab" role="tablist">
                <button class="btn btn-outline-warning text-uppercase me-3 active" id="nav-log-in-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab" aria-controls="nav-sign-in" aria-selected="true">
                  Giriş Yap
                </button>
                <button class="btn btn-outline-warning text-uppercase" id="nav-sign-in-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">
                  Üye Ol
                </button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <!-- Giriş Yap Formu -->
              <div class="tab-pane fade active show" id="nav-sign-in" role="tabpanel" aria-labelledby="nav-sign-in-tab">
                <form action="login_handler.php" method="POST" id="form1" class="form-group flex-wrap p-3">
                  <div class="form-input col-lg-12 my-4">
                    <label for="exampleInputEmail1" class="form-label fs-6 text-uppercase fw-bold text-black">E-Posta Adresi</label>
                    <input type="text" id="exampleInputEmail1" name="eposta" placeholder="E-Posta" class="form-control ps-3" />
                  </div>
                  <div class="form-input col-lg-12 my-4">
                    <label for="inputPassword1" class="form-label fs-6 text-uppercase fw-bold text-black">Şifre</label>
                    <input type="password" id="inputPassword1" name="sifre" placeholder="Şifre" class="form-control ps-3" />
                    <div id="passwordHelpBlock" class="form-text text-center">
                      <a href="#" class="password">Şifremi Unuttum!</a>
                    </div>
                  </div>
                  <input type="checkbox" id="beni_hatirla" name="beni_hatirla" <?php echo isset($_COOKIE['kullanici_eposta']) ? 'checked' : ''; ?>>
                  <label for="beni_hatirla">Beni Hatırla</label>
                  <div class="d-grid my-3">
                    <button name="girisbuton" class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">
                      Giriş Yap
                    </button>
                  </div>
                </form>
              </div>
              <!-- Üye Ol Formu -->
              <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                <form action="sign_handler.php" method="POST" id="form2" class="form-group flex-wrap p-3">

                  <div class="row">
                    <div class="form-input col-lg-6 ">
                      <label
                        for="exampleInputAd"
                        class="form-label fs-6 text-uppercase fw-bold text-black">Ad</label>
                      <input
                        type="text"
                        id="exampleInputAd"
                        name="ad"
                        placeholder="Ad"
                        class="form-control ps-3" />
                      <div class="text-danger" id="adError"></div>
                    </div>
                    <div class="form-input col-lg-6 ">
                      <label
                        for="exampleInputSoyad"
                        class="form-label fs-6 text-uppercase fw-bold text-black">Soyad</label>
                      <input
                        type="text"
                        id="exampleInputSoyad"
                        name="soyad"
                        placeholder="Soyad"
                        class="form-control ps-3" />
                      <div class="text-danger" id="soyadError"></div>
                    </div>
                  </div>

                  <div class="form-input col-lg-12 my-4">
                    <label
                      for="exampleInputEmail2"
                      class="form-label fs-6 text-uppercase fw-bold text-black">E-Posta Adresi</label>
                    <input
                      type="email"
                      id="exampleInputEmail2"
                      name="eposta"
                      placeholder="E-Posta"
                      class="form-control ps-3" />
                  </div>
                  <div class="form-input col-lg-12 my-4">
                    <label
                      for="inputPassword2"
                      class="form-label fs-6 text-uppercase fw-bold text-black">Şifre</label>
                    <input
                      type="password"
                      id="inputPassword2"
                      name="sifre"
                      placeholder="Şifre"
                      class="form-control ps-3"
                      aria-describedby="passwordHelpBlock" />
                    <div class="text-danger" id="sifreError"></div>
                  </div>
                  <label class="py-3">
                    <input
                      type="checkbox"
                      required=""
                      class="d-inline" />
                    <span class="label-body text-black">
                      <a
                        href="#"
                        class="text-black password border-bottom">Gizlilik Politikasını</a>
                      kabul ediyorum.
                    </span>
                  </label>
                  <div class="d-grid my-3">
                    <!-- <input type="submit" class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6" value="gönder"> -->
                    <button
                      id="kayitbuton"
                      name="kayitbuton"
                      class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">
                      Üye Ol
                    </button>


                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>