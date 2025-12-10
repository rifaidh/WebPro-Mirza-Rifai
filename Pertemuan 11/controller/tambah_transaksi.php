<?php
include '../config.php';

if(isset($_POST['id_pelanggan'], $_POST['id_layanan'], $_POST['berat'], $_POST['tanggal_masuk'], $_POST['tanggal_selesai'], $_POST['status'])) {
    $id_pelanggan = intval($_POST['id_pelanggan']);
    $id_layanan = intval($_POST['id_layanan']);
    $berat = floatval($_POST['berat']);
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $status = $_POST['status'];

    // Ambil harga per KG dari layanan
    $res = $conn->query("SELECT harga_per_kg FROM layanan WHERE id_layanan=$id_layanan");
    $harga = $res->fetch_assoc()['harga_per_kg'];

    $total_harga = $harga * $berat;

    $sql = "INSERT INTO transaksi (id_pelanggan, id_layanan, tanggal_masuk, tanggal_selesai, berat, total_harga, status)
            VALUES ($id_pelanggan, $id_layanan, '$tanggal_masuk', '$tanggal_selesai', $berat, $total_harga, '$status')";

    if($conn->query($sql)){
        header("Location: ../public/transaksi.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
header("Location: ../public/transaksi.php");
?>
