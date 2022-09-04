<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Dashboard_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('id_user_level') == 1) {
            if (!empty($_GET['ta'])) {
                $ta = $_GET['ta'];
            } else {
                $ta = date('Y');
            }
            if (!empty($_GET['satker'])) {
                $satker = $_GET['satker'];
            } else {
                $satker = '';
            }
        } else {
            $ta = $this->session->userdata('ta');
            $satker = $this->session->userdata('kode_satker');
        }
        $pagu = $this->Dashboard_model->ttl_pagu($ta, $satker);
        $penarikan = $this->Dashboard_model->ttl_penarikan($ta, $satker);
        $realisasi_omspan = $this->Dashboard_model->realisasi_pagu_omspan($ta, $satker);
        $realisasi_inputan = $this->Dashboard_model->realisasi_pagu_inputan($ta, $satker);
        $realisasi_fisik = $this->Dashboard_model->realisasi_fisik($ta, $satker);
        $data = array(
            'pagu' => $pagu->pagu,
            'penarikan' => $penarikan->januari + $penarikan->februari + $penarikan->maret + $penarikan->april + $penarikan->mei + $penarikan->juni + $penarikan->juli + $penarikan->agustus + $penarikan->september + $penarikan->oktober + $penarikan->november + $penarikan->desember,
            'realisasi_pagu_omspan' => $realisasi_omspan->ang_januari + $realisasi_omspan->ang_februari + $realisasi_omspan->ang_maret + $realisasi_omspan->ang_april + $realisasi_omspan->ang_mei + $realisasi_omspan->ang_juni + $realisasi_omspan->ang_juli + $realisasi_omspan->ang_agustus + $realisasi_omspan->ang_september + $realisasi_omspan->ang_oktober + $realisasi_omspan->ang_november + $realisasi_omspan->ang_desember,
            'realisasi_pagu_inputan' => $realisasi_inputan->real_januari + $realisasi_inputan->real_februari + $realisasi_inputan->real_maret + $realisasi_inputan->real_april + $realisasi_inputan->real_mei + $realisasi_inputan->real_juni + $realisasi_inputan->real_juli + $realisasi_inputan->real_agustus + $realisasi_inputan->real_september + $realisasi_inputan->real_oktober + $realisasi_inputan->real_november + $realisasi_inputan->real_desember,
            'realisasi_fisik' => $realisasi_fisik->fisik_januari + $realisasi_fisik->fisik_februari + $realisasi_fisik->fisik_maret + $realisasi_fisik->fisik_april + $realisasi_fisik->fisik_mei + $realisasi_fisik->fisik_juni + $realisasi_fisik->fisik_juli + $realisasi_fisik->fisik_agustus + $realisasi_fisik->fisik_september + $realisasi_fisik->fisik_oktober + $realisasi_fisik->fisik_november + $realisasi_fisik->fisik_desember,
            'kegiatan' => $this->Dashboard_model->kegiatan($ta, $satker),
            'akun' => $this->Dashboard_model->akun($ta, $satker),
            'pagu_realisasi_kegiatan' => $this->Dashboard_model->pagu_realisasi_kegiatan($ta, $satker),
            'pagu_realisasi_kro' => $this->Dashboard_model->pagu_realisasi_kro($ta, $satker),
            //'pagu_realisasi_lokasi' => $this->Dashboard_model->pagu_realisasi_lokasi($ta, $satker),
            'pagu_realisasi_akun' => $this->Dashboard_model->pagu_realisasi_akun($ta, $satker),
            'pagu_realisasi_dana' => $this->Dashboard_model->pagu_realisasi_dana($ta, $satker),
            'pagu_realisasi_belanja' => $this->Dashboard_model->pagu_realisasi_belanja($ta, $satker),
            'pagu_realisasi_detail' => $this->Dashboard_model->pagu_realisasi_detail($ta, $satker),
        );
        $this->template->load('template', 'dashboard', $data);
    }

    public function esimon()
    {
        $this->template->load('template', 'dashboard_esimon');
    }
    // public function master_rs($id)
    // {
    //     $row2 = $this->Dashboard_model->get_master_rs($id);
    //     $masterrs = array(
    //         'masterrs' => $row2,
    //     );
    //     $this->template->load('template', 'dash_detail', $masterrs);
    // }
    // public function detail($id)
    // {
    //     $row = $this->Dashboard_model->get_kunjungan_day_by($id);
    //     $kjngn_day = array(
    //         'kjngn_day' => $row,
    //     );
    //     $this->template->load('template', 'dash_detail', $kjngn_day);
    // }
}
