<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1>Detail Barang</h1>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card-body">
                <img src="<?= base_url('uploads/'.$barang->gambar) ?>" alt="image" class="img-fluid">
            </div>
        </div>
        <div class="col-6">
            <h1 class="text-success"><?= $barang->nama ?></h1>
            <h4>Harga : <?= $barang->harga ?></h4>
            <h4>Stok : <?= $barang->stok ?></h4>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>