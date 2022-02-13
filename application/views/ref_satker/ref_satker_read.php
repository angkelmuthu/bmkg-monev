<main id="js-page-content" role="main" class="page-content">
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>Satker Read</h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
        <table class="table table-striped">
	    <tr><td>Kode Satker</td><td><?php echo $kode_satker; ?></td></tr>
	    <tr><td>Nama Satker</td><td><?php echo $nama_satker; ?></td></tr>
	    <tr><td>Kode Jenis Satker</td><td><?php echo $kode_jenis_satker; ?></td></tr>
	    <tr><td>Kode Parent Satker</td><td><?php echo $kode_parent_satker; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Tlpn</td><td><?php echo $no_tlpn; ?></td></tr>
	    <tr><td>Kode Dept</td><td><?php echo $kode_dept; ?></td></tr>
	    <tr><td>Kode Unit Kerja</td><td><?php echo $kode_unit_kerja; ?></td></tr>
	    <tr><td>Aktif</td><td><?php echo $aktif; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ref_satker') ?>" class="btn btn-primary waves-effect waves-themed">Kembali</a></td></tr>
	</table>
</div>
</div>

            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>