<?php
session_start();
include 'db.php';

if (!empty($_GET['cari']) && isset($_GET['keyword'])) {
    $keyword = trim(strip_tags($_GET['keyword'])); // Mengambil input pencarian dan membersihkan

    if ($keyword != '') {
        // Query pencarian tanpa join kategori
        $sql = "SELECT * FROM tbl_produk
                WHERE id_produk LIKE '%$keyword%' 
                   OR nm_produk LIKE '%$keyword%' 
                   OR harga LIKE '%$keyword%' 
                   OR stok LIKE '%$keyword%' 
                   OR gambar_produk LIKE '%$keyword%'";

        // Eksekusi query
        $result = $conn->query($sql);

        // Cek jika ada hasil
        if ($result->num_rows > 0) {
            // Menampilkan hasil pencarian dalam tabel
            echo '<table class="table table-stripped" width="100%" id="example2">';
            echo '<tr>';
            echo '<th>ID Produk</th>';
            echo '<th>Nama Produk</th>';
            echo '<th>Harga</th>';
            echo '<th>Stok</th>';
            echo '<th>Gambar Produk</th>';
            echo '<th>Aksi</th>';
            echo '</tr>';

            // Loop untuk menampilkan hasil pencarian
            while ($row = $result->fetch_assoc()) {
              
                echo '<tr>';
                echo '<td>' . $row['ID_Produk'] . '</td>';
                echo '<td>' . $row['Nm_Produk'] . '</td>';
                echo '<td>' . $row['Harga'] . '</td>';
                echo '<td>' . $row['Stok'] . '</td>';
                echo '<td>'; 
                if ($row['Gambar_Produk']) {
                    echo '<img src="'. $row['Gambar_Produk'] . '" alt="Gambar Produk" width="50" />';
                } else {
                    echo 'No Image';
                }
                echo '</td>';
                echo '<td>';
                // Pastikan $_SESSION ada dan valid
                if (isset($_SESSION['login_user'])) {
                    echo '<a href="jual.php?add_to_cart=true&id=' . $row['ID_Produk'] . '" class="btn btn-success">';
                    echo '<i class="fa fa-shopping-cart"></i>';
                    echo '</a>';
                } else {
                    echo 'ID Kasir tidak ditemukan';
                }
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Produk tidak ditemukan.';
        }
    }
}
?>
