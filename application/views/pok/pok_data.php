<div class="mt-4 mb-2">
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#default-example-modal"><i class="fal fa-plus-square"></i> Tambah Kegiatan</button>
</div>
<!-- Modal tambah program -->
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
                        <label class="form-label" for="single-default">
                            Kegiatan
                        </label>
                        <select name="kode_kegiatan" id="kode_kegiatan" class="select2 form-control w-100" required="">
                            <?php
                            $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
                            $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
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
<table class="table table-sm table-bordered table-hover table-striped w-100" id="dt-basic-example">
    <thead class="thead-themed">
        <tr>
            <th class="text-center" rowspan="2"></th>
            <th class="text-center" rowspan="2">Kode</th>
            <th class="text-center" rowspan="2">Program/Kegiatan/Output/Komponen/Sub Komponen/Akun/Detil</th>
            <th class="text-center" colspan="2">Rincian Perhitungan</th>
            <th class="text-center" rowspan="2">Harga satuan</th>
            <th class="text-center" rowspan="2">PAGU</th>
            <th class="text-center" rowspan="2"></th>
        </tr>
        <tr>
            <th class="text-center">Vol</th>
            <th class="text-center">Sat</th>
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
            <td></td>
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
        ,sum(b.jumlah) as total');
        $this->db->from('t_program a');
        $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
        $this->db->where('a.kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('a.kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('a.kode_satker', $this->session->userdata('kode_satker'));
        $this->db->where('a.tahun_anggaran', $this->session->userdata('ta'));
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
                <td>
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
                </td>
            </tr>
            <!-- kegiatan -->
            <?php
            $this->db->select('a.*,
            (SELECT count(*) FROM t_output c
            WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
            ,sum(b.jumlah) as total');
            $this->db->from('t_kegiatan a');
            $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
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
                    <td>
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
                    </td>
                </tr>
                <!-- kro -->
                <?php
                $this->db->select('a.*,
                (SELECT count(*) FROM t_output_sub c
                WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                ,sum(b.jumlah) as total');
                $this->db->from('t_output a');
                $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
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
                        <td>
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
                        </td>
                    </tr>
                    <!-- ro -->
                    <?php
                    $this->db->select('a.*,
                    (SELECT count(*) FROM t_output_sub c
                    WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_ro=c.kode_ro and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                    ,sum(b.jumlah) as total');
                    $this->db->from('t_output_sub a');
                    $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
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
                            <td>
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
                            </td>
                        </tr>
                        <!-- komponen -->
                        <?php
                        $this->db->select('a.*,
                        (SELECT count(*) FROM t_komponen_sub c
                        WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_komponen=c.kode_komponen and a.kode_ro=c.kode_ro and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                        ,sum(b.jumlah) as total');
                        $this->db->from('t_komponen a');
                        $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
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
                                <td>
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
                                </td>
                            </tr>
                            <!-- komponen sub -->
                            <?php
                            $this->db->select('a.*,
                            (SELECT count(*) FROM t_akun c
                            WHERE a.kode_dept=c.kode_dept and a.kode_unit_kerja=c.kode_unit_kerja and a.kode_satker=c.kode_satker and a.tahun_anggaran=c.tahun_anggaran and a.kode_komponen_sub=c.kode_komponen_sub and a.kode_komponen=c.kode_komponen and a.kode_ro=c.kode_ro and a.kode_kro=c.kode_kro and a.kode_kegiatan=c.kode_kegiatan and a.kode_program=c.kode_program) as anak
                            ,sum(b.jumlah) as total');
                            $this->db->from('t_komponen_sub a');
                            $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_komponen_sub=b.kode_komponen_sub and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
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
                                    <td>
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
                                    </td>
                                </tr>
                                <!-- Akun-->
                                <?php
                                $this->db->select('a.*,count(b.id_item) as anak,sum(b.jumlah) as total');
                                $this->db->from('t_akun a');
                                $this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_akun=b.kode_akun and a.kode_komponen_sub=b.kode_komponen_sub and a.kode_komponen=b.kode_komponen and a.kode_ro=b.kode_ro and a.kode_kro=b.kode_kro and a.kode_kegiatan=b.kode_kegiatan and a.kode_program=b.kode_program', 'LEFT');
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
                                        <td>
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
                                        </td>
                                    </tr>
                                    <!-- Item-->
                                    <?php
                                    $this->db->select('*,sum(jumlah) as total');
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
                                    $list_item_title = $this->db->get('t_item')->result();
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
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        $this->db->where('item_title', $item_title->item_title);
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
                                        $list_item = $this->db->get('t_item')->result();
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
                                                <td>
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
                                                </td>
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
                // $('#Item').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();
            }
        });
    });
    $('.kro').click(function() {
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_kro',
            method: 'post',
            data: {
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
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_ro',
            method: 'post',
            data: {
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
        var kode_dept = $(this).attr("kode_dept");
        var kode_unit_kerja = $(this).attr("kode_unit_kerja");
        var kode_kegiatan = $(this).attr("kode_kegiatan");
        var kode_kro = $(this).attr("kode_kro");
        var kode_ro = $(this).attr("kode_ro");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_komponen',
            method: 'post',
            data: {
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
        var id = $(this).attr("key");
        $.ajax({
            url: '<?php echo base_url(); ?>pok/get_item_update',
            method: 'post',
            data: {
                id: id
            },
            success: function(data) {
                $('#EditItem').modal("show");
                $('#EditItem_modal').html(data);
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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
                $('#tampil').load("<?php echo base_url(); ?>pok/pok_data");
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