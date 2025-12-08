<?php 
    require 'koneksi.php';

    //insert
    if (isset($_POST['submit'])) {
        $nim = $_POST['nim'];
        $nama_mhs = $_POST['nama_mhs'];
        $tgl_lahir= $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];

        $query = "INSERT INTO mahasiswa (nim,  nama_mhs, tgl_lahir, alamat) VALUES ('$nim', '$nama_mhs','$tgl_lahir', '$alamat')";
        $sql = $koneksi->query($query);

        if ($sql){
        header('Location: index.php');
        } else {
            echo "Gagal simpan data";
        }
    }

    
    //delete
    if (isset($_GET['nim'])) {
        $nim = $_GET['nim'];
        $query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
        $sql = $koneksi->query($query);
        if ($sql) {
            header("Location: index.php");
            exit();
        } else {
            echo "Gagal menghapus data: ";
        }
    }
    
    if (isset($_POST['update'])) {

        $nim_lama = $_POST['nim_lama'];  // dipakai di WHERE
        $nim = $_POST['nim'];
        $nama_mhs = $_POST['nama_mhs'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];

        $query = "UPDATE mahasiswa SET 
            nim='$nim',
            nama_mhs='$nama_mhs',
            tgl_lahir='$tgl_lahir',
            alamat='$alamat'
            WHERE nim='$nim_lama'";

        $sql = mysqli_query($koneksi, $query);

        if ($sql) {
            header("Location: index.php");
            exit();
        } else {
            echo "Gagal update: " . mysqli_error($koneksi);
        }
    }


?>