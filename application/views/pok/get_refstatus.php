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
                <th class="text-center">KDSATKER</th>
                <th class="text-center">KODE_STS_HISTORY</th>
                <th class="text-center">JENIS_REVISI</th>
                <th class="text-center">REVISI_KE</th>
                <th class="text-center">PAGU_BELANJA</th>
                <th class="text-center">NO_DIPA</th>
                <th class="text-center">TGL_DIPA</th>
                <th class="text-center">TGL_REVISI</th>
                <th class="text-center">APPROVE</th>
                <th class="text-center">APPROVE_SPAN</th>
                <th class="text-center">VALIDATED</th>
                <th class="text-center">FLAG_UPDATE_COA</th>
                <th class="text-center">OWNER</th>
                <th class="text-center">DIGITAL_STAMP</th>
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
                <td class="text-center"><?= $value->KDSATKER ?></td>
                <td class="text-center"><?= $value->KODE_STS_HISTORY ?></td>
                <td class="text-center"><?= $value->JENIS_REVISI ?></td>
                <td class="text-center"><?= $value->REVISI_KE ?></td>
                <td class="text-center"><?= $value->PAGU_BELANJA ?></td>
                <td class="text-center"><?= $value->NO_DIPA ?></td>
                <td class="text-center"><?= $value->TGL_DIPA ?></td>
                <td class="text-center"><?= $value->TGL_REVISI ?></td>
                <td class="text-center"><?= $value->APPROVE ?></td>
                <td class="text-center"><?= $value->APPROVE_SPAN ?></td>
                <td class="text-center"><?= $value->VALIDATED ?></td>
                <td class="text-center"><?= $value->FLAG_UPDATE_COA ?></td>
                <td class="text-center"><?= $value->OWNER ?></td>
                <td class="text-center"><?= $value->DIGITAL_STAMP ?></td>
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
