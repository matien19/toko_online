<?php
$session = session();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="<?= site_url('Home/index')?>">Ebeauty</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= site_url('Home/index')?>">Home <span class="sr-only">(current)</span></a>
          </li>
        <?php if ($session->get('isLoggedIn') ): ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?= site_url('etalase/index')?>">Etalase</a>
          </li>
        <?php if (session()->get('role')==0): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Barang</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a href="<?= site_url('barang/index')?>" class="dropdown-item">List Barang</a>
              <a href="<?= site_url('barang/create')?>" class="dropdown-item">Tambah Barang</a>
            </div>
          </li>
          </ul>
        <?php endif ?>
        </ul>
        <?php endif ?>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <ul class="navbar-nav mr-auto">
        <?php if ($session->get('isLoggedIn')): ?>
            <li class="nav-item">
              <a class="btn btn-dark" href="<?= site_url('auth/logout') ?>">Logout</a>
            </li>
          </ul>
        <?php else: ?>
        <li class="nav-item">
              <a class="btn btn-dark" href="<?= site_url('auth/login') ?>">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-dark" href="<?= site_url('auth/register') ?>">register</a>
            </li>
          </ul>
        <?php endif ?>

        </div>
      </div>
    </nav>
