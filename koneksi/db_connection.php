<?php

$host = 'localhost';
$nama_database = 'kedai_kopi';
$user = 'root';
$pass = '';

// Koneksi
$conn = new mysqli($host, $user, $pass, $nama_database);

// Cek koneksi
if ($conn->connect_error) {
    if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
        echo 'Koneksi gagal: ' . $conn->connect_error;
    }

}

$conn->set_charset('utf8mb4');

if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    echo 'Koneksi berhasil';
}
