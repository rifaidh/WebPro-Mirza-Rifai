<?php
include '../config.php';

if(isset($_POST['nama_layanan'], $_POST['harga_per_kg'])){
    $nama = $conn->real_escape_string($_POST['nama_layanan']);
    $harga = intval($_POST['harga_per_kg']);

    $sql = "INSERT INTO layanan (nama_layanan, harga_per_kg) VALUES ('$nama', $harga)";
    if($conn->query($sql)){
        header("Location: ../public/packages.php");
    exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
header("Location: ../public/packages.php");
