<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<h1>Home</h1>
<?php echo session()->get('username') ;?>
<?= $this->endSection('layout'); ?>