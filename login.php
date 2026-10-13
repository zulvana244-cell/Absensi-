<?php
require_once 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    foreach ($_SESSION['users'] as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user_login'] = $user;
            if ($user['role'] === 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            exit;
        }
    }
    $error = "Username atau Password salah!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">Sistem Absensi</h3>
                            <p class="text-muted small">Silakan masuk menggunakan akun Anda</p>
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger py-2 small" role="alert"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold">Masuk</button>
                        </form>
                        
                        <div class="mt-4 text-center text-muted small">
                            <p class="mb-1">Akun Demo:</p>
                            <span>Admin: <code>admin</code> / <code>admin123</code></span><br>
                            <span>User: <code>budi</code> / <code>user123</code></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
