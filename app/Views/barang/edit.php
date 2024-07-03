<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA BARANG </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> Pengelolaan Data Barang</li>
        </ol>
        <!-- Start Flash Data -->
        <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('msg') ?>
        </div>
        <?php endif; ?>
        <!-- End Flash Data -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Form Tambah Buku -->
                <form action="<?= base_url('barang/edit/' . $result['id_barang']) ?>" method="POST"
                    enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="slug" value="<?= $result['slug'] ?>">
                    <div class="mb-3 row">
                        <label for="nama" class="vol-sm col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>" id="nama"
                                name="nama" value="<?= old('nama', $result['nama']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('nama') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2 col-form--label">Stok</label>
                        <div class="col-sm-3">
                            <input type="number"
                                class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : '' ?>" id="stok"
                                name="stok" value="<?= old('stok', $result['stok']) ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stok') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-5">
                            <input type="hidden" name="sampullama" value="<?= $result['gambar'] ?>">
                            <input type="file" class="form-control <?= $validation->hasError('sampul') ?
                                                                        'is-invalid' : '' ?>" id="sampul" name="sampul"
                                onchange="previewImage()">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('sampul') ?>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <img src="/img/<?= $result['gambar'] == "" ? "default.jpg" :  $result['gambar'] ?>"
                                    alt="" class="img-thumbnail img-preview">
                            </div>
                        </div>
                        <label for="barang_category_id" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                            <select type="text" class="form-control" id="barang_category_id" name="barang_category_id">
                                <?php foreach ($category as $value) : ?>
                                <option value="<?= $value['barang_category_id'] ?>"
                                    <?= $value['barang_category_id'] == $result['barang_category_id'] ? 'selected' : '' ?>>
                                    <?= $value['name_category'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit">Perbarui</button>
                        <button class="btn btn-danger" type="reset">Batal</button>
                    </div>
                </form>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>