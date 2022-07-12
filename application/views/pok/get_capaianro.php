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
                <th class="text-center">ID</th>
                <th class="text-center">KODE_KEMENTERIAN</th>
                <th class="text-center">KODE_UNIT</th>
                <th class="text-center">KDSATKER</th>
                <th class="text-center">SUB_OUTPUT_KODE</th>
                <th class="text-center">KODE_PERIODE</th>
                <th class="text-center">STATUS</th>
                <th class="text-center">RENCANA_SUB_OUTPUT</th>
                <th class="text-center">SATUAN_SUB_OUTPUT</th>
                <th class="text-center">PENAMBAHAN_REALISASI_VOLUME_RO</th>
                <th class="text-center">TOTAL_REALISASI_SUB_OUTPUT</th>
                <th class="text-center">PENAMBAHAN_PROGRESS_CAPAIAN_RO</th>
                <th class="text-center">TOTAL_PROGRESS_CAPAIAN_RO</th>
                <th class="text-center">BUKTI_DOKUMEN</th>
                <th class="text-center">REFERENSI_KETERANGAN</th>
                <th class="text-center">REFERENSI</th>
                <th class="text-center">KETERANGAN</th>
                <th class="text-center">RO_STRATEGIS</th>
                <th class="text-center">ANGGARAN_BELANJA</th>
                <th class="text-center">REALISASI_BELANJA</th>
                <th class="text-center">PENGEMBALIAN_BELANJA</th>
                <th class="text-center">PERSEN_GAP</th>
                <th class="text-center">REVISI_DIPA_KE</th>
            </tr>
         
        </thead>
        <tbody>
		<?php 
		//var_dump($get[0]->KODE_KEMENTERIAN);
		$i=0;
		foreach ($get as $value) { 
		$i++;
		?>
            <tr>
			
                <td class="text-center"><?= $i ?></td>
                <td class="text-center"><?= $value->KODE_KEMENTERIAN ?></td>
                <td class="text-center"><?= $value->KODE_UNIT ?></td>
                <td class="text-center"><?= $value->KDSATKER ?></td>
                <td class="text-center"><?= $value->SUB_OUTPUT_KODE ?></td>
                <td class="text-center"><?= $value->KODE_PERIODE ?></td>
                <td class="text-center"><?= $value->STATUS ?></td>
                <td class="text-center"><?= $value->RENCANA_SUB_OUTPUT ?></td>
                <td class="text-center"><?= $value->SATUAN_SUB_OUTPUT ?></td>
                <td class="text-center"><?= $value->PENAMBAHAN_REALISASI_VOLUME_RO ?></td>
                <td class="text-center"><?= $value->TOTAL_REALISASI_SUB_OUTPUT ?></td>
                <td class="text-center"><?= $value->PENAMBAHAN_PROGRESS_CAPAIAN_RO ?></td>
                <td class="text-center"><?= $value->TOTAL_PROGRESS_CAPAIAN_RO ?></td>
                <td class="text-center"><?= $value->BUKTI_DOKUMEN ?></td>
                <td class="text-center"><?= $value->REFERENSI_KETERANGAN ?></td>
                <td class="text-center"><?= $value->REFERENSI ?></td>
                <td class="text-center"><?= $value->KETERANGAN ?></td>
                <td class="text-center"><?= $value->RO_STRATEGIS ?></td>
                <td class="text-center"><?= $value->ANGGARAN_BELANJA ?></td>
                <td class="text-center"><?= $value->REALISASI_BELANJA ?></td>
                <td class="text-center"><?= $value->PENGEMBALIAN_BELANJA ?></td>
                <td class="text-center"><?= $value->PERSEN_GAP ?></td>
                <td class="text-center"><?= $value->REVISI_DIPA_KE ?></td>
            </tr>
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
        $(document).ready(function() {
            var table = $('#dt-basic-example').DataTable({
                scrollY: "500px",
                scrollX: true,
                scrollCollapse: true,
                ordering: false,
                paging: false,
               
            });
        });
    </script>