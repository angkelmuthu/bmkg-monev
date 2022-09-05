<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Monev | BMKG
    </title>
    <meta name="description" content="Page Titile">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin-slim/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin-slim/css/app.bundle.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/smartadmin-slim/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/smartadmin-slim/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="<?php echo base_url() ?>assets/smartadmin-slim/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/datagrid/datatables/datatables.bundle.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/formplugins/select2/select2.bundle.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/notifications/toastr/toastr.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/page-invoice.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/costume/default.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/bootstrap/css/sweetalert.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/statistics/c3/c3.css">
    <link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/statistics/chartjs/chartjs.css">

    <script src="<?php echo base_url() ?>assets/bootstrap/js/sweetalert.min.js"></script>
    <!-- <link id="mytheme" rel="stylesheet" href="<?php echo base_url() ?>assets/smartadmin-slim/css/themes/cust-theme-5.css"> -->
    <!--<link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->
    <style>
        .c3-chart-arc text {
            fill: black;
        }
    </style>
</head>

<body class="mod-bg-1 mod-pace-custom nav-mobile-push nav-mobile-slide-out header-function-fixed nav-function-fixed desktop chrome webkit pace-done blur">
    <!-- DOC: script to save and load page settings -->
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /**
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
            themeURL = themeSettings.themeURL || 'nav-function-top',
            themeOptions = themeSettings.themeOptions || '';
        /**
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);
        }
        /**
         * Save to localstorage
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /**
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                <main id="js-page-content" role="main" class="page-content">
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-8" class="panel mb-1">
                                <div class="panel-hdr bg-primary-700 bg-success-gradient">
                                    <h2>
                                        BADAN METEOROLOGI KLIMATOLOGI DAN GEOFISIKA
                                        <span class="badge badge-pill badge-warning fw-400 l-h-n">
                                            ​Bidang Pemantauan dan Evaluasi - Biro Perencanaan
                                        </span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <div class="btn-group" role="group" aria-label="Group C">
                                            <a href="#" class="btn btn-secondary waves-effect waves-themed" disabled><span class="fal fa-check mr-1"></span> Sumber Data SAKTI</a>
                                            <a href="<?php echo site_url('Dashboard_eksekutif/omspan') ?>" class="btn btn-default waves-effect waves-themed">Sumber Data OMSPAN</a>
                                        </div>
                                    </div>
                                    <div class="panel-toolbar ml-2">
                                        <a href="<?php echo site_url('Dashboard') ?>" class="btn btn-dark waves-effect waves-themed">
                                            <span class="fal fa-arrow-left mr-1"></span>
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div id="panel-10" class="panel mb-1">
                                <div class="panel-hdr">
                                    <h2>
                                        Realisasi
                                    </h2>
                                    <div class="panel-toolbar">
                                        <h5 class="m-0">
                                            Satuan Milyar
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="panel-content ml-1">
                                                <h4 class="text-center">BMKG</h4>
                                                <div id="bmkg" style="width:100%; height:180px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="panel-content ml-1">
                                                <h4 class="text-center">Program DUKMAN</h4>
                                                <div id="dukman" style="width:100%; height:180px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <h4 class="text-center">Program PMKG</h4>
                                                    <div id="pmkg" style="width:100%; height:180px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div id="panel-10" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        Realisasi Perjenis Belanja
                                    </h2>
                                    <div class="panel-toolbar">
                                        <h5 class="m-0">
                                            Satuan Milyar
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div id="barChart">
                                            <canvas style="width:100%; height:210px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div id="panel-10" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        Realisasi Perbulan
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div id="barlineCombine">
                                            <canvas style="width:100%; height:200px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- </div> -->
                        <div class="col-xl-5">
                            <div id="panel-10" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        Realisasi <span class="fw-300"><i>Persumber Dana</i></span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <h5 class="m-0">
                                            Satuan Milyar
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-1">
                                        <table class="table table-striped table-bordered">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Sumber Dana</th>
                                                    <th>Pagu</th>
                                                    <th>Realisasi</th>
                                                    <th>%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($sumber_dana as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->nama ?></td>
                                                        <td class="text-right"><?php echo $row->pagu ?></td>
                                                        <td class="text-right"><?php echo $row->realisasi ?></td>
                                                        <td class="text-right"><?php echo $row->persen ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div id="panel-10" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        Realisasi <span class="fw-300"><i>Persumber Dana</i></span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <h5 class="m-0">
                                            Satuan Milyar
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-1">
                                        <div id="barChart2">
                                            <canvas style="width:100%; height:280px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5">
                            <div id="panel-10" class="panel mb-1">
                                <div class="panel-hdr">
                                    <h2>
                                        Satuan Kerja</span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <h5 class="m-0">
                                            Satuan Milyar
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="example">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <th>Satuan Kerja</th>
                                                        <th>Pagu</th>
                                                        <th>Realisasi</th>
                                                        <th>%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($satker as $row) { ?>
                                                        <tr>
                                                            <td><?php echo $row->kode . ' | ' . $row->nama ?></td>
                                                            <td class="text-right"><?php echo $row->pagu ?></td>
                                                            <td class="text-right"><?php echo $row->realisasi ?></td>
                                                            <td class="text-right"><?php echo $row->persen ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div id="panel-10" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        Realisasi <span class="fw-300"><i>Per Kegiatan</i></span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <h5 class="m-0">
                                            Satuan Milyar
                                        </h5>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="example2">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <th>Kegiatan</th>
                                                        <th>Pagu</th>
                                                        <th>Realisasi</th>
                                                        <th>%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($kegiatan as $row) { ?>
                                                        <tr>
                                                            <td><?php echo $row->kode_kegiatan . ' | ' . $row->nama ?></td>
                                                            <td class="text-right"><?php echo $row->pagu ?></td>
                                                            <td class="text-right"><?php echo $row->realisasi ?></td>
                                                            <td class="text-right"><?php echo $row->persen ?></td>
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
                </main>
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
    <script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
    <!-- dependency for c3 charts : this dependency is a BSD license with clause 3 -->
    <script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/d3/d3.js"></script>
    <!-- c3 charts : MIT license -->
    <script src="https://unpkg.com/@develoka/angka-rupiah-js/index.min.js"></script>
    <script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/c3/c3.js"></script>
    <script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/demo-data/demo-c3.js"></script>
    <script src="<?php echo base_url() ?>assets/smartadmin/js/statistics/chartjs/chartjs.bundle.js"></script>
    <script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.export.js"></script>
    <script>
        var colors = [myapp_get_color.success_500, myapp_get_color.danger_500, myapp_get_color.info_500, myapp_get_color.primary_500, myapp_get_color.warning_500];

        var bmkg = c3.generate({
            bindto: "#bmkg",
            data: {
                // iris data from R
                columns: [
                    ['Pagu : <?php echo angka($bmkg_pagu) ?>', <?php echo $bmkg_pagu ?>],
                    ['Realisasi : <?php echo angka($bmkg_realisasi) ?>', <?php echo $bmkg_realisasi ?>],
                ],
                type: 'donut' //,
                /*onclick: function (d, i) { console.log("onclick", d, i); },
                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
            },
            donut: {
                title: "<?php echo $bmkg_persen ?>"
            },
            color: {
                pattern: colors
            }
        });

        var dukman = c3.generate({
            bindto: "#dukman",
            data: {
                // iris data from R
                columns: [
                    ['Pagu : <?php echo angka($dukman_pagu) ?>', <?php echo $dukman_pagu ?>],
                    ['Realisasi : <?php echo angka($dukman_realisasi) ?>', <?php echo $dukman_realisasi ?>],
                ],
                type: 'donut' //,
                /*onclick: function (d, i) { console.log("onclick", d, i); },
                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
            },
            donut: {
                title: "<?php echo $dukman_persen ?>"
            },
            color: {
                pattern: colors
            }
        });

        var pmkg = c3.generate({
            bindto: "#pmkg",
            data: {
                // iris data from R
                columns: [
                    ['Pagu : <?php echo angka($pmkg_pagu) ?>', <?php echo $pmkg_pagu ?>],
                    ['Realisasi : <?php echo angka($pmkg_realisasi) ?>', <?php echo $pmkg_realisasi ?>],
                ],
                type: 'donut' //,
                /*onclick: function (d, i) { console.log("onclick", d, i); },
                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                onmouseout: function (d, i) { console.log("onmouseout", d, i); }*/
            },
            donut: {
                title: "<?php echo $pmkg_persen ?>"
            },
            color: {
                pattern: colors
            }
        });

        var barlineCombine = function() {
            var pr_kegiatan = {
                "pr_kegiatan_array": <?php echo json_encode($real_bulanan) ?>
            };
            var labels = pr_kegiatan.pr_kegiatan_array.map(function(e) {
                return e.bulan;
            });
            var pagu = pr_kegiatan.pr_kegiatan_array.map(function(e) {
                return e.pagu;
            });
            var realisasi = pr_kegiatan.pr_kegiatan_array.map(function(e) {
                return e.realisasi;
            });
            var realisasi_fisik = pr_kegiatan.pr_kegiatan_array.map(function(e) {
                return e.realisasi_fisik;
            });
            var barlineCombineData = {
                labels: labels,
                datasets: [{
                        type: 'line',
                        label: 'Realisasi Th. 21',
                        borderColor: myapp_get_color.danger_300,
                        pointBackgroundColor: myapp_get_color.danger_500,
                        pointBorderColor: myapp_get_color.danger_500,
                        pointBorderWidth: 1,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        fill: false,
                        data: realisasi
                    },
                    {
                        type: 'bar',
                        label: 'Pagu Th. 22',
                        backgroundColor: myapp_get_color.primary_300,
                        borderColor: myapp_get_color.primary_500,
                        data: pagu,
                        borderWidth: 1
                    },
                    {
                        type: 'bar',
                        label: 'Realisasi Anggaran Th. 22',
                        backgroundColor: myapp_get_color.success_300,
                        borderColor: myapp_get_color.success_500,
                        data: realisasi,
                        borderWidth: 1
                    },
                    {
                        type: 'bar',
                        label: 'Realisasi Fisik Th. 22',
                        backgroundColor: myapp_get_color.warning_300,
                        borderColor: myapp_get_color.warning_500,
                        data: realisasi_fisik,
                        borderWidth: 1
                    }
                ]

            };
            var config = {
                type: 'bar',
                data: barlineCombineData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Bar Chart'
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
                    },
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
                                        scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                    ctx.fillStyle = '#444';
                                    var y_pos = model.y - 5;
                                    // Make sure data value does not get overflown and hidden
                                    // when the bar's value is too close to max value of scale
                                    // Note: The y value is reverse, it counts from top down
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText(dataset.data[i], model.x, y_pos);
                                }
                            });
                        }
                    }
                }
            }
            new Chart($("#barlineCombine > canvas").get(0).getContext("2d"), config);
        }

        var barChart = function() {
            var pr_kegiatan = {
                "pr_kegiatan_array": <?php echo json_encode($real_kegiatan) ?>
            };
            var labels = pr_kegiatan.pr_kegiatan_array.map(function(e) {
                return e.nama;
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
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: 'Bar Chart'
                    },
                    tooltips: {
                        callbacks: {
                            label: function(t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = t.yLabel >= 1000 ? '' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                                return xLabel + ': ' + yLabel;
                            }
                        }
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
                            display: false,
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
                                fontSize: 11,
                                callback: function(value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return '' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return '' + value;
                                    }
                                }
                            }
                        }]
                    },
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
                                        scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                    ctx.fillStyle = '#444';
                                    var y_pos = model.y - 5;
                                    // Make sure data value does not get overflown and hidden
                                    // when the bar's value is too close to max value of scale
                                    // Note: The y value is reverse, it counts from top down
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText('' + dataset.data[i].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."), model.x, y_pos);
                                    //ctx.fillText('' + dataset.data[i], model.x, y_pos);
                                }
                            });
                        }
                    }
                }
            }
            new Chart($("#barChart > canvas").get(0).getContext("2d"), config);
        }
        var barChart2 = function() {
            var pr_kegiatan = {
                "pr_kegiatan_array": <?php echo json_encode($sumber_dana) ?>
            };
            var labels = pr_kegiatan.pr_kegiatan_array.map(function(e) {
                return e.nama;
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
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: 'Bar Chart'
                    },
                    tooltips: {
                        callbacks: {
                            label: function(t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = t.yLabel >= 1000 ? '' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                                return xLabel + ': ' + yLabel;
                            }
                        }
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
                            display: false,
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
                                fontSize: 11,
                                callback: function(value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return '' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return '' + value;
                                    }
                                }
                            }
                        }]
                    },
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
                                        scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                    ctx.fillStyle = '#444';
                                    var y_pos = model.y - 5;
                                    // Make sure data value does not get overflown and hidden
                                    // when the bar's value is too close to max value of scale
                                    // Note: The y value is reverse, it counts from top down
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText('' + dataset.data[i].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."), model.x, y_pos);
                                    //ctx.fillText('' + dataset.data[i], model.x, y_pos);
                                }
                            });
                        }
                    }
                }
            }
            new Chart($("#barChart2 > canvas").get(0).getContext("2d"), config);
        }
        $(document).ready(function() {
            $('#example').DataTable({
                scrollY: '200px',
                scrollCollapse: true,
                paging: false,
            });
            $('#example2').DataTable({
                scrollY: '200px',
                scrollCollapse: true,
                paging: false,
            });
            barlineCombine();
            barChart();
            barChart2();
        });
    </script>

</body>

</html>