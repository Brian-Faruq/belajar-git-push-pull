<?php
include 'koneksi.php';

// --- CREATE: Tambah Data Baru ---
if (isset($_POST['tambah'])) {
    $nama_tugas = $_POST['nama_tugas'];
    if (!empty($nama_tugas)) {
        $stmt = $pdo->prepare("INSERT INTO tugas (nama_tugas) VALUES (?)");
        $stmt->execute([$nama_tugas]);
        header("Location: index.php");
        exit;
    }
}

// --- READ: Ambil Semua Data ---
$stmt = $pdo->query("SELECT * FROM tugas ORDER BY id DESC");
$daftar_tugas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Sederhana PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Tugas Saya</h2>

        <!-- Form Tambah Data (Create) -->
        <form method="POST" class="form-tambah">
            <input type="text" name="nama_tugas" placeholder="Tulis tugas baru..." required>
            <button type="submit" name="tambah">Tambah</button>
        </form>

        <!-- Tabel Tampil Data (Read) -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($daftar_tugas as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_tugas']); ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <!-- Tombol Edit (Update) dan Hapus (Delete) -->
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>