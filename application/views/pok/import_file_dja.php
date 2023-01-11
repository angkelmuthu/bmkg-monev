<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Import DJA </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
					<form  method="post" enctype="multipart/form-data"  class="form-horizontal" role="form" onsubmit="return confSubmit();">
                        <table class="table table-clean">
							<tr>
                                <td>File DJA (Hanya File ZIP dan RAR)</td>
                                <td><input type="file" id="impor"  class="btn btn-warning" name="impor"></td>
                            </tr>
							<tr>
							<td> </td>
							<td><button type="submit" class="btn btn-block btn-success" name='submit' value='import'>Import</button>
							
							</td>
							</tr>

                        </table>
					</form>
					<button class="btn btn-block btn-danger" onclick="exe()"  id="exe" >Execute</button>
					 <div class="ajax-loader text-center">
                            <img id="loading-pok" style="display:none;" src="<?php echo base_url() ?>assets/smartadmin/img/loading.gif" class="img-responsive" />
					</div>
						<table class="table table-sm table-bordered table-hover table-striped" id="dt-basic-example">
						<thead class="thead-themed">
							<tr>
								<th class="text-center">Nomor</th>
								<th class="text-center">Nama File</th>
								<th class="text-center">Hapus</th>
							  
							</tr>
						 
						</thead>
						<tbody>
						<?php 
						//var_dump($get[0]->KODE_KEMENTERIAN);
						$i=0;
						if(!empty($file))
						{
						foreach ($file as $value) { 
						$i++;
						?>
							<tr>
								<td class="text-center"><?= $i ?></td>
								<td class="text-left"><?= $value ?></td>
								<td class="text-center"><button class="btn btn-block btn-danger" onclick="hapus('<?php echo $value ?>')"  id="delete" >Hapus</button></td>
							</tr>
						<?php }} ?>
					 
						</tbody>
					</table>
                       

                    </div>
					
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>

<script>
function exe()
  {
					 swal({
					  title: "Akan mengeksekusi file dja terakhir ?",
						  text: "Data akan di ubah dengan yang baru",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "Ya, Eksekusi",
					  cancelButtonText: "Tidak",
					  closeOnCancel: false
					},
					function(isConfirm){
					  if (isConfirm) {
						  
					       jQuery.post('<?php echo site_url('pok/exe_file')?>',{},function(data) {
								swal(data);
								location.reload(); 
							}); 
					  } else {
						swal("File Tidak Jadi Di ubah");
					  }
					});



  }
  function hapus(nama)
  {
					 swal({
					  title: "File "+nama+" akan dihapus ?",
						  text: "Data akan dihapus permanen",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "Ya, Hapus",
					  cancelButtonText: "Tidak",
					  closeOnConfirm: false,
					  closeOnCancel: false
					},
					function(isConfirm){
					  if (isConfirm) {
						  
					       jQuery.post('<?php echo site_url('pok/hapus_file')?>',{nama:nama},function(data) {
								swal("Data sudah di hapus.!!");
								location.reload(); 
							}); 
					  } else {
						swal("File Tidak Jadi Di hapus");
					  }
					});



  }
 </script>