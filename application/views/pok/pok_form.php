<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>INPUT DATA POK</h2>
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
                                    <td width='200'>Tahun Anggaran</td>
                                    <td><input type="text" class="form-control" name="tahun_anggaran" id="tahun_anggaran" placeholder="Tahun Anggaran" value="<?php echo $tahun_anggaran; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Dept</td>
                                    <td><input type="text" class="form-control" name="kode_dept" id="kode_dept" placeholder="Kode Dept" value="<?php echo $kode_dept; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Unit Kerja</td>
                                    <td><input type="text" class="form-control" name="kode_unit_kerja" id="kode_unit_kerja" placeholder="Kode Unit Kerja" value="<?php echo $kode_unit_kerja; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Satker</td>
                                    <td><input type="text" class="form-control" name="kode_satker" id="kode_satker" placeholder="Kode Satker" value="<?php echo $kode_satker; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Program</td>
                                    <td><input type="text" class="form-control" name="kode_program" id="kode_program" placeholder="Kode Program" value="<?php echo $kode_program; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Program</td>
                                    <td><input type="text" class="form-control" name="nama_program" id="nama_program" placeholder="Nama Program" value="<?php echo $nama_program; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Create Date</td>
                                    <td><input type="text" class="form-control" name="create_date" id="create_date" placeholder="Create Date" value="<?php echo $create_date; ?>" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id_program" value="<?php echo $id_program; ?>" />
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed"><i class="fal fa-save"></i> <?php echo $button ?></button>
                                        <a href="<?php echo site_url('pok') ?>" class="btn btn-info waves-effect waves-themed"><i class="fal fa-sign-out"></i> Kembali</a>
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