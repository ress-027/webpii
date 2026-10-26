<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === "") {
        $error = "Email dan password wajib diisi.";
    } else {
        $stmt = $pdo->prepare("SELECT id, nama, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_nama"] = $user["nama"];
            $_SESSION["user_email"] = $user["email"];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Email atau password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Web Alvi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">
    <main class="auth-card">
        <a class="brand" href="login.php"><span class="brand-mark">A</span> web_alvi</a>
        <h1>Selamat datang</h1>
        <p class="subtitle">Masuk ke akun Anda untuk melanjutkan.</p>

        <?php if (isset($_GET["registered"])): ?>
            <div class="alert success">Registrasi berhasil. Silakan login.</div>
        <?php endif; ?>

        <?php if ($error !== ""): ?>
            <div class="alert error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label for="email">Email</label>
            <input id="email" name="email" type="email"
                   value="<?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>" placeholder="nama@email.com" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="Masukkan password" required>

            <button class="btn btn-primary btn-full" type="submit">Login</button>
        </form>

        <p class="switch-auth">Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
    </main>
</body>
</html>
