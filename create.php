<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div>
        <form action="proses.php" method="post">
        <h1 style="color: #ffff; text-align: center;">Input data mahasiswa</h1>
        <div class="mb-3">
            <label for="nim" class="form-label" style="color: #ffff;">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" placeholder="123456789">
        </div>
        <div class="mb-3">
            <label for="nama_mhs" class="form-label" style="color: #ffff;">Nama</label>
            <input type="text" class="form-control" id="nama_mhs" name="nama_mhs">
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label" style="color: #ffff;">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label" style="color: #ffff;">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>