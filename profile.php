<?php
session_start();
// Giriş kontrolü: Eğer oturum açılmamışsa, 401.php'ye yönlendir.
if (!isset($_SESSION["kullanici_id"])) {
  header("Location: 403.php");
  exit;
}

// // Eğer giriş yapılmamışsa, 403 sayfasına yönlendir
// if (!isset($_SESSION['kullanici_id'])) {
//   header('Location: 403.php'); // 403 sayfasına yönlendir
//   exit;
// }

include "_header.php";
?>

<?php
// Veritabanı bağlantısını dahil et
include 'baglanti.php';

// Kullanıcı ID'si (oturumdan alınabilir)
$user_id = $_SESSION['kullanici_id']; // Oturumdan alınan kullanıcı ID'sini kullanıyoruz

// Kullanıcıyı veritabanından al (Prepared statement kullanıyoruz)
$stmt = $conn->prepare("SELECT * FROM kullanicilar WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Eğer kullanıcı bulunursa, bilgileri göster
if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
} else {
  echo "Kullanıcı bulunamadı.";
  exit;
}

$path = "images/";
?>

<div class="profile-container">
  <div class="profile-header">
    <!-- Profil resmi veritabanından alınan isimle dinamik şekilde gösterilecek -->
    <img src="<?php echo $path . $user["resim"]; ?>" alt="Profil Fotoğrafı" class="profile-picture">
    <h1><?php echo $user['ad']; ?></h1>
    <p><?php echo $user['eposta']; ?></p>
  </div>

  <div class="profile-content">
    <div class="section">
      <h2>Hesap Bilgileri</h2>
      <p><strong>Ad Soyad:</strong> <?php echo $user['ad'] . ' ' . $user['soyad']; ?></p>
      <p><strong>E-posta:</strong> <?php echo $user['eposta']; ?></p>
      <p><strong>Telefon:</strong> <?php echo $user['telefon']; ?></p>
      <!-- Bilgileri Düzenle Butonu -->
      <button type="button" data-bs-toggle="modal" data-bs-target="#guncelle" style="background-color: #3b5d50; color: white; padding: 10px 20px; border: none; cursor: pointer; transition: background-color 0.3s ease;">
        Bilgileri Güncelle
      </button>
      <button type="button" onclick="window.location.href='cikis.php'" style="background-color: #3b5d50; color: white; padding: 10px 20px; border: none; cursor: pointer; transition: background-color 0.3s ease;">
        Çıkış Yap
      </button>

    </div>

    <div class="section">
      <h2>Sipariş Geçmişi</h2>
      <ul class="order-list">
        <li><strong>2024/11/15</strong> - Sipariş #12345 - 250 TL</li>
        <li><strong>2024/10/30</strong> - Sipariş #12330 - 150 TL</li>
        <li><strong>2024/09/20</strong> - Sipariş #12300 - 300 TL</li>
      </ul>
      <button class="btn-view-orders">Tüm Siparişleri Gör</button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="guncelle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bilgilerinizi Güncelleyebilirsiniz. </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form action="guncelle.php" method="POST" enctype="multipart/form-data">
          <div class="mb-1">
            <label for="resim" class="form-label">Resim</label>
            <input type="file" class="form-control" id="resim" name="resim">
          </div>
          <div class="mb-1">
            <label for="adsoyad" class="form-label">Ad Soyad</label>
            <input type="text" class="form-control" id="adsoyad" name="adsoyad" value="<?php echo $user['ad'] . ' ' . $user['soyad']; ?>">
          </div>
          <div class="mb-1">
            <label for="eposta" class="form-label">E-posta</label>
            <input type="text" class="form-control" id="eposta" name="eposta" value="<?php echo $user['eposta']; ?>">
          </div>
          <div class="mb-1">
            <label for="telefon" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo $user['telefon']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color:#f9bf29; color:white">Kapat</button>
            <button type="submit" class="btn" style="background-color:#3b5d50; color:white">Değişiklikleri Kaydet</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Bootstrap JS ve Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>