<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_akun_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_akun/ref_akun_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_akun_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_akun_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_akun' => $row->id_akun,
		'kode_akun' => $row->kode_akun,
		'nama_akun' => $row->nama_akun,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_akun/ref_akun_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_akun'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_akun/create_action'),
	    'id_akun' => set_value('id_akun'),
	    'kode_akun' => set_value('kode_akun'),
	    'nama_akun' => set_value('nama_akun'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_akun/ref_akun_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_akun' => $this->input->post('kode_akun',TRUE),
		'nama_akun' => $this->input->post('nama_akun',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_akun_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_akun'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_akun_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_akun/update_action'),
		'id_akun' => set_value('id_akun', $row->id_akun),
		'kode_akun' => set_value('kode_akun', $row->kode_akun),
		'nama_akun' => set_value('nama_akun', $row->nama_akun),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_akun/ref_akun_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_akun'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_akun', TRUE));
        // } else {
            $data = array(
		'kode_akun' => $this->input->post('kode_akun',TRUE),
		'nama_akun' => $this->input->post('nama_akun',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_akun_model->update($this->input->post('id_akun', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_akun'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_akun_model->get_by_id($id);

        if ($row) {
            $this->Ref_akun_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_akun'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_akun'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_akun.php */
/* Location: ./application/controllers/Ref_akun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 17:50:41 */
/* http://harviacode.com */