## Belajar Menggunakan PHP

# Index
index.php menjadi halaman utama yang ditampilkan ketika membuka file. Pada file ini tidak banyak menggunakan php hanya dibagian status untuk memberikan
informasi apakah data berhasil dimasukkan ke database
<img width="800" alt="image" src="https://github.com/user-attachments/assets/4713dc7f-82ab-4d83-b752-2041694b6634" />

[index.php](index.php)

# Form Daftar
form-daftar.php menjadi halaman yang ditampilkan ketika memilih menu Daftar Baru. Halaman ini akan menampilkan form untuk memasukkan data baru yang kemudian
akan memanggil script proses-pendaftaran.php dan action yang di request adalah "POST"
<img width="800" alt="image" src="https://github.com/user-attachments/assets/f9f21c6f-0e7f-4e06-bc15-27fd51f35f17" />

[form-daftar.php](form-daftar.php)

# Proses Pendaftaran
# List Siswa
list-siswa.php adalah halaman yang muncul ketika kita mengklik menu Pendaftar. Source code disini menggunakan html untuk membuat table dan mengisi table head. Kemudian menggunakan php dan membuat query untuk membaca isi dari database "calon_siswa" dan menuliskannya ke dalam table  
<img width="800" alt="image" src="https://github.com/user-attachments/assets/e1b3501c-ab60-4841-8321-1625ccf1edfc" />

[list-siswa.php](list-siswa.php)

# Form Edit
form-edit.php adalah halaman untuk mengedit data siswa yang sudah masuk di database. Data yang diedit diatur menggunakan id yang kita pilih di database. Ketika kita klik simpan maka

