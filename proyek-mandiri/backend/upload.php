<?php
session_start();

if (!isset($_SESSION['username'])) {
    die("❌ Anda harus login terlebih dahulu.");
}

$username = $_SESSION['username'];

// Buat folder uploads/{username} jika belum ada
$baseUploadPath = realpath(__DIR__ . '/../uploads');
if ($baseUploadPath === false) {
    die("Folder utama uploads tidak ditemukan.");
}

$userUploadPath = $baseUploadPath . '/' . $username;
if (!file_exists($userUploadPath)) {
    mkdir($userUploadPath, 0777, true); // Buat folder user
}

// Pastikan folder dapat ditulisi
if (!is_writable($userUploadPath)) {
    die("Folder upload tidak bisa ditulisi.");
}

// Dapatkan ekstensi dan rename file
$extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
$newFileName = "Kartu-Rencana-Studi_Aktif." . $extension;
$targetFile = $userUploadPath . '/' . $newFileName;

// Upload file
if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    die("❌ Gagal mengupload file.");
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Berhasil</title>
    <style>
        body {
            font-family: "Poppins-Bold", Helvetica;
            background-color: #1d1d1d;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background-color: #1d1d1d;
            padding: 20px 30px;
            border-radius: 10px;
            color: #4ade80;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #6552fe;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #6552fe;
        }
    </style>
</head>
<body>
    <div class="message-box">File berhasil diupload dan disimpan sebagai <strong><?= htmlspecialchars($newFileName) ?></strong>.</div>
    <a href="../beranda/index.php" class="back-button">Kembali ke Jadwal</a>
</body>
</html>
