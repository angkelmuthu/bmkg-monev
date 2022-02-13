<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_jenis_satker extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_jenis_satker_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_jenis_satker/ref_jenis_satker_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_jenis_satker_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_jenis_satker_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jenis_satker' => $row->id_jenis_satker,
		'kode_jenis_satker' => $row->kode_jenis_satker,
		'nama_jenis_satker' => $row->nama_jenis_satker,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_jenis_satker/ref_jenis_satker_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_jenis_satker'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_jenis_satker/create_action'),
	    'id_jenis_satker' => set_value('id_jenis_satker'),
	    'kode_jenis_satker' => set_value('kode_jenis_satker'),
	    'nama_jenis_satker' => set_value('nama_jenis_satker'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_jenis_satker/ref_jenis_satker_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_jenis_satker' => $this->input->post('kode_jenis_satker',TRUE),
		'nama_jenis_satker' => $this->input->post('nama_jenis_satker',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_jenis_satker_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_jenis_satker'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_jenis_satker_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_jenis_satker/update_action'),
		'id_jenis_satker' => set_value('id_jenis_satker', $row->id_jenis_satker),
		'kode_jenis_satker' => set_value('kode_jenis_satker', $row->kode_jenis_satker),
		'nama_jenis_satker' => set_value('nama_jenis_satker', $row->nama_jenis_satker),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_jenis_satker/ref_jenis_satker_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_jenis_satker'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_jenis_satker', TRUE));
        // } else {
            $data = array(
		'kode_jenis_satker' => $this->input->post('kode_jenis_satker',TRUE),
		'nama_jenis_satker' => $this->input->post('nama_jenis_satker',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_jenis_satker_model->update($this->input->post('id_jenis_satker', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_jenis_satker'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_jenis_satker_model->get_by_id($id);

        if ($row) {
            $this->Ref_jenis_satker_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_jenis_satker'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_jenis_satker'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_jenis_satker.php */
/* Location: ./application/controllers/Ref_jenis_satker.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 17:50:25 */
/* http://harviacode.com */