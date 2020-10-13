<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class welcome extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model("login_model");
			$this->load->model("main_model");
		}
		public function index(){
			if($this->input->post()){
				$post = $this->input->post(); 
				if(isset($post['id_pencarian'])){
					$data=$this->main_model->cekproyek();
                    if($data=="proyek") redirect(site_url("monitoring/proyek"));
                    elseif($data=="unit") redirect(site_url("monitoring/unit"));
				}
				else{
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
				}
			}
			$this->load->view('home');
		}
	}
