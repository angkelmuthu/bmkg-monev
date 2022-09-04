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
        $this->db->select('c.nama_program,round(sum(a.jumlah),0) as pagu');
        $this->db->from('t_item a');
        $this->db->join('ref_program c', 'a.kode_program = c.kode_program', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_program');
        $query = $this->db->get();
        return $query->result();
    }

    function akun($ta, $satker)
    {
        $this->db->select('CASE
        WHEN left(a.kode_akun,2)=51 THEN "Pegawai"
        WHEN left(a.kode_akun,2)=52 THEN "Barang"
        ELSE "Modal" END as nama_akun,round(sum(a.jumlah),0) as pagu');
        $this->db->from('t_item a');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('left(a.kode_akun,2)');
        $query = $this->db->get();
        return $query->result();
    }

    function pagu_realisasi_kegiatan($ta, $satker)
    {
        $this->db->select('c.nama_kegiatan,
        sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        $this->db->from('t_item a');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->join('ref_kegiatan c', 'a.kode_kegiatan = c.kode_kegiatan AND a.kode_program = c.kode_program', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_kegiatan');
        return $this->db->get()->result();
    }

    function pagu_realisasi_kro($ta, $satker)
    {
        $this->db->select('c.nama_kro,
        sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        $this->db->from('t_item a');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->join('ref_output c', 'a.kode_kro = c.kode_kro', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_kro');
        return $this->db->get()->result();
    }

    function pagu_realisasi_lokasi($ta, $satker)
    {
        $this->db->select('c.nama_lokasi,
        sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        $this->db->from('t_item a');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->join('ref_lokasi c', 'a.kode_lokasi = c.kode_lokasi', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_lokasi');
        return $this->db->get()->result();
    }

    function pagu_realisasi_akun($ta, $satker)
    {
        $this->db->select('c.nama_akun,
        sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        $this->db->from('t_item a');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->join('ref_akun c', 'a.kode_akun = c.kode_akun', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_akun');
        return $this->db->get()->result();
    }

    function pagu_realisasi_belanja($ta, $satker)
    {
        $this->db->select('CASE
        WHEN left(a.kode_akun,2)=51 THEN "Pegawai"
        WHEN left(a.kode_akun,2)=52 THEN "Barang"
        ELSE "Modal" END as nama_akun,
        sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        $this->db->from('t_item a');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('left(a.kode_akun,2)');
        return $this->db->get()->result();
    }

    function pagu_realisasi_dana($ta, $satker)
    {
        $this->db->select('c.nama_beban,
        sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        $this->db->from('t_item a');
        $this->db->join('t_akun aa', 'a.kode_akun = aa.kode_akun AND a.kode_komponen_sub = aa.kode_komponen_sub AND a.kode_komponen = aa.kode_komponen AND a.kode_ro = aa.kode_ro AND a.kode_kro = aa.kode_kro AND a.kode_kegiatan = aa.kode_kegiatan AND a.kode_program = aa.kode_program AND a.kode_dept = aa.kode_dept AND a.kode_unit_kerja = aa.kode_unit_kerja AND a.kode_satker= aa.kode_satker AND a.tahun_anggaran = aa.tahun_anggaran', 'left');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->join('ref_beban c', 'aa.kode_beban = c.kode_beban', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('aa.kode_beban');
        return $this->db->get()->result();
    }

    function pagu_realisasi_detail($ta, $satker)
    {
        $this->db->select('c.nama_satker,d.nama_kegiatan,e.nama_kro,f.nama_akun, sum(a.jumlah) as pagu,
        sum(ifnull(b.ang_januari,0))+sum(ifnull(b.ang_februari,0))+sum(ifnull(b.ang_maret,0))+sum(ifnull(b.ang_april,0))+sum(ifnull(b.ang_mei,0))+sum(ifnull(b.ang_juni,0))+sum(ifnull(b.ang_juli,0))+sum(ifnull(b.ang_agustus,0))+sum(ifnull(b.ang_september,0))+sum(ifnull(b.ang_oktober,0))+sum(ifnull(b.ang_november,0))+sum(ifnull(b.ang_desember,0)) as realisasi');
        //$this->db->from('v_dashboard a');
        $this->db->from('t_item a');
        $this->db->join('t_item_realisasi b', 'a.id_item = b.id_item', 'left');
        $this->db->join('ref_satker c', 'a.kode_satker=c.kode_satker', 'left');
        $this->db->join('ref_kegiatan d', 'a.kode_kegiatan = d.kode_kegiatan', 'left');
        $this->db->join('ref_output e', 'a.kode_kro = e.kode_kro', 'left');
        $this->db->join('ref_akun f', 'a.kode_akun = f.kode_akun', 'left');
        $this->db->where('a.tahun_anggaran', $ta);
        if (!empty($satker)) {
            $this->db->where('a.kode_satker', $satker);
        }
        $this->db->group_by('a.kode_satker,a.kode_akun,a.kode_kro,a.kode_kegiatan');
        return $this->db->get()->result();
    }
}
