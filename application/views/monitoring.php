<style>
    .showTop {
        display: table-row-group !important;
    }
</style>
<?php
if (!empty($_GET['ta'])) {
    $ta = $_GET['ta'];
} else {
    $ta = date('Y');
}
if (!empty($_GET['lokasi'])) {
    $lokasi = $_GET['lokasi'];
    $this->db->where('kode_lokasi', $lokasi);
    $dt = $this->db->get('ref_lokasi')->row();
    $title = $dt->nama_lokasi;
} else {
    $lokasi = '';
    $title = 'Semua Lokasi';
}
?>
<main id="js-page-content" role="main" class="page-content">
    <form method="GET" action="">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> Monitoring
                <small>
                    Lokasi : <?php echo '<span class="badge border border-primary text-primary">' . $title . '</span>'; ?> |
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
                    <select name="lokasi" id="lokasi" class="select2 form-control w-100">
                        <option value="">Tampilkan Semua Lokasi</option>
                        <?php
                        $this->db->where('aktif', 'y');
                        $this->db->order_by('nama_lokasi', 'ASC');
                        $result = $this->db->get('ref_lokasi')->result();
                        foreach ($result as $row) { ?>
                            <option value="<?php echo $row->kode_lokasi ?>" <?php if ($lokasi == $row->kode_lokasi) {
                                                                                print 'selected';
                                                                            } ?>><?php echo $row->nama_lokasi  ?></option>';
                        <?php } ?>
                    </select>
                </div>
            </div>

        </div>
    </form>
    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-info rounded overflow-hidden position-relative text-black mb-g">
                <div class="">
                    <h4 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <small class="m-0 l-h-n fw-500">Total Pagu Anggaran</small>
                        Rp. <?php echo angka($pagu) ?>

                    </h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-success rounded overflow-hidden position-relative text-black mb-g">
                <div class="">
                    <h4 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <small class="m-0 l-h-n fw-500">Realisasi Inputan</small>
                        <?php echo 'Rp. ' . angka($realisasi_pagu_inputan) ?>

                    </h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-warning rounded overflow-hidden position-relative text-black mb-g">
                <div class="">
                    <h4 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <small class="m-0 l-h-n fw-500">Serapan</small>
                        <?php echo round($realisasi_pagu_inputan / $pagu * 100, 2) . '%'; ?>

                    </h4>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>MONITORING REALISASI</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        Keterangan : <span class="badge bg-info-500">Penyerapan > 50%</span> <span class="badge bg-success-500">Penyerapan < 50%</span> <span class="badge bg-warning-500">Penyerapan 0%</span>
                                <table class="table table-bordered table-hover w-100" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Kode Satker</th>
                                            <th>Nama Satker</th>
                                            <th>Lokasi</th>
                                            <!-- <th>Penjabat PPK</th>
                                            <th>KPA</th>
                                            <th>Kontak</th>
                                            <th>Email</th> -->
                                            <th>Pagu</th>
                                            <th>Realisasi</th>
                                            <th>Persentase</th>
                                            <th>Penyerapan</th>
                                            <th>Detil</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="showTop">
                                        <tr>
                                            <th>Kode Satker</th>
                                            <th>Nama Satker</th>
                                            <th>Lokasi</th>
                                            <!-- <th>Penjabat PPK</th>
                                            <th>KPA</th>
                                            <th>Kontak</th>
                                            <th>Email</th> -->
                                            <th>Pagu</th>
                                            <th>Realisasi</th>
                                            <th>Persentase</th>
                                            <th>Penyerapan</th>
                                            <th>Detil</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($monitoring as $dt) {
                                            if ($dt->pagu > 0) {
                                                $persen = round($dt->realisasi / $dt->pagu * 100, 2);
                                            } else {
                                                $persen = 0;
                                            }

                                            if ($persen >= 50) {
                                                $serap = "Penyarapan > 50%";
                                                echo '<tr class="bg-info-500">';
                                            } elseif (($persen > 0) && ($persen <= 49)) {
                                                $serap = "Penyarapan < 50%";
                                                echo '<tr class="bg-success-500">';
                                            } else {
                                                $serap = "Penyarapan 0%";
                                                echo '<tr class="bg-warning-500">';
                                            }
                                        ?>
                                            <td><?php echo $dt->kode_satker ?></td>
                                            <td><?php echo $dt->nama_satker ?></td>
                                            <td><?php echo $dt->nama_lokasi ?></td>
                                            <!-- <td><?php echo $dt->penjabat_ppk ?></td>
                                            <td><?php echo $dt->kpa ?></td>
                                            <td><?php echo $dt->kontak ?></td>
                                            <td><?php echo $dt->email ?></td> -->
                                            <td><?php echo 'Rp. ' . angka($dt->pagu) ?></td>
                                            <td><?php echo 'Rp. ' . angka($dt->realisasi) ?></td>
                                            <td><?php echo $persen ?>%</td>
                                            <td><?php echo $serap ?>%</td>
                                            <td><a href="<?php echo site_url('#'); ?>" class="btn btn-xs btn-default"><i class="fal fa-eye"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                Keterangan : <span class="badge bg-info-500">Penyerapan > 50%</span> <span class="badge bg-success-500">Penyerapan < 50%</span> <span class="badge bg-warning-500">Penyerapan 0%</span>
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
        //$('#myTable').DataTable();
        $('#myTable').DataTable({
            initComplete: function() {
                this.api()
                    .columns([2, 6])
                    .every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
        });
        $('select').change(function() {
            this.form.submit();
        });
    });
</script>