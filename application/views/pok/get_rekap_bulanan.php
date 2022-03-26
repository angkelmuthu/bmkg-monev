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
			(sum(c.nominal_kontrak_januari)+sum(c.nominal_kontrak_desember)+sum(c.nominal_kontrak_februari)+sum(c.nominal_kontrak_maret)
			+sum(c.nominal_kontrak_april)+sum(c.nominal_kontrak_mei)+sum(c.nominal_kontrak_juni)+sum(c.nominal_kontrak_juli)+sum(c.nominal_kontrak_agustus)
			+sum(c.nominal_kontrak_september)+sum(c.nominal_kontrak_oktober)+sum(c.nominal_kontrak_november))as kontrak,
			(sum(c.ang_januari)+sum(c.ang_desember)+sum(c.ang_februari)+sum(c.ang_maret)
			+sum(c.ang_april)+sum(c.ang_mei)+sum(c.ang_juni)+sum(c.ang_juli)+sum(c.ang_agustus)
			+sum(c.ang_september)+sum(c.ang_oktober)+sum(c.ang_november))as anggaran,
			(sum(c.fisik_januari)+sum(c.fisik_desember)+sum(c.fisik_februari)+sum(c.fisik_maret)
			+sum(c.fisik_april)+sum(c.fisik_mei)+sum(c.fisik_juni)+sum(c.fisik_juli)+sum(c.fisik_agustus)
			+sum(c.fisik_september)+sum(c.fisik_oktober)+sum(c.fisik_november))as fisik,sum(b.jumlah) as total');
            $this->db->from('t_program a');
			$this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
            $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
            $this->db->join('ref_satker d', 'd.kode_satker=b.kode_satker', 'LEFT');
            $this->db->join('ref_lokasi e', 'e.kode_lokasi=d.kode_lokasi', 'LEFT');
            $this->db->where('a.tahun_anggaran', $tahun_anggaran);
            $this->db->group_by('d.kode_lokasi');
			$list_prov = $this->db->get()->result();
			foreach ($list_prov as $prov) { ?>
                <tr>
                    <td class="text-right"><?php echo $prov->kode_lokasi ?></td>
                    <td class="text-left fw-700"><?php echo $prov->nama_lokasi ?></td>
                    <td><?php echo $prov->vol ?></td>
                    <td class="text-right fw-700"><?php echo angka($prov->total) ?></td>
                    <td class="text-right fw-700"><?php echo round(($prov->anggaran/$prov->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo angka($prov->kontrak) ?></td>
                    <td class="text-right fw-700"><?php echo angka($prov->anggaran) ?></td>
                    <td class="text-right fw-700"><?php echo round(($prov->anggaran/$prov->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo $prov->fisik ?></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"><?php echo angka($prov->total-$prov->kontrak) ?></td>
                    <td class="text-right fw-700"><?php echo angka($prov->total-$prov->anggaran) ?></td>
                    <td class="text-right fw-700"></td>
              
                </tr>
              
      
  
            <?php
            $this->db->select('a.*,d.nama_satker,a.kode_satker,sum(b.volume)as vol,
			(sum(c.nominal_kontrak_januari)+sum(c.nominal_kontrak_desember)+sum(c.nominal_kontrak_februari)+sum(c.nominal_kontrak_maret)
			+sum(c.nominal_kontrak_april)+sum(c.nominal_kontrak_mei)+sum(c.nominal_kontrak_juni)+sum(c.nominal_kontrak_juli)+sum(c.nominal_kontrak_agustus)
			+sum(c.nominal_kontrak_september)+sum(c.nominal_kontrak_oktober)+sum(c.nominal_kontrak_november))as kontrak,
			(sum(c.ang_januari)+sum(c.ang_desember)+sum(c.ang_februari)+sum(c.ang_maret)
			+sum(c.ang_april)+sum(c.ang_mei)+sum(c.ang_juni)+sum(c.ang_juli)+sum(c.ang_agustus)
			+sum(c.ang_september)+sum(c.ang_oktober)+sum(c.ang_november))as anggaran,
			(sum(c.fisik_januari)+sum(c.fisik_desember)+sum(c.fisik_februari)+sum(c.fisik_maret)
			+sum(c.fisik_april)+sum(c.fisik_mei)+sum(c.fisik_juni)+sum(c.fisik_juli)+sum(c.fisik_agustus)
			+sum(c.fisik_september)+sum(c.fisik_oktober)+sum(c.fisik_november))as fisik,sum(b.jumlah) as total');
            $this->db->from('t_program a');
			$this->db->join('t_item b', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
            $this->db->join('t_item_realisasi c', 'c.id_item=b.id_item', 'LEFT');
            $this->db->join('ref_satker d', 'd.kode_satker=b.kode_satker', 'LEFT');
            $this->db->where('a.tahun_anggaran', $tahun_anggaran);
            $this->db->where('d.kode_lokasi', $prov->kode_lokasi);
            $this->db->group_by('a.kode_satker');
            $list_program = $this->db->get()->result();
            foreach ($list_program as $program) { ?>
                <tr>
                    <td class="text-right"></td>
                    <td class="text-left fw-700"><?php echo $program->nama_satker ?></td>
                    <td><?php echo $program->vol ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->total) ?></td>
                    <td class="text-right fw-700"><?php echo round(($program->anggaran/$program->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->kontrak) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->anggaran) ?></td>
                    <td class="text-right fw-700"><?php echo round(($program->anggaran/$program->total)*100,2) ?></td>
                    <td class="text-right fw-700"><?php echo $program->fisik ?></td>
                    <td class="text-right fw-700"></td>
                    <td class="text-right fw-700"><?php echo angka($program->total-$program->kontrak) ?></td>
                    <td class="text-right fw-700"><?php echo angka($program->total-$program->anggaran) ?></td>
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