<?php
include 'db.php';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../ltr/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../ltr/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../ltr/assets/css/style.css" rel="stylesheet">
    <link href="../ltr/assets/css/icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Tambah Supplier</h3>
    
        <!-- Kontainer kecil dengan border -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 border border-primary p-4 rounded"> <!-- Menggunakan border dan padding -->
                <!-- Form Input Supplier -->
                <form action="insert_suplier.php" method="POST">
                  
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier:</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat:</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon:</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="suplier.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
