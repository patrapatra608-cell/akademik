<?php
require 'koneksi.php';

$nim = $_GET['nim'];  // <-- ambil id dari URL

// ambil data berdasarkan id
$tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_assoc($tampil);

// ambil data prodi
$prodi = $koneksi->query("SELECT * FROM prodi");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">
    <h3>Edit Data Mahasiswa</h3>

    <form method="POST" action="proses.php">

        <!-- simpan NIM lama -->
        <input type="hidden" name="nim_lama" value="<?= $data['nim']; ?>">

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= $data['nim']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_mhs" class="form-control" value="<?= $data['nama_mhs']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-control" required>
                <option value="">-- Pilih Program Studi --</option>
                <?php while ($row = $prodi->fetch_assoc()) { ?>
                    <option value="<?= $row['id']; ?>"
                        <?= ($row['id'] == $data['prodi_id']) ? 'selected' : ''; ?>>
                        <?= $row['nama_prodi']; ?> (<?= $row['jenjang']; ?>)
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php?page=mahasiswa" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
