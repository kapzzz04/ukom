  <?php

$admin = query("SELECT * FROM tm_loginadmin");

$guru = query("SELECT * FROM tm_gurustaff");

$murid = query("SELECT * FROM tm_murid");

$kategori = query("SELECT * FROM tm_jenis");

$buku_habis = query("SELECT * FROM tm_buku 
INNER JOIN tm_jenis ON tm_buku.kode_jenis = tm_jenis.kode_jenis 
WHERE tm_buku.jumlah IS NULL");

$buku_tersedia = query("SELECT * FROM tm_buku 
INNER JOIN tm_jenis ON tm_buku.kode_jenis = tm_jenis.kode_jenis 
WHERE tm_buku.jumlah IS NOT NULL");


$peminjamanKelasX = query("SELECT * 
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid
WHERE tm_murid.Kelas LIKE '%X-%'");

$peminjamanKelasXI = query("SELECT * 
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid
WHERE tm_murid.Kelas LIKE '%XI %' OR tm_murid.Kelas LIKE '%XI-%'");

$peminjamanKelasXII = query("SELECT * 
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid
WHERE tm_murid.Kelas LIKE '%XII %'");

$peminjamanGuruStaff = query("SELECT * 
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_gurustaff ON tt_daftartamu.No_GS = tm_gurustaff.No_AgtGS");

$pengembalianSudah = query("SELECT * 
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid
WHERE tt_pinjamkembali.StatusBuku LIKE '%sudah kembali%'");

$pengembalianBelum = query("SELECT * 
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid
WHERE tt_pinjamkembali.StatusBuku LIKE '%belum kembali%'");

$selectedBooks = [];
$selectedTamu = [];


// Pastikan $no_pnj sudah di-set

if ($no_pnj) {
// Query untuk mendapatkan buku yang sudah dipinjam
$getPengembalianById = query("SELECT *
FROM tt_pinjamkembali
INNER JOIN tm_buku ON tt_pinjamkembali.Kode_Buku = tm_buku.Kode_buku
INNER JOIN tt_daftartamu ON tt_pinjamkembali.No_Knj = tt_daftartamu.No_Knj
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid
INNER JOIN tm_jenis ON tm_buku.Kode_Jenis = tm_jenis.Kode_Jenis
WHERE tt_pinjamkembali.No_Pnj = '$no_pnj'");


    // Simpan kode buku yang sudah dipilih ke dalam array
    if (is_array($getPengembalianById)) {
        foreach ($getPengembalianById as $row) {
        $selectedBooks[] = $row['Kode_buku'];
        }
    } else {
        echo "Error: " . mysql_error();
        exit;
    }

    
}



// Query untuk mendapatkan murid yang hanya ada di tt_daftartamu
$allTamu = query('SELECT * FROM tt_daftartamu
INNER JOIN tm_murid ON tt_daftartamu.No_Murid = tm_murid.No_Murid');

// Simpan hasil query ke dalam array
$tamu = [];
if (is_array($allTamu)) {
    foreach ($allTamu as $row) {
    $label = !empty($row['Nama_Murid']) ? $row['Nama_Murid'] : '-';
    $kelas = !empty($row['Kelas']) ? $row['Kelas'] : '-';
    $label2 = !empty($row['Nama_AgtGS']) ? $row['Nama_AgtGS'] : '-';
    $jabatan = !empty($row['Jabatan']) ? $row['Jabatan'] : '-';
    $no_knj = !empty($row['No_Knj']) ? $row['No_Knj'] : '-';


        $tamu[] = [
        'label' => $label . ' (' . $kelas . ')',
        'value' => $row['Foto'],
        'no_knj' => $row['No_Knj']
        ];
    }
}

// Query untuk mendapatkan semua buku
$allBooks = query('SELECT * FROM tm_buku');

// Simpan hasil query ke dalam array
$books = [];
if (is_array($allBooks)) {
foreach ($allBooks as $row) {
// Ganti nilai NULL dengan "-"
$label = !empty($row['Judul_Buku']) ? $row['Judul_Buku'] : '-';
$kelasMapel = !empty($row['KelasMapel']) ? $row['KelasMapel'] : '-';
$edisi = !empty($row['Edisi']) ? $row['Edisi'] : '-';
$Kode_buku = !empty($row['Kode_buku']) ? $row['Kode_buku'] : '-';

$books[] = [
'label' => $label . ' (' . $kelasMapel . ', ' . $edisi . ')',
'value' => $row['Kode_buku'],
'no_knj' => $row['Kode_buku']
];
}
}