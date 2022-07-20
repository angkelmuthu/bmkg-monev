
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Import Realisasi Omspan </h2>
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
                                <td>Tahun Anggaran</td>
                                <td><select class="form-control" name="ta" id="ta" required>
                                        <option value="">Pilih Tahun</option>
                                        <?php
                                        for ($i = date('Y'); $i >= date('Y') - 10; $i -= 1) {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                        ?>
                                    </select></td>
                            </tr>
							<tr>
                                <td>File TXT</td>
                                <td><input type="file" id="impor"  class="btn btn-warning" name="impor"></td>
                            </tr>
							<tr>
							<td> </td>
							<td><button type="submit" class="btn btn-block btn-success" name='submit' value='import'>Import</button></td>
							</tr>

                        </table>
					</form>
					 <div class="ajax-loader text-center">
                            <img id="loading-pok" style="display:none;" src="<?php echo base_url() ?>assets/smartadmin/img/loading.gif" class="img-responsive" />
						</div>
						
                       

                    </div>
					
                </div>
            </div>
        </div>
    </div>
</main>
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Data Realisasi Omspan </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
					<div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-clean">
                           
                            <tr>
                                <td>Satker</td>
                                <td>
								<?php if ($this->session->userdata('id_user_level') != 1) { ?>
								<?php 
								echo select2_dinamis('kode_satker', 'ref_satker', 'kode_satker', 'nama_satker', $kode_unit_kerja, 'kode_satker="'.$kode_unit_kerja.'"', 'id_satker ASC') 
							
								
								?></td>
								<?php }else{ ?>
								<?php 
								echo select2_dinamis('kode_satker', 'ref_satker', 'kode_satker', 'nama_satker', $kode_unit_kerja, 'aktif="y"', 'id_satker ASC') 
								
								?></td>
								<?php } ?>
                            </tr>
							 <tr>
                                <td>Tahun Anggaran</td>
                                <td><select class="form-control" name="tahun" id="tahun" >
                                        <option value="">Pilih Tahun</option>
                                        <?php
                                        for ($i = date('Y'); $i >= date('Y') - 10; $i -= 1) {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                        ?>
                                    </select></td>
                            </tr>
							<tr>
							<td></td>
							<td><button type="button" onClick="cari()" class="btn btn-block btn-danger">Cari</button></td>
							</tr>

                        </table>
                        <div id="tampil"></div>

                    </div>
					
                </div>
					</div>
            </div>
        </div>
    </div>
</main>
					
					
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/select2/select2.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/kostum.js"></script>
<script>
 function confSubmit() {
	var r=confirm('Apakah ingin di import..??');
     $("#loading-pok").show();
      return r;  
 }
 function cari(){
	 $("#loading-pok").show();
	  kode_satker= $("#kode_satker").val();
	  ta= $("#tahun").val();
	  
	  if(ta=='')
	  {
		  alert("pilih tahun");
		   $("#loading-pok").hide();
	  }else{
	   $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>"+"pok/data_realisasi_omspan/"+kode_satker+"/"+ta,
            cache: false,
            success: function(data) {
                $("#tampil").html(data);
				 $("#loading-pok").hide();
            }
        });
	  }
 
 }

 
    $(document).ready(function() {
		 $("#loading-pok").hide();
        //$.fn.modal.Constructor.prototype.enforceFocus = function() {};
        //Tampilkan Data
	/* 	 $("#loading-pok").show();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>"+"pok/data_realisasi_omspan",
            cache: false,
            success: function(data) {
                $("#tampil").html(data);
				 $("#loading-pok").hide();
            }
        }); */
    });
</script>