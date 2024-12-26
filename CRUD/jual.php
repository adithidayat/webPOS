<?php
session_start();
include 'db.php';


if (isset($_POST['update_keranjang'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah_baru = $_POST['jumlah'];

    
    // Ambil stok produk dari database
    $query = "SELECT Stok FROM tbl_produk WHERE ID_Produk = '$id_produk'";
    $result = $conn->query($query);
    
    // Jika produk ditemukan
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stok_produk = $row['Stok'];

        // Cek jika jumlah baru tidak melebihi stok
        if ($jumlah_baru <= $stok_produk && $jumlah_baru > 0 && isset($_SESSION['keranjang'][$id_produk])) {
            $_SESSION['keranjang'][$id_produk]['jumlah'] = $jumlah_baru;  // Update jumlah produk
            $_SESSION['message'] = "Jumlah produk berhasil diperbarui!";
            $_SESSION['message_type'] = "success";
        } elseif ($jumlah_baru > $stok_produk) {
            $_SESSION['message'] = "Jumlah produk melebihi stok yang tersedia!";
            $_SESSION['message_type'] = "danger";
        } else {
            $_SESSION['message'] = "Jumlah produk tidak valid!";
            $_SESSION['message_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Produk tidak ditemukan!";
        $_SESSION['message_type'] = "danger";
    }

    // Tutup koneksi
    $conn->close();

    // Redirect untuk menghindari pengiriman form yang sama
    header("Location: transaksi.php");
    exit;
}

if (isset($_GET['add_to_cart']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);
    
    // Query untuk mendapatkan informasi produk
    $sql = "SELECT * FROM tbl_produk WHERE ID_Produk = '$id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $produk = mysqli_fetch_assoc($result);
        
        // Cek apakah produk sudah ada di keranjang
        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id]['jumlah'] += 1;  // Menambah jumlah produk
        } else {
            $_SESSION['keranjang'][$id] = [
                'nm_produk' => $produk['Nm_Produk'],
                'harga' => $produk['Harga'],
                'jumlah' => 1,
                'gambar' => $produk['Gambar_Produk']
            ];
        }
    }
    
    // Redirect kembali ke halaman utama
    header("Location: transaksi.php");
    exit;
}

 

 
if (isset($_GET['remove_from_cart']) && $_GET['remove_from_cart'] == 'all') {
    // Hapus seluruh produk dari keranjang
    unset($_SESSION['keranjang']);
    
    // Redirect kembali ke halaman transaksi setelah reset
    header("Location: transaksi.php");
    exit;
}

if (isset($_POST['bayar'])) {
    $bayar = $_POST['bayar'];
    $total = 0;

    // Hitung total harga keranjang
    foreach ($_SESSION['keranjang'] as $produk) {
        $total += $produk['harga'] * $produk['jumlah'];
    }

    $_SESSION['uang'] = $bayar;
    // Simpan total ke session
    $_SESSION['total'] = $total;

    $kembali = $bayar - $total;

    // Simpan kembali ke session
    $_SESSION['kembali'] = $kembali;

    // Simpan nama pembeli ke session
    $_SESSION['NamaPembeli'] = $_POST['NamaPembeli'];

    if ($kembali >= 0) {
        $_SESSION['message'] = "Pembayaran Berhasil! Kembalian: Rp. " . number_format($kembali, 0, ',', '.');
        $_SESSION['message_type'] = "success";
        // Hapus keranjang setelah transaksi selesai
        
    } else {
        $_SESSION['message'] = "Uang yang dibayar tidak cukup!";
        $_SESSION['message_type'] = "danger";
    }

    // Redirect ke transaksi.php untuk menampilkan hasil pembayaran
    header("Location: transaksi.php");
    exit;
}

?>
