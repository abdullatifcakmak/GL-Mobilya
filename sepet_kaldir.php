<?php
include "baglanti.php";

if (isset($_POST['sepet_id'])) {
    $sepet_id = $_POST['sepet_id'];

    // Sepetten ürün kaldırma sorgusu
    $kaldirQuery = "DELETE FROM sepet WHERE id = ?";
    $stmt = $conn->prepare($kaldirQuery);
    $stmt->bind_param("i", $sepet_id);

    if ($stmt->execute()) {
        header("Location: cart.php");
    } else {
        echo "Ürün kaldırılırken bir hata oluştu: " . $stmt->error;
    }
} else {
    echo "Geçersiz işlem.";
}
