<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>INPUT DATA DEPARTEMEN</h2>
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
                                    <td width='200'>Kode Departement</td>
                                    <td><input type="text" class="form-control" name="kode_dept" id="kode_dept" placeholder="Kode Departement" value="<?php echo $kode_dept; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Departement</td>
                                    <td><input type="text" class="form-control" name="nama_dept" id="nama_dept" placeholder="Nama Departement" value="<?php echo $nama_dept; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Aktif</td>
                                    <td>
                                        <?php echo form_dropdown('aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $aktif, array('class' => 'form-control')); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id_dept" value="<?php echo $id_dept; ?>" />
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed"><i class="fal fa-save"></i> <?php echo $button ?></button>
                                        <a href="<?php echo site_url('ref_departemen') ?>" class="btn btn-info waves-effect waves-themed"><i class="fal fa-sign-out"></i> Kembali</a>
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