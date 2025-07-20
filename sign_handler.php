<?php
include "baglanti.php";
session_start();

if (isset($_POST["kayitbuton"])) {
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $eposta = $_POST["eposta"];
    $sifre = password_hash($_POST["sifre"], PASSWORD_DEFAULT);

    if (isset($ad) && isset($soyad) && isset($eposta) && isset($sifre)) {
        // E-posta adresinin daha önce kayıtlı olup olmadığını kontrol et
        $kontrol = "SELECT * FROM kullanicilar WHERE eposta = '$eposta'";
        $sonuc = mysqli_query($conn, $kontrol);

        if (mysqli_num_rows($sonuc) > 0) {
            // E-posta adresi zaten kayıtlıysa hata mesajı
            $_SESSION["hataMesaj"] = "Bu e-posta adresi zaten kayıtlı!";
            header("location: index.php");
            exit;
        } else {
            // E-posta adresi veritabanında yoksa yeni kullanıcıyı ekle
            $ekle = "INSERT INTO kullanicilar (ad, soyad, eposta, sifre) VALUES ('$ad', '$soyad', '$eposta', '$sifre')";
            $calistirekle = mysqli_query($conn, $ekle);

            if ($calistirekle) {
                $_SESSION["basariMesaj"] = "Kayıt Başarılı Bir Şekilde Eklendi.";
                header("location: index.php");
                exit;
            } else {
                $_SESSION["hataMesaj"] = "Kayıt esnasında bir hata oluştu!";
                header("location: index.php");
                exit;
            }
        }

        mysqli_close($baglanti);
    } else {
        $_SESSION["hataMesaj"] = "Kayıt Esnasında Sorun Oluştu!";
        header("location: index.php");
        exit;
    }
}
