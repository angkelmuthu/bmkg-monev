<?php
if (!empty($_GET['ta'])) {
    $ta = $_GET['ta'];
} else {
    $ta = date('Y');
}
if (!empty($_GET['bulan'])) {
    $bulan = $_GET['bulan'];
} else {
    $bulan = date('m');
}
?>
<main id="js-page-content" role="main" class="page-content">
    <form method="GET" action="">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> Monitoring
                <small>
                    Bulan : <?php echo '<span class="badge border border-primary text-primary">' . $bulan . '</span>'; ?> |
                    Tahun : <?php echo '<span class="badge border border-primary text-primary">' . $ta . '</span>'; ?>
                </small>
            </h1>

            <div class="d-flex mr-4">
                <div>
                    <label class="fs-sm mb-0 mt-2 mt-md-0">Tahun Anggaran</label>
                    <div class="form-group">
                        <select class="form-control" name="ta" id="ta">
                            <?php
                            if (!empty($_GET['ta'])) {
                                $ta = $_GET['ta'];
                            } else {
                                $ta = date('Y');
                            }
                            $tg_awal = date('Y') - 10;
                            $tgl_akhir = date('Y') + 2;
                            for ($i = $tgl_akhir; $i >= $tg_awal; $i--) {
                                echo "<option value='$i'";
                                if ($ta == $i) {
                                    echo "selected";
                                }
                                echo ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex mr-0">
                <div>
                    <label class="fs-sm mb-0 mt-2 mt-md-0">Lokasi</label>
                    <select name="bulan" id="bulan" class="select2 form-control w-100">
                        <option value="1" <?php if ($bulan == 1) {
                                                echo ' selected';
                                            } ?>>Januari</option>
                        <option value="2" <?php if ($bulan == 2) {
                                                echo ' selected';
                                            } ?>>Februari</option>
                        <option value="3" <?php if ($bulan == 3) {
                                                echo ' selected';
                                            } ?>>Maret</option>
                        <option value="4" <?php if ($bulan == 4) {
                                                echo ' selected';
                                            } ?>>April</option>
                        <option value="5" <?php if ($bulan == 5) {
                                                echo ' selected';
                                            } ?>>Mei</option>
                        <option value="6" <?php if ($bulan == 6) {
                                                echo ' selected';
                                            } ?>>Juni</option>
                        <option value="7" <?php if ($bulan == 7) {
                                                echo ' selected';
                                            } ?>>Juli</option>
                        <option value="8" <?php if ($bulan == 8) {
                                                echo ' selected';
                                            } ?>>Agustus</option>
                        <option value="9" <?php if ($bulan == 9) {
                                                echo ' selected';
                                            } ?>>September</option>
                        <option value="10" <?php if ($bulan == 10) {
                                                echo ' selected';
                                            } ?>>Oktober</option>
                        <option value="11" <?php if ($bulan == 11) {
                                                echo ' selected';
                                            } ?>>November</option>
                        <option value="12" <?php if ($bulan == 12) {
                                                echo ' selected';
                                            } ?>>Desember</option>
                    </select>
                </div>
            </div>

        </div>
    </form>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>MONITORING STATUS</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        Keterangan : <span class="badge badge-secondary">Draft</span> <span class="badge badge-info">Terkirim</span> <span class="badge badge-success">Final</span> <span class="badge badge-warning">Revisi</span>
                        <table class="table table-bordered table-hover w-100" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kode Satker</th>
                                    <th>Nama Satker</th>
                                    <th>Kode Program</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($monitoring as $dt) {
                                ?>
                                    <td><?php echo $dt->kode_satker ?></td>
                                    <td><?php echo $dt->nama_satker ?></td>
                                    <td><?php echo $dt->kode_program ?></td>
                                    <td><?php echo $dt->nama_program ?></td>
                                    <td>
                                        <?php if ($dt->status == 'Terkirim') {
                                            echo '<span class="badge badge-info">' . $dt->status . '</span>';
                                        } elseif ($dt->status == 'Final') {
                                            echo '<span class="badge badge-success">' . $dt->status . '</span>';
                                        } elseif ($dt->status == 'Revisi') {
                                            echo '<span class="badge badge-warning">' . $dt->status . '</span>';
                                        } else {
                                            echo '<span class="badge badge-secondary">Draft</span>';
                                        } ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        Keterangan : <span class="badge badge-secondary">Draft</span> <span class="badge badge-info">Terkirim</span> <span class="badge badge-success">Final</span> <span class="badge badge-warning">Revisi</span>
                    </div>
                </div>
                <?php //$this->output->enable_profiler(TRUE);
                ?>
            </div>
        </div>

</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.export.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('select').change(function() {
            this.form.submit();
        });
    });
</script>