<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow" style="width: 22rem;">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Login</h4>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>

            <?php
                require 'koneksi.php';
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                    $pass = md5($_POST['password']);

                    $ceklogin = "SELECT * FROM pengguna WHERE email=? AND password=?";
                    $stmt = $koneksi->prepare($ceklogin);
                    $stmt->bind_param("ss", $email, $pass);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $data = $result->fetch_assoc();
                        session_start();
                        $_SESSION['login'] = true;
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['id'] = $data['id'];
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger mt-3 text-center'>Login gagal</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>

</body>
</html>
