<?php
    class monitoring extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model("main_model");
        }
        public function index(){
            redirect(site_url());
        }
        public function proyek($link=null,$link1=null){
            if(!isset($link)){
                $data["lihat_data_pembangunan"]=$this->main_model->monitoring_proyek(); 
                $this->load->view("monitoring_proyek_view",$data);
            }
            elseif($link=="pekerjaan_belum_selesai"){
                if(!isset($link1)){
                    $data["monitoring_unit"]=$this->main_model->pekerjaan_belum_selesai(); 
                    $this->load->view("pekerjaan_belum_view",$data);
                }
                else{
                    $this->main_model->simpan_session("id1",$link1); 
                    redirect(site_url("monitoring/proyek/pekerjaan_belum_selesai"));
                }
            }
        }
        public function unit(){
            $data["monitoring_unit"]=$this->main_model->monitoring_unit(); 
            $this->load->view("monitoring_unit_view",$data);
        }
        public function upload_bukti_pembayaran(){
            if($this->input->post()){
                if($this->main_model->upload_bukti_pembayaran()) redirect(site_url("monitoring/unit"));
            }
            $this->load->view("upload_bukti_view");
        }
    } 