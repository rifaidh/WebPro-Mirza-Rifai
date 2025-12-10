<?php
include '../config.php';
if(isset($_POST['nama'], $_POST['alamat'], $_POST['telp'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $telp = $conn->real_escape_string($_POST['telp']);

    $conn->query("INSERT INTO pelanggan (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$telp')");
}
header("Location: ../public/pelanggan.php");