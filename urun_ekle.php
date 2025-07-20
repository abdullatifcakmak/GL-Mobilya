<?php
$pageTitle = "Yeni Ürün Ekle";
include "_header.php"; // Header içeriklerini ekle

include "baglanti.php";

// Ürün ekleme işlemi yapılacaksa:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isim = $_POST['urun_adi'];
    $fiyat = $_POST['fiyat'];
    $stok = $_POST['stok'];
    $resim = $_FILES['resim']['name'];
    $resim_tmp = $_FILES['resim']['tmp_name'];

    // Kategori, Kategori İçerik, Material ve Renk seçimi
    $kategori_id = $_POST['kategori_id'];
    $kategori_icerik_id = $_POST['kategori_icerik_id'];
    $material_id = $_POST['material_id'];
    $renk_id = $_POST['renk_id'];

    // Resim yükleme işlemi
    $resim_path = "images/" . $resim;
    move_uploaded_file($resim_tmp, $resim_path);

    // Ürünü veritabanına ekle
    $sql = "INSERT INTO urunler (urun_adi, fiyat, stok, resim, kategori_id, kategori_icerik_id, material_id, renk_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Parametreleri bağlama
    $stmt->bind_param("sdssiiii", $isim, $fiyat, $stok, $resim, $kategori_id, $kategori_icerik_id, $material_id, $renk_id);

    // Parametreleri execute ederek sorguyu çalıştır
    if ($stmt->execute()) {
        // İşlem başarılı, yönlendir
        @header("Location: admin.php");
    } else {
        echo "Hata: " . $stmt->error;
    }
}
?>

<!-- HTML kısmı burada başlar -->
<div class="container">
    <h1>Yeni Ürün Ekle</h1>
    <form action="urun_ekle.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="isim">Ürün İsmi</label>
            <input type="text" class="form-control" id="isim" name="urun_adi" required>
        </div>
        <div class="form-group">
            <label for="fiyat">Fiyat</label>
            <input type="number" class="form-control" id="fiyat" name="fiyat" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>


        <!-- Kategori Seçimi -->
        <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <select class="form-control" id="kategori_id" name="kategori_id" required>
                <?php
                // Kategoriler listesini al
                $kategori_query = "SELECT * FROM kategori";
                $kategori_result = $conn->query($kategori_query);
                while ($kategori = $kategori_result->fetch_assoc()) {
                    echo "<option value='{$kategori['id']}'>{$kategori['kategori_adi']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Kategori İçerik Seçimi -->
        <div class="form-group">
            <label for="kategori_icerik_id">Kategori İçeriği</label>
            <select class="form-control" id="kategori_icerik_id" name="kategori_icerik_id" required>
                <?php
                // Kategori içerik listesini al
                $icerik_query = "SELECT * FROM kategori_icerik";
                $icerik_result = $conn->query($icerik_query);
                while ($icerik = $icerik_result->fetch_assoc()) {
                    echo "<option value='{$icerik['id']}'>{$icerik['kategori_icerik_adi']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Material Seçimi -->
        <div class="form-group">
            <label for="material_id">Material</label>
            <select class="form-control" id="material_id" name="material_id" required>
                <?php
                // Material listesini al
                $material_query = "SELECT * FROM material";
                $material_result = $conn->query($material_query);
                while ($material = $material_result->fetch_assoc()) {
                    echo "<option value='{$material['id']}'>{$material['material_adi']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Renk Seçimi -->
        <div class="form-group">
            <label for="renk_id">Renk</label>
            <select class="form-control" id="renk_id" name="renk_id" required>
                <?php
                // Renk listesini al
                $renk_query = "SELECT * FROM renkler";
                $renk_result = $conn->query($renk_query);
                while ($renk = $renk_result->fetch_assoc()) {
                    echo "<option value='{$renk['id']}'>{$renk['renk_adi']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="resim">Resim</label>
            <input type="file" class="form-control" id="resim" name="resim" required>
        </div>

        <button type="submit" class="btn btn-primary">Ürün Ekle</button>
    </form>
</div>

<?php
$conn->close();
include "_footer.php";
?>