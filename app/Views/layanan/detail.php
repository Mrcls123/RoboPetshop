<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA LAYANAN  </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Pengelolaan Data Layanan 
            </li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>

            </div>
            <div class="card-body">
                <!--Tabel Buku-->
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $result['title'] ?></h5>
                                <!-- <p class="card-text">Penulis:<?= $result['author'] ?></p>
                                <p class="card-text">Tahun Rilis:<?= $result['release_year'] ?></p>
                                <p class="card-text">Stok:<?= $result['stok'] ?></p> -->
                                <p class="card-text">Harga:<?= $result['harga'] ?></p>
                                <!-- <p class="card-text">Diskon:<?= $result['discount'] ?></p> -->
                                <div class="d-grid gap-2 d-md-block">
                                    <a class="btn btn-success" type="button" href="<?= base_url('layanan') ?>">Kembali</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>