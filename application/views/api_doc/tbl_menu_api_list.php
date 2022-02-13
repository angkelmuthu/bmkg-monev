<main id="js-page-content" role="main" class="page-content">
    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>DOKUMENTASI API</h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <div class="row">
                            <div class="col-auto">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        <span class="hidden-sm-down ml-1"> Petunjuk Teknis</span>
                                    </a>
                                    <?php
                                    foreach ($list as $api) {
                                    ?>
                                        <a class="nav-link" id="v-pills-<?php echo $api->url ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $api->url ?>" role="tab" aria-controls="v-pills-<?php echo $api->url ?>" aria-selected="false">
                                            <span class="hidden-sm-down ml-1"> <?php echo $api->title ?></span>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <h3>
                                            Petunjuk Teknis
                                        </h3>
                                        <p>
                                            Berikut ini adalah API yang untuk keperluan development agar dapat terintegrasi dengan aplikasi.
                                            <br>
                                            Untuk dapat mengakses API anda harus memiliki akun terlebih dahulu, untuk mendapatkannya silahkan hubungin pihak terkait dalam pembuatan akun. selanjutnya jika anda sudah memiliki akun tahap pertama silahkan anda login via API untuk mendapatkan "User-ID" & "Authorization" yang dibutuhkan untuk mengakses service-service API kami.
                                        </p>
                                        <div class="panel-tag mb-2 mt-4">
                                            Header
                                        </div>
                                        <table class="table table-bordered table-hover m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <td>Key</td>
                                                    <td>Value</td>
                                                    <td>Keterangan</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row = $this->db->get('tbl_api_authorization')->row();
                                                ?>
                                                <tr>
                                                    <td>Content-Type</td>
                                                    <td>application/json</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Client-Service</td>
                                                    <td><?php echo $row->client_service ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Auth-Key</td>
                                                    <td><?php echo $row->auth_key ?></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="panel-tag mb-2 mt-4">
                                            Login & Logout
                                        </div>
                                        <table class="table table-bordered table-hover m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <td>Function</td>
                                                    <td>Method</td>
                                                    <td>Url</td>
                                                    <td>Json</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Login</td>
                                                    <td class="text-center"><span class="badge badge-primary">POST</span></td>
                                                    <td>/api/login</td>
                                                    <td>{ "username" : "member", "password" : "123"}</td>
                                                </tr>
                                                <tr>
                                                    <td>Logout</td>
                                                    <td class="text-center"><span class="badge badge-primary">POST</span></td>
                                                    <td>/api/logout</td>
                                                    <td>{ "username" : "member", "password" : "123"}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="panel-tag mb-2 mt-4">
                                            Result
                                        </div>
                                        <span class="badge badge-success">200</span>
                                        <code>
                                            {
                                            "status": 200,
                                            "message": "Succesfully Login!",
                                            "User-ID": "123",
                                            "Authorization": "$1wiXBcH4b0$bXPX92eqI/slc.HyZvis80"
                                            }
                                        </code>
                                        <br>
                                        <span class="badge badge-danger">401</span>
                                        <code>
                                            {
                                            "status": 401,
                                            "message": "Unauthorized"
                                            }
                                        </code>
                                        <br>
                                        <span class="badge badge-danger">401</span>
                                        <code>
                                            {
                                            "status": 401,
                                            "message": "Your session has been expired"
                                            }
                                        </code>
                                        <br>
                                        <span class="badge badge-danger">404</span>
                                        <code>
                                            {
                                            "status": 404,
                                            "message": "Username not found."
                                            }
                                        </code>
                                        <br>
                                        <span class="badge badge-danger">404</span>
                                        <code>
                                            {
                                            "status": 404,
                                            "message": "Wrong Password."
                                            }
                                        </code>
                                        <br>
                                        <span class="badge badge-danger">404</span>
                                        <code>
                                            {
                                            "status": 404,
                                            "message": "Bad request."
                                            }
                                        </code>
                                        <br>
                                        <span class="badge badge-danger">500</span>
                                        <code>
                                            {
                                            "status": 500,
                                            "message": "Internal Server Error."
                                            }
                                        </code>
                                        <div class="alert bg-info-400 text-white mt-5" role="alert">
                                            <strong>Perhatian !</strong> "Authorization" akan expired dalam waktu 12 jam kedepan.
                                        </div>
                                    </div>
                                    <?php
                                    foreach ($list as $api) {
                                    ?>
                                        <div class="tab-pane fade" id="v-pills-<?php echo $api->url ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $api->url ?>-tab">
                                            <h3>
                                                <?php echo $api->title ?>
                                            </h3>
                                            <div class="panel-tag mb-2 mt-4">
                                                Header
                                            </div>
                                            <table class="table table-bordered table-hover m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <td>Key</td>
                                                        <td>Value</td>
                                                        <td>Keterangan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $row = $this->db->get('tbl_api_authorization')->row();
                                                    ?>
                                                    <tr>
                                                        <td>Content-Type</td>
                                                        <td>application/json</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Client-Service</td>
                                                        <td><?php echo $row->client_service ?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Auth-Key</td>
                                                        <td><?php echo $row->auth_key ?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>User-ID</td>
                                                        <td>/* didapat setelah ketika "Login" */</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Authorization</td>
                                                        <td>/* didapat setelah ketika "Login" */</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="panel-tag mb-2 mt-4">
                                                Method
                                            </div>

                                            <table class="table table-bordered table-hover m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <td>Function</td>
                                                        <td>Method</td>
                                                        <td>Url</td>
                                                        <td>Json</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Get All Data</td>
                                                        <td class="text-center"><span class="badge badge-success">GET</span></td>
                                                        <td>/api/<?php echo $api->url ?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Get By Parameter</td>
                                                        <td class="text-center"><span class="badge badge-success">GET</span></td>
                                                        <td>/api/<?php echo $api->url ?>/{field}/{value}</td>
                                                        <td></td>
                                                    </tr>
                                                    <?php if ($api->tipe == 'crud') { ?>
                                                        <tr>
                                                            <td>Create/Insert</td>
                                                            <td class="text-center"><span class="badge badge-primary">POST</span></td>
                                                            <td>/api/<?php echo $api->url ?>/create</td>
                                                            <td>
                                                                <?php
                                                                $fields = $this->db->field_data($api->nm_tabel);
                                                                //$arr = array();
                                                                $arr = '{';
                                                                foreach ($fields as $field) {
                                                                    if ($field->primary_key == '0') {
                                                                        $arr .= '"' . $field->name . '" : "value",';
                                                                    }
                                                                }
                                                                $arr .= '}';
                                                                $json = str_replace(",}", "}", $arr);
                                                                echo '<code>' . $json . '</code>';
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Update</td>
                                                            <td class="text-center"><span class="badge badge-primary">POST</span></td>
                                                            <td>/api/<?php echo $api->url ?>/update/{id}</td>
                                                            <td>
                                                                <?php
                                                                $fields = $this->db->field_data($api->nm_tabel);
                                                                //$arr = array();
                                                                $arr = '{';
                                                                foreach ($fields as $field) {
                                                                    if ($field->primary_key == '0') {
                                                                        $arr .= '"' . $field->name . '" : "value",';
                                                                    }
                                                                }
                                                                $arr .= '}';
                                                                $json = str_replace(",}", "}", $arr);
                                                                echo '<code>' . $json . '</code>';
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Delete Data</td>
                                                            <td class="text-center"><span class="badge badge-warning">DELETE</span></td>
                                                            <td>/api/<?php echo $api->url ?>/{id}</td>
                                                            <td></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="panel-tag mb-2 mt-4">
                                                Parameter
                                            </div>
                                            <table class="table table-bordered table-hover m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <td>No.</td>
                                                        <td>Field</td>
                                                        <td>Type</td>
                                                        <td>Length</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $fields = $this->db->field_data($api->nm_tabel);
                                                    foreach ($fields as $field) {
                                                        //if ($field->primary_key == '0') {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $field->name ?></td>
                                                            <td><?php echo $field->type ?></td>
                                                            <td><?php echo $field->max_length ?></td>
                                                        </tr>

                                                    <?php //}
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <div class="panel-tag mb-2 mt-4">
                                                Result
                                            </div>
                                            <?php if ($api->tipe == 'crud') { ?>
                                                <span class="badge badge-success">201</span>
                                                <code>
                                                    {
                                                    "status": 201,
                                                    "message": "Data berhasil dibuat"
                                                    }
                                                </code>
                                                <br>
                                                <span class="badge badge-success">201</span>
                                                <code>
                                                    {
                                                    "status": 201,
                                                    "message": "Data berhasil diupdate"
                                                    }
                                                </code>
                                                <br>
                                                <span class="badge badge-success">201</span>
                                                <code>
                                                    {
                                                    "status": 201,
                                                    "message": "Data berhasil dihapus"
                                                    }
                                                </code>
                                                <br>
                                                <span class="badge badge-success">202</span>
                                                <code>
                                                    {
                                                    "status": 202,
                                                    "message": "Data tidak tersedia"
                                                    }
                                                </code>
                                                <br>
                                                <span class="badge badge-danger">401</span>
                                                <code>
                                                    {
                                                    "status": 401,
                                                    "message": "field is required"
                                                    }
                                                </code>
                                                <br>
                                            <?php } ?>
                                            <span class="badge badge-danger">401</span>
                                            <code>
                                                {
                                                "status": 401,
                                                "message": "parameter tidak boleh kosong"
                                                }
                                            </code>
                                            <br>
                                            <span class="badge badge-danger">401</span>
                                            <code>
                                                {
                                                "status": 401,
                                                "message": "Unauthorized"
                                                }
                                            </code>
                                            <br>
                                            <span class="badge badge-danger">401</span>
                                            <code>
                                                {
                                                "status": 401,
                                                "message": "Your session has been expired"
                                                }
                                            </code>
                                            <br>
                                            <span class="badge badge-danger">404</span>
                                            <code>
                                                {
                                                "status": 404,
                                                "message": "Bad request."
                                                }
                                            </code>
                                            <br>
                                            <span class="badge badge-danger">500</span>
                                            <code>
                                                {
                                                "status": 500,
                                                "message": "Internal Server Error."
                                                }
                                            </code>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
<script src="<?php echo base_url() ?>assets/smartadmin/js/vendors.bundle.js"></script>
<script src="<?php echo base_url() ?>assets/smartadmin/js/app.bundle.js"></script>