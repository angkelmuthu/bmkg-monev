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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="tombol" name="tombol" value="<?php echo ucfirst($_GET['table']); ?>" class="form-control" placeholder="Nama Tombol" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Jenis API</label>
                            <?php $jenis_api = isset($_POST['jenis_api']) ? $_POST['jenis_api'] : 'reguler_table'; ?>
                            <div class="form-group">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_api" value="crud" checked="">
                                        CRUD (GET | POST | DELETE)
                                    </label>
                                </div>

                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_api" value="view">
                                        View (GET Only)
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