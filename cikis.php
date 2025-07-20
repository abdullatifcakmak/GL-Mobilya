<?php
session_start();

// Oturumu sonlandır
session_unset();
session_destroy();

// Anasayfaya yönlendir
header("Location: index.php");
exit;
