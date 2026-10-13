<?php
require_once 'koneksi.php';
if (!isset($_SESSION['user_login']) || $_SESSION['user_login']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
$admin = $_SESSION['user_login'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Panel Admin Absensi</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small">Halo, Admin (<?= htmlspecialchars($admin['nama']) ?>)</span>
                <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">Rekapitulasi Kehadiran Karyawan</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (empty($_SESSION['absen'])):
                            ?>
                                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data absensi yang masuk.</td></tr>
                            <?php 
                            else:
                                $no = 1;
                                foreach ($_SESSION['absen'] as $row):
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['jam_masuk'] ?></td>
                                    <td><?= $row['jam_keluar'] ?></td>
                                    <td><span class="badge bg-success"><?= $row['status'] ?></span></td>
                                </tr>
                            <?php 
                                endforeach;
                            endif; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
