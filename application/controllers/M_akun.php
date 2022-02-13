<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('M_akun_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','m_akun/m_akun_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->M_akun_model->json();
    }

    public function read($id)
    {
        $row = $this->M_akun_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_akun' => $row->id_akun,
		'kode_akun' => $row->kode_akun,
		'nama_akun' => $row->nama_akun,
		'kode_komponen_sub' => $row->kode_komponen_sub,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','m_akun/m_akun_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('m_akun'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_akun/create_action'),
	    'id_akun' => set_value('id_akun'),
	    'kode_akun' => set_value('kode_akun'),
	    'nama_akun' => set_value('nama_akun'),
	    'kode_komponen_sub' => set_value('kode_komponen_sub'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','m_akun/m_akun_form', $data);
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
		'kode_komponen_sub' => $this->input->post('kode_komponen_sub',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->M_akun_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('m_akun'));
        //}
    }

    public function update($id)
    {
        $row = $this->M_akun_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_akun/update_action'),
		'id_akun' => set_value('id_akun', $row->id_akun),
		'kode_akun' => set_value('kode_akun', $row->kode_akun),
		'nama_akun' => set_value('nama_akun', $row->nama_akun),
		'kode_komponen_sub' => set_value('kode_komponen_sub', $row->kode_komponen_sub),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','m_akun/m_akun_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('m_akun'));
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
		'kode_komponen_sub' => $this->input->post('kode_komponen_sub',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->M_akun_model->update($this->input->post('id_akun', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('m_akun'));
        // }
    }

    public function delete($id)
    {
        $row = $this->M_akun_model->get_by_id($id);

        if ($row) {
            $this->M_akun_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('m_akun'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('m_akun'));
        }
    }

//     public function _rules()
//     {

}

/* End of file M_akun.php */
/* Location: ./application/controllers/M_akun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-12 09:01:12 */
/* http://harviacode.com */