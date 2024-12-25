<?php
include 'db.php';   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    // Query untuk memasukkan data ke dalam tabel tbl_supplier
    $sql = "INSERT INTO tbl_supplier (Nama_Supplier, Alamat, No_Telepon) 
            VALUES ('$nama_supplier', '$alamat', '$no_telepon')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data supplier berhasil ditambahkan!'); window.location.href = 'supplier.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan supplier!'); window.location.href = 'form_input_supplier.php';</script>";
    }
}
?>
