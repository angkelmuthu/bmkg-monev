<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_komponen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_komponen_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_komponen/ref_komponen_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_komponen_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_komponen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_komponen' => $row->id_komponen,
		'kode_komponen' => $row->kode_komponen,
		'nama_komponen' => $row->nama_komponen,
		'kode_dept' => $row->kode_dept,
		'kode_unit_kerja' => $row->kode_unit_kerja,
		'kode_program' => $row->kode_program,
		'kode_kegiatan' => $row->kode_kegiatan,
		'kode_kro' => $row->kode_kro,
		'kode_ro' => $row->kode_ro,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_komponen/ref_komponen_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_komponen'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_komponen/create_action'),
	    'id_komponen' => set_value('id_komponen'),
	    'kode_komponen' => set_value('kode_komponen'),
	    'nama_komponen' => set_value('nama_komponen'),
	    'kode_dept' => set_value('kode_dept'),
	    'kode_unit_kerja' => set_value('kode_unit_kerja'),
	    'kode_program' => set_value('kode_program'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'kode_kro' => set_value('kode_kro'),
	    'kode_ro' => set_value('kode_ro'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_komponen/ref_komponen_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_komponen' => $this->input->post('kode_komponen',TRUE),
		'nama_komponen' => $this->input->post('nama_komponen',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'kode_kro' => $this->input->post('kode_kro',TRUE),
		'kode_ro' => $this->input->post('kode_ro',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_komponen_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_komponen'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_komponen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_komponen/update_action'),
		'id_komponen' => set_value('id_komponen', $row->id_komponen),
		'kode_komponen' => set_value('kode_komponen', $row->kode_komponen),
		'nama_komponen' => set_value('nama_komponen', $row->nama_komponen),
		'kode_dept' => set_value('kode_dept', $row->kode_dept),
		'kode_unit_kerja' => set_value('kode_unit_kerja', $row->kode_unit_kerja),
		'kode_program' => set_value('kode_program', $row->kode_program),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'kode_kro' => set_value('kode_kro', $row->kode_kro),
		'kode_ro' => set_value('kode_ro', $row->kode_ro),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_komponen/ref_komponen_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_komponen'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_komponen', TRUE));
        // } else {
            $data = array(
		'kode_komponen' => $this->input->post('kode_komponen',TRUE),
		'nama_komponen' => $this->input->post('nama_komponen',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'kode_kro' => $this->input->post('kode_kro',TRUE),
		'kode_ro' => $this->input->post('kode_ro',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_komponen_model->update($this->input->post('id_komponen', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_komponen'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_komponen_model->get_by_id($id);

        if ($row) {
            $this->Ref_komponen_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_komponen'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_komponen'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_komponen.php */
/* Location: ./application/controllers/Ref_komponen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-26 15:20:55 */
/* http://harviacode.com */