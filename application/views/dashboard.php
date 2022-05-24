<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/statistics/chartjs/chartjs.css">
<?php
if ($this->session->userdata('id_user_level') == 1) {
    if (!empty($_GET['ta'])) {
        $ta = $_GET['ta'];
    } else {
        $ta = date('Y');
    }
    if (!empty($_GET['satker'])) {
        $satker = $_GET['satker'];
        $this->db->where('kode_satker', $satker);
        $dt = $this->db->get('ref_satker')->row();
        $title = $dt->nama_satker;
    } else {
        $satker = '';
        $title = 'All Satker';
    }
} else {
    $ta = $this->session->userdata('ta');
    $satker = $this->session->userdata('kode_satker');
    $title = $this->session->userdata('nama_satker');
}
?>
<main id="js-page-content" role="main" class="page-content">
    <form method="GET" action="">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-chart-area'></i> Dashboard
                <small>
                    Satker : <?php echo '<span class="badge border border-primary text-primary">' . $title . '</span>'; ?> |
                    Tahun : <?php echo '<span class="badge border border-primary text-primary">' . $ta . '</span>'; ?>
                </small>
            </h1>
            <?php
            if ($this->session->userdata('id_user_level') == 1) { ?>
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
                        <label class="fs-sm mb-0 mt-2 mt-md-0">Satker</label>
                        <select name="satker" id="satker" class="select2 form-control w-100">
                            <option value="">Tampilkan Semua Satker</option>
                            <?php
                            $this->db->where('aktif', 'y');
                            $this->db->order_by('nama_satker', 'ASC');
                            $result = $this->db->get('ref_satker')->result();
                            foreach ($result as $row) { ?>
                                <option value="<?php echo $row->kode_satker ?>" <?php if ($satker == $row->kode_satker) {
                                                                                    print 'selected';
                                                                                } ?>><?php echo $row->nama_satker  ?></option>';
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-info rounded overflow-hidden position-relative text-white mb-g">
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
            <div class="p-3 bg-success-500 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <?php echo angka($realisasi_pagu) ?>
                        <small class="m-0 l-h-n">Total Realisasi Anggaran</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-warning-600 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="text-right display-5 d-block l-h-n m-0 fw-500">
                        <?php echo angka($realisasi_fisik) ?>
                        <small class="m-0 l-h-n">Total Realisasi Fisik</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Pagu Anggaran Berdasarkan Kegiatan
                        </h2>
                    </div>
                    <canvas id="kegiatan"></canvas>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Pagu Anggaran Berdasarkan Jenis Belanja
                        </h2>
                    </div>
                    <canvas id="akun"></canvas>
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
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-3" role="tab">Berdasarkan Akun</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-4" role="tab">Berdasarkan Sumber Dana</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-4" role="tab">Berdasarkan Lokasi</a></li> -->
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_justified-5" role="tab">Detail Rincian</a></li>
                            </ul>
                            <div class="tab-content p-3">
                                <div class="tab-pane fade show active" id="tab_justified-1" role="tabpanel">
                                    <div id="barChart_kegiatan">
                                        <canvas style="width:100%; height:300px;"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_justified-2" role="tabpanel">
                                    <div id="barChart_kro">
                                        <canvas style="width:100%; height:300px;"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_justified-3" role="tabpanel">
                                    <div id="barChart_akun">
                                        <canvas style="width:100%; height:300px;"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_justified-4" role="tabpanel">
                                    <div id="barChart_dana">
                                        <canvas style="width:100%; height:300px;"></canvas>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="tab_justified-4" role="tabpanel">
                                <div id="barChart_lokasi">
                                    <canvas style="width:100%; height:300px;"></canvas>
                                </div>
                            </div> -->
                                <div class="tab-pane fade" id="tab_justified-5" role="tabpanel">
                                    <table class="table table-striped table-bordered" id=myTable>
                                        <thead class="thead-themed">
                                            <tr>
                                                <th>Satker</th>
                                                <th>Kegiatan</th>
                                                <th>Kro</th>
                                                <th>Akun</th>
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
                                                    <td><?php echo $row->nama_akun ?></td>
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
    </div>
</main>
<?php //$this->output->enable_profiler(TRUE);
?>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/chartjs/chartjs.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('select').change(function() {
            this.form.submit();
        });
    });

    function getRandomColor() {
        var letters = '789ABCD'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.round(Math.random() * 6)];
        }
        return color;
    }

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
        data: {
            labels: labels,
            datasets: [{
                label: 'Kegiatan',
                data: data,
                backgroundColor: [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false,
                // position: 'right',
                // labels: {
                //     boxWidth: 20,
                //     padding: 20
                // }
            }
        }
    });

    ///Akun
    var jsonfile = {
        "jsonarray": <?php echo json_encode($akun) ?>
    };

    var labels = jsonfile.jsonarray.map(function(e) {
        return e.nama_akun;
    });
    var data = jsonfile.jsonarray.map(function(e) {
        return e.pagu;
    });

    var ctx = document.getElementById('akun').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        /* w  ww  .de mo  2s .  c  om*/
        data: {
            labels: labels,
            datasets: [{
                label: 'Kegiatan',
                data: data,
                backgroundColor: [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                // position: 'right',
                // labels: {
                //     boxWidth: 20,
                //     padding: 20
                // }
            }
        }
    });

    /* bar char kegiatan*/
    var barChart_kegiatan = function() {
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
        var barChartData = {
            labels: labels,
            datasets: [{
                    label: "Pagu",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                },
                {
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
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
        new Chart($("#barChart_kegiatan > canvas").get(0).getContext("2d"), config);
    }
    /* bar char kegiatan-- end */
    /* bar char kro */
    var barChart_kro = function() {
        var pr_kro = {
            "pr_kro_array": <?php echo json_encode($pagu_realisasi_kro)
                            ?>
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
        var barChartData = {
            labels: labels,
            datasets: [{
                    label: "Pagu",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                },
                {
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
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
        new Chart($("#barChart_kro > canvas").get(0).getContext("2d"), config);
    }

    /* bar char kro -- end */
    /* bar chart akun */
    var barChart_akun = function() {
        var pr_akun = {
            "pr_akun_array": <?php echo json_encode($pagu_realisasi_akun) ?>
        };
        var labels = pr_akun.pr_akun_array.map(function(e) {
            return e.nama_akun;
        });
        var pagu = pr_akun.pr_akun_array.map(function(e) {
            return e.pagu;
        });
        var realisasi = pr_akun.pr_akun_array.map(function(e) {
            return e.realisasi;
        });
        var barChartData = {
            labels: labels,
            datasets: [{
                    label: "Pagu",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                },
                {
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
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
        new Chart($("#barChart_akun > canvas").get(0).getContext("2d"), config);
    }

    var barChart_dana = function() {
        var pr_dana = {
            "pr_dana_array": <?php echo json_encode($pagu_realisasi_dana) ?>
        };
        var labels = pr_dana.pr_dana_array.map(function(e) {
            return e.nama_beban;
        });
        var pagu = pr_dana.pr_dana_array.map(function(e) {
            return e.pagu;
        });
        var realisasi = pr_dana.pr_dana_array.map(function(e) {
            return e.realisasi;
        });
        var barChartData = {
            labels: labels,
            datasets: [{
                    label: "Pagu",
                    backgroundColor: myapp_get_color.success_300,
                    borderColor: myapp_get_color.success_500,
                    borderWidth: 1,
                    data: pagu
                },
                {
                    label: "Realisasi",
                    backgroundColor: myapp_get_color.primary_300,
                    borderColor: myapp_get_color.primary_500,
                    borderWidth: 1,
                    data: realisasi
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
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
        new Chart($("#barChart_dana > canvas").get(0).getContext("2d"), config);
    }

    /* bar chart akun -- end */
    /* bar chart lokasi */

    // var barChart_lokasi = function() {
    //     var pr_lokasi = {
    //         "pr_lokasi_array": <?php //echo json_encode($pagu_realisasi_lokasi)
                                    ?>
    //     };
    //     var labels = pr_lokasi.pr_lokasi_array.map(function(e) {
    //         return e.nama_lokasi;
    //     });
    //     var pagu = pr_lokasi.pr_lokasi_array.map(function(e) {
    //         return e.pagu;
    //     });
    //     var realisasi = pr_lokasi.pr_lokasi_array.map(function(e) {
    //         return e.realisasi;
    //     });
    //     var barChartData = {
    //         labels: labels,
    //         datasets: [{
    //                 label: "Pagu",
    //                 backgroundColor: myapp_get_color.success_300,
    //                 borderColor: myapp_get_color.success_500,
    //                 borderWidth: 1,
    //                 data: pagu
    //             },
    //             {
    //                 label: "Realisasi",
    //                 backgroundColor: myapp_get_color.primary_300,
    //                 borderColor: myapp_get_color.primary_500,
    //                 borderWidth: 1,
    //                 data: realisasi
    //             }
    //         ]

    //     };
    //     var config = {
    //         type: 'bar',
    //         data: barChartData,
    //         options: {
    //             responsive: true,
    //             legend: {
    //                 position: 'top',
    //             },
    //             title: {
    //                 display: false,
    //                 text: 'Bar Chart'
    //             },
    //             scales: {
    //                 xAxes: [{
    //                     display: true,
    //                     scaleLabel: {
    //                         display: false,
    //                         labelString: '6 months forecast'
    //                     },
    //                     gridLines: {
    //                         display: true,
    //                         color: "#f2f2f2"
    //                     },
    //                     ticks: {
    //                         beginAtZero: true,
    //                         fontSize: 11
    //                     }
    //                 }],
    //                 yAxes: [{
    //                     display: true,
    //                     scaleLabel: {
    //                         display: false,
    //                         labelString: 'Profit margin (approx)'
    //                     },
    //                     gridLines: {
    //                         display: true,
    //                         color: "#f2f2f2"
    //                     },
    //                     ticks: {
    //                         beginAtZero: true,
    //                         fontSize: 11
    //                     }
    //                 }]
    //             }
    //         }
    //     }
    //     new Chart($("#barChart_lokasi > canvas").get(0).getContext("2d"), config);
    // }

    /* bar chart lokasi -- end */

    /* initialize all charts */
    $(document).ready(function() {
        barChart_kegiatan();
        barChart_kro();
        barChart_akun();
        barChart_dana();
        //barChart_lokasi();
    });
</script>