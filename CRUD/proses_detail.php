<?php
session_start();
include 'db.php';

// Cek apakah ID_Pemesanan ada dalam session
if (!isset($_SESSION['id_pemesanan'])) {
    echo "<script>alert('ID Pemesanan tidak ditemukan.'); window.location.href='dashboard.php';</script>";
    exit();
}

// Cek apakah session id_user ada
if (!isset($_SESSION['login_user'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location.href='login.php';</script>";
    exit();
}

// Jika tidak ada produk dalam keranjang
if (!isset($_SESSION['pemesanan']) || empty($_SESSION['pemesanan'])) {
    echo "<script>alert('Keranjang Anda kosong. Silakan pesan produk terlebih dahulu.'); window.location.href='dashboard.php';</script>";
    exit();
}

$id_pemesanan = $_SESSION['id_pemesanan'];

// Menambahkan data ke dalam tabel detail_pemesanan
foreach ($_SESSION['pemesanan'] as $item) {
    $id_produk = $item['id_produk'];
    $jumlah = $item['jumlah'];
    $harga_satuan = $item['harga'];  // Harga satuan produk
    $subtotal = $item['subtotal'];  // Hitung subtotal

    // Menambahkan data ke dalam tabel detail_pemesanan
    $sql_detail = "INSERT INTO detail_pemesanan (ID_Pemesanan, ID_Produk, Jumlah, Harga_Satuan, Subtotal) 
                   VALUES ('$id_pemesanan', '$id_produk', $jumlah, $harga_satuan, $subtotal)";
    if (!$conn->query($sql_detail)) {
        echo "<script>alert('Gagal memasukkan data ke detail pemesanan: " . $conn->error . "'); window.location.href='dashboard.php';</script>";
        exit();
    }
}

// Setelah berhasil menyimpan, hapus session pemesanan
unset($_SESSION['pemesanan']);
unset($_SESSION['total_harga']);
unset($_SESSION['id_pemesanan']);

// Menampilkan pesan sukses dan mengarahkan ke halaman terima kasih
echo "<script>alert('Pemesanan berhasil! Terima kasih telah memesan produk kami.'); window.location.href='dashboard.php';</script>";
exit();
?>
