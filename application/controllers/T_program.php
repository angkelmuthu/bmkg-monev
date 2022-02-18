<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_program extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('T_program_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','t_program/t_program_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->T_program_model->json();
    }

    public function read($id)
    {
        $row = $this->T_program_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_program' => $row->id_program,
		'tahun_anggaran' => $row->tahun_anggaran,
		'kode_dept' => $row->kode_dept,
		'kode_unit_kerja' => $row->kode_unit_kerja,
		'kode_satker' => $row->kode_satker,
		'kode_program' => $row->kode_program,
		'nama_program' => $row->nama_program,
		'create_date' => $row->create_date,
	    );
            $this->template->load('template','t_program/t_program_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('t_program'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_program/create_action'),
	    'id_program' => set_value('id_program'),
	    'tahun_anggaran' => set_value('tahun_anggaran'),
	    'kode_dept' => set_value('kode_dept'),
	    'kode_unit_kerja' => set_value('kode_unit_kerja'),
	    'kode_satker' => set_value('kode_satker'),
	    'kode_program' => set_value('kode_program'),
	    'nama_program' => set_value('nama_program'),
	    'create_date' => set_value('create_date'),
	);
        $this->template->load('template','t_program/t_program_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_satker' => $this->input->post('kode_satker',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'nama_program' => $this->input->post('nama_program',TRUE),
		'create_date' => $this->input->post('create_date',TRUE),
	    );

            $this->T_program_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('t_program'));
        //}
    }

    public function update($id)
    {
        $row = $this->T_program_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_program/update_action'),
		'id_program' => set_value('id_program', $row->id_program),
		'tahun_anggaran' => set_value('tahun_anggaran', $row->tahun_anggaran),
		'kode_dept' => set_value('kode_dept', $row->kode_dept),
		'kode_unit_kerja' => set_value('kode_unit_kerja', $row->kode_unit_kerja),
		'kode_satker' => set_value('kode_satker', $row->kode_satker),
		'kode_program' => set_value('kode_program', $row->kode_program),
		'nama_program' => set_value('nama_program', $row->nama_program),
		'create_date' => set_value('create_date', $row->create_date),
	    );
            $this->template->load('template','t_program/t_program_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('t_program'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_program', TRUE));
        // } else {
            $data = array(
		'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_satker' => $this->input->post('kode_satker',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'nama_program' => $this->input->post('nama_program',TRUE),
		'create_date' => $this->input->post('create_date',TRUE),
	    );

            $this->T_program_model->update($this->input->post('id_program', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('t_program'));
        // }
    }

    public function delete($id)
    {
        $row = $this->T_program_model->get_by_id($id);

        if ($row) {
            $this->T_program_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('t_program'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('t_program'));
        }
    }

//     public function _rules()
//     {

}

/* End of file T_program.php */
/* Location: ./application/controllers/T_program.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-18 05:03:59 */
/* http://harviacode.com */