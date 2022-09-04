<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/datagrid/datatables/datatables.bundle.css">
<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                  
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
				<?php
				$bulans=['Januari','Februari'];
					 $this->db->select('a.*,d.nama_satker,d.alamat,d.no_tlpn,
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
						$this->db->join('ref_satker d', 'd.kode_satker=a.kode_satker', 'LEFT');
						$this->db->where('a.kode_satker', $kode_satker);
						$this->db->where('a.tahun_anggaran', $tahun_anggaran);
						$this->db->group_by('a.kode_program');
						//$this->db->order_by('create_date', 'ASC');
						//$q = $this->db->get();
						//var_dump($q);
						$list_program = $this->db->get()->result();
						$id=$list_program[0]->id_program;
				?>
                    <div class="panel-content">
					 <center> <h2>LAPORAN BULANAN PELAKSANAAN KEGIATAN </h2></center>
					 <center> <h3>TAHUN ANGGARAN <?= $tahun_anggaran ?></h3></center>
					 <center> <h3> Posisi  : Bulan <?= $bulans[$bulan-1] ?> </h3></center>
					  <h4><table>
					 <tr>
					 <td>NAMA SATKER </td><td>:</td><td><?= $list_program[0]->nama_satker ?></td>
					 </tr>
					 <tr>
					 <td>DIPA NOMOR/TANGGAL </td><td>:</td><td></td>
					 </tr>
					 <tr>
					 <td>PLAFON/PAGU ANGGARAN </td><td>:</td><td><?= angka($list_program[0]->total) ?></td>
					 </tr>
					 <tr>
					 <td>ALAMAT SATKER</td><td>:</td><td><?= $list_program[0]->alamat ?></td>
					 </tr>
					  <tr>
					 <td>NOMOR TELEPON</td><td>:</td><td><?= $list_program[0]->no_tlpn ?></td>
					 </tr>
					 </table></h4>
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
                foreach ($list_kegiatan as $kegiatan) { ?>
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

                    foreach ($list_kro as $kro) {
						$totalpagu=$totalpagu+$kro->total;
						?>
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
                                                    <td class="text-center"><?php echo $item->volume ?></td>
                                                    <td class="text-right"><?php echo angka($item->jumlah) ?></td>
                                                    <td class="text-right"><?php echo round(($item->jumlah/$list_program[0]->total)*100,2) ?></td>
                                                    <td class="text-right"><?php echo angka($nominal) ?></td>
                                                    <td class="text-right"><?php echo angka($realisasi) ?></td>
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
                                                    <td class="text-right"><?php echo round((round(($item->jumlah/$list_program[0]->total)*100,2)*($fisik))/100,2) ?></td>
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
			<tr>
					<td class="text-center" colspan=2>Total</td>                            
					<td class="text-right"><?php echo $totalvolume; ?></td>                             
					<td class="text-right"><?php echo angka($totalpagu); ?></td>                                
					<td class="text-right"><?php echo $totalbobot; ?></td>                             
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
	<?php

	$status = explode(",", $row);
	foreach($status as $val) {
		if($val=="Terkirim")
        {
		  echo '<span class="badge badge-primary">Realisasi <?= $bulans[$bulan-1] ?> Sudah Terkirim</span>';
		}
		if($val=="Revisi")
        {
		  echo '<span class="badge badge-danger">Realisasi <?= $bulans[$bulan-1] ?> Harus Di Revisi</span>';
		}
		if($val=="Final")
        {
		  echo '<span class="badge badge-success">Realisasi <?= $bulans[$bulan-1] ?> Harus Di Revisi</span>';
		}
		
		
		
	}

			if($rowlast=="Terkirim")
			{
				echo '<button type="button" onClick="kirim_final('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Final</button>';
				echo '<button type="button" onClick="revisi()" class="btn btn-block btn-danger">Revisi</button>';
			}
			if($rowlast=="Revisi")
			{
				 echo '</br> Keterangan Revisi : <span class="badge badge-danger">'.$getketerangan.'</span>';
				echo '<button type="button" onClick="kirim('.$list_program[0]->id_program.')" class="btn btn-block btn-warning">Kirim</button>';
				//echo '<button type="button" onClick="revisi()" class="btn btn-block btn-danger">Revisi</button>';
			}
			
	

?>



</div>
</div>
					
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="Kro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Revisi Laporan Realisasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="Kro_modal">
				 <h4 >Isikan Keterangan</h4>
                   <textarea type="text" name="ket" id="ket"  class="form-control" ><?php //echo $keterangan ?></textarea>
				   <button type="button" onClick="kirim_revisi('<?php echo $list_program[0]->id_program ?>')" class="btn btn-block btn-danger">Revisi</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>

<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>

<script>
function kirim(id)
  {

	  	  satker=<?= $kode_satker ?>;
	  tahun=<?= $tahun_anggaran ?>;
	  bulan= <?= $bulan ?>;
	  nama= '<?= $bulans[$bulan-1] ?>';
	
       swal({
						  title: "Data "+nama+" Akan Di Kirim.??",
						  text: "Data yang sudah dikirim tidak akan bisa di rubah kembali",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "Ya",
						  cancelButtonText: "Tidak",
						  closeOnConfirm: true,
						  closeOnCancel: true
						},
						function(isConfirm){
						  if (isConfirm) {
							 jQuery.post('<?php echo site_url('pok/kirim_realisasi')?>',{id:id,satker:satker,tahun:tahun,bulan:bulan,status:"Terkirim"},function(data) {
									var explode = eval("(" + data + ")");
									alert(explode.msg);
										location.reload(); 
							  }); 
						  }else{
							swal("Data Laporan "+nama+" Tidak Dikirim");
						  }						  
						});
    }
    function kirim_final(id)
  {

	  satker=<?= $kode_satker ?>;
	  tahun=<?= $tahun_anggaran ?>;
	  bulan= <?= $bulan ?>;
	  nama= '<?= $bulans[$bulan-1] ?>';

       swal({
						  title: "Data "+nama+" Akan Di Final.??",
						  text: "Data yang sudah difinal tidak akan bisa di rubah kembali",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "Ya",
						  cancelButtonText: "Tidak",
						  closeOnConfirm: true,
						  closeOnCancel: true
						},
						function(isConfirm){
						  if (isConfirm) {
							 jQuery.post('<?php echo site_url('pok/kirim_realisasi')?>',{id:id,satker:satker,tahun:tahun,bulan:bulan,status:"Final"},function(data) {
									var explode = eval("(" + data + ")");
									alert(explode.msg);
										location.reload(); 
							  }); 
						  }else{
							swal("Data Laporan "+nama+" Tidak Final");
						  }						  
						});
    }
	
	 function revisi()
   {
      $('#Kro').modal("show");
	 
    }
	function kirim_revisi(id)
	{
		 satker=<?= $kode_satker ?>;
	  tahun=<?= $tahun_anggaran ?>;
	  bulan= <?= $bulan ?>;
	  nama= '<?= $bulans[$bulan-1] ?>';
	  ket= $("#ket").val();
	  if(ket=="")
	  {
		  swal("Isikan Keterangan Revisi");
	  }else{
       swal({
						  title: "Data "+nama+" Akan Di Revisi.??",
					
						  type: "warning",
						   text: 'Data akan dikembalikan dengan status revisi',
						  showCancelButton: true,
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "Ya",
						  cancelButtonText: "Tidak",
						  closeOnConfirm: true,
						  closeOnCancel: true
						},
						function(isConfirm){
						  if (isConfirm) {
							 
								
								  jQuery.post('<?php echo site_url('pok/kirim_revisi')?>',{ket:ket,id:id,satker:satker,tahun:tahun,bulan:bulan,status:"Revisi"},function(data) {
									var explode = eval("(" + data + ")");
									alert(explode.msg);
										location.reload(); 
									}); 
							
								
						  }else{
							swal("Data Laporan "+nama+" Tidak di Revisi");
						  }						  
						});
	  }
		
	}

</script>