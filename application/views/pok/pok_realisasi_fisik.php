<main id="js-page-content" role="main" class="page-content">
    <div class="row">
	
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>REALISASI</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Dept</th>
                                    <th>Unit Kerja</th>
                                    <th>Satker</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.export.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        var t = $("#dt-basic-example").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "json_realisasi_fisik",
                "type": "POST"
            },
            columns: [{
                    "data": "id_program",
                    "orderable": false
                }, {
                    "data": "tahun_anggaran"
                }, {
                    "data": "nama_dept"
                }, {
                    "data": "nama_unit_kerja"
                }, {
                    "data": "nama_satker"
                }, {
                    "data": "create_date"
                },
				{
                    render: function(data,type,row){
						if(row.kirim==null)
						{
							return '';
						}else{
							get=row.kirim.split(",");
							
							show="";
							for(var i = 0; i < get.length; i++) {
								getstatus=get[i].split("-");
								tahun=<?= $this->session->userdata('ta') ?>;
								if(getstatus[i]=='Terkirim')
								{
									show =show+'<a href="<?php echo base_url("pok/view_laporan_bulanan/'+row.kode_satker+'/'+tahun+'/'+getstatus[2]+'") ?>" ><span class="badge badge-danger">Realisasi '+getstatus[0]+' '+getstatus[1]+'</span></a></br>';
								}else{
									show =show+'<a href="<?php echo base_url("pok/view_laporan_bulanan/'+row.kode_satker+'/'+tahun+'/'+getstatus[2]+'") ?>" ><span class="badge badge-success">Realisasi '+getstatus[0]+' '+getstatus[1]+'</span></a></br>';
								}
							}
							return show;
						}
					}
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>