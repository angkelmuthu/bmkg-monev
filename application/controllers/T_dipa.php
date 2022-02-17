<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_dipa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('T_dipa_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 't_dipa/t_dipa_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->T_dipa_model->json();
    }

    public function read($id)
    {
        $row = $this->T_dipa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_dipa' => $row->id_dipa,
                'no_dipa' => $row->no_dipa,
                'tahun_anggaran' => $row->tahun_anggaran,
                'pagu' => $row->pagu,
                'kode_dept' => $row->kode_dept,
                'nama_dept' => $row->nama_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'nama_unit_kerja' => $row->nama_unit_kerja,
                'kode_satker' => $row->kode_satker,
                'nama_satker' => $row->nama_satker,
                'create_date' => $row->create_date,
            );
            $this->template->load('template', 't_dipa/t_dipa_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('t_dipa'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_dipa/create_action'),
            'id_dipa' => set_value('id_dipa'),
            'no_dipa' => set_value('no_dipa'),
            'tahun_anggaran' => set_value('tahun_anggaran'),
            'pagu' => set_value('pagu'),
            'kode_dept' => set_value('kode_dept'),
            'kode_unit_kerja' => set_value('kode_unit_kerja'),
            'kode_satker' => set_value('kode_satker'),
            'create_date' => set_value('create_date'),
        );
        $this->template->load('template', 't_dipa/t_dipa_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
        $data = array(
            'no_dipa' => $this->input->post('no_dipa', TRUE),
            'tahun_anggaran' => $this->input->post('tahun_anggaran', TRUE),
            'pagu' => $this->input->post('pagu', TRUE),
            'kode_dept' => $this->input->post('kode_dept', TRUE),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja', TRUE),
            'kode_satker' => $this->input->post('kode_satker', TRUE),
            'create_date' => $this->input->post('create_date', TRUE),
        );

        $this->T_dipa_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
        redirect(site_url('t_dipa'));
        //}
    }

    public function update($id)
    {
        $row = $this->T_dipa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_dipa/update_action'),
                'id_dipa' => set_value('id_dipa', $row->id_dipa),
                'no_dipa' => set_value('no_dipa', $row->no_dipa),
                'tahun_anggaran' => set_value('tahun_anggaran', $row->tahun_anggaran),
                'pagu' => set_value('pagu', $row->pagu),
                'kode_dept' => set_value('kode_dept', $row->kode_dept),
                'kode_unit_kerja' => set_value('kode_unit_kerja', $row->kode_unit_kerja),
                'kode_satker' => set_value('kode_satker', $row->kode_satker),
                'create_date' => set_value('create_date', $row->create_date),
            );
            $this->template->load('template', 't_dipa/t_dipa_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('t_dipa'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_dipa', TRUE));
        // } else {
        $data = array(
            'no_dipa' => $this->input->post('no_dipa', TRUE),
            'tahun_anggaran' => $this->input->post('tahun_anggaran', TRUE),
            'pagu' => $this->input->post('pagu', TRUE),
            'kode_dept' => $this->input->post('kode_dept', TRUE),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja', TRUE),
            'kode_satker' => $this->input->post('kode_satker', TRUE),
            'create_date' => $this->input->post('create_date', TRUE),
        );

        $this->T_dipa_model->update($this->input->post('id_dipa', TRUE), $data);
        $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
        redirect(site_url('t_dipa'));
        // }
    }

    public function delete($id)
    {
        $row = $this->T_dipa_model->get_by_id($id);

        if ($row) {
            $this->T_dipa_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('t_dipa'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('t_dipa'));
        }
    }

    //     public function _rules()
    //     {

}

/* End of file T_dipa.php */
/* Location: ./application/controllers/T_dipa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-17 06:01:42 */
/* http://harviacode.com */