<form action="./partials/daftar_users_add_act.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ss">Nama Lengkap</label>
        <input type="text" required name="nama" class="form-control" id="ss" placeholder="Nama Lengkap...">
    </div>
    <div class="form-group">
        <label for="ps">Email</label>
        <input type="text" required name="email" class="form-control" id="ps" placeholder="Email...">
    </div>
    <div class="form-group">
        <label for="pb">Kota</label>
        <input type="text" required name="kota" class="form-control" id="pb" placeholder="Kota...">
    </div>
    <div class="form-group">
        <label for="kd">Kode Pos</label>
        <input type="number" required class="form-control" name="kode_pos" id="kd" placeholder="15879">
    </div>
    <div class="form-group">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter"
            required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" required name="role" id="role">
            <option value="">===PILIH ROLE===</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" required rows="5" cols="50" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</script>