<?php
include "baglanti.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sepet_id = intval($_POST['sepet_id']);

    if (isset($_POST['increase'])) {
        $query = "UPDATE sepet SET miktar = miktar + 1 WHERE id = ?";
    } elseif (isset($_POST['decrease'])) {
        $query = "UPDATE sepet SET miktar = GREATEST(miktar - 1, 1) WHERE id = ?";
    } elseif (isset($_POST['remove'])) {
        $query = "DELETE FROM sepet WHERE id = ?";
    }

    if (!empty($query)) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $sepet_id);
        $stmt->execute();
    }

    header("Location: cart.php");
    exit;
}
