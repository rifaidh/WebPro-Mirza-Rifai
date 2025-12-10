<?php
include '../config.php';
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM pelanggan WHERE id_pelanggan=$id");
}
header("Location: ../public/pelanggan.php");