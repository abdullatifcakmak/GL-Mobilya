<?php
include "baglanti.php";

if (isset($_GET['urun_id'])) {
    $urun_id = intval($_GET['urun_id']);

    // Sepette aynı ürün var mı kontrol et
    $query = "SELECT * FROM sepet WHERE urun_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $urun_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Aynı ürün varsa miktarını artır
        $updateQuery = "UPDATE sepet SET miktar = miktar + 1 WHERE urun_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $urun_id);
        $updateStmt->execute();
    } else {
        // Ürün sepette yoksa yeni satır ekle
        $insertQuery = "INSERT INTO sepet (urun_id, miktar) VALUES (?, 1)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("i", $urun_id);
        $insertStmt->execute();
    }

    header("Location: cart.php");
    exit;
}
