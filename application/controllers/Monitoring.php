<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitoring extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Monitoring_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        if (!empty($_GET['ta'])) {
            $ta = $_GET['ta'];
        } else {
            $ta = date('Y');
        }
        if (!empty($_GET['lokasi'])) {
            $lokasi = $_GET['lokasi'];
        } else {
            $lokasi = '';
        }
        $pagu = $this->Monitoring_model->ttl_pagu($ta);
        $realisasi_inputan = $this->Monitoring_model->realisasi_pagu_inputan($ta);
        $data = array(
            'pagu' => $pagu->pagu,
            'realisasi_pagu_inputan' => $realisasi_inputan->real_januari + $realisasi_inputan->real_februari + $realisasi_inputan->real_maret + $realisasi_inputan->real_april + $realisasi_inputan->real_mei + $realisasi_inputan->real_juni + $realisasi_inputan->real_juli + $realisasi_inputan->real_agustus + $realisasi_inputan->real_september + $realisasi_inputan->real_oktober + $realisasi_inputan->real_november + $realisasi_inputan->real_desember,
            'monitoring' => $this->Monitoring_model->monitoring($ta, $lokasi),
        );
        $this->template->load('template', 'monitoring', $data);
    }

    public function status()
    {
        if (!empty($_GET['ta'])) {
            $ta = $_GET['ta'];
        } else {
            $ta = date('Y');
        }
        if (!empty($_GET['bulan'])) {
            $bulan = $_GET['bulan'];
        } else {
            $bulan = date('m');
        }
        $data['monitoring'] = $this->Monitoring_model->monitoring_status($ta, $bulan);
        $data['chart'] = $this->Monitoring_model->chart($ta, $bulan);
        $this->template->load('template', 'monitoring_status', $data);
    }

    public function new()
    {
        if (!empty($_POST['ta'])) {
            $ta = $_POST['ta'];
        } else {
            $ta = date('Y');
        }
        if (!empty($_POST['kode_balai'])) {
            $kode_balai = $_POST['kode_balai'];
        } else {
            $kode_balai = '';
        }
        if (!empty($_POST['kode_lokasi'])) {
            $kode_lokasi = $_POST['kode_lokasi'];
        } else {
            $kode_lokasi = '';
        }
        if (!empty($_POST['kode_satker'])) {
            $kode_satker = $_POST['kode_satker'];
        } else {
            $kode_satker = '';
        }
        $data['monitoring'] = $this->Monitoring_model->monitoring_new($ta, $kode_balai, $kode_lokasi, $kode_satker);
        $data['chart'] = $this->Monitoring_model->chart_new($ta, $kode_balai, $kode_lokasi, $kode_satker);
        $this->template->load('template', 'monitoring_new', $data);
    }
}
