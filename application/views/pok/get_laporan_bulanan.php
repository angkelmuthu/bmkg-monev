<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/datagrid/datatables/datatables.bundle.css">
<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>

<div>
    <table class="table table-sm table-bordered table-hover table-striped" id="dt-basic-example">
        <thead class="thead-themed">
            <tr>
                <th class="text-center" rowspan="2">Kode</th>
                <th class="text-center" rowspan="2">Program/Kegiatan/Output/Komponen/Sub Komponen/Akun/Detil</th>
                <th class="text-center"  rowspan="2">Volume</th>
                <th class="text-center" rowspan="2">PAGU PER JENIS PEKERJAAN</th>
                <th class="text-center" rowspan="2">% BOBOT</th>
                <th class="text-center" rowspan="2">NILAI KUM KONTRAK/SPK PER JENIS PEKERJAAN</th>
                <th class="text-center" colspan="2">REALISASI KEU.KUMULATIF PER JENIS KEGIATAN</th>
                <th class="text-center" colspan="2">% PROSENTASE FISIK KUMULATIF</th>
                <th class="text-center" colspan="2">SISA PAGU</th>
                <th class="text-center" rowspan="2">KETERANGAN</th>

            </tr>
            <tr>
 
                <th class="text-center">RUPIAH</th>
                <th class="text-center">PROSEN (7 : 4) X 100</th>
                <th class="text-center">PER KEG.</th>
                <th class="text-center">THD SELURUH PEKERJAAN ( 9 x 5) /100</th>
                <th class="text-center">THD NILAI KONTRAK (4-6)</th>
                <th class="text-center">THD REALIASASI KEUANGAN (4-7)</th>
            </tr>
        </thead>
        <tbody>
            <tr>

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
               
            </tr>
            <!-- program -->
            <?php
			//var_dump($this->session->userdata('kode_satker'));
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
            $this->db->where('a.kode_satker', $kode_satker);
            $this->db->where('a.tahun_anggaran', $tahun_anggaran);
            $this->db->group_by('a.kode_program');
            //$this->db->order_by('create_date', 'ASC');
            //$q = $this->db->get();
            //var_dump($q);

			  $list_program = $this->db->get()->result();
			if(!empty($list_program))
			{
				          
			$id=$list_program[0]->id_program;
			 $totalvolume=0;
           $totalpagu=0;
           $totalbobot=0;
           $totalkontrak=0;
           $totalrealisasi=0;
           $totalprosen=0;
           $totalfisik=0;
           $totalseluruh=0;
           $totalsisa1=0;
           $totalsisa2=0;
            foreach ($list_program as $program) { ?>
                <tr>
                    <td class="text-right"><?php echo $program->kode_dept . '.' . $program->kode_unit_kerja . '.' . $program->kode_program ?></td>
                    <td class="text-left fw-700"><?php echo $program->nama_program ?></td>
                    <td></td>
                    <td class="text-right fw-700"><?php echo angka($program->total) ?></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"></td>
              
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
                foreach ($list_kegiatan as $kegiatan) { 
				$totalpagu=$totalpagu+$kegiatan->total;
				?>
                    <tr>
                 
                        <td class="text-right"><?php echo $kegiatan->kode_kegiatan ?></td>
                        <td class="text-left fw-500"><?php echo $kegiatan->nama_kegiatan ?></td>
                        <td></td>
                        <td class="text-right fw-500"><?php echo angka($kegiatan->total) ?></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
                        <td class="text-right fw-500"></td>
     
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
                            <td class="text-right"><?php echo $kro->kode_kro ?></td>
                            <td class="text-left"><i class="fal fa-angle-right mr-1"></i><?php echo $kro->nama_kro ?></td>
                            <td class="text-center"><?php echo $kro->volume ?></td>
                            <td class="text-right"><?php echo angka($kro->total) ?></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                        
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

                                <td class="text-right"><?php echo $ro->kode_ro ?></td>
                                <td class="text-left"><i class="fal fa-angle-right ml-1 mr-1"> <?php echo $ro->nama_ro ?></td>
                                <td></td>
                                <td class="text-right"><?php echo angka($ro->total) ?></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                              
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

                                    <td class="text-right"><?php echo $komponen->kode_komponen ?></td>
                                    <td class="text-left"><i class="fal fa-angle-right ml-2 mr-1"> <?php echo $komponen->nama_komponen ?></td>
                                    <td></td>
                                    <td class="text-right"><?php echo angka($komponen->total) ?></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                   
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

                                        <td class="text-right"><?php echo $komponen_sub->kode_komponen_sub ?></td>
                                        <td class="text-left"><i class="fal fa-angle-right ml-3 mr-1"> <?php echo $komponen_sub->nama_komponen_sub ?></td>
                                        <td></td>
                                        <td class="text-right"><?php echo angka($komponen_sub->total) ?></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                
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

                                            <td class="text-right"><?php echo $akun->kode_akun ?></td>
                                            <td class="text-left"><i class="fal fa-angle-right ml-4 mr-1"> <?php echo $akun->nama_akun ?></td>
                                            <td></td>
                                            <td class="text-right"><?php echo angka($akun->total) ?></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            
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

                                                    <td class="text-right"></td>
                                                    <td class="text-left"><i class="fal fa-angle-right ml-5 mr-1"> <?php echo $item_title->item_title ?></td>
                                                    <td></td>
                                                    <td class="text-right"><?php echo angka($item_title->total) ?></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>                                           
                                                </tr>
                                            <?php } ?>
                                            <?php
											$this->db->select('a.*,sum(jumlah) as total,sum(c.ang_januari) as januari,sum(c.ang_februari) as februari,sum(c.ang_maret) as maret,sum(c.ang_april) as april,
										sum(c.ang_mei) as mei,sum(c.ang_juni) as juni,sum(c.ang_juli) as juli,sum(c.ang_agustus) as agustus,sum(c.ang_september) as september,sum(c.ang_november) as november,
										sum(c.ang_oktober) as oktober,sum(c.ang_desember) as desember,c.fisik_januari,c.fisik_desember,c.fisik_februari,c.fisik_maret
										,c.fisik_april,c.fisik_mei,c.fisik_juni,c.fisik_juli,c.fisik_agustus,c.fisik_september,c.fisik_oktober,c.fisik_november
										,c.nominal_kontrak_januari,c.nominal_kontrak_desember,c.nominal_kontrak_februari,c.nominal_kontrak_maret
										,c.nominal_kontrak_april,c.nominal_kontrak_mei,c.nominal_kontrak_juni,c.nominal_kontrak_juli,c.nominal_kontrak_agustus,
										c.nominal_kontrak_september,c.nominal_kontrak_oktober,c.nominal_kontrak_november
										,c.ket_kontrak_januari,c.ket_kontrak_desember,c.ket_kontrak_februari,c.ket_kontrak_maret
										,c.ket_kontrak_april,c.ket_kontrak_mei,c.ket_kontrak_juni,c.ket_kontrak_juli,c.ket_kontrak_agustus,
										c.ket_kontrak_september,c.ket_kontrak_oktober,c.ket_kontrak_november');
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
												$ket="";
												$nominal="";
												$realisasi="";
												$fisik="";
												if($bulan==1)
												{
													$nominal=$item->nominal_kontrak_januari;
													$realisasi=$item->januari;
													$fisik=$item->fisik_januari;
													$ket=json_decode($item->ket_kontrak_januari);
												}
												if($bulan==2)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari;
													$realisasi=$item->januari+$item->februari;
													$fisik=$item->fisik_januari+$item->fisik_februari;
													$ket=json_decode($item->ket_kontrak_februari);
												}
												if($bulan==3)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret;
													$realisasi=$item->januari+$item->februari+$item->maret;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret;
													$ket=json_decode($item->ket_kontrak_maret);
												}
												if($bulan==4)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april;
													$ket=json_decode($item->ket_kontrak_april);
												}
												if($bulan==5)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei;
													$ket=json_decode($item->ket_kontrak_mei);
												}
												if($bulan==6)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni;
													$ket=json_decode($item->ket_kontrak_juni);
												}
												if($bulan==7)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni+$item->nominal_kontrak_juli;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni+$item->juli;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni+$item->fisik_juli;
													$ket=json_decode($item->ket_kontrak_juli);
												}
												if($bulan==8)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni+$item->nominal_kontrak_juli+$item->nominal_kontrak_agustus;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni+$item->juli+$item->agustus;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni+$item->fisik_juli+$item->fisik_agustus;
													$ket=json_decode($item->ket_kontrak_agustus);
												}
												if($bulan==9)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni+$item->nominal_kontrak_juli+$item->nominal_kontrak_agustus+$item->nominal_kontrak_september;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni+$item->juli+$item->agustus+$item->september;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni+$item->fisik_juli+$item->fisik_agustus+$item->fisik_september;
													$ket=json_decode($item->ket_kontrak_september);
												}
												if($bulan==10)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni+$item->nominal_kontrak_juli+$item->nominal_kontrak_agustus+$item->nominal_kontrak_september+$item->nominal_kontrak_oktober;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni+$item->juli+$item->agustus+$item->september+$item->oktober;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni+$item->fisik_juli+$item->fisik_agustus+$item->fisik_september+$item->fisik_oktober;
													$ket=json_decode($item->ket_kontrak_oktober);
												}
												if($bulan==11)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni+$item->nominal_kontrak_juli+$item->nominal_kontrak_agustus+$item->nominal_kontrak_september+$item->nominal_kontrak_oktober
													+$item->nominal_kontrak_november;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni+$item->juli+$item->agustus+$item->september+$item->oktober
													+$item->november;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni+$item->fisik_juli+$item->fisik_agustus+$item->fisik_september+$item->fisik_oktober
													+$item->fisik_november;
													$ket=json_decode($item->ket_kontrak_november);
												}	
												if($bulan==12)
												{
													$nominal=$item->nominal_kontrak_januari+$item->nominal_kontrak_februari+$item->nominal_kontrak_maret+$item->nominal_kontrak_april
													+$item->nominal_kontrak_mei+$item->nominal_kontrak_juni+$item->nominal_kontrak_juli+$item->nominal_kontrak_agustus+$item->nominal_kontrak_september+$item->nominal_kontrak_oktober
													+$item->nominal_kontrak_november+$item->nominal_kontrak_desember;
													$realisasi=$item->januari+$item->februari+$item->maret+$item->april
													+$item->mei+$item->juni+$item->juli+$item->agustus+$item->september+$item->oktober
													+$item->november+$item->desember;
													$fisik=$item->fisik_januari+$item->fisik_februari+$item->fisik_maret+$item->fisik_april
													+$item->fisik_mei+$item->fisik_juni+$item->fisik_juli+$item->fisik_agustus+$item->fisik_september+$item->fisik_oktober
													+$item->fisik_november+$item->fisik_desember;
													$ket=json_decode($item->ket_kontrak_desember);
												}
												$totalvolume=$totalvolume+$item->volume;
												$totalbobot=$totalbobot+round(($item->jumlah/$list_program[0]->total)*100,2);
												$totalkontrak=$totalkontrak+$nominal;
												$totalrealisasi=$totalrealisasi+$realisasi;
												$totalfisik=$totalfisik+$fisik;
												$totalseluruh=$totalseluruh+(round((round(($item->jumlah/$list_program[0]->total)*100,2)*($fisik))/100,2));
												$totalsisa1=$totalsisa1+($item->jumlah-($nominal));
												$totalsisa2=$totalsisa2+($item->jumlah-($realisasi));
                                            ?>
                                                <tr>
                                                    <td class="text-right"></td>
                                                    <?php if (!empty($item->item_title)) { ?>
                                                        <td class="text-left"><i class="fal fa-angle-right ml-6 mr-1"> <?php echo $item->item ?></td>
                                                    <?php } else { ?>
                                                        <td class="text-left"><i class="fal fa-angle-right ml-5 mr-1"> <?php echo $item->item ?></td>
                                                    <?php } ?>
                                                    <td class="text-center"><?php echo isset($item->volume) ? $item->volume : "0" ?></td>
                                                    <td class="text-right"><?php echo angka($item->jumlah) ?></td>
                                                    <td class="text-right"><?php echo isset($totalpagu) ? round(($item->jumlah/$totalpagu)*100,2) : 0 ?></td>
                                                    <td class="text-right"><?php echo angka($nominal) ?></td>
                                                    <td class="text-right"><?php echo  angka($realisasi) ?></td>
                                                    <td class="text-right"><?php 
													//$jml=0;
													//$realisasi=0;
													$real=0;
													if(empty($realisasi) || !isset($realisasi))
													{
														$real=0;
													}
													if(!empty($item->jumlah) || isset($item->jumlah))
													{
														$jml=$item->jumlah;
													}
													if($jml!=0)
													{
														echo  round((($realisasi)/round($jml))*100,2);
														$totalprosen=$totalprosen+(round((($realisasi)/round($jml))*100,2));
														
													}
													
													
													?></td>
                                                    <td class="text-right"><?php echo $fisik ?></td>
                                                    <td class="text-right"><?php echo isset($list_program[0]->total) ? round((round(($item->jumlah/$list_program[0]->total)*100,2)*($fisik))/100,2) : 0 ?></td>
                                                    <td class="text-right"><?php echo angka($item->jumlah-($nominal)) ?></td>
                                                    <td class="text-right"><?php echo angka($item->jumlah-($realisasi)) ?></td>
                                                    <td class="text-right"><?php echo isset($ket->ket) ? $ket->ket : '' ?></td>
                                                   
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
            <?php } ?>
			<tr>
					<td class="text-center" colspan=2>Total</td>                            
					<td class="text-right"><?php echo $totalvolume; ?></td>                             
					<td class="text-right"><?php echo angka($totalpagu); ?></td>                                
					<td class="text-right"><?php echo ($totalpagu/$totalpagu)*100 ?></td>                             
					<td class="text-right"><?php echo angka($totalkontrak); ?></td>                             
					<td class="text-right"><?php echo angka($totalrealisasi); ?></td>                             
					<td class="text-right"><?php echo $totalprosen; ?></td>                             
					<td class="text-right"><?php echo $totalfisik; ?></td>           
					<td class="text-right"><?php echo $totalseluruh; ?></td>                             
					<td class="text-right"><?php echo angka($totalsisa1); ?></td>                             
					<td class="text-right"><?php echo angka($totalsisa2); ?></td>                                 
					<td class="text-right"></td>                             
            </tr>
        </tbody>
    </table>
