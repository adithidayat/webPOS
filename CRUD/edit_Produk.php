<?php
include 'db.php';  
 
    $ID_Produk = $_POST['ID_Produk'];
    $nama_Produk = $_POST['Nm_Produk'];
    $harga = $_POST['Harga'];
    $stok = $_POST['stok'];
    $foto_tersembunyi=$_POST ['foto_cadangan'];
    $namaFile = $_FILES['foto']['name'];
    $namaSementara = $_FILES['foto']['tmp_name'];
    $lokasi_folder = "../foto/";

    $terupload = move_uploaded_file($namaSementara, $lokasi_folder . $namaFile);
    if ($terupload) {
        echo "Upload berhasil!<br/>";
        $lokasi = $lokasi_folder . $namaFile;
    } else {
        $lokasi = $foto_tersembunyi;    
    }
    $sql = "UPDATE tbl_produk SET Nm_Produk='$nama_Produk', Harga='$harga', Stok='$stok', Gambar_produk='$lokasi' WHERE ID_Produk='$ID_Produk'";

    if ($conn->query($sql) === TRUE) {
        header("Location: Produk.php");
        echo "<div class='alert alert-success'>Data berhasil diperbarui.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
?>
