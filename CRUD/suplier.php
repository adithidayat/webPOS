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

        <!--start breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
          <div class="breadcrumb-title pe-3">Dashboard</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                    <ion-icon name="home-outline"></ion-icon>
                  </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">eCommerce</li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <button type="button" class="btn btn-outline-primary">Settings</button>
              <button type="button"
                class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                  href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
              </div>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->

        <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Supplier</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="display: flex; align-items: center;">
                        <!-- Button Tambah Data -->
                        <button type="button" class="btn btn-danger" style="margin-right: 10px;" onclick="window.location.href='form_insert_Suplier.php'">
                            Tambah Supplier
                        </button>
                        <!-- Search Input -->
                        <input type="text" name="table_search" class="form-control" placeholder="Search" style="width: 150px;">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db.php';

                        // Query untuk mengambil data supplier
                        $sql = 'SELECT * FROM tbl_supplier';
                        $a = mysqli_query($conn, $sql);

                        // Menampilkan data supplier
                        while ($hasil = mysqli_fetch_array($a)) {
                            echo "<tr>
                                    <td>" . $hasil['ID_Supplier'] . "</td>
                                    <td>" . $hasil['Nama_Supplier'] . "</td>
                                    <td>" . $hasil['Alamat'] . "</td>
                                    <td>" . $hasil['No_Telepon'] . "</td>
                                    <td>
                                        <button class='btn btn-warning' onclick=\"window.location.href='form.edit_Supplier.php?ID_Supplier=" . $hasil['ID_Supplier'] . "'\">Edit</button>
                                        <button class='btn btn-danger' onclick=\"if(confirm('Apakah Anda yakin ingin menghapus data ini?')) { window.location.href='hapus_Supplier.php?ID_Supplier=" . $hasil['ID_Supplier'] . "'; }\">Hapus</button>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
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


</body>

</html>