<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_test extends CI_Model
{

    public $table = 'test';
    public $id = 'id';
    public $order = 'DESC';

    public function getAll()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    public function getDetail($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return array('status' => 201, 'message' => 'Data berhasil dibuat');
    }

    public function update($data, $id)
    {
        $this->db->where($this->id, $id)->update($this->table, $data);
        return array('status' => 201, 'message' => 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->db->where($this->id, $id)->delete($this->table);
        //return array('status' => 201, 'message' => 'Data has been deleted');
        if ($this->db->affected_rows() > 0) {
            return array('status' => 201, 'message' => 'Data berhasil dihapus');
        } else {
            return array('status' => 201, 'message' => 'Data tidak tersedia');
        }
    }
}
