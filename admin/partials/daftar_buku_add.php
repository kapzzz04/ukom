<form action="./partials/daftar_buku_add_act.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="ss">Judul Buku</label>
        <input type="text" required name="Judul_Buku" class="form-control" id="ss" placeholder="Judul Buku">
    </div>
    <div class="form-group">
        <label for="ps">Penulis</label>
        <input type="text" required name="Penulis" class="form-control" id="ps" placeholder="Penulis">
    </div>
    <div class="form-group">
        <label for="pb">Publisher</label>
        <input type="text" required name="Publisher" class="form-control" id="pb" placeholder="Publisher">
    </div>
    <div class="form-group">
        <label for="th">Tentukan Harga</label>
        <input type="number" required name="price" class="form-control" id="th"
            placeholder="Tentukan harga dalam rupiah ( 100000)">
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select class="form-control" required name="kategori" id="kategori">
            <option value="">===PILIH KATEGORI===</option>
            <option value="3">Biografi</option>
            <option value="1">Komik</option>
            <option value="5">Non-Fiksi</option>
            <option value="4">Fiksi</option>
            <option value="2">Novel</option>


        </select>
    </div>
    <div class="form-group">
        <label for="jumlah">Stok Buku</label>
        <input type="number" required class="form-control" name="jum_buk" id="jumlah">
    </div>
    <div class="form-group">
        <label>Deskripsi Buku</label>
        <textarea name="komentar" required rows="5" cols="50" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="file">Pilih File:</label>
        <input type="file" name="file" id="file" accept=".jpg,.png" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(function() {
    var books = <?php echo json_encode($books); ?>;
    var selectedBooks = <?php echo json_encode($selectedBooks); ?>; // Data buku yang sudah dipilih

    $("#bukuYangDipinjam").autocomplete({
        source: books,
        select: function(event, ui) {
            // Ketika item dipilih, set nilai input dengan label buku
            $(this).val(ui.item.label); // Menampilkan nama buku
            // Update Kode_Buku hidden input dengan kode buku yang dipilih
            $("#Kode_Buku").val(ui.item.value);
            return false; // Prevents input from being updated with value
        }
    });

    // Jika ada buku yang sudah dipilih, set sebagai nilai input
    if (selectedBooks.length > 0) {
        var selectedBookLabels = books.filter(function(book) {
            return selectedBooks.includes(book.value);
        }).map(function(book) {
            return book.label;
        });
        $("#bukuYangDipinjam").val(selectedBookLabels.join(', '));
    }
});

$(function() {
    var guest = <?php echo json_encode($tamu); ?>;
    var selectedTamu = <?php echo json_encode($selectedTamu); ?>;

    $("#namaSiswa").autocomplete({
        source: guest,
        select: function(event, ui) {
            $(this).val(ui.item.label);
            $("#No_Knj").val(ui.item.no_knj);
            return false;
        }
    });

    if (selectedTamu) {
        var selectedTamuObj = guest.find(function(guest) {
            return guest.no_knj === selectedTamu; // Periksa no_knj
        });

        if (selectedTamuObj) {
            $("#namaSiswa").val(selectedTamuObj.label);
            $("#No_Knj").val(selectedTamuObj.no_knj);
        }
    }
});
</script>