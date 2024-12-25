<?php
include 'db.php'; 


if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "DELETE FROM tb_mahasiswa WHERE nim='$nim'";

    if ($conn->query($sql) === TRUE) {
        header("Location: mahasiswa.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "NIM tidak ditemukan.";
}

$conn->close();
?>
