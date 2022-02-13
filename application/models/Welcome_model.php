<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome_model extends CI_Model
{

    public $table = 't_kunjungan';
    public $id = 'kdrs';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all dash
    function ttl_risk()
    {
        //$date = new DateTime("now");
        //$curr_date = $date->format('Y-m-d');
        $this->db->select('nm_pj,count(id_risk) as ttl');
        $this->db->from('v_resiko');
        $this->db->group_by('id_pj');
        $this->db->order_by('ttl DESC');
        //$this->db->where('DATE(a.tgl)', $curr_date);
        $query = $this->db->get();
        return $query->result();
    }
    // get data rs by kdrs
    function peta_risk()
    {
        $query = $this->db->get('v_peta_resiko');
        return $query->result();
    }
    // get data kunjungan hari ini by kdrs
    function get_kunjungan_day_by($id)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');
        $this->db->select('*');
        $this->db->from('t_kunjungan');
        $this->db->where('kdrs', $id);
        $this->db->where('DATE(tgl)', $curr_date);
        $query = $this->db->get();
        return $query->result();
    }
}
