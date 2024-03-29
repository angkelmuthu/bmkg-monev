<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pok_model extends CI_Model
{

    public $table = 't_program';
    public $id = 'id_program';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id_program,tahun_anggaran,kode_dept,nama_dept,kode_unit_kerja,nama_unit_kerja,kode_satker,nama_satker,create_date');
        $this->datatables->from('v_list_pok');
        if ($this->session->userdata('id_user_level') == 1) {
            $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
        } else {
            $this->datatables->where('kode_dept', $this->session->userdata('kode_dept'));
            $this->datatables->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
            $this->datatables->where('kode_satker', $this->session->userdata('kode_satker'));
            $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
            $this->datatables->group_by('tahun_anggaran');
        }
        //add this line for join
        //$this->datatables->join('table2', 't_program.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('pok/read/$1'), '<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-xs btn-info')), 'id_program');
        // $this->datatables->add_column('action', anchor(site_url('pok/read/$1'), '<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm waves-effect waves-themed')) . "
        //     " . anchor(site_url('pok/update/$1'), '<i class="fal fa-pencil" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm waves-effect waves-themed')) . "
        //         " . anchor(site_url('pok/delete/$1'), '<i class="fal fa-trash" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm waves-effect waves-themed" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_program');
        return $this->datatables->generate();
    }
	
    function json_realisasi()
    {
        $this->datatables->select('id_program,tahun_anggaran,kode_dept,nama_dept,kode_unit_kerja,nama_unit_kerja,kode_satker,nama_satker,create_date,kirim');
        $this->datatables->from('v_list_pok');
        if ($this->session->userdata('id_user_level') == 1) {
            $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
        } else {
            $this->datatables->where('kode_dept', $this->session->userdata('kode_dept'));
            $this->datatables->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
            $this->datatables->where('kode_satker', $this->session->userdata('kode_satker'));
            $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
            $this->datatables->group_by('tahun_anggaran');
        }

        //var_dump($this->datatables);
        //add this line for join
        //$this->datatables->join('table2', 't_program.field = table2.field');
      //  $this->datatables->add_column('action', anchor(site_url('pok/realisasi_kegiatan/$1'), 'Realisasi Per Item', array('class' => 'btn btn-xs btn-info')) ."
        // " . anchor(site_url('pok/realisasi_kegiatan_fisik/$1'), 'Realisasi Per Akun', array('class' => 'btn btn-xs btn-warning')), 'id_program');
        $this->datatables->add_column('action', anchor(site_url('pok/realisasi_kegiatan/$1'), 'Realisasi Per Item', array('class' => 'btn btn-xs btn-info')), 'id_program');
        // $this->datatables->add_column('action', anchor(site_url('pok/read/$1'), '<i class="fal fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm waves-effect waves-themed')) . "
        //     " . anchor(site_url('pok/update/$1'), '<i class="fal fa-pencil" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm waves-effect waves-themed')) . "
        //         " . anchor(site_url('pok/delete/$1'), '<i class="fal fa-trash" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm waves-effect waves-themed" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_program');
        return $this->datatables->generate();
    }
	function json_realisasi_fisik()
    {
        $this->datatables->select('id_program,tahun_anggaran,kode_dept,nama_dept,kode_unit_kerja,nama_unit_kerja,kode_satker,nama_satker,create_date,kirim');
        $this->datatables->from('v_list_pok');
        if ($this->session->userdata('id_user_level') == 1) {
            $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
        } else {
            $this->datatables->where('kode_dept', $this->session->userdata('kode_dept'));
            $this->datatables->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
            $this->datatables->where('kode_satker', $this->session->userdata('kode_satker'));
            $this->datatables->where('tahun_anggaran', $this->session->userdata('ta'));
            $this->datatables->group_by('tahun_anggaran');
        }
        $this->datatables->add_column('action', anchor(site_url('pok/realisasi_kegiatan_fisik/$1'), 'Realisasi Fisik', array('class' => 'btn btn-xs btn-info')), 'id_program,kirim');
        return $this->datatables->generate();
    }

    // get data by id
    function read($id)
    {
        $this->db->select('a.tahun_anggaran,c.nama_satker,sum(b.jumlah) as total');
        $this->db->from('t_program a');
        $this->db->join('t_item b', 'a.kode_satker=b.kode_satker and a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.tahun_anggaran=b.tahun_anggaran', 'left');
        $this->db->join('ref_satker c', 'a.kode_satker=c.kode_satker', 'left');
        $this->db->where('a.id_program', $id);
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        // $this->db->where('tahun_anggaran', $this->session->userdata('ta'));
        return $this->db->get()->row();
    }
	
	function read_fisik($id)
    {
        $this->db->select('a.tahun_anggaran,c.nama_satker,sum(b.jumlah) as total');
        $this->db->from('t_program a');
        $this->db->join('t_item b', 'a.kode_satker=b.kode_satker and a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.tahun_anggaran=b.tahun_anggaran', 'left');
        $this->db->join('ref_satker c', 'a.kode_satker=c.kode_satker', 'left');
        $this->db->where('a.id_program', $id);
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        // $this->db->where('tahun_anggaran', $this->session->userdata('ta'));
        return $this->db->get()->row();
    }

    function pok_data($id)
    {
        $this->db->where('id_program', $id);
        return $this->db->get('t_program')->row();
    }

    function cek_kegiatan($kode_kegiatan)
    {
        $this->db->select('a.*,b.nama_program');
        $this->db->from('ref_kegiatan a');
        $this->db->join('ref_program b', 'a.kode_program=b.kode_program', 'LEFT');
        $this->db->where('a.kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('a.kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('a.kode_kegiatan', $kode_kegiatan);
        return $this->db->get('')->row();
    }

    // get all
    function get_program()
    {
        $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('kode_satker', $this->session->userdata('kode_satker'));
        $this->db->where('tahun_anggaran', $this->session->userdata('ta'));
        $this->db->order_by('create_date', 'ASC');
        return $this->db->get('t_program')->result();
    }

    function get_kro($kode_dept, $kode_unit_kerja, $kode_kegiatan)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->order_by('nama_kro', 'ASC');
        return $this->db->get('ref_output')->result();
    }

    function cek_kro($id_kro)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_kro', $id_kro);
        return $this->db->get('ref_output')->row();
    }

    function get_ro($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->where('kode_kro', $kode_kro);
        $this->db->order_by('nama_ro', 'ASC');
        return $this->db->get('ref_output_sub')->result();
    }

    function cek_ro($id_ro)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_ro', $id_ro);
        return $this->db->get('ref_output_sub')->row();
    }

    function get_komponen($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->where('kode_kro', $kode_kro);
        $this->db->where('kode_ro', $kode_ro);
        $this->db->order_by('nama_komponen', 'ASC');
        return $this->db->get('ref_komponen')->result();
    }

    function cek_komponen($id_komponen)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_komponen', $id_komponen);
        return $this->db->get('ref_komponen')->row();
    }

    function get_komponen_sub($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen)
    {
        $this->db->where('aktif', 'y');
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->where('kode_kro', $kode_kro);
        $this->db->where('kode_ro', $kode_ro);
        $this->db->where('kode_komponen', $kode_komponen);
        $this->db->order_by('nama_komponen_sub', 'ASC');
        return $this->db->get('ref_komponen_sub')->result();
    }

    function cek_komponen_sub($id_komponen_sub)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_komponen_sub', $id_komponen_sub);
        return $this->db->get('ref_komponen_sub')->row();
    }

    function get_akun($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen, $kode_komponen_sub)
    {
        $this->db->where('aktif', 'y');
        $this->db->order_by('nama_akun', 'ASC');
        return $this->db->get('ref_akun')->result();
    }

    function cek_akun($id_akun)
    {
        $this->db->where('aktif', 'y');
        // $this->db->where('kode_dept', $this->session->userdata('kode_dept'));
        // $this->db->where('kode_unit_kerja', $this->session->userdata('kode_unit_kerja'));
        $this->db->where('id_akun', $id_akun);
        return $this->db->get('ref_akun')->row();
    }
	function data_ompsan($satker,$tahun)
    {
		
        $this->db->select('*');
        $this->db->from('realisasi_omspan');
		 $this->db->where('tahun', $tahun);
        $this->db->where('kdsatker', $satker);
        return $this->db->get()->result();
    }

    function get_item_head($kode_dept, $kode_unit_kerja, $kode_program, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen, $kode_komponen_sub, $kode_akun)
    {
        $this->db->where('kode_dept', $kode_dept);
        $this->db->where('kode_unit_kerja', $kode_unit_kerja);
        $this->db->where('kode_program', $kode_program);
        $this->db->where('kode_kegiatan', $kode_kegiatan);
        $this->db->where('kode_kro', $kode_kro);
        $this->db->where('kode_ro', $kode_ro);
        $this->db->where('kode_komponen', $kode_komponen);
        $this->db->where('kode_komponen_sub', $kode_komponen_sub);
        $this->db->where('kode_akun', $kode_akun);
        $this->db->where('item_title !=', '');
        $this->db->group_by('item_title', 'ASC');
        $this->db->order_by('item_title', 'ASC');
        return $this->db->get('t_item')->result();
    }

    function cek_realisasi_omspan($tahun)
	{
		$this->db->where('tahun', $tahun);
		$this->db->delete('realisasi_omspan');
	}
	function get_akun_id($id,$tahun,$kom,$ro,$kro,$kegiatan,$subkom,$satker,$program)
    {
		
		  $this->db->select('t_item.*, sum(jumlah)as total,
							t_akun.nama_akun,t_output.nama_kro,t_kegiatan.nama_kegiatan,t_program.nama_program,
							v_pagu_realisasi_omspan.real_januari,v_pagu_realisasi_omspan.real_februari,v_pagu_realisasi_omspan.real_maret,
							v_pagu_realisasi_omspan.real_april,v_pagu_realisasi_omspan.real_mei,v_pagu_realisasi_omspan.real_juni,
							v_pagu_realisasi_omspan.real_juli,v_pagu_realisasi_omspan.real_agustus,v_pagu_realisasi_omspan.real_september,
							v_pagu_realisasi_omspan.real_oktober,v_pagu_realisasi_omspan.real_november,v_pagu_realisasi_omspan.real_desember');
        $this->db->from('t_item');
        $this->db->join('t_akun', 't_akun.tahun_anggaran=t_item.tahun_anggaran and t_akun.kode_satker=t_item.kode_satker
												and t_akun.kode_program=t_item.kode_program
												and t_akun.kode_kegiatan=t_item.kode_kegiatan
												and t_akun.kode_kro=t_item.kode_kro
												and t_akun.kode_ro=t_item.kode_ro
												and t_akun.kode_komponen=t_item.kode_komponen	
												and t_akun.kode_komponen_sub=t_item.kode_komponen_sub
												and t_akun.kode_akun=t_item.kode_akun
												and t_akun.kode_beban=t_item.kode_beban', 'LEFT');
		$this->db->join('t_output', 't_output.tahun_anggaran=t_item.tahun_anggaran
												and t_output.kode_satker=t_item.kode_satker
												and t_output.kode_program=t_item.kode_program
												and t_output.kode_kegiatan=t_item.kode_kegiatan
												and t_output.kode_kro=t_item.kode_kro', 'LEFT');
		$this->db->join('t_kegiatan', 't_kegiatan.tahun_anggaran=t_item.tahun_anggaran
												and t_kegiatan.kode_satker=t_item.kode_satker
												and t_kegiatan.kode_program=t_item.kode_program
												and t_kegiatan.kode_kegiatan=t_item.kode_kegiatan', 'LEFT');
		$this->db->join('t_program', 't_program.tahun_anggaran=t_item.tahun_anggaran
												and t_program.kode_satker=t_item.kode_satker
												and t_program.kode_program=t_item.kode_program', 'LEFT');
		$this->db->join('v_pagu_realisasi_omspan', 'v_pagu_realisasi_omspan.tahun_anggaran=t_item.tahun_anggaran and v_pagu_realisasi_omspan.kode_satker=t_item.kode_satker
												and v_pagu_realisasi_omspan.kode_program=t_item.kode_program
												and v_pagu_realisasi_omspan.kode_kegiatan=t_item.kode_kegiatan
												and v_pagu_realisasi_omspan.kode_kro=t_item.kode_kro
												
												and v_pagu_realisasi_omspan.kode_akun=t_item.kode_akun
												and v_pagu_realisasi_omspan.kode_beban=t_item.kode_beban', 'LEFT');
        $this->db->where('t_item.kode_akun', $id);
        $this->db->where('t_item.kode_komponen_sub', $subkom);
        $this->db->where('t_item.kode_komponen', $kom);
        $this->db->where('t_item.kode_ro', $ro);
        $this->db->where('t_item.kode_kro', $kro);
        $this->db->where('t_item.kode_kegiatan', $kegiatan);
        $this->db->where('t_item.kode_program', $program);
        $this->db->where('t_item.kode_satker', $satker);
        $this->db->where('t_item.tahun_anggaran', $tahun);
		$this->db->group_by('t_item.kode_program,t_item.kode_kegiatan,t_item.kode_kro,t_item.kode_akun');
         return $this->db->get()->row();

		//return $query->result_array;
    }
    function get_item_id($id)
    {
        $this->db->where('id_item', $id);
        return $this->db->get('t_item')->row();
    }
    function get_real_item_id($id)
    {
        $this->db->where('id_item', $id);
        return $this->db->get('t_item_realisasi')->row();
    }
	function get_real_item_id_fisik($id,$tahun,$kom,$ro,$kro,$kegiatan,$subkom,$satker,$program)
    {
        $this->db->where('kode_akun', $id);
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->where('kode_komponen', $kom);
        $this->db->where('kode_komponen_sub', $subkom);
        $this->db->where('kode_ro', $ro);
        $this->db->where('kode_kro', $kro);
        $this->db->where('kode_kegiatan', $kegiatan);
        $this->db->where('kode_satker', $satker);
        $this->db->where('kode_program', $program);
        return $this->db->get('t_item_realisasi_fisik')->row();
    }
	function get_satker_sakti()
    {
        $this->db->select('refAdmin.*,if(ref_satker.nama_satker is null,refAdmin.nama_kppn,ref_satker.nama_satker)as nama_satker');
        $this->db->from('refAdmin');
		$this->db->join('ref_satker', 'ref_satker.kode_satker=refAdmin.kdsatker', 'LEFT');

        return $this->db->get()->result();
    }
	function get_status_realisasi_all($tahun, $bulan)
    {
        $this->db->select('c.*,a.kode_satker,a.id_program');
        $this->db->from('t_item_realisasi c');
        $this->db->join('t_item b', 'c.id_item=b.id_item', 'LEFT');
        $this->db->join('t_program a', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker
		and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
        $this->db->where('b.tahun_anggaran', $tahun);
        $this->db->group_by('a.kode_program');

        return $this->db->get()->result();
    }
    function get_status_realisasi($satker, $id_program, $tahun, $bulan)
    {
        $this->db->select('c.*');
        $this->db->from('t_item_realisasi c');
        $this->db->join('t_item b', 'c.id_item=b.id_item', 'LEFT');
        $this->db->join('t_program a', 'a.kode_dept=b.kode_dept and a.kode_unit_kerja=b.kode_unit_kerja and a.kode_satker=b.kode_satker
		and a.tahun_anggaran=b.tahun_anggaran and a.kode_program=b.kode_program', 'LEFT');
        $this->db->where('a.id_program', $id_program);
        $this->db->where('a.kode_satker', $satker);
        $this->db->where('b.tahun_anggaran', $tahun);
        $this->db->group_by('a.kode_program');

        return $this->db->get()->result();
    }
    function get_status_kirim($satker, $tahun, $bulan)
    {
        $this->db->select('status,keterangan');
        $this->db->where('kode_satker', $satker);
        $this->db->where('tahun', $tahun);
        $this->db->where('bulan', $bulan);
        $this->db->where('flag', 1);
        return $this->db->get('t_status_kirim')->row();
    }
    function get_status_kirim_grup($satker, $tahun, $bulan)
    {
        $this->db->select('group_concat(status)as status,group_concat(keterangan)as keterangan');
        $this->db->where('kode_satker', $satker);
        $this->db->where('tahun', $tahun);
        $this->db->where('bulan', $bulan);

        // $this->db->where('flag', 1);
        $this->db->group_by('kode_satker,tahun,bulan,id_program');
        return $this->db->get('t_status_kirim')->row();
    }
    function get_kirim($satker, $id_program, $tahun, $bulan)
    {
        $this->db->where('kode_satker', $satker);
        $this->db->where('id_program', $id_program);
        $this->db->where('tahun', $tahun);
        $this->db->where('bulan', $bulan);
        $this->db->where('flag', 1);
        return $this->db->get('t_status_kirim')->row();
    }
	function get_kirim_fisik($satker, $id_program, $tahun, $bulan)
    {
        $this->db->where('kode_satker', $satker);
        $this->db->where('id_program', $id_program);
        $this->db->where('tahun', $tahun);
        $this->db->where('bulan', $bulan);
        $this->db->where('flag', 1);
        return $this->db->get('t_status_kirim_fisik')->row();
    }
}

/* End of file Pok_model.php */
/* Location: ./application/models/Pok_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-19 05:11:13 */
/* http://harviacode.com */