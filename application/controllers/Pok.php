<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pok_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'pok/pok_list');
    }
    public function realisasi()
    {
		
        $this->template->load('template', 'pok/pok_list_realisasi');
    }
    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Pok_model->json();
    }
    public function json_realisasi()
    {
        header('Content-Type: application/json');
        echo $this->Pok_model->json_realisasi();
    }
	public function realisasi_kegiatan($id)
    {
        $row = $this->Pok_model->read($id);
		//$this->output->enable_profiler(TRUE);
        if ($row) {
            $data = array(
                'tahun_anggaran' => $row->tahun_anggaran,
                'nama_satker' => $row->nama_satker,
                'pagu' => $row->total,
            );
        } else {
            $data = array(
                'tahun_anggaran' => $this->session->userdata('ta'),
                'nama_satker' => $this->session->userdata('nama_satker'),
                'pagu' => '0',
            );
        }
        $this->template->load('template', 'pok/pok_realisasi_kegiatan', $data);
    }
    public function read($id)
    {
        $row = $this->Pok_model->read($id);
		//$this->output->enable_profiler(TRUE);
        if ($row) {
            $data = array(
                'tahun_anggaran' => $row->tahun_anggaran,
                'nama_satker' => $row->nama_satker,
                'pagu' => $row->total,
            );
        } else {
            $data = array(
                'tahun_anggaran' => $this->session->userdata('ta'),
                'nama_satker' => $this->session->userdata('nama_satker'),
                'pagu' => '0',
            );
        }
        $this->template->load('template', 'pok/pok_read', $data);
    }
   public function pok_data_realisasi($id)
    {
        $row = $this->Pok_model->pok_data($id);
	//	$this->output->enable_profiler(TRUE);
        $data = array(
            'kode_dept' => $row->kode_dept,
            'kode_unit_kerja' => $row->kode_unit_kerja,
            'kode_program' => $row->kode_program,
            'tahun_anggaran' => $row->tahun_anggaran,
            'kode_satker' => $row->kode_satker,
        );
        $this->load->view('pok/pok_data_realisasi', $data);
    }
    public function pok_data($id)
    {
        $row = $this->Pok_model->pok_data($id);
		//$this->output->enable_profiler(TRUE);
        $data = array(
            'kode_dept' => $row->kode_dept,
            'kode_unit_kerja' => $row->kode_unit_kerja,
            'kode_program' => $row->kode_program,
            'tahun_anggaran' => $row->tahun_anggaran,
            'kode_satker' => $row->kode_satker,
        );
        $this->load->view('pok/pok_data', $data);
    }

    function hapus_program()
    {
        $this->db->where('id_program', $this->input->post('id'));
        $this->db->delete('t_program');
    }

    function tambah_kegiatan()
    {
        $row = $this->Pok_model->cek_kegiatan($this->input->post('kode_kegiatan'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $arr_program = array(
                'nama_program' => $row->nama_program,
            );

            $program = array_merge($arr, $arr_program);
            $this->db->insert('t_program', $program);

            $arr_kegiatan = array(
                'kode_kegiatan' => $row->kode_kegiatan,
                'nama_kegiatan' => $row->nama_kegiatan,
            );
            $arr_merger = array_merge($arr, $arr_kegiatan);
            $this->db->insert('t_kegiatan', $arr_merger);
            if ($this->input->post('new') == 'Y') {
                redirect(site_url('pok'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }


    function hapus_kegiatan()
    {
        $this->db->where('id_kegiatan', $this->input->post('id'));
        $this->db->delete('t_kegiatan');
    }

    function get_kro()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $data = array(
            'pok' => $this->input->post('pok'),
            'dt_kro' => $this->Pok_model->get_kro($kode_dept, $kode_unit_kerja, $kode_kegiatan),
        );
        $this->load->view('pok/pok_modal_kro', $data);
    }

    function tambah_kro()
    {
        $row = $this->Pok_model->cek_kro($this->input->post('id_kro'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'nama_kro' => $row->nama_kro,
                'volume' => $this->input->post('volume'),
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_output', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function hapus_kro()
    {
        $this->db->where('id_kro', $this->input->post('id'));
        $this->db->delete('t_output');
    }

    function get_ro()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $data = array(
            'pok' => $this->input->post('pok'),
            'dt_ro' => $this->Pok_model->get_ro($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro),
        );
        $this->load->view('pok/pok_modal_ro', $data);
    }

    function tambah_ro()
    {
        $row = $this->Pok_model->cek_ro($this->input->post('id_ro'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'kode_ro' => $row->kode_ro,
                'nama_ro' => $row->nama_ro,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_output_sub', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function hapus_ro()
    {
        $this->db->where('id_ro', $this->input->post('id'));
        $this->db->delete('t_output_sub');
    }

    function get_komponen()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $data = array(
            'pok' => $this->input->post('pok'),
            'dt_komponen' => $this->Pok_model->get_komponen($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro),
        );
        $this->load->view('pok/pok_modal_komponen', $data);
    }

    function tambah_komponen()
    {
        $row = $this->Pok_model->cek_komponen($this->input->post('id_komponen'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'kode_ro' => $row->kode_ro,
                'kode_komponen' => $row->kode_komponen,
                'nama_komponen' => $row->nama_komponen,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_komponen', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function hapus_komponen()
    {
        $this->db->where('id_komponen', $this->input->post('id'));
        $this->db->delete('t_komponen');
    }

    function get_komponen_sub()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $data = array(
            'pok' => $this->input->post('pok'),
            'dt_komponen_sub' => $this->Pok_model->get_komponen_sub($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen),
        );
        $this->load->view('pok/pok_modal_komponen_sub', $data);
    }

    function tambah_komponen_sub()
    {
        $row = $this->Pok_model->cek_komponen_sub($this->input->post('id_komponen_sub'));
        if ($row) {
            $arr = array(
                'kode_dept' => $row->kode_dept,
                'kode_unit_kerja' => $row->kode_unit_kerja,
                'kode_program' => $row->kode_program,
                'kode_kegiatan' => $row->kode_kegiatan,
                'kode_kro' => $row->kode_kro,
                'kode_ro' => $row->kode_ro,
                'kode_komponen' => $row->kode_komponen,
                'kode_komponen_sub' => $row->kode_komponen_sub,
                'nama_komponen_sub' => $row->nama_komponen_sub,
                'tahun_anggaran' => $this->session->userdata('ta'),
                'kode_satker' => $this->session->userdata('kode_satker'),
                'create_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('t_komponen_sub', $arr);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </button><strong> Record Not Found</strong></div>');
            redirect(site_url('pok'));
        }
    }

    function hapus_komponensub()
    {
        $this->db->where('id_komponen_sub', $this->input->post('id'));
        $this->db->delete('t_komponen_sub');
    }

    function get_akun()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $kode_komponen_sub = $this->input->post('kode_komponen_sub');
        $data = array(
            'pok' => $this->input->post('pok'),
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'dt_akun' => $this->Pok_model->get_akun($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen, $kode_komponen_sub),
        );
        $this->load->view('pok/pok_modal_akun', $data);
    }

    function tambah_akun()
    {
        $str_akun = $this->input->post('akun');
        $akun = explode('|', $str_akun);
        $arr = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'kode_akun' => $akun['0'],
            'nama_akun' => $akun['1'],
            'tahun_anggaran' => $this->session->userdata('ta'),
            'kode_satker' => $this->session->userdata('kode_satker'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_akun', $arr);
    }

    function hapus_akun()
    {
        $this->db->where('id_akun', $this->input->post('id'));
        $this->db->delete('t_akun');
    }

    function get_item()
    {
        $kode_dept = $this->input->post('kode_dept');
        $kode_unit_kerja = $this->input->post('kode_unit_kerja');
        $kode_program = $this->input->post('kode_program');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $kode_komponen_sub = $this->input->post('kode_komponen_sub');
        $kode_akun = $this->input->post('kode_akun');
        $data = array(
            'pok' => $this->input->post('pok'),
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'kode_akun' => $this->input->post('kode_akun'),
            'dt_item_head' => $this->Pok_model->get_item_head($kode_dept, $kode_unit_kerja, $kode_program, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen, $kode_komponen_sub, $kode_akun),
        );
        $this->load->view('pok/pok_modal_item', $data);
    }

    function tambah_item()
    {
        if ($this->input->post('item_title') == '0') {
            $item_title = $this->input->post('item_title_baru');
        } else {
            $item_title = $this->input->post('item_title');
        }
        $arr = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'kode_akun' => $this->input->post('kode_akun'),
            'item_title' => $item_title,
            'item' => $this->input->post('item'),
            'volume' => $this->input->post('volume'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'jumlah' => $this->input->post('total'),
            'tahun_anggaran' => $this->session->userdata('ta'),
            'kode_satker' => $this->session->userdata('kode_satker'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_item', $arr);
    }

    function get_item_update()
    {
        $row = $this->Pok_model->get_item_id($this->input->post('id'));
        $data = array(
            'pok' => $this->input->post('pok'),
            'id_item' => $row->id_item,
            'item_title' => $row->item_title,
            'item' => $row->item,
            'volume' => $row->volume,
            'satuan' => $row->satuan,
            'harga_satuan' => $row->harga_satuan,
            'jumlah' => $row->jumlah,
        );
        $this->load->view('pok/pok_modal_item_edit', $data);
    }
	function get_realisasi()
    {
        $row = $this->Pok_model->get_item_id($this->input->post('id'));
        $real = $this->Pok_model->get_real_item_id($this->input->post('id'));
        $data = array(
            'pok' => $this->input->post('pok'),
            'item' => $row->item,
            'id_item' => $row->id_item,
            'jumlah' => $row->jumlah,
            'januari' => $row->januari,
            'februari' => $row->februari,
            'maret' => $row->maret,
            'april' => $row->april,
            'mei' => $row->mei,
            'juni' => $row->juni,
            'juli' => $row->juli,
            'agustus' => $row->agustus,
            'september' => $row->september,
            'oktober' => $row->oktober,
            'november' => $row->november,
            'desember' => $row->desember,
			'ang_januari' => isset($real->ang_januari) ? $real->ang_januari : 0,
            'ang_februari' => isset($real->ang_februari) ? $real->ang_februari : 0,
            'ang_maret' => isset($real->ang_maret) ? $real->ang_maret : 0,
            'ang_april' => isset($real->ang_april) ? $real->ang_april : 0,
            'ang_mei' => isset($real->ang_mei) ? $real->ang_mei : 0,
            'ang_juni' => isset($real->ang_juni) ? $real->ang_juni : 0,
            'ang_juli' => isset($real->ang_juli) ? $real->ang_juli : 0,
            'ang_agustus' => isset($real->ang_agustus) ? $real->ang_agustus : 0,
            'ang_september' => isset($real->ang_september) ? $real->ang_september : 0,
            'ang_oktober' => isset($real->ang_oktober) ? $real->ang_oktober : 0,
            'ang_november' => isset($real->ang_november) ? $real->ang_november : 0,
            'ang_desember' => isset($real->ang_desember) ? $real->ang_desember : 0,
			'fisik_januari' => isset($real->fisik_januari) ? $real->fisik_januari : 0,
            'fisik_februari' => isset($real->fisik_februari) ? $real->fisik_februari : 0,
            'fisik_maret' => isset($real->fisik_maret) ? $real->fisik_maret : 0,
            'fisik_april' => isset($real->fisik_april) ? $real->fisik_april : 0,
            'fisik_mei' => isset($real->fisik_mei) ? $real->fisik_mei : 0,
            'fisik_juni' => isset($real->fisik_juni) ? $real->fisik_juni : 0,
            'fisik_juli' => isset($real->fisik_juli) ? $real->fisik_juli : 0,
            'fisik_agustus' => isset($real->fisik_agustus) ? $real->fisik_agustus : 0,
            'fisik_september' => isset($real->fisik_september) ? $real->fisik_september : 0,
            'fisik_oktober' => isset($real->fisik_oktober) ? $real->fisik_oktober : 0,
            'fisik_november' => isset($real->fisik_november) ? $real->fisik_november : 0,
            'fisik_desember' => isset($real->fisik_desember) ? $real->fisik_desember : 0,
        );
        $this->load->view('pok/pok_modal_item_realisasi', $data);
    }
    function get_penarikan()
    {
        $row = $this->Pok_model->get_item_id($this->input->post('id'));
        $data = array(
            'pok' => $this->input->post('pok'),
            'id_item' => $row->id_item,
            'jumlah' => $row->jumlah,
            'januari' => $row->januari,
            'februari' => $row->februari,
            'maret' => $row->maret,
            'april' => $row->april,
            'mei' => $row->mei,
            'juni' => $row->juni,
            'juli' => $row->juli,
            'agustus' => $row->agustus,
            'september' => $row->september,
            'oktober' => $row->oktober,
            'november' => $row->november,
            'desember' => $row->desember,
        );
        $this->load->view('pok/pok_modal_item_penarikan', $data);
    }

    function update_item()
    {
        $arr = array(
            'item' => $this->input->post('item'),
            'volume' => $this->input->post('volume'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'jumlah' => $this->input->post('total'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->where('id_item', $this->input->post('id_item'));
        $this->db->update('t_item', $arr);
    }

    function update_penarikan()
    {
        $arr = array(
            'januari' => $this->input->post('januari'),
            'februari' => $this->input->post('februari'),
            'maret' => $this->input->post('maret'),
            'april' => $this->input->post('april'),
            'mei' => $this->input->post('mei'),
            'juni' => $this->input->post('juni'),
            'juli' => $this->input->post('juli'),
            'agustus' => $this->input->post('agustus'),
            'september' => $this->input->post('september'),
            'oktober' => $this->input->post('oktober'),
            'november' => $this->input->post('november'),
            'desember' => $this->input->post('desember'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->where('id_item', $this->input->post('id_item'));
        $this->db->update('t_item', $arr);
    }
	function update_realisasi()
    {
		$row = $this->Pok_model->get_real_item_id($this->input->post('id_item'));
		if(!empty($row))
		{
			$arr = array(
				'ang_januari' => $this->input->post('anggaran_jan'),
				'ang_februari' => $this->input->post('anggaran_feb'),
				'ang_maret' => $this->input->post('anggaran_mar'),
				'ang_april' => $this->input->post('anggaran_apr'),
				'ang_mei' => $this->input->post('anggaran_mei'),
				'ang_juni' => $this->input->post('anggaran_jun'),
				'ang_juli' => $this->input->post('anggaran_jul'),
				'ang_agustus' => $this->input->post('anggaran_agu'),
				'ang_september' => $this->input->post('anggaran_sep'),
				'ang_oktober' => $this->input->post('anggaran_okt'),
				'ang_november' => $this->input->post('anggaran_nov'),
				'ang_desember' => $this->input->post('anggaran_des'),
				'fisik_januari' => $this->input->post('fisik_jan'),
				'fisik_februari' => $this->input->post('fisik_feb'),
				'fisik_maret' => $this->input->post('fisik_mar'),
				'fisik_april' => $this->input->post('fisik_apr'),
				'fisik_mei' => $this->input->post('fisik_mei'),
				'fisik_juni' => $this->input->post('fisik_jun'),
				'fisik_juli' => $this->input->post('fisik_jul'),
				'fisik_agustus' => $this->input->post('fisik_agu'),
				'fisik_september' => $this->input->post('fisik_sep'),
				'fisik_oktober' => $this->input->post('fisik_okt'),
				'fisik_november' => $this->input->post('fisik_nov'),
				'fisik_desember' => $this->input->post('fisik_des'),
				'update_date' => date('Y-m-d H:i:s'),
			);
			$this->db->where('id_item', $this->input->post('id_item'));
			$this->db->update('t_item_realisasi', $arr);
		}else{
			$arr = array(
				'id_item' => $this->input->post('id_item'),
				'ang_januari' => $this->input->post('anggaran_jan'),
				'ang_februari' => $this->input->post('anggaran_feb'),
				'ang_maret' => $this->input->post('anggaran_mar'),
				'ang_april' => $this->input->post('anggaran_apr'),
				'ang_mei' => $this->input->post('anggaran_mei'),
				'ang_juni' => $this->input->post('anggaran_jun'),
				'ang_juli' => $this->input->post('anggaran_jul'),
				'ang_agustus' => $this->input->post('anggaran_agu'),
				'ang_september' => $this->input->post('anggaran_sep'),
				'ang_oktober' => $this->input->post('anggaran_okt'),
				'ang_november' => $this->input->post('anggaran_nov'),
				'ang_desember' => $this->input->post('anggaran_des'),
				'fisik_januari' => $this->input->post('fisik_jan'),
				'fisik_februari' => $this->input->post('fisik_feb'),
				'fisik_maret' => $this->input->post('fisik_mar'),
				'fisik_april' => $this->input->post('fisik_apr'),
				'fisik_mei' => $this->input->post('fisik_mei'),
				'fisik_juni' => $this->input->post('fisik_jun'),
				'fisik_juli' => $this->input->post('fisik_jul'),
				'fisik_agustus' => $this->input->post('fisik_agu'),
				'fisik_september' => $this->input->post('fisik_sep'),
				'fisik_oktober' => $this->input->post('fisik_okt'),
				'fisik_november' => $this->input->post('fisik_nov'),
				'fisik_desember' => $this->input->post('fisik_des'),
				'update_date' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('t_item_realisasi', $arr);
			
			
		}
    }

    function hapus_item()
    {
        $this->db->where('id_item', $this->input->post('id'));
        $this->db->delete('t_item');
    }
}

/* End of file Pok.php */
/* Location: ./application/controllers/Pok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-19 05:11:13 */
/* http://harviacode.com */