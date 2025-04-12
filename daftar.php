<?php
require './koneksi.php';


$success = "";
$error = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = mysqli_real_escape_string($con, $_POST['name']);
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
        echo '<script>alert("Email atau nama sudah terdaftar"); window.location.href = "./daftar.php";</script>';
        exit;
    } else {
        $query = "INSERT INTO users (name, email, alamat, kota, kode_pos, password, role)
                  VALUES ('$name', '$email', '$alamat', '$kota', '$kode_pos', '$password', '$role')";

        if (mysqli_query($con, $query)) {
            $success = "Pendaftaran berhasil! Silakan login.";

            exit;
        } else {
            $error = "Gagal mendaftar: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(to right, #e0f2f1, #ffffff);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
    }

    .btn-primary {
        border-radius: 10px;
        font-weight: 600;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="card mx-auto" style="max-width: 550px;">
            <h3 class="text-center mb-4">Buat Akun Baru</h3>

            <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama lengkap..."
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email aktif..."
                        required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="2" placeholder="Alamat lengkap..."
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" name="kota" id="kota" class="form-control" placeholder="Contoh: Surabaya"
                        required>
                </div>

                <div class="mb-3">
                    <label for="kode_pos" class="form-label">Kode Pos</label>
                    <input type="text" name="kode_pos" id="kode_pos" class="form-control"
                        placeholder="Kode pos wilayah..." required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Minimal 6 karakter" required>
                </div>

                <input type="hidden" name="role" value="user">

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                </div>
            </form>
            <p class="text-center mt-2">
                Sudah punya akun? <a href="login.php">Masuk</a>
            </p>
        </div>
    </div>

</body>

</html>