<?php
if (!empty($_POST['ta'])) {
    $ta = $_POST['ta'];
} else {
    $ta = date('Y');
}
if (!empty($_POST['kode_balai'])) {
    $kode_balai = $_POST['kode_balai'];
} else {
    $kode_balai = '';
}
if (!empty($_POST['kode_lokasi'])) {
    $kode_lokasi = $_POST['kode_lokasi'];
} else {
    $kode_lokasi = '';
}
if (!empty($_POST['kode_satker'])) {
    $kode_satker = $_POST['kode_satker'];
} else {
    $kode_satker = '';
}
?>
<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/statistics/chartjs/chartjs.css">
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Monitoring
            <small>
                Tahun : <?php echo '<span class="badge border border-primary text-primary">' . $ta . '</span>'; ?>
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>FILTER Data</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="fs-sm mb-0 mt-2 mt-md-0">Balai</label>
                                    <div class="form-group">
                                        <select name="kode_balai" id="kode_balai" class="form-control select2">
                                            <option value="">Tampil Semua</option>
                                            <?php
                                            $this->db->where('aktif', '1');
                                            $this->db->order_by('kode_balai', 'ASC');
                                            $dt_balai = $this->db->get('ref_balai')->result();
                                            foreach ($dt_balai as $row1) : ?>
                                                <option value="<?php echo $row1->kode_balai ?>" <?php echo ($row1->kode_balai == $kode_balai) ? 'selected="selected"' : '' ?>><?php echo $row1->nama_balai ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-sm mb-0 mt-2 mt-md-0">Provinsi</label>
                                    <div class="form-group">
                                        <select name="kode_lokasi" id="kode_lokasi" class="form-control select2">
                                            <option value="">Tampil Semua</option>
                                            <?php
                                            $this->db->where('aktif', 'y');
                                            $this->db->order_by('kode_lokasi', 'ASC');
                                            $dt_lokasi = $this->db->get('ref_lokasi')->result();
                                            foreach ($dt_lokasi as $row2) : ?>
                                                <option value="<?php echo $row2->kode_lokasi ?>" <?php echo ($row2->kode_lokasi == $kode_lokasi) ? 'selected="selected"' : '' ?>><?php echo $row2->nama_lokasi ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-sm mb-0 mt-2 mt-md-0">Tahun Anggaran</label>
                                    <div class="form-group">
                                        <select class="form-control" name="ta" id="ta">
                                            <?php
                                            if (!empty($_POST['ta'])) {
                                                $ta = $_POST['ta'];
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
                                <div class="col-md-3">
                                    <label class="fs-sm mb-0 mt-2 mt-md-0">Satuan Kerja</label>
                                    <div class="form-group">
                                        <select name="kode_satker" id="kode_satker" class="form-control select2">
                                            <option value="">Tampil Semua</option>
                                            <?php
                                            $this->db->where('aktif', 'y');
                                            $this->db->order_by('kode_satker', 'ASC');
                                            $dt_satker = $this->db->get('ref_satker')->result();
                                            foreach ($dt_satker as $row3) : ?>
                                                <option value="<?php echo $row3->kode_satker ?>" <?php echo ($row3->kode_satker == $kode_satker) ? 'selected="selected"' : '' ?>><?php echo $row3->nama_satker ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2"><button type="submit" class="btn btn-block btn-sm btn-primary">Filter</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>CEKLIST RENCANA KERJA TAHUNAN</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered table-hover w-100" id="myTable">
                            <thead class="thead-themed">
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Provinsi</th>
                                    <th class="text-center" rowspan="2">Jumlah UPT</th>
                                    <th class="text-center" colspan="2">Penyampaian</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Belum</th>
                                    <th class="text-center">Sudah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($monitoring as $dt) {
                                ?>
                                    <tr>
                                        <td class="bg-primary-400 text-center" colspan="5"><?php echo $dt->nama_balai ?></td>
                                    </tr>
                                    <?php
                                    $this->db->select('nama_lokasi, count(kode_lokasi) as ttl_lokasi, COUNT(CASE WHEN status = "Draft" THEN 1 END) AS belum, COUNT(CASE WHEN status = "Terkirim" THEN 1 END) AS sudah');
                                    $this->db->from('v_monitoring_new');
                                    $this->db->where('kode_balai', $dt->kode_balai);
                                    $this->db->where('tahun_anggaran', $dt->tahun_anggaran);
                                    if (!empty($kode_lokasi)) {
                                        $this->db->where('kode_lokasi', $kode_lokasi);
                                    }
                                    if (!empty($kode_satker)) {
                                        $this->db->where('kode_satker', $kode_satker);
                                    }
                                    $this->db->group_by('kode_lokasi');
                                    $query = $this->db->get()->result();
                                    $no = 1;
                                    foreach ($query as $dt2) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $dt2->nama_lokasi ?></td>
                                            <td class="text-center"><?php echo $dt2->ttl_lokasi ?></td>
                                            <td class="text-center"><?php echo $dt2->belum ?></td>
                                            <td class="text-center"><?php echo $dt2->sudah ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>GRAFIK RENCANA KERJA</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div id="pieChart">
                            <canvas style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php //$this->output->enable_profiler(true);
        ?>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.export.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/chartjs/chartjs.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
        // $('select').change(function() {
        //     this.form.submit();
        // });
    });
</script>
<script>
    function getRandomColor() {
        var letters = '789ABCD'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.round(Math.random() * 6)];
        }
        return color;
    }

    /* bar char kegiatan*/
    var data_chart = {
        "row": <?php echo json_encode($chart) ?>
    };
    var pieChart = function() {
        var labels = data_chart.row.map(function(e) {
            return e.status;
        });
        var jml = data_chart.row.map(function(e) {
            return e.jml;
        });
        var barChartData = {
            labels: labels,
            datasets: [{
                label: "Status",
                backgroundColor: [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()],
                borderWidth: 1,
                data: jml
            }]

        };
        var config = {
            type: 'pie',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                events: false,
                animation: {
                    duration: 500,
                    easing: "easeOutQuart",
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset) {

                            for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                                    mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius) / 2,
                                    start_angle = model.startAngle,
                                    end_angle = model.endAngle,
                                    mid_angle = start_angle + (end_angle - start_angle) / 2;

                                var x = mid_radius * Math.cos(mid_angle);
                                var y = mid_radius * Math.sin(mid_angle);

                                ctx.fillStyle = '#000';
                                if (i == 10) { // Darker text color for lighter background
                                    ctx.fillStyle = '#444';
                                }
                                var percent = String(Math.round(dataset.data[i] / total * 100)) + "%";
                                ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                                // Display percent in another line, line break doesn't work for fillText
                                ctx.fillText(percent, model.x + x, model.y + y + 15);
                            }
                        });
                    }
                }
            }
        }
        new Chart($("#pieChart > canvas").get(0).getContext("2d"), config);
    }

    /* bar char kro -- end */

    /* initialize all charts */
    $(document).ready(function() {
        pieChart();
    });
</script>