</div>

<?php
if(!empty($list_program))
			{
				$bulans=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
	$status = explode(",", $row);
	foreach($status as $val) {
		if($val=="Terkirim")
        {
		  echo '<span class="badge badge-primary">Realisasi '.$bulans[$bulan-1].' Sudah Terkirim</span>';
		}
		if($val=="Revisi")
        {
		  echo '<span class="badge badge-danger">Realisasi '.$bulans[$bulan-1].' Harus Di Revisi</span>';
		}
		if($val=="Final")
        {
		  echo '<span class="badge badge-success">Realisasi '.$bulans[$bulan-1].' Final</span>';
		}
		
		
		
	}
		 echo '</br> Keterangan Revisi : <span class="badge badge-success">'.$keterangan.'</span>';
 if ($this->session->userdata('id_user_level') != 1) { 
			if($rowlast=="Terkirim")
			{
				//echo '<button type="button" onClick="kirim('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Final</button></br>';
				//echo '<button type="button" onClick="revisi()" class="btn btn-block btn-danger">Revisi</button>';
			}else if($rowlast=="Revisi")
			{
				echo '</br><button type="button" onClick="kirim('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Kirim</button>';
				//  echo '</br> Keterangan Revisi : <span class="badge badge-danger">'.$getketerangan.'</span>';
				//echo '<button type="button" onClick="revisi()" class="btn btn-block btn-danger">Revisi</button>';
			}else if($rowlast=="Final")
			{
				
			}
			if($rowlast=="")
			{
				echo '</br><button type="button" onClick="kirim('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Kirim</button>';
			}
			
 }else{
	 	if($rowlast=="Terkirim")
			{
				echo '<button type="button" onClick="kirim_final('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Final</button>';
				echo '<button type="button" onClick="revisi()" class="btn btn-block btn-danger">Revisi</button>';
			}else if($rowlast=="Revisi")
			{
				// echo '</br> Keterangan Revisi : <span class="badge badge-danger">'.$getketerangan.'</span>';
				echo '<button type="button" onClick="kirim('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Kirim</button>';
				
			}else if($rowlast=="Final")
			{
				
			}
			if($rowlast=="")
			{
				echo '<button type="button" onClick="kirim('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Kirim</button>';
			}
			
	 
 }
			}
?>

</br>
</br>
 <button class="btn btn-block btn-primary pull-right" onclick="ExportToExcel('dt-basic-example')" name="submit" id="btnExport" style="margin-left:10px;">Excell</button>

<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script type="text/javascript">
function ExportToExcel(mytblId){
       var htmltable= document.getElementById('dt-basic-example');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );


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