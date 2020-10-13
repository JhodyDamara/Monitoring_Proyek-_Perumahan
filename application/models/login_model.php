<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class login_model extends CI_Model{
        private $_table = "pengguna";
        public function doLogin(){
            $post = $this->input->post(); 
            $sql = "select jenis_pengguna, username from {$this->_table} WHERE username='".$post['username']."' and password=UNHEX(MD5('".$post['password']."'))";
            $data=$this->db->query($sql)->result();
            if($data){
                $this->session->set_userdata(['userLogin' => $data[0]->jenis_pengguna]);
                $this->session->set_userdata(['username' => $data[0]->username]);
                return $data[0]->jenis_pengguna;
            }
            $this->session->set_userdata(['error' => "Username atau Password Salah"]);
            return false;
        }

        public function isNotLogin(){ 
            if($this->session->userdata('userLogin') === null) return false;
            else return $this->session->userdata('userLogin');
        } 
    } 