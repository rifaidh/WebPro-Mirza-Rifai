<?php
include 'db.php';

if (isset($_POST['simpan'])) {
    $nim            = $_POST['nim'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $no_hp          = $_POST['no_hp'];
    $tanggal_lahir  = $_POST['tanggal_lahir']; 

    $query_insert = "INSERT INTO mahasiswa (nim, nama_lengkap, no_hp, tanggal_lahir) 
                     VALUES ('$nim', '$nama_lengkap', '$no_hp', '$tanggal_lahir')";

    if (mysqli_query($conn, $query_insert)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        input { width: 95%; padding: 5px; margin-bottom: 10px; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        .btn-pdf { background-color: #dc3545; text-decoration: none; padding: 10px 20px; color: white; display: inline-block; }
        h2 { border-bottom: 2px solid #333; padding-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Input Data Siswa Baru</h2>
    
    <form action="" method="POST">
        <label>NIM:</label><br>
        <input type="text" name="nim" required placeholder="Contoh: 5025241001"><br>

        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" required placeholder="Nama Siswa"><br>

        <label>No HP:</label><br>
        <input type="text" name="no_hp" required placeholder="0812xxxx"><br>

        <label>Tanggal Lahir:</label><br>
        <input type="date" name="tanggal_lahir" required><br>

        <button type="submit" name="simpan">Simpan Data</button>
        <a href="cetakPDF.php" target="_blank" class="btn-pdf">Cetak PDF</a>
    </form>

    <br><br>

    <h2>Daftar Data Siswa</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>No HP</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nim ASC");
            
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nim']; ?></td>
                    <td><?= $data['nama_lengkap']; ?></td>
                    <td><?= $data['no_hp']; ?></td>
                    <td><?= $data['tanggal_lahir']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>