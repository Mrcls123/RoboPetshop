<?= $this->extend('layout/template')?>

<?= $this->section('content')?>
<div class="container">
    <h1>Container</h1>
    <div class="row bg-warning" style="height: 50vh;">
        <div class="col-4 d-flex flex-column allign-items-center justify-content-center gap-y-0">
            <img src="https://i.scdn.co/image/ab6761610000e5eb4a06ebac6ff9bdfd39c36e73" alt="" width="100" height="100"
                class="rounded-circle">
            <p class="font-weight-bold">Biodata</p>
            <p>Nama: Mamang Kesbor </p>
            <p>TTL : 19 Maret 1990
            <p>NPM : 211711248
        </div>
        <div class="col-8 p-2">
            <div class="bg-primary h-100 d-flex-column align-items-center justify-content-center">
                <img src=http://logo.uajy.ac.id/file/uploads/2021/08/UAJY-LOGOGRAM_-01.png alt="" width="200"
                    height="200">
                <p style="margin-top: 60px;">UAJY</p>
                <p style="margin-top: 0,1px">SAYA SUKA BERKULIAH DI UAJY</p>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>