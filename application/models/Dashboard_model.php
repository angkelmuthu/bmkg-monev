<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public $table = 't_kunjungan';
    public $id = 'kdrs';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all dash
    function ttl_pagu($ta, $satker)
    {
        $this->db->select('sum(jumlah) as pagu');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        return $this->db->get('v_dashboard')->row();
    }

    function ttl_penarikan($ta, $satker)
    {
        $this->db->select('sum(ifnull(januari,0)) as januari,sum(ifnull(februari,0)) as februari,sum(ifnull(maret,0)) as maret,sum(ifnull(april,0)) as april,sum(ifnull(mei,0)) as mei,sum(ifnull(juni,0)) as juni,sum(ifnull(juli,0)) as juli,sum(ifnull(agustus,0)) as agustus,sum(ifnull(september,0)) as september,sum(ifnull(oktober,0)) as oktober,sum(ifnull(november,0)) as november,sum(ifnull(desember,0)) as desember');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        return $this->db->get('v_dashboard')->row();
    }

    function realisasi_pagu($ta, $satker)
    {
        $this->db->select('sum(ifnull(ang_januari,0)) as ang_januari,sum(ifnull(ang_februari,0)) as ang_februari,sum(ifnull(ang_maret,0)) as ang_maret,sum(ifnull(ang_april,0)) as ang_april,sum(ifnull(ang_mei,0)) as ang_mei,sum(ifnull(ang_juni,0)) as ang_juni,sum(ifnull(ang_juli,0)) as ang_juli,sum(ifnull(ang_agustus,0)) as ang_agustus,sum(ifnull(ang_september,0)) as ang_september,sum(ifnull(ang_oktober,0)) as ang_oktober,sum(ifnull(ang_november,0)) as ang_november,sum(ifnull(ang_desember,0)) as ang_desember');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        return $this->db->get('v_dashboard')->row();
    }

    function realisasi_fisik($ta, $satker)
    {
        $this->db->select('sum(ifnull(fisik_januari,0)) as fisik_januari,sum(ifnull(fisik_februari,0)) as fisik_februari,sum(ifnull(fisik_maret,0)) as fisik_maret,sum(ifnull(fisik_april,0)) as fisik_april,sum(ifnull(fisik_mei,0)) as fisik_mei,sum(ifnull(fisik_juni,0)) as fisik_juni,sum(ifnull(fisik_juli,0)) as fisik_juli,sum(ifnull(fisik_agustus,0)) as fisik_agustus,sum(ifnull(fisik_september,0)) as fisik_september,sum(ifnull(fisik_oktober,0)) as fisik_oktober,sum(ifnull(fisik_november,0)) as fisik_november,sum(ifnull(fisik_desember,0)) as fisik_desember');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        return $this->db->get('v_dashboard')->row();
    }

    function kegiatan($ta, $satker)
    {
        $this->db->select('nama_kegiatan,sum(jumlah) as pagu');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        $this->db->group_by('kode_kegiatan');
        $query = $this->db->get('v_dashboard');
        return $query->result();
    }

    function akun($ta, $satker)
    {
        $this->db->select('nama_akun,sum(jumlah) as pagu');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        $this->db->group_by('kode_akun');
        $query = $this->db->get('v_dashboard');
        return $query->result();
    }

    function pagu_realisasi_kegiatan($ta, $satker)
    {
        $this->db->select('nama_kegiatan,
        sum(jumlah) as pagu,
        sum(ifnull(ang_januari,0))+sum(ifnull(ang_februari,0))+sum(ifnull(ang_maret,0))+sum(ifnull(ang_april,0))+sum(ifnull(ang_mei,0))+sum(ifnull(ang_juni,0))+sum(ifnull(ang_juli,0))+sum(ifnull(ang_agustus,0))+sum(ifnull(ang_september,0))+sum(ifnull(ang_oktober,0))+sum(ifnull(ang_november,0))+sum(ifnull(ang_desember,0)) as realisasi');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        $this->db->group_by('kode_kegiatan');
        return $this->db->get('v_dashboard')->result();
    }

    function pagu_realisasi_kro($ta, $satker)
    {
        $this->db->select('nama_kro,
        sum(jumlah) as pagu,
        sum(ifnull(ang_januari,0))+sum(ifnull(ang_februari,0))+sum(ifnull(ang_maret,0))+sum(ifnull(ang_april,0))+sum(ifnull(ang_mei,0))+sum(ifnull(ang_juni,0))+sum(ifnull(ang_juli,0))+sum(ifnull(ang_agustus,0))+sum(ifnull(ang_september,0))+sum(ifnull(ang_oktober,0))+sum(ifnull(ang_november,0))+sum(ifnull(ang_desember,0)) as realisasi');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        $this->db->group_by('kode_kro');
        return $this->db->get('v_dashboard')->result();
    }

    function pagu_realisasi_lokasi($ta, $satker)
    {
        $this->db->select('nama_lokasi,
        sum(jumlah) as pagu,
        sum(ifnull(ang_januari,0))+sum(ifnull(ang_februari,0))+sum(ifnull(ang_maret,0))+sum(ifnull(ang_april,0))+sum(ifnull(ang_mei,0))+sum(ifnull(ang_juni,0))+sum(ifnull(ang_juli,0))+sum(ifnull(ang_agustus,0))+sum(ifnull(ang_september,0))+sum(ifnull(ang_oktober,0))+sum(ifnull(ang_november,0))+sum(ifnull(ang_desember,0)) as realisasi');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        $this->db->group_by('kode_lokasi');
        return $this->db->get('v_dashboard')->result();
    }

    function pagu_realisasi_akun($ta, $satker)
    {
        $this->db->select('nama_akun,
        sum(jumlah) as pagu,
        sum(ifnull(ang_januari,0))+sum(ifnull(ang_februari,0))+sum(ifnull(ang_maret,0))+sum(ifnull(ang_april,0))+sum(ifnull(ang_mei,0))+sum(ifnull(ang_juni,0))+sum(ifnull(ang_juli,0))+sum(ifnull(ang_agustus,0))+sum(ifnull(ang_september,0))+sum(ifnull(ang_oktober,0))+sum(ifnull(ang_november,0))+sum(ifnull(ang_desember,0)) as realisasi');
        $this->db->where('tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('kode_satker', $satker);
        }
        $this->db->group_by('kode_akun');
        return $this->db->get('v_dashboard')->result();
    }

    function pagu_realisasi_detail($ta, $satker)
    {
        $this->db->select('b.nama_satker,a.nama_kegiatan,a.nama_kro,a.nama_akun,
        sum(a.jumlah) as pagu,
        sum(ifnull(a.ang_januari,0))+sum(ifnull(a.ang_februari,0))+sum(ifnull(a.ang_maret,0))+sum(ifnull(a.ang_april,0))+sum(ifnull(a.ang_mei,0))+sum(ifnull(a.ang_juni,0))+sum(ifnull(a.ang_juli,0))+sum(ifnull(a.ang_agustus,0))+sum(ifnull(a.ang_september,0))+sum(ifnull(a.ang_oktober,0))+sum(ifnull(a.ang_november,0))+sum(ifnull(a.ang_desember,0)) as realisasi');
        $this->db->from('v_dashboard a');
        $this->db->join('ref_satker b', 'a.kode_satker=b.kode_satker', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_satker,a.kode_akun,a.kode_kro,a.kode_kegiatan');
        return $this->db->get('v_dashboard')->result();
    }
}
