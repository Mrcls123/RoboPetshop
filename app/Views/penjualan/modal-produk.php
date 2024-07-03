<div class="modal fade" id="modalProduk" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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
                        foreach($dataBarang as $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="img/<?= $value['gambar'] ?>" alt="" width="100">
                            </td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['harga'] ?></td>
                            <td><?= $value['stok'] ?></td>
                            <td>
                                <button onclick="add_cart('<?= $value['id_barang'] ?>', '<?= $value['nama'] ?>'
                                    , '<?= $value['harga'] ?>')" class="btn btn-success"><i
                                        class="fa fa-cart-plus"></i> Tambahkan</button>
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

<!--Modal Update Jumlah -->
<div class="modal fade" id="modalUbah" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">UBAH JUMLAH PRODUK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-7">
                        <input type="hidden" id="rowid">
                        <input type="number" id="qty" class="form-control" placeholder="Masukkan Jumlah Produk" min="1"
                            value="1">
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" onclick="update_cart()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function add_cart(id, name, price) {
    $.ajax({
        url: " <?= base_url('jual') ?>",
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

function update_cart() {
    var rowid = $('#rowid').val();
    var qty = $('#qty').val();

    $.ajax({
        url: "<?= base_url('jual/update') ?>",
        method: "POST",
        data: {
            rowid: rowid,
            qty: qty,
        },
        success: function(data) {
            load();
            $('#modalUbah').modal('hide');
        }
    });
}
</script>
<script>
function load() {
    $('#detail_cart').load("/jual/load");
    //$('#detail_cart').load(" < ?= base_url('jual/load') ?>");
    $('#spanTotal').load("<?= base_url('jual/gettotal') ?>");
}
$(document).ready(function() {
    load();
});
// Ubah Jumlah Item
$(document).on('click', '.ubah_cart', function() {
    var row_id = $(this).attr("id");
    var qty = $(this).attr("qty");
    $('#rowid').val(row_id);
    $('#qty').val(qty);
    $('#modalUbah').modal('show');
});

//Hapus Item Cart
$(document).on('click', '.hapus_cart', function() {
    var row_id = $(this).attr("id");
    $.ajax({
        url: "<?= base_url('jual') ?>/" + row_id,
        method: "DELETE",
        success: function(data) {
            $('#detail_cart').load('');
        }
    });
});

//Pembayaran
function bayar() {
    var nominal = $('#nominal').val();
    $.ajax({
        url: "<?= base_url('/jual/bayar') ?>",
        method: "POST",
        data: {
            'nominal': nominal
        },
        success: function(response) {
            var result = JSON.parse(response);
            swal({
                title: result.msg,
                icon: result.status ? "success" : "error",
            });
            load();
            $('#nominal').val("");
            $('#kembalian').val(result.data.kembalian);
        }
    });
}
</script>