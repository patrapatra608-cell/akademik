<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Check if user is logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header('Location: login.php');
    exit;
}

// Get user email from session
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '';

// Get user data from database
require 'koneksi.php';

$query = "SELECT * FROM pengguna WHERE email = '$email'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $error = 'Data pengguna tidak ditemukan.';
}

// Handle form submission
$message = '';
$messageType = '';

if (isset($_POST['update_profil'])) {
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $passwordLama = isset($_POST['password_lama']) ? $_POST['password_lama'] : '';
    $passwordBaru = isset($_POST['password_baru']) ? $_POST['password_baru'] : '';
    $passwordKonfirm = isset($_POST['password_konfirm']) ? $_POST['password_konfirm'] : '';

    // Validasi nama
    if (empty($nama)) {
        $messageType = 'danger';
        $message = 'Nama tidak boleh kosong.';
    } elseif (strlen($nama) < 3) {
        $messageType = 'danger';
        $message = 'Nama minimal harus 3 karakter.';
    } elseif (strlen($nama) > 100) {
        $messageType = 'danger';
        $message = 'Nama maksimal 100 karakter.';
    } else {
        // If password change is requested
        if (!empty($passwordBaru)) {
            // Validasi password lama
            if (empty($passwordLama)) {
                $messageType = 'danger';
                $message = 'Masukkan password lama untuk mengubah password.';
            } elseif (md5($passwordLama) !== $user['password']) {
                $messageType = 'danger';
                $message = 'Password lama tidak sesuai.';
            } elseif (strlen($passwordBaru) < 6) {
                $messageType = 'danger';
                $message = 'Password baru minimal harus 6 karakter.';
            } elseif ($passwordBaru !== $passwordKonfirm) {
                $messageType = 'danger';
                $message = 'Konfirmasi password tidak sesuai.';
            } elseif ($passwordLama === $passwordBaru) {
                $messageType = 'danger';
                $message = 'Password baru tidak boleh sama dengan password lama.';
            } else {
                // Hash new password
                $hashedPassword = md5($passwordBaru);

                // Update nama dan password
                $updateQuery = "UPDATE pengguna SET nama_lengkap = '$nama', password = '$hashedPassword' WHERE email = '$email'";

                if ($koneksi->query($updateQuery)) {
                    $messageType = 'success';
                    $message = 'Profil berhasil diperbarui.';
                    // Refresh user data
                    $result = $koneksi->query($query);
                    $user = $result->fetch_assoc();
                } else {
                    $messageType = 'danger';
                    $message = 'Gagal memperbarui profil: ' . $koneksi->error;
                }
            }
        } else {
            // Update nama only (without password change)
            $updateQuery = "UPDATE pengguna SET nama_lengkap = '$nama' WHERE email = '$email'";

            if ($koneksi->query($updateQuery)) {
                $messageType = 'success';
                $message = 'Profil berhasil diperbarui.';
                // Refresh user data
                $result = $koneksi->query($query);
                $user = $result->fetch_assoc();
            } else {
                $messageType = 'danger';
                $message = 'Gagal memperbarui profil: ' . $koneksi->error;
            }
        }
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Profil Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <!-- Display messages -->
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php else: ?>
                            <form action="" method="POST">
                                <!-- Email (Read Only) -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-muted">(tidak dapat diubah)</span></label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>" disabled>
                                    <small class="form-text text-muted">Email Anda bersifat tetap dan tidak dapat diubah.</small>
                                </div>

                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo isset($user['nama_lengkap']) ? htmlspecialchars($user['nama_lengkap']) : ''; ?>" required minlength="3" maxlength="100">
                                    <small class="form-text text-muted">Nama minimal 3 karakter, maksimal 100 karakter.</small>
                                </div>

                                <!-- Password Lama -->
                                <div class="mb-3">
                                    <label for="password_lama" class="form-label">Password Lama</label>
                                    <input type="password" class="form-control" id="password_lama" name="password_lama">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                </div>

                                <!-- Password Baru -->
                                <div class="mb-3">
                                    <label for="password_baru" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="password_baru" name="password_baru" minlength="6">
                                    <small class="form-text text-muted">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</small>
                                </div>

                                <!-- Konfirmasi Password Baru -->
                                <div class="mb-3">
                                    <label for="password_konfirm" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="password_konfirm" name="password_konfirm" minlength="6">
                                    <small class="form-text text-muted">Harus sama dengan password baru.</small>
                                </div>

                                <!-- Buttons -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="index.php?page=home" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" name="update_profil" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>