<?php

$servername = "localhost";
$database = "pwd_2441919004";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Koneksi Gagal: ". mysqli_connect_error());
}

echo "Koneksi Berhasil";
mysqli_close($conn);

?>