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
                <th class="text-center">NAMA</th>
                <th class="text-center">NIP</th>
                <th class="text-center">TELPON</th>
                <th class="text-center">EMAIL</th>
                <th class="text-center">JABATAN</th>
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
                <td class="text-center"><?= $value->NAMA ?></td>
                <td class="text-center"><?= $value->NIP ?></td>
                <td class="text-center"><?= $value->TELPON ?></td>
                <td class="text-center"><?= $value->EMAIL ?></td>
                <td class="text-center"><?= $value->JABATAN ?></td>
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