<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_departemen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_departemen_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_departemen/ref_departemen_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_departemen_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_departemen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_dept' => $row->id_dept,
		'kode_dept' => $row->kode_dept,
		'nama_dept' => $row->nama_dept,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_departemen/ref_departemen_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_departemen'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_departemen/create_action'),
	    'id_dept' => set_value('id_dept'),
	    'kode_dept' => set_value('kode_dept'),
	    'nama_dept' => set_value('nama_dept'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_departemen/ref_departemen_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'nama_dept' => $this->input->post('nama_dept',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_departemen_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_departemen'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_departemen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_departemen/update_action'),
		'id_dept' => set_value('id_dept', $row->id_dept),
		'kode_dept' => set_value('kode_dept', $row->kode_dept),
		'nama_dept' => set_value('nama_dept', $row->nama_dept),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_departemen/ref_departemen_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_departemen'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_dept', TRUE));
        // } else {
            $data = array(
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'nama_dept' => $this->input->post('nama_dept',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_departemen_model->update($this->input->post('id_dept', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_departemen'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_departemen_model->get_by_id($id);

        if ($row) {
            $this->Ref_departemen_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_departemen'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_departemen'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_departemen.php */
/* Location: ./application/controllers/Ref_departemen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 17:38:08 */
/* http://harviacode.com */