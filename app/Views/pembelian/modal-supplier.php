<div class="modal fade" id="modalSupp" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--Tabel Buku -->
                <table id="datatableSimple">
                    <thead>
                        <tr>
                            <th width="%5">No</th>
                            <th width="10%">Gambar</th>
                            <th width="30%">Nama</th>
                            <th width="15%">Harga</th>
                            <th width="10%">Stok</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach($dataSupp as $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['no_supplier'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['phone'] ?></td>
                            <td>
                                <button onclick="selectSupplier('<?= $value['supplier_id'] ?>',
                                '<?= $value['name'] ?>')" class="btn btn-success"><i class="fa fa-plus"></i>Pilih
                                </button>
                            </td>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- -->
            </div>
            <div class=" modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
function add_cart(id, name, price) {
    $.ajax({
        url: "<?= base_url('beli') ?>",
        method: "POST",
        data: {
            id: id,
            name: name,
            qty: 1,
            price: price,
        },
        success: function(data) {
            load()
        }
    });
}
</script>