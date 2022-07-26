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
        ( SELECT ifnull(SUM( real_januari )+ SUM( real_februari )+ SUM( real_maret )+ SUM( real_april )+ SUM( real_mei )+ SUM( real_juni )+ SUM( real_juli )+ SUM( real_agustus )+ SUM( real_september )+ SUM( real_oktober )+ SUM( real_november )+ SUM( real_desember ),0)
        FROM
        v_pagu_realisasi_omspan
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

    function monitoring_status($ta, $bulan)
    {
        $this->db->select('a.kode_satker,c.nama_satker,a.kode_program,a.nama_program,b.status');
        $this->db->from('t_program a');
        $this->db->join('t_status_kirim b', 'a.id_program = b.id_program AND a.tahun_anggaran = b.tahun and b.bulan=' . $bulan . '', 'left');
        $this->db->join('ref_satker c', 'a.kode_satker = c.kode_satker', 'left');
        if (!empty($ta)) {
            $this->db->where('a.tahun_anggaran', $ta);
        }
        // if (!empty($bulan)) {
        //     $this->db->where('b.bulan', $bulan);
        // }
        return $this->db->get()->result();
    }

    function chart($ta, $bulan)
    {
        $this->db->select('if(b.status is null,"Draft",b.`status`) as status,COUNT(ifnull(b.`status`,"Draft")) as jml');
        $this->db->from('t_program a');
        $this->db->join('t_status_kirim b', 'a.id_program = b.id_program AND a.tahun_anggaran = b.tahun and b.bulan=' . $bulan . '', 'left');
        if (!empty($ta)) {
            $this->db->where('a.tahun_anggaran', $ta);
        }
        $this->db->group_by('b.status');
        return $this->db->get()->result();
    }

    function monitoring_new($ta, $kode_balai, $kode_lokasi, $kode_satker)
    {
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($kode_balai)) {
            $this->db->where('kode_balai', $kode_balai);
        }
        if (!empty($kode_lokasi)) {
            $this->db->where('kode_lokasi', $kode_lokasi);
        }
        if (!empty($kode_satker)) {
            $this->db->where('kode_satker', $kode_satker);
        }
        $this->db->group_by('kode_balai');
        return $this->db->get('v_monitoring_new')->result();
    }
    function chart_new($ta, $kode_balai, $kode_lokasi, $kode_satker)
    {
        if (!empty($kode_balai)) {
            $balai = ' and b.kode_balai="' . $kode_balai . '"';
        } else {
            $balai = '';
        }
        if (!empty($kode_lokasi)) {
            $lokasi = ' and b.kode_lokasi="' . $kode_lokasi . '"';
        } else {
            $lokasi = '';
        }
        if (!empty($kode_satker)) {
            $satker = ' and b.kode_satker="' . $kode_satker . '"';
        } else {
            $satker = '';
        }
        $filter = 'a.status=b.status and b.tahun_anggaran=' . $ta . $balai . $lokasi . $satker;
        $this->db->select('a.status, COUNT(b.status) as jml');
        $this->db->from('ref_status a');
        $this->db->join('v_monitoring_new b', $filter, 'left');
        $this->db->group_by('a.status');
        return $this->db->get()->result();
    }
}
