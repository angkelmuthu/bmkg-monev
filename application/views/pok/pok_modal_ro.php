<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<form method="post" id="form">
    <div class="form-group">
        <div class="form-group">
            <label class="form-label">Rancangan Output</label>
            <select name="id_ro" class="select2 form-control" id="id_ro" required>
                <?php
                foreach ($dt_ro as $row) {
                    echo '<option value="' . $row->id_ro . '">' . $row->kode_ro . ' - ' . $row->nama_ro . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <button id="tambah_ro" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_kro').select2({
            dropdownParent: $('#Kro .modal-content')
        });
        $("#tambah_ro").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_ro",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $pok ?>");
                    $('#Ro').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>