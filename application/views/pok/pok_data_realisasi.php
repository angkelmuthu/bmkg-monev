<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/datagrid/datatables/datatables.bundle.css">
<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<div class="modal fade" id="default-example-modal" role="dialog" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <form action="" method="post"> -->
            <div class="modal-header">
                <h4 class="modal-title">
                    Kegiatan
                    <small class="m-0 text-muted">
                        Pilih kegiatan dibawah untuk menambah
                    </small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <form method="post" id="form_kegiatan">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="new" value="N">
                        <label class="form-label" for="single-default">
                            Kegiatan
                        </label>
                        <select name="kode_kegiatan" id="kode_kegiatan" class="select2 form-control w-100" required="">
                            <?php
                            $this->db->where('kode_dept', $kode_dept);
                            $this->db->where('kode_unit_kerja', $kode_unit_kerja);
                            $this->db->order_by('kode_kegiatan', 'ASC');
                            $row_keg = $this->db->get('ref_kegiatan')->result();
                            foreach ($row_keg as $keg) { ?>
                                <option value="<?php echo $keg->kode_kegiatan ?>"><?php echo $keg->kode_kegiatan . '-' . $keg->nama_kegiatan ?></option>
                            <?php } ?>
                        </select>
                        <?php //echo select2_custom_2('kode_kegiatan', 'ref_kegiatan', 'kode_kegiatan', 'kode_kegiatan', 'nama_kegiatan', 'kode_dept="' . $this->session->userdata("kode_dept") . '" and kode_unit_kerja="' . $this->session->userdata("kode_unit_kerja") . '"', 'aktif="y"', 'nama_kegiatan ASC')
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="tambah_kegiatan" type="button" class="btn btn-warning" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div>
    <table class="table table-sm table-bordered table-hover table-striped" id="dt-basic-example">
        <thead class="thead-themed">
            <tr>
                <th class="text-center" rowspan="2"></th>
                <th class="text-center" rowspan="2">Kode</th>
                <th class="text-center" rowspan="2">Program/Kegiatan/Output/Komponen/Sub Komponen/Akun/Detil</th>
                <th class="text-center" colspan="2">Rincian Perhitungan</th>
                <th class="text-center" rowspan="2">Harga satuan</th>
                <th class="text-center" rowspan="2">PAGU</th>

                <th class="text-center" colspan="12">Realisasi</th>
                <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                   <th class="text-center" rowspan="2"></th>
                   <!--  <th class="text-center" rowspan="2" width="100px">Aksi</th> -->
                <?php } ?>

            </tr>
            <tr>
                <th class="text-center">Vol</th>
                <th class="text-center">Sat</th>
                <th class="text-right">Januari</th>
                <th class="text-right">Februari</th>
                <th class="text-right">Maret</th>
                <th class="text-right">April</th>
                <th class="text-right">Mei</th>
                <th class="text-right">Juni</th>
                <th class="text-right">Juli</th>
                <th class="text-right">Agustus</th>
                <th class="text-right">September</th>
                <th class="text-right">Oktober</th>
                <th class="text-right">November</th>
                <th class="text-right">Desember</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"></td>
                <td class="text-center">1</td>
                <td class="text-center">2</td>
                <td class="text-center">3</td>
                <td class="text-center">4</td>
                <td class="text-center">5</td>
                <td class="text-center">6</td>

                <td class="text-center">7</td>
                <td class="text-center">8</td>
                <td class="text-center">9</td>
                <td class="text-center">10</td>
                <td class="text-center">11</td>
                <td class="text-center">12</td>
                <td class="text-center">13</td>
                <td class="text-center">14</td>
                <td class="text-center">15</td>
                <td class="text-center">16</td>
                <td class="text-center">17</td>
                <td class="text-center">18</td>
                <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                   <td></td>
                    <!-- <td width="100px"></td>-->
                <?php } ?>
            </tr>
            <!-- program -->
            <?php
            $this->db->select('a.*,
        (SELECT count(*) FROM t_kegiatan c
        WHERE`a`.`kode_dept` = `c`.`kode_dept`
        AND `a`.`kode_unit_kerja` = `c`.`kode_unit_kerja`
        AND `a`.`kode_satker` = `c`.`kode_satker`
        AND `a`.`tahun_anggaran` = `c`.`tahun_anggaran`
        AND `a`.`kode_program` = `c`.`kode_program`) as anak
        ,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
            $this->db->from('t_program a');
			$this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
            $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
            $this->db->where('a.kode_dept', $kode_dept);
            $this->db->where('a.kode_unit_kerja', $kode_unit_kerja);
            $this->db->where('a.kode_satker', $kode_satker);
            $this->db->where('a.tahun_anggaran', $tahun_anggaran);
            $this->db->group_by('a.kode_program');
            //$this->db->order_by('create_date', 'ASC');
            //$q = $this->db->get();
            //var_dump($q);
            $list_program = $this->db->get()->result();
            foreach ($list_program as $program) { ?>
                <tr>
                    <td class="text-center"><span class="badge badge-success">Program</span></td>
                    <td class="text-right"><?php echo $program->kode_dept . '.' . $program->kode_unit_kerja . '.' . $program->kode_program ?></td>
                    <td class="text-left fw-700"><?php echo $program->nama_program ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right fw-700"><?php echo angka($program->total) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_januari) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_februari) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_maret) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_april) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_mei) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_juni) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_juli) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_agustus) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_september) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_oktober) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_november) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->ttl_desember) ?></td>
                    <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                        <td></td>
                       <!-- <td width="100px">
                            <div class="text-center">
                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-program-<?php echo $program->id_program ?>"><i class="fal fa-trash"></i></button>
                            </div>
                            <div class="modal fade" id="hapus-program-<?php echo $program->id_program ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <?php if ($program->anak > 0) { ?>
                                            <div class="modal-body">
                                                <p>Maaf, data tidak bisa dihapus</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                            </div>
                                        <?php } else { ?>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                <button key="<?php echo $program->id_program ?>" type=" button" class="hapus-program btn btn-primary">Ya, Hapus</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </td>-->
                    <?php } ?>
                </tr>
                <!-- kegiatan -->
                <?php
                $this->db->select('a.*,
            (SELECT count(*) FROM t_output c
            WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
            ,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
                $this->db->from('t_kegiatan a');
                $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
				$this->db->where('a.kode_program', $program->kode_program);
                $this->db->where('a.kode_dept', $program->kode_dept);
                $this->db->where('a.kode_unit_kerja', $program->kode_unit_kerja);
                $this->db->where('a.kode_satker', $program->kode_satker);
                $this->db->where('a.tahun_anggaran', $program->tahun_anggaran);
                $this->db->group_by('a.kode_kegiatan');
                $list_kegiatan = $this->db->get()->result();
                foreach ($list_kegiatan as $kegiatan) { ?>
                    <tr>
                        <td class="text-center"><span class="badge badge-success">Kegiatan</span></td>
                        <td class="text-right"><?php echo $kegiatan->kode_kegiatan ?></td>
                        <td class="text-left fw-500"><?php echo $kegiatan->nama_kegiatan ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->total) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_januari) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_februari) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_maret) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_april) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_mei) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_juni) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_juli) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_agustus) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_september) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_oktober) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_november) ?></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->ttl_desember) ?></td>
                        <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                            <td></td>
                          <!--  <td width="100px">
                                <div class="text-center">
                                    <button type="button" kode_dept="<?php echo $kegiatan->kode_dept; ?>" kode_unit_kerja="<?php echo $kegiatan->kode_unit_kerja; ?>" kode_kegiatan="<?php echo $kegiatan->kode_kegiatan; ?>" class="kro btn btn-xs btn-info"><i class="fal fa-plus-square"></i></button>

                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-kegiatan-<?php echo $kegiatan->id_kegiatan ?>"><i class="fal fa-trash"></i></button>
                                    <div class="modal fade" id="hapus-kegiatan-<?php echo $kegiatan->id_kegiatan ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <?php if ($kegiatan->anak > 0) { ?>
                                                    <div class="modal-body">
                                                        <p>Maaf, data tidak bisa dihapus</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <button key="<?php echo $kegiatan->id_kegiatan ?>" type=" button" class="hapus-kegiatan btn btn-primary">Ya, Hapus</button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>-->
                        <?php } ?>
                    </tr>
                    <!-- kro -->
                    <?php
                    $this->db->select('a.*,
                (SELECT count(*) FROM t_output_sub c
                WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                ,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
                    $this->db->from('t_output a');
                    $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                    $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
					$this->db->where('a.kode_kegiatan', $kegiatan->kode_kegiatan);
                    $this->db->where('a.kode_program', $program->kode_program);
                    $this->db->where('a.kode_dept', $program->kode_dept);
                    $this->db->where('a.kode_unit_kerja', $program->kode_unit_kerja);
                    $this->db->where('a.kode_satker', $program->kode_satker);
                    $this->db->where('a.tahun_anggaran', $program->tahun_anggaran);
                    $this->db->group_by('a.kode_kro');
                    $list_kro = $this->db->get()->result();

                    foreach ($list_kro as $kro) { ?>
                        <tr>
                            <td class="text-center"><span class="badge badge-success">KRO</span></td>
                            <td class="text-right"><?php echo $kro->kode_kro ?></td>
                            <td class="text-left"><i class="fal fa-angle-right mr-1"></i><?php echo $kro->nama_kro ?></td>
                            <td class="text-center"><?php echo $kro->volume ?></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><?php echo angka($kro->total) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_januari) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_februari) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_maret) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_april) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_mei) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_juni) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_juli) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_agustus) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_september) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_oktober) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_november) ?></td>
                            <td class="text-right"><?php echo angka($kro->ttl_desember) ?></td>
                            <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                <td></td>
                               <!-- <td>
                                    <div class="text-center">
                                        <button type="button" kode_dept="<?php echo $kro->kode_dept; ?>" kode_unit_kerja="<?php echo $kro->kode_unit_kerja; ?>" kode_kegiatan="<?php echo $kro->kode_kegiatan; ?>" kode_kro="<?php echo $kro->kode_kro; ?>" class="ro btn btn-xs btn-info"><i class="fal fa-plus-square"></i></button>

                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-kro-<?php echo $kro->id_kro ?>"><i class="fal fa-trash"></i></button>
                                        <div class="modal fade" id="hapus-kro-<?php echo $kro->id_kro ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                        </button>
                                                    </div>
                                                    <?php if ($kro->anak > 0) { ?>
                                                        <div class="modal-body">
                                                            <p>Maaf, data tidak bisa dihapus</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                            <button key="<?php echo $kro->id_kro ?>" type=" button" class="hapus-kro btn btn-primary">Ya, Hapus</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>-->
                            <?php } ?>
                        </tr>
                        <!-- ro -->
                        <?php
                        $this->db->select('a.*,
                    (SELECT count(*) FROM t_output_sub c
                    WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_ro=c.kode_ro and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                    ,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
                        $this->db->from('t_output_sub a');
                        $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                        $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
					    $this->db->where('a.kode_kro', $kro->kode_kro);
                        $this->db->where('a.kode_kegiatan', $kegiatan->kode_kegiatan);
                        $this->db->where('a.kode_program', $program->kode_program);
                        $this->db->where('a.kode_dept', $program->kode_dept);
                        $this->db->where('a.kode_unit_kerja', $program->kode_unit_kerja);
                        $this->db->where('a.kode_satker', $program->kode_satker);
                        $this->db->where('a.tahun_anggaran', $program->tahun_anggaran);
                        $this->db->group_by('a.kode_ro');
                        $list_ro = $this->db->get()->result();
                        foreach ($list_ro as $ro) { ?>
                            <tr>
                                <td class="text-center"><span class="badge badge-success">RO</span></td>
                                <td class="text-right"><?php echo $ro->kode_ro ?></td>
                                <td class="text-left"><i class="fal fa-angle-right ml-1 mr-1"> <?php echo $ro->nama_ro ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><?php echo angka($ro->total) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_januari) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_februari) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_maret) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_april) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_mei) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_juni) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_juli) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_agustus) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_september) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_oktober) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_november) ?></td>
                                <td class="text-right"><?php echo angka($ro->ttl_desember) ?></td>
                                <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                    <td></td>
                                   <!-- <td width="100px">
                                        <div class="text-center">
                                            <button type="button" kode_dept="<?php echo $ro->kode_dept; ?>" kode_unit_kerja="<?php echo $ro->kode_unit_kerja; ?>" kode_kegiatan="<?php echo $ro->kode_kegiatan; ?>" kode_kro="<?php echo $ro->kode_kro; ?>" kode_ro="<?php echo $ro->kode_ro; ?>" class="komponen btn btn-xs btn-info"><i class="fal fa-plus-square"></i></button>

                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-ro-<?php echo $ro->id_ro ?>"><i class="fal fa-trash"></i></button>
                                            <div class="modal fade" id="hapus-ro-<?php echo $ro->id_ro ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>
                                                        <?php if ($ro->anak > 0) { ?>
                                                            <div class="modal-body">
                                                                <p>Maaf, data tidak bisa dihapus</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="modal-body">
                                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                <button key="<?php echo $ro->id_ro ?>" type=" button" class="hapus-ro btn btn-primary">Ya, Hapus</button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>-->
                                <?php } ?>
                            </tr>
                            <!-- komponen -->
                            <?php
                            $this->db->select('a.*,
                        (SELECT count(*) FROM t_komponen_sub c
                        WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_komponen=c.kode_komponen and a.kode_ro=c.kode_ro and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                        ,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
                            $this->db->from('t_komponen a');
                            $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                           $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
						   $this->db->where('a.kode_ro', $ro->kode_ro);
                            $this->db->where('a.kode_kro', $kro->kode_kro);
                            $this->db->where('a.kode_kegiatan', $kegiatan->kode_kegiatan);
                            $this->db->where('a.kode_program', $program->kode_program);
                            $this->db->where('a.kode_dept', $program->kode_dept);
                            $this->db->where('a.kode_unit_kerja', $program->kode_unit_kerja);
                            $this->db->where('a.kode_satker', $program->kode_satker);
                            $this->db->where('a.tahun_anggaran', $program->tahun_anggaran);
                            $this->db->group_by('a.kode_komponen');
                            $list_komponen = $this->db->get()->result();
                            foreach ($list_komponen as $komponen) { ?>
                                <tr>
                                    <td class="text-center"><span class="badge badge-success">Komponen</span></td>
                                    <td class="text-right"><?php echo $komponen->kode_komponen ?></td>
                                    <td class="text-left"><i class="fal fa-angle-right ml-2 mr-1"> <?php echo $komponen->nama_komponen ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><?php echo angka($komponen->total) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_januari) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_februari) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_maret) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_april) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_mei) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_juni) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_juli) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_agustus) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_september) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_oktober) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_november) ?></td>
                                    <td class="text-right"><?php echo angka($komponen->ttl_desember) ?></td>
                                    <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                        <td></td>
                                      <!--  <td width="100px">
                                            <div class="text-center">
                                                <button type="button" kode_dept="<?php echo $komponen->kode_dept; ?>" kode_unit_kerja="<?php echo $komponen->kode_unit_kerja; ?>" kode_kegiatan="<?php echo $komponen->kode_kegiatan; ?>" kode_kro="<?php echo $komponen->kode_kro; ?>" kode_ro="<?php echo $komponen->kode_ro; ?>" kode_komponen="<?php echo $komponen->kode_komponen; ?>" class="komponen_sub btn btn-xs btn-info"><i class="fal fa-plus-square"></i></button>

                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-komponen-<?php echo $komponen->id_komponen ?>"><i class="fal fa-trash"></i></button>
                                                <div class="modal fade" id="hapus-komponen-<?php echo $komponen->id_komponen ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                </button>
                                                            </div>
                                                            <?php if ($komponen->anak > 0) { ?>
                                                                <div class="modal-body">
                                                                    <p>Maaf, data tidak bisa dihapus</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                    <button key="<?php echo $komponen->id_komponen ?>" type=" button" class="hapus-komponen btn btn-primary">Ya, Hapus</button>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>-->
                                    <?php } ?>
                                </tr>
                                <!-- komponen sub -->
                                <?php
                                $this->db->select('a.*,
                            (SELECT count(*) FROM t_akun c
                            WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_komponen_sub=c.kode_komponen_sub and a.kode_komponen=c.kode_komponen and a.kode_ro=c.kode_ro and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                            ,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
                                $this->db->from('t_komponen_sub a');
                                $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_komponen_sub=b.kode_komponen_sub and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                              $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
							  $this->db->where('a.kode_komponen', $komponen->kode_komponen);
                                $this->db->where('a.kode_ro', $ro->kode_ro);
                                $this->db->where('a.kode_kro', $kro->kode_kro);
                                $this->db->where('a.kode_kegiatan', $kegiatan->kode_kegiatan);
                                $this->db->where('a.kode_program', $program->kode_program);
                                $this->db->where('a.kode_dept', $program->kode_dept);
                                $this->db->where('a.kode_unit_kerja', $program->kode_unit_kerja);
                                $this->db->where('a.kode_satker', $program->kode_satker);
                                $this->db->where('a.tahun_anggaran', $program->tahun_anggaran);
                                $this->db->group_by('a.kode_komponen_sub');
                                $list_komponen_sub = $this->db->get()->result();
                                foreach ($list_komponen_sub as $komponen_sub) { ?>
                                    <tr>
                                        <td class="text-center"><span class="badge badge-success">Sub Komponen</span></td>
                                        <td class="text-right"><?php echo $komponen_sub->kode_komponen_sub ?></td>
                                        <td class="text-left"><i class="fal fa-angle-right ml-3 mr-1"> <?php echo $komponen_sub->nama_komponen_sub ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->total) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_januari) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_februari) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_maret) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_april) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_mei) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_juni) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_juli) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_agustus) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_september) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_oktober) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_november) ?></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->ttl_desember) ?></td>
                                        <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                            <td></td>
                                        <!--    <td width="100px">
                                                <div class="text-center">
                                                    <button type="button" kode_dept="<?php echo $komponen_sub->kode_dept; ?>" kode_unit_kerja="<?php echo $komponen_sub->kode_unit_kerja; ?>" kode_program="<?php echo $komponen_sub->kode_program; ?>" kode_kegiatan="<?php echo $komponen_sub->kode_kegiatan; ?>" kode_kro="<?php echo $komponen_sub->kode_kro; ?>" kode_ro="<?php echo $komponen_sub->kode_ro; ?>" kode_komponen="<?php echo $komponen_sub->kode_komponen; ?>" kode_komponen_sub="<?php echo $komponen_sub->kode_komponen_sub; ?>" class="akun btn btn-xs btn-info"><i class="fal fa-plus-square"></i></button>

                                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-komponensub-<?php echo $komponen_sub->id_komponen_sub ?>"><i class="fal fa-trash"></i></button>

                                                    <div class="modal fade" id="hapus-komponensub-<?php echo $komponen_sub->id_komponen_sub ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                    </button>
                                                                </div>
                                                                <?php if ($komponen_sub->anak > 0) { ?>
                                                                    <div class="modal-body">
                                                                        <p>Maaf, data tidak bisa dihapus</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="modal-body">
                                                                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                        <button key="<?php echo $komponen_sub->id_komponen_sub ?>" type=" button" class="hapus-komponensub btn btn-primary">Ya, Hapus</button>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>-->
                                        <?php } ?>
                                    </tr>
                                    <!-- Akun-->
                                    <?php
                                    $this->db->select('a.*,count(b.id_item) as anak,sum(b.jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
                                    $this->db->from('t_akun a');
                                    $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_akun=b.kode_akun and a.kode_komponen_sub=b.kode_komponen_sub and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                                    $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
									$this->db->where('a.kode_komponen_sub', $komponen_sub->kode_komponen_sub);
                                    $this->db->where('a.kode_komponen', $komponen->kode_komponen);
                                    $this->db->where('a.kode_ro', $ro->kode_ro);
                                    $this->db->where('a.kode_kro', $kro->kode_kro);
                                    $this->db->where('a.kode_kegiatan', $kegiatan->kode_kegiatan);
                                    $this->db->where('a.kode_program', $program->kode_program);
                                    $this->db->where('a.kode_dept', $program->kode_dept);
                                    $this->db->where('a.kode_unit_kerja', $program->kode_unit_kerja);
                                    $this->db->where('a.kode_satker', $program->kode_satker);
                                    $this->db->where('a.tahun_anggaran', $program->tahun_anggaran);
                                    $this->db->group_by('a.kode_akun');
                                    $list_akun = $this->db->get()->result();
                                    foreach ($list_akun as $akun) { ?>
                                        <tr>
                                            <td class="text-center"><span class="badge badge-success">Akun</span></td>
                                            <td class="text-right"><?php echo $akun->kode_akun ?></td>
                                            <td class="text-left"><i class="fal fa-angle-right ml-4 mr-1"> <?php echo $akun->nama_akun ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><?php echo angka($akun->total) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_januari) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_februari) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_maret) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_april) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_mei) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_juni) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_juli) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_agustus) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_september) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_oktober) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_november) ?></td>
                                            <td class="text-right"><?php echo angka($akun->ttl_desember) ?></td>
                                            <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                                <td></td>
                                              <!--  <td width="100px">
                                                    <div class="text-center">
                                                        <button type="button" kode_dept="<?php echo $akun->kode_dept; ?>" kode_unit_kerja="<?php echo $akun->kode_unit_kerja; ?>" kode_program="<?php echo $akun->kode_program; ?>" kode_kegiatan="<?php echo $akun->kode_kegiatan; ?>" kode_kro="<?php echo $akun->kode_kro; ?>" kode_ro="<?php echo $akun->kode_ro; ?>" kode_komponen="<?php echo $akun->kode_komponen; ?>" kode_komponen_sub="<?php echo $akun->kode_komponen_sub; ?>" kode_akun="<?php echo $akun->kode_akun; ?>" class="item btn btn-xs btn-info"><i class="fal fa-plus-square"></i></button>

                                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-akun-<?php echo $akun->id_akun ?>"><i class="fal fa-trash"></i></button>
                                                        <div class="modal fade" id="hapus-akun-<?php echo $akun->id_akun ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Data</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <?php if ($akun->anak > 0) { ?>
                                                                        <div class="modal-body">
                                                                            <p>Maaf, data tidak bisa dihapus</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="modal-body">
                                                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                            <button key="<?php echo $akun->id_akun ?>" type=" button" class="hapus-akun btn btn-primary">Ya, Hapus</button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>-->
                                            <?php } ?>
                                        </tr>
                                        <!-- Item-->
                                        <?php
                                        $this->db->select('a.*,sum(jumlah) as total,sum(c.ang_januari) as ttl_januari,sum(c.ang_februari) as ttl_februari,sum(c.ang_maret) as ttl_maret,sum(c.ang_april) as ttl_april,
										sum(c.ang_mei) as ttl_mei,sum(c.ang_juni) as ttl_juni,sum(c.ang_juli) as ttl_juli,sum(c.ang_agustus) as ttl_agustus,sum(c.ang_september) as ttl_september,sum(c.ang_november) as ttl_november,
										sum(c.ang_oktober) as ttl_oktober,sum(c.ang_desember) as ttl_desember');
										$this->db->from('t_item a');
                                        $this->db->join('t_item_realisasi c', 'c.id_item=a.id_item', 'LEFT');
									    $this->db->where('kode_akun', $akun->kode_akun);
                                        $this->db->where('kode_komponen_sub', $komponen_sub->kode_komponen_sub);
                                        $this->db->where('kode_komponen', $komponen->kode_komponen);
                                        $this->db->where('kode_ro', $ro->kode_ro);
                                        $this->db->where('kode_kro', $kro->kode_kro);
                                        $this->db->where('kode_kegiatan', $kegiatan->kode_kegiatan);
                                        $this->db->where('kode_program', $program->kode_program);
                                        $this->db->where('kode_dept', $program->kode_dept);
                                        $this->db->where('kode_unit_kerja', $program->kode_unit_kerja);
                                        $this->db->where('kode_satker', $program->kode_satker);
                                        $this->db->where('tahun_anggaran', $program->tahun_anggaran);
                                        $this->db->group_by('item_title');
                                        $this->db->order_by('id_item');
                                        $list_item_title = $this->db->get()->result();
										//$this->output->enable_profiler(TRUE);
                                        foreach ($list_item_title as $item_title) {
                                            if (!empty($item_title->item_title)) {
                                        ?>
                                                <tr>
                                                    <td class="text-center"><span class="badge badge-success">Judul Item</span></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-left"><i class="fal fa-angle-right ml-5 mr-1"> <?php echo $item_title->item_title ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><?php echo angka($item_title->total) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_januari) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_februari) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_maret) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_april) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_mei) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_juni) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_juli) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_agustus) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_september) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_oktober) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_november) ?></td>
                                                    <td class="text-right"><?php echo angka($item_title->ttl_desember) ?></td>
                                                    <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                                        <td></td>
                                                      <!--  <td width="100px"></td>-->
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <?php
											$this->db->select('a.*,sum(jumlah) as total,sum(c.ang_januari) as januari,sum(c.ang_februari) as februari,sum(c.ang_maret) as maret,sum(c.ang_april) as april,
										sum(c.ang_mei) as mei,sum(c.ang_juni) as juni,sum(c.ang_juli) as juli,sum(c.ang_agustus) as agustus,sum(c.ang_september) as september,sum(c.ang_november) as november,
										sum(c.ang_oktober) as oktober,sum(c.ang_desember) as desember');
										$this->db->from('t_item a');
                                        $this->db->join('t_item_realisasi c', 'c.id_item=a.id_item', 'LEFT');
                                            $this->db->where('a.item_title', $item_title->item_title);
                                            $this->db->where('kode_akun', $akun->kode_akun);
                                            $this->db->where('kode_komponen_sub', $komponen_sub->kode_komponen_sub);
                                            $this->db->where('kode_komponen', $komponen->kode_komponen);
                                            $this->db->where('kode_ro', $ro->kode_ro);
                                            $this->db->where('kode_kro', $kro->kode_kro);
                                            $this->db->where('kode_kegiatan', $kegiatan->kode_kegiatan);
                                            $this->db->where('kode_program', $program->kode_program);
                                            $this->db->where('kode_dept', $program->kode_dept);
                                            $this->db->where('kode_unit_kerja', $program->kode_unit_kerja);
                                            $this->db->where('kode_satker', $program->kode_satker);
                                            $this->db->where('tahun_anggaran', $program->tahun_anggaran);
                                            $this->db->group_by('a.id_item');
                                            $list_item = $this->db->get()->result();
                                            foreach ($list_item as $item) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><span class="badge badge-success">Item</span></td>
                                                    <td class="text-right"></td>
                                                    <?php if (!empty($item->item_title)) { ?>
                                                        <td class="text-left"><i class="fal fa-angle-right ml-6 mr-1"> <?php echo $item->item ?></td>
                                                    <?php } else { ?>
                                                        <td class="text-left"><i class="fal fa-angle-right ml-5 mr-1"> <?php echo $item->item ?></td>
                                                    <?php } ?>
                                                    <td class="text-center"><?php echo $item->volume ?></td>
                                                    <td class="text-center"><?php echo $item->satuan ?></td>
                                                    <td class="text-right"><?php echo angka($item->harga_satuan) ?></td>
                                                    <td class="text-right"><?php echo angka($item->jumlah) ?></td>
                                                    <td class="text-right"><?php echo angka($item->januari) ?></td>
                                                    <td class="text-right"><?php echo angka($item->februari) ?></td>
                                                    <td class="text-right"><?php echo angka($item->maret) ?></td>
                                                    <td class="text-right"><?php echo angka($item->april) ?></td>
                                                    <td class="text-right"><?php echo angka($item->mei) ?></td>
                                                    <td class="text-right"><?php echo angka($item->juni) ?></td>
                                                    <td class="text-right"><?php echo angka($item->juli) ?></td>
                                                    <td class="text-right"><?php echo angka($item->agustus) ?></td>
                                                    <td class="text-right"><?php echo angka($item->september) ?></td>
                                                    <td class="text-right"><?php echo angka($item->oktober) ?></td>
                                                    <td class="text-right"><?php echo angka($item->november) ?></td>
                                                    <td class="text-right"><?php echo angka($item->desember) ?></td>
                                                    <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                                        <td>
                                                            <button type="button" key="<?php echo $item->id_item ?>" class="realisasi btn btn-xs btn-success">Realisasi</button>
                                                        </td>
                                                        <!--<td width="100px">
                                                            <div class="text-center">
                                                                <button type="button" key="<?php echo $item->id_item ?>" class="edit-item btn btn-xs btn-warning"><i class="fal fa-pencil"></i></button>
                                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus-item-<?php echo $item->id_item ?>"><i class="fal fa-trash"></i></button>
                                                                <div class="modal fade" id="hapus-item-<?php echo $item->id_item ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Konfirmasi Data</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                                <button key="<?php echo $item->id_item ?>" type=" button" class="hapus-item btn btn-primary">Ya, Hapus</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>-->
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal kro -->
<div class="modal fade" id="Kro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kegiatan Rancangan Output</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Kro_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal ro -->
<div class="modal fade" id="Ro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Rancangan Output</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Ro_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal komponen -->
<div class="modal fade" id="Komponen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Komponen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Komponen_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal komponen Sub -->
<div class="modal fade" id="Komponen_sub" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Sub Komponen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Komponen_sub_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Akun -->
<div class="modal fade" id="Akun" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Akun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Akun_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Item -->
<div class="modal fade" id="Item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Item_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Item -->
<div class="modal fade" id="EditItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="EditItem_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rencana Realisasi-->
<div class="modal fade" id="Realisasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Realisasi Anggaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Realisasi_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<?php if ($this->session->userdata('id_user_level') != 1) { ?>
    <script>
        $(document).ready(function() {
            var table = $('#dt-basic-example').DataTable({
                scrollY: "500px",
                scrollX: true,
                scrollCollapse: true,
                ordering: false,
                paging: false,
                fixedColumns: {
                    leftColumns: 0,
                    rightColumns: 1
                }
            });
        });
    </script>
<?php } else { ?>
    <script>
        $(document).ready(function() {
            var table = $('#dt-basic-example').DataTable({
                scrollY: "500px",
                scrollX: true,
                scrollCollapse: true,
                ordering: false,
                paging: false,
                fixedColumns: {
                    leftColumns: 7,
                    rightColumns: 0
                }
            });
        });
    </script>
<?php } ?>
<script>
    $('#kode_kegiatan').select2({
        dropdownParent: $('#default-example-modal .modal-content')
    });
    // tambah kegiatan
    $("#tambah_kegiatan").click(function() {
        var data = $('#form_kegiatan').serialize();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/tambah_kegiatan",
            data: data,
            cache: false,
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                // $('#Item').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();
            }
        });
    });
    $('.kro').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_kro',
            method: 'post',
            data: {
                pok: pok,
                kode_dept: kode_dept,
                kode_unit_kerja: kode_unit_kerja,
                kode_kegiatan: kode_kegiatan
            },
            success: function(data) {
                $('#Kro').modal("show");
                $('#Kro_modal').html(data);
            }
        });
    });
    $('.ro').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_ro',
            method: 'post',
            data: {
                pok: pok,
                kode_dept: kode_dept,
                kode_unit_kerja: kode_unit_kerja,
                kode_kegiatan: kode_kegiatan,
                kode_kro: kode_kro
            },
            success: function(data) {
                $('#Ro').modal("show");
                $('#Ro_modal').html(data);
            }
        });
    });
    $('.komponen').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        var kode_ro = $(this).attr("kode_ro");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_komponen',
            method: 'post',
            data: {
                pok: pok,
                kode_dept: kode_dept,
                kode_unit_kerja: kode_unit_kerja,
                kode_kegiatan: kode_kegiatan,
                kode_kro: kode_kro,
                kode_ro: kode_ro
            },
            success: function(data) {
                $('#Komponen').modal("show");
                $('#Komponen_modal').html(data);
            }
        });
    });
    $('.komponen_sub').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        var kode_ro = $(this).attr("kode_ro");
        var kode_komponen = $(this).attr("kode_komponen");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_komponen_sub',
            method: 'post',
            data: {
                pok: pok,
                kode_dept: kode_dept,
                kode_unit_kerja: kode_unit_kerja,
                kode_kegiatan: kode_kegiatan,
                kode_kro: kode_kro,
                kode_ro: kode_ro,
                kode_komponen: kode_komponen
            },
            success: function(data) {
                $('#Komponen_sub').modal("show");
                $('#Komponen_sub_modal').html(data);
            }
        });
    });

    $('.akun').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_program = $(this).attr("kode_program");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        var kode_ro = $(this).attr("kode_ro");
        var kode_komponen = $(this).attr("kode_komponen");
        var kode_komponen_sub = $(this).attr("kode_komponen_sub");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_akun',
            method: 'post',
            data: {
                pok: pok,
                kode_dept: kode_dept,
                kode_unit_kerja: kode_unit_kerja,
                kode_program: kode_program,
                kode_kegiatan: kode_kegiatan,
                kode_kro: kode_kro,
                kode_ro: kode_ro,
                kode_komponen: kode_komponen,
                kode_komponen_sub: kode_komponen_sub
            },
            success: function(data) {
                $('#Akun').modal("show");
                $('#Akun_modal').html(data);
            }
        });
    });

    $('.item').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_program = $(this).attr("kode_program");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        var kode_ro = $(this).attr("kode_ro");
        var kode_komponen = $(this).attr("kode_komponen");
        var kode_komponen_sub = $(this).attr("kode_komponen_sub");
        var kode_akun = $(this).attr("kode_akun");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_item',
            method: 'post',
            data: {
                pok: pok,
                kode_dept: kode_dept,
                kode_unit_kerja: kode_unit_kerja,
                kode_program: kode_program,
                kode_kegiatan: kode_kegiatan,
                kode_kro: kode_kro,
                kode_ro: kode_ro,
                kode_komponen: kode_komponen,
                kode_komponen_sub: kode_komponen_sub,
                kode_akun: kode_akun
            },
            success: function(data) {
                $('#Item').modal("show");
                $('#Item_modal').html(data);
            }
        });
    });

    $('.edit-item').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var id = $(this).attr("key");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_item_update',
            method: 'post',
            data: {
                pok: pok,
                id: id
            },
            success: function(data) {
                $('#EditItem').modal("show");
                $('#EditItem_modal').html(data);
            }
        });
    });

    $('.realisasi').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var id = $(this).attr("key");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_realisasi',
            method: 'post',
            data: {
                pok: pok,
                id: id
            },
            success: function(data) {
                $('#Realisasi').modal("show");
                $('#Realisasi_modal').html(data);
            }
        });
    });

    $(".hapus-item").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_item",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-item').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-item').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });

    $(".hapus-akun").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_akun",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-akun').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-akun').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });

    $(".hapus-komponensub").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_komponensub",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-komponensub').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-komponensub').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });

    $(".hapus-komponen").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_komponen",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-komponen').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-komponen').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });

    $(".hapus-ro").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_ro",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-ro').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-ro').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });

    $(".hapus-kro").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_kro",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-kro').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-kro').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });


    $(".hapus-kegiatan").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_kegiatan",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-kegiatan').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-kegiatan').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });

    $(".hapus-program").click(function() {
        var key = $(this).attr("key");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/hapus_program",
            data: {
                id: key
            },
            success: function(data) {
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data/<?php echo $this->uri->segment(3) ?>");
                $('.hapus-program').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function() {
                $('.hapus-program').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });
</script>