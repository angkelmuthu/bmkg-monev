<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_lokasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_lokasi_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_lokasi/ref_lokasi_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_lokasi_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_lokasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_lokasi' => $row->id_lokasi,
		'kode_lokasi' => $row->kode_lokasi,
		'nama_lokasi' => $row->nama_lokasi,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_lokasi/ref_lokasi_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_lokasi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_lokasi/create_action'),
	    'id_lokasi' => set_value('id_lokasi'),
	    'kode_lokasi' => set_value('kode_lokasi'),
	    'nama_lokasi' => set_value('nama_lokasi'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_lokasi/ref_lokasi_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_lokasi' => $this->input->post('kode_lokasi',TRUE),
		'nama_lokasi' => $this->input->post('nama_lokasi',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_lokasi_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_lokasi'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_lokasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_lokasi/update_action'),
		'id_lokasi' => set_value('id_lokasi', $row->id_lokasi),
		'kode_lokasi' => set_value('kode_lokasi', $row->kode_lokasi),
		'nama_lokasi' => set_value('nama_lokasi', $row->nama_lokasi),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_lokasi/ref_lokasi_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_lokasi'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_lokasi', TRUE));
        // } else {
            $data = array(
		'kode_lokasi' => $this->input->post('kode_lokasi',TRUE),
		'nama_lokasi' => $this->input->post('nama_lokasi',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_lokasi_model->update($this->input->post('id_lokasi', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_lokasi'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_lokasi_model->get_by_id($id);

        if ($row) {
            $this->Ref_lokasi_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_lokasi'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_lokasi'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_lokasi.php */
/* Location: ./application/controllers/Ref_lokasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 17:49:50 */
/* http://harviacode.com */