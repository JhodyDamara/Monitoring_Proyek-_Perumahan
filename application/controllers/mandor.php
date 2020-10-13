<?php
    class mandor extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("main_model");
            $this->load->model("login_model"); 
            $login=$this->login_model->isNotLogin();
            if($login=="admin"){
                redirect(site_url('admin'));
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
            $this->load->view("mandor/mandor_view",$data);
        }
        public function data_proyek($link1=NULL, $link2=NULL, $link3=NULL,$link4=NULL){
            if(!isset($link1)){
                $data["proyek"]=$this->main_model->proyek();
                $this->load->view("mandor/data_proyek_view",$data);
            } 
            elseif ($link1=="perancangan") {
                if(!isset($link2)){
                    $data["perancangan"]=$this->main_model->perancangan();
                    $data["rancanganpembangunan"]=$this->main_model->rancanganpembangunan();
                    $data["keuangan"]=$this->main_model->rancangan_anggara();
                    $this->load->view("mandor/data_proyek/perancangan_view",$data);
                } 
                elseif($link2=="pembangunan"){
                    $data["rancanganpembangunan"]=$this->main_model->rancanganpembangunan();
                    $this->load->view("mandor/data_proyek/perancangan/pembangunan_view",$data);
                }
                elseif($link2=="anggaran"){
                    $data["tampil"]=$this->main_model->rancangan_anggara();
                    $this->load->view("mandor/data_proyek/perancangan/anggaran_view",$data);
                }
                else{
                    $this->main_model->simpan_session("dataproyek",$link2);
                    redirect(site_url("mandor/data_proyek/perancangan"));
                }
            }
            elseif ($link1=="pembangunan") {
                if(!isset($link2)) {
                    $data["perancangan"]=$this->main_model->perancangan(); 
                    $data["rancanganpembangunan"]=$this->main_model->rancanganpembangunan();
                    $data["tampil"]=$this->main_model->rancangan_anggara();
                    $this->load->view("mandor/data_proyek/pembangunan_view",$data);
                }
                elseif($link2=="perkembangan_pembangunan"){ 
                    if(!isset($link3)) {
                        $data["tampil"]=$this->main_model->perkembangan_pembangunan();
                        $data["tampil1"]=$this->main_model->rancanganpembangunan();
                        $data["tampil2"]=$this->main_model->perancangan();
                        $this->load->view("mandor/data_proyek/pembangunan/perkembangan_pembangunan_view",$data);
                    }
                    elseif($link3=="tambah_perkembangan_pembangunan") {
                        if($this->input->post()){
                            if($this->main_model->tambah_perkembangan_pembangunan()) redirect(site_url("mandor/data_proyek/pembangunan/perkembangan_pembangunan"));
                        } 
                        $data["tampil"]=$this->main_model->rancanganpembangunan();
                        $this->load->view("mandor/data_proyek/pembangunan/perkembangan_pembangunan/tambah_perkembangan_pembangunan",$data);
                    }
                }
                elseif($link2=="pengeluaran_keuangan"){
                    if(!isset($link3)) {
                        $data["tampil"]=$this->main_model->perancangan();
                        $data["tampil1"]=$this->main_model->pengeluaran_keuangan();
                        $this->load->view("mandor/data_proyek/pembangunan/pengeluaran_keuangan_view", $data);
                    }
                    elseif($link3=="tambah_pengeluaran_keuangan") {
                        if($this->input->post()){
                            if($this->main_model->tambah_pengeluaran_keuangan()) redirect(site_url("mandor/data_proyek/pembangunan/pengeluaran_keuangan"));
                        } 
                        $data["tampil"]=$this->main_model->rancangan_anggara();
                        $this->load->view("mandor/data_proyek/pembangunan/pengeluaran_keuangan/tambah_pengeluaran_view",$data);
                    }
                }
                elseif($link2=="evaluasi"){
                    if(!isset($link3)){
                        $data["tampil"]=$this->main_model->tampil_evaluasi();
                        $data["tampil1"]=$this->main_model->perancangan();
                        $this->load->view("mandor/data_proyek/pembangunan/evaluasi_view",$data);
                    }
                    elseif($link3=="tambah_evaluasi") {
                        if($this->input->post()){
                            if($this->main_model->evaluasi()) redirect(site_url("mandor/data_proyek/pembangunan/evaluasi"));
                        } 
                        $this->load->view("mandor/data_proyek/pembangunan/evaluasi/tambah_evaluasi_view"); 
                    }    
                } 
                else{
                    $this->main_model->simpan_session("dataproyek",$link2);
                    redirect(site_url("mandor/data_proyek/pembangunan"));
                }
            }
        }
        public function pengaturan(){
            if($this->input->post()){
                $this->main_model->edit_akun();
                redirect(site_url("login/logout")); 
            }
            $data['tampil']=$this->main_model->tampil_edit();
            $this->load->view("mandor/pengaturan_view",$data);
        }
        public function data_perancangan_proyek($link=null, $link1=null, $link2=null){
            if(!isset($link)){
                $data['data_perancangan_proyek']=$this->main_model->data_proyek_status("perancangan");
                $this->load->view("mandor/data_perancangan_view",$data);
            }
            elseif($link=="lihat_data_perancangan"){
                if(!isset($link1)){
                    $data['data_perancangan_lihat']=$this->main_model->data_perancangan_lihat(); 
                    $this->load->view("mandor/data_perancangan/lihat_data_view",$data);
                }
                else{
                    $this->main_model->simpan_session("id",$link1);
                    redirect(site_url("mandor/data_perancangan_proyek/lihat_data_perancangan"));
                }
            }
        }
        public function data_pembangunan_proyek($link=null,$link1=null,$link2=null){
            if(!isset($link)){
                $data['data_proyek_status']=$this->main_model->data_pembangunan_proyek();
                $this->load->view("mandor/data_pembangunan_view",$data);
            }
            elseif($link=="lihat_data_pembangunan"){
                if(!isset($link1)){
                    $data['lihat_data_pembangunan']=$this->main_model->lihat_data_pembangunan();
                    $this->load->view("mandor/data_pembangunan/lihat_data_view",$data);
                }
                elseif ($link1=="tambah_perkembangan_proyek") {
                    if(!isset($link2)){
                        if($this->input->post()){ 
                            if($this->main_model->tambah_perkembangan_pembangunan()) redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan"));
                        }
                        $data['tampil']=$this->main_model->data_target_pembangunan("id_unit");
                        $this->load->view("mandor/data_pembangunan/lihat_data/tambah_perkembangan_view",$data);
                    }
                    else{
                        $this->main_model->simpan_session("id1",$link2); 
                        redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan/tambah_perkembangan_proyek"));
                    }
                }
                elseif ($link1=="tambah_pengeluaran_proyek") {
                    if(!isset($link2)){
                        if($this->input->post()){
                            if($this->main_model->tambah_pengeluaran_keuangan()) redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan"));
                        }
                        $data['tampil']=$this->main_model->data_target_keuangan("id_unit");
                        $this->load->view("mandor/data_pembangunan/lihat_data/tambah_pengeluaran_view",$data);
                    } 
                    else{
                        $this->main_model->simpan_session("id1",$link2); 
                        redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan/tambah_pengeluaran_proyek"));
                    }
                } 
                elseif ($link1=="edit_target_pekerjaan") {
                    if(!isset($link2)){
                        if($this->input->post()){
                            $this->main_model->edit_target_projek();
                            redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan"));
                        }
                        $data['data_edit_target']=$this->main_model->data_edit_target();
                        $this->load->view("mandor/data_pembangunan/lihat_data/edit_target_view",$data);
                    }
                    else{
                        $this->main_model->simpan_session("id1",$link2); 
                        redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan/edit_target_pekerjaan"));
                    }
                }
                else{
                    $this->main_model->simpan_session("id",$link1); 
                    redirect(site_url("mandor/data_pembangunan_proyek/lihat_data_pembangunan"));
                }
            } 
        }
        public function monitoring($link=null,$link1=null,$link2=null){
            if(!isset($link)){
                if($this->input->post()){
                    $data=$this->main_model->cekproyek();
                    if($data=="proyek") redirect(site_url("mandor/monitoring/proyek"));
                    elseif($data=="unit") redirect(site_url("mandor/monitoring/unit"));
                }
                $this->load->view("mandor/form_monitoring_view");
            }
            elseif($link=="proyek"){
                if(!isset($link1)){
                    $data["lihat_data_pembangunan"]=$this->main_model->monitoring_proyek(); 
                    $this->load->view("mandor/monitoring_proyek_view",$data);
                }
                elseif($link1=="pekerjaan_belum_selesai"){
                    if(!isset($link2)){
                        $data["monitoring_unit"]=$this->main_model->pekerjaan_belum_selesai(); 
                        $this->load->view("mandor/pekerjaan_belum_view",$data);
                    }
                    else{
                        $this->main_model->simpan_session("id1",$link2); 
                        redirect(site_url("mandor/monitoring/proyek/pekerjaan_belum_selesai"));
                    }
                }
            }
            elseif($link=="unit"){
                $data["monitoring_unit"]=$this->main_model->monitoring_unit(); 
                $this->load->view("mandor/monitoring_unit_view",$data);
            }
        } 
        public function tambah_target_selesai($link=null,$link1=null){
            $this->main_model->tambah_target_selesai($link,$link1);
        }
    } 