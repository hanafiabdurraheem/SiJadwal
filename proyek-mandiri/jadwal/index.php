<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'] ?? '';

$files = glob("uploads/$username/*.json"); // atau *.txt sesuai tipe file
foreach ($files as $file) {
    $data = file_get_contents($file);
    // Proses file sesuai kebutuhan kamu
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="tambah-kurang-jadwal">
      <div class="div">
        <div class="text-wrapper">Tambah/Kurang</div>
        
        
<div class="frame">
  <form id="uploadForm" action="../backend/upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload" required style="display: none;" />
    
    <label for="fileToUpload" class="button" style="cursor: pointer; display: inline-block;">
      Upload CSV
    </label>
  </form>
</div>

<script>
  // Ketika file dipilih, otomatis kirim form
  document.getElementById("fileToUpload").addEventListener("change", function () {
    document.getElementById("uploadForm").submit();
  });
</script>



        

    <div class="overlap-group">
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Path folder upload relatif terhadap file ini
        $username = $_SESSION['username'] ?? '';
        $uploadDir = __DIR__ . "/../uploads/$username";

        $files = array_diff(scandir($uploadDir), array('.', '..'));
        

       if (!empty($files)): ?>
    <table class="file-table">

        <?php foreach ($files as $file): ?>
            <tr>
                <td><?php echo htmlspecialchars($file); ?></td>
                <td>
                    <a class="file-link" href="<?php echo "../uploads/$username/" . urlencode($file); ?>" target="_blank">Lihat/Unduh</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Tidak ada file yang ditemukan.</p>
<?php endif; ?>
    </div>

    <div class="text-wrapper-4">Jadwal anda</div>
    <img class="line" src="../img/line.png" />
    <?php include '../nav.php'; ?>

</body>
</html>
