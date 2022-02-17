<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Dipa Read</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="text-center">
                            <h3>Tahun Anggaran <?php echo $tahun_anggaran; ?></h3>
                        </div>
                        <table class="table tabl-clean">
                            <tr>
                                <td>Nama Satker</td>
                                <td><?php echo $nama_satker; ?></td>
                            </tr>
                            <tr>
                                <td>Kode Unit Kerja</td>
                                <td><?php echo $nama_unit_kerja; ?></td>
                            </tr>
                            <tr>
                                <td>No Dipa</td>
                                <td><?php echo $no_dipa; ?></td>
                            </tr>
                            <tr>
                                <td>Pagu</td>
                                <td><?php echo $pagu; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Dipa Read</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                            <thead class="thead-themed">
                                <tr>
                                    <th class="text-center" rowspan="2">KODE</th>
                                    <th class="text-center" rowspan="2">PROGRAM/KEGIATAN/OUTPUT/SUB OUTPUT/KOMPONEN/</th>
                                    <th class="text-center" rowspan="2">VOLUME</th>
                                    <th class="text-center" rowspan="2">PAGU PER JENIS</th>
                                    <th class="text-center" rowspan="2">BOBOT</th>
                                    <th class="text-center" rowspan="2">NILAI KUM</th>
                                    <th class="text-center" colspan="2">REALISASI KEU.KUMULATIF</th>
                                    <th class="text-center" colspan="2">% PROSENTASE</th>
                                    <th class="text-center" colspan="2">SISA PAGU</th>
                                    <th class="text-center" rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-center">RUPIAH</th>
                                    <th class="text-center">PROSEN</th>
                                    <th class="text-center">PER KEG.</th>
                                    <th class="text-center">THD SELURUH</th>
                                    <th class="text-center">RUPIAH</th>
                                    <th class="text-center">PROSEN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">2</td>
                                    <td class="text-center">3</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">5</td>
                                    <td class="text-center">6</td>
                                    <td class="text-center">7</td>
                                    <td class="text-center">8</td>
                                    <td class="text-center">9</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>