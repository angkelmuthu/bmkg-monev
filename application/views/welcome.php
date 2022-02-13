<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/statistics/c3/c3.css">
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <?php
        $this->db->select("
	sum(IF( verifikasi_flag = 'Disetujui', 1, 0 )) AS setuju,
	sum(IF( verifikasi_flag = 'Revisi', 1, 0 )) AS revisi,
	sum(IF( verifikasi_flag = 'Ditolak', 1, 0 )) AS tolak,
	sum(IF( verifikasi_flag is null, 1, 0 )) AS belum");
        $this->db->from("t_resiko");
        $dt = $this->db->get()->row();
        ?>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php echo $dt->setuju ?>
                        <small class="m-0 l-h-n">Risk Register Disetujui</small>
                    </h3>
                </div>
                <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php echo $dt->revisi ?>
                        <small class="m-0 l-h-n">Risk Register Revisi</small>
                    </h3>
                </div>
                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php echo $dt->tolak ?>
                        <small class="m-0 l-h-n">Risk Register Ditolak</small>
                    </h3>
                </div>
                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php echo $dt->belum ?>
                        <small class="m-0 l-h-n">Risk Register Belum Divalidasi</small>
                    </h3>
                </div>
                <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-10" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Data Resiko Unit
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-themed">
                                <tr>
                                    <th>No</th>
                                    <th>Pemilik</th>
                                    <th>Total Risk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($ttl_risk as $dt) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $dt->nm_pj ?></td>
                                        <td><?php echo $dt->ttl ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div id="panel-10" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Peta Resiko Unit
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-themed">
                                <tr>
                                    <th>No</th>
                                    <th>Pemilik</th>
                                    <th>Sangat Rendah</th>
                                    <th>Rendah</th>
                                    <th>Sedang</th>
                                    <th>Tinggi</th>
                                    <th>Sangat Tinggi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($peta_risk as $dt) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $dt->nm_pj ?></td>
                                        <td><?php echo $dt->satu ?></td>
                                        <td><?php echo $dt->dua ?></td>
                                        <td><?php echo $dt->tiga ?></td>
                                        <td><?php echo $dt->empat ?></td>
                                        <td><?php echo $dt->lima ?></td>
                                    </tr>
                                <?php } ?>
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