<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('M_unit_model');
        $this->load->library('form_validation');}

    public function index()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            $cekAuthClient = $this->M_auth->checkAuthClient();
            if ($cekAuthClient == true) {
                $auth = $this->M_auth->auth();
                if ($auth['status'] == 200) {
                    $row = $this->M_unit_model->getAll();
                    $this->output->set_content_type('application/json');
                    $this->output->set_status_header($auth['status']);
                    $this->output->set_output(json_encode(array('status' => $auth['status'], 'message' => $row)));
                }
            }
        }
    }

    public function by_param($field,$value)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != "GET") {
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            $cekAuthClient = $this->M_auth->checkAuthClient();
            if ($cekAuthClient == true) {
                $auth = $this->M_auth->auth();
                if ($auth["status"] == 200) {
                    $row = $this->M_unit_model->getDetail($field,$value);
                    $this->output->set_content_type('application/json');
                    $this->output->set_status_header($auth["status"]);
                    $this->output->set_output(json_encode(array('status' => $auth["status"], 'message' => $row)));
                }
            }
        }
    }


    public function create()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            $cekAuthClient = $this->M_auth->checkAuthClient();
            if ($cekAuthClient == true) {
                $auth = $this->M_auth->auth();

                if ($auth['status'] == 200) {
                    $_POST = json_decode(file_get_contents('php://input'), TRUE);

                    $this->_rules();
                    if ($this->form_validation->run() == FALSE) {
                        $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(401)
                            ->set_output(json_encode(array('status' => 401, 'message' => $this->form_validation->error_array())));
                    } else {
                        $row = $this->M_unit_model->create($_POST);
                        $this->output
                            ->set_content_type('application/json')
                            ->set_status_header($row['status'])
                            ->set_output(json_encode($row));
                    }
                }
            }
        }
    }

    public function update($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            $cekAuthClient = $this->M_auth->checkAuthClient();
            if ($cekAuthClient == true) {
                $auth = $this->M_auth->auth();

                if ($auth['status'] == 200) {
                    $_POST = json_decode(file_get_contents('php://input'), TRUE);

                    $this->_rules();
                    if ($this->form_validation->run() == FALSE) {
                        $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(401)
                            ->set_output(json_encode(array('status' => 401, 'message' => $this->form_validation->error_array())));
                    } else {
                        $row = $this->M_unit_model->update($_POST, $id);
                        $this->output
                            ->set_content_type('application/json')
                            ->set_status_header($row['status'])
                            ->set_output(json_encode($row));
                    }
                }
            }
        }
    }

    public function delete($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'DELETE') {
            $this->output->set_content_type('application/json');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(array('status' => 400, 'message' => 'Bad request.')));
        } else {
            $cekAuthClient = $this->M_auth->checkAuthClient();
            if ($cekAuthClient == true) {
                $auth = $this->M_auth->auth();

                if ($auth['status'] == 200) {
                    if ($id == '') {
                        $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(401)
                            ->set_output(json_encode(array('status' => 401, 'message' => 'parameter tidak boleh kosong')));
                    } else {
                        $row = $this->M_unit_model->delete($id);
                        $this->output
                            ->set_content_type('application/json')
                            ->set_status_header($row['status'])
                            ->set_output(json_encode($row));
                    }
                }
            }
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nm_unit', 'nm unit', 'trim|required');
	$this->form_validation->set_rules('id_direktorat', 'id direktorat', 'trim|required');

	$this->form_validation->set_rules('id_unit', 'id_unit', 'trim');
	$this->form_validation->set_error_delimiters('', '');
    }

}

/* End of file M_unit.php */
/* Location: ./application/controllers/M_unit.php */
/* Please DO NOT modify this information : */
/* Generated by Rifai | Codeigniter API Generator 2021-07-10 15:43:48 */
/* rifai.kre@gmail.com */