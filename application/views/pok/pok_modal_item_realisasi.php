<form method="post" id="form" >
    <input type="hidden" name="id_item" id="id_item" value="<?php echo $id_item ?>">
    <input type="hidden" name="pagu" id="pagu" value="<?php echo $jumlah ?>">
	 <h3><?php echo $item ?></h3>
    <div class="alert alert-warning" role="alert">
        <strong>Perhatian!</strong> Total Realisasi tidak boleh melebihi Pagu Anggaran sebesar Rp. <?php echo angka($jumlah) ?>
    </div>
    <div class="row">
	<table class="table table-sm table-bordered table-hover table-striped" id="dt-basic-example" >
        <thead class="thead-themed">
            <tr>
			<th>Bulan</th>
			<th>Rencana_Penarikan</th>
			<th>Nominal_Kontrak</th>
			<th>Nomor_Kontrak</th>
			<th>Tanggal_Kontrak</th>
			<th>Realisasi_Anggaran</th>
			<th>Realisasi_Fisik %</th>
			<th>Keterangan</th>
            </tr>
		</thead>
		<tbody>
		<tr>
		<td>Januari </td>
		<td> <input  type="text" name="tarik_jan" id="tarik_jan" value="<?php echo angka($januari) ?>" class="form-control" readonly></td>
		<td> <input <?php if(!empty($bulan[1])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" type="text" name="nominal_kontrak_jan" id="nominal_kontrak_jan" value="<?php echo angka($nominal_kontrak_januari) ?>" class="form-control" onKeyup="total_nominal('jan',this.value)">
		     <input type="hidden" name="nominal_kontrak_jan_temp"  id="nominal_kontrak_jan_temp" value="<?php echo $nominal_kontrak_januari ?>" ></td>
		<td> <input <?php if(!empty($bulan[1])){ echo "readonly"; } ?> type="text" name="nomor_jan" id="nomor_jan" value="<?php echo $nomor_januari ?>" class="form-control" ></td>
		<td> <input <?php if(!empty($bulan[1])){ echo "readonly"; } ?> type="date" name="tgl_jan" id="tgl_jan" value="<?php echo $tgl_januari ?>" class="form-control" ></td>
		<td> <input <?php if(!empty($bulan[1])){ echo "readonly"; } ?> type="text" onkeypress="return hanyaAngka(event)" name="anggaran_jan" id="anggaran_jan" value="<?php echo angka($ang_januari) ?>" class="form-control" onKeyup="total_ang('jan',this.value)">
		     <input type="hidden" name="anggaran_jan_temp" id="anggaran_jan_temp" value="<?php echo $ang_januari ?>" ></td>
		
		<td> <input <?php if(!empty($bulan[1])){ echo "readonly"; } ?> type="text" name="fisik_jan" id="fisik_jan" value="<?php echo $fisik_januari ?>" class="form-control" onkeypress="return hanyaAngka(event)" onKeyup="total_fis('jan',this.value)">
		     <input type="hidden" name="fisik_jan_temp" id="fisik_jan_temp" value="<?php echo $fisik_januari ?>" class="form-control"></td>
		<td> <textarea <?php if(!empty($bulan[1])){ echo "readonly"; } ?> type="text" name="ket_jan" id="ket_jan"  class="form-control" ><?php echo $ket_januari ?></textarea></td>
		</tr>
		<tr>
		<td>Februari</td>
		<td> <input type="text" name="tarik_feb" id="tarik_feb" value="<?php echo angka($februari) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[2])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_feb" id="nominal_kontrak_feb" value="<?php echo angka($nominal_kontrak_februari) ?>" class="form-control" onKeyup="total_nominal('feb',this.value)">
		     <input type="hidden" name="nominal_kontrak_feb_temp" id="nominal_kontrak_feb_temp" value="<?php echo $nominal_kontrak_februari ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[2])){ echo "readonly"; } ?> name="nomor_feb" id="nomor_feb" value="<?php echo $nomor_februari ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[2])){ echo "readonly"; } ?> name="tgl_feb" id="tgl_feb" value="<?php echo $tgl_februari ?>" class="form-control" ></td>
		<td> <input type="currency" <?php if(!empty($bulan[2])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_feb" id="anggaran_feb" value="<?php echo angka($ang_februari) ?>" class="form-control" onChange="total_ang('feb',this.value)">
		<input type="hidden" name="anggaran_feb_temp" id="anggaran_feb_temp" value="<?php echo $ang_februari ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[2])){ echo "readonly"; } ?> name="fisik_feb" id="fisik_feb" value="<?php echo $fisik_februari ?>" class="form-control"  onkeypress="return hanyaAngka(event)" onKeyup="total_fis('feb',this.value)">
		     <input type="hidden" name="fisik_feb_temp" id="fisik_feb_temp" value="<?php echo $fisik_februari ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[2])){ echo "readonly"; } ?> name="ket_feb" id="ket_feb"  class="form-control" ><?php echo $ket_februari ?></textarea></td>
		</tr>
		<tr>
		<td>Maret</td>
		<td> <input type="text" name="tarik_mar" id="tarik_mar" value="<?php echo angka($maret) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[3])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_mar" id="nominal_kontrak_mar" value="<?php echo angka($nominal_kontrak_maret) ?>" class="form-control" onKeyup="total_nominal('mar',this.value)">
		     <input type="hidden" name="nominal_kontrak_mar_temp" id="nominal_kontrak_mar_temp" value="<?php echo $nominal_kontrak_maret ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[3])){ echo "readonly"; } ?> name="nomor_mar" id="nomor_mar" value="<?php echo $nomor_maret ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[3])){ echo "readonly"; } ?> name="tgl_mar" id="tgl_mar" value="<?php echo $tgl_maret ?>" class="form-control" ></td>
		<td> <input type="text"  <?php if(!empty($bulan[3])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_mar" id="anggaran_mar" value="<?php echo angka($ang_maret) ?>" class="form-control" onChange="total_ang('mar',this.value)">
		<input type="hidden" name="anggaran_mar_temp" id="anggaran_mar_temp" value="<?php echo $ang_maret ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[3])){ echo "readonly"; } ?> name="fisik_mar" id="fisik_mar" value="<?php echo $fisik_maret ?>" class="form-control"  onkeypress="return hanyaAngka(event)" onKeyup="total_fis('mar',this.value)">
		     <input type="hidden" name="fisik_mar_temp" id="fisik_mar_temp" value="<?php echo $fisik_maret ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[3])){ echo "readonly"; } ?> name="ket_mar" id="ket_mar"  class="form-control" ><?php echo $ket_maret ?></textarea></td>
		</tr>
		<tr>
		<td>April</td>
		<td> <input type="text" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> name="tarik_apr" id="tarik_apr" value="<?php echo angka($april) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_apr" id="nominal_kontrak_apr" value="<?php echo angka($nominal_kontrak_april) ?>" class="form-control" onKeyup="total_nominal('apr',this.value)">
		     <input type="hidden" name="nominal_kontrak_apr_temp" id="nominal_kontrak_apr_temp" value="<?php echo $nominal_kontrak_april ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> name="nomor_apr" id="nomor_apr" value="<?php echo $nomor_april ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> name="tgl_apr" id="tgl_apr" value="<?php echo $tgl_april ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_apr" id="anggaran_apr" value="<?php echo angka($ang_april) ?>" class="form-control" onChange="total_ang('apr',this.value)">
		<input type="hidden" name="anggaran_apr_temp" id="anggaran_apr_temp" value="<?php echo $ang_april ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> name="fisik_apr" id="fisik_apr" value="<?php echo $fisik_april ?>" class="form-control"  onkeypress="return hanyaAngka(event)"  onKeyup="total_fis('apr',this.value)">
		     <input type="hidden" name="fisik_apr_temp" id="fisik_apr_temp" value="<?php echo $fisik_april ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[4])){ echo "readonly"; } ?> name="ket_apr" id="ket_apr"  class="form-control" ><?php echo $ket_april ?></textarea></td>
		</tr>
		<tr>
		<td>Mei</td>
		<td> <input type="text" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> name="tarik_mei" id="tarik_mei" value="<?php echo angka($mei) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_mei" id="nominal_kontrak_mei" value="<?php echo angka($nominal_kontrak_mei) ?>" class="form-control" onKeyup="total_nominal('mei',this.value)">
		     <input type="hidden" name="nominal_kontrak_mei_temp" id="nominal_kontrak_mei_temp" value="<?php echo $nominal_kontrak_mei ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> name="nomor_mei" id="nomor_mei" value="<?php echo $nomor_mei ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> name="tgl_mei" id="tgl_mei" value="<?php echo $tgl_mei ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)"  name="anggaran_mei" id="anggaran_mei" value="<?php echo angka($ang_mei) ?>" class="form-control" onChange="total_ang('mei',this.value)">
		<input type="hidden" name="anggaran_mei_temp" id="anggaran_mei_temp" value="<?php echo $ang_mei ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> name="fisik_mei" id="fisik_mei" value="<?php echo $fisik_mei ?>" class="form-control" onkeypress="return hanyaAngka(event)"  onKeyup="total_fis('mei',this.value)">
		     <input type="hidden" name="fisik_mei_temp" id="fisik_mei_temp" value="<?php echo $fisik_mei ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[5])){ echo "readonly"; } ?> name="ket_mei" id="ket_mei"  class="form-control" ><?php echo $ket_mei ?></textarea></td>
		</tr>
		<tr>
		<td>Juni</td>
		<td> <input type="text" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> name="tarik_jun" id="tarik_jun" value="<?php echo angka($juni) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_jun" id="nominal_kontrak_jun" value="<?php echo angka($nominal_kontrak_juni) ?>" class="form-control" onKeyup="total_nominal('jun',this.value)">
		     <input type="hidden" name="nominal_kontrak_jun_temp" id="nominal_kontrak_jun_temp" value="<?php echo $nominal_kontrak_juni ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> name="nomor_jun" id="nomor_jun" value="<?php echo $nomor_juni ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> name="tgl_jun" id="tgl_jun" value="<?php echo $tgl_juni ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_jun" id="anggaran_jun" value="<?php echo angka($ang_juni) ?>" class="form-control" onChange="total_ang('jun',this.value)">
		<input type="hidden" name="anggaran_jun_temp" id="anggaran_jun_temp" value="<?php echo $ang_juni ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> name="fisik_jun" id="fisik_jun" value="<?php echo $fisik_juni ?>" class="form-control" onkeypress="return hanyaAngka(event)"  onKeyup="total_fis('jun',this.value)">
		     <input type="hidden" name="fisik_jun_temp" id="fisik_jun_temp" value="<?php echo $fisik_juni ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[6])){ echo "readonly"; } ?> name="ket_jun" id="ket_jun"  class="form-control" ><?php echo $ket_juni ?></textarea></td>
		</tr>
		<tr>
		<td>Juli</td>
		<td> <input type="text" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> name="tarik_jul" id="tarik_jul" value="<?php echo angka($juli) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_jul" id="nominal_kontrak_jul" value="<?php echo angka($nominal_kontrak_juli) ?>" class="form-control" onKeyup="total_nominal('jul',this.value)">
		     <input type="hidden" name="nominal_kontrak_jul_temp" id="nominal_kontrak_jul_temp" value="<?php echo $nominal_kontrak_juli ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> name="nomor_jul" id="nomor_jul" value="<?php echo $nomor_juli ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> name="tgl_jul" id="tgl_jul" value="<?php echo $tgl_juli ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_jul" id="anggaran_jul" value="<?php echo angka($ang_juli) ?>" class="form-control" onChange="total_ang('jul',this.value)">
		<input type="hidden" name="anggaran_jul_temp" id="anggaran_jul_temp" value="<?php echo $ang_juli ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> name="fisik_jul" id="fisik_jul" value="<?php echo $fisik_juli ?>" class="form-control" onkeypress="return hanyaAngka(event)"  onKeyup="total_fis('jul',this.value)">
		     <input type="hidden" name="fisik_jul_temp" id="fisik_jul_temp" value="<?php echo $fisik_juli ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[7])){ echo "readonly"; } ?> name="ket_jul" id="ket_jul"  class="form-control" ><?php echo $ket_juli ?></textarea></td>
		</tr>
		<tr>
		<td>Agustus</td>
		<td> <input type="text" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> name="tarik_agu" id="tarik_agu" value="<?php echo angka($agustus) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_agu" id="nominal_kontrak_agu" value="<?php echo angka($nominal_kontrak_agustus) ?>" class="form-control" onKeyup="total_nominal('agu',this.value)">
		     <input type="hidden" name="nominal_kontrak_agu_temp" id="nominal_kontrak_agu_temp" value="<?php echo $nominal_kontrak_agustus ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> name="nomor_agu" id="nomor_agu" value="<?php echo $nomor_agustus ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> name="tgl_agu" id="tgl_agu" value="<?php echo $tgl_agustus ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_agu" id="anggaran_agu" value="<?php echo angka($ang_agustus) ?>" class="form-control" onChange="total_ang('agu',this.value)">
		<input type="hidden" name="anggaran_agu_temp" id="anggaran_agu_temp" value="<?php echo $ang_agustus ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> name="fisik_agu" id="fisik_agu" value="<?php echo $fisik_agustus ?>" class="form-control" onkeypress="return hanyaAngka(event)"  onKeyup="total_fis('agu',this.value)">
		     <input type="hidden" name="fisik_agu_temp" id="fisik_agu_temp" value="<?php echo $fisik_agustus ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[8])){ echo "readonly"; } ?> name="ket_agu" id="ket_agu"  class="form-control" ><?php echo $ket_agustus ?></textarea></td>
		</tr>
		<tr>
		<td>September</td>
		<td> <input type="text" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> name="tarik_sep" id="tarik_sep" value="<?php echo angka($september) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="nominal_kontrak_sep" id="nominal_kontrak_sep" value="<?php echo angka($nominal_kontrak_september)  ?>" class="form-control" onKeyup="total_nominal('sep',this.value)">
		     <input type="hidden" name="nominal_kontrak_sep_temp" id="nominal_kontrak_sep_temp" value="<?php echo $nominal_kontrak_september ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> name="nomor_sep" id="nomor_sep" value="<?php echo $nomor_september ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> name="tgl_sep" id="tgl_sep" value="<?php echo $tgl_september ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)"  name="anggaran_sep" id="anggaran_sep" value="<?php echo angka($ang_september) ?>" class="form-control" onChange="total_ang('sep',this.value)">
		<input type="hidden" name="anggaran_sep_temp" id="anggaran_sep_temp" value="<?php echo $ang_september ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> name="fisik_sep" id="fisik_sep" value="<?php echo $fisik_september ?>" class="form-control" onkeypress="return hanyaAngka(event)"  onKeyup="total_fis('sep',this.value)">
		     <input type="hidden" name="fisik_sep_temp" id="fisik_sep_temp" value="<?php echo $fisik_september ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[9])){ echo "readonly"; } ?> name="ket_sep" id="ket_sep"  class="form-control" ><?php echo $ket_september ?></textarea></td>
		</tr>
		<tr>
		<td>Oktober</td>
		<td> <input type="text" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> name="tarik_okt" id="tarik_okt" value="<?php echo angka($oktober) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)"  name="nominal_kontrak_okt" id="nominal_kontrak_okt" value="<?php echo angka($nominal_kontrak_oktober) ?>" class="form-control" onKeyup="total_nominal('okt',this.value)">
		     <input type="hidden" name="nominal_kontrak_okt_temp" id="nominal_kontrak_okt_temp" value="<?php echo $nominal_kontrak_oktober ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> name="nomor_okt" id="nomor_okt" value="<?php echo $nomor_oktober ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> name="tgl_okt" id="tgl_okt" value="<?php echo $tgl_oktober ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_okt" id="anggaran_okt" value="<?php echo angka($ang_oktober) ?>" class="form-control" onChange="total_ang('okt',this.value)">
		<input type="hidden" name="anggaran_okt_temp" id="anggaran_okt_temp" value="<?php echo $ang_oktober ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> name="fisik_okt" id="fisik_okt" value="<?php echo $fisik_oktober ?>" class="form-control"  onkeypress="return hanyaAngka(event)" onKeyup="total_fis('okt',this.value)">
		     <input type="hidden" name="fisik_okt_temp" id="fisik_okt_temp" value="<?php echo $fisik_oktober ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[10])){ echo "readonly"; } ?> name="ket_okt" id="ket_okt"  class="form-control" ><?php echo $ket_oktober ?></textarea></td>
		</tr>
		<tr>
		<td>November</td>
		<td> <input type="text" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> name="tarik_nov" id="tarik_nov" value="<?php echo angka($november) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)"  name="nominal_kontrak_nov" id="nominal_kontrak_nov" value="<?php echo angka($nominal_kontrak_november) ?>" class="form-control" onKeyup="total_nominal('nov',this.value)">
		     <input type="hidden" name="nominal_kontrak_nov_temp" id="nominal_kontrak_nov_temp" value="<?php echo $nominal_kontrak_november ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> name="nomor_nov" id="nomor_nov" value="<?php echo $nomor_november ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> name="tgl_nov" id="tgl_nov" value="<?php echo $tgl_november ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_nov" id="anggaran_nov" value="<?php echo angka($ang_november) ?>" class="form-control" onChange="total_ang('nov',this.value)">
		<input type="hidden" name="anggaran_nov_temp" id="anggaran_nov_temp" value="<?php echo $ang_februari ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> name="fisik_nov" id="fisik_nov" value="<?php echo $fisik_november ?>" class="form-control"  onkeypress="return hanyaAngka(event)" onKeyup="total_fis('nov',this.value)">
		     <input type="hidden" name="fisik_nov_temp" id="fisik_nov_temp" value="<?php echo $fisik_november ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[11])){ echo "readonly"; } ?> name="ket_nov" id="ket_nov"  class="form-control" ><?php echo $ket_november ?></textarea></td>
		</tr>
		<tr>
		<td>Desember</td>
		<td> <input type="text" <?php if(!empty($bulan[12])){ echo "readonly"; } ?> name="tarik_des" id="tarik_des" value="<?php echo angka($desember) ?>" class="form-control" readonly></td>
		<td> <input type="text" <?php if(!empty($bulan[12])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)"  name="nominal_kontrak_des" id="nominal_kontrak_des" value="<?php echo angka($nominal_kontrak_desember) ?>" class="form-control" onKeyup="total_nominal('des',this.value)">
		     <input type="hidden" name="nominal_kontrak_des_temp" id="nominal_kontrak_des_temp" value="<?php echo $nominal_kontrak_desember ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[12])){ echo "readonly"; } ?> name="nomor_des" id="nomor_des" value="<?php echo $nomor_desember ?>" class="form-control" ></td>
		<td> <input type="date" <?php if(!empty($bulan[12])){ echo "readonly"; } ?>name="tgl_des" id="tgl_des" value="<?php echo $tgl_desember ?>" class="form-control" ></td>
		<td> <input type="text" <?php if(!empty($bulan[12])){ echo "readonly"; } ?> onkeypress="return hanyaAngka(event)" name="anggaran_des" id="anggaran_des" value="<?php echo angka($ang_desember) ?>" class="form-control" onChange="total_ang('des',this.value)">
		<input type="hidden" name="anggaran_des_temp" id="anggaran_des_temp" value="<?php echo $ang_desember ?>" ></td>
		<td> <input type="text" <?php if(!empty($bulan[12])){ echo "readonly"; } ?> name="fisik_des" id="fisik_des" value="<?php echo $fisik_desember ?>" class="form-control"  onkeypress="return hanyaAngka(event)" onKeyup="total_fis('des',this.value)">
		     <input type="hidden" name="fisik_des_temp" id="fisik_des_temp" value="<?php echo $fisik_desember ?>" class="form-control"></td>
		<td> <textarea type="text" <?php if(!empty($bulan[12])){ echo "readonly"; } ?> name="ket_des" id="ket_des"  class="form-control" ><?php echo $ket_desember ?></textarea></td>
		</tr>
		<tr>
		<td>Total</td>
		<td> <input type="text" name="total_tarik" id="total_tarik" value="<?php echo angka($januari+$februari+$maret+$april+$mei+$juni+$juli+$agustus+$september+$oktober+$november+$desember) ?>" class="form-control" readonly></td>
		<td> <input type="text" name="total_nominal_kontrak" id="total_nominal_kontrak" value="<?php echo angka($nominal_kontrak_januari+$nominal_kontrak_februari+$nominal_kontrak_maret+$nominal_kontrak_april+$nominal_kontrak_mei+$nominal_kontrak_juni+$nominal_kontrak_juli+$nominal_kontrak_agustus+$nominal_kontrak_september+$nominal_kontrak_oktober+$nominal_kontrak_november+$nominal_kontrak_desember) ?>" class="form-control" readonly></td>
		<td> </td>
		<td> </td>
		<td> <input type="text" name="total_anggaran" id="total_anggaran" value="<?php echo angka($ang_januari+$ang_februari+$ang_maret+$ang_april+$ang_mei+$ang_juni+$ang_juli+$ang_agustus+$ang_september+$ang_oktober+$ang_november+$ang_desember) ?>" class="form-control" readonly></td>
		<td> <input type="text" name="total_fisik" id="total_fisik" value="<?php echo $fisik_januari+$fisik_februari+$fisik_maret+$fisik_april+$fisik_mei+$fisik_juni+$fisik_juli+$fisik_agustus+$fisik_september+$fisik_oktober+$fisik_november+$fisik_desember ?>" class="form-control" readonly></td>
		</tr>
		</tbody>
	</table>
        
        <div class="col-xl-12 mb-2">
            <button id="update_item" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </div>
</form>
    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
			{
                return false;
			}else{
            return true;
			}
        }
    </script>
