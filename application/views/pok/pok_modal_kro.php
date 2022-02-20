<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<form method="post" id="form">
    <div class="form-group">
        <div class="form-group">
            <label class="form-label">Kegiatan Rencangan Output</label>
            <select name="id_kro" class="select2 form-control" id="id_kro" required>
                <?php
                foreach ($dt_kro as $row) {
                    echo '<option value="' . $row->id_kro . '">' . $row->kode_kro . '-' . $row->nama_kro . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Volume</label>
            <input type="text" name="volume" class="form-control">
        </div>
    </div>
    <button id="tambah_kro" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_kro').select2({
            dropdownParent: $('#Kro .modal-content')
        });
        $("#tambah_kro").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_kro",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
                    $('#Kro').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>