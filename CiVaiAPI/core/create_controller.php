<?php

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        \$this->load->model('$m');
        \$this->load->library('form_validation');";

$string .= "}";

if ($jenis_api == 'crud') {

    $string .= "\n\n    public function index()
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != 'GET') {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();
                if (\$auth['status'] == 200) {
                    \$row = \$this->" . $m . "->getAll();
                    \$this->output->set_content_type('application/json');
                    \$this->output->set_status_header(\$auth['status']);
                    \$this->output->set_output(json_encode(array('status' => \$auth['status'], 'message' => \$row)));
                }
            }
        }
    }

    public function by_param(\$field,\$value)
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != \"GET\") {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();
                if (\$auth[\"status\"] == 200) {
                    \$row = \$this->" . $m . "->getDetail(\$field,\$value);
                    \$this->output->set_content_type('application/json');
                    \$this->output->set_status_header(\$auth[\"status\"]);
                    \$this->output->set_output(json_encode(array('status' => \$auth[\"status\"], 'message' => \$row)));
                }
            }
        }
    }


    public function create()
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != 'POST') {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();

                if (\$auth['status'] == 200) {
                    \$_POST = json_decode(file_get_contents('php://input'), TRUE);

                    \$this->_rules();
                    if (\$this->form_validation->run() == FALSE) {
                        \$this->output
                            ->set_content_type('application/json')
                            ->set_status_header(401)
                            ->set_output(json_encode(array('status' => 401, 'message' => \$this->form_validation->error_array())));
                    } else {
                        \$row = \$this->" . $m . "->create(\$_POST);
                        \$this->output
                            ->set_content_type('application/json')
                            ->set_status_header(\$row['status'])
                            ->set_output(json_encode(\$row));
                    }
                }
            }
        }
    }

    public function update(\$id)
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != 'POST') {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();

                if (\$auth['status'] == 200) {
                    \$_POST = json_decode(file_get_contents('php://input'), TRUE);

                    \$this->_rules();
                    if (\$this->form_validation->run() == FALSE) {
                        \$this->output
                            ->set_content_type('application/json')
                            ->set_status_header(401)
                            ->set_output(json_encode(array('status' => 401, 'message' => \$this->form_validation->error_array())));
                    } else {
                        \$row = \$this->" . $m . "->update(\$_POST, \$id);
                        \$this->output
                            ->set_content_type('application/json')
                            ->set_status_header(\$row['status'])
                            ->set_output(json_encode(\$row));
                    }
                }
            }
        }
    }

    public function delete(\$id)
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != 'DELETE') {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();

                if (\$auth['status'] == 200) {
                    if (\$id == '') {
                        \$this->output
                            ->set_content_type('application/json')
                            ->set_status_header(401)
                            ->set_output(json_encode(array('status' => 401, 'message' => 'parameter tidak boleh kosong')));
                    } else {
                        \$row = \$this->" . $m . "->delete(\$id);
                        \$this->output
                            ->set_content_type('application/json')
                            ->set_status_header(\$row['status'])
                            ->set_output(json_encode(\$row));
                    }
                }
            }
        }
    }

    public function _rules()
    {";
    foreach ($non_pk as $row) {
        $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
        $string .= "\n\t\$this->form_validation->set_rules('" . $row['column_name'] . "', '" .  strtolower(label($row['column_name'])) . "', 'trim|required$int');";
    }
    $string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
    $string .= "\n\t\$this->form_validation->set_error_delimiters('', '');
    }";
} else {
    $string .= "\n\n    public function index()
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != 'GET') {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();
                if (\$auth['status'] == 200) {
                    \$row = \$this->" . $m . "->getAll();
                    \$this->output->set_content_type('application/json');
                    \$this->output->set_status_header(\$auth['status']);
                    \$this->output->set_output(json_encode(array('status' => \$auth['status'], 'message' => \$row)));
                }
            }
        }
    }

    public function by_param(\$field,\$value)
    {
        \$method = \$_SERVER['REQUEST_METHOD'];
        if (\$method != \"GET\") {
            \$this->output->set_content_type('application/json');
            \$this->output->set_status_header(400);
            \$this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            \$cekAuthClient = \$this->M_auth->checkAuthClient();
            if (\$cekAuthClient == true) {
                \$auth = \$this->M_auth->auth();
                if (\$auth[\"status\"] == 200) {
                    \$row = \$this->" . $m . "->getDetail(\$field,\$value);
                    \$this->output->set_content_type('application/json');
                    \$this->output->set_status_header(\$auth[\"status\"]);
                    \$this->output->set_output(json_encode(array('status' => \$auth[\"status\"], 'message' => \$row)));
                }
            }
        }
    }";
}




$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by Rifai | Codeigniter API Generator " . date('Y-m-d H:i:s') . " */
/* rifai.kre@gmail.com */";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);
