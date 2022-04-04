<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_output_sub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_output_sub_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/ref_output_sub/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/ref_output_sub/index/';
            $config['first_url'] = base_url() . 'index.php/ref_output_sub/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Ref_output_sub_model->total_rows($q);
        $ref_output_sub = $this->Ref_output_sub_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ref_output_sub_data' => $ref_output_sub,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','ref_output_sub/ref_output_sub_list', $data);
    }

    public function read($id)
    {
        $row = $this->Ref_output_sub_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ro' => $row->id_ro,
		'kode_ro' => $row->kode_ro,
		'nama_ro' => $row->nama_ro,
		'kode_dept' => $row->kode_dept,
		'kode_unit_kerja' => $row->kode_unit_kerja,
		'kode_program' => $row->kode_program,
		'kode_kegiatan' => $row->kode_kegiatan,
		'kode_kro' => $row->kode_kro,
		'aktif' => $row->aktif,
	    );
            $this->template->load('template','ref_output_sub/ref_output_sub_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_output_sub'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_output_sub/create_action'),
	    'id_ro' => set_value('id_ro'),
	    'kode_ro' => set_value('kode_ro'),
	    'nama_ro' => set_value('nama_ro'),
	    'kode_dept' => set_value('kode_dept'),
	    'kode_unit_kerja' => set_value('kode_unit_kerja'),
	    'kode_program' => set_value('kode_program'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'kode_kro' => set_value('kode_kro'),
	    'aktif' => set_value('aktif'),
	);
        $this->template->load('template','ref_output_sub/ref_output_sub_form', $data);
    }

    public function create_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'kode_ro' => $this->input->post('kode_ro',TRUE),
		'nama_ro' => $this->input->post('nama_ro',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'kode_kro' => $this->input->post('kode_kro',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_output_sub_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Create Record Success 2</strong></div>');
            redirect(site_url('ref_output_sub'));
        //}
    }

    public function update($id)
    {
        $row = $this->Ref_output_sub_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_output_sub/update_action'),
		'id_ro' => set_value('id_ro', $row->id_ro),
		'kode_ro' => set_value('kode_ro', $row->kode_ro),
		'nama_ro' => set_value('nama_ro', $row->nama_ro),
		'kode_dept' => set_value('kode_dept', $row->kode_dept),
		'kode_unit_kerja' => set_value('kode_unit_kerja', $row->kode_unit_kerja),
		'kode_program' => set_value('kode_program', $row->kode_program),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'kode_kro' => set_value('kode_kro', $row->kode_kro),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->template->load('template','ref_output_sub/ref_output_sub_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_output_sub'));
        }
    }

    public function update_action()
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_ro', TRUE));
        // } else {
            $data = array(
		'kode_ro' => $this->input->post('kode_ro',TRUE),
		'nama_ro' => $this->input->post('nama_ro',TRUE),
		'kode_dept' => $this->input->post('kode_dept',TRUE),
		'kode_unit_kerja' => $this->input->post('kode_unit_kerja',TRUE),
		'kode_program' => $this->input->post('kode_program',TRUE),
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'kode_kro' => $this->input->post('kode_kro',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Ref_output_sub_model->update($this->input->post('id_ro', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Record Success</strong></div>');
            redirect(site_url('ref_output_sub'));
        // }
    }

    public function delete($id)
    {
        $row = $this->Ref_output_sub_model->get_by_id($id);

        if ($row) {
            $this->Ref_output_sub_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Delete Record Success</strong></div>');
            redirect(site_url('ref_output_sub'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Record Not Found</strong></div>');
            redirect(site_url('ref_output_sub'));
        }
    }

//     public function _rules()
//     {

}

/* End of file Ref_output_sub.php */
/* Location: ./application/controllers/Ref_output_sub.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-26 15:25:58 */
/* http://harviacode.com */