<?php
include 'db.php';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../ltr/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../ltr/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../ltr/assets/css/style.css" rel="stylesheet">
    <link href="../ltr/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Tambah Produk</h3>
        
        <!-- Kontainer kecil untuk form dengan border menggunakan Bootstrap -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 border border-primary p-4 rounded shadow-sm"> <!-- Menggunakan border, padding, rounded, dan shadow untuk tampilan lebih rapi -->
                <!-- Form Input Produk -->
                <form action="insert_bahanbaku.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk:</label>
                        <input type="text" name="nama_bahan" id="nama_bahan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok:</label>
                        <input type="number" name="jumlah_stok" id="jumlah_stok" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan:</label>
                        <input type="text" name="satuan" id="satuan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga:</label>
                        <input type="number" name="harga_per_satuan" id="harga_per_satuan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Pilih Supplier:</label>
                        <select name="id_supplier" id="id_supplier" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php
                            // Query untuk mengambil data supplier
                            $sql_supplier = "SELECT * FROM tbl_supplier";
                            $result_supplier = mysqli_query($conn, $sql_supplier);

                            // Menampilkan supplier dalam dropdown
                            while ($supplier = mysqli_fetch_array($result_supplier)) {
                                echo "<option value='" . $supplier['ID_Supplier'] . "'>" . $supplier['Nama_Supplier'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="produk.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-GLhlTQ8iRAB+KqtxK6cyZfR6IAGFtWQX3RX4oI3ujjlO5oypR91B5YwtWf3i7ue6p" crossorigin="anonymous"></script>
</body>
</html>
