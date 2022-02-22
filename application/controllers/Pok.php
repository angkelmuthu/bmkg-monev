<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pok_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'pok/pok_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Pok_model->json();
    }

    public function read()
    {
        $this->template->load('template', 'pok/pok_read');
    }

    public function pok_data()
    {
        //$data['list_program'] = $this->Pok_model->get_program();
        $this->load->view('pok/pok_data');
    }

    function tambah_kegiatan()
    {
        $row = $this->Pok_model->cek_kegiatan($this->input->post('kode_kegiatan'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $arr_program = array(
                'nama_program' => $row->nama_program,
            );

            $program = array_merge($arr, $arr_program);
            $this->db->insert('t_program', $program);

            $arr_kegiatan = array(
                'kode_kegiatan' => $row->kode_kegiatan,
                'nama_kegiatan' => $row->nama_kegiatan,
            );
            $arr_merger = array_merge($arr, $arr_kegiatan);
            $this->db->insert('t_kegiatan', $arr_merger);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function get_kro()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $data = array(
            'dt_kro' => $this->Pok_model->get_kro($kode_dept, $kode_unit_kerja, $kode_kegiatan),
        );
        $this->load->view('pok/pok_modal_kro', $data);
    }

    function tambah_kro()
    {
        $row = $this->Pok_model->cek_kro($this->input->post('id_kro'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'nama_kro' => $row->nama_kro,
                'volume' => $this->input->post('volume'),
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_output', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function get_ro()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $data = array(
            'dt_ro' => $this->Pok_model->get_ro($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro),
        );
        $this->load->view('pok/pok_modal_ro', $data);
    }

    function tambah_ro()
    {
        $row = $this->Pok_model->cek_ro($this->input->post('id_ro'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'kode_ro' => $row->kode_ro,
                'nama_ro' => $row->nama_ro,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_output_sub', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function get_komponen()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $data = array(
            'dt_komponen' => $this->Pok_model->get_komponen($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro),
        );
        $this->load->view('pok/pok_modal_komponen', $data);
    }

    function tambah_komponen()
    {
        $row = $this->Pok_model->cek_komponen($this->input->post('id_komponen'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'kode_ro' => $row->kode_ro,
                'kode_komponen' => $row->kode_komponen,
                'nama_komponen' => $row->nama_komponen,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_komponen', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function get_komponen_sub()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $data = array(
            'dt_komponen_sub' => $this->Pok_model->get_komponen_sub($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen),
        );
        $this->load->view('pok/pok_modal_komponen_sub', $data);
    }

    function tambah_komponen_sub()
    {
        $row = $this->Pok_model->cek_komponen_sub($this->input->post('id_komponen_sub'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'kode_ro' => $row->kode_ro,
                'kode_komponen' => $row->kode_komponen,
                'kode_komponen_sub' => $row->kode_komponen_sub,
                'nama_komponen_sub' => $row->nama_komponen_sub,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_komponen_sub', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }


    function get_akun()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $kode_komponen_sub = $this->input->post('kode_komponen_sub');
        $data = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'dt_akun' => $this->Pok_model->get_akun($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen, $kode_komponen_sub),
        );
        $this->load->view('pok/pok_modal_akun', $data);
    }

    function tambah_akun()
    {
        $str_akun = $this->input->post('akun');
        $akun = explode('|', $str_akun);
        $arr = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'kode_akun' => $akun['0'],
            'nama_akun' => $akun['1'],
            'tahun_anggaran' => $this->session->userdata('ta'),
            'kode_satker' => $this->session->userdata('kode_satker'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_akun', $arr);
    }

    function get_item()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_program = $this->input->post('kode_program');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $kode_komponen_sub = $this->input->post('kode_komponen_sub');
        $kode_akun = $this->input->post('kode_akun');
        $data = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'kode_akun' => $this->input->post('kode_akun'),
            'dt_item_head' => $this->Pok_model->get_item_head($kode_dept, $kode_unit_kerja, $kode_program, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen, $kode_komponen_sub, $kode_akun),
        );
        $this->load->view('pok/pok_modal_item', $data);
    }

    function tambah_item()
    {
        if ($this->input->post('item_title') == '0') {
            $item_title = $this->input->post('item_title_baru');
        } else {
            $item_title = $this->input->post('item_title');
        }
        $arr = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'kode_akun' => $this->input->post('kode_akun'),
            'item_title' => $item_title,
            'item' => $this->input->post('item'),
            'volume' => $this->input->post('volume'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'jumlah' => $this->input->post('total'),
            'tahun_anggaran' => $this->session->userdata('ta'),
            'kode_satker' => $this->session->userdata('kode_satker'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_item', $arr);
    }
}

/* End of file Pok.php */
/* Location: ./application/controllers/Pok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-19 05:11:13 */
/* http://harviacode.com */