<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>POK</h2>
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
                                <td><?php echo $tahun_anggaran; ?></td>
                            </tr>
                            <tr>
                                <td>Satker</td>
                                <td><?php echo $nama_satker; ?></td>
                            </tr>
                            <tr>
                                <td>PLAFON/PAGU ANGGARAN</td>
                                <td>Rp. <?php echo angka($pagu) ?></td>
                            </tr>

                        </table>
                        <div class="ajax-loader text-center">
                            <img id="loading-pok" style="display:none;" src="<?php echo base_url() ?>assets/smartadmin/img/loading.gif" class="img-responsive" />
                        </div>
                        <div id="tampil"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php //$this->output->enable_profiler(TRUE);
?>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>
<script>
    $(document).ready(function() {
        //$.fn.modal.Constructor.prototype.enforceFocus = function() {};
        //Tampilkan Data
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>",
            cache: false,
            beforeSend: function() {
                $("#loading-pok").show();
            },
            success: function(data) {
                $("#tampil").html(data);
            },
            complete: function() {
                $('#loading-pok').hide();
            }
        });
    });
</script>