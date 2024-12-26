<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

$total = 0;
if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $produk) {
        $total += $produk['harga'] * $produk['jumlah'];
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = $_SESSION['message_type'];
    unset($_SESSION['message']); // Hapus pesan setelah ditampilkan

    // Menampilkan alert berdasarkan tipe pesan
    echo "<script type='text/javascript'>
            alert('$message');
          </script>";
}
?>

<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- loader-->
  <link href="../ltr/assets/css/pace.min.css" rel="stylesheet" />
  <script src="../ltr/assets/js/pace.min.js"></script>

  <!--plugins-->
  <link href="../ltr/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="../ltr/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="../ltr/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="../ltr/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../ltr/assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="../ltr/assets/css/style.css" rel="stylesheet">
  <link href="../ltr/assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!--Theme Styles-->
  <link href="../ltr/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="../ltr/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="../ltr/assets/css/header-colors.css" rel="stylesheet" />

  <title>Dashkote - Bootstrap5 Admin Template</title>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">

  <?php
    include 'sidebar.php';
    include 'header.php';
?>


    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
      <!-- start page content-->
      <div class="page-content">

       
        <section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Keranjang Penjualan</h3>
                <br>
            
                <div class="alert alert-success d-none">
                    <p>Edit Data Berhasil!</p>
                </div>
                <div class="alert alert-danger d-none">
                    <p>Hapus Data Berhasil!</p>
                </div>

              


                <!-- Sales Cart Section -->
                
                          <div class="row">
                              <!-- Kolom kiri untuk form pencarian -->
                              <div class="col-md-4">
                                  <div class="card border-primary">
                                      <div class="card-header bg-primary text-white">
                                          <h4><i class="fa fa-search"></i> Cari Barang</h4>
                                      </div>
                                      <div class="card-body">
                                          <input type="text" id="cari" class="form-control" name="cari" placeholder="Masukkan : Kode / Nama Barang">
                                      </div>
                                  </div>
                              </div>

                              <!-- Kolom kanan untuk hasil pencarian -->
                              <div class="col-md-8">
                                  <div class="card border-primary">
                                      <div class="card-header bg-primary text-white">
                                          <h4><i class="fa fa-list"></i> Hasil Pencarian</h4>
                                      </div>
                                      <div class="card-body">
                                          <div id="hasil_cari"></div>
                                          <div id="tunggu" style="display:none;">Menunggu hasil...</div>
                                      </div>
                                  </div>
                              </div>
                          </div>
         


                <div class="col-sm-12">
                    <div class="card border-primary ">
                        <div class="card-header bg-primary text-white" style="height: 90px;">
                            <h4><i class="fa fa-shopping-cart"></i> KASIR
                                <a class="btn btn-danger float-end" href="jual.php?remove_from_cart=all">
                                    <b>RESET KERANJANG</b>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div id="keranjang">
                            <table class="table table-bordered">
                                    <tr>
                                        <td><b>Tanggal</b></td>
                                        <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date('d F Y, H:i'); ?>" name="tgl"></td>
                                    </tr>
                                </table>

                                <!-- Cart Items Table -->
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Barang</td>
                                            <td style="width:10%;">Jumlah</td>
                                            <td style="width:20%;">Total</td>
                                            <td>Aksi</td>
                                          
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <?php
                                            // Cek apakah ada produk di keranjang
                                            if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) {
                                                $no = 1;
                                                $total = 0;
                                                foreach ($_SESSION['keranjang'] as $id => $produk) {
                                                    $total += $produk['harga'] * $produk['jumlah'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $produk['nm_produk']; ?></td>
                                                    <td>
                                                        <form action="jual.php" method="POST" class="d-flex align-items-center">
                                                            <input type="number" name="jumlah" value="<?php echo $produk['jumlah']; ?>" min="1" style="width: 60px;" class="form-control form-control-sm">
                                                            <input type="hidden" name="id_produk" value="<?php echo $id; ?>">
                                                            
                                                       
                                                    </td>
                                                    <td>Rp. <?php echo number_format($produk['harga'] * $produk['jumlah'], 0, ',', '.'); ?></td>
                                                    <td>
                                                    <button type="submit" name="update_keranjang" class="btn btn-warning btn-sm ml-2">Update</button>
                                                        <a href="jual.php?remove_from_cart=1&id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                                    </td>
                                                    </form>
                                                </tr>
                                            <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="5">Keranjang kosong</td></tr>';
                                            }
                                            if (isset($_SESSION['message'])) {
                                                echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
                                                unset($_SESSION['message']);
                                                unset($_SESSION['message_type']);
                                            }
                                            ?>
                                    </tbody>
                                </table>

                                <br/>

                                <!-- Total Amount Section -->
                                <form method="POST" action="jual.php">
                                    <table class="table table-stripped">
                                        <tr>
                                            <td>Total Semua</td>
                                            <td>
                                                <input type="text" class="form-control" name="total" 
                                                value="<?php echo isset($total) ? number_format($total, 0, ',', '.') : (isset($_SESSION['total']) ? number_format($_SESSION['total'], 0, ',', '.') : '0'); ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pembeli</td>
                                            <td>
                                                <input type="text" class="form-control" name="NamaPembeli" 
                                                value="<?php echo isset($_SESSION['NamaPembeli']) ? $_SESSION['NamaPembeli'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bayar</td>
                                            <td><input type="text" class="form-control" name="bayar"
                                            value="<?php echo isset($_SESSION['uang']) ? $_SESSION['uang'] : ''; ?>"
                                            ></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-success">Bayar</button>
                                                <!-- Cek apakah keranjang tidak kosong sebelum menampilkan tombol RESET -->
                                                <?php if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0): ?>
                                                    <a class="btn btn-danger" href="jual.php?remove_from_cart=all">
                                                        <b>RESET</b>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </form>



                                <!-- Change & Print Section -->
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Kembali</td>
                                        <td><input type="text" class="form-control" value="<?php 
                                                echo  number_format($_SESSION['kembali'], 0, ',', '.');
                                            ?>" readonly></td>
                                        <td></td>
                                        <td>
                                            <a href="print_url" target="_blank">
                                            <button class="btn btn-default bg-primary text-white">
                                              <i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
                                            </button></a>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</section>


    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

  </div>
  <!--end wrapper-->


  <!-- JS Files-->
  <script src="../ltr/assets/js/jquery.min.js"></script>
  <script src="../ltr/assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="../ltr/assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="../ltr/assets/js/bootstrap.bundle.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <!--plugins-->
  <script src="../ltr/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="../ltr/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
  <script src="../ltr/assets/plugins/chartjs/chart.min.js"></script>
  <script src="../ltr/assets/js/index.js"></script>
  <!-- Main JS-->
  <script src="../ltr/assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script >
    $(document).ready(function(){
        // Menangani perubahan pada input pencarian
        $("#cari").change(function(){
            var keyword = $(this).val(); // Ambil nilai dari input pencarian
            if(keyword != '') {  // Pastikan input tidak kosong
                $.ajax({
                    type: "GET", // Menggunakan metode GET
                    url: "cari.php", // URL file PHP untuk menangani pencarian
                    data: { cari: "yes", keyword: keyword }, // Kirim data pencarian
                    beforeSend: function() {
                        // Menampilkan pesan "Menunggu hasil..." sebelum melakukan pencarian
                        $("#hasil_cari").hide();
                        $("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>').show();
                    },
                    success: function(html) {
                        // Setelah data berhasil diterima, sembunyikan pesan dan tampilkan hasilnya
                        $("#tunggu").hide();
                        $("#hasil_cari").show();
                        $("#hasil_cari").html(html); // Menampilkan hasil pencarian
                    }
                });
            } else {
                // Jika input kosong, sembunyikan hasil pencarian
                $("#hasil_cari").html('');
                $("#tunggu").hide();
            }
        });

      
    });
  </script>

</body>

</html>