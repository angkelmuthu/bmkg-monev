<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<form method="post" id="form">
    <!-- <div class="form-group">
        <div class="form-group">
            <label class="form-label">Sub Komponen</label>
            <select name="id_komponen_sub" class="select2 form-control" id="id_komponen_sub" required>
                <?php
                foreach ($dt_komponen_sub as $row) {
                    echo '<option value="' . $row->id_komponen_sub . '">' . $row->kode_komponen_sub . ' - ' . $row->nama_komponen_sub . '</option>';
                }
                ?>
            </select>
        </div>
    </div> -->
    <input type="hidden" name="kode_dept" id="kode_dept" value="<?php echo $kode_dept ?>">
    <input type="hidden" name="kode_unit_kerja" id="kode_unit_kerja" value="<?php echo $kode_unit_kerja ?>">
    <input type="hidden" name="kode_program" id="kode_program" value="<?php echo $kode_program ?>">
    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan" value="<?php echo $kode_kegiatan ?>">
    <input type="hidden" name="kode_kro" id="kode_kro" value="<?php echo $kode_kro ?>">
    <input type="hidden" name="kode_ro" id="kode_ro" value="<?php echo $kode_ro ?>">
    <input type="hidden" name="kode_komponen" id="kode_komponen" value="<?php echo $kode_komponen ?>">
    <div class="col-xl-12 mb-2">
        <div class="form-group">
            <label class="form-label">Kode Sub Komponen</label>
            <input type="text" name="kode_komponen_sub" id="kode_komponen_sub" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-xl-12 mb-2">
        <div class="form-group">
            <label class="form-label">Nama Sub Komponen</label>
            <input type="text" name="nama_komponen_sub" id="nama_komponen_sub" class="form-control" value="" required>
        </div>
    </div>
    <button id="tambah_komponen_sub" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_komponen_sub').select2({
            dropdownParent: $('#Komponen_sub .modal-content')
        });
        $("#tambah_komponen_sub").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_komponen_sub",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $pok ?>");
                    $('#Komponen_sub').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>