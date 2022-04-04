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
    public function laporan_bulanan()
    {
        $data = array(
            'kode_unit_kerja' => $this->session->userdata('kode_satker'),
        );
        $this->template->load('template', 'pok/laporan_bulanan', $data);
    }



    public function rekap_pertahun()
    {
        $data = array(
            'kode_unit_kerja' => $this->session->userdata('kode_satker'),
        );
        $this->template->load('template', 'pok/rekap_pertahun', $data);
    }
    public function rekap_bulanan()
    {
        $data = array(
            'kode_unit_kerja' => $this->session->userdata('kode_satker'),
        );
        $this->template->load('template', 'pok/rekap_bulanan', $data);
    }
    public function view_laporan_bulanan($satker, $tahun, $bulan)
    {
        //$this->output->enable_profiler(TRUE);

        $row = $this->Pok_model->get_status_kirim_grup($satker,$tahun,$bulan);
        $rowlast = $this->Pok_model->get_status_kirim($satker,$tahun,$bulan);
		if(!empty($row))
		{
			$get=$row->status;
		}else{
			$get="";
		}
		if(!empty($rowlast))
		{
			$getlast=$rowlast->status;
			$getketerangan=$rowlast->keterangan;
		}else{
			$getketerangan="";
			$getlast="";
		}
		


        $data = array(
            'bulan' => $bulan,
            'tahun_anggaran' => $tahun,
            'kode_satker' => $satker,
            'row' => $get,
            'rowlast' => $getlast,
            'getketerangan' => $getketerangan,
        );
        $this->template->load('template', 'pok/view_laporan_bulanan', $data);
    }
    public function get_laporan_bulanan($satker, $tahun, $bulan)
    {

        
		 $row = $this->Pok_model->get_status_kirim_grup($satker,$tahun,$bulan);
        $rowlast = $this->Pok_model->get_status_kirim($satker,$tahun,$bulan);
		if(!empty($row))
		{
			$get=$row->status;
		}else{
			$get="";
		}
		if(!empty($rowlast))
		{
			$getlast=$rowlast->status;
			$getketerangan=$rowlast->keterangan;
		}else{
			$getketerangan="";
			$getlast="";
		}
		

        $data = array(
            'bulan' => $bulan,
            'tahun_anggaran' => $tahun,
            'kode_satker' => $satker,
            'row' => $get,
            'rowlast' => $getlast,
            'getketerangan' => $getketerangan,
        );
        $this->load->view('pok/get_laporan_bulanan', $data);
    }

    public function get_rekap_bulanan($tahun, $bulan)
    {
        //$this->output->enable_profiler(TRUE);
        $data = array(
            'bulan' => $bulan,
            'tahun_anggaran' => $tahun,
        );
        $this->load->view('pok/get_rekap_bulanan', $data);
    }

    public function get_rekap_tahunan($tahun)
    {
        //$this->output->enable_profiler(TRUE);
        $data = array(
            'tahun_anggaran' => $tahun,
        );
        $this->load->view('pok/get_rekap_tahunan', $data);
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
                'kode_lokasi' => $this->input->post('kode_lokasi'),
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
        $kode_program = $this->input->post('kode_program');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $kode_kro = $this->input->post('kode_kro');
        $kode_ro = $this->input->post('kode_ro');
        $kode_komponen = $this->input->post('kode_komponen');
        $data = array(
            'pok' => $this->input->post('pok'),
            'kode_dept' => $kode_dept,
            'kode_unit_kerja' => $kode_unit_kerja,
            'kode_program' => $kode_program,
            'kode_kegiatan' => $kode_kegiatan,
            'kode_kro' => $kode_kro,
            'kode_ro' => $kode_ro,
            'kode_komponen' => $kode_komponen,
            'dt_komponen_sub' => $this->Pok_model->get_komponen_sub($kode_dept, $kode_unit_kerja, $kode_kegiatan, $kode_kro, $kode_ro, $kode_komponen),
        );
        $this->load->view('pok/pok_modal_komponen_sub', $data);
    }

    function tambah_komponen_sub()
    {
        //$row = $this->Pok_model->cek_komponen_sub($this->input->post('id_komponen_sub'));
        //if ($row) {
        $arr = array(
            'kode_dept' => $this->input->post('kode_dept'),
            'kode_unit_kerja' => $this->input->post('kode_unit_kerja'),
            'kode_program' => $this->input->post('kode_program'),
            'kode_kegiatan' => $this->input->post('kode_kegiatan'),
            'kode_kro' => $this->input->post('kode_kro'),
            'kode_ro' => $this->input->post('kode_ro'),
            'kode_komponen' => $this->input->post('kode_komponen'),
            'kode_komponen_sub' => $this->input->post('kode_komponen_sub'),
            'nama_komponen_sub' => $this->input->post('nama_komponen_sub'),
            'tahun_anggaran' => $this->session->userdata('ta'),
            'kode_satker' => $this->session->userdata('kode_satker'),
            'create_date' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('t_komponen_sub', $arr);
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true"><i class="fal fa-times"></i></span>
        // </button><strong> Record Not Found</strong></div>');
        //     redirect(site_url('pok'));
        // }
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
            'satuan' => $this->input->post('satuan'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'jumlah' => $this->input->post('total'),
            'is_swakelola' => $this->input->post('is_swakelola'),
            'kode_blokir' => $this->input->post('kode_blokir'),
            'jumlah_blokir' => $this->input->post('jumlah_blokir'),
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
            'is_swakelola' => $row->is_swakelola,
            'kode_blokir' => $row->kode_blokir,
            'jumlah_blokir' => $row->jumlah_blokir,
        );
        $this->load->view('pok/pok_modal_item_edit', $data);
    }
    function get_realisasi()
    {
        $row = $this->Pok_model->get_item_id($this->input->post('id'));
        $real = $this->Pok_model->get_real_item_id($this->input->post('id'));

		for ($x = 0; $x <= 12; $x++) {
			$get = $this->Pok_model->get_kirim($_POST['satker'],$_POST['program'],$_POST['tahun'],$x);
			if(!empty($get)){
				if($get->status=='Revisi')
				{
					$bulan[]="";
				}else{
					$bulan[]=isset($get->bulan) ? $get->bulan : "";
				}
			}else{
				$bulan[]="";
			}
		}

        $getjan = json_decode(isset($real->ket_kontrak_januari) ? $real->ket_kontrak_januari : "");
        $getfeb = json_decode(isset($real->ket_kontrak_februari) ? $real->ket_kontrak_januari : "");
        $getmar = json_decode(isset($real->ket_kontrak_maret) ? $real->ket_kontrak_maret : "");
        $getapr = json_decode(isset($real->ket_kontrak_april) ? $real->ket_kontrak_april : "");
        $getmei = json_decode(isset($real->ket_kontrak_mei) ? $real->ket_kontrak_mei : "");
        $getjun = json_decode(isset($real->ket_kontrak_juni) ? $real->ket_kontrak_juni : "");
        $getjul = json_decode(isset($real->ket_kontrak_juli) ? $real->ket_kontrak_juli : "");
        $getagu = json_decode(isset($real->ket_kontrak_agustus) ? $real->ket_kontrak_agustus : "");
        $getsep = json_decode(isset($real->ket_kontrak_september) ? $real->ket_kontrak_september : "");
        $getokt = json_decode(isset($real->ket_kontrak_oktober) ? $real->ket_kontrak_oktober : "");
        $getnov = json_decode(isset($real->ket_kontrak_november) ? $real->ket_kontrak_november : "");
        $getdes = json_decode(isset($real->ket_kontrak_desember) ? $real->ket_kontrak_desember : "");
        $data = array(
            'bulan' => $bulan,
            'pok' => $this->input->post('pok'),
            'item' => isset($row->item) ? $row->item : "",
            'id_item' => isset($row->id_item) ? $row->id_item : "",
            'jumlah' => isset($row->jumlah) ? $row->jumlah : "",
            'januari' => isset($row->januari) ? $row->januari : "0",
            'februari' => isset($row->februari) ? $row->februari : "0",
            'maret' => isset($row->maret) ? $row->maret : "0",
            'april' => isset($row->april) ? $row->april : "0",
            'mei' => isset($row->mei) ? $row->mei : "0",
            'juni' => isset($row->juni) ? $row->juni : "0",
            'juli' => isset($row->juli) ? $row->juli : "0",
            'agustus' => isset($row->agustus) ? $row->agustus : "0",
            'september' => isset($row->september) ? $row->september : "0",
            'oktober' => isset($row->oktober) ? $row->oktober : "0",
            'november' => isset($row->november) ? $row->november : "0",
            'desember' => isset($row->desember) ? $row->desember : "0",
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
            'nominal_kontrak_januari' => isset($real->nominal_kontrak_januari) ? $real->nominal_kontrak_januari : 0,
            'nominal_kontrak_februari' => isset($real->nominal_kontrak_februari) ? $real->nominal_kontrak_februari : 0,
            'nominal_kontrak_maret' => isset($real->nominal_kontrak_maret) ? $real->nominal_kontrak_maret : 0,
            'nominal_kontrak_april' => isset($real->nominal_kontrak_april) ? $real->nominal_kontrak_april : 0,
            'nominal_kontrak_mei' => isset($real->nominal_kontrak_mei) ? $real->nominal_kontrak_mei : 0,
            'nominal_kontrak_juni' => isset($real->nominal_kontrak_juni) ? $real->nominal_kontrak_juni : 0,
            'nominal_kontrak_juli' => isset($real->nominal_kontrak_juli) ? $real->nominal_kontrak_juli : 0,
            'nominal_kontrak_agustus' => isset($real->nominal_kontrak_agustus) ? $real->nominal_kontrak_agustus : 0,
            'nominal_kontrak_september' => isset($real->nominal_kontrak_september) ? $real->nominal_kontrak_september : 0,
            'nominal_kontrak_oktober' => isset($real->nominal_kontrak_oktober) ? $real->nominal_kontrak_oktober : 0,
            'nominal_kontrak_november' => isset($real->nominal_kontrak_november) ? $real->nominal_kontrak_november : 0,
            'nominal_kontrak_desember' => isset($real->nominal_kontrak_desember) ? $real->nominal_kontrak_desember : 0,
            'nomor_januari' => isset($getjan->nomor) ? $getjan->nomor : '',
            'nomor_februari' => isset($getfeb->nomor) ? $getfeb->nomor : '',
            'nomor_maret' => isset($getmar->nomor) ? $getmar->nomor : '',
            'nomor_april' => isset($getapr->nomor) ? $getapr->nomor : '',
            'nomor_mei' => isset($getmei->nomor) ? $getmei->nomor : '',
            'nomor_juni' => isset($getjun->nomor) ? $getjun->nomor : '',
            'nomor_juli' => isset($getjul->nomor) ? $getjul->nomor : '',
            'nomor_agustus' => isset($getagu->nomor) ? $getagu->nomor : '',
            'nomor_september' => isset($getsep->nomor) ? $getsep->nomor : '',
            'nomor_oktober' => isset($getokt->nomor) ? $getokt->nomor : '',
            'nomor_november' => isset($getnov->nomor) ? $getnov->nomor : '',
            'nomor_desember' => isset($getdes->nomor) ? $getdes->nomor : '',
            'tgl_januari' => isset($getjan->tanggal) ? $getjan->tanggal : '',
            'tgl_februari' => isset($getfeb->tanggal) ? $getfeb->tanggal : '',
            'tgl_maret' => isset($getmar->tanggal) ? $getmar->tanggal : '',
            'tgl_april' => isset($getapr->tanggal) ? $getapr->tanggal : '',
            'tgl_mei' => isset($getmei->tanggal) ? $getmei->tanggal : '',
            'tgl_juni' => isset($getjun->tanggal) ? $getjun->tanggal : '',
            'tgl_juli' => isset($getjul->tanggal) ? $getjul->tanggal : '',
            'tgl_agustus' => isset($getagu->tanggal) ? $getagu->tanggal : '',
            'tgl_september' => isset($getsep->tanggal) ? $getsep->tanggal : '',
            'tgl_oktober' => isset($getokt->tanggal) ? $getokt->tanggal : '',
            'tgl_november' => isset($getnov->tanggal) ? $getnov->tanggal : '',
            'tgl_desember' => isset($getdes->tanggal) ? $getdes->tanggal : '',
            'ket_januari' => isset($getjan->ket) ? $getjan->ket : '',
            'ket_februari' => isset($getfeb->ket) ? $getfeb->ket : '',
            'ket_maret' => isset($getmar->ket) ? $getmar->ket : '',
            'ket_april' => isset($getapr->ket) ? $getapr->ket : '',
            'ket_mei' => isset($getmei->ket) ? $getmei->ket : '',
            'ket_juni' => isset($getjun->ket) ? $getjun->ket : '',
            'ket_juli' => isset($getjul->ket) ? $getjul->ket : '',
            'ket_agustus' => isset($getagu->ket) ? $getagu->ket : '',
            'ket_september' => isset($getsep->ket) ? $getsep->ket : '',
            'ket_oktober' => isset($getokt->ket) ? $getokt->ket : '',
            'ket_november' => isset($getnov->ket) ? $getnov->ket : '',
            'ket_desember' => isset($getdes->ket) ? $getdes->ket : '',

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
            'satuan' => $this->input->post('satuan'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'jumlah' => $this->input->post('total'),
            'is_swakelola' => $this->input->post('is_swakelola'),
            'kode_blokir' => $this->input->post('kode_blokir'),
            'jumlah_blokir' => $this->input->post('jumlah_blokir'),
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

	function kirim_revisi()
    {
        $cek = $this->Pok_model->get_status_realisasi($_POST['satker'],$_POST['id'],$_POST['tahun'],$_POST['bulan']);
			//$this->output->enable_profiler(TRUE);
        $row = $this->Pok_model->get_kirim($_POST['satker'],$_POST['id'],$_POST['tahun'],$_POST['bulan']);
		if (!empty($cek)) {
			if (!empty($row)) {
				$arr = array(
				 'flag' => 0,
				);
				$this->db->where('kode_satker', $_POST['satker']);
				$this->db->where('id_program', $_POST['id']);
				$this->db->where('tahun', $_POST['tahun']);
				$this->db->where('bulan', $_POST['bulan']);
				$this->db->update('t_status_kirim', $arr);
				
			}
				$arr_insert = array(
				 'kode_satker' => $_POST['satker'],
				 'id_program' => $_POST['id'],
				 'tahun' => $_POST['tahun'],
				 'bulan' => $_POST['bulan'],
				 'status' => $_POST['status'],
				 'keterangan' =>  $_POST['ket'],
				 'tgl_kirim' =>  date('Y-m-d H:i:s'),
				 'id_user' => $this->session->userdata('kode_satker'),
				 'flag' => 1,
				);
				$simpan=$this->db->insert('t_status_kirim', $arr_insert);
				if($simpan)
				{
					echo "{'kode':'200','msg':'Realisasi berhasil ".$_POST['status']."'}";
				}else{
					echo "{'kode':'201','msg':'Realisasi gagal ".$_POST['status']."'}";
				}
		}else{
			echo '{"kode":"201","msg":"Tidak dapat '.$_POST['status'].', anda belum menginput realisasi"}';
			
		}
		
    }
	function kirim_realisasi()
    {
        $cek = $this->Pok_model->get_status_realisasi($_POST['satker'],$_POST['id'],$_POST['tahun'],$_POST['bulan']);
			//$this->output->enable_profiler(TRUE);
        $row = $this->Pok_model->get_kirim($_POST['satker'],$_POST['id'],$_POST['tahun'],$_POST['bulan']);
		if (!empty($cek)) {
			if (!empty($row)) {
				$arr = array(
				 'flag' => 0,
				);
				$this->db->where('kode_satker', $_POST['satker']);
				$this->db->where('id_program', $_POST['id']);
				$this->db->where('tahun', $_POST['tahun']);
				$this->db->where('bulan', $_POST['bulan']);
				$this->db->update('t_status_kirim', $arr);
				
			}
				$arr_insert = array(
				 'kode_satker' => $_POST['satker'],
				 'id_program' => $_POST['id'],
				 'tahun' => $_POST['tahun'],
				 'bulan' => $_POST['bulan'],
				 'status' => $_POST['status'],
				 'tgl_kirim' =>  date('Y-m-d H:i:s'),
				 'id_user' => $this->session->userdata('kode_satker'),
				 'flag' => 1,
				);
				$simpan=$this->db->insert('t_status_kirim', $arr_insert);
				if($simpan)
				{
					echo "{'kode':'200','msg':'Realisasi berhasil ".$_POST['status']."'}";
				}else{
					echo "{'kode':'201','msg':'Realisasi gagal ".$_POST['status']."'}";
				}
		}else{
			echo '{"kode":"201","msg":"Tidak dapat '.$_POST['status'].', anda belum menginput realisasi"}';
			
		}
		
    }		

    function update_realisasi()
    {
        $row = $this->Pok_model->get_real_item_id($this->input->post('id_item'));
        if (!empty($row)) {
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
                'nominal_kontrak_januari' => $this->input->post('nominal_kontrak_jan'),
                'nominal_kontrak_februari' => $this->input->post('nominal_kontrak_feb'),
                'nominal_kontrak_maret' => $this->input->post('nominal_kontrak_mar'),
                'nominal_kontrak_april' => $this->input->post('nominal_kontrak_apr'),
                'nominal_kontrak_mei' => $this->input->post('nominal_kontrak_mei'),
                'nominal_kontrak_juni' => $this->input->post('nominal_kontrak_jun'),
                'nominal_kontrak_juli' => $this->input->post('nominal_kontrak_jul'),
                'nominal_kontrak_agustus' => $this->input->post('nominal_kontrak_agu'),
                'nominal_kontrak_september' => $this->input->post('nominal_kontrak_sep'),
                'nominal_kontrak_oktober' => $this->input->post('nominal_kontrak_okt'),
                'nominal_kontrak_november' => $this->input->post('nominal_kontrak_nov'),
                'nominal_kontrak_desember' => $this->input->post('nominal_kontrak_des'),
                'ket_kontrak_januari' => '{"nomor":"' . $this->input->post('nomor_jan') . '","tanggal":"' . $this->input->post('tgl_jan') . '","ket":"' . $this->input->post('ket_jan') . '"}',
                'ket_kontrak_februari' => '{"nomor":"' . $this->input->post('nomor_feb') . '","tanggal":"' . $this->input->post('tgl_feb') . '","ket":"' . $this->input->post('ket_feb') . '"}',
                'ket_kontrak_maret' => '{"nomor":"' . $this->input->post('nomor_mar') . '","tanggal":"' . $this->input->post('tgl_mar') . '","ket":"' . $this->input->post('ket_mar') . '"}',
                'ket_kontrak_april' => '{"nomor":"' . $this->input->post('nomor_apr') . '","tanggal":"' . $this->input->post('tgl_apr') . '","ket":"' . $this->input->post('ket_apr') . '"}',
                'ket_kontrak_mei' => '{"nomor":"' . $this->input->post('nomor_mei') . '","tanggal":"' . $this->input->post('tgl_mei') . '","ket":"' . $this->input->post('ket_mei') . '"}',
                'ket_kontrak_juni' => '{"nomor":"' . $this->input->post('nomor_jun') . '","tanggal":"' . $this->input->post('tgl_jun') . '","ket":"' . $this->input->post('ket_jun') . '"}',
                'ket_kontrak_juli' => '{"nomor":"' . $this->input->post('nomor_jul') . '","tanggal":"' . $this->input->post('tgl_jul') . '","ket":"' . $this->input->post('ket_jul') . '"}',
                'ket_kontrak_agustus' => '{"nomor":"' . $this->input->post('nomor_agu') . '","tanggal":"' . $this->input->post('tgl_agu') . '","ket":"' . $this->input->post('ket_agu') . '"}',
                'ket_kontrak_september' => '{"nomor":"' . $this->input->post('nomor_sep') . '","tanggal":"' . $this->input->post('tgl_sep') . '","ket":"' . $this->input->post('ket_sep') . '"}',
                'ket_kontrak_oktober' => '{"nomor":"' . $this->input->post('nomor_okt') . '","tanggal":"' . $this->input->post('tgl_okt') . '","ket":"' . $this->input->post('ket_okt') . '"}',
                'ket_kontrak_november' => '{"nomor":"' . $this->input->post('nomor_nov') . '","tanggal":"' . $this->input->post('tgl_nov') . '","ket":"' . $this->input->post('ket_nov') . '"}',
                'ket_kontrak_desember' => '{"nomor":"' . $this->input->post('nomor_des') . '","tanggal":"' . $this->input->post('tgl_des') . '","ket":"' . $this->input->post('ket_des') . '"}',
                'update_date' => date('Y-m-d H:i:s'),
            );
            $this->db->where('id_item', $this->input->post('id_item'));
            $this->db->update('t_item_realisasi', $arr);
        } else {
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
                'nominal_kontrak_januari' => $this->input->post('nominal_kontrak_jan'),
                'nominal_kontrak_februari' => $this->input->post('nominal_kontrak_feb'),
                'nominal_kontrak_maret' => $this->input->post('nominal_kontrak_mar'),
                'nominal_kontrak_april' => $this->input->post('nominal_kontrak_apr'),
                'nominal_kontrak_mei' => $this->input->post('nominal_kontrak_mei'),
                'nominal_kontrak_juni' => $this->input->post('nominal_kontrak_jun'),
                'nominal_kontrak_juli' => $this->input->post('nominal_kontrak_jul'),
                'nominal_kontrak_agustus' => $this->input->post('nominal_kontrak_agu'),
                'nominal_kontrak_september' => $this->input->post('nominal_kontrak_sep'),
                'nominal_kontrak_oktober' => $this->input->post('nominal_kontrak_okt'),
                'nominal_kontrak_november' => $this->input->post('nominal_kontrak_nov'),
                'nominal_kontrak_desember' => $this->input->post('nominal_kontrak_des'),
                'ket_kontrak_januari' => '{"nomor":"' . $this->input->post('nomor_jan') . '","tanggal":"' . $this->input->post('tgl_jan') . '","ket":"' . $this->input->post('ket_jan') . '"}',
                'ket_kontrak_februari' => '{"nomor":"' . $this->input->post('nomor_feb') . '","tanggal":"' . $this->input->post('tgl_feb') . '","ket":"' . $this->input->post('ket_feb') . '"}',
                'ket_kontrak_maret' => '{"nomor":"' . $this->input->post('nomor_mar') . '","tanggal":"' . $this->input->post('tgl_mar') . '","ket":"' . $this->input->post('ket_mar') . '"}',
                'ket_kontrak_april' => '{"nomor":"' . $this->input->post('nomor_apr') . '","tanggal":"' . $this->input->post('tgl_apr') . '","ket":"' . $this->input->post('ket_apr') . '"}',
                'ket_kontrak_mei' => '{"nomor":"' . $this->input->post('nomor_mei') . '","tanggal":"' . $this->input->post('tgl_mei') . '","ket":"' . $this->input->post('ket_mei') . '"}',
                'ket_kontrak_juni' => '{"nomor":"' . $this->input->post('nomor_jun') . '","tanggal":"' . $this->input->post('tgl_jun') . '","ket":"' . $this->input->post('ket_jun') . '"}',
                'ket_kontrak_juli' => '{"nomor":"' . $this->input->post('nomor_jul') . '","tanggal":"' . $this->input->post('tgl_jul') . '","ket":"' . $this->input->post('ket_jul') . '"}',
                'ket_kontrak_agustus' => '{"nomor":"' . $this->input->post('nomor_agu') . '","tanggal":"' . $this->input->post('tgl_agu') . '","ket":"' . $this->input->post('ket_agu') . '"}',
                'ket_kontrak_september' => '{"nomor":"' . $this->input->post('nomor_sep') . '","tanggal":"' . $this->input->post('tgl_sep') . '","ket":"' . $this->input->post('ket_sep') . '"}',
                'ket_kontrak_oktober' => '{"nomor":"' . $this->input->post('nomor_okt') . '","tanggal":"' . $this->input->post('tgl_okt') . '","ket":"' . $this->input->post('ket_okt') . '"}',
                'ket_kontrak_november' => '{"nomor":"' . $this->input->post('nomor_nov') . '","tanggal":"' . $this->input->post('tgl_nov') . '","ket":"' . $this->input->post('ket_nov') . '"}',
                'ket_kontrak_desember' => '{"nomor":"' . $this->input->post('nomor_des') . '","tanggal":"' . $this->input->post('tgl_des') . '","ket":"' . $this->input->post('ket_des') . '"}',
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