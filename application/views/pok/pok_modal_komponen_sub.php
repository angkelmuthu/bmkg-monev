<form method="post" id="form">
    <div class="form-group">
        <div class="form-group">
            <label class="form-label">Sub Komponen</label>
            <select name="kode_komponen_sub" class="select2 form-control" id="kode_komponen_sub" required>
                <?php
                foreach ($dt_komponen_sub as $row) {
                    echo '<option value="' . $row->kode_komponen_sub . '">' . $row->nama_komponen_sub . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <button id="tambah_komponen_sub" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("#tambah_komponen_sub").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>pok/tambah_komponen_sub",
                data: data,
                cache: false,
                success: function(data) {
                    $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
                    $('#Komponen_sub').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            });
        });
    });
</script>