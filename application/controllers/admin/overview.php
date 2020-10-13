<?php
    class overview extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("main_model");
            $this->load->model("login_model"); 
            $login=$this->login_model->isNotLogin();
            if($login=="Mandor"){
                redirect(site_url('mandor'));
            }
            elseif($login=="Developer"){
                redirect(site_url('developer'));
            }
            elseif($login==false){
                redirect(site_url());
            } 
        }
        public function index(){
            $data["profile"]=$this->main_model->profile();
            $this->load->view("admin/overview_view",$data);
        }
    }  