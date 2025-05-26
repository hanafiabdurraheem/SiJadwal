<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
  
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="detailed/global.css" />
    <link rel="stylesheet" href="detailed/styleguide.css" />
    <link rel="stylesheet" href="detailed/style.css">
  </head>


  <body>
    <div class="jadwal-kuliah">
      <div class="div">
      <span class="text-wrapper">Hey, <?php echo htmlspecialchars($username); ?></span>
      <span class="waktu">
        <?php
          setlocale(LC_TIME, 'id_ID');
          date_default_timezone_set('Asia/Jakarta');
          echo strftime('%A, %d %B');
        ?>
      </span>
      
        
          <div class="overlap" style="cursor: pointer;" onclick="openModal()">


              <div class="kotak-upcoming"></div>
              <div class="text-wrapper-2">Upcoming schedule</div>
              <div class="text-wrapper-3">
  <?php
    ob_start();
    include '../backend/upcoming.php';
    $output = ob_get_clean();

    // Misalnya ambil hanya satu baris data pertama dari tabel (tanpa tag HTML)
    // Contoh: hapus semua tag HTML dan ambil isi
    $plainText = strip_tags($output);
    echo htmlspecialchars($plainText); // atau echo langsung jika aman
  ?>
</div>


            </div>
          </a>


      <style>

/* Wrapper tabel jika diperlukan */
.tabel-di-tengah-rata-kiri {
  position: absolute;
  top: 360px;
  left: 25px;
  width: 383px;
  max-height: 90vh;
  overflow-y: auto;
  background-color: #1d1d1d;
  border-radius: 12px;
  box-sizing: border-box;
}

/* Tabel umum */
.tabel-di-tengah-rata-kiri table {
  width: 100%;
  border-collapse: collapse;
  background-color: #1d1d1d;
  color: white;
  font-family: Helvetica, sans-serif;
}

.tabel-di-tengah-rata-kiri thead tr {
  background-image: url("/../proyek-mandiri/img/mesh-gradient-1.png");
  background-color: #6552fe;
  background-size: cover;
  background-position: center;
  background-blend-mode: overlay;
}

.tabel-di-tengah-rata-kiri th {
  color: white;
  text-align: left;
  padding: 10px 12px;
  font-weight: bold;
  font-size: 14px;
  border-bottom: 1px solid #4b42d1;
  /* Hapus background-color atau background-image di sini */
}


/* Isi baris */
.tabel-di-tengah-rata-kiri td {
  padding: 10px 12px;
  border-top: 1px solid #333333;
  font-size: 14px;
}

/* Hover efek */
.tabel-di-tengah-rata-kiri tr:hover td {
  background-color: #2e2e2e;
}

h2 {
  color: white;
  font-family: Helvetica, sans-serif;
}
       </style>

        <div class="tabel-di-tengah-rata-kiri">
  <?php include '../backend/jadwal-hari-ini.php'; ?>
</div>



        <img class="user"/>
        <div class="frame">
          <form action="../tugas/tugas-list/index.php" method="GET" style="all: unset;">
            <button type="submit" style="all: unset; cursor: pointer;">
              <div class="group">
                <div class="overlap-group">
                  <div class="rectangle"></div>
                  <div class="rectangle-2"></div>
                  <div class="interface-edit-grid"></div>
                  <div class="interface-setting"><img class="img"/></div>
                </div>
              </div>
            </button>
          </form>
        </div>       

      
    
      <!-- Modal HTML -->
      <div id="popupOverlay" 
      style="display:none; 
        position:fixed; 
        top:0; 
        left:0; 
        width:60px;         
        height:40px;        
        background:transparentns; 
        z-index:999;">
      </div>

      <div id="popupModal" 
      style="display:none; 
      position:fixed; 
      top:50%; 
      left:50%; 
        transform:translate(-50%, -50%); 
        background:white; 
        padding:20px; 
        max-width:383px; 
        max-height:100%;
        border-radius: 12px;
        overflow:auto; 
        z-index:1000;">
        <div id="modalContent">Memuat...</div>
        
      </div>



    <script>
  document.addEventListener("DOMContentLoaded", function () {
    window.openModal = function () {
      document.getElementById('popupOverlay').style.display = 'block';
      document.getElementById('popupModal').style.display = 'block';

      fetch('detailed/index.php') 
        .then(response => response.text())
        .then(html => {
          document.getElementById('modalContent').innerHTML = html;
        })
        .catch(err => {
          document.getElementById('modalContent').innerHTML = 'Gagal memuat konten.';
          console.error(err);
        });
    };

    window.closeModal = function () {
      document.getElementById('popupOverlay').style.display = 'none';
      document.getElementById('popupModal').style.display = 'none';
    };
  });
</script>


      </div>
      <?php include '../nav.php'; ?>
    </div>
  </body>
</html>
