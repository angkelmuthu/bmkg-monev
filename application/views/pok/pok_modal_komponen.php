<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<form method="post" id="form">
    <div class="form-group">
        <div class="form-group">
            <label class="form-label">Komponen</label>
            <select name="id_komponen" class="select2 form-control" id="id_komponen" required>
                <?php
                foreach ($dt_komponen as $row) {
                    echo '<option value="' . $row->id_komponen . '">' . $row->kode_komponen . ' - ' . $row->nama_komponen . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <button id="tambah_komponen" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_komponen').select2({
            dropdownParent: $('#Komponen .modal-content')
        });
        $("#tambah_komponen").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_komponen",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
                    $('#Komponen').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>