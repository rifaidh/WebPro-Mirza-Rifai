<?php
include '../config.php';

if(isset($_POST['id_transaksi'], $_POST['status'])){
    $id = intval($_POST['id_transaksi']);
    $status = $_POST['status'] === 'Selesai' ? 'Selesai' : 'Proses';

    $conn->query("UPDATE transaksi SET status='$status' WHERE id_transaksi=$id");
}
?>
