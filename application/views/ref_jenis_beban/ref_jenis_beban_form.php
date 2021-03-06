<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>INPUT DATA JENIS BEBAN</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="<?php echo $action; ?>" method="post">

                            <table class='table table-striped'>
                                <tr>
                                    <td width='200'>Kode Jenis Beban</td>
                                    <td><input type="text" class="form-control" name="kode_jenis_beban" id="kode_jenis_beban" placeholder="Kode Jenis Beban" value="<?php echo $kode_jenis_beban; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Jenis Beban</td>
                                    <td><input type="text" class="form-control" name="nama_jenis_beban" id="nama_jenis_beban" placeholder="Nama Jenis Beban" value="<?php echo $nama_jenis_beban; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Beban</td>
                                    <td><?php echo select2_dinamis('kode_beban', 'ref_beban', 'kode_beban', 'nama_beban', $kode_beban, 'aktif="y"', 'nama_beban ASC') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Sumber Dana</td>
                                    <td><?php echo select2_dinamis('kode_sumber_dana', 'ref_sumber_dana', 'kode_sumber_dana', 'nama_sumber_dana', $kode_sumber_dana, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Aktif</td>
                                    <td><?php echo form_dropdown('aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $aktif, array('class' => 'form-control')); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id_jenis_beban" value="<?php echo $id_jenis_beban; ?>" />
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed"><i class="fal fa-save"></i> <?php echo $button ?></button>
                                        <a href="<?php echo site_url('ref_jenis_beban') ?>" class="btn btn-info waves-effect waves-themed"><i class="fal fa-sign-out"></i> Kembali</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
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