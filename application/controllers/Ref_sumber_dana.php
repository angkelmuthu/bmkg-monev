<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_sumber_dana extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_sumber_dana_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','ref_sumber_dana/ref_sumber_dana_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_sumber_dana_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_sumber_dana_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_sumber_dana' => $row->id_sumber_dana,
		'kode_sumber_dana' => $row->kode_sumber_dana,
		'nama_sumber_dana' => $row->nama_sumber_dana,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_sumber_dana/ref_sumber_dana_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_sumber_dana'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_sumber_dana/create_action'),
	    'id_sumber_dana' => set_value('id_sumber_dana'),
	    'kode_sumber_dana' => set_value('kode_sumber_dana'),
	    'nama_sumber_dana' => set_value('nama_sumber_dana'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_sumber_dana/ref_sumber_dana_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_sumber_dana' => $this->input->post('kode_sumber_dana',TRUE),
		'nama_sumber_dana' => $this->input->post('nama_sumber_dana',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_sumber_dana_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_sumber_dana'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_sumber_dana_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_sumber_dana/update_action'),
		'id_sumber_dana' => set_value('id_sumber_dana', $row->id_sumber_dana),
		'kode_sumber_dana' => set_value('kode_sumber_dana', $row->kode_sumber_dana),
		'nama_sumber_dana' => set_value('nama_sumber_dana', $row->nama_sumber_dana),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_sumber_dana/ref_sumber_dana_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_sumber_dana'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_sumber_dana', TRUE));
        // } else {
            $data = array(
		'kode_sumber_dana' => $this->input->post('kode_sumber_dana',TRUE),
		'nama_sumber_dana' => $this->input->post('nama_sumber_dana',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_sumber_dana_model->update($this->input->post('id_sumber_dana', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_sumber_dana'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_sumber_dana_model->get_by_id($id);

        if ($row) {
            $this->Ref_sumber_dana_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_sumber_dana'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_sumber_dana'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_sumber_dana.php */
/* Location: ./application/controllers/Ref_sumber_dana.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 18:01:46 */
/* http://harviacode.com */