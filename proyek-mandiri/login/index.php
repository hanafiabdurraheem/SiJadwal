<?php
session_start();

if (!empty($_SESSION['message'])) {
    echo '<div style="color: green; background: #e0ffe0; padding: 10px; margin: 10px 20px; border-radius: 5px;">' .
         htmlspecialchars($_SESSION['message']) .
         '</div>';
    unset($_SESSION['message']); // Hapus setelah ditampilkan sekali
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            header("Location: ../beranda/index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
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

          <div class="text-wrapper">Username</div>
          <input type="text" name="username" class="user" placeholder="Username" required>

          <div class="text-wrapper-2">Password</div>
          <input type="password" name="password" class="password" placeholder="Password" required>

          <button type="submit" class="text-wrapper-3">Login</button>
        </div>
      </form>
    <button type="submit" class="text-wrapper-3"></button>
      <?php if (!empty($error)) : ?>
        <div class="error-message" style="color: red; text-align: center; margin-top: 10px;">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <div class="text-wrapper-4">Selamat Datang</div>
      <div class="text-wrapper-5">Silahkan login!</div>
      <div class="signup-wrapper">
        <span class="text-wrapper-6">Belum punya akun? </span>
        <a href="../index.php" class="sign-up">Sign Up</a>
      </div>


    </div>


  </div>
</body>
</html>