<script type="text/javascript">
$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val =  input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += "";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

function total_nominal(bulan,nominal)
{
	
	totalawal= $("#total_nominal_kontrak").val();
	pagu= $("#pagu").val();
	pengurang= $("#nominal_kontrak_"+bulan+"_temp").val();
	//alert(pengurang);
	if(nominal=="")
	{
		nominal=0;
		$("#nominal_kontrak_"+bulan).val("0");
	}
	 total_akhir=(parseInt(totalawal.replace(".", ""))-parseInt(pengurang))+parseInt(nominal);
	 if(parseInt(total_akhir)>parseInt(pagu))
	 {
		 alert("Total Kontrak tidak boleh melebihi pagu");
		 $("#nominal_kontrak_"+bulan).val(pengurang);
	 }else{
		 $("#total_nominal_kontrak").val(total_akhir);
		 $("#nominal_kontrak_"+bulan+"_temp").val(nominal);
	 }
    
}
function total_ang(bulan,nominal)
{
	
	totalawal= $("#total_anggaran").val();
	pagu= $("#pagu").val();
	pengurang= $("#anggaran_"+bulan+"_temp").val();
	//alert(pengurang);
	if(nominal=="")
	{
		nominal=0;
		$("#anggaran_"+bulan).val("0");
	}
	 total_akhir=(parseInt(totalawal.replace(".", ""))-parseInt(pengurang))+parseInt(nominal);
	 if(parseInt(total_akhir)>parseInt(pagu))
	 {
		 alert("Total Realisasi tidak boleh melebihi pagu");
		 $("#anggaran_"+bulan).val(pengurang);
	 }else{
		 $("#total_anggaran").val(total_akhir);
		 $("#anggaran_"+bulan+"_temp").val(nominal);
	 }
    
}
function total_fis(bulan,nominal)
{
	
	totalawal= $("#total_fisik").val();
	pengurang= $("#fisik_"+bulan+"_temp").val();
	//alert(pengurang);
	if(nominal=="")
	{
		nominal=0;
		$("#fisik_"+bulan).val("0");
	}
	if(nominal)
	{
		//nominal=0;
		 total_akhir=(parseFloat(totalawal)-parseFloat(pengurang))+parseFloat(nominal);

		 $("#total_fisik").val(total_akhir);
		 $("#fisik_"+bulan+"_temp").val(nominal);
		
	}

	
	
    
}
    $(document).ready(function() {
        $("#harga_satuan, #volume").keyup(function() {
            var harga_satuanx = $("#harga_satuan").val();
            var harga_satuan = parseInt(harga_satuanx.replace(/,.*|[^0-9]/g, ''), 10);
            var volume = $("#volume").val();

            var total = parseInt(harga_satuan) * parseInt(volume);
            $("#total").val(total);
        });

        $("#update_item").click(function() {
			totalawal= $("#total_anggaran").val();
			//alert(totalawal);
			pagu= $("#pagu").val();

	
			 if(parseInt(totalawal)>parseInt(pagu))
			 {
				 alert("Total Realisasi tidak boleh melebihi pagu");
				
			 }else{
				  var data = $('#form').serialize();
			
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url(); ?>pok/update_realisasi",
					data: data,
					cache: false,
					success: function(data) {
						$('#tampil').load("<?php echo base_url(); ?>pok/pok_data_realisasi/<?php echo $pok ?>");
						$('#Penarikan').modal('hide');
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
					}
				}); 
			 }
           
        });
    });
</script>