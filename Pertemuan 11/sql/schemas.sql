-- Buat database
CREATE DATABASE IF NOT EXISTS LaundryCraft;
USE LaundryCraft;

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20)
);

-- Tabel Layanan
CREATE TABLE IF NOT EXISTS layanan (
    id_layanan INT AUTO_INCREMENT PRIMARY KEY,
    nama_layanan VARCHAR(100) NOT NULL,
    harga_per_kg DECIMAL(10,2) NOT NULL
);

-- Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT NOT NULL,
    id_layanan INT NOT NULL,
    tanggal_masuk DATE NOT NULL,
    tanggal_selesai DATE,
    berat DECIMAL(5,2) NOT NULL,
    total_harga DECIMAL(10,2) NOT NULL,
    status ENUM('Baru','Proses','Selesai','Diambil') NOT NULL DEFAULT 'Baru',
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
    FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan) ON DELETE CASCADE
);
