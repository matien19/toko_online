<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php

$nama = [
    'name' => 'nama',
    'id' => 'nama',
    'value' => $barang->nama,
    'class' => 'form-control',
];
$harga = [
    'name' => 'harga',
    'id' => 'harga',
    'value' => $barang->harga,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];
$stok = [
    'name' => 'stok',
    'id' => 'stok',
    'value' => $barang->stok,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];
$gambar = [
    'name' => 'gambar',
    'id' => 'gambar',
    'value' => null,
    'class' => 'form-control',
];
$submit = [
    'name' => 'submit',
    'id' => 'submit',
    'value' => 'submit',
    'class' => 'btn btn-success',
    'type' => 'submit',
];

$session = session();
$errors = $session->getFlashdata('errors');
?>

<h1>Tambah Barang</h1>

<?php if($errors != null): ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Terjadi Kesalahan</h4>
        <hr>
        <p class="mb-0">
            <?php
            foreach($errors as $err){
                echo $err.'<br>';
            }
            ?>
        </p>
    </div>
    <?php endif ?>
<?= form_open_multipart('Barang/update/'.$barang->id) ?>
<div class="form-group">
    <?= form_label("Name", "nama") ?>
    <?= form_input($nama) ?>
</div>
<div class="form-group">
    <?= form_label("Harga", "harga") ?>
    <?= form_input($harga) ?>
</div>
<div class="form-group">
    <?= form_label("Stok", "stok") ?>
    <?= form_input($stok) ?>
</div>

<img src="<?= base_url('uploads/'.$barang->gambar) ?>" alt="image" class="img-fluid">

<div class="form-group">
    <?= form_label("Gambar", "gambar") ?>
    <?= form_upload($gambar) ?>
</div>
<div class="text-right">
    <?= form_submit($submit) ?>
</div>

<?= $this->endSection('content'); ?>