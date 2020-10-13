<?php
    class data_proyek extends CI_Controller {
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
            $data["proyek"]=$this->main_model->proyek();
            $this->load->view("admin/data_proyek_view",$data);
        } 
        public function tambah_data_proyek(){
            if($this->input->post()){
                if($this->main_model->simpan_data_proyek()) redirect(site_url("admin/data_proyek"));
            }
            $data["mandor"]=$this->main_model->mandor();
            $this->load->view("admin/data_proyek/tambah_data_view",$data);
        }
        public function perancangan($link1=null, $link2=null,$link3=null){
            if(!isset($link1)){
                $data["perancangan"]=$this->main_model->perancangan();
                $data["rancanganpembangunan"]=$this->main_model->rancanganpembangunan();
                $data["keuangan"]=$this->main_model->rancangan_anggara();
                $this->load->view("admin/data_proyek/perancangan_view",$data);
            } 
            elseif($link1=="pembangunan"){
                if(!isset($link2)){
                    $data["rancanganpembangunan"]=$this->main_model->rancanganpembangunan();
                    $this->load->view("admin/data_proyek/perancangan/pembangunan_view",$data);
                }
                if($link2=="tambah_pembangunan"){
                    if($this->input->post()){
                        if($this->main_model->simpan_perancangan_pembangunan()) redirect(site_url("admin/data_proyek/perancangan/pembangunan"));
                    }
                    $this->load->view("admin/data_proyek/perancangan/pembangunan/tambah_pembangunan_view");
                }
                elseif($link2=="edit_pembangunan"){
                    if(!isset($link3)){
                        if($this->input->post()){
                            if($this->main_model->edit_perancangan_pembangunan()) redirect(site_url("admin/data_proyek/perancangan/pembangunan"));
                        }
                        $data["rancanganpembangunanbyid"]=$this->main_model->rancanganpembangunanbyid();
                        $this->load->view("admin/data_proyek/perancangan/pembangunan/edit_pembangunan_view",$data);
                    } 
                    else{
                        $this->main_model->simpan_session("datarancanganpembangunan",$link3);
                        redirect(site_url("admin/data_proyek/perancangan/pembangunan/edit_pembangunan"));
                    }
                }
                elseif($link2=="hapus_pembangunan"){
                    $this->main_model->hapusrancanganpembangunan($link3);
                    redirect(site_url("admin/data_proyek/perancangan/pembangunan"));
                }
            }
            elseif($link1=="anggaran"){
                if(!isset($link2)) {
                    $data["tampil"]=$this->main_model->rancangan_anggara();
                    $this->load->view("admin/data_proyek/perancangan/anggaran_view",$data);
                }
                elseif($link2=="tambah_anggaran"){
                    if($this->input->post()){
                        if($this->main_model->tambah_anggaran()) redirect(site_url("admin/data_proyek/perancangan/anggaran"));
                    } 
                    $this->load->view("admin/data_proyek/perancangan/anggaran/tambah_anggaran_view");
                }
                elseif($link2=="edit_anggaran"){
                    if(!isset($link3)) {
                        if($this->input->post()){
                            if($this->main_model->edit_rancangan_anggara()) redirect(site_url("admin/data_proyek/perancangan/anggaran"));
                        }
                        $data["tampil"]=$this->main_model->rancangan_anggara_byid();
                        $this->load->view("admin/data_proyek/perancangan/anggaran/edit_anggaran_view",$data);
                    }
                    else{
                        $this->main_model->simpan_session("datarancangananggaran",$link3);
                        redirect(site_url("admin/data_proyek/perancangan/anggaran/edit_anggaran"));
                    }
                }
                elseif($link2=="hapus_anggaran"){
                    $this->main_model->hapusrancangananggaran($link3);
                    redirect(site_url("admin/data_proyek/perancangan/anggaran"));
                }
            }
            elseif($link1=="start"){
                if($link2!=0 && $link3!=0) {
                    $this->main_model->start_proyek();
                    redirect(site_url("admin/data_proyek"));
                }
                else{
                    $this->session->set_userdata(['error' => "Perancangan pembangunan dan anggaran biaya belum jelas"]);
                    redirect(site_url("admin/data_proyek/perancangan"));
                }
            }
            else{
                $this->main_model->simpan_session("dataproyek",$link1);
                redirect(site_url("admin/data_proyek/perancangan"));
            } 
        }
        public function pembangunan($link1=null, $link2=null){
            if(!isset($link1)) {
                $data["perancangan"]=$this->main_model->perancangan(); 
                $data["rancanganpembangunan"]=$this->main_model->rancanganpembangunan();
                $data["tampil"]=$this->main_model->rancangan_anggara();
                $this->load->view("admin/data_proyek/pembangunan_view",$data);
            }
            elseif($link1=="perkembangan_pembangunan"){ 
                if(!isset($link2)) {
                    $data["tampil"]=$this->main_model->perkembangan_pembangunan();
                    $data["tampil1"]=$this->main_model->rancanganpembangunan();
                    $data["tampil2"]=$this->main_model->perancangan();
                    $this->load->view("admin/data_proyek/pembangunan/perkembangan_pembangunan_view",$data);
                }
                elseif($link2=="tambah_perkembangan_pembangunan") {
                    if($this->input->post()){
                        if($this->main_model->tambah_perkembangan_pembangunan()) redirect(site_url("admin/data_proyek/pembangunan/perkembangan_pembangunan"));
                    } 
                    $data["tampil"]=$this->main_model->rancanganpembangunan();
                    $this->load->view("admin/data_proyek/pembangunan/perkembangan_pembangunan/tambah_perkembangan_pembangunan",$data);
                }
            }
            elseif($link1=="pengeluaran_keuangan"){
                if(!isset($link2)) {
                    $data["tampil"]=$this->main_model->perancangan();
                    $data["tampil1"]=$this->main_model->pengeluaran_keuangan();
                    $this->load->view("admin/data_proyek/pembangunan/pengeluaran_keuangan_view", $data);
                }
                elseif($link2=="tambah_pengeluaran_keuangan") {
                    if($this->input->post()){
                        if($this->main_model->tambah_pengeluaran_keuangan()) redirect(site_url("admin/data_proyek/pembangunan/pengeluaran_keuangan"));
                    } 
                    $data["tampil"]=$this->main_model->rancangan_anggara();
                    $this->load->view("admin/data_proyek/pembangunan/pengeluaran_keuangan/tambah_pengeluaran_view",$data);
                }
            }
            elseif($link1=="evaluasi"){
                if(!isset($link2)){
                    $data["tampil"]=$this->main_model->tampil_evaluasi();
                    $data["tampil1"]=$this->main_model->perancangan();
                    $this->load->view("admin/data_proyek/pembangunan/evaluasi_view",$data);
                }
                elseif($link2=="tambah_evaluasi") {
                    if($this->input->post()){
                        if($this->main_model->evaluasi()) redirect(site_url("admin/data_proyek/pembangunan/evaluasi"));
                    } 
                    $this->load->view("admin/data_proyek/pembangunan/evaluasi/tambah_evaluasi_view"); 
                }    
            } 
            else{
                $this->main_model->simpan_session("dataproyek",$link1);
                redirect(site_url("admin/data_proyek/pembangunan"));
            }
        }
        public function update($link1=NULL){
            if(!isset($link1)){
                if($this->input->post()){
                    if($this->main_model->edit_data_proyek()) redirect(site_url("admin/data_proyek"));
                }
                $data["update"]=$this->main_model->ambildata($link1);
                $data["mandor"]=$this->main_model->mandor();
                $this->load->view("admin/data_proyek/edit_view",$data);
            }
            else{
                $this->main_model->simpan_session("dataproyek",$link1);
                redirect(site_url("admin/data_proyek/update"));
            }
        } 
        public function hapus_proyek($link1=NULL){
            if($this->main_model->hapus_data_proyek($link1)) redirect(site_url("admin/data_proyek"));
        }
    }