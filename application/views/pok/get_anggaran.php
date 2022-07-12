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
                <th class="text-center">KDSATKER</th>
                <th class="text-center">KODE_PROGRAM</th>
                <th class="text-center">KODE_KEGIATAN</th>
                <th class="text-center">KODE_OUTPUT</th>
                <th class="text-center">KDIB</th>
                <th class="text-center">VOLUME_OUTPUT</th>
                <th class="text-center">KODE_SUBOUTPUT</th>
                <th class="text-center">VOLUME_SUBOUTPUT</th>
                <th class="text-center">KODE_KOMPONEN</th>
                <th class="text-center">KODE_SUBKOMPONEN</th>
                <th class="text-center">URAIAN_SUBKOMPONEN</th>
                <th class="text-center">KODE_AKUN</th>
                <th class="text-center">KODE_JENIS_BEBAN</th>
                <th class="text-center">KODE_CARA_TARIK</th>
                <th class="text-center">KODE_JENIS_BANTUAN</th>
                <th class="text-center">KODE_REGISTER</th>
                <th class="text-center">HEADER1</th>
                <th class="text-center">HEADER2</th>
                <th class="text-center">KODE_ITEM</th>
                <th class="text-center">NOMOR_ITEM</th>
                <th class="text-center">CONS_ITEM</th>
                <th class="text-center">URAIAN_ITEM</th>
                <th class="text-center">SUMBER_DANA</th>
                <th class="text-center">VOL_KEG_1</th>
                <th class="text-center">SAT_KEG_1</th>
                <th class="text-center">VOL_KEG_2</th>
                <th class="text-center">SAT_KEG_2</th>
                <th class="text-center">VOL_KEG_3</th>
                <th class="text-center">SAT_KEG_3</th>
                <th class="text-center">VOL_KEG_4</th>
                <th class="text-center">SAT_KEG_4</th>
                <th class="text-center">VOLKEG</th>
                <th class="text-center">SATKEG</th>
                <th class="text-center">HARGASAT</th>
                <th class="text-center">TOTAL</th>
                <th class="text-center">KODE_BLOKIR</th>
                <th class="text-center">NILAI_BLOKIR</th>
                <th class="text-center">KODE_STS_HISTORY</th>
                <th class="text-center">POK_NILAI_1</th>
                <th class="text-center">POK_NILAI_2</th>
                <th class="text-center">POK_NILAI_3</th>
                <th class="text-center">POK_NILAI_4</th>
                <th class="text-center">POK_NILAI_5</th>
                <th class="text-center">POK_NILAI_6</th>
                <th class="text-center">POK_NILAI_7</th>
                <th class="text-center">POK_NILAI_8</th>
                <th class="text-center">POK_NILAI_9</th>
                <th class="text-center">POK_NILAI_10</th>
                <th class="text-center">POK_NILAI_11</th>
                <th class="text-center">POK_NILAI_12</th>
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
                <td class="text-center"><?= $value->KODE_PROGRAM ?></td>
                <td class="text-center"><?= $value->KODE_KEGIATAN ?></td>
                <td class="text-center"><?= $value->KODE_OUTPUT ?></td>
                <td class="text-center"><?= $value->KDIB ?></td>
                <td class="text-center"><?= $value->VOLUME_OUTPUT ?></td>
                <td class="text-center"><?= $value->KODE_SUBOUTPUT ?></td>
                <td class="text-center"><?= $value->VOLUME_SUBOUTPUT ?></td>
                <td class="text-center"><?= $value->KODE_KOMPONEN ?></td>
                <td class="text-center"><?= $value->KODE_SUBKOMPONEN ?></td>
                <td class="text-center"><?= $value->URAIAN_SUBKOMPONEN ?></td>
                <td class="text-center"><?= $value->KODE_AKUN ?></td>
                <td class="text-center"><?= $value->KODE_JENIS_BEBAN ?></td>
                <td class="text-center"><?= $value->KODE_CARA_TARIK ?></td>
                <td class="text-center"><?= $value->KODE_JENIS_BANTUAN ?></td>
                <td class="text-center"><?= $value->KODE_REGISTER ?></td>
                <td class="text-center"><?= $value->HEADER1 ?></td>
                <td class="text-center"><?= $value->HEADER2 ?></td>
                <td class="text-center"><?= $value->KODE_ITEM ?></td>
                <td class="text-center"><?= $value->NOMOR_ITEM ?></td>
                <td class="text-center"><?= $value->CONS_ITEM ?></td>
                <td class="text-center"><?= $value->URAIAN_ITEM ?></td>
                <td class="text-center"><?= $value->SUMBER_DANA ?></td>
                <td class="text-center"><?= $value->VOL_KEG_1 ?></td>
                <td class="text-center"><?= $value->SAT_KEG_1 ?></td>
                <td class="text-center"><?= $value->VOL_KEG_2 ?></td>
                <td class="text-center"><?= $value->SAT_KEG_2 ?></td>
                <td class="text-center"><?= $value->VOL_KEG_3 ?></td>
                <td class="text-center"><?= $value->SAT_KEG_3 ?></td>
                <td class="text-center"><?= $value->VOL_KEG_4 ?></td>
                <td class="text-center"><?= $value->SAT_KEG_4 ?></td>
                <td class="text-center"><?= $value->VOLKEG ?></td>
                <td class="text-center"><?= $value->SATKEG ?></td>
                <td class="text-center"><?= $value->HARGASAT ?></td>
                <td class="text-center"><?= $value->TOTAL ?></td>
                <td class="text-center"><?= $value->KODE_BLOKIR ?></td>
                <td class="text-center"><?= $value->NILAI_BLOKIR ?></td>
                <td class="text-center"><?= $value->KODE_STS_HISTORY ?></td>
                <td class="text-center"><?= $value->POK_NILAI_1 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_2 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_3 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_4 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_5 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_6 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_7 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_8 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_9 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_10 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_11 ?></td>
                <td class="text-center"><?= $value->POK_NILAI_12 ?></td>
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
