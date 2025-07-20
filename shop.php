<?php
$pageTitle = "Shop";
$activePage = "shop";
include "_header.php";
include "baglanti.php";

// Filtreleme parametrelerini al
$category = isset($_POST['category']) ? $_POST['category'] : '';
$category_icerik = isset($_POST['category_icerik']) ? $_POST['category_icerik'] : '';
$material = isset($_POST['material']) ? $_POST['material'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$price = isset($_POST['fiyat']) ? $_POST['fiyat'] : '';

// SQL sorgusunu başlat
$sql = "SELECT * FROM urunler WHERE 1";

// Kategori filtresi
if (!empty($category)) {
	$sql .= " AND kategori_id = " . intval($category);
}

// Kategori içerik filtresi
if (!empty($category_icerik)) {
	$sql .= " AND kategori_icerik_id = " . intval($category_icerik);
}

// Malzeme filtresi
if (!empty($material)) {
	$sql .= " AND material_id = " . intval($material);
}

// Renk filtresi
if (!empty($color)) {
	$sql .= " AND renk_id = " . intval($color);
}

// Fiyat filtresi
if (!empty($price)) {
	if ($price == '500-1000') {
		$sql .= " AND fiyat BETWEEN 500 AND 1000";
	} elseif ($price == '1000-2500') {
		$sql .= " AND fiyat BETWEEN 1000 AND 2500";
	} elseif ($price == '2500-5000') {
		$sql .= " AND fiyat BETWEEN 2500 AND 5000";
	} elseif ($price == '5000-7500') {
		$sql .= " AND fiyat BETWEEN 5000 AND 7500";
	} elseif ($price == '7500-10000') {
		$sql .= " AND fiyat BETWEEN 7500 AND 10000";
	}
}

// Ürünleri çek
$result = $conn->query($sql);
?>

<!-- Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>Ürünler</h1>
					<p>GL Mobilya'nın geniş ürün yelpazesine göz atın. Filtreleri kullanarak aradığınız ürünü kolayca bulun!</p>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="hero-img-wrap">
					<img src="images/couch.png" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Filtreleme Formu -->
<div class="container mb-5" style="margin-top: 10%;">
	<form method="POST" action="shop.php">
		<div class="row">
			<div class="col-md-3">
				<label for="category">Kategori:</label>
				<select name="category" id="category" class="form-control">
					<option value="">Tüm Kategoriler</option>
					<?php
					$kategoriler = $conn->query("SELECT id, kategori_adi FROM kategori");
					while ($kategori = $kategoriler->fetch_assoc()) {
						echo "<option value='{$kategori['id']}'" . ($category == $kategori['id'] ? ' selected' : '') . ">{$kategori['kategori_adi']}</option>";
					}
					?>
				</select>
			</div>
			<div class="col-md-3">
				<label for="category_icerik">Kategori İçeriği:</label>
				<select name="category_icerik" id="category_icerik" class="form-control">
					<option value="">Tüm İçerikler</option>
					<?php
					$icerikler = $conn->query("SELECT id, kategori_icerik_adi FROM kategori_icerik");
					while ($icerik = $icerikler->fetch_assoc()) {
						echo "<option value='{$icerik['id']}'" . ($category_icerik == $icerik['id'] ? ' selected' : '') . ">{$icerik['kategori_icerik_adi']}</option>";
					}
					?>
				</select>
			</div>
			<div class="col-md-3">
				<label for="material">Malzeme:</label>
				<select name="material" id="material" class="form-control">
					<option value="">Tüm Malzemeler</option>
					<?php
					$malzemeler = $conn->query("SELECT id, material_adi FROM material");
					while ($malzeme = $malzemeler->fetch_assoc()) {
						echo "<option value='{$malzeme['id']}'" . ($material == $malzeme['id'] ? ' selected' : '') . ">{$malzeme['material_adi']}</option>";
					}
					?>
				</select>
			</div>
			<div class="col-md-3">
				<label for="color">Renk:</label>
				<select name="color" id="color" class="form-control">
					<option value="">Tüm Renkler</option>
					<?php
					$renkler = $conn->query("SELECT id, renk_adi FROM renkler");
					while ($renk = $renkler->fetch_assoc()) {
						echo "<option value='{$renk['id']}'" . ($color == $renk['id'] ? ' selected' : '') . ">{$renk['renk_adi']}</option>";
					}
					?>
				</select>
			</div>
			<div class="col-md-3 mt-3">
				<label for="fiyat">Fiyat:</label>
				<select name="fiyat" id="fiyat" class="form-control">
					<option value="">Tüm Fiyatlar</option>
					<option value="500-1000" <?= $price == '500-1000' ? 'selected' : '' ?>>500-1000 TL</option>
					<option value="1000-2500" <?= $price == '1000-2500' ? 'selected' : '' ?>>1000-2500 TL</option>
					<option value="2500-5000" <?= $price == '2500-5000' ? 'selected' : '' ?>>2500-5000 TL</option>
					<option value="5000-7500" <?= $price == '5000-7500' ? 'selected' : '' ?>>5000-7500 TL</option>
					<option value="7500-10000" <?= $price == '7500-10000' ? 'selected' : '' ?>>7500-10000 TL</option>
				</select>
			</div>
		</div>
		<button type="submit" class="btn btn-primary mt-3">Filtrele</button>
	</form>
</div>

<!-- Ürün Listeleme -->
<div class="untree_co-section product-section before-footer-section">
	<div class="container">
		<div class="row">
			<?php if ($result->num_rows > 0): ?>
				<?php while ($row = $result->fetch_assoc()): ?>
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="#">
							<!-- Veritabanından resim yolunu çek -->
							<img src="images/<?= htmlspecialchars($row['resim']) ?>" class="img-fluid product-thumbnail" alt="<?= htmlspecialchars($row['urun_adi']) ?>">
							<h3 class="product-title"><?= htmlspecialchars($row['urun_adi']) ?></h3>
							<strong class="product-price"><?= number_format($row['fiyat'], 2) ?> TL</strong>

							<!-- Sepete Ekle -->
							<span class="icon-cross">
								<a href="sepet_ekle.php?urun_id=<?= $row['id'] ?>" class="btn btn-primary">
									Sepete Ekle
								</a>
							</span>
						</a>
					</div>
				<?php endwhile; ?>
			<?php else: ?>
				<p class="text-center">Mağazada ürün bulunamadı.</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
$conn->close();
include "_footer.php";
?>