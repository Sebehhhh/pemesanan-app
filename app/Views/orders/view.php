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
                    <h3>Detail Pesanan #<?= $order['id'] ?></h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('orders') ?>">Pesanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
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
                    <p><strong>ID Pesanan:</strong> <?= $order['id'] ?></p>
                    <p><strong>Total Harga:</strong> Rp <?= number_format($order['total_price'], 0, ',', '.') ?></p>
                    <p><strong>Status:</strong> <?= $order['status'] ?></p>

                    <h5>Item Pesanan</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produk</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; ?>
                            <?php foreach ($orderItems as $item) : ?>
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $products[$item['product_id']]['name'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Place your content here -->
<?= $this->endSection() ?>