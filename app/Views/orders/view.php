<!-- Extend the main layout -->
<?= $this->extend('template/layout') ?>

<!-- Set the title for this page -->
<?= $this->section('title') ?>
Detail Pesanan
<?= $this->endSection() ?>

<!-- Set the content for this page -->
<?= $this->section('content') ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Pesanan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('orders') ?>">Pesanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pesanan</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Total Harga:</strong> Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong> <?= $order['status'] ?>
                    </div>
                    <div class="mb-3">
                        <strong>Nama Produk:</strong> <?= $product['name'] ?>
                    </div>
                    <div class="mb-3">
                        <strong>Deskripsi Produk:</strong> <?= $product['description'] ?>
                    </div>
                    <div class="mb-3">
                        <strong>Harga Produk:</strong> Rp <?= number_format($product['price'], 0, ',', '.') ?>
                    </div>
                    <div class="mb-3">
                        <strong>Gambar Produk:</strong>
                        <?php if ($product['image']) : ?>
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= $product['image'] ?>" class="img-fluid" style="max-width: 200px;">
                        <?php else : ?>
                            No Image
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <strong>Nama Pengguna:</strong> <?= $user['username'] ?>
                    </div>
                    <div class="mb-3">
                        <strong>Email Pengguna:</strong> <?= $user['email'] ?>
                    </div>
                    <div>
                        <a href="<?= base_url('orders') ?>" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>