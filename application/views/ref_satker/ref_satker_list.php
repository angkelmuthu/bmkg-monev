<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>KELOLA DATA SATKER</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="text-center">
                            <?php echo anchor(site_url('ref_satker/create'), '<i class="fal fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-primary btn-sm waves-effect waves-themed"'); ?></div>
                        <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Kode Satker</th>
                                    <th>Nama Satker</th>
                                    <th>Kode Jenis Satker</th>
                                    <th>Kode Parent Satker</th>
                                    <th>Alamat</th>
                                    <th>No Tlpn</th>
                                    <th>Penjabat PPK</th>
                                    <th>KPA</th>
                                    <th>Operator</th>
                                    <th>Email</th>
                                    <th>Kontak</th>
                                    <th>Kode Dept</th>
                                    <th>Kode Unit Kerja</th>
                                    <th>Aktif</th>
                                    <th width="200px">Action</th>
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
                "url": "ref_satker/json",
                "type": "POST"
            },
            columns: [{
                    "data": "id_satker",
                    "orderable": false
                }, {
                    "data": "kode_satker"
                }, {
                    "data": "nama_satker"
                }, {
                    "data": "kode_jenis_satker"
                }, {
                    "data": "kode_parent_satker"
                }, {
                    "data": "alamat"
                }, {
                    "data": "no_tlpn"
                }, {
                    "data": "penjabat_ppk"
                }, {
                    "data": "kpa"
                }, {
                    "data": "operator"
                }, {
                    "data": "email"
                }, {
                    "data": "kontak"
                }, {
                    "data": "kode_dept"
                }, {
                    "data": "kode_unit_kerja"
                }, {
                    "data": "aktif"
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