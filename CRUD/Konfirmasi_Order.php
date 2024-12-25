<?php
session_start();
include 'db.php';

// Cek apakah session id_user ada
if (!isset($_SESSION['login_user'])) {
    echo "Anda harus login terlebih dahulu.";
    exit();
}

// Jika tidak ada produk dalam keranjang
if (!isset($_SESSION['pemesanan']) || empty($_SESSION['pemesanan'])) {
    echo "Keranjang Anda kosong. Silakan pesan produk terlebih dahulu.";
    exit();
}

// Proses pemesanan saat tombol 'Selesaikan Pemesanan' ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari session dan form
    $total_harga = $_SESSION['total_harga'];
    $tanggal_pemesanan = date('Y-m-d H:i:s');
    $id_user = $_SESSION['Id_User'];  // ID User yang login
    $status_pemesanan = 'Proses'; // Status awal adalah Proses
    $metode_pengambilan = $_POST['metode_pengambilan']; // Ambil metode pengambilan dari form

    // Membuat query untuk memasukkan data pemesanan tanpa ID_Pemesanan, karena ID otomatis
    $sql_pemesanan = "INSERT INTO tbl_pemesanan (Tanggal_Pemesanan, Total_harga, Status_Pemesanan, Metode_pengambilan, Id_User) 
                      VALUES ('$tanggal_pemesanan', $total_harga, '$status_pemesanan', '$metode_pengambilan', '$id_user')";

    if ($conn->query($sql_pemesanan) === TRUE) {
        // Ambil ID Pemesanan yang baru saja dibuat oleh database
        $id_pemesanan = $conn->insert_id;  // Ambil ID Pemesanan yang baru dibuat (Auto Increment)

        // Simpan ID Pemesanan dalam session untuk digunakan pada halaman berikutnya
        $_SESSION['id_pemesanan'] = $id_pemesanan;

        // Redirect ke halaman detail pemesanan
        header("Location: proses_detail.php");
        exit();
    } else {
        echo "Gagal memproses pemesanan.";
    }
}

// Hapus produk dari keranjang
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    
    // Cari produk dalam session dan hapus produk yang sesuai
    foreach ($_SESSION['pemesanan'] as $key => $item) {
        if ($item['id_produk'] == $id_hapus) {
            unset($_SESSION['pemesanan'][$key]);
            break;
        }
    }

    // Reindex array untuk memastikan indeks keranjang berurutan
    $_SESSION['pemesanan'] = array_values($_SESSION['pemesanan']);
    
    // Redirect untuk memperbarui tampilan
    header("Location: konfirmasi_order.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Konfirmasi Pemesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">



<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top" style="height:80px;">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand" href="#">
            <img src="../foto/logo2.png" alt="Logo" style="height: 50px; margin-left : 200px"> 
        </a>
        
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">  
        <div class="d-flex align-items-center">
            <!-- Search Bar -->
            <li class="input-group-icon pe-2 ">
                <i class="fas fa-search input-box-icon text-primary"></i>
                <input class="form-control border-0 input-box bg-100 bg-light" type="search" placeholder="Search Food" aria-label="Search" />
            </li>

            <?php
                // Jika session login_user ada, artinya pengguna sudah login
                if (!isset($_SESSION['login_user'])):
            ?>
                <li class="nav-item">
                    <button class="btn btn-outline-light btn-primary" style="margin-right: 10px; width : 120px  " onclick="window.location.href='login.php'">
                        Login
                    </button>
                </li>
            <?php else: ?>
                <!-- Jika sudah login, tampilkan menu Logout -->
                <li class="nav-item">
                    <button class="btn btn-primary" style="margin-right: 10px;" onclick="window.location.href='logout.php'">
                        Logout
                    </button>
                </li>
            <?php endif; ?>
        </div>

        </ul>
      </div>
    </div>
  </nav>

<div class="container py-4">
    <div class="row">
        <!-- Bagian Kiri -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Menu Item</h5>
                </div>
                <div class="card-body">
                    <!-- Rincian Pesanan -->
                    <div class="card-body">
    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($_SESSION['pemesanan'] as $item) {
                                    echo "<tr>
                                            <!-- Kolom Item (Gambar dan Nama Produk) -->
                                            <td class='d-flex align-items-center'>
                                                <img src='" . htmlspecialchars($item['gambar']) . "' alt='" . htmlspecialchars($item['nm_produk']) . "' class='img-thumbnail me-3' style='width: 80px; height: 80px; object-fit: cover;'>
                                                <span>" . htmlspecialchars($item['nm_produk']) . "</span>
                                            </td>
                                            
                                            <!-- Kolom Kuantitas -->
                                            <td class='text-center'>
                                                <div class='input-group'>
                                                    <button class='btn btn-outline-secondary'>-</button>
                                                    <input type='text' class='form-control text-center' value='" . $item['jumlah'] . "' style='width: 50px;' readonly>
                                                    <button class='btn btn-outline-secondary'>+</button>
                                                </div>
                                            </td>

                                            <!-- Kolom Subtotal -->
                                            <td class='text-center'>
                                                <h6 class='mb-0'>Rp " . number_format($item['subtotal'], 2, ',', '.') . "</h6>
                                            </td>

                                            <!-- Kolom Aksi (Hapus) -->
                                            <td class='text-center'>
                                                <a href='konfirmasi_order.php?hapus=" . $item['id_produk'] . "' class='btn btn-danger btn-sm'>Hapus</a>
                                            </td>
                                        </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>


                  
                <a href="produkjual.php" class="btn btn-primary">Pilih Produk Lain</a>

                </div>
            </div>

            <!-- Tambah Catatan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tambahkan Catatan</h5>
                </div>
                <div class="card-body">
                    <textarea class="form-control" id="notes" rows="2" placeholder="Tambahkan catatan untuk pesanan Anda..."></textarea>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Order Subtotal*</h5>
                    <h4 class="mb-4">Rp <?php echo number_format($_SESSION['total_harga'], 2, ',', '.'); ?></h4>
                    <small class="text-muted d-block mb-4">*Harga dapat berubah tergantung lokasi pengantaran.</small>

                    <!-- Form untuk memilih metode pengambilan -->
                    <form method="POST">
                        <div class="mb-3">
                            <label for="metode_pengambilan" class="form-label">Metode Pengambilan</label>
                            <select class="form-select" id="metode_pengambilan" name="metode_pengambilan" required>
                                <option value="Ditempat">Ditempat</option>
                                <option value="DiAntar">DiAntar</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Selesaikan Pemesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
