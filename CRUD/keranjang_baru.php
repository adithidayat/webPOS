<?php
session_start();

// Menampilkan produk yang ada di keranjang
if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) {
    $no = 1;
    $total = 0;
    foreach ($_SESSION['keranjang'] as $id => $produk) {
        $total += $produk['harga'] * $produk['jumlah'];
        echo '<tr>';
        echo '<td>' . $no++ . '</td>';
        echo '<td>' . $produk['nm_produk'] . '</td>';
        
        // Membuat input untuk jumlah produk dan tombol Update di sampingnya
        echo '<td>
                <form action="jual.php" method="POST" class="d-flex align-items-center">
                    <input type="number" name="jumlah" value="' . $produk['jumlah'] . '" min="1" style="width: 60px;" class="form-control form-control-sm">
                    <input type="hidden" name="id_produk" value="' . $id . '">
                    <button type="submit" name="update_keranjang" class="btn btn-warning btn-sm ml-2">Update</button>
                </form>
              </td>';

        echo '<td>Rp. ' . number_format($produk['harga'] * $produk['jumlah'], 0, ',', '.') . '</td>';
        echo '<td>
                <a href="jual.php?remove_from_cart=1&id=' . $id . '" class="btn btn-danger btn-sm">Hapus</a>
              </td>';
        echo '</tr>';
    }
   
} else {
    echo '<tr><td colspan="5">Keranjang kosong</td></tr>';
}
?>
