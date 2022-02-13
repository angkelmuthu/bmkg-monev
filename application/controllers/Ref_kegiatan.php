<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_kegiatan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_kegiatan/ref_kegiatan_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_kegiatan_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan' => $row->id_kegiatan,
		'kode_kegiatan' => $row->kode_kegiatan,
		'nama_kegiatan' => $row->nama_kegiatan,
		'kode_dept' => $row->kode_dept,
		'kode_unit_kerja' => $row->kode_unit_kerja,
		'kode_program' => $row->kode_program,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_kegiatan/ref_kegiatan_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_kegiatan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_kegiatan/create_action'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'nama_kegiatan' => set_value('nama_kegiatan'),
	    'kode_dept' => set_value('kode_dept'),
	    'kode_unit_kerja' => set_value('kode_unit_kerja'),
	    'kode_program' => set_value('kode_program'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_kegiatan/ref_kegiatan_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_kegiatan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_kegiatan'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
		'kode_dept' => set_value('kode_dept', $row->kode_dept),
		'kode_unit_kerja' => set_value('kode_unit_kerja', $row->kode_unit_kerja),
		'kode_program' => set_value('kode_program', $row->kode_program),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_kegiatan/ref_kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_kegiatan'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_kegiatan', TRUE));
        // } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_kegiatan'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Ref_kegiatan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_kegiatan'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_kegiatan'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_kegiatan.php */
/* Location: ./application/controllers/Ref_kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 18:25:42 */
/* http://harviacode.com */