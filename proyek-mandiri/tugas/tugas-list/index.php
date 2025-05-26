<!DOCTYPE html>
<html>
  
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />

        <style> 
            /* Terapkan warna latar gelap ke seluruh halaman */
            html, body {
                background-color: #1d1d1d !important;
                color: white;
                margin: 0;
                padding: 0;
                font-family: Helvetica, sans-serif;
            }

            /* Jika kamu menggunakan kontainer utama */
            .container {
            background-color: #1d1d1d;
            padding: 20px;
            min-height: 100vh;
            }

            /* Tabel tetap konsisten */
            table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            background-color: #1d1d1d;
            border-radius: 12px;
            overflow: hidden;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            }

            tr {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px) brightness(100%);
            background-blend-mode: multiply;
            }


            /* Header tabel */
            th {
            background-color: rgba(79, 70, 229, 0.6); /* opsional, semi-transparan */
            background-image: url(../../img/gradien.png);
            background-position: center;
            color: white;
            padding: 12px 15px;
            text-align: left;
            }

            /* Isi tabel */
            td {
            padding: 12px 15px;
            border-top: 1px solid #2e2e2e;
            background-color: #1d1d1d;
            color: white;
            }

            /* Hover efek */
            tr:hover td {
            background-color: #2e2e2e;
            }

            /* Tombol kembali */
            .tambah-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.2s ease;
            }

            .kembali-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background-color:rgb(255, 255, 255);
            color: #1d1d1d;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.2s ease;
            }

            .kembali-button:hover {
            background-color:rgb(192, 192, 192);
            }

            .tambah-button:hover {
            background-color: #4338ca;
            }

            /* Tombol selesai */
            .selesai-button {
            background-color: #e11d48;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            }

            .selesai-button:hover {
            background-color: #be123c;
            }

            .table-wrapper {
              width: 100%;
              overflow-x: auto;
            }

            table {
              width: 100%;
              max-width: 480px;
              margin: 0 auto; /* supaya center */
            }

            .header-aksi {
  position: relative;
  top: 60px;   /* atur sesuai kebutuhan */
  left: 40px;  /* geser dari sisi kiri */
  display: flex;
  flex-direction: column;
  gap: 12px;
  align-items: left;
  z-index: 100;
}
        </style>


  </head>

  <body>
    <div class="table-wrapper">
    <?php include '../../backend/bacacsv-tugas.php'; 
    ?>
    </div>

        <a href="../../beranda/index.php" class="kembali-button">← Kembali</a>
        <a href="../../tugas/index.php" class="tambah-button">+ Tambah</a>
    
    
  </body>
</html>
