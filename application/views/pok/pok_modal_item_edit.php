<form method="post" id="form">
    <input type="hidden" name="id_item" id="id_item" value="<?php echo $id_item ?>">
    <div class="row">
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Judul Item</label>
                <input type="text" name="item_title_baru" id="item_title_baru" class="form-control" value="<?php echo $item_title ?>" readonly>
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Item</label>
                <input type="text" name="item" id="item" class="form-control" value="<?php echo $item ?>" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Volume</label>
                <input type="text" name="volume" id="volume" class="form-control" value="<?php echo $volume ?>" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Harga Satuan</label>
                <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" value="<?php echo $harga_satuan ?>" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Total</label>
                <input type="text" name="total" id="total" class="form-control" value="<?php echo $jumlah ?>" required readonly>
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <button id="update_item" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $("#harga_satuan, #volume").keyup(function() {
            var harga_satuanx = $("#harga_satuan").val();
            var harga_satuan = parseInt(harga_satuanx.replace(/,.*|[^0-9]/g, ''), 10);
            var volume = $("#volume").val();

            var total = parseInt(harga_satuan) * parseInt(volume);
            $("#total").val(total);
        });

        $("#update_item").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/update_item",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $pok ?>");
                    $('#Item').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>