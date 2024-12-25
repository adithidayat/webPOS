<?php
include 'db.php';  

if (isset($_GET['ID_Produk'])) {
    $ID_Produk = $_GET['ID_Produk'];
    $sql = "DELETE FROM tbl_produk WHERE ID_Produk='$ID_Produk'";

    if ($conn->query($sql) === TRUE) {
        header("Location: produk.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID Produk tidak ditemukan.";
}

$conn->close();
?>
