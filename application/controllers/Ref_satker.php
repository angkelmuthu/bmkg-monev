<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_satker extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_satker_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'ref_satker/ref_satker_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Ref_satker_model->json();
    }

    public function read($id)
    {
        $row = $this->Ref_satker_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_satker' => $row->id_satker,
                'kode_satker' => $row->kode_satker,
                'nama_satker' => $row->nama_satker,
                'kode_jenis_satker' => $row->kode_jenis_satker,
                'kode_parent_satker' => $row->kode_parent_satker,
                'alamat' => $row->alamat,
                'no_tlpn' => $row->no_tlpn,
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'penjabat_ppk' => $row->penjabat_ppk,
                'kpa' => $row->kpa,
                'operator' => $row->operator,
                'email' => $row->email,
                'kontak' => $row->kontak,
                'aktif' => $row->aktif,
            );
            $this->template->load('template', 'ref_satker/ref_satker_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_satker'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_satker/create_action'),
            'id_satker' => set_value('id_satker'),
            'kode_satker' => set_value('kode_satker'),
            'nama_satker' => set_value('nama_satker'),
            'kode_jenis_satker' => set_value('kode_jenis_satker'),
            'kode_parent_satker' => set_value('kode_parent_satker'),
            'alamat' => set_value('alamat'),
            'no_tlpn' => set_value('no_tlpn'),
            'kode_dept' => set_value('kode_dept'),
            'kode_unit_kerja' => set_value('kode_unit_kerja'),
            'penjabat_ppk' => set_value('penjabat_ppk'),
            'kpa' => set_value('kpa'),
            'operator' => set_value('operator'),
            'email' => set_value('email'),
            'kontak' => set_value('kontak'),
            'aktif' => set_value('aktif'),
        );
        $this->template->load('template', 'ref_satker/ref_satker_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
        $data = array(
            'kode_satker' => $this->input->post('kode_satker', TRUE),
            'nama_satker' => $this->input->post('nama_satker', TRUE),
            'kode_jenis_satker' => $this->input->post('kode_jenis_satker', TRUE),
            'kode_parent_satker' => $this->input->post('kode_parent_satker', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'no_tlpn' => $this->input->post('no_tlpn', TRUE),
            'kode_dept' => $this->input->post('kode_dept', TRUE),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja', TRUE),
            'penjabat_ppk' => $this->input->post('penjabat_ppk', TRUE),
            'kpa' => $this->input->post('kpa', TRUE),
            'operator' => $this->input->post('operator', TRUE),
            'email' => $this->input->post('email', TRUE),
            'kontak' => $this->input->post('kontak', TRUE),
            'aktif' => $this->input->post('aktif', TRUE),
        );

        $this->Ref_satker_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
        redirect(site_url('ref_satker'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_satker_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_satker/update_action'),
                'id_satker' => set_value('id_satker', $row->id_satker),
                'kode_satker' => set_value('kode_satker', $row->kode_satker),
                'nama_satker' => set_value('nama_satker', $row->nama_satker),
                'kode_jenis_satker' => set_value('kode_jenis_satker', $row->kode_jenis_satker),
                'kode_parent_satker' => set_value('kode_parent_satker', $row->kode_parent_satker),
                'alamat' => set_value('alamat', $row->alamat),
                'no_tlpn' => set_value('no_tlpn', $row->no_tlpn),
                'kode_dept' => set_value('kode_dept', $row->kode_dept),
                'kode_unit_kerja' => set_value('kode_unit_kerja', $row->kode_unit_kerja),
                'penjabat_ppk' => set_value('penjabat_ppk', $row->penjabat_ppk),
                'kpa' => set_value('kpa', $row->kpa),
                'operator' => set_value('operator', $row->operator),
                'email' => set_value('email', $row->email),
                'kontak' => set_value('kontak', $row->kontak),
                'aktif' => set_value('aktif', $row->aktif),
            );
            $this->template->load('template', 'ref_satker/ref_satker_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_satker'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_satker', TRUE));
        // } else {
        $data = array(
            'kode_satker' => $this->input->post('kode_satker', TRUE),
            'nama_satker' => $this->input->post('nama_satker', TRUE),
            'kode_jenis_satker' => $this->input->post('kode_jenis_satker', TRUE),
            'kode_parent_satker' => $this->input->post('kode_parent_satker', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'no_tlpn' => $this->input->post('no_tlpn', TRUE),
            'kode_dept' => $this->input->post('kode_dept', TRUE),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja', TRUE),
            'penjabat_ppk' => $this->input->post('penjabat_ppk', TRUE),
            'kpa' => $this->input->post('kpa', TRUE),
            'operator' => $this->input->post('operator', TRUE),
            'email' => $this->input->post('email', TRUE),
            'kontak' => $this->input->post('kontak', TRUE),
            'aktif' => $this->input->post('aktif', TRUE),
        );

        $this->Ref_satker_model->update($this->input->post('id_satker', TRUE), $data);
        $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
        redirect(site_url('ref_satker'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_satker_model->get_by_id($id);

        if ($row) {
            $this->Ref_satker_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_satker'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_satker'));
        }
    }

    //     public function _rules()
    //     {

}

/* End of file Ref_satker.php */
/* Location: ./application/controllers/Ref_satker.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 18:08:13 */
/* http://harviacode.com */