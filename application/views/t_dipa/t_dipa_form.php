<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>INPUT DATA DIPA</h2>
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
                                    <td width='200'>No Dipa</td>
                                    <td><input type="text" class="form-control" name="no_dipa" id="no_dipa" placeholder="No Dipa" value="<?php echo $no_dipa; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Tahun Anggaran</td>
                                    <td><input type="number" class="form-control" name="tahun_anggaran" id="tahun_anggaran" placeholder="Tahun Anggaran" value="<?php echo $tahun_anggaran; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Pagu</td>
                                    <td><input type="number" class="form-control" name="pagu" id="pagu" placeholder="Pagu" value="<?php echo $pagu; ?>" required /></td>
                                </tr>
                                <input type="hidden" class="form-control" name="kode_dept" id="kode_dept" placeholder="Kode Dept" value="<?php echo $this->session->userdata('kode_dept'); ?>" />
                                <input type="hidden" class="form-control" name="kode_unit_kerja" id="kode_unit_kerja" placeholder="Kode Unit Kerja" value="<?php echo $this->session->userdata('kode_unit_kerja'); ?>" />
                                <input type="hidden" class="form-control" name="kode_satker" id="kode_satker" placeholder="Kode Satker" value="<?php echo $this->session->userdata('kode_satker'); ?>" />
                                <input type="hidden" class="form-control" name="create_date" id="create_date" placeholder="Create Date" value="<?php echo date('Y-m-d H:i:s'); ?>" />

                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id_dipa" value="<?php echo $id_dipa; ?>" />
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed"><i class="fal fa-save"></i> <?php echo $button ?></button>
                                        <a href="<?php echo site_url('t_dipa') ?>" class="btn btn-info waves-effect waves-themed"><i class="fal fa-sign-out"></i> Kembali</a>
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