<?php
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data tugas berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM tugas WHERE id = ?");
$stmt->execute([$id]);
$tugas = $stmt->fetch(PDO::FETCH_ASSOC);

// --- UPDATE: Simpan Perubahan ---
if (isset($_POST['update'])) {
    $nama_tugas = $_POST['nama_tugas'];
    $status     = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tugas SET nama_tugas = ?, status = ? WHERE id = ?");
    $stmt->execute([$nama_tugas, $status, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Tugas</h2>
        <form method="POST">
            <label>Nama Tugas:</label>
            <input type="text" name="nama_tugas" value="<?= htmlspecialchars($tugas['nama_tugas']); ?>" required>
            
            <label>Status:</label>
            <select name="status">
                <option value="Belum Selesai" <?= $tugas['status'] == 'Belum Selesai' ? 'selected' : ''; ?>>Belum Selesai</option>
                <option value="Selesai" <?= $tugas['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
            </select>

            <button type="submit" name="update">Simpan Perubahan</button>
            <a href="index.php" class="btn-batal">Batal</a>
        </form>
    </div>
</body>
</html>