<?php

if (!defined('BASEPATH'))
    //exit('No direct script access allowed');

class Api_sakti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pok_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
		$this->load->helper("api_sakti_helper");
    }
	public function index()
    {
        $this->template->load('template', 'pok/pok_list');
    }
	public function get_token()
    {
         $get=create_token();
		 var_dump($get);
    }



}
?>