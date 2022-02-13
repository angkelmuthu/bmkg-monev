<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_kegiatan_model extends CI_Model
{

    public $table = 'ref_kegiatan';
    public $id = 'id_kegiatan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_kegiatan,kode_kegiatan,nama_kegiatan,kode_dept,kode_unit_kerja,kode_program,aktif');
        $this->datatables->from('ref_kegiatan');
        //add this line for join
        //$this->datatables->join('table2', 'ref_kegiatan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('ref_kegiatan/read/$1'),'<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm waves-effect waves-themed'))." 
            ".anchor(site_url('ref_kegiatan/update/$1'),'<i class="fal fa-pencil" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm waves-effect waves-themed'))." 
                ".anchor(site_url('ref_kegiatan/delete/$1'),'<i class="fal fa-trash" aria-hidden="true"></i>','class="btn btn-danger btn-sm waves-effect waves-themed" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_kegiatan');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_kegiatan', $q);
	$this->db->or_like('kode_kegiatan', $q);
	$this->db->or_like('nama_kegiatan', $q);
	$this->db->or_like('kode_dept', $q);
	$this->db->or_like('kode_unit_kerja', $q);
	$this->db->or_like('kode_program', $q);
	$this->db->or_like('aktif', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kegiatan', $q);
	$this->db->or_like('kode_kegiatan', $q);
	$this->db->or_like('nama_kegiatan', $q);
	$this->db->or_like('kode_dept', $q);
	$this->db->or_like('kode_unit_kerja', $q);
	$this->db->or_like('kode_program', $q);
	$this->db->or_like('aktif', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Ref_kegiatan_model.php */
/* Location: ./application/models/Ref_kegiatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 18:25:42 */
/* http://harviacode.com */