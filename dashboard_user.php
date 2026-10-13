<?php
require_once 'koneksi.php';
if (!isset($_SESSION['user_login']) || $_SESSION['user_login']['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user_login'];
$tanggal_hari_ini = date('Y-m-d');

// Cek status absen hari ini
$absen_hari_ini = null;
foreach ($_SESSION['absen'] as $absen) {
    if ($absen['user_id'] == $user['id'] && $absen['tanggal'] == $tanggal_hari_ini) {
        $absen_hari_ini = $absen;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Portal Karyawan</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small">Halo, <?= htmlspecialchars($user['nama']) ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body text-center p-4">
                        <h4 class="fw-bold mb-1">Absensi Harian</h4>
                        <p class="text-muted small"><?= date('l, d F Y') ?></p>
                        
                        <div class="my-4">
                            <?php if (!$absen_hari_ini): ?>
                                <p class="text-danger fw-semibold">Anda belum melakukan absensi masuk hari ini.</p>
                                <a href="proses_absen.php?aksi=masuk" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">Absen Masuk</a>
                            <?php elseif ($absen_hari_ini['jam_keluar'] === '-'): ?>
                                <p class="text-success fw-semibold">Absen Masuk tercatat pukul: <?= $absen_hari_ini['jam_masuk'] ?></p>
                                <a href="proses_absen.php?aksi=keluar" class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm">Absen Keluar</a>
                            <?php else: ?>
                                <div class="alert alert-info mb-0">
                                    Absensi hari ini telah selesai.<br>
                                    Masuk: <b><?= $absen_hari_ini['jam_masuk'] ?></b> | Keluar: <b><?= $absen_hari_ini['jam_keluar'] ?></b>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Riwayat Absensi Anda</h5>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle small">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $ada_riwayat = false;
                                    foreach ($_SESSION['absen'] as $absen): 
                                        if ($absen['user_id'] == $user['id']):
                                            $ada_riwayat = true;
                                    ?>
                                        <tr>
                                            <td><?= $absen['tanggal'] ?></td>
                                            <td><?= $absen['jam_masuk'] ?></td>
                                            <td><?= $absen['jam_keluar'] ?></td>
                                            <td><span class="badge bg-success"><?= $absen['status'] ?></span></td>
                                        </tr>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    if (!$ada_riwayat):
                                    ?>
                                        <tr><td colspan="4" class="text-center text-muted">Belum ada riwayat absensi.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
