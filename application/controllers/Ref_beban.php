<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_beban extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_beban_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_beban/ref_beban_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_beban_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_beban_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_beban' => $row->id_beban,
		'kode_beban' => $row->kode_beban,
		'nama_beban' => $row->nama_beban,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_beban/ref_beban_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_beban'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_beban/create_action'),
	    'id_beban' => set_value('id_beban'),
	    'kode_beban' => set_value('kode_beban'),
	    'nama_beban' => set_value('nama_beban'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_beban/ref_beban_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_beban' => $this->input->post('kode_beban',TRUE),
		'nama_beban' => $this->input->post('nama_beban',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_beban_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_beban'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_beban_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_beban/update_action'),
		'id_beban' => set_value('id_beban', $row->id_beban),
		'kode_beban' => set_value('kode_beban', $row->kode_beban),
		'nama_beban' => set_value('nama_beban', $row->nama_beban),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_beban/ref_beban_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_beban'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_beban', TRUE));
        // } else {
            $data = array(
		'kode_beban' => $this->input->post('kode_beban',TRUE),
		'nama_beban' => $this->input->post('nama_beban',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_beban_model->update($this->input->post('id_beban', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_beban'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_beban_model->get_by_id($id);

        if ($row) {
            $this->Ref_beban_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_beban'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_beban'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_beban.php */
/* Location: ./application/controllers/Ref_beban.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 17:51:21 */
/* http://harviacode.com */