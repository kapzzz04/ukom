<?php

$buku_tersedia = query("SELECT * FROM tm_buku 
INNER JOIN tm_jenis ON tm_buku.kode_jenis = tm_jenis.kode_jenis 
WHERE tm_buku.jumlah IS NOT NULL AND tm_buku.Kode_buku = $id_buku");

$buku_habis = query("SELECT * FROM tm_buku 
INNER JOIN tm_jenis ON tm_buku.kode_jenis = tm_jenis.kode_jenis 
WHERE tm_buku.jumlah IS NULL AND tm_buku.Kode_buku = $id_buku");


if ($_GET['nama_halaman'] === 'buku_habis') {

    foreach ($buku_habis as $items) {
        $book_id = $items['Kode_buku'];
        $judul_buku = $items['Judul_Buku'];
        $nama_jenis = $items['nama_jenis'];
        $jum = $items['Jumlah'] === NULL ? 0 : $items['Jumlah'];
        $status = $items['Status'] === NULL ? 0 : $items['Status'];
    }
} else {
    foreach ($buku_tersedia as $items) {
        $book_id = $items['Kode_buku'];
        $judul_buku = $items['Judul_Buku'];
        $nama_jenis = $items['nama_jenis'];
        $jum = $items['Jumlah'] === NULL ? 0 : $items['Jumlah'];
        $status = $items['Status'] === NULL ? 0 : $items['Status'];
    }
}



?>