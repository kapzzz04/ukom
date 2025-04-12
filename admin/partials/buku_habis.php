<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Daftar Buku Habis
            </h6>
            <br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableHabis" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aktifitas</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-center align-middle">
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Aktifitas</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
$no = 1;
foreach ($buku_habis as $items) :

    if ($items['stock'] == 0): // Tampilkan hanya jika stok 0
?>
                        <tr class="text-center">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $items['id_book']; ?></td>
                            <td><?php echo $items['title']; ?></td>
                            <td><?php echo $items['name']; ?></td>
                            <td><?php echo $items['stock']; ?></td>
                            <td class="d-flex flex-row align-items-center justify-content-center">
                                <a href="./daftar_buku_details.php?id=<?= $items['id_book']; ?>&nama_halaman=<?= 'buku_habis'; ?>&nomor=<?= $no; ?>"
                                    class="btn btn-sm btn-primary mr-lg-3 mr-2"><i class="fa fa-eye"></i></a>

                                <a href="./daftar_buku_edit.php?id_bkk=<?= $items['id_book']; ?>&nama_halaman=<?= 'buku_habis'; ?>"
                                    class="btn btn-sm btn-success mr-lg-3 mr-2"><i class="fa fa-edit"></i></a>

                                <a href="?ibook=<?= $items['id_book']; ?>"
                                    onclick="javascript:return confirm('Hapus Data Kategori ?');"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
    endif;
endforeach;
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>