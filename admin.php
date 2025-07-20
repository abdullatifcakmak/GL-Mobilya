<?php
session_start();

// Giriş kontrolü: Eğer oturum açılmamışsa, 403.php'ye yönlendir.
if (!isset($_SESSION["kullanici_id"])) {
    header("Location: 401.php");
    exit;
}

// // Kullanıcının giriş yapıp yapmadığını kontrol et
// if (!isset($_SESSION['kullanici_id'])) {
//     // Giriş yapılmadıysa login sayfasına yönlendir
//     header('Location: 401.php');
// }

$pageTitle = "Admin Paneli - Ürünler";
include "_header.php";
include "baglanti.php";

// Ürünleri veritabanından çek
$sql = "SELECT * FROM urunler";
$result = $conn->query($sql);

// Ürün silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM urunler WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    @header("Location: admin.php");  // Sayfayı yeniden yükle
}
?>

<div class="container" style="margin-bottom: 10%;">
    <h1>Ürün Yönetimi</h1>
    <a href="urun_ekle.php" class="btn btn-primary mb-3">Yeni Ürün Ekle</a>

    <h3>Ürünler Listesi</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>İsim</th>
                <th>Fiyat</th>
                <th>Stok</th>
                <th>Resim</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['urun_adi'] ?></td>
                        <td><?= number_format($row['fiyat'], 2) ?> TL</td>
                        <td><?= $row['stok'] ?></td>
                        <td>
                            <img src="images/<?= $row['resim'] ?>" alt="<?= $row['urun_adi'] ?>" width="50">
                        </td>
                        <td>
                            <a href="urun_duzenle.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                            <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Ürün bulunamadı.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include "_footer.php";
?>