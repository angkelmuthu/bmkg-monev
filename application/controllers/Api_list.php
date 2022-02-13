<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_list extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Api_list_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','api_list/tbl_api_menu_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Api_list_model->json();
    }

    public function read($id)
    {
        $row = $this->Api_list_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'title' => $row->title,
		'url' => $row->url,
		'tipe' => $row->tipe,
		'create_date' => $row->create_date,
		'is_aktif' => $row->is_aktif,
	    );
            $this->template->load('template','api_list/tbl_api_menu_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('api_list'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('api_list/create_action'),
	    'id' => set_value('id'),
	    'title' => set_value('title'),
	    'url' => set_value('url'),
	    'tipe' => set_value('tipe'),
	    'create_date' => set_value('create_date'),
	    'is_aktif' => set_value('is_aktif'),
	);
        $this->template->load('template','api_list/tbl_api_menu_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'url' => $this->input->post('url',TRUE),
		'tipe' => $this->input->post('tipe',TRUE),
		'create_date' => $this->input->post('create_date',TRUE),
		'is_aktif' => $this->input->post('is_aktif',TRUE),
	    );

            $this->Api_list_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('api_list'));
        //}
    }

    public function update($id)
    {
        $row = $this->Api_list_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('api_list/update_action'),
		'id' => set_value('id', $row->id),
		'title' => set_value('title', $row->title),
		'url' => set_value('url', $row->url),
		'tipe' => set_value('tipe', $row->tipe),
		'create_date' => set_value('create_date', $row->create_date),
		'is_aktif' => set_value('is_aktif', $row->is_aktif),
	    );
            $this->template->load('template','api_list/tbl_api_menu_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('api_list'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id', TRUE));
        // } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'url' => $this->input->post('url',TRUE),
		'tipe' => $this->input->post('tipe',TRUE),
		'create_date' => $this->input->post('create_date',TRUE),
		'is_aktif' => $this->input->post('is_aktif',TRUE),
	    );

            $this->Api_list_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('api_list'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Api_list_model->get_by_id($id);

        if ($row) {
            $this->Api_list_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('api_list'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('api_list'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Api_list.php */
/* Location: ./application/controllers/Api_list.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-09 16:57:03 */
/* http://harviacode.com */