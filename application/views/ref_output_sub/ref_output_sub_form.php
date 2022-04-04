<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>INPUT DATA SUB OUTPUT</h2>
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
                                    <td width='200'>Kode Ro</td>
                                    <td><input type="text" class="form-control" name="kode_ro" id="kode_ro" placeholder="Kode Ro" value="<?php echo $kode_ro; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Ro</td>
                                    <td><input type="text" class="form-control" name="nama_ro" id="nama_ro" placeholder="Nama Ro" value="<?php echo $nama_ro; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Dept</td>
                                    <td><?php echo select2_dinamis('kode_dept', 'ref_departemen', 'kode_dept', 'nama_dept', $kode_dept, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Unit Kerja</td>
                                    <td><?php echo select2_dinamis('kode_unit_kerja', 'ref_unit_kerja', 'kode_unit_kerja', 'nama_unit_kerja', $kode_unit_kerja, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Program</td>
                                    <td><?php echo select2_dinamis('kode_program', 'ref_program', 'kode_program', 'nama_program', $kode_program, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Kegiatan</td>
                                    <td><?php echo select2_dinamis('kode_kegiatan', 'ref_kegiatan', 'kode_kegiatan', 'nama_kegiatan', $kode_kegiatan, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Kro</td>
                                    <td><?php echo select2_dinamis('kode_kro', 'ref_output', 'kode_kro', 'nama_kro', $kode_kro, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Aktif</td>
                                    <td><?php echo form_dropdown('aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $aktif, array('class' => 'form-control')); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id_ro" value="<?php echo $id_ro; ?>" />
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed"><i class="fal fa-save"></i> <?php echo $button ?></button>
                                        <a href="<?php echo site_url('ref_output_sub') ?>" class="btn btn-info waves-effect waves-themed"><i class="fal fa-sign-out"></i> Kembali</a>
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