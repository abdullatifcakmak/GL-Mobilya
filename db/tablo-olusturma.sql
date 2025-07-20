create table kullanicilar (
	id int auto_increment primary key,
    ad varchar(50),
    soyad varchar(50),
    eposta varchar(50) unique,
    sifre varchar(150)
);

ALTER TABLE kullanicilar
ADD resim VARCHAR(255) DEFAULT 'default.jpg',
ADD telefon VARCHAR(11);

CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori_adi VARCHAR(255) not null
);

CREATE TABLE kategori_icerik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori_icerik_adi VARCHAR(255) not null
);

CREATE TABLE material (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_adi VARCHAR(255) not null
);

CREATE TABLE renkler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    renk_adi VARCHAR(255) not null
);


CREATE TABLE urunler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    urun_adi VARCHAR(255) NOT NULL,
    fiyat DECIMAL(10, 2) NOT NULL,
    stok INT NOT NULL,
    resim VARCHAR(255) DEFAULT 'default.jpg',
    kategori_id INT,
    kategori_icerik_id INT,
    material_id INT,
    renk_id INT,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id),
    FOREIGN KEY (kategori_icerik_id) REFERENCES kategori_icerik(id),
    FOREIGN KEY (material_id) REFERENCES material(id),
    FOREIGN KEY (renk_id) REFERENCES renkler(id)
);



CREATE TABLE sepet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    urun_id INT NOT NULL,
    miktar INT NOT NULL,
    FOREIGN KEY (urun_id) REFERENCES urunler(id)
);






