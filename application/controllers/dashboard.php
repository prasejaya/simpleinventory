<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Login Gagal!! Username atau Password Salah !');
            redirect('');
        };
        $this->load->model('model_app');
    }

    function index(){
        $this->load->view('element/v_header');
        $this->load->view('pages/v_dashboard');
        $this->load->view('element/v_footer');
    }

}