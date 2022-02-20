<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pok_model extends CI_Model
{

    public $table = 't_program';
    public $id = 'id_program';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id_program,tahun_anggaran,kode_dept,nama_dept,kode_unit_kerja,nama_unit_kerja,kode_satker,nama_satker,create_date');
        $this->datatables->from('v_list_pok');
        $this->datatables->where('kode_dept', $this->session->userdata('kode_dept'));
        $this->datatables->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->datatables->where('kode_satker', $this->session->userdata('kode_satker'));
        $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
        $this->datatables->group_by('tahun_anggaran');
        //add this line for join
        //$this->datatables->join('table2', 't_program.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('pok/read'), '<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-xs btn-info')));
        // $this->datatables->add_column('action', anchor(site_url('pok/read/$1'), '<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm waves-effect waves-themed')) . "
        //     " . anchor(site_url('pok/update/$1'), '<i class="fal fa-pencil" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm waves-effect waves-themed')) . "
        //         " . anchor(site_url('pok/delete/$1'), '<i class="fal fa-trash" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm waves-effect waves-themed" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_program');
        return $this->datatables->generate();
    }

    // get data by id
    function cek_kegiatan($kode_kegiatan)
    {
        $this->db->select('a.*,b.nama_program');
        $this->db->from('ref_kegiatan a');
        $this->db->join('ref_program b', 'a.kode_program=b.kode_program', 'LEFT');
        $this->db->where('a.kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('a.kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('a.kode_kegiatan', $kode_kegiatan);
        return $this->db->get('')->row();
    }

    // get all
    function get_program()
    {
        $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('kode_satker', $this->session->userdata('kode_satker'));
        $this->db->where('tahun_anggaran', $this->session->userdata('ta'));
        $this->db->order_by('create_date', 'ASC');
        return $this->db->get('t_program')->result();
    }

    function get_kro($kode_dept, $kode_unit_kerja, $kode_kegiatan)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->order_by('nama_kro', 'ASC');
        return $this->db->get('ref_output')->result();
    }

    function cek_kro($id_kro)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_kro', $id_kro);
        return $this->db->get('ref_output')->row();
    }

    function get_ro($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->where('kode_kro', $kode_kro);
        $this->db->order_by('nama_ro', 'ASC');
        return $this->db->get('ref_output_sub')->result();
    }

    function cek_ro($id_ro)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_ro', $id_ro);
        return $this->db->get('ref_output_sub')->row();
    }

    function get_komponen($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->where('kode_kro', $kode_kro);
        $this->db->where('kode_ro', $kode_ro);
        $this->db->order_by('nama_komponen', 'ASC');
        return $this->db->get('ref_komponen')->result();
    }

    function cek_komponen($id_komponen)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_komponen', $id_komponen);
        return $this->db->get('ref_komponen')->row();
    }

    function get_komponen_sub($kode_komponen)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('kode_komponen', $kode_komponen);
        $this->db->order_by('nama_komponen_sub', 'ASC');
        return $this->db->get('ref_komponen_sub')->result();
    }

    function cek_komponen_sub($kode_komponen_sub)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('kode_komponen_sub', $kode_komponen_sub);
        return $this->db->get('ref_komponen_sub')->row();
    }
}

/* End of file Pok_model.php */
/* Location: ./application/models/Pok_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-19 05:11:13 */
/* http://harviacode.com */