<!-- Extend the main layout -->
<?= $this->extend('template/layout') ?>

<!-- Set the title for this page -->
<?= $this->section('title') ?>
Tambah Pengguna
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
                    <h3>Tambah Pengguna</h3>
                    <p class="text-subtitle text-muted">Tambah pengguna baru ke sistem.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="basic-input-groups">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Pengguna Baru</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <?php if (session()->has('success')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->get('success') ?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= base_url('users/store'); ?>" method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_admin" class="form-label">Is Admin</label>
                                        <select class="form-control" id="is_admin" name="is_admin" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Place your content here -->
<?= $this->endSection() ?>