<?php
$pageTitle = "Ürün Düzenle";
include "_header.php";
include "baglanti.php";

if (isset($_GET['id'])) {
    $urun_id = $_GET['id'];
    $sql = "SELECT * FROM urunler WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $urun_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $urun = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isim = $_POST['urun_adi'];
    $fiyat = $_POST['fiyat'];
    $stok = $_POST['stok'];
    $resim = $_FILES['resim']['name'];

    // Resim yükleme işlemi
    if ($resim) {
        $resim_tmp = $_FILES['resim']['tmp_name'];
        $resim_path = $resim;
        move_uploaded_file($resim_tmp, $resim_path);
    } else {
        $resim_path = $urun['resim']; // Var olan resmi koru
    }

    // Ürünü güncelle
    $sql = "UPDATE urunler SET urun_adi = ?, fiyat = ?, stok = ?, resim = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $isim, $fiyat, $stok, $resim_path, $urun_id);
    $stmt->execute();

    @header("Location: admin.php"); // Admin sayfasına yönlendir

}

?>

<div class="container">
    <h1>Ürün Düzenle</h1>
    <form action="urun_duzenle.php?id=<?= $urun['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="isim">Ürün İsmi</label>
            <input type="text" class="form-control" id="isim" name="urun_adi" value="<?= $urun['urun_adi'] ?>" required>
        </div>
        <div class="form-group">
            <label for="fiyat">Fiyat</label>
            <input type="number" class="form-control" id="fiyat" name="fiyat" step="0.01" value="<?= $urun['fiyat'] ?>" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" value="<?= $urun['stok'] ?>" required>
        </div>
        <div class="form-group">
            <label for="resim">Resim</label>
            <input type="file" class="form-control" id="resim" name="resim">
            <img src="images/<?= $urun['resim'] ?>" alt="<?= $urun['urun_adi'] ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>

<?php
$conn->close();
include "./_footer.php";
?>