<form method="post" id="form">
    <input type="hidden" name="kode_dept" id="kode_dept" value="<?php echo $kode_dept ?>">
    <input type="hidden" name="kode_unit_kerja" id="kode_unit_kerja" value="<?php echo $kode_unit_kerja ?>">
    <input type="hidden" name="kode_program" id="kode_program" value="<?php echo $kode_program ?>">
    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan" value="<?php echo $kode_kegiatan ?>">
    <input type="hidden" name="kode_kro" id="kode_kro" value="<?php echo $kode_kro ?>">
    <input type="hidden" name="kode_ro" id="kode_ro" value="<?php echo $kode_ro ?>">
    <input type="hidden" name="kode_komponen" id="kode_komponen" value="<?php echo $kode_komponen ?>">
    <input type="hidden" name="kode_komponen_sub" id="kode_komponen_sub" value="<?php echo $kode_komponen_sub ?>">
    <input type="hidden" name="kode_akun" id="kode_akun" value="<?php echo $kode_akun ?>">
    <div class="row">
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Judul Item</label>
                <select name="item_title" class="select2 form-control" id="item_title">
                    <option></option>
                    <option value="0">Buat Judul Item Baru</option>
                    <?php
                    foreach ($dt_item_head as $row) {
                        echo '<option value="' . $row->item_title . '">' . $row->item_title . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div id="hide" class="col-xl-12 mb-2" style="display: none;">
            <div class="form-group">
                <label class="form-label">Judul Item Baru</label>
                <input type="text" name="item_title_baru" id="item_title_baru" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <div class="form-group">
                <label class="form-label">Item</label>
                <input type="text" name="item" id="item" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Volume</label>
                <input type="text" name="volume" id="volume" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Satuan</label>
                <input type="text" name="satuan" id="satuan" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Harga Satuan</label>
                <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Total</label>
                <input type="text" name="total" id="total" class="form-control" value="" required readonly>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Swakelola</label>
                <?php echo form_dropdown('is_swakelola', array('n' => 'Bukan Swakelola', 'y' => 'Swakelola'), '', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="col-xl-6 mb-2"></div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Kode Blokir</label>
                <input type="text" name="kode_blokir" id="kode_blokir" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-6 mb-2">
            <div class="form-group">
                <label class="form-label">Jumlah Blokir</label>
                <input type="text" name="jumlah_blokir" id="jumlah_blokir" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-xl-12 mb-2">
            <button id="tambah_item" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#item_title').change(function() {
            var item_title = $('#item_title').val();
            if (item_title == '0') {
                $("#hide").css("display", "");
            } else {
                $("#hide").css("display", "none");
            }
        });

        $("#harga_satuan, #volume").keyup(function() {
            var harga_satuanx = $("#harga_satuan").val();
            var harga_satuan = parseInt(harga_satuanx.replace(/,.*|[^0-9]/g, ''), 10);
            var volume = $("#volume").val();

            var total = parseInt(harga_satuan) * parseInt(volume);
            $("#total").val(total);
        });

        $("#tambah_item").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_item",
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