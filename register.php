<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
$nama = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $konfirmasi = $_POST["konfirmasi"] ?? "";

    if ($nama === "" || $email === "" || $password === "" || $konfirmasi === "") {
        $error = "Semua kolom wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
    } elseif (strlen($password) < 8) {
        $error = "Password minimal 8 karakter.";
    } elseif ($password !== $konfirmasi) {
        $error = "Konfirmasi password tidak sama.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "Email sudah terdaftar. Silakan gunakan email lain.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $email, $hash]);
            header("Location: login.php?registered=1");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Web Alvi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <main class="auth-card">
        <a class="brand" href="login.php"><span class="brand-mark">A</span> web_alvi</a>
        <h1>Buat akun baru</h1>
        <p class="subtitle">Daftar untuk mulai menggunakan dashboard.</p>

        <?php if ($error !== ""): ?>
            <div class="alert error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label for="nama">Nama lengkap</label>
            <input id="nama" name="nama" type="text" maxlength="100"
                   value="<?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?>" placeholder="Masukkan nama lengkap" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email"
                   value="<?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>" placeholder="nama@email.com" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" minlength="8" placeholder="Minimal 8 karakter" required>

            <label for="konfirmasi">Konfirmasi password</label>
            <input id="konfirmasi" name="konfirmasi" type="password" minlength="8" placeholder="Ulangi password" required>

            <button class="btn btn-primary btn-full" type="submit">Daftar</button>
        </form>

        <p class="switch-auth">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </main>
</body>
</html>
