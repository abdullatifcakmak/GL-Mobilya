<?php
include 'baglanti.php';
session_start();

// Eğer kullanıcı giriş yapmamışsa, yönlendirme yap
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: 403.php");
    exit;
}

// Kullanıcı ID'sini oturumdan al
$user_id = $_SESSION['kullanici_id'];

// Form verilerini kontrol et
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $adsoyad = isset($_POST['adsoyad']) ? trim($_POST['adsoyad']) : '';
    $eposta = isset($_POST['eposta']) ? trim($_POST['eposta']) : '';
    $telefon = isset($_POST['telefon']) ? trim($_POST['telefon']) : '';
    $resim = isset($_FILES['resim']['name']) && !empty($_FILES['resim']['name']) ? $_FILES['resim']['name'] : null;

    // Hataları kontrol et
    $hatalar = [];

    if (empty($adsoyad)) {
        $hatalar[] = "Ad Soyad boş olamaz.";
    }
    if (empty($eposta) || !filter_var($eposta, FILTER_VALIDATE_EMAIL)) {
        $hatalar[] = "Geçerli bir e-posta adresi giriniz.";
    }
    if (empty($telefon) || !preg_match('/^\d{10,15}$/', $telefon)) {
        $hatalar[] = "Telefon numarası 10-15 haneli olmalıdır.";
    }

    // Resim yükleme işlemi
    if (!empty($resim)) {
        $hedef_dizin = "images/";
        $hedef_dosya = $hedef_dizin . basename($_FILES['resim']['name']);
        $resim_tipi = strtolower(pathinfo($hedef_dosya, PATHINFO_EXTENSION));
        $izinli_tipler = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($resim_tipi, $izinli_tipler)) {
            $hatalar[] = "Yalnızca JPG, JPEG, PNG ve GIF dosyaları yüklenebilir.";
        } elseif ($_FILES['resim']['size'] > 5000000) { // 5MB sınırı
            $hatalar[] = "Resim dosyası 5MB'den küçük olmalıdır.";
        } else {
            if (!move_uploaded_file($_FILES['resim']['tmp_name'], $hedef_dosya)) {
                $hatalar[] = "Resim yüklenirken bir hata oluştu.";
            }
        }
    } else {
        // Resim yüklenmezse mevcut resmi koruyalım
        $stmt = $conn->prepare("SELECT resim FROM kullanicilar WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $resim = $user['resim']; // Mevcut resmi al
        } else {
            $hatalar[] = "Kullanıcı bulunamadı.";
        }
        $stmt->close();
    }

    // Eğer hata yoksa veritabanını güncelle
    if (empty($hatalar)) {
        $stmt = $conn->prepare(
            "UPDATE kullanicilar SET ad = ?, soyad = ?, eposta = ?, telefon = ?, resim = ? WHERE id = ?"
        );
        $ad_soyad = explode(' ', $adsoyad, 2);
        $ad = $ad_soyad[0];
        $soyad = isset($ad_soyad[1]) ? $ad_soyad[1] : '';

        $stmt->bind_param("sssssi", $ad, $soyad, $eposta, $telefon, $resim, $user_id);

        if ($stmt->execute()) {
            $_SESSION['basari'] = "Bilgiler başarıyla güncellendi.";
        } else {
            $_SESSION['hata'] = "Bilgiler güncellenirken bir hata oluştu.";
        }
        $stmt->close();
        $conn->close();
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['hatalar'] = $hatalar;
        header("Location: profile.php");
        exit;
    }
}
