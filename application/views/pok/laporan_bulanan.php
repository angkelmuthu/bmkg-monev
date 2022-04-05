<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>LAPORAN BULANAN PELAKSANAAN KEGIATAN </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
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
                                <td>Bulan</td>
                                <td><select class="form-control" name="bulan" id="bulan" required>
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                       
                                    </select></td>
                            </tr>
							<tr>
							<td></td>
							<td><button type="button" onClick="cari()" class="btn btn-block btn-success">Cari</button></td>
							</tr>

                        </table>
                        <div id="tampil"></div>

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
  function cari()
  {
	  satker= $("#kode_satker").val();
	  tahun= $("#ta").val();
	  bulan= $("#bulan").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>pok/get_laporan_bulanan/"+satker+"/"+tahun+"/"+bulan,
            cache: false,
            success: function(data) {
                $("#tampil").html(data);
            }
        });
    }
</script>
<script>
  function kirim(id)
  {

	  satker= $("#kode_satker").val();
	  tahun= $("#ta").val();
	  bulan= $("#bulan").val();
	  nama= $("#bulan option:selected").text();
       swal({
						  title: "Data "+nama+" Akan Di Kirim.??",
						  text: "Data yang sudah dikirim tidak akan bisa di rubah kembali",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "Ya",
						  cancelButtonText: "Tidak",
						  closeOnConfirm: true,
						  closeOnCancel: true
						},
						function(isConfirm){
						  if (isConfirm) {
							 jQuery.post('<?php echo site_url('pok/kirim_realisasi')?>',{id:id,satker:satker,tahun:tahun,bulan:bulan,status:"Terkirim"},function(data) {
									var explode = eval("(" + data + ")");
									alert(explode.msg);
										$.ajax({
											type: 'POST',
											url: "<?php echo base_url(); ?>pok/get_laporan_bulanan/"+satker+"/"+tahun+"/"+bulan,
											cache: false,
											success: function(data) {
												$("#tampil").html(data);
											}
										});
							  }); 
						  }else{
							swal("Data Laporan "+nama+" Tidak Dikirim");
						  }						  
						});
    }
</script>