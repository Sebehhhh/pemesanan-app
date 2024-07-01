<!-- Extend the main layout -->
<?= $this->extend('template/layout') ?>

<!-- Set the title for this page -->
<?= $this->section('title') ?>
Products
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
                    <h3>Products</h3>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
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

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <a href="<?= base_url('products/create') ?>" class="btn btn-primary">Tambah Produk</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Actions</th>
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
                                        <a href="<?= base_url('products/edit/' . $product['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url('products/delete/' . $product['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                                        <form action="<?= base_url('cart/add') ?>" method="post" style="display:inline;">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-success">Tambah ke Keranjang</button>
                                        </form>
                                    </td>
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