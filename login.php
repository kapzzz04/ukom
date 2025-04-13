<?php
session_start();
include 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass  = mysqli_real_escape_string($con, $_POST['pass']);

    // Cek apakah email ada dulu
    $check_email = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or die('Query gagal');

    if (mysqli_num_rows($check_email) > 0) {
        // Email ditemukan, cek password
        $user = mysqli_fetch_assoc($check_email);

        if ($pass === $user['password']) {
            // Login sukses
            $_SESSION['name_user']   = $user['name'];
            $_SESSION['email_user']  = $user['email'];
            $_SESSION['alamat_user'] = $user['alamat'];
            $_SESSION['user_id']     = $user['id'];
            $_SESSION['role']     = $user['role'];


            echo '<script>alert("Login Sukses!"); window.location="./index.php";</script>';
        } else {
            // Password salah
            echo '<script>alert("Password salah!"); window.location="./login.php";</script>';
        }
    } else {
        // Email tidak terdaftar
        echo '<script>alert("Email belum terdaftar!"); window.location="./login.php";</script>';
    }
}


?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        max-width: 400px;
        margin-top: 50px;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h3 {
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-primary {
        width: 100%;
        font-weight: bold;
    }

    p.text-center a {
        text-decoration: none;
        font-weight: bold;
    }

    p.text-center a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h3>Masuk</h3>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="pass" required />
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" />
                <label class="form-check-label" for="rememberMe">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
        <p class="text-center mt-2">
            Belum punya akun? <a href="daftar.php">Daftar</a>
        </p>
    </div>
</body>

</html>