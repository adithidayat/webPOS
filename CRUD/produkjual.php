<?php
include 'db.php';

$sql = "SELECT * FROM tbl_produk";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Mulai session untuk cek login status
session_start();

// Cek apakah user sudah login
$is_logged_in = isset($_SESSION['login_user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

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



  <div class="container mt-5">
    <div class="text-left display-6">
      Menu Kami
    </div>
    <div class="row">
      <?php
      foreach ($products as $product) {
          // Cek status login dan atur URL Order Now
          $order_url = $is_logged_in ? "order.php?id=" . $product['ID_Produk'] : "login.php";

          echo '
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3">
              <div class="card" style="width: 100%; height: 100%;">
                  <img src="' . $product['Gambar_Produk'] . '" class="card-img-top" alt="' . $product['Nm_Produk'] . '" style="height: 200px; object-fit: cover;">
                  <div class="card-body d-flex flex-column p-2">
                      <h5 class="card-title" style="font-size: 1.1rem;">' . $product['Nm_Produk'] . '</h5>
                      <p class="card-text" style="font-size: 0.9rem;">Harga: Rp ' . number_format($product['Harga'], 2, ',', '.') . '</p>
                      <a href="' . $order_url . '" class="btn btn-primary btn-sm ms-auto mt-auto">Order Now</a>
                  </div>
              </div>
          </div>
          ';
      }
      ?>
    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 Bubur Ayam Pak Adit. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <script src="../UAS/dist/js/adminlte.js"></script>
</body>
</html>
