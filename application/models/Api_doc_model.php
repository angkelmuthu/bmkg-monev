<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_doc_model extends CI_Model
{

    public $table = 'tbl_api_menu';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->order_by('is_aktif', 'y');
        return $this->db->get($this->table)->result();
    }
}

/* End of file Tbl_menu_api_model.php */
/* Location: ./application/models/Tbl_menu_api_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-09 15:37:36 */
/* http://harviacode.com */