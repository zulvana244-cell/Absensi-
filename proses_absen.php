<?php
require_once 'koneksi.php';

if (!isset($_SESSION['user_login']) || $_SESSION['user_login']['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_login'];
$tanggal_hari_ini = date('Y-m-d');
$waktu_sekarang = date('H:i:s');
$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'masuk') {
    // Cek apakah sudah absen hari ini
    $sudah_absen = false;
    foreach ($_SESSION['absen'] as $absen) {
        if ($absen['user_id'] == $user['id'] && $absen['tanggal'] == $tanggal_hari_ini) {
            $sudah_absen = true;
            break;
        }
    }

    if (!$sudah_absen) {
        $_SESSION['absen'][] = [
            'id' => uniqid(),
            'user_id' => $user['id'],
            'nama' => $user['nama'],
            'tanggal' => $tanggal_hari_ini,
            'jam_masuk' => $waktu_sekarang,
            'jam_keluar' => '-',
            'status' => 'Hadir'
        ];
    }
} elseif ($aksi === 'keluar') {
    foreach ($_SESSION['absen'] as &$absen) {
        if ($absen['user_id'] == $user['id'] && $absen['tanggal'] == $tanggal_hari_ini && $absen['jam_keluar'] === '-') {
            $absen['jam_keluar'] = $waktu_sekarang;
            break;
        }
    }
}

header("Location: dashboard_user.php");
exit;
