<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitoring_model extends CI_Model
{

    public $table = 't_kunjungan';
    public $id = 'kdrs';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function monitoring($ta, $lokasi)
    {
        // $this->db->select('b.tahun_anggaran,a.kode_satker,a.nama_satker,a.kode_lokasi,c.nama_lokasi,a.kontak,a.kpa,a.email,a.penjabat_ppk,
        // CASE WHEN COUNT(bb.id_realisasi) > 0 THEN "SUDAH" ELSE "BELUM" END AS realisasi');
        // $this->db->from('ref_satker a');
        // $this->db->join('t_item b', 'a.kode_satker=b.kode_satker and b.tahun_anggaran=' . $ta, 'left');
        // $this->db->join('t_item_realisasi bb', 'b.id_item=bb.id_item', 'left');
        // $this->db->join('ref_lokasi c', 'a.kode_lokasi=c.kode_lokasi', 'left');
        // if (!empty($satker)) {
        //     $this->db->where('a.kode_satker', $satker);
        // }
        // $this->db->group_by('a.kode_satker');
        $this->db->select('
        a.kode_satker,
        a.nama_satker,
        a.kontak,
        a.kpa,
        a.email,
        a.penjabat_ppk,
        a.kode_lokasi,
        b.nama_lokasi,
        ( SELECT ifnull(SUM( jumlah),0 ) FROM v_item_realisasi WHERE kode_satker = a.kode_satker and tahun_anggaran=' . $ta . ') AS pagu,
        ( SELECT ifnull(SUM( ang_januari )+ SUM( ang_februari )+ SUM( ang_maret )+ SUM( ang_april )+ SUM( ang_mei )+ SUM( ang_juni )+ SUM( ang_juli )+ SUM( ang_agustus )+ SUM( ang_september )+ SUM( ang_oktober )+ SUM( ang_november )+ SUM( ang_desember ),0)
        FROM
            v_item_realisasi
        WHERE
            kode_satker = a.kode_satker and tahun_anggaran=' . $ta . '
        ) AS realisasi');
        $this->db->from('ref_satker a');
        $this->db->join('ref_lokasi b', 'a.kode_lokasi=b.kode_lokasi', 'left');
        if (!empty($lokasi)) {
            $this->db->where('a.kode_lokasi', $lokasi);
        }
        //$this->db->group_by('a.kode_satker');
        return $this->db->get()->result();
    }
}
