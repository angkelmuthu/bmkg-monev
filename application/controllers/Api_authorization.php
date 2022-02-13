<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_authorization extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Api_authorization_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/api_authorization/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/api_authorization/index/';
            $config['first_url'] = base_url() . 'index.php/api_authorization/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Api_authorization_model->total_rows($q);
        $api_authorization = $this->Api_authorization_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'api_authorization_data' => $api_authorization,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','api_authorization/tbl_api_authorization_list', $data);
    }

    public function read($id)
    {
        $row = $this->Api_authorization_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'client_service' => $row->client_service,
		'auth_key' => $row->auth_key,
	    );
            $this->template->load('template','api_authorization/tbl_api_authorization_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('api_authorization'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('api_authorization/create_action'),
	    'id' => set_value('id'),
	    'client_service' => set_value('client_service'),
	    'auth_key' => set_value('auth_key'),
	);
        $this->template->load('template','api_authorization/tbl_api_authorization_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'client_service' => $this->input->post('client_service',TRUE),
		'auth_key' => $this->input->post('auth_key',TRUE),
	    );

            $this->Api_authorization_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('api_authorization'));
        //}
    }

    public function update($id)
    {
        $row = $this->Api_authorization_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('api_authorization/update_action'),
		'id' => set_value('id', $row->id),
		'client_service' => set_value('client_service', $row->client_service),
		'auth_key' => set_value('auth_key', $row->auth_key),
	    );
            $this->template->load('template','api_authorization/tbl_api_authorization_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('api_authorization'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id', TRUE));
        // } else {
            $data = array(
		'client_service' => $this->input->post('client_service',TRUE),
		'auth_key' => $this->input->post('auth_key',TRUE),
	    );

            $this->Api_authorization_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('api_authorization'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Api_authorization_model->get_by_id($id);

        if ($row) {
            $this->Api_authorization_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('api_authorization'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('api_authorization'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Api_authorization.php */
/* Location: ./application/controllers/Api_authorization.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-09 16:51:58 */
/* http://harviacode.com */