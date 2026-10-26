<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION["user_nama"] ?? "Pengguna";
$email = $_SESSION["user_email"] ?? "";
$inisial = strtoupper(substr($nama, 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Web Alvi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dashboard-page">
    <aside class="sidebar">
        <a class="brand sidebar-brand" href="dashboard.php"><span class="brand-mark">A</span> web_alvi</a>
        <p class="nav-heading">MENU UTAMA</p>
        <a class="nav-link active" href="dashboard.php"><span>▦</span> Dashboard</a>
        <a class="nav-link" href="dashboard.php"><span>◉</span> Profil Saya</a>
        <div class="sidebar-bottom">
            <div class="sidebar-user">
                <div class="avatar"><?= htmlspecialchars($inisial, ENT_QUOTES, "UTF-8") ?></div>
                <div class="user-text">
                    <strong><?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?></strong>
                    <small>Pengguna</small>
                </div>
            </div>
            <a class="nav-link logout-link" href="logout.php">↪ Logout</a>
        </div>
    </aside>

    <main class="dashboard-main">
        <header class="topbar">
            <div>
                <span class="eyebrow">HALAMAN UTAMA</span>
                <h1>Dashboard</h1>
            </div>
            <div class="topbar-profile">
                <div class="avatar"><?= htmlspecialchars($inisial, ENT_QUOTES, "UTF-8") ?></div>
                <span><?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?></span>
            </div>
        </header>

        <section class="welcome-panel">
            <div>
                <p class="welcome-label">DASHBOARD WEB ALVI</p>
                <h2>Halo, <?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?>! 👋</h2>
                <p>Anda berhasil login. Selamat datang di halaman dashboard Anda.</p>
            </div>
            <div class="welcome-icon"></div>
        </section>

        <section class="stats-grid">
            <article class="stat-card">
                <div class="stat-icon purple">♙</div>
                <p>Status akun</p>
                <h3>Aktif</h3>
                <span class="stat-note">Akun berhasil login</span>
            </article>
            <article class="stat-card">
                <div class="stat-icon blue">✉</div>
                <p>Email terdaftar</p>
                <h3 class="email-value"><?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?></h3>
                <span class="stat-note">Email akun Anda</span>
            </article>
            <article class="stat-card">
                <div class="stat-icon green">✓</div>
                <p>Keamanan</p>
                <h3>Terlindungi</h3>
                <span class="stat-note">Password disimpan dalam hash</span>
            </article>
        </section>

        <section class="content-card">
            <div class="section-title">
                <div>
                    <h2>Informasi akun</h2>
                    <p>Ringkasan akun yang sedang digunakan.</p>
                </div>
                <span class="status-pill">● Login aktif</span>
            </div>
            <div class="info-row">
                <span>Nama lengkap</span>
                <strong><?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?></strong>
            </div>
            <div class="info-row">
                <span>Email</span>
                <strong><?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?></strong>
            </div>
            <div class="info-row">
                <span>Status sesi</span>
                <strong>Sudah login</strong>
            </div>
            <a class="btn btn-outline" href="logout.php">Logout dari akun</a>
        </section>

        <footer class="dashboard-footer">© <?= date("Y") ?> web_alvi. Dibuat dengan PHP Native dan CSS.</footer>
    </main>
</body>
</html>
