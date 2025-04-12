<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Daftar Buku Tersedia
            </h6>
            <br>
            <a href="./daftar_buku_add.php" class="btn btn-success btn-sm">Tambah Daftar Buku</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableTersedia" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Author</th>
                            <th>Stok</th>
                            <th>Aktifitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                        $no = 1;
                    foreach ($buku_tersedia as $i) : 
                        if ($i['stock'] > 0): // Tampilkan hanya jika stok lebih dari 0
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $i['title']; ?></td>
                            <td><?php echo $i['name']; ?></td>
                            <td><?php echo $i['author']; ?></td>
                            <td><?php echo $i['stock']; ?></td>
                            <td class="d-flex flex-row align-items-center justify-content-center">
                                <a href="./daftar_buku_details.php?id=<?= $i['id_book']; ?>"
                                    class="btn btn-sm btn-primary mr-lg-3 mr-2"><i class="fa fa-eye"></i></a>

                                <a href="./daftar_buku_edit.php?id_bkk=<?= $i['id_book']; ?>"
                                    class="btn btn-sm btn-success mr-lg-3 mr-2"><i class="fa fa-edit"></i></a>

                                <a href="?ibook=<?= $i['id_book']; ?>"
                                    onclick="javascript:return confirm('Hapus Data Kategori ?');"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php 
                     endif;
                    endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>