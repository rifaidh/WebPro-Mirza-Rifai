# Spesifikasi Sistem CRUD Web

## 1. Deskripsi
Sistem Pendaftaran Siswa Baru adalah aplikasi web sederhana berbasis PHP dan MySQL. Sistem ini digunakan untuk mengelola data 
calon siswa yang mendaftar. Admin dapat menginput data siswa, mengubah data, menghapus data, dan melihat daftar siswa dalam bentuk 
tabel. Sistem tidak memiliki role pengguna, sehingga seluruh fungsi dapat diakses langsung. Aplikasi ini bertujuan mempermudah 
proses pencatatan data calon siswa secara digital agar lebih rapi, cepat, dan mudah diakses.

## 2. Tujuan

Dokumen ini menjelaskan spesifikasi teknis untuk aplikasi CRUD berbasis
web, mencakup struktur data, alur fitur, kebutuhan fungsi, dan detail
endpoint.

## 3. Fitur Utama

### 3.1. Pendaftaran Siswa
- Form input data lengkap:
  - Nama
  - Alamat
  - Jenis Kelamin
  - Agama
  - Sekolah Asal

### 3.2. Daftar Siswa
- Menampilkan tabel seluruh calon siswa.
- Menampilkan total jumlah pendaftar.
- Link menuju edit dan hapus per baris data.

### 3.3. Edit Data Siswa
- Memuat data berdasarkan parameter id.
- Mengubah seluruh kolom data.
- Menyimpan perubahan ke database.

### 3.4. Hapus Data
- Menghapus data berdasarkan id.
- Redirect ke halaman daftar siswa.

## 4. Struktur File
```
/pendaftaran-siswa/
│
├── config.php                 → Koneksi database
├── index.php                  → Halaman awal / redirect
├── form-daftar.php            → Halaman form pendaftaran siswa
├── proses-pendaftaran.php     → Logika insert data pendaftaran
├── list-siswa.php             → Daftar seluruh siswa (read)
├── form-edit.php              → Form edit data siswa
├── proses-edit.php            → Proses update data
└── hapus.php                  → Proses delete data
```
## 5. Peran Pengguna
Tidak ada role user. Sistem ini hanya memiliki satu level akses:
- Admin/Petugas: Memasukkan, mengedit, menghapus, dan melihat data siswa.

## 6. Spesifikasi Teknis

-  Front-End: HTML dasar
-  Back-End: PHP (procedural)
-  Database: MySQL
-  Server: Apache (XAMPP)
-  Tools: phpMyAdmin, VS Code
Tidak ada framework CSS/JS atau library tambahan.

## 7. Validasi

-   Semua field wajib diisi
-   Format email valid
-   Panjang teks dibatasi

## 8. Database

Tabel `items`:
```
id	            INT, AUTO_INCREMENT	Primary key
nama	        VARCHAR	
alamat          TEXT	
jenis_kelamin	VARCHAR	
agama	VARCHAR	Agama 
sekolah_asal	VARCHAR
```

## 9. Alur CRUD
1. Alur Proses Sistem
2. Petugas membuka halaman pendaftaran.
3. Petugas mengisi form pendaftaran siswa.
4. Sistem menyimpan data ke tabel calon_siswa.
5. Data ditampilkan pada halaman daftar siswa.
6. Jika perlu mengubah data, petugas memilih menu edit.
7. Jika data ingin dihapus, petugas memilih tombol hapus.
8. Semua perubahan langsung tercatat di database.
9. Alur ini menggambarkan sistem CRUD penuh (Create, Read, Update, Delete).
