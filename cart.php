<?php
$pageTitle = "Sepet";
include "_header.php";
include "baglanti.php";

// Sepet toplamını hesaplayan fonksiyon
function toplamFiyatHesapla($conn)
{
  // Sepet ve ürünler tablosunu join ederek sepetin içeriğini al
  $query = "
        SELECT urunler.fiyat, sepet.miktar 
        FROM sepet 
        INNER JOIN urunler ON sepet.urun_id = urunler.id";
  $result = $conn->query($query);

  $toplamFiyat = 0;

  // Her bir ürün için fiyat ve miktarı çarpıp toplam fiyatı hesapla
  while ($row = $result->fetch_assoc()) {
    $toplam = $row['fiyat'] * $row['miktar'];
    $toplamFiyat += $toplam;
  }

  return $toplamFiyat;
}

// Sepet verilerini al
$query = "
    SELECT sepet.id AS sepet_id, urunler.id AS urun_id, urunler.urun_adi, urunler.fiyat, urunler.resim, sepet.miktar 
    FROM sepet 
    INNER JOIN urunler ON sepet.urun_id = urunler.id";
$result = $conn->query($query);

// Toplam fiyatı hesapla
$toplamFiyat = toplamFiyatHesapla($conn);
?>

<div class="untree_co-section before-footer-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="site-blocks-table">
          <table class="table">
            <thead>
              <tr>
                <th>Resim</th>
                <th>Ürün</th>
                <th>Fiyat</th>
                <th>Miktar</th>
                <th>Toplam</th>
                <th>Kaldır</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = $result->fetch_assoc()) {
                $toplam = $row['fiyat'] * $row['miktar'];
              ?>
                <tr>
                  <td><img src="images/<?= htmlspecialchars($row['resim']) ?>" alt="<?= htmlspecialchars($row['urun_adi']) ?>" class="img-fluid" style="max-width: 80px;"></td>
                  <td><?= htmlspecialchars($row['urun_adi']) ?></td>
                  <td><?= number_format($row['fiyat'], 2) ?> TL</td>
                  <td>
                    <form method="post" action="sepet_guncelle.php" style="display: flex; align-items: center;">
                      <input type="hidden" name="sepet_id" value="<?= $row['sepet_id'] ?>">
                      <button type="submit" name="decrease" class="btn btn-outline-black btn-sm">-</button>
                      <input type="text" name="miktar" value="<?= $row['miktar'] ?>" class="form-control text-center" style="width: 60px;" readonly>
                      <button type="submit" name="increase" class="btn btn-outline-black btn-sm">+</button>
                    </form>
                  </td>
                  <td><?= number_format($toplam, 2) ?> TL</td>
                  <td>
                    <form method="post" action="sepet_guncelle.php">
                      <input type="hidden" name="sepet_id" value="<?= $row['sepet_id'] ?>">
                      <button type="submit" name="remove" class="btn btn-black btn-sm">X</button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 text-right">
        <h4>Toplam Fiyat: <?= number_format($toplamFiyat, 2) ?> TL</h4>
        <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Ödemeye Devam Et</button>
      </div>
    </div>
  </div>
</div>

<?php include "_footer.php"; ?>