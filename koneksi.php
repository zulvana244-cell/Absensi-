<?php
session_start();

// Inisialisasi Data Akun Default jika belum ada
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'username' => 'admin', 'password' => 'admin123', 'nama' => 'Administrator', 'role' => 'admin'],
        ['id' => 2, 'username' => 'budi', 'password' => 'user123', 'nama' => 'Budi Santoso', 'role' => 'user'],
        ['id' => 3, 'username' => 'siti', 'password' => 'user123', 'nama' => 'Siti Aminah', 'role' => 'user'],
    ];
}

// Inisialisasi Data Absensi
if (!isset($_SESSION['absen'])) {
    $_SESSION['absen'] = [];
}
?>
