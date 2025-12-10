# Membuat CRUD LaundryCraft

## index.php
<img width="800" alt="image" src="https://github.com/user-attachments/assets/1ab04fad-e0c9-4e25-b932-0c0cc1fd1e52" />  

Mengambil keseluruhan data dari database untuk ditampilkan  
[Source Code](public/index.php)

## pelanggan.php
<img width="800" alt="image" src="https://github.com/user-attachments/assets/35f41abb-54d6-4466-90d9-df497a1d179c" />  

Mengelola data pelanggan di tabel pelanggan. Bisa menambahkan pelanggan baru yang akan memanggil function tampilan lain.  

<img width="800" alt="image" src="https://github.com/user-attachments/assets/252ac3f1-a1a2-4179-9e0d-0a40d44cba7f" />  

Saat selesai mengisi form dan klik tombol simpan, maka akan memanggil script php untuk memnambahkan ke database.  
[Source Code](public/pelanggan.php)  
[Script tambah pelanggan](controller/tambah_pelanggan.php)  
[Script hapus pelanggan](controller/hapus_pelanggan.php)

## packages.php
<img width="800" alt="image" src="https://github.com/user-attachments/assets/dfe49033-87ae-4cc2-b1f0-51a8698cb445" />  

Mengelola data jenis paket layanan di tabel layanan. Bisa menambahkan layanan baru yang akan memanggil function tampilan lain.  

<img width="800" alt="image" src="https://github.com/user-attachments/assets/36e1b620-e57f-402d-9d7e-9d40cb3296e0" />  

Saat selesai mengisi form dan klik tombol simpan, maka akan memanggil script php untuk memnambahkan ke database.  
[Source Code](public/packages.php)  
[Script tambah layanan](controller/tambah_layanan.php)  
[Script hapus layanan](controller/hapus_layanan.php)

## transaksi.php
<img width="800" alt="image" src="https://github.com/user-attachments/assets/f5ee90cc-6d98-4ab8-9fab-7cdf25d51d02" />  

Mengelola data transaksi di tabel transaksi. Bisa menambahkan transaksi baru yang akan memanggil function tampilan lain. Dan bisa mengubah
status dengan cara klik badge-nya  

<img width="800" alt="image" src="https://github.com/user-attachments/assets/77f8b35c-eb02-4750-bb8e-a7119fa3cb1c" />  

Saat selesai mengisi form dan klik tombol simpan, maka akan memanggil script php untuk memnambahkan ke database.  
[Source Code](public/transaksi.php)  
[Script tambah transaksi](controller/tambah_transaksi.php)  
[Script ubah status](controller/status.php)

