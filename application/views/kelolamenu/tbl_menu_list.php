<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        SETTING TAMPILAN MENU
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <!-- <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            <?php echo form_open('kelolamenu/simpan_setting') ?>
                            <table class="table">
                                <tr>
                                    <td width="250">Tampilkan Menu Berdasarkan Level</td>
                                    <td>

                                        <?php
                                        echo form_dropdown('tampil_menu', array('ya' => 'YA', 'tidak' => 'TIDAK'), $setting['value'], array('class' => 'form-control'));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="btn btn-primary waves-effect waves-themed">Simpan Perubahan</button></td>
                                </tr>
                            </table>
                            </form>
                        </div>

                    </div>
                </div> -->


                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="text-center">
                            <?php echo anchor(site_url('kelolamenu/create'), '<i class="fal fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-primary waves-effect waves-themed"'); ?>
                            <?php //echo anchor(site_url('kelolamenu/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"');
                            ?>
                            <?php //echo anchor(site_url('kelolamenu/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"');
                            ?>
                        </div>
                        <table id="menu" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Is Main Menu</th>
                                    <th>Is Aktif</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list as $menu) { ?>
                                    <tr>
                                        <td widtd="30px"><?php echo $no++ ?></td>
                                        <td><?php echo $menu->title ?></td>
                                        <td><?php echo $menu->url ?></td>
                                        <td><?php echo $menu->icon ?></td>
                                        <td><?php echo $menu->is_main_menu ?></td>
                                        <td><?php echo rename_string_is_aktif($menu->is_aktif) ?></td>
                                        <td width="100px">
                                            <a href="<?php echo site_url('kelolamenu/update/' . $menu->id_menu) ?>" class="btn btn-xs btn-warning"><i class="fal fa-pencil" aria-hidden="true"></i></a>
                                            <?php if ($menu->type != 'core') { ?>
                                                <a href="<?php echo site_url('kelolamenu/delete/' . $menu->id_menu) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are You Sure ?')"><i class="fal fa-trash" aria-hidden="true"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
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
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/datagrid/datatables/datatables.export.js"></script>
<script>
    $(document).ready(function() {
        $(' #menu').DataTable();
    });
</script>
<!-- <script type="text/javascript">
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
                "url": "kelolamenu/json",
                "type": "POST"
            },
            columns: [{
                    "data": "id_menu",
                    "orderable": false
                }, {
                    "data": "title"
                }, {
                    "data": "url"
                }, {
                    "data": "icon"
                }, {
                    "data": "is_main_menu"
                }, {
                    "data": "is_aktif"
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
</script> -->