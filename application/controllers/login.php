<?php
    class login extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model("login_model");
            $this->load->library('form_validation');
        }
        public function index(){
            if($this->input->post()){
                $login=$this->login_model->doLogin();
                if($login=="admin"){
                    redirect(site_url('admin'));
                }
                elseif($login=="Mandor"){
                    redirect(site_url('mandor'));
                }
                elseif($login=="Developer"){
                    redirect(site_url('developer'));
                }
                else{
                    redirect(site_url());
                }
            }
            $this->load->view("admin/");
        }
        public function logout(){
            $this->session->sess_destroy();
            redirect(site_url()); 
        }
}