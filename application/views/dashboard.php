<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/statistics/chartjs/chartjs.css">
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Dashboard
            <small>
            </small>
        </h1>
        <!-- <div class="d-flex mr-4">
            <div class="mr-2">
                <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#967bbd&quot;, &quot;#ccbfdf&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }">7/10</span>
            </div>
            <div>
                <label class="fs-sm mb-0 mt-2 mt-md-0">New Sessions</label>
                <h4 class="font-weight-bold mb-0">70.60%</h4>
            </div>
        </div>
        <div class="d-flex mr-0">
            <div class="mr-2">
                <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#2196F3&quot;, &quot;#9acffa&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }">3/10</span>
            </div>
            <div>
                <label class="fs-sm mb-0 mt-2 mt-md-0">Page Views</label>
                <h4 class="font-weight-bold mb-0">14,134</h4>
            </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <?php echo angka($pagu) ?>
                        <small class="m-0 l-h-n">Total Pagu Anggaran</small>
                    </h3>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <?php echo angka($penarikan) ?>
                        <small class="m-0 l-h-n">Total Rencana Penarikan</small>
                    </h3>
                </div>
            </div>
        </div> -->
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <?php echo angka($realisasi_pagu) ?>
                        <small class="m-0 l-h-n">Total Realisasi Anggaran</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <?php echo angka($realisasi_fisik) ?>
                        <small class="m-0 l-h-n">Total Realisasi Fisik</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Pagu Anggaran <span class="fw-300"><i>Berdasarkan Kegiatan</i></span>
                    </h2>
                </div>
                <canvas id="kegiatan"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Pagu Anggaran <span class="fw-300"><i>Berdasarkan Lokasi</i></span>
                    </h2>
                </div>
                <canvas id="lokasi"></canvas>
            </div>
        </div>
        <div class="col-md-12">
            <div id="panel-4" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Pagu Anggaran & Realisai</span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_justified-1" role="tab">Berdasarkan Kegiatan</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-2" role="tab">Berdasarkan Output</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-3" role="tab">Berdasarkan Lokasi</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-4" role="tab">Detail Rincian</a></li>
                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane fade show active" id="tab_justified-1" role="tabpanel">
                                <div id="barStacked_kegiatan">
                                    <canvas style="width:100%;"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_justified-2" role="tabpanel">
                                <div id="barStacked_kro">
                                    <canvas style="width:100%;"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_justified-3" role="tabpanel">
                                <div id="barStacked_lokasi">
                                    <canvas style="width:100%;"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_justified-4" role="tabpanel">
                                <table class="table table-striped" id=myTable>
                                    <thead>
                                        <tr>
                                            <th>Satker</th>
                                            <th>Kegiatan</th>
                                            <th>Kro</th>
                                            <th>Pagu</th>
                                            <th>Realisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pagu_realisasi_detail as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->nama_satker ?></td>
                                                <td><?php echo $row->nama_kegiatan ?></td>
                                                <td><?php echo $row->nama_kro ?></td>
                                                <td class="text-right"><?php echo angka($row->pagu) ?></td>
                                                <td class="text-right"><?php echo angka($row->realisasi) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/chartjs/chartjs.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    var kegiatan_json = {
        "kegiatan_array": <?php echo json_encode($kegiatan) ?>
    };

    var labels = kegiatan_json.kegiatan_array.map(function(e) {
        return e.nama_kegiatan;
    });
    var data = kegiatan_json.kegiatan_array.map(function(e) {
        return e.pagu;
    });

    var ctx = document.getElementById('kegiatan').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        /* w  ww  .de mo  2s .  c  om*/
        data: {
            labels: labels,
            datasets: [{
                label: 'Kegiatan',
                data: data,
                backgroundColor: [
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor()
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 20,
                    padding: 20
                }
            }
        }
    });

    ///lokasi
    var jsonfile = {
        "jsonarray": <?php echo json_encode($lokasi) ?>
    };

    var labels = jsonfile.jsonarray.map(function(e) {
        return e.nama_lokasi;
    });
    var data = jsonfile.jsonarray.map(function(e) {
        return e.pagu;
    });

    var ctx = document.getElementById('lokasi').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        /* w  ww  .de mo  2s .  c  om*/
        data: {
            labels: labels,
            datasets: [{
                label: 'Kegiatan',
                data: data,
                backgroundColor: [
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor(),
                    getRandomColor()
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 20,
                    padding: 20
                }
            }
        }
    });

    /* bar stacked */
    var barStacked_kegiatan = function() {
        var pr_kegiatan = {
            "pr_kegiatan_array": <?php echo json_encode($pagu_realisasi_kegiatan) ?>
        };

        var labels = pr_kegiatan.pr_kegiatan_array.map(function(e) {
            return e.nama_kegiatan;
        });
        var pagu = pr_kegiatan.pr_kegiatan_array.map(function(e) {
            return e.pagu;
        });
        var realisasi = pr_kegiatan.pr_kegiatan_array.map(function(e) {
            return e.realisasi;
        });
        var barStackedData = {
            labels: labels,
            datasets: [{
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                },
                {
                    label: "Pagu Anggaran",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barStackedData,
            options: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#barStacked_kegiatan > canvas").get(0).getContext("2d"), config);
    }
    /* bar stacked -- end */
    /* bar stacked */
    var barStacked_kro = function() {
        var pr_kro = {
            "pr_kro_array": <?php echo json_encode($pagu_realisasi_kro) ?>
        };

        var labels = pr_kro.pr_kro_array.map(function(e) {
            return e.nama_kro;
        });
        var pagu = pr_kro.pr_kro_array.map(function(e) {
            return e.pagu;
        });
        var realisasi = pr_kro.pr_kro_array.map(function(e) {
            return e.realisasi;
        });
        var barStackedData = {
            labels: labels,
            datasets: [{
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                },
                {
                    label: "Pagu Anggaran",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barStackedData,
            options: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#barStacked_kro > canvas").get(0).getContext("2d"), config);
    }
    /* bar stacked -- end */
    /* bar stacked */
    var barStacked_lokasi = function() {
        var pr_lokasi = {
            "pr_lokasi_array": <?php echo json_encode($pagu_realisasi_lokasi) ?>
        };

        var labels = pr_lokasi.pr_lokasi_array.map(function(e) {
            return e.nama_lokasi;
        });
        var pagu = pr_lokasi.pr_lokasi_array.map(function(e) {
            return e.pagu;
        });
        var realisasi = pr_lokasi.pr_lokasi_array.map(function(e) {
            return e.realisasi;
        });
        var barStackedData = {
            labels: labels,
            datasets: [{
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                },
                {
                    label: "Pagu Anggaran",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barStackedData,
            options: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#barStacked_lokasi > canvas").get(0).getContext("2d"), config);
    }
    /* bar stacked -- end */
    function getRandomColor() {
        var letters = '789ABCD'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.round(Math.random() * 6)];
        }
        return color;
    }
    /* initialize all charts */
    $(document).ready(function() {
        barStacked_kegiatan();
        barStacked_kro();
        barStacked_lokasi();
    });
</script>