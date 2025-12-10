<?php
include '../config.php';
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM layanan WHERE id_layanan=$id");
}
header("Location: ../public/packages.php");