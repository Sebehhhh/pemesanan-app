<!-- File: app/Views/cart/index.php -->

<?= $this->extend('template/layout') ?>

<?= $this->section('title') ?>
Cart
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="main">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Shopping Cart</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Display Flash Messages -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <?php if (empty($products)) : ?>
                        <p>Cart is empty.</p>
                    <?php else : ?>
                        <form action="<?= base_url('checkout') ?>" method="post">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 1; ?>
                                    <?php foreach ($products as $product) : ?>
                                        <tr>
                                            <td><?= $number++ ?></td>
                                            <td><?= $product['name'] ?></td>
                                            <td><?= $product['description'] ?></td>
                                            <td><?= $product['price'] ?></td>
                                            <td>
                                                <?php if ($product['image']) : ?>
                                                    <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= $product['image'] ?>" class="img-fluid" style="max-width: 100px;">
                                                <?php else : ?>
                                                    No Image
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="selected_products[]" value="<?= $product['id'] ?>">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Checkout Selected</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>