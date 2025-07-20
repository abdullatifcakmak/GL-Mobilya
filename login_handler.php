<?php
include "baglanti.php";
session_start();

$epostaErr = "";
$sifreErr = "";

if (isset($_POST["girisbuton"])) {
  $eposta = $_POST["eposta"];
  $sifre = $_POST["sifre"];

  if (!empty($eposta) && !empty($sifre)) {
    $secim = "SELECT * FROM kullanicilar WHERE eposta = ?";
    $stmt = $conn->prepare($secim);
    $stmt->bind_param("s", $eposta);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $ilgilikayit = $result->fetch_assoc();
      $hashlisifre = $ilgilikayit["sifre"];

      if (password_verify($sifre, $hashlisifre)) {
        $_SESSION["kullanici_id"] = $ilgilikayit["id"];
        $_SESSION["eposta"] = $ilgilikayit["eposta"];

        // Beni Hatırla seçeneği kontrolü
        if (isset($_POST["beni_hatirla"])) {
          // Cookie'yi ayarla, 30 gün geçerli
          setcookie("kullanici_id", $ilgilikayit["id"], time() + (86400 * 30), "/"); // 30 gün boyunca geçerli
          setcookie("kullanici_eposta", $eposta, time() + (86400 * 30), "/"); // 30 gün boyunca geçerli
        } else {
          // Cookie'yi temizle, eğer beni hatırla seçeneği işaretlenmediyse
          setcookie("kullanici_id", "", time() - 3600, "/"); // Cookie'yi sil
          setcookie("kullanici_eposta", "", time() - 3600, "/"); // Cookie'yi sil
        }

        // Yönlendirme
        if ($_SESSION["eposta"] == "admin@example.com") {
          header("Location: admin.php");
        } else {
          header("Location: profile.php");
        }
        exit;
      } else {
        $_SESSION["hataliSifre"] = "Hatalı şifre!";
        header("Location: index.php");
        exit;
      }
    } else {
      $_SESSION["hataliEposta"] = "E-posta bulunamadı!";
      header("Location: index.php");
      exit;
    }
  }
  $stmt->close();
  $conn->close();
}
