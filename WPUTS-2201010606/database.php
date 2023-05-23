<?php
// menghubungkan dengan file koneksi.php

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'db_kampus';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Membuat database
$sql = "CREATE DATABASE IF NOT EXISTS db_kampus";
if (mysqli_query($mysqli, $sql)) {
    echo "Database berhasil dibuat";
    echo "<br>";
} else {
    echo "Database gagal dibuat: " . mysqli_error($mysqli);
    echo "<br>";
}

require_once('koneksi.php');
// Menggunakan database yang telah dibuat
mysqli_select_db($mysqli, "db_kampus");

// Membuat tabel
$sql = "CREATE TABLE IF NOT EXISTS tb_mahasiswa (
  nim CHAR(10) PRIMARY KEY,
  nama VARCHAR(100),
  jurusan VARCHAR(50),
  gender VARCHAR(100)
)";

if (mysqli_query($mysqli, $sql)) {
    echo "Tabel berhasil dibuat";
    echo "<br>";
} else {
    echo "Tabel gagal dibuat: " . mysqli_error($mysqli);
    echo "<br>";
}

// Menutup koneksi ke MySQL
mysqli_close($mysqli);
?>
