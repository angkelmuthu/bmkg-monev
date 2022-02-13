<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_satker_model extends CI_Model
{

    public $table = 'ref_satker';
    public $id = 'id_satker';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_satker,kode_satker,nama_satker,kode_jenis_satker,kode_parent_satker,alamat,no_tlpn,kode_dept,kode_unit_kerja,aktif');
        $this->datatables->from('ref_satker');
        //add this line for join
        //$this->datatables->join('table2', 'ref_satker.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('ref_satker/read/$1'),'<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm waves-effect waves-themed'))." 
            ".anchor(site_url('ref_satker/update/$1'),'<i class="fal fa-pencil" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm waves-effect waves-themed'))." 
                ".anchor(site_url('ref_satker/delete/$1'),'<i class="fal fa-trash" aria-hidden="true"></i>','class="btn btn-danger btn-sm waves-effect waves-themed" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_satker');
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
        $this->db->like('id_satker', $q);
	$this->db->or_like('kode_satker', $q);
	$this->db->or_like('nama_satker', $q);
	$this->db->or_like('kode_jenis_satker', $q);
	$this->db->or_like('kode_parent_satker', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_tlpn', $q);
	$this->db->or_like('kode_dept', $q);
	$this->db->or_like('kode_unit_kerja', $q);
	$this->db->or_like('aktif', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_satker', $q);
	$this->db->or_like('kode_satker', $q);
	$this->db->or_like('nama_satker', $q);
	$this->db->or_like('kode_jenis_satker', $q);
	$this->db->or_like('kode_parent_satker', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_tlpn', $q);
	$this->db->or_like('kode_dept', $q);
	$this->db->or_like('kode_unit_kerja', $q);
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

/* End of file Ref_satker_model.php */
/* Location: ./application/models/Ref_satker_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-12 18:08:13 */
/* http://harviacode.com */