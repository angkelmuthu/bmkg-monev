<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Akun_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }


    public function update()
    {
        $row = $this->Akun_model->get_by_id($this->session->userdata('id_users'));

        if ($row) {
            $data = array(
                'button'        => 'Update',
                'action'        => site_url('akun/update_action'),
                'id_users'      => set_value('id_users', $row->id_users),
                'full_name'     => set_value('full_name', $row->full_name),
                'email'         => set_value('email', $row->email),
                //'password'      => set_value('password', $row->password),
                //'log'           => set_value('log', $row->log),
                'images'        => set_value('images', $row->images),
                // 'id_user_level' => set_value('id_user_level', $row->id_user_level),
                // 'nama_level' => set_value('nama_level', $row->nama_level),
                // 'is_aktif'      => set_value('is_aktif', $row->is_aktif),
            );
            $this->template->load('template', 'akun/akun', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Data tidak ditemukan</strong></div>');
            redirect(site_url('welcome'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_users', TRUE));
        } else {
            if ($foto['file_name'] == '') {
                $data = array(
                    'full_name'     => $this->input->post('full_name', TRUE),
                    'email'         => $this->input->post('email', TRUE),
                );
            } else {
                $data = array(
                    'full_name'     => $this->input->post('full_name', TRUE),
                    'email'         => $this->input->post('email', TRUE),
                    'images'        => $foto['file_name'],
                );

                // ubah foto profil yang aktif
                $this->session->set_userdata('images', $foto['file_name']);
            }

            $this->Akun_model->update($this->input->post('id_users', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Update Data Success</strong></div>');
            redirect(site_url('akun/update'));
        }
    }

    public function update_pass()
    {
        $row = $this->Akun_model->get_by_id($this->session->userdata('id_users'));

        if ($row) {
            $data = array(
                'button'        => 'Update',
                'action'        => site_url('akun/update_pass_action'),
                'id_users'      => set_value('id_users', $row->id_users),
                'password'      => set_value('password', $row->password),
                //'log'           => set_value('log', $row->log),
            );
            $this->template->load('template', 'akun/ganti_pass', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Data tidak ditemukan</strong></div>');
            redirect(site_url('welcome'));
        }
    }

    public function update_pass_action()
    {
        $row = $this->Akun_model->get_by_id($this->session->userdata('id_users'));
        $password       = $this->input->post('password', TRUE);
        $options        = array("cost" => 4);
        $hashPassword   = password_hash($password, PASSWORD_BCRYPT, $options);
        //if ($row->log == $this->input->post('log')) {
        $data = array(
            //'log'     => $this->input->post('password', TRUE),
            'password' => $hashPassword,
        );
        $this->Akun_model->update($this->input->post('id_users', TRUE), $data);
        $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Password berhasil diganti</strong></div>');
        redirect(site_url('akun/update_pass'));
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //         <span aria-hidden="true"><i class="fal fa-times"></i></span>
        //     </button><strong> Password gagal diganti, password lama yang anda masukkan tidak sesuai.</strong></div>');
        //     redirect(site_url('akun/update_pass'));
        // }
    }

    public function update_ttd()
    {
        $row = $this->Akun_model->get_by_id($this->session->userdata('id_users'));
        //header("Content-Type: image/png");
        $this->load->library('ciqrcode');
        $this->load->helper('url');
        if ($row) {
            $data = array(
                'button'        => 'Update',
                'action'        => site_url('akun/update_ttd_action'),
                'id_users'      => set_value('id_users', $row->id_users),
                'nama'      => set_value('nama', $row->nama),
                'nip'      => set_value('nip', $row->nip),
                'ttd'      => set_value('ttd', $row->ttd),
            );
            $this->template->load('template', 'akun/signature', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-warning-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Data tidak ditemukan</strong></div>');
            redirect(site_url('welcome'));
        }
    }

    public function ttd_action()
    {
        $row = $this->Akun_model->get_by_id($this->session->userdata('id_users'));
        // $img = $this->input->post('foto', TRUE);
        // $img = str_replace('data:image/png;base64,', '', $img);
        // $img = str_replace(' ', '+', $img);
        // $data_img = base64_decode($img);
        if (empty($row->ttd)) {
            $data = array(
                'id_users' => $this->session->userdata('id_users'),
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'ttd'     => $this->input->post('ttd', TRUE),

            );
            $this->Akun_model->insert_ttd($data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button><strong> Tanda tangan anda berhasil dibuat. Terima Kasih</strong></div>');
            redirect(site_url('akun/update_ttd'));
        } else {
            $data = array(
                'id_users' => $this->session->userdata('id_users'),
                'create_date' => $row->update_date,
                'update_date' => $this->session->userdata('id_users'),
                'ttd'     => $this->input->post('ttd', TRUE),

            );
            $this->Akun_model->update_ttd($this->session->userdata('id_users'), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-info-500" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button><strong> Tanda tangan anda berhasil diupdate. Terima Kasih</strong></div>');
            redirect(site_url('akun/update_ttd'));
        }
    }

    function upload_foto()
    {
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('images');
        return $this->upload->data();
    }

    public function _rules()
    {
        $this->form_validation->set_rules('full_name', 'full name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        //$this->form_validation->set_rules('password', 'password', 'trim|required');
        //$this->form_validation->set_rules('images', 'images', 'trim|required');
        // $this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
        // $this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');

        $this->form_validation->set_rules('id_users', 'id_users', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */
