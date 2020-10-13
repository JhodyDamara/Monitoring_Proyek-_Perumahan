<?php
    class pengaturan extends CI_Controller {
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
            $data['tampil']=$this->main_model->tampil_akun();
            $this->load->view("admin/pengaturan_view",$data);
        }
        public function tambah_akun(){
            if($this->input->post()){
                if($this->main_model->tambah_akun()) redirect(site_url("admin/pengaturan")); 
            }
            $this->load->view("admin/pengaturan/tambah_akun_view");
        } 
        public function edit_akun($link=null){
            if(!isset($link)){
                if($this->input->post()){
                    if($this->main_model->edit_akun()) redirect(site_url("admin/pengaturan"));
                }
                $data['tampil']=$this->main_model->tampil_edit();
                $this->load->view("admin/pengaturan/edit_akun_view",$data);
            }
            else{
                $this->main_model->simpan_session("editakun",$link,true);
                redirect(site_url("admin/pengaturan/edit_akun"));
            }
        }
        public function hapus_akun($link=null){
            if(isset($link)){
                if($this->main_model->hapus_akun($link)) redirect(site_url("admin/pengaturan"));
            }
        }
    }