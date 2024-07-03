<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA BARANG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item-archive">Pengelolaan Data Barang</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Isi Detail -->
                <div class="card mb-3">
                    <div class="row 9-0">
                        <div class="col-md-4">
                            <img src="<?= base_url('img/' . $result['gambar']) ?>" alt="" width="100%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $result['nama'] ?></h5>
                                <p class="card-text">Stok: <?= $result['stok'] ?></p>
                                <p class="card-text">Harga: <?= $result['harga'] ?></p>
                                <div class="d-grip gap-2 d-md-block">
                                    <a class="btn btn-dark" type="button" href="<?= base_url('barang') ?>">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -->
            </div>
        </div>
    </div>
</main>

<?= $this->endSection()?>