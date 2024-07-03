<?= $this->extend('layout/template')?>

<?= $this->section('content')?>

<div class="container-1">
    <div class="jumbotron-text-left">
        <h2>Container</h2>
    </div>
    <div class="row">
        <div class="text-center bg-warning">
            <h5>Container 1-Gambar</h5>
        </div>
        <div class="col-sm-6 bg-primary">
            <div class="text-center">
                <br>
                <img style="height : 300px; width : 300px"
                    src=https://sokoguru.id/backend/statics/1541470304063197184/asal-muasal-cuanki-kudapan-khas-bandung-yang-menasional.webp>
                <p style="font-weight: bold;">CUANKI</p>
            </div>
        </div>
        <div class="col-sm-6 bg-success">
            <div class="text-center">
                <br>
                <img style="height : 300px; width : 300px"
                    src=https://images.tokopedia.net/img/KRMmCm/2022/10/6/2cb23dcb-a38a-47af-a5d5-4b3a9ab60ac9.jpg>
                <p style="font-weight: bold;">SEBLAK</p>
            </div>
        </div>
    </div>

    <div class="col-sm-4 bg-light">
        <h5></h5>
    </div>
    <div class="container-2">
        <div class="row">
            <div class="jumbotron text-center bg-warning">
                <h5>Container 2 - Pesan dan Kesan</h5>
            </div>
            <div class="col-sm-7 bg-info">
                <h4 class="text-center">Pesan Kesan belajar di Sistem Informasi :</h4><br>
                <p>Pesan dan kesan saya selama belajar di Sistem Informasi sangat amat amat amat menyenangkan </p>
            </div>
            <div class="col-sm-5 text-center bg-primary">
                <h4>Pesan dan Kesan : </h4>
                <p>Pesan : PENGEN BAKSO CUANKI</p>
                <p>Kesan : SAMA PENGEN SEBLAK LEVEL 5</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>