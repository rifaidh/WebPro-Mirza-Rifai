# Arsitektur Aplikasi Website

Aplikasi manajemen data siswa sederhana yang dibangun menggunakan **PHP Native** dan **MySQL (PDO)**. Aplikasi ini menerapkan konsep **Arsitektur 3-Layer (3-Tier Architecture)** secara sederhana dengan memisahkan logika tampilan, pemrosesan data, dan koneksi database.

## Penjelasan Layer

### 1. Presentation Layer (Lapisan Tampilan)
Layer ini bertanggung jawab untuk antarmuka pengguna (User Interface). Berisi kode HTML dan PHP minimal untuk menampilkan data dan formulir kepada pengguna.
* `index.php`: Menampilkan tabel data siswa dan foto.
* `form_simpan.php`: Formulir antarmuka untuk input data baru.
* `form_ubah.php`: Formulir antarmuka untuk mengedit data yang sudah ada (dengan fitur *auto-fill* data lama).

### 2. Logic Layer (Lapisan Proses)
Layer ini menangani logika, validasi input, pemrosesan file (upload gambar), dan mengontrol aliran data antara tampilan dan database.
* `proses_simpan.php`: Menerima input dari form, menangani upload foto (`move_uploaded_file`), dan mengirim perintah simpan.
* `proses_ubah.php`: Menangani logika update, termasuk pengecekan logika apakah foto diganti atau tidak, serta menghapus foto lama jika ada penggantian.
* `proses_hapus.php`: Menangani logika penghapusan data database sekaligus menghapus file fisik foto dari server (`unlink`).

### 3. Data Layer (Lapisan Data)
Layer ini bertugas menangani koneksi dan komunikasi langsung dengan penyimpanan data (Database).
* `koneksi.php`: Mengelola konfigurasi koneksi ke database MySQL menggunakan driver **PDO** (PHP Data Objects) untuk keamanan yang lebih baik.
* Database (MySQL): Tabel `siswa` menyimpan informasi teks dan nama file gambar.

### Struktur Tabel Siswa
**Nama Tabel:** `siswa`

| Nama Kolom | Tipe Data | Atribut |
| :--- | :--- | :--- |
| **id** | `INT(11)` | PRIMARY KEY, AUTO_INCREMENT |
| **nis** | `VARCHAR(20)` | NOT NULL |
| **nama** | `VARCHAR(50)` | NOT NULL |
| **jenis_kelamin** | `VARCHAR(20)` | NOT NULL |
| **telp** | `VARCHAR(15)` | NOT NULL |
| **alamat** | `TEXT` | NOT NULL |
| **foto** | `VARCHAR(255)` | NOT NULL |
