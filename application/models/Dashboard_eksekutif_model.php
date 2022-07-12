<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_eksekutif_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function real_bmkg()
    {
        $this->db->where('tahun_anggaran', '2022');
        $query = $this->db->get('v_eks_dashboard_total_bmkg');
        return $query->row();
    }
    function real_dukman()
    {
        $this->db->where('tahun_anggaran', '2022');
        $this->db->where('kode_program', 'GJ');
        $query = $this->db->get('v_eks_dashboard_total_per_program');
        return $query->row();
    }
    function real_pmkg()
    {
        $this->db->where('tahun_anggaran', '2022');
        $this->db->where('kode_program', 'WA');
        $query = $this->db->get('v_eks_dashboard_total_per_program');
        return $query->row();
    }
    function real_bulanan()
    {
        $this->db->where('tahun_anggaran', '2022');
        $query = $this->db->get('v_eks_dashboard_total_per_bulan');
        return $query->result();
    }
    function real_kegiatan()
    {
        $this->db->where('tahun_anggaran', '2022');
        $query = $this->db->get('v_eks_dashboard_total_per_jenis_belanja');
        return $query->result();
    }
    function sumber_dana()
    {
        $this->db->where('tahun_anggaran', '2022');
        $query = $this->db->get('v_eks_dashboard_total_per_sumber_dana');
        return $query->result();
    }
    function satker()
    {
        $this->db->where('tahun_anggaran', '2022');
        $query = $this->db->get('v_eks_dashboard_total_per_satker');
        return $query->result();
    }
    function kegiatan()
    {
        $this->db->where('tahun_anggaran', '2022');
        $query = $this->db->get('v_eks_dashboard_total_per_kegiatan');
        return $query->result();
    }
}
