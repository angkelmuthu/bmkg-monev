<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>KELOLA DATA POK</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="text-center">
                            <?php //echo anchor(site_url('pok/read/0'), '<i class="fal fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-primary btn-sm waves-effect waves-themed"');
                            ?>
                            <?php if ($this->session->userdata('id_user_level') != 1) { ?>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#default-example-modal"><i class="fal fa-plus-square"></i> Tambah Kegiatan</button>
                            <?php } ?>
                        </div>
                        <div class="modal fade" id="default-example-modal" role="dialog" aria-hidden="true" style="overflow:hidden;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <!-- <form action="" method="post"> -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            Kegiatan
                                            <small class="m-0 text-muted">
                                                Pilih kegiatan dibawah untuk menambah
                                            </small>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <form method="post" action="<?php echo site_url('Pok/tambah_kegiatan') ?>">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="new" value="Y">
                                                <label class="form-label" for="single-default">
                                                    Kegiatan
                                                </label>
                                                <select name="kode_kegiatan" id="kode_kegiatan" class="select2 form-control w-100" required="">
                                                    <?php
                                                    $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
                                                    $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
                                                    $this->db->order_by('kode_kegiatan', 'ASC');
                                                    $row_keg = $this->db->get('ref_kegiatan')->result();
                                                    foreach ($row_keg as $keg) { ?>
                                                        <option value="<?php echo $keg->kode_kegiatan ?>"><?php echo $keg->kode_kegiatan . '-' . $keg->nama_kegiatan ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php //echo select2_custom_2('kode_kegiatan', 'ref_kegiatan', 'kode_kegiatan', 'kode_kegiatan', 'nama_kegiatan', 'kode_dept="' . $this->session->userdata("kode_dept") . '" and kode_unit_kerja="' . $this->session->userdata("kode_unit_kerja") . '"', 'aktif="y"', 'nama_kegiatan ASC')
                                                ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button id="tambah_kegiatan" type="submit" class="btn btn-warning">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Dept</th>
                                    <th>Unit Kerja</th>
                                    <th>Satker</th>
                                    <th>Create Date</th>
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
                "url": "pok/json",
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