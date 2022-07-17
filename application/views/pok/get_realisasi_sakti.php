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
                <th class="text-center">KDSATKER</th>
                <th class="text-center">KODE_KEMENTERIAN</th>
                <th class="text-center">KD_JNS_SPP</th>
                <th class="text-center">NO_SPP</th>
                <th class="text-center">TGL_SPP</th>
                <th class="text-center">NO_SPM</th>
                <th class="text-center">TGL_SPM</th>
                <th class="text-center">NO_SP2D</th>
                <th class="text-center">TGL_SP2D</th>
                <th class="text-center">NO_SP2B</th>
                <th class="text-center">TGL_SP2B</th>
                <th class="text-center">URAIAN</th>
                <th class="text-center">KODE_COA</th>
                <th class="text-center">KODE_PROGRAM</th>
                <th class="text-center">KODE_KEGIATAN</th>
                <th class="text-center">KODE_OUTPUT</th>
                <th class="text-center">KODE_SUBOUTPUT</th>
                <th class="text-center">KODE_KOMPONEN</th>
                <th class="text-center">KODE_SUBKOMPONEN</th>
                <th class="text-center">KODE_AKUN</th>
                <th class="text-center">KODE_ITEM</th>
                <th class="text-center">MATA_UANG</th>
                <th class="text-center">KURS</th>
                <th class="text-center">NILAI_VALAS</th>
                <th class="text-center">NILAI_RUPIAH</th>
                <th class="text-center">STATUS_DATA</th>

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
                <td class="text-center"><?= $value->KDSATKER ?></td>
                <td class="text-center"><?= $value->KODE_KEMENTERIAN ?></td>
                <td class="text-center"><?= $value->KD_JNS_SPP ?></td>
                <td class="text-center"><?= $value->NO_SPP ?></td>
                <td class="text-center"><?= $value->TGL_SPP ?></td>
                <td class="text-center"><?= $value->NO_SPM ?></td>
                <td class="text-center"><?= $value->TGL_SPM ?></td>
                <td class="text-center"><?= $value->NO_SP2D ?></td>
                <td class="text-center"><?= $value->TGL_SP2D ?></td>
                <td class="text-center"><?= $value->NO_SP2B ?></td>
                <td class="text-center"><?= $value->TGL_SP2B ?></td>
                <td class="text-center"><?= $value->URAIAN ?></td>
                <td class="text-center"><?= $value->KODE_COA ?></td>
                <td class="text-center"><?= $value->KODE_PROGRAM ?></td>
                <td class="text-center"><?= $value->KODE_KEGIATAN ?></td>
                <td class="text-center"><?= $value->KODE_OUTPUT ?></td>
                <td class="text-center"><?= $value->KODE_SUBOUTPUT ?></td>
                <td class="text-center"><?= $value->KODE_KOMPONEN ?></td>
                <td class="text-center"><?= $value->KODE_SUBKOMPONEN ?></td>
                <td class="text-center"><?= $value->KODE_AKUN ?></td>
                <td class="text-center"><?= $value->KODE_ITEM ?></td>
                <td class="text-center"><?= $value->MATA_UANG ?></td>
                <td class="text-center"><?= $value->KURS ?></td>
                <td class="text-center"><?= $value->NILAI_VALAS ?></td>
                <td class="text-center"><?= $value->NILAI_RUPIAH ?></td>
                <td class="text-center"><?= $value->STATUS_DATA ?></td>
               
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
