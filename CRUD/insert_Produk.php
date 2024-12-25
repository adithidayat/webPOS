<?php
include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangani data dari form
    $nama_Produk = $_POST['nama'];
    $harga = $_POST['Harga'];
    $stok = $_POST['stok'];
    
    // Menangani file upload
    $namaFile = $_FILES['foto']['name'];
    $namaSementara = $_FILES['foto']['tmp_name'];
    $lokasi_folder = "../foto/";

    // Pastikan folder tujuan dapat diakses dan siap untuk menerima file
    $terupload = move_uploaded_file($namaSementara, $lokasi_folder . $namaFile);
    if ($terupload) {
        $lokasi = $lokasi_folder . $namaFile; // Set lokasi gambar yang sudah di-upload
    } else {
        echo "Upload Gagal!";
        $lokasi = ''; // Jika gagal upload, set lokasi menjadi kosong
    }

    // Menyimpan data produk ke database
    $sql = "INSERT INTO tbl_produk (ID_Produk, Nm_Produk, Harga, Stok, Gambar_Produk) VALUES ('','$nama_Produk', '$harga', '$stok', '$lokasi')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
        header("Location: produk.php");
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Produk</title>
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../ltr/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../ltr/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../ltr/assets/css/style.css" rel="stylesheet">
    <link href="../ltr/assets/css/icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Form Input Produk</h1>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Masukkan Data Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="insert_Produk.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="Harga">Harga:</label>
                                <input type="number" id="Harga" name="Harga" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok:</label>
                                <input type="number" id="stok" name="stok" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto :</label>
                                <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a href="mahasiswa.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../UAS/dist/js/adminlte.js"></script>
</body>
</html>

<?php
$conn->close();
?>
