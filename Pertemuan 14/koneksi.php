<?php
$koneksi = mysqli_connect("localhost","root","","manajemen_login");
// Check connection
if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>