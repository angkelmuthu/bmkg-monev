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
        $data['monitoring'] = $this->Monitoring_model->monitoring($ta, $lokasi);
        $this->template->load('template', 'monitoring', $data);
    }
}
