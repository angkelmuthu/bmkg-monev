<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>LAPORAN TAHUNAN PELAKSANAAN KEGIATAN (BALAI)</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-clean">
							 <tr>
                                <td>Tahun Anggaran</td>
                                <td><select class="form-control" name="ta" id="ta" required>
                                        <option value="">Pilih Tahun</option>
                                        <?php
                                        for ($i = date('Y'); $i <= date('Y') + 5; $i++) {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                        ?>
                                    </select></td>
                            </tr>
							<tr>
							<td></td>
							<td><button type="button" onClick="cari()" class="btn btn-block btn-success">Cari</button></td>
							</tr>

                        </table>

                        <div id="tampil"></div>

                    </div>
					
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>
<script>
  function cari()
  {
	  tahun= $("#ta").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/get_rekap_tahunan_balai/"+tahun,
            cache: false,
            success: function(data) {
                $("#tampil").html(data);
            }
        });
    }
</script>