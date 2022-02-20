<?php
class Auth extends CI_Controller
{



    function index()
    {
        $this->load->view('auth/login4');
    }

    function cheklogin()
    {
        $ta      = $this->input->post('ta');
        $email      = $this->input->post('username');
        //$password   = $this->input->post('password');
        $password = $this->input->post('password', TRUE);
        $hashPass = password_hash($password, PASSWORD_DEFAULT);
        $test     = password_verify($password, $hashPass);
        // query chek users
        $this->db->where('username', $email);
        //$this->db->where('password',  $test);
        $users       = $this->db->get('v_login');
        if ($users->num_rows() > 0) {
            $array_ta = array(
                'ta' => $this->input->post('ta'),
            );
            $user = $users->row_array();
            $merger = array_merge($user, $array_ta);
            if (password_verify($password, $user['password'])) {
                // retrive user data to session
                $this->session->set_userdata($merger);
                redirect('welcome');
            } else {
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('status_login', 'email atau password yang anda input salah');
            redirect('auth');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login', 'Anda sudah berhasil keluar dari aplikasi');
        redirect('auth');
    }
}
