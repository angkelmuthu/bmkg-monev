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
                <th class="text-center">NOMOR</th>
                <th class="text-center">KODE_KEMENTERIAN</th>
                <th class="text-center">KODE_UNIT</th>
                <th class="text-center">KDSATKER</th>
                <th class="text-center">KODE_KAB_KOTA</th>
                <th class="text-center">URAIAN_KODE_KAB_KOTA</th>
                <th class="text-center">KODE_KEWENANGAN</th>
                <th class="text-center">URAIAN_KEWENANGAN</th>
                <th class="text-center">KODE_KPPN</th>
                <th class="text-center">NAMA_KPPN</th>

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
                <td class="text-center"><?= $value->KODE_KAB_KOTA ?></td>
                <td class="text-center"><?= $value->URAIAN_KODE_KAB_KOTA ?></td>

                <td class="text-center"><?= $value->KODE_KEWENANGAN ?></td>
                <td class="text-center"><?= $value->URAIAN_KEWENANGAN ?></td>
                <td class="text-center"><?= $value->KODE_KPPN ?></td>
                <td class="text-center"><?= $value->NAMA_KPPN ?></td>
               
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
