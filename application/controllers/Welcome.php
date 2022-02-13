<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Welcome_model');
    }
    public function index()
    {
        $data['ttl_risk'] = $this->Welcome_model->ttl_risk();
        $data['peta_risk'] = $this->Welcome_model->peta_risk();
        $this->template->load('template', 'welcome', $data);
    }
}
