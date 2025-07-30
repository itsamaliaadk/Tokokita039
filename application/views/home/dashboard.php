<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Dashboard Member <?php echo $konsumen->namaKonsumen; ?></span></h2>
    </div>

</div>
<div class="row px-xl-5">
    <div class="col-lg-6 mb-3">
        <a href="<?php echo site_url('toko/index'); ?>" class="btn btn-primary btn-block">Kelola Toko & Produk</a>
    </div>
    <div class="col-lg-6 mb-3">
        <a href="<?php echo site_url('Seller/TransaksiSell/history'); ?>" class="btn btn-success btn-block">History Penjualan</a>
    </div>
</div>