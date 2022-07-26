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
                <?php //if ($this->session->userdata('id_user_level') != 1) { ?>
                   <td></td>
                    <!-- <td width="100px"></td>-->
                <?php //} ?>
            </tr>
            <!-- program -->
            <?php
            $this->db->select('a.*,sum(d.pagu) as total, sum(d.real_januari) as ttl_januari, sum(d.real_februari) as ttl_februari, sum(d.real_maret) as ttl_maret, sum(d.real_april) as ttl_april, sum(d.real_mei) as ttl_mei, sum(d.real_juni) as ttl_juni, sum(d.real_juli) as ttl_juli, sum(d.real_agustus) as ttl_agustus, sum(d.real_september) as ttl_september, sum(d.real_november) as ttl_november, sum(d.real_oktober) as ttl_oktober, sum(d.real_desember) as ttl_desember');
            $this->db->from('t_program a');
			$this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
            $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
			$this->db->join('v_pagu_realisasi_omspan d', ' d.kode_dept=a.kode_dept and a.tahun_anggaran=d.tahun_anggaran and a.kode_unit_kerja=d.kode_unit_kerja and a.kode_program=d.kode_program', 'LEFT');

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
                $this->db->select('a.*,sum(d.pagu) as total, sum(d.real_januari) as ttl_januari, sum(d.real_februari) as ttl_februari, sum(d.real_maret) as ttl_maret, sum(d.real_april) as ttl_april, sum(d.real_mei) as ttl_mei, sum(d.real_juni) as ttl_juni, sum(d.real_juli) as ttl_juli, sum(d.real_agustus) as ttl_agustus, sum(d.real_september) as ttl_september, sum(d.real_november) as ttl_november, sum(d.real_oktober) as ttl_oktober, sum(d.real_desember) as ttl_desember');
                $this->db->from('t_kegiatan a');
                $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
				$this->db->join('v_pagu_realisasi_omspan d', 'd.kode_kegiatan=a.kode_kegiatan and  a.tahun_anggaran=d.tahun_anggaran and a.kode_unit_kerja=d.kode_unit_kerja and a.kode_program=d.kode_program', 'LEFT');

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
                    $this->db->select('a.*,sum(d.pagu) as total, sum(d.real_januari) as ttl_januari, sum(d.real_februari) as ttl_februari, sum(d.real_maret) as ttl_maret, sum(d.real_april) as ttl_april, sum(d.real_mei) as ttl_mei, sum(d.real_juni) as ttl_juni, sum(d.real_juli) as ttl_juli, sum(d.real_agustus) as ttl_agustus, sum(d.real_september) as ttl_september, sum(d.real_november) as ttl_november, sum(d.real_oktober) as ttl_oktober, sum(d.real_desember) as ttl_desember');
                    $this->db->from('t_output a');
                    $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                    $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
					$this->db->join('v_pagu_realisasi_omspan d', 'd.kode_kro=a.kode_kro 
                                                     and d.kode_kegiatan=a.kode_kegiatan and d.kode_dept=a.kode_dept and a.tahun_anggaran=d.tahun_anggaran and a.kode_unit_kerja=d.kode_unit_kerja and a.kode_program=d.kode_program', 'LEFT');

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

                          
                                
                                    <!-- Akun-->
                                    <?php
                                    $this->db->select('a.*,sum(d.pagu) as total, sum(d.real_januari) as ttl_januari, sum(d.real_februari) as ttl_februari, sum(d.real_maret) as ttl_maret, sum(d.real_april) as ttl_april, sum(d.real_mei) as ttl_mei, sum(d.real_juni) as ttl_juni, sum(d.real_juli) as ttl_juli, sum(d.real_agustus) as ttl_agustus, sum(d.real_september) as ttl_september, sum(d.real_november) as ttl_november, sum(d.real_oktober) as ttl_oktober, sum(d.real_desember) as ttl_desember');
                                    $this->db->from('t_akun a');
                                    $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_akun=b.kode_akun and a.kode_komponen_sub=b.kode_komponen_sub and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
                                    $this->db->join('v_pagu_realisasi_omspan d', 'd.kode_akun=a.kode_akun and d.kode_kro=a.kode_kro and d.kode_beban=a.kode_beban
                                                     and d.kode_kegiatan=a.kode_kegiatan and d.kode_dept=a.kode_dept and a.tahun_anggaran=d.tahun_anggaran and a.kode_unit_kerja=d.kode_unit_kerja and a.kode_program=d.kode_program', 'LEFT');

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
											
                                            <?php if ($this->session->userdata('id_user_level') == 1) { ?>
                                                <td></td>
                                           
                                            <?php }else{ ?>
											<td>
                                               <button type="button" subkom="<?php echo $akun->kode_komponen_sub ?>" kom="<?php echo $akun->kode_komponen ?>" 
											   ro="<?php echo $akun->kode_ro ?>" kro="<?php echo $akun->kode_kro ?>" tahun="<?php echo $akun->tahun_anggaran ?>" 
											   kegiatan="<?php echo $akun->kode_kegiatan ?>"
											   key="<?php echo $akun->kode_akun ?>" program="<?php echo $akun->kode_program ?>" satker="<?php echo $akun->kode_satker ?>" onClick=""
											   class="realisasi btn btn-xs btn-success">Realisasi Fisik</button>
                                            </td>
											<?php } ?>
                                        </tr>
                              
                                       
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>



<!-- Modal Rencana Realisasi-->
<div class="modal fade" id="Realisasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Realisasi Fisik</h4>
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
                scrollY: "400px",
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
    $('.realisasi').click(function() {
        var pok = <?php echo $this->uri->segment(3) ?>;
        var id = $(this).attr("key");
        var kom = $(this).attr("kom");
        var ro = $(this).attr("ro");
        var kro = $(this).attr("kro");
        var kegiatan = $(this).attr("kegiatan");
        var subkom = $(this).attr("subkom");
        var program = $(this).attr("program");
        var tahun = $(this).attr("tahun");
        var satker = $(this).attr("satker");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_realisasi_fisik',
            method: 'post',
            data: {
                kom: kom,
                ro: ro,
                kro: kro,
                kegiatan: kegiatan,
                subkom: subkom,
                tahun: tahun,
                satker: satker,
                program: program,
                pok: pok,
                id: id
            },
            success: function(data) {
                $('#Realisasi').modal("show");
                $('#Realisasi_modal').html(data);
            }
        });
    });
</script>