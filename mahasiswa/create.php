<?php
    require __DIR__ . '/../koneksi.php';
    $prodi = $koneksi->query("SELECT * FROM prodi");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="POST" action="proses.php">
    <div class="container">
        <h3 class="mt-3">Tambah Data Mahasiswa</h3>

        <!-- Display error message jika ada -->
        <?php 
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['error_nim'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Error!</strong> <?php echo $_SESSION['error_nim']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error_nim']); ?>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_mhs" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgl_lahir" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-control" required>
                <option value="">-- Pilih Program Studi --</option>
                <?php while ($row = mysqli_fetch_assoc($prodi)) { ?>
                    <option value="<?= $row['id']; ?>">
                        <?= $row['nama_prodi']; ?> (<?= $row['jenjang']; ?>)
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="index.php?page=home" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>