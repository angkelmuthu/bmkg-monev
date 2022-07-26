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
                <th class="text-center">kdsatker</th>
                <th class="text-center">ba</th>
                <th class="text-center">baes1</th>
                <th class="text-center">akun</th>
                <th class="text-center">program</th>
                <th class="text-center">kegiatan</th>
                <th class="text-center">output</th>
                <th class="text-center">kewenangan</th>
                <th class="text-center">sumber_dana</th>
                <th class="text-center">cara_tarik</th>
                <th class="text-center">kdregister</th>
                <th class="text-center">lokasi</th>
                <th class="text-center">budget_type</th>
                <th class="text-center">tanggal</th>
                <th class="text-center">amount</th>
                <th class="text-center">create_date</th>
                <th class="text-center">tahun</th>
            </tr>
  
        </thead>
        <tbody>
		<?php 
		$i=0;
		foreach ($row as $value) { 
		$i++;
		?>
            <tr>
			
                <td class="text-center"><?= $i ?></td>
                <td class="text-center"><?= $value->kdsatker ?></td>
                <td class="text-center"><?= $value->ba ?></td>
                <td class="text-center"><?= $value->baes1 ?></td>
                <td class="text-center"><?= $value->akun ?></td>
                <td class="text-center"><?= $value->program ?></td>
                <td class="text-center"><?= $value->kegiatan ?></td>
                <td class="text-center"><?= $value->output ?></td>
                <td class="text-center"><?= $value->kewenangan ?></td>
                <td class="text-center"><?= $value->sumber_dana ?></td>
                <td class="text-center"><?= $value->cara_tarik ?></td>
                <td class="text-center"><?= $value->kdregister ?></td>
                <td class="text-center"><?= $value->lokasi ?></td>
                <td class="text-center"><?= $value->budget_type ?></td>
                <td class="text-center"><?= $value->tanggal ?></td>
                <td class="text-center"><?= $value->amount ?></td>
                <td class="text-center"><?= $value->create_date ?></td>
                <td class="text-center"><?= $value->tahun ?></td>
               
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
