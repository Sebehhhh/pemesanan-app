<!-- Extend the main layout -->
<?= $this->extend('template/layout') ?>

<!-- Set the title for this page -->
<?= $this->section('title') ?>
Users
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
                    <h3>Users</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                        <a href="<?= base_url('users/create') ?>" class="btn btn-primary">Tambah Pengguna</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Is Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $number++ ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td>
                                        <?php if ($user['is_admin']) : ?>
                                            <span class="badge bg-success">Yes</span>
                                        <?php else : ?>
                                            <span class="badge bg-secondary">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="<?= base_url('users/delete/' . $user['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
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