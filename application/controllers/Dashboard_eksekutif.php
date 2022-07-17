<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_eksekutif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_eksekutif_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $bmkg = $this->Dashboard_eksekutif_model->real_bmkg();
        $dukman = $this->Dashboard_eksekutif_model->real_dukman();
        $pmkg = $this->Dashboard_eksekutif_model->real_pmkg();
        $data = array(
            'bmkg_pagu' => $bmkg->pagu,
            'bmkg_realisasi' => $bmkg->realisasi,
            'bmkg_persen' => $bmkg->persen,
            'dukman_pagu' => $dukman->pagu,
            'dukman_realisasi' => $dukman->realisasi,
            'dukman_persen' => $dukman->persen,
            'pmkg_pagu' => $pmkg->pagu,
            'pmkg_realisasi' => $pmkg->realisasi,
            'pmkg_persen' => $pmkg->persen,
            'real_bulanan' => $this->Dashboard_eksekutif_model->real_bulanan(),
            'real_kegiatan' => $this->Dashboard_eksekutif_model->real_kegiatan(),
            'sumber_dana' => $this->Dashboard_eksekutif_model->sumber_dana(),
            'satker' => $this->Dashboard_eksekutif_model->satker(),
            'kegiatan' => $this->Dashboard_eksekutif_model->kegiatan(),
        );
        $this->load->view('dashboard_eksekutif', $data);
    }

    public function omspan()
    {
        $bmkg = $this->Dashboard_eksekutif_model->real_bmkg_omspan();
        $dukman = $this->Dashboard_eksekutif_model->real_dukman_omspan();
        $pmkg = $this->Dashboard_eksekutif_model->real_pmkg_omspan();
        $data = array(
            'bmkg_pagu' => $bmkg->pagu,
            'bmkg_realisasi' => $bmkg->realisasi,
            'bmkg_persen' => $bmkg->persen,
            'dukman_pagu' => $dukman->pagu,
            'dukman_realisasi' => $dukman->realisasi,
            'dukman_persen' => $dukman->persen,
            'pmkg_pagu' => $pmkg->pagu,
            'pmkg_realisasi' => $pmkg->realisasi,
            'pmkg_persen' => $pmkg->persen,
            'real_bulanan' => $this->Dashboard_eksekutif_model->real_bulanan_omspan(),
            'real_kegiatan' => $this->Dashboard_eksekutif_model->real_kegiatan_omspan(),
            'sumber_dana' => $this->Dashboard_eksekutif_model->sumber_dana_omspan(),
            'satker' => $this->Dashboard_eksekutif_model->satker_omspan(),
            'kegiatan' => $this->Dashboard_eksekutif_model->kegiatan_omspan(),
        );
        $this->load->view('dashboard_eksekutif_omspan', $data);
    }
}
