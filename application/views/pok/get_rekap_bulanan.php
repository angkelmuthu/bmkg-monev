<link rel="stylesheet" media="screen, print" href="<?php echo base_url() ?>assets/smartadmin/css/datagrid/datatables/datatables.bundle.css">
<style>
    body .select2-container {
        z-index: 9999 !important;
    }
</style>
<div >
    <table border="1" style="border-collapse: collapse;" class="table table-sm table-bordered table-hover table-striped" id="dt-basic-example">
        <thead class="thead-themed">
            <tr>
                <th class="text-center" rowspan="2">Kode</th>
                <th class="text-center" rowspan="2">PROPINSI / SATUAN KERJA</th>
                <th class="text-center"  rowspan="2">Volume</th>
                <th class="text-center" rowspan="2">PAGU</th>
                <th class="text-center" rowspan="2">% BOBOT</th>
                <th class="text-center" rowspan="2">NILAI KONTRAK/ SPK</th>
                <th class="text-center" colspan="2">REALISASI KEU.KUMULATIF</th>
                <th class="text-center" colspan="2">REALISASI KEG. THDP (%) FISIK</th>
                <th class="text-center" colspan="2">SISA PAGU TERHADAP</th>
                <th class="text-center" rowspan="2">KETERANGAN</th>

            </tr>
            <tr>
 
                <th class="text-right">RUPIAH</th>
                <th class="text-right">%</th>
                <th class="text-right">SATKER</th>
                <th class="text-right">BMKG</th>
                <th class="text-right">KONTRAK</th>
                <th class="text-right">REALISASI</th>
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
            $this->db->select('a.*,e.nama_lokasi,e.kode_lokasi,a.kode_satker,sum(b.volume)as vol,
			c.nominal_kontrak_januari,c.nominal_kontrak_desember,c.nominal_kontrak_februari,c.nominal_kontrak_maret
										,c.nominal_kontrak_april,c.nominal_kontrak_mei,c.nominal_kontrak_juni,c.nominal_kontrak_juli,c.nominal_kontrak_agustus,
										c.nominal_kontrak_september,c.nominal_kontrak_oktober,c.nominal_kontrak_november,
			sum(c.ang_januari) as januari,sum(c.ang_februari) as februari,sum(c.ang_maret) as maret,sum(c.ang_april) as april,
										sum(c.ang_mei) as mei,sum(c.ang_juni) as juni,sum(c.ang_juli) as juli,sum(c.ang_agustus) as agustus,sum(c.ang_september) as september,sum(c.ang_november) as november,
										sum(c.ang_oktober) as oktober,sum(c.ang_desember) as desember,c.fisik_januari,c.fisik_desember,c.fisik_februari,c.fisik_maret
										,c.fisik_april,c.fisik_mei,c.fisik_juni,c.fisik_juli,c.fisik_agustus,c.fisik_september,c.fisik_oktober,c.fisik_november,sum(b.jumlah) as total');
            $this->db->from('t_program a');
			$this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
            $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
            $this->db->join('ref_satker d', 'd.kode_satker=b.kode_satker', 'LEFT');
            $this->db->join('ref_lokasi e', 'e.kode_lokasi=d.kode_lokasi', 'LEFT');
            $this->db->where('a.tahun_anggaran', $tahun_anggaran);
            $this->db->group_by('d.kode_lokasi');
			$list_prov = $this->db->get()->result();
			foreach ($list_prov as $prov) {
												if($bulan==1)
												{
													$nominal=$prov->nominal_kontrak_januari;
													$realisasi=$prov->januari;
													$fisik=$prov->fisik_januari;
												}
												if($bulan==2)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari;
													$realisasi=$prov->januari+$prov->februari;
													$fisik=$prov->fisik_januari+$prov->fisik_februari;
												}
												if($bulan==3)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret;
													$realisasi=$prov->januari+$prov->februari+$prov->maret;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret;
												}
												if($bulan==4)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april;
												
												}
												if($bulan==5)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei;
												}
												if($bulan==6)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni;
												}
												if($bulan==7)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni+$prov->nominal_kontrak_juli;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni+$prov->juli;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni+$prov->fisik_juli;
												}
												if($bulan==8)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni+$prov->nominal_kontrak_juli+$prov->nominal_kontrak_agustus;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni+$prov->juli+$prov->agustus;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni+$prov->fisik_juli+$prov->fisik_agustus;
													
												}
												if($bulan==9)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni+$prov->nominal_kontrak_juli+$prov->nominal_kontrak_agustus+$prov->nominal_kontrak_september;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni+$prov->juli+$prov->agustus+$prov->september;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni+$prov->fisik_juli+$prov->fisik_agustus+$prov->fisik_september;
											
												}
												if($bulan==10)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni+$prov->nominal_kontrak_juli+$prov->nominal_kontrak_agustus+$prov->nominal_kontrak_september+$prov->nominal_kontrak_oktober;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni+$prov->juli+$prov->agustus+$prov->september+$prov->oktober;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni+$prov->fisik_juli+$prov->fisik_agustus+$prov->fisik_september+$prov->fisik_oktober;
												
												}
												if($bulan==11)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni+$prov->nominal_kontrak_juli+$prov->nominal_kontrak_agustus+$prov->nominal_kontrak_september+$prov->nominal_kontrak_oktober
													+$prov->nominal_kontrak_november;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni+$prov->juli+$prov->agustus+$prov->september+$prov->oktober
													+$prov->november;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni+$prov->fisik_juli+$prov->fisik_agustus+$prov->fisik_september+$prov->fisik_oktober
													+$prov->fisik_november;
												}	
												if($bulan==12)
												{
													$nominal=$prov->nominal_kontrak_januari+$prov->nominal_kontrak_februari+$prov->nominal_kontrak_maret+$prov->nominal_kontrak_april
													+$prov->nominal_kontrak_mei+$prov->nominal_kontrak_juni+$prov->nominal_kontrak_juli+$prov->nominal_kontrak_agustus+$prov->nominal_kontrak_september+$prov->nominal_kontrak_oktober
													+$prov->nominal_kontrak_november+$prov->nominal_kontrak_desember;
													$realisasi=$prov->januari+$prov->februari+$prov->maret+$prov->april
													+$prov->mei+$prov->juni+$prov->juli+$prov->agustus+$prov->september+$prov->oktober
													+$prov->november+$prov->desember;
													$fisik=$prov->fisik_januari+$prov->fisik_februari+$prov->fisik_maret+$prov->fisik_april
													+$prov->fisik_mei+$prov->fisik_juni+$prov->fisik_juli+$prov->fisik_agustus+$prov->fisik_september+$prov->fisik_oktober
													+$prov->fisik_november+$prov->fisik_desember;
												}

				?>
                <tr>
                    <td class="text-right"><?php echo $prov->kode_lokasi ?></td>
                    <td class="text-left fw-700"><?php echo $prov->nama_lokasi ?></td>
                    <td><?php echo $prov->vol ?></td>
                    <td class="text-right fw-700"><?php echo angka($prov->total) ?></td>
                    <td class="text-right fw-700"><?php echo round(($realisasi/$prov->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo angka($nominal) ?></td>
                    <td class="text-right fw-700"><?php echo angka($realisasi) ?></td>
                    <td class="text-right fw-700"><?php echo round(($realisasi/$prov->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo $fisik ?></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"><?php echo angka($prov->total-$nominal) ?></td>
                    <td class="text-right fw-700"><?php echo angka($prov->total-$realisasi) ?></td>
                    <td class="text-right fw-700"></td>
              
                </tr>
              
      
  
            <?php
            $this->db->select('a.*,d.nama_satker,a.kode_satker,sum(b.volume)as vol,
			c.nominal_kontrak_januari,c.nominal_kontrak_desember,c.nominal_kontrak_februari,c.nominal_kontrak_maret
										,c.nominal_kontrak_april,c.nominal_kontrak_mei,c.nominal_kontrak_juni,c.nominal_kontrak_juli,c.nominal_kontrak_agustus,
										c.nominal_kontrak_september,c.nominal_kontrak_oktober,c.nominal_kontrak_november,
			sum(c.ang_januari) as januari,sum(c.ang_februari) as februari,sum(c.ang_maret) as maret,sum(c.ang_april) as april,
										sum(c.ang_mei) as mei,sum(c.ang_juni) as juni,sum(c.ang_juli) as juli,sum(c.ang_agustus) as agustus,sum(c.ang_september) as september,sum(c.ang_november) as november,
										sum(c.ang_oktober) as oktober,sum(c.ang_desember) as desember,c.fisik_januari,c.fisik_desember,c.fisik_februari,c.fisik_maret
										,c.fisik_april,c.fisik_mei,c.fisik_juni,c.fisik_juli,c.fisik_agustus,c.fisik_september,c.fisik_oktober,c.fisik_november,sum(b.jumlah) as total');
            $this->db->from('t_program a');
			$this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
            $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
            $this->db->join('ref_satker d', 'd.kode_satker=b.kode_satker', 'LEFT');
            $this->db->where('a.tahun_anggaran', $tahun_anggaran);
            $this->db->where('d.kode_lokasi', $prov->kode_lokasi);
            $this->db->group_by('a.kode_satker');
            $list_program = $this->db->get()->result();
            foreach ($list_program as $program) {
											if($bulan==1)
												{
													$nominal=$program->nominal_kontrak_januari;
													$realisasi=$program->januari;
													$fisik=$program->fisik_januari;
												}
												if($bulan==2)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari;
													$realisasi=$program->januari+$program->februari;
													$fisik=$program->fisik_januari+$program->fisik_februari;
												}
												if($bulan==3)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret;
													$realisasi=$program->januari+$program->februari+$program->maret;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret;
												}
												if($bulan==4)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april;
												
												}
												if($bulan==5)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei;
												}
												if($bulan==6)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni;
												}
												if($bulan==7)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni+$program->nominal_kontrak_juli;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni+$program->juli;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni+$program->fisik_juli;
												}
												if($bulan==8)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni+$program->nominal_kontrak_juli+$program->nominal_kontrak_agustus;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni+$program->juli+$program->agustus;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni+$program->fisik_juli+$program->fisik_agustus;
													
												}
												if($bulan==9)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni+$program->nominal_kontrak_juli+$program->nominal_kontrak_agustus+$program->nominal_kontrak_september;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni+$program->juli+$program->agustus+$program->september;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni+$program->fisik_juli+$program->fisik_agustus+$program->fisik_september;
											
												}
												if($bulan==10)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni+$program->nominal_kontrak_juli+$program->nominal_kontrak_agustus+$program->nominal_kontrak_september+$program->nominal_kontrak_oktober;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni+$program->juli+$program->agustus+$program->september+$program->oktober;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni+$program->fisik_juli+$program->fisik_agustus+$program->fisik_september+$program->fisik_oktober;
												
												}
												if($bulan==11)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni+$program->nominal_kontrak_juli+$program->nominal_kontrak_agustus+$program->nominal_kontrak_september+$program->nominal_kontrak_oktober
													+$program->nominal_kontrak_november;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni+$program->juli+$program->agustus+$program->september+$program->oktober
													+$program->november;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni+$program->fisik_juli+$program->fisik_agustus+$program->fisik_september+$program->fisik_oktober
													+$program->fisik_november;
												}	
												if($bulan==12)
												{
													$nominal=$program->nominal_kontrak_januari+$program->nominal_kontrak_februari+$program->nominal_kontrak_maret+$program->nominal_kontrak_april
													+$program->nominal_kontrak_mei+$program->nominal_kontrak_juni+$program->nominal_kontrak_juli+$program->nominal_kontrak_agustus+$program->nominal_kontrak_september+$program->nominal_kontrak_oktober
													+$program->nominal_kontrak_november+$program->nominal_kontrak_desember;
													$realisasi=$program->januari+$program->februari+$program->maret+$program->april
													+$program->mei+$program->juni+$program->juli+$program->agustus+$program->september+$program->oktober
													+$program->november+$program->desember;
													$fisik=$program->fisik_januari+$program->fisik_februari+$program->fisik_maret+$program->fisik_april
													+$program->fisik_mei+$program->fisik_juni+$program->fisik_juli+$program->fisik_agustus+$program->fisik_september+$program->fisik_oktober
													+$program->fisik_november+$program->fisik_desember;
												}
				?>
                <tr>
                    <td class="text-right"></td>
                    <td class="text-left fw-700"><?php echo $program->nama_satker ?></td>
                    <td><?php echo $program->vol ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->total) ?></td>
                    <td class="text-right fw-700"><?php echo round(($realisasi/$program->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo angka($nominal) ?></td>
                    <td class="text-right fw-700"><?php echo angka($realisasi) ?></td>
                    <td class="text-right fw-700"><?php echo round(($realisasi/$program->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo $fisik ?></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"><?php echo angka($program->total-$nominal) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->total-$realisasi) ?></td>
                    <td class="text-right fw-700"></td>
              
                </tr>
              
      
            <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

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