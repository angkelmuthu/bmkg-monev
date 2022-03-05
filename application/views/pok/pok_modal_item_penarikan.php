<form method="post" id="form">
    <input type="hidden" name="id_item" id="id_item" value="<?php echo $id_item ?>">
    <div class="alert alert-warning" role="alert">
        <strong>Perhatian!</strong> Total penarikan tidak boleh melebihi Pagu Anggaran sebesar Rp. <?php echo angka($jumlah) ?>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Januari</label>
                <input type="text" name="januari" id="januari" value="<?php echo $januari ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Februari</label>
                <input type="text" name="februari" id="februari" value="<?php echo $februari ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Maret</label>
                <input type="text" name="maret" id="maret" value="<?php echo $maret ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">April</label>
                <input type="text" name="april" id="april" value="<?php echo $april ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Mei</label>
                <input type="text" name="mei" id="mei" value="<?php echo $mei ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Juni</label>
                <input type="text" name="juni" id="juni" value="<?php echo $juni ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Juli</label>
                <input type="text" name="juli" id="juli" value="<?php echo $juli ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Agustus</label>
                <input type="text" name="agustus" id="agustus" value="<?php echo $agustus ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">September</label>
                <input type="text" name="september" id="september" value="<?php echo $september ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Oktober</label>
                <input type="text" name="oktober" id="oktober" value="<?php echo $oktober ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">November</label>
                <input type="text" name="november" id="november" value="<?php echo $november ?>" class="form-control">
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Desember</label>
                <input type="text" name="desember" id="desember" value="<?php echo $desember ?>" class="form-control">
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
                url: "<?php echo base_url(); ?>pok/update_penarikan",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $pok ?>");
                    $('#Penarikan').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>