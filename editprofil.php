<?php
require 'koneksi.php';

// Cegah makhluk belum login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

// Ambil data user
$stmt = $koneksi->prepare("SELECT email, nama_lengkap FROM pengguna WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data user tidak ditemukan. Silakan login ulang.";
    exit;
}

$user = $result->fetch_assoc();

// Update profil
if (isset($_POST['update'])) {
    $email = trim($_POST['email']);
    $nama  = trim($_POST['nama_lengkap']);
    $password = $_POST['password'];

    // Kalau password diisi → update pakai password
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare(
            "UPDATE pengguna SET email=?, nama_lengkap=?, password=? WHERE id=?"
        );
        $stmt->bind_param("sssi", $email, $nama, $hash, $id);
    } else {
        // Kalau password kosong → aman, nggak diubah
        $stmt = $koneksi->prepare(
            "UPDATE pengguna SET email=?, nama_lengkap=? WHERE id=?"
        );
        $stmt->bind_param("ssi", $email, $nama, $id);
    }

    if ($stmt->execute()) {
        header("Location: profil.php?status=updated");
        exit;
    } else {
        $error = "Update gagal. Database lagi bad mood.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil</title>
</head>
<body>

<h2>Edit Profil</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post">

    <input type="email" name="email"
    value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>

    <input type="text" name="nama_lengkap"
    value="<?= htmlspecialchars($user['nama_lengkap'] ?? '') ?>" required>


    <button type="submit" name="update">Update Profil</button>
</form>

<a href="logout.php">Logout</a>

</body>
</html>
