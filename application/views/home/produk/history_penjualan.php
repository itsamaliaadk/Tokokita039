<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">History Penjualan</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($history as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->tglOrder; ?></td>
                        <td><?= $row->namaProduk; ?></td>
                        <td><?= $row->jumlah; ?></td>
                        <td>Rp<?= number_format($row->harga); ?></td>
                        <td>Rp<?= number_format($row->jumlah * $row->harga); ?></td>
                        <td><?= $row->statusOrder; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 