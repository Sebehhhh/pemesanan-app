<!-- Extend the main layout -->
<?= $this->extend('template/layout') ?>

<!-- Set the title for this page -->
<?= $this->section('title') ?>
Keranjang
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
                    <h3>Keranjang Belanja</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Keranjang Anda</h4>
                    <a href="<?= base_url('cart/clear') ?>" class="btn btn-danger float-end">Kosongkan Keranjang</a>
                </div>
                <div class="card-body">
                    <?php if (session()->has('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($cart && count($cart) > 0) : ?>
                        <form action="<?= base_url('checkout') ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pilih</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 1; ?>
                                    <?php foreach ($cart as $productId => $quantity) : ?>
                                        <tr>
                                            <td><?= $number++ ?></td>
                                            <td><input type="checkbox" name="product_ids[]" value="<?= $productId ?>"></td>
                                            <td><?= $products[$productId]['name'] ?></td>
                                            <td><?= $quantity ?></td>
                                            <td>
                                                <a href="<?= base_url('cart/remove/' . $productId) ?>" class="btn btn-sm btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                    <?php else : ?>
                        <p>Keranjang Anda kosong.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Place your content here -->
<?= $this->endSection() ?>