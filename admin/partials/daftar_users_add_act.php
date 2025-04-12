<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = mysqli_real_escape_string($con, $_POST['nama']);
    $email    = mysqli_real_escape_string($con, $_POST['email']);
    $alamat   = mysqli_real_escape_string($con, $_POST['alamat']);
    $kota     = mysqli_real_escape_string($con, $_POST['kota']);
    $kode_pos = mysqli_real_escape_string($con, $_POST['kode_pos']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $role     = mysqli_real_escape_string($con, $_POST['role']);

    // Cek email
    $cek_email = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
    // Cek nama
    $cek_nama = mysqli_query($con, "SELECT * FROM users WHERE name = '$name'");

    if (mysqli_num_rows($cek_email) > 0 || mysqli_num_rows($cek_nama) > 0) {
        echo '<script>alert("Email atau nama sudah terdaftar"); window.location.href = "../daftar_users.php";</script>';
        exit;
    } else {
        $query = "INSERT INTO users (name, email, alamat, kota, kode_pos, password, role)
                  VALUES ('$name', '$email', '$alamat', '$kota', '$kode_pos', '$password', '$role')";

        if (mysqli_query($con, $query)) {
            echo '<script>alert("Tambah User berhasil"); window.location.href = "../daftar_users.php";</script>';
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>