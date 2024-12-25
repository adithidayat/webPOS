<?php
include 'db.php';   
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_bahan = $_POST['nama_bahan'];
    $jumlah_stok = $_POST['jumlah_stok'];
    $satuan = $_POST['satuan'];
    $harga_per_satuan = $_POST['harga_per_satuan'];
    $id_supplier = $_POST['id_supplier'];   

   
    $sql = "INSERT INTO tbl_bahanbaku (Nama_Bahan, Jumlah_Stok, Satuan, Harga_per_Satuan, ID_Suplier) 
            VALUES ('$nama_bahan', '$jumlah_stok', '$satuan', '$harga_per_satuan', '$id_supplier')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data bahan baku berhasil ditambahkan!'); window.location.href = 'bahanbaku.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan bahan baku!'); window.location.href = 'form_input_bahan_baku.php';</script>";
    }
}
?>
