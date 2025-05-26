<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "userdb");
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
    // Buat folder user
    $userFolder = __DIR__ . "/../uploads/$username";
    if (!is_dir($userFolder)) {
        mkdir($userFolder, 0777, true);
    }

    // Buat file tugas.csv default
    $tugasCsvPath = $userFolder . "/tugas.csv";
    $tugasAwal = [
        ["Judul", "Deadline", "Keterangan"],
        ["Contoh Tugas", "2025-06-01", "Ini hanya contoh."]
    ];
    $fp = fopen($tugasCsvPath, "w");
    foreach ($tugasAwal as $baris) {
        fputcsv($fp, $baris);
    }
    fclose($fp);

    // Simpan pesan dan redirect ke index.php
    $_SESSION['message'] = "✅ Registrasi berhasil. Folder dan file tugas.csv telah dibuat.";
    header("Location: index.php");
    exit;
}

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>Login</title>
  <link rel="stylesheet" href="global.css" />
  <link rel="stylesheet" href="styleguide.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="login">
    <div class="div">
      <form method="POST" action="">
        <div class="overlap-group">
          <div class="kotak-utama"></div>
          <div class="kotak-usernam"></div>
          <div class="kotak-pass"></div>
          <div class="button-login"></div>

          <div class="text-wrapper">Username Baru</div>
          <input type="text" name="username" class="user" placeholder="Username" required>

          <div class="text-wrapper-2">Password Baru</div>
          <input type="password" name="password" class="password" placeholder="Password" required>

          <button type="submit" class="text-wrapper-3">Sign Up</button>
        </div>
      </form>

      <?php if (!empty($error)) : ?>
        <div class="error-message" style="color: red; text-align: center; margin-top: 10px;">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <div class="text-wrapper-4">Form Registrasi</div>
      <div class="text-wrapper-5">Silahkan Daftar!</div>
      <div class="text-wrapper-6">Sudah punya akun?</div>
      <div class="signup">
        <a href="index.php" class="sign-up">Login</a>
      </div>
    </div>
        
  </div>
</body>
</html>
