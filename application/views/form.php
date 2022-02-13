<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        CONTOH HELPER TAMBAHAN
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <table class="table">
                            <tr>
                                <td>Select option</td>
                                <td>
                                    <?php echo cmb_dinamis('test', 'tbl_menu', 'id_menu', 'title', '2', 'is_aktif="y"', 'id_menu ASC') ?>
                                    <br><code>helper : cmb_dinamis('test', 'tbl_menu', 'id_menu', 'title', '2', 'is_aktif="y"', 'id_menu ASC')
                                    </code>
                                </td>
                            </tr>
                            <tr>
                                <td>Select Option with Search</td>
                                <td>
                                    <?php echo select2_dinamis('test', 'tbl_menu', 'id_menu', 'title', '3', 'is_aktif="y"', 'id_menu ASC') ?>
                                    <br><code>helper :
                                        select2_dinamis('test', 'tbl_menu', 'id_menu', 'title', '3', 'is_aktif="y"', 'id_menu ASC')
                                    </code>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Datalist</td>
                                <td>
                                    <?php echo datalist_dinamis('test', 'tbl_menu', 'id_menu', 'title', '3', 'is_aktif="y"', 'id_menu ASC') ?>
                                    <br><code>helper :
                                        datalist_dinamis('test', 'tbl_menu', 'title')
                                    </code>
                                </td>
                            </tr> -->
                            <tr>
                                <td>Radio Button</td>
                                <td>
                                    <?php echo radiobtn_dinamis('test', 'tbl_menu', 'id_menu', 'title', '5', 'is_aktif="y"', 'id_menu ASC') ?>
                                    <br><code>helper :
                                        radiobtn_dinamis('test', 'tbl_menu', 'id_menu', 'title', '5', 'is_aktif="y"', 'id_menu ASC')
                                    </code>
                                </td>
                            </tr>
                            <tr>
                                <td>Aktif / Tidak Aktif</td>
                                <td>
                                    y = <?php echo y_or_n('y'); ?> <code>helper : y_or_n('y')</code> <br>
                                    n = <?php echo y_or_n('n'); ?> <code>helper : y_or_n('n')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Format Angka</td>
                                <td>
                                    <?php echo angka('3435345453'); ?>
                                    <br><code>helper : angka('3435345453')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Format Rupiah</td>
                                <td>
                                    <?php echo formatRP('3435345453'); ?>
                                    <br><code>helper : formatRP('3435345453')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Terbilang</td>
                                <td>
                                    <?php echo terbilang('3435345453'); ?>
                                    <br><code>helper : terbilang('3435345453')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Indo</td>
                                <td>
                                    <?php echo tgl_indo('1989-04-01'); ?>
                                    <br><code>helper : tgl_indo('1989-04-01')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Indo</td>
                                <td>
                                    <?php echo tgl_indo2('1989-04-01'); ?>
                                    <br><code>helper : tgl_indo2('1989-04-01')</code>
                                </td>
                            </tr>

                            <tr>
                                <td>Hitung Umur</td>
                                <td>
                                    <?php echo umur('1989-04-01'); ?>
                                    <br><code>helper : umur('1989-04-01')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Menghitung Waktu</td>
                                <td>
                                    <?php echo konversiwaktuLalu('1989-04-01'); ?>
                                    <br><code>helper : konversiwaktuLalu('1989-04-01')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Menghitung Hari</td>
                                <td>
                                    2021-01-01 lama hari sampai saat ini <?php echo how_days('2020-12-01', date('Y-m-d')); ?>
                                    <br><code>helper : how_days('2020-12-01', date('Y-m-d'))</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Uppercas (membuat huruf jadi besar)</td>
                                <td>
                                    "membuat huruf jadi besar" menjadi <?php echo kapital('membuat huruf jadi besar'); ?>
                                    <br><code>helper : kapital('membuat huruf jadi besar')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>LoremIpsum</td>
                                <td>
                                    <?php echo LoremIpsum(); ?>
                                    <br><code>helper : konversiwaktuLalu('') atau konversiwaktuLalu('paragraphs')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Date Mysql</td>
                                <td>
                                    10/12/2020 menjadi <?php echo date_to_mysql('10/12/2020'); ?>
                                    <br><code>helper : date_to_mysql('10/12/2020')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Date Mysql</td>
                                <td>
                                    2020-12-01 menjadi <?php echo date_from_mysql('2020-12-01'); ?>
                                    <br><code>helper : date_from_mysql('2020-12-01')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Datetime</td>
                                <td>
                                    2020-12-01 212111 menjadi <?php echo tanggaljam('2020-12-01 212111'); ?>
                                    <br><code>helper : date_from_mysql('2020-12-01 212111')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Numeric to Mysql</td>
                                <td>
                                    202.012.001 menjadi <?php echo numeric_to_mysql('202.012.001'); ?>
                                    <br><code>helper : numeric_to_mysql('202.012.001')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Clean String</td>
                                <td>
                                    "hányÃ Çontoh" menjadi <?php echo clean_string('hányÃ Çontoh'); ?>
                                    <br><code>helper : clean_string('hányÃ Çontoh')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Alert Js</td>
                                <td>
                                    <?php //echo alert_js('contoh alert');
                                    ?>
                                    <br><code>helper : alert_js('contoh alert')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Alert Bootstrap</td>
                                <td><?php echo alert_basic('primary', 'Informasi', 'contoh alert Basic'); ?>
                                    <br><code>helper : alert_basic('primary', 'Informasi', 'contoh alert')</code>
                                    <br>
                                    <?php echo alert_outline('primary', 'Informasi', 'contoh alert outline'); ?>
                                    <br><code>helper : alert_outline('primary', 'Informasi', 'contoh alert outline')</code>
                                    <br>
                                    <?php echo alert_alt('bg-info-500', 'Informasi', 'contoh alert Alternative'); ?>
                                    <br><code>helper : alert_alt('bg-info-500', 'Informasi', 'contoh alert Alternative')</code>
                                    <br>
                                    <?php echo alert_dismissable('primary', 'Informasi', 'contoh alert Dismissable'); ?>
                                    <br><code>helper : alert_dismissable('primary', 'Informasi', 'contoh alert')</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Tooltips Bootstrap</td>
                                <td><?php echo tooltips('#', 'primary', 'Informasi', 'contoh tooltips'); ?>
                                    <br><code>helper : tooltips('#', 'primary', 'Informasi', 'contoh tooltips')</code>
                                </td>
                            </tr>
                        </table>

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