<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>INPUT DATA SATKER</h2>
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
                                    <td width='200'>Kode Satker</td>
                                    <td><input type="text" class="form-control" name="kode_satker" id="kode_satker" placeholder="Kode Satker" value="<?php echo $kode_satker; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Nama Satker</td>
                                    <td><input type="text" class="form-control" name="nama_satker" id="nama_satker" placeholder="Nama Satker" value="<?php echo $nama_satker; ?>" required /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Jenis Satker</td>
                                    <td><?php echo select2_dinamis('kode_jenis_satker', 'ref_jenis_satker', 'kode_jenis_satker', 'nama_jenis_satker', $kode_jenis_satker, 'aktif="y"', 'nama_jenis_satker ASC') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Parent Satker</td>
                                    <td><input type="text" class="form-control" name="kode_parent_satker" id="kode_parent_satker" placeholder="Kode Parent Satker" value="<?php echo $kode_parent_satker; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Alamat</td>
                                    <td><input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>No Tlpn</td>
                                    <td><input type="text" class="form-control" name="no_tlpn" id="no_tlpn" placeholder="No Tlpn" value="<?php echo $no_tlpn; ?>" /></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Dept</td>
                                    <td><?php echo select2_dinamis('kode_dept', 'ref_departemen', 'kode_dept', 'nama_dept', $kode_dept, 'aktif="y"', '') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Kode Unit Kerja</td>
                                    <td><?php echo select2_dinamis('kode_unit_kerja', 'ref_unit_kerja', 'kode_unit_kerja', 'nama_unit_kerja', $kode_unit_kerja, 'aktif="y"', 'nama_unit_kerja asc') ?></td>
                                </tr>
                                <tr>
                                    <td width='200'>Aktif</td>
                                    <td><?php echo form_dropdown('aktif', array('y' => 'AKTIF', 'n' => 'TIDAK AKTIF'), $aktif, array('class' => 'form-control')); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id_satker" value="<?php echo $id_satker; ?>" />
                                        <button type="submit" class="btn btn-warning waves-effect waves-themed"><i class="fal fa-save"></i> <?php echo $button ?></button>
                                        <a href="<?php echo site_url('ref_satker') ?>" class="btn btn-info waves-effect waves-themed"><i class="fal fa-sign-out"></i> Kembali</a>
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