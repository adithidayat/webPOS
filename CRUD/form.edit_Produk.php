<?php
include 'db.php'; 
$a = $_GET['ID_Produk'];
$data = mysqli_query($conn, "SELECT * FROM tbl_produk where ID_Produk ='$a' ");
$hasil = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="container" style="max-width: 800px;"> 
                <h1 class="mt-4">Edit Data Produk</h1>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Perbarui Data Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="edit_Produk.php?" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="ID_Produk">ID Produk:</label>
                                <input type="text" id="ID_Produk" name="ID_Produk" class="form-control" value="<?php echo $hasil['ID_Produk']; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="Nm_Produk">Nama Produk:</label>
                                <input type="text" id="Nm_Produk" name="Nm_Produk" class="form-control" value="<?php echo $hasil['Nm_Produk']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="Harga">Harga:</label>
                                <textarea id="Harga" name="Harga" class="form-control" required><?php echo $hasil['Harga']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok:</label>
                                <input type="text" id="stok" name="stok" class="form-control" value="<?php echo $hasil['Stok']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto Produk</label>
                                <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                                <input type="hidden" name="foto_cadangan" value="<?php echo $hasil['Gambar_Produk'];?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="produk.php" class="btn btn-secondary">Kembali</a>
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
