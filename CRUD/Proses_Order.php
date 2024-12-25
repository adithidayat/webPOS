<?php
session_start();

// Cek jika tidak ada pemesanan di session
if (!isset($_SESSION['pemesanan'])) {
    header("Location: index.php"); // Jika tidak ada pemesanan, arahkan ke halaman utama
    exit();
}

// Proses pemesanan, misalnya menyimpan ke database
// Di sini bisa Anda tambahkan kode untuk menyimpan data pemesanan ke dalam database

// Mengosongkan session pemesanan setelah proses selesai
unset($_SESSION['pemesanan']);
unset($_SESSION['total_harga']);

// Arahkan ke halaman terima kasih atau halaman lain setelah pemesanan selesai
header("Location: terimakasih.php");
exit();
