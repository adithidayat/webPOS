<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menambahkan produk ke dalam session
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Ambil informasi produk dari database
    $sql = "SELECT * FROM tbl_produk WHERE ID_Produk = '$id_produk'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Produk tidak ditemukan.");
    }

    $subtotal = $product['Harga'] * $jumlah;

    // Inisialisasi session pemesanan jika belum ada
    if (!isset($_SESSION['pemesanan'])) {
        $_SESSION['pemesanan'] = [];
    }

    // Cek apakah produk sudah ada di dalam keranjang
    $found = false;
    $_SESSION['pemesanan'] = array_map(function($item) use ($id_produk, $jumlah, $subtotal, $product, &$found) {
        if ($item['id_produk'] == $id_produk) {
            // Jika produk ada, hanya tambahkan jumlahnya dan update subtotal
            $item['jumlah'] += $jumlah;
            $item['subtotal'] = $item['jumlah'] * $item['harga']; // Update subtotal
            $found = true;
        }
        return $item; // Kembalikan item yang sudah dimodifikasi atau yang belum dimodifikasi
    }, $_SESSION['pemesanan']);

    // Jika produk belum ada di dalam keranjang, tambah produk baru ke dalam session
    if (!$found) {
        $_SESSION['pemesanan'][] = [
            'id_produk' => $product['ID_Produk'],
            'nm_produk' => $product['Nm_Produk'],
            'harga' => $product['Harga'],
            'gambar' => $product['Gambar_Produk'],
            'jumlah' => $jumlah,
            'subtotal' => $subtotal
        ];
    }

    // Hitung total harga
    $_SESSION['total_harga'] = 0;
    foreach ($_SESSION['pemesanan'] as $item) {
        $_SESSION['total_harga'] += $item['subtotal'];
    }

    // Debugging: tampilkan isi session untuk memastikan semuanya benar
    echo "<pre>";
    print_r($_SESSION['pemesanan']);
    echo "</pre>";

    // Redirect ke halaman konfirmasi
    header("Location: Konfirmasi_Order.php");
    exit();
}

$id_produk = $_GET['id'];
$sql = "SELECT * FROM tbl_produk WHERE ID_Produk = '$id_produk'";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pemesanan Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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

  <div class="container text-center" style="width: 650px; height :200px">
    <h1 class="mb-4">Pemesanan Produk</h1>
    
    <!-- Card for product information and ordering -->
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <!-- Gambar produk -->
          <img src="<?php echo $product['Gambar_Produk']; ?>" class="img-fluid rounded-start" alt="<?php echo $product['Nm_Produk']; ?>" style="height: 200px; object-fit: cover;">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $product['Nm_Produk']; ?></h5>
            <p class="card-text">Harga: Rp <?php echo number_format($product['Harga'], 2, ',', '.'); ?></p>
           
            <!-- Form untuk memilih jumlah produk -->
            <form method="POST">
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah:</label>
                <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control" required>
              </div>
              <input type="hidden" name="id_produk" value="<?php echo $product['ID_Produk']; ?>">
              <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <a href="produkjual.php" class="btn btn-secondary">Pilih Produk Lain</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
