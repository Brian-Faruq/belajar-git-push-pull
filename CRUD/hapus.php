<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // --- DELETE: Hapus Data ---
    $stmt = $pdo->prepare("DELETE FROM tugas WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>