<!-- Extend the main layout -->
<?= $this->extend('template/layout') ?>

<!-- Set the title for this page -->
<?= $this->section('title') ?>
Checkout
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
                    <h3>Checkout</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('cart') ?>">Keranjang Belanja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
                    <?php if (session()->has('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('checkout') ?>" method="post">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 1; ?>
                                <?php $totalPrice = 0; ?>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><?= $cart[$product['id']] ?></td>
                                        <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($product['price'] * $cart[$product['id']], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalPrice += $product['price'] * $cart[$product['id']]; ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4"><strong>Total Harga</strong></td>
                                    <td><strong>Rp <?= number_format($totalPrice, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Buat Pesanan</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Place your content here -->
<?= $this->endSection() ?>