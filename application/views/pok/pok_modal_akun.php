<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<form method="post" id="form">
    <input type="hidden" name="kode_dept" id="kode_dept" value="<?php echo $kode_dept ?>">
    <input type="hidden" name="kode_unit_kerja" id="kode_unit_kerja" value="<?php echo $kode_unit_kerja ?>">
    <input type="hidden" name="kode_program" id="kode_program" value="<?php echo $kode_program ?>">
    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan" value="<?php echo $kode_kegiatan ?>">
    <input type="hidden" name="kode_kro" id="kode_kro" value="<?php echo $kode_kro ?>">
    <input type="hidden" name="kode_ro" id="kode_ro" value="<?php echo $kode_ro ?>">
    <input type="hidden" name="kode_komponen" id="kode_komponen" value="<?php echo $kode_komponen ?>">
    <input type="hidden" name="kode_komponen_sub" id="kode_komponen_sub" value="<?php echo $kode_komponen_sub ?>">
    <div class="form-group">
        <div class="form-group">
            <label class="form-label">Akun</label>
            <select name="akun" class="select2 form-control" id="akun" required>
                <?php
                foreach ($dt_akun as $row) {
                    echo '<option value="' . $row->kode_akun . '|' . $row->nama_akun . '">' . $row->kode_akun . ' - ' . $row->nama_akun . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <button id="tambah_akun" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#akun').select2({
            dropdownParent: $('#Akun .modal-content')
        });

        $("#tambah_akun").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_akun",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $pok ?>");
                    $('#Akun').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>