<form method="post" id="form">
    <input type="hidden" name="id_item" id="id_item" value="<?php echo $id_item ?>">
    <input type="hidden" name="pagu" id="pagu" value="<?php echo $jumlah ?>">
	 <h3><?php echo $item ?></h3>
    <div class="alert alert-warning" role="alert">
        <strong>Perhatian!</strong> Total Realisasi tidak boleh melebihi Pagu Anggaran sebesar Rp. <?php echo angka($jumlah) ?>
    </div>
    <div class="row">
	<table class="table table-sm table-bordered table-hover table-striped" id="dt-basic-example">
        <thead class="thead-themed">
            <tr>
			<th>Bulan</th>
			<th>Rencana Penarikan</th>
			<th>Realisasi Anggaran</th>
			<th>Realisasi Fisik</th>
            </tr>
		</thead>
		<tbody>
		<tr>
		<td>Januari</td>
		<td> <input type="text" name="tarik_jan" id="tarik_jan" value="<?php echo $januari ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_jan" id="anggaran_jan" value="<?php echo $ang_januari ?>" class="form-control" onKeyup="total_ang('jan',this.value)">
		     <input type="hidden" name="anggaran_jan_temp" id="anggaran_jan_temp" value="<?php echo $ang_januari ?>" ></td>
		<td> <input type="text" name="fisik_jan" id="fisik_jan" value="<?php echo $fisik_januari ?>" class="form-control" onKeyup="total_fis('jan',this.value)">
		     <input type="hidden" name="fisik_jan_temp" id="fisik_jan_temp" value="<?php echo $fisik_januari ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Februari</td>
		<td> <input type="text" name="tarik_feb" id="tarik_feb" value="<?php echo $februari ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_feb" id="anggaran_feb" value="<?php echo $ang_februari ?>" class="form-control" onChange="total_ang('feb',this.value)">
		<input type="hidden" name="anggaran_feb_temp" id="anggaran_feb_temp" value="<?php echo $ang_februari ?>" ></td>
		<td> <input type="text" name="fisik_feb" id="fisik_feb" value="<?php echo $fisik_februari ?>" class="form-control" onKeyup="total_fis('feb',this.value)">
		     <input type="hidden" name="fisik_feb_temp" id="fisik_feb_temp" value="<?php echo $fisik_februari ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Maret</td>
		<td> <input type="text" name="tarik_mar" id="tarik_mar" value="<?php echo $maret ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_mar" id="anggaran_mar" value="<?php echo $ang_maret ?>" class="form-control" onChange="total_ang('mar',this.value)">
		<input type="hidden" name="anggaran_mar_temp" id="anggaran_mar_temp" value="<?php echo $ang_maret ?>" ></td>
		<td> <input type="text" name="fisik_mar" id="fisik_mar" value="<?php echo $fisik_maret ?>" class="form-control" onKeyup="total_fis('mar',this.value)">
		     <input type="hidden" name="fisik_mar_temp" id="fisik_mar_temp" value="<?php echo $fisik_maret ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>April</td>
		<td> <input type="text" name="tarik_apr" id="tarik_apr" value="<?php echo $april ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_apr" id="anggaran_apr" value="<?php echo $ang_april ?>" class="form-control" onChange="total_ang('apr',this.value)">
		<input type="hidden" name="anggaran_apr_temp" id="anggaran_apr_temp" value="<?php echo $ang_april ?>" ></td>
		<td> <input type="text" name="fisik_apr" id="fisik_apr" value="<?php echo $fisik_april ?>" class="form-control" onKeyup="total_fis('apr',this.value)">
		     <input type="hidden" name="fisik_apr_temp" id="fisik_apr_temp" value="<?php echo $fisik_april ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Mei</td>
		<td> <input type="text" name="tarik_mei" id="tarik_mei" value="<?php echo $mei ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_mei" id="anggaran_mei" value="<?php echo $ang_mei ?>" class="form-control" onChange="total_ang('mei',this.value)">
		<input type="hidden" name="anggaran_mei_temp" id="anggaran_mei_temp" value="<?php echo $ang_mei ?>" ></td>
		<td> <input type="text" name="fisik_mei" id="fisik_mei" value="<?php echo $fisik_mei ?>" class="form-control" onKeyup="total_fis('mei',this.value)">
		     <input type="hidden" name="fisik_mei_temp" id="fisik_mei_temp" value="<?php echo $fisik_mei ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Juni</td>
		<td> <input type="text" name="tarik_jun" id="tarik_jun" value="<?php echo $juni ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_jun" id="anggaran_jun" value="<?php echo $ang_juni ?>" class="form-control" onChange="total_ang('jun',this.value)">
		<input type="hidden" name="anggaran_jun_temp" id="anggaran_jun_temp" value="<?php echo $ang_juni ?>" ></td>
		<td> <input type="text" name="fisik_jun" id="fisik_jun" value="<?php echo $fisik_juni ?>" class="form-control" onKeyup="total_fis('jun',this.value)">
		     <input type="hidden" name="fisik_jun_temp" id="fisik_jun_temp" value="<?php echo $fisik_juni ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Juli</td>
		<td> <input type="text" name="tarik_jul" id="tarik_jul" value="<?php echo $juli ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_jul" id="anggaran_jul" value="<?php echo $ang_juli ?>" class="form-control" onChange="total_ang('jul',this.value)">
		<input type="hidden" name="anggaran_jul_temp" id="anggaran_jul_temp" value="<?php echo $ang_juli ?>" ></td>
		<td> <input type="text" name="fisik_jul" id="fisik_jul" value="<?php echo $fisik_juli ?>" class="form-control" onKeyup="total_fis('jul',this.value)">
		     <input type="hidden" name="fisik_jul_temp" id="fisik_jul_temp" value="<?php echo $fisik_juli ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Agustus</td>
		<td> <input type="text" name="tarik_agu" id="tarik_agu" value="<?php echo $agustus ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_agu" id="anggaran_agu" value="<?php echo $ang_agustus ?>" class="form-control" onChange="total_ang('agu',this.value)">
		<input type="hidden" name="anggaran_agu_temp" id="anggaran_agu_temp" value="<?php echo $ang_agustus ?>" ></td>
		<td> <input type="text" name="fisik_agu" id="fisik_agu" value="<?php echo $fisik_agustus ?>" class="form-control" onKeyup="total_fis('agu',this.value)">
		     <input type="hidden" name="fisik_agu_temp" id="fisik_agu_temp" value="<?php echo $fisik_agustus ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>September</td>
		<td> <input type="text" name="tarik_sep" id="tarik_sep" value="<?php echo $september ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_sep" id="anggaran_sep" value="<?php echo $ang_september ?>" class="form-control" onChange="total_ang('sep',this.value)">
		<input type="hidden" name="anggaran_sep_temp" id="anggaran_sep_temp" value="<?php echo $ang_september ?>" ></td>
		<td> <input type="text" name="fisik_sep" id="fisik_sep" value="<?php echo $fisik_september ?>" class="form-control" onKeyup="total_fis('sep',this.value)">
		     <input type="hidden" name="fisik_sep_temp" id="fisik_sep_temp" value="<?php echo $fisik_september ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Oktober</td>
		<td> <input type="text" name="tarik_okt" id="tarik_okt" value="<?php echo $oktober ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_okt" id="anggaran_okt" value="<?php echo $ang_oktober ?>" class="form-control" onChange="total_ang('okt',this.value)">
		<input type="hidden" name="anggaran_okt_temp" id="anggaran_okt_temp" value="<?php echo $ang_oktober ?>" ></td>
		<td> <input type="text" name="fisik_okt" id="fisik_okt" value="<?php echo $fisik_oktober ?>" class="form-control" onKeyup="total_fis('okt',this.value)">
		     <input type="hidden" name="fisik_okt_temp" id="fisik_okt_temp" value="<?php echo $fisik_oktober ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>November</td>
		<td> <input type="text" name="tarik_nov" id="tarik_nov" value="<?php echo $november ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_nov" id="anggaran_nov" value="<?php echo $ang_november ?>" class="form-control" onChange="total_ang('nov',this.value)">
		<input type="hidden" name="anggaran_nov_temp" id="anggaran_nov_temp" value="<?php echo $ang_februari ?>" ></td>
		<td> <input type="text" name="fisik_nov" id="fisik_nov" value="<?php echo $fisik_november ?>" class="form-control" onKeyup="total_fis('nov',this.value)">
		     <input type="hidden" name="fisik_nov_temp" id="fisik_nov_temp" value="<?php echo $fisik_november ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Desember</td>
		<td> <input type="text" name="tarik_des" id="tarik_des" value="<?php echo $desember ?>" class="form-control" readonly></td>
		<td> <input type="text" name="anggaran_des" id="anggaran_des" value="<?php echo $ang_desember ?>" class="form-control" onChange="total_ang('des',this.value)">
		<input type="hidden" name="anggaran_des_temp" id="anggaran_des_temp" value="<?php echo $ang_desember ?>" ></td>
		<td> <input type="text" name="fisik_des" id="fisik_des" value="<?php echo $fisik_desember ?>" class="form-control" onKeyup="total_fis('des',this.value)">
		     <input type="hidden" name="fisik_des_temp" id="fisik_des_temp" value="<?php echo $fisik_desember ?>" class="form-control"></td>
		</tr>
		<tr>
		<td>Total</td>
		<td> <input type="text" name="total_tarik" id="total_tarik" value="<?php echo $januari+$februari+$maret+$april+$mei+$juni+$juli+$agustus+$september+$oktober+$november+$desember ?>" class="form-control" ></td>
		<td> <input type="text" name="total_anggaran" id="total_anggaran" value="<?php echo $ang_januari+$ang_februari+$ang_maret+$ang_april+$ang_mei+$ang_juni+$ang_juli+$ang_agustus+$ang_september+$ang_oktober+$ang_november+$ang_desember ?>" class="form-control"></td>
		<td> <input type="text" name="total_fisik" id="total_fisik" value="<?php echo $fisik_januari+$fisik_februari+$fisik_maret+$fisik_april+$fisik_mei+$fisik_juni+$fisik_juli+$fisik_agustus+$fisik_september+$fisik_oktober+$fisik_november+$fisik_desember ?>" class="form-control"></td>
		</tr>
		</tbody>
	</table>
        
        <div class="col-xl-12 mb-2">
            <button id="update_item" type="button" class="btn btn-block btn-warning" data-dismiss="modal">Simpan</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </div>
</form>

<script type="text/javascript">
function total_ang(bulan,nominal)
{
	
	totalawal= $("#total_anggaran").val();
	pagu= $("#pagu").val();
	pengurang= $("#anggaran_"+bulan+"_temp").val();
	//alert(pengurang);
	 total_akhir=(parseInt(totalawal)-parseInt(pengurang))+parseInt(nominal);
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
	 total_akhir=(parseInt(totalawal)-parseInt(pengurang))+parseInt(nominal);

		 $("#total_fisik").val(total_akhir);
		 $("#fisik_"+bulan+"_temp").val(nominal);
	
    
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