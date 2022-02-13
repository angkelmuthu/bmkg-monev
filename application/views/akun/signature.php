<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/js-lib/jquery.signature.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/js-lib/jquery-ui.css" />

<style>
    .kbw-signature {
        height: 200px;
        width: 300px;
    }
</style>


<main id="js-page-content" role="main" class="page-content">
    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    <div class="row">
        <div class="col-xl-4">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        DIGITAL SIGNATURE (TTD Digital)
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table">
                            <tr class="text-center">
                                <td>
                                    <div id="show" style="border: none;"></div>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td><?php echo $nama ?></td>
                            </tr>
                            <tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0 text-center">
                                <td>NIP. <?php echo $nip ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        DIGITAL SIGNATURE (TTD Digital) | QRCODE
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <?php
                        $qr['data'] = site_url('frontend/qr/' . $this->session->userdata('id_users'));

                        $qr['level'] = 'H';
                        $qr['size'] = 10;
                        $qr['savename'] = FCPATH . 'qr.png';
                        $this->ciqrcode->generate($qr);
                        echo '
                                <table class="table table">
                                <tr class="text-center">
                                    <td>
                                    <img width="200" style="overflow: hidden; border-radius: 50%;" src="' . base_url() . 'qr.png" class="img-fluid img-thumbnail rounded" alt="">
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>' . $nama . '</td>
                                </tr>
                                <tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0 text-center">
                                    <td>NIP. ' . $nip . '</td>
                                </tr>
                            </table>
                                ';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        CREATE DIGITAL SIGNATURE (TTD Digital)
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="text-center">
                            <h3>Buat tanda tangan anda dibawah ini.</h3>
                            <div id="tandatangan"></div>
                        </div>
                        <div class="text-center">
                            <button id="hapus" class="btn btn-warning">Hapus</button>
                            <button id="draw" class="btn btn-primary" data-toggle="modal" data-target="#default-example-modal">Lihat & Simpan</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="default-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="<?php echo site_url('akun/ttd_action'); ?>" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                Basic Modals
                                                <small class="m-0 text-muted">
                                                    Below is a static modal example
                                                </small>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="salinan"></div>
                                            <textarea class="form-control" name="ttd" id="ttd" readonly required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/plugins/js-lib/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/js-lib/jquery-ui.min.js" type="text/javascript"> </script> -->
<script src="<?php echo base_url() ?>assets/plugins/js-lib/jquery.signature.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/js-lib/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<script>
    $(function() {
        $('#tandatangan').signature({
            guideline: false
        });

        $('#hapus').click(function() {
            $('#tandatangan').signature('clear');
            $('#salinan').signature('clear');
        });

        $('#json').click(function() {
            var pesan = $('#tandatangan').signature('toJSON');
            alert(pesan);
        });

        $('#draw').click(function() {
            var json = $('#tandatangan').signature('toJSON');
            $('#salinan').signature('draw', json);
            var ttd_raw = $('#tandatangan').signature('toJSON');
            document.getElementById("ttd").value = ttd_raw;
        });

        $('#salinan').signature({
            disabled: true,
            guideline: false
        });
        $('#show').signature({
            disabled: true,
            guideline: false
        });
        var ttdx = '<?php echo $ttd ?>';
        var ttd = ttdx.replace(/&quot;/g, '"');;
        if (ttd != '' && ttd != null) {
            $('#show').signature('draw', ttd);
        } else {
            $('#show').html('');
        }

    });
</script>