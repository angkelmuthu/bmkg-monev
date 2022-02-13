<?php
error_reporting(0);
require_once 'core/harviacode.php';
require_once 'core/helper.php';
require_once 'core/process.php';
?>
<!doctype html>
<html>

<head>
    <title>Harviacode Codeigniter CRUD Generator</title>
    <link rel="stylesheet" href="core/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> -->
    <link rel="stylesheet" href="core/style.css" />
</head>

<body>
    <div class="row">
        <?php
        if (empty($_GET['table'])) { ?>
            <div class="col-md-12">

                <div class="col-lg-12">
                    <h4>Table List</h4>
                    <input type="search" class="form-control" id="input-search" placeholder="Search Table...">
                </div>
                <div class="searchable-container">
                    <?php
                        $table_list = $hc->table_list();
                        foreach ($table_list as $table) { ?>
                        <div class="items col-xs-12 col-sm-3 col-md-3 col-lg-3 clearfix">
                            <div class="info-block block-info clearfix">
                                <a href="index.php?table=<?php echo $table['table_name'] ?>" class="btn btn-block btn-success"><?php echo $table['table_name'] ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-12">
                <form action="index.php" method="POST">

                    <!-- <div class="form-group">
                        <label>Select Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Please Select</option>
                            <?php
                                $table_list = $hc->table_list();
                                $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                                foreach ($table_list as $table) {
                                    ?>
                                <option value="<?php echo $table['table_name'] ?>" <?php echo $table_list_selected == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                                <?php
                                    }
                                    ?>
                        </select>
                    </div> -->

                    <input type="hidden" id="table_name" name="table_name" class="form-control" value="<?php echo $_GET['table']; ?>" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="tombol" name="tombol" value="<?php echo ucfirst($_GET['table']); ?>" class="form-control" placeholder="Nama Tombol" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Jenis Table List</label>
                            <?php $jenis_tabel = isset($_POST['jenis_tabel']) ? $_POST['jenis_tabel'] : 'reguler_table'; ?>
                            <div class="form-group">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="reguler_table" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                                        Reguler Table
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                                        Serverside Datatables
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Export</label>
                            <div class="form-group">
                                <div class="checkbox">
                                    <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : ''; ?>
                                    <label>
                                        <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                        Export Excel
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : ''; ?>
                                    <label>
                                        <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                        Export Word
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Custom Controller Name</label>
                                <input type="text" id="controller" name="controller" value="<?php echo ucfirst($_GET['table']); ?>" class="form-control" placeholder="Controller Name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Custom Model Name</label>
                                <input type="text" id="model" name="model" value="<?php echo ucfirst($_GET['table']) . '_model' ?>" class="form-control" placeholder="Controller Name" />
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Field Name</th>
                                <!-- <th>NULL</th> -->
                                <th>Data Type</th>
                                <th>Label</th>
                                <th>Input Type</th>
                                <th>Atribut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $colums = $hc->not_primary_field($_GET['table']);
                                $no = 1;
                                foreach ($colums as $column) {
                                    ?>
                                <tr>
                                    <td><b><?php echo $column['column_name'] ?></b></td>
                                    <!-- <td><?php echo $column['column_key'] ?></td> -->
                                    <td><?php echo $column['data_type'] ?></td>
                                    <td><input type="text" name="set[<?php echo $column['ordinal_position'] ?>][label]" class="form-control" value="<?php echo label($column['column_name']) ?>" multiple /></td>
                                    <td>
                                        <input type="hidden" name="kolom[<?php echo $column['ordinal_position'] ?>][xx]" value="<?php echo $column['ordinal_position'] ?>" />
                                        <div class="form-group">
                                            <select name="gen[<?php echo $column['ordinal_position'] ?>][test]" class="form-control" id="ddlPassport<?php echo $no ?>">
                                                <option value="text">Text</option>
                                                <option value="number">Number</option>
                                                <option value="area">Text Area</option>
                                                <option value="select">Select Option</option>
                                                <option value="select2">Select With Search</option>
                                                <option value="radio">Radio Button</option>
                                                <option value="date">Date</option>
                                                <option value="datenow">Date Now</option>
                                                <option value="datetime">Date Time</option>
                                                <option value="datetimenow">Date Time Now</option>
                                                <option value="iduser">Id User</option>
                                                <option value="nmuser">Nama User</option>
                                                <option value="segment3">Uri Segment 3</option>
                                                <option value="segment4">Uri Segment 4</option>
                                            </select>
                                        </div>
                                        <div id="vaicode<?php echo $no ?>" style="display: none">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <select name="tabel[<?php echo $column['ordinal_position'] ?>][satu]" class="form-control">
                                                            <option value="">pilih tabel relasi</option>
                                                            <?php
                                                                    $table_list = $hc->table_list();
                                                                    foreach ($table_list as $table) { ?>
                                                                <option value="<?php echo $table['table_name'] ?>"><?php echo $table['table_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>


                                                    <!-- <input type="text" name="tabel[<?php echo $column['ordinal_position'] ?>][satu]" class="form-control" multiple /> -->
                                                    <td><input type="text" name="tabel_ket[<?php echo $column['ordinal_position'] ?>][dua]" class="form-control" placeholder="Value" multiple /></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="document.getElementById('value-info').style.display='block';" class="btn btn-info">i</a>
                                                    </td>
                                                    <td><input type="text" name="tabel_id[<?php echo $column['ordinal_position'] ?>][tiga]" class="form-control" placeholder="Label" multiple /></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="document.getElementById('label-info').style.display='block';" class="btn btn-info">i</a>
                                                    </td>
                                                    <td><input type="text" name="tabel_id[<?php echo $column['ordinal_position'] ?>][empat]" class="form-control" placeholder="Selected" multiple /></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="document.getElementById('selected-info').style.display='block';" class="btn btn-info">i</a>
                                                    </td>
                                                    <td><input type="text" name="tabel_id[<?php echo $column['ordinal_position'] ?>][lima]" class="form-control" placeholder="Where Field" multiple /></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="document.getElementById('where-info').style.display='block';" class="btn btn-info">i</a>
                                                    </td>
                                                    <!-- <td><input type="text" name="tabel_id[<?php echo $column['ordinal_position'] ?>][enam]" class="form-control" placeholder="Where Value" multiple /></td> -->
                                                    <td><input type="text" name="tabel_id[<?php echo $column['ordinal_position'] ?>][tujuh]" class="form-control" placeholder="Order By" multiple /></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="document.getElementById('orderby-info').style.display='block';" class="btn btn-info">i</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>

                                    <td>
                                        <div id="vaicode2<?php echo $no ?>">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="req" name="gen[<?php echo $column['ordinal_position'] ?>][req]">
                                                <label class="form-check-label" for="req">
                                                    Required
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="read" name="gen[<?php echo $column['ordinal_position'] ?>][read]">
                                                <label class="form-check-label" for="read">
                                                    Readonly
                                                </label>
                                            </div>
                                            <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="gen[<?php echo $column['ordinal_position'] ?>][hide]">
                                            <label class="form-check-label" for="hide">
                                                Hidden
                                            </label>
                                        </div> -->
                                        </div>
                                    </td>

                                </tr>

                            <?php $no++;
                                } ?>
                        </tbody>
                    </table>



                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
                    <!-- <input type="submit" value="Generate All" name="generateall" class="btn btn-danger" onclick="javascript: return confirm('WARNING !! This will generate code for ALL TABLE and overwrite the existing files\
                    \nPlease double check before continue. Continue ?')" /> -->
                    <!-- <a href="core/setting.php" class="btn btn-default">Setting</a> -->
                </form>
                <br>

                <?php
                    foreach ($hasil as $h) {
                        echo '<p>' . $h . '</p>';
                    }
                    ?>
            </div>
        <?php } ?>
        <div id="value-info" class="white_content alert alert-success">
            <div class="" role="alert">
                <a href="javascript:void(0)" onclick="document.getElementById('value-info').style.display='none';" class="textright close"><span aria-hidden="true">&times;</span></a>
                <h4 class="alert-heading">Info Value</h4>
                <p>value ini adalah isi dari inputan HTML (value="") yang diambil dari data table yg dipilih</p>
            </div>
        </div>
        <div id="label-info" class="white_content alert alert-success">
            <div class="" role="alert">
                <a href="javascript:void(0)" onclick="document.getElementById('label-info').style.display='none';" class="textright close"><span aria-hidden="true">&times;</span></a>
                <h4 class="alert-heading">Info Label</h4>
                <p>Label adalah penamaan atau pilihan yang ditampilkan dari data table yang dipilih</p>
            </div>
        </div>
        <div id="selected-info" class="white_content alert alert-success">
            <div class="" role="alert">
                <a href="javascript:void(0)" onclick="document.getElementById('selected-info').style.display='none';" class="textright close"><span aria-hidden="true">&times;</span></a>
                <h4 class="alert-heading">Info Selected</h4>
                <p>selected berguna untuk default pilihan inputan yang biasa dalam HTML selected atau checked.</p>
            </div>
        </div>
        <div id="where-info" class="white_content alert alert-success">
            <div class="" role="alert">
                <a href="javascript:void(0)" onclick="document.getElementById('where-info').style.display='none';" class="textright close"><span aria-hidden="true">&times;</span></a>
                <h4 class="alert-heading">Info Where</h4>
                <p></p>
            </div>
        </div>
        <div id="orderby-info" class="white_content alert alert-success">
            <div class="" role="alert">
                <a href="javascript:void(0)" onclick="document.getElementById('orderby-info').style.display='none';" class="textright close"><span aria-hidden="true">&times;</span></a>
                <h4 class="alert-heading">Info Order By</h4>
                <p></p>
            </div>
        </div>
    </div>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(function() {
            $('#input-search').on('keyup', function() {
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable-container .items').hide();
                $('.searchable-container .items').filter(function() {
                    return rex.test($(this).text());
                }).show();
            });
        });
        <?php
        $colums = $hc->not_primary_field($_GET['table']);
        $no = 1;
        foreach ($colums as $column) {
            ?>
            $(function() {
                $("#ddlPassport<?php echo $no ?>").change(function() {
                    if ($(this).val() == "select" ||
                        $(this).val() == "select2" ||
                        $(this).val() == "radio") {
                        $("#vaicode<?php echo $no ?>").show();
                        $("#vaicode2<?php echo $no ?>").hide();
                    } else {
                        $("#vaicode<?php echo $no ?>").hide();
                        $("#vaicode2<?php echo $no ?>").show();
                    }
                });
            });
        <?php $no++;
        } ?>
    </script>
</body>

</html>