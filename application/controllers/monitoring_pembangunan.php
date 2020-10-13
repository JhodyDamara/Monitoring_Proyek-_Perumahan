<?php
    class monitoring_pembangunan extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model("main_model");
        }
        public function index(){
                $data["tampil"]=$this->main_model->perkembangan_pembangunan();
                $data["tampil1"]=$this->main_model->rancanganpembangunan();
                $data["tampil2"]=$this->main_model->perancangan();
                $this->load->view("monitoring_pembangunan_view",$data);
        }
}