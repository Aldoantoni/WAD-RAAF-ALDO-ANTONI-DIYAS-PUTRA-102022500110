<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id = $_POST['id'] ?? '';
    $kode = trim($_POST['kode']);
    $jenis = $_POST['jenis'];
    $merek = trim($_POST['merek']);
    $kapasitas = $_POST['kapasitas'];
    $status = $_POST['status'];

    if (!empty($id)) {
        // Update data jika ada ID
        $sql = "UPDATE mesin SET kode = ?, jenis = ?, merek = ?, kapasitas = ?, status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$kode, $jenis, $merek, $kapasitas, $status, $id]);
    } else {
        // Insert data baru ke database
        $sql = "INSERT INTO mesin (kode, jenis, merek, kapasitas, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$kode, $jenis, $merek, $kapasitas, $status]);
    }
    
    header("Location: index.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $sql = "delete FROM mesin WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_hapus]);

    header("Location: index.php");
    exit;
}
?>