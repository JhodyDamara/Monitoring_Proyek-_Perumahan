<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class main_model extends CI_Model{
        public function profile(){
            $user=$this->session->userdata('username');
            $sql = "select * from pengguna where username='$user'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function proyek(){
            $where="";
            if($this->session->userdata('userLogin')=="Mandor") $where="where username='".$this->session->userdata('username')."'";
            $sql = "select * from data_proyek $where";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function simpan_data_proyek(){
            $post = $this->input->post();    
            if($post['jenis']!='Perumahan') {
                $post['jumlah']=1;
                $post['blok0']=1;
            }
            if($post['mandor']=="" || $post['jenis']=="" || $post['nama']=="" || $post['lokasi']=="" || $post['jumlah']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            for ($i=0; $i < $post['jumlah'] ; $i++) { 
                if($post['blok'.$i]=="" || $post['jenis'.$i]==""){
                    $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                    return false;
                }
            }
            $id=substr($post['nama'],0,3).(date("dmis")+1);
            $sql="insert into data_proyek values('$id','".$post['mandor']."','".$post['nama']."','".$post['jenis']."','".$post['lokasi']."','perancangan','0000-00-00')";
            $this->db->query($sql);
            $values_blok="";
            $values_unit="";
            $value_pembangunan="";
            $value_anggaran="";
            $huruf="A";
            for($i=0;$i<$post['jumlah'];$i++){
                $id1="B".$huruf.$id;
                $values_blok=$values_blok."('$id1','$id','Blok $huruf'),";
                if(!isset($data[$post['jenis'.$i]])){
                    $sql="select * from rancangan_pembangunan where id_tipe_pembangunan='".$post['jenis'.$i]."'";
                    $data['pembangunan'][$post['jenis'.$i]]=$this->db->query($sql)->result();
                    $sql="select * from rancangan_anggaran where id_tipe_pembangunan='".$post['jenis'.$i]."'";
                    $data['anggaran'][$post['jenis'.$i]]=$this->db->query($sql)->result();
                }
                for ($j=0; $j < $post['blok'.$i]; $j++) { 
                    $id2="U".$j.$id1;
                    $values_unit=$values_unit."('$id2','$id1','Blok $huruf".($j+1)."'),";
                    foreach ($data['pembangunan'][$post['jenis'.$i]] as $key => $value) {
                        $id3="P".$key.$id2;
                        $value_pembangunan=$value_pembangunan."('$id3','$id2','$value->pembangunan',$value->jumlah,'$value->satuan',$value->lama_pengerjaan),";
                    }
                    foreach ($data['anggaran'][$post['jenis'.$i]] as $key => $value) {
                        $id3="A".$key.$id2;
                        $value_anggaran=$value_anggaran."('$id3','$id2','$value->nama_barang',$value->jumlah,'$value->satuan',$value->anggaran_biaya),";
                    }
                }
                $huruf++;
            }
            $sql="insert into blok values ".substr($values_blok,0,-1);
            $this->db->query($sql);
            $sql="insert into unit values ".substr($values_unit,0,-1);
            $this->db->query($sql);
            $sql="insert into target_pembangunan values ".substr($value_pembangunan,0,-1);
            $this->db->query($sql);
            $sql="insert into target_keuangan values ".substr($value_anggaran,0,-1);
            $this->db->query($sql);
            return true;
        }
        public function mandor(){
            $sql = "select * from pengguna where jenis_pengguna='mandor'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function ambildata(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select * from data_proyek where id_data_proyek='$id'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function edit_data_proyek(){
            $post = $this->input->post();
            $id=$this->session->userdata('dataproyek');
            $sql = "update data_proyek set username='".$post["mandor"]."', nama_proyek='".$post["nama"]."', jenis_proyek='".$post["jenis"]."', lokasi='".$post["lokasi"]."' where id_data_proyek='$id'";
            $data=$this->db->query($sql);
            return true;
        } 
        public function hapus_data_proyek($id){
            $sql = "delete perkembangan_pembangunan from perkembangan_pembangunan inner join target_pembangunan on perkembangan_pembangunan.id_target_pembangunan=target_pembangunan.id_target_pembangunan where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            $sql = "delete pengeluaran_keuangan from target_keuangan inner join pengeluaran_keuangan on target_keuangan.id_target_keuangan=pengeluaran_keuangan.id_target_keuangan where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            $sql = "delete from target_pembangunan where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            $sql = "delete from target_keuangan where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            $sql = "delete from evaluasi where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            $sql = "delete from data_proyek where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            return true;
        }
        public function perancangan(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select data_proyek.id_data_proyek as id, nama_proyek, nama_pengguna, jenis_proyek, lokasi, start_proyek from data_proyek,pengguna where data_proyek.username=pengguna.username and id_data_proyek='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function rancanganpembangunan(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select * from target_pembangunan where id_data_proyek='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function simpan_perancangan_pembangunan(){
            $post = $this->input->post();
            if($post['pembangunan']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['lama']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['pembangunan'],0,3).(date("dmis")+1);
            $idproyek=$this->session->userdata('dataproyek');
            $sql="insert into target_pembangunan values('$id','$idproyek','".$post['pembangunan']."',".$post['jumlah'].",'".$post['satuan']."',".$post['lama'].")";
            $data=$this->db->query($sql);
            return true;
        }
        public function simpan_session($key, $value){
            $this->session->set_userdata([$key => $value]);
            return true;
        }
        public function rancanganpembangunanbyid(){
            $id=$this->session->userdata('datarancanganpembangunan');
            $sql="select * from target_pembangunan where id_target_pembangunan='$id'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function edit_perancangan_pembangunan(){
            $post = $this->input->post();
            $id=$this->session->userdata('datarancanganpembangunan');
            $sql="update target_pembangunan set pembangunan='".$post['pembangunan']."', satuan='".$post['satuan']."', jumlah=".$post['jumlah'].", lama_pengerjaan=".$post['lama']." where id_target_pembangunan='$id'";
            $data=$this->db->query($sql);
            return true;
        }
        public function hapusrancanganpembangunan($id){
            $sql="delete from target_pembangunan where id_target_pembangunan='$id'";
            $data=$this->db->query($sql);
            return true;
        }
        public function rancangan_anggara(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select * from target_keuangan where id_data_proyek='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function tambah_anggaran(){
            $post = $this->input->post();
            if($post['nama']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['anggaran']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $idproyek=$this->session->userdata('dataproyek');
            $id=substr($post['nama'],0,3).(date("dmis")+1);
            $sql = "insert into target_keuangan values('$id','$idproyek','".$post['nama']."',".$post['jumlah'].",'".$post['satuan']."','".$post['anggaran']."')";
            $data=$this->db->query($sql);
            return true;
        }
        public function rancangan_anggara_byid(){
            $id=$this->session->userdata('datarancangananggaran');
            $sql = "select * from target_keuangan where id_target_keuangan='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function edit_rancangan_anggara(){
            $post = $this->input->post();
            $id=$this->session->userdata('datarancangananggaran');
            $sql="update target_keuangan set nama_barang='".$post['nama']."', satuan='".$post['satuan']."', jumlah=".$post['jumlah'].", anggaran=".$post['anggaran']." where id_target_keuangan='".$id."'";
            $data=$this->db->query($sql);
            return true;
        }
        public function hapusrancangananggaran($id){
            $sql="delete from target_keuangan where id_target_keuangan='".$id."'";
            $data=$this->db->query($sql);
            return true;
        }
        public function start_proyek(){
            date_default_timezone_set('Asia/Jakarta');
            $id=$this->session->userdata('dataproyek');
            $sql="update data_proyek set status='pembangunan', start_proyek='".date('Y-m-d')."' where id_data_proyek='".$id."'";
            $data=$this->db->query($sql);
            return true;
        }
        public function tambah_perkembangan_pembangunan(){
            $post = $this->input->post();
            if($this->session->userdata('data_target') === null || $_FILES['tambah']['size']==0){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $target=$this->session->userdata('data_target');
            $i=1;
            foreach ($target as $key => $value) {
                $id=substr($key,0,3).(date("dmis")+$i);
                if(!isset($where)){
                    $nama = $_FILES['tambah']['name'];
                    $x = explode('.', $nama);
                    $ekstensi = strtolower(end($x));
                    $nama=$id.".".$ekstensi; 
                    $nama_foto=$id;
                }
                $i++;
                $where[]="('$id','$key','$nama',$value,'".date("Y-m-d")."')";
            }
            $config['upload_path']="./images/perkembangan_proyek";
            $config["allowed_types"]="gif|jpg|png|jpeg";
            $config['file_name'] = $nama_foto;
            $config['max_size'] = 20000;
            $this->load->library('upload',$config);
            if ( ! $this->upload->do_upload('tambah')){
                $this->session->set_userdata(['error' => $this->upload->display_errors()]);
                return false;
            } 
            $sql="insert into perkembangan_pembangunan values ".join(",",$where);
            return $this->db->query($sql);
        }
        public function perkembangan_pembangunan(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select pembangunan, perkembangan_pembangunan.jumlah as jumlah, tanggal_pembangunan, data_foto from perkembangan_pembangunan, target_pembangunan where perkembangan_pembangunan.id_target_pembangunan=target_pembangunan.id_target_pembangunan and id_data_proyek='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function tambah_pengeluaran_keuangan(){
            $post = $this->input->post();
            if($post['nama']=="" || $post['jumlah']=="" || $post['biaya']=="" || $_FILES['tambah']['size']==0){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['nama'],0,3).(date("dmis")+1);
            $config['upload_path']="./images/pengeluaran_keuangan";
            $config["allowed_types"]="gif|jpg|png|jpeg";
            $config['file_name'] = $id;
            $config['max_size'] = 20000;
            $this->load->library('upload',$config);
            if ( ! $this->upload->do_upload('tambah')) echo $this->upload->display_errors();
            $nama = $_FILES['tambah']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $nama=$id.".".$ekstensi; 
            $sql="insert into pengeluaran_keuangan values('$id','".$post['nama']."','$nama',".$post['jumlah'].",".$post['biaya'].",'".date("Y-m-d")."')";
            $data=$this->db->query($sql);
            return true;
        }
        public function pengeluaran_keuangan(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select nama_barang, pengeluaran_keuangan.jumlah as jumlah, biaya, tanggal_pengeluaran from pengeluaran_keuangan, target_keuangan where pengeluaran_keuangan.id_target_keuangan=target_keuangan.id_target_keuangan and id_data_proyek='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function evaluasi(){
            $post = $this->input->post();
            if($post['masalah']=="" || $post['masukkan']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['masalah'],0,3).(date("dmis")+1);
            $idproyek=$this->session->userdata('dataproyek');
            $sql="insert into evaluasi values('$id','$idproyek','".$post['masalah']."','".$post['masukkan']."')";
            $data=$this->db->query($sql);
            return true;
        }
        public function tampil_evaluasi(){
            $id=$this->session->userdata('dataproyek');
            $sql = "select * from evaluasi, data_proyek where evaluasi.id_data_proyek=data_proyek.id_data_proyek and evaluasi.id_data_proyek='".$id."'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function tambah_akun(){
            $post = $this->input->post();
            $data = $this->db->get_where('pengguna', array(
                'username' => $post['username']
            ));
            $count = $data->num_rows();
            if($count){
                $this->session->set_userdata(['error' => "Username Telah digunakan"]);
                return false;
            }
            else{
                $sql="insert into pengguna values('".$post['username']."',UNHEX(MD5('1234')),'".$post['nama']."','Mandor','user.png')";
                $data=$this->db->query($sql);
                return true;
            }
        }
        public function tampil_akun(){
            $sql="select * from pengguna where username!='admin' and jenis_pengguna!='Developer'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function tampil_edit(){
            $id=$this->session->userdata('editakun');
            if(!isset($id)) $id=$this->session->userdata('username');
            $sql="select * from pengguna where username='$id'";
            $data=$this->db->query($sql)->result();
            return $data;
        }
        public function edit_akun(){
            $post = $this->input->post();
            $update="";
            if(isset($post['password']) && $post['password']!="") $update=$update.", password=unhex(md5('".$post['password']."'))";
            if(isset($post['jenis'])) $update=$update.", jenis_pengguna='".$post['jenis']."'";
            $id=$this->session->userdata('editakun');
            if(!isset($id)) $id=$this->session->userdata('username');
            if(isset($_FILES['foto']['size']) && $_FILES['foto']['size']>0) {
                $nama = $_FILES['foto']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $nama=$id.".".$ekstensi;
                $update=$update.", foto='".$nama."'";
                unlink('./images/pengguna/'.$nama);
                $config['upload_path']="./images/pengguna";
                $config["allowed_types"]="gif|jpg|png|jpeg";
                $config['file_name'] = $id;
                $config['max_size'] = 20000;
                $this->load->library('upload',$config);
                if ( ! $this->upload->do_upload('foto')) return array('error' => $this->upload->display_errors()); 
            }
            $sql="update pengguna set nama_pengguna='".$post['nama']."' $update where username='$id'";
            $data=$this->db->query($sql);
            return true;
        }
        public function hapus_akun($id){
            $sql="update data_proyek set username=NULL where username='$id'";
            $data=$this->db->query($sql);
            $sql="delete from pengguna where username='$id'";
            $data=$this->db->query($sql);
            return true;
        }
        public function data_tambah_pembangunan(){
            $post = $this->input->post();
            if($post['pembangunan']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['lama']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['pembangunan'],0,3).(date("dmis")+1);
            $sql="insert into rancangan_pembangunan values('$id',null,'".$post['pembangunan']."',".$post['jumlah'].",'".$post['satuan']."',".$post['lama'].")";
            return $this->db->query($sql);
        }
        public function tambah_data_tipe(){
            $sql="select * from rancangan_pembangunan where id_tipe_pembangunan is null";
            $data[]=$this->db->query($sql)->result();
            $sql="select * from rancangan_anggaran where id_tipe_pembangunan is null";
            $data[]=$this->db->query($sql)->result();
            return $data;
        }
        public function data_tambah_anggaran(){
            $post = $this->input->post();
            if($post['nama']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['anggaran']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['nama'],0,3).(date("dmis")+1);
            $sql="insert into rancangan_anggaran values('$id',null,'".$post['nama']."',".$post['jumlah'].",'".$post['satuan']."',".$post['anggaran'].")";
            return $this->db->query($sql);
        }
        public function tambah_pembangunan_edit(){
            $sql="select * from rancangan_pembangunan where id_rancangan_pembangunan='".$this->session->userdata["id"]."'";
            return $this->db->query($sql)->result();
        }
        public function pembangunan_edit(){
            $post = $this->input->post();
            $sql="update rancangan_pembangunan set pembangunan='".$post["pembangunan"]."', jumlah=".$post["jumlah"].", satuan='".$post["satuan"]."', lama_pengerjaan=".$post["lama"]." where id_rancangan_pembangunan='".$this->session->userdata["id"]."'";
            return $this->db->query($sql);
        }
        public function tambah_pembangunan_hapus($id){
            $sql="delete from rancangan_pembangunan where id_rancangan_pembangunan='".$id."'";
            return $this->db->query($sql);
        }
        public function tambah_anggaran_edit(){
            $sql="select * from rancangan_anggaran where id_rancangan_anggaran='".$this->session->userdata["id"]."'";
            return $this->db->query($sql)->result();
        }
        public function anggaran_edit(){
            $post = $this->input->post();
            $sql="update rancangan_anggaran set nama_barang='".$post["nama"]."', jumlah=".$post["jumlah"].", satuan='".$post["satuan"]."', anggaran_biaya=".$post["anggaran"]." where id_rancangan_anggaran='".$this->session->userdata["id"]."'";
            return $this->db->query($sql);
        }
        public function tambah_anggaran_hapus($id){
            $sql="delete from rancangan_anggaran where id_rancangan_anggaran='".$id."'";
            return $this->db->query($sql);
        }
        public function tambah_data(){
            $post = $this->input->post();
            if($post['tipe']=="" || $post['bykpembangunan']==0 || $post['bykanggaran']==0){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['tipe'],0,3).(date("dmis")+1);
            $sql="insert into tipe_pembangunan values ('$id','".$post['tipe']."')";
            $this->db->query($sql);
            $sql="update rancangan_pembangunan set id_tipe_pembangunan='$id' where id_tipe_pembangunan is null";
            $this->db->query($sql);
            $sql="update rancangan_anggaran set id_tipe_pembangunan='$id' where id_tipe_pembangunan is null";
            return $this->db->query($sql);
        }
        public function data_tipe_pembangunan(){
            $sql="SELECT rancangan_pembangunan.id_tipe_pembangunan as id, nama_tipe_pembangunan, sum(lama_pengerjaan) as lama FROM tipe_pembangunan, rancangan_pembangunan where tipe_pembangunan.id_tipe_pembangunan=rancangan_pembangunan.id_tipe_pembangunan group by rancangan_pembangunan.id_tipe_pembangunan";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $value) {
                $data[$value->id]['tipe']=$value->nama_tipe_pembangunan;
                $data[$value->id]['lama']=$value->lama;
            }
            $sql="SELECT rancangan_anggaran.id_tipe_pembangunan as id, sum(anggaran_biaya) as biaya FROM tipe_pembangunan, rancangan_anggaran where tipe_pembangunan.id_tipe_pembangunan=rancangan_anggaran.id_tipe_pembangunan group by rancangan_anggaran.id_tipe_pembangunan";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $value) {
                $data[$value->id]['biaya']=$value->biaya;
            }
            if(!isset($data)) $data=null;
            return $data;
        }
        public function data_tambah_batal(){
            $sql="delete from rancangan_pembangunan where id_tipe_pembangunan is null";
            $this->db->query($sql);
            $sql="delete from rancangan_anggaran where id_tipe_pembangunan is null";
            $this->db->query($sql);
            return true;
        }
        public function data_tipe_edit(){
            $sql="SELECT id_rancangan_pembangunan as id, nama_tipe_pembangunan, pembangunan, jumlah, satuan, lama_pengerjaan FROM tipe_pembangunan, rancangan_pembangunan where tipe_pembangunan.id_tipe_pembangunan=rancangan_pembangunan.id_tipe_pembangunan and rancangan_pembangunan.id_tipe_pembangunan='".$this->session->userdata['id1']."'";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $key => $value) {
                $data['tipe']=$value->nama_tipe_pembangunan;
                $data['pembangunan'][$value->id]['pembangunan']=$value->pembangunan;
                $data['pembangunan'][$value->id]['jumlah']=$value->jumlah." ".$value->satuan;
                $data['pembangunan'][$value->id]['lama_pengerjaan']=$value->lama_pengerjaan;
            }
            $sql="SELECT id_rancangan_anggaran as id, nama_barang, jumlah, satuan, anggaran_biaya FROM tipe_pembangunan, rancangan_anggaran where tipe_pembangunan.id_tipe_pembangunan=rancangan_anggaran.id_tipe_pembangunan and rancangan_anggaran.id_tipe_pembangunan='".$this->session->userdata["id1"]."'";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $key => $value) {
                $data['anggaran'][$value->id]['nama_barang']=$value->nama_barang;
                $data['anggaran'][$value->id]['jumlah']=$value->jumlah." ".$value->satuan;
                $data['anggaran'][$value->id]['anggaran_biaya']=$value->anggaran_biaya;
            }
            return $data;
        }
        public function data_edit_pekerjaan(){
            $post = $this->input->post();
            if($post['pembangunan']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['lama']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['pembangunan'],0,3).(date("dmis")+1);
            $sql="insert into rancangan_pembangunan values('$id','".$this->session->userdata['id1']."','".$post['pembangunan']."',".$post['jumlah'].",'".$post['satuan']."',".$post['lama'].")";
            return $this->db->query($sql);
        }
        public function data_edit_anggaran(){
            $post = $this->input->post();
            if($post['nama']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['anggaran']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['nama'],0,3).(date("dmis")+1);
            $sql="insert into rancangan_anggaran values('$id','".$this->session->userdata['id1']."','".$post['nama']."',".$post['jumlah'].",'".$post['satuan']."',".$post['anggaran'].")";
            return $this->db->query($sql);
        }
        public function edit_data_tipe(){
            $post = $this->input->post();
            $sql="update tipe_pembangunan set nama_tipe_pembangunan='".$post['tipe']."' where id_tipe_pembangunan='".$this->session->userdata['id1']."'";
            return $this->db->query($sql);
        }
        public function data_tipe_hapus($id){
            $sql="delete from rancangan_anggaran where id_tipe_pembangunan='$id'";
            $this->db->query($sql);
            $sql="delete from rancangan_pembangunan where id_tipe_pembangunan='$id'";
            $this->db->query($sql);
            $sql="delete from tipe_pembangunan where id_tipe_pembangunan='$id'";
            return $this->db->query($sql);
        }
        public function jumlahblok($link,$byk){
            $sql="select * from tipe_pembangunan";
            $data=$this->db->query($sql)->result();
            if($link=="Perumahan"){
                $huruf='A';
                for($i=0;$i<$byk;$i++){
                    ?>
                        <div class="col-md-12">
                            <label for="blok<?=$i?>">Jumlah Blok <?=$huruf?></label>
                            <input type="number" name="blok<?=$i?>" id="blok<?=$i?>" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="jenis<?=$i?>">Tipe Pembangunan Blok <?=$huruf?></label>
                            <select name="jenis<?=$i?>" id="jenis<?=$i?>" class="form-control">
                                <option value="">Pilih</option>
                                <?php
                                    foreach($data as $tipePembangunan){
                                        echo "<option value='$tipePembangunan->id_tipe_pembangunan'>$tipePembangunan->nama_tipe_pembangunan</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    <?php
                    $huruf++;
                }
            }
            else{
                ?>
                    <div class="col-md-12">
                        <label for="jenis0">Tipe Pembangunan Blok A</label>
                        <select name="jenis0" id="jenis0" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                                foreach($data as $tipePembangunan){
                                    echo "<option value='$tipePembangunan->id_tipe_pembangunan'>$tipePembangunan->nama_tipe_pembangunan</option>";
                                }
                            ?>
                        </select>
                    </div>
                <?php
            }
        }
        public function data_proyek_status($status){
            $username="and username='".$this->session->userdata('username')."'";
            if($this->session->userdata('username')=="admin") $username="";
            $sql="select data_proyek.id_data_proyek, nama_proyek, start_proyek, sum(lama_pengerjaan) as lama from data_proyek, blok, unit, target_pembangunan where data_proyek.id_data_proyek=blok.id_data_proyek and blok.id_blok=unit.id_blok and unit.id_unit=target_pembangunan.id_unit and status='$status' $username group by data_proyek.id_data_proyek order by start_proyek, nama_proyek";
            $data[0]=$this->db->query($sql)->result();
            $sql="select data_proyek.id_data_proyek, sum(anggaran) as anggaran from data_proyek, blok, unit, target_keuangan where data_proyek.id_data_proyek=blok.id_data_proyek and blok.id_blok=unit.id_blok and unit.id_unit=target_keuangan.id_unit and status='perancangan' $username group by data_proyek.id_data_proyek order by start_proyek, nama_proyek";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $value) {
                $data[1][$value->id_data_proyek]="Rp. ".number_format($value->anggaran,0,',','.');
            }
            return $data;
        }
        public function data_perancangan_lihat(){
            $sql="select * from pengguna, data_proyek, blok, unit, target_pembangunan where pengguna.username=data_proyek.username and data_proyek.id_data_proyek=blok.id_data_proyek and blok.id_blok=unit.id_blok and unit.id_unit=target_pembangunan.id_unit and data_proyek.id_data_proyek='".$this->session->userdata('id')."'";
            $sementara=$this->db->query($sql)->result();
            $byk=0;
            foreach ($sementara as $key => $value) {
                $data['proyek']['nama_pengguna']=$value->nama_pengguna;
                $data['proyek']['foto']=$value->foto;
                $data['proyek']['nama_proyek']=$value->nama_proyek;
                $data['proyek']['jenis_proyek']=$value->jenis_proyek.".png";
                $data['proyek']['lokasi']=$value->lokasi;
                $data['proyek']['hari']=$value->start_proyek;
                $data['blok'][$value->id_blok]=$value->nama_blok;
                $data['unit'][$value->id_blok][$value->id_unit]=$value->nama_unit;
                $data['pekerjaan'][$value->id_unit][$key]['id_target_pembangunan']=$value->id_target_pembangunan;
                $data['pekerjaan'][$value->id_unit][$key]['pembangunan']=$value->pembangunan;
                $data['pekerjaan'][$value->id_unit][$key]['jumlah']=$value->jumlah;
                $data['pekerjaan'][$value->id_unit][$key]['satuan']=$value->satuan;
                $data['pekerjaan'][$value->id_unit][$key]['lama_pengerjaan']=$value->lama_pengerjaan." Hari";
                $byk+=$value->lama_pengerjaan;
            }
            $data['proyek']['lama']=$byk." Hari";
            $sql="select * from data_proyek, blok, unit, target_keuangan where data_proyek.id_data_proyek=blok.id_data_proyek and blok.id_blok=unit.id_blok and unit.id_unit=target_keuangan.id_unit and data_proyek.id_data_proyek='".$this->session->userdata('id')."'";
            $sementara=$this->db->query($sql)->result();
            $byk=0;
            foreach ($sementara as $key => $value) {
                $data['anggaran'][$value->id_unit][$key]['id_target_keuangan']=$value->id_target_keuangan;
                $data['anggaran'][$value->id_unit][$key]['nama_barang']=$value->nama_barang;
                $data['anggaran'][$value->id_unit][$key]['jumlah']=$value->jumlah." ".$value->satuan;
                $data['anggaran'][$value->id_unit][$key]['anggaran']=$value->anggaran;
                $byk+=$value->anggaran;
            } 
            $data['proyek']['anggaran']="Rp. ".number_format($byk,0,',','.');
            date_default_timezone_set('Asia/Jakarta');
            $end_date = new DateTime(date("Y-m-d"));
            $start_date = new DateTime($data['proyek']['hari']);
            $interval = $start_date->diff($end_date);
            $data['proyek']['hari']=$interval->days;
            return $data;
        }
        public function tambah_target_pekerjaan(){
            $post = $this->input->post();            
            if($post['pembangunan']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['lama']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['pembangunan'],0,3).(date("dmis")+1);
            $sql="insert into target_pembangunan values('$id','".$this->session->userdata('id1')."','".$post['pembangunan']."',".$post['jumlah'].",'".$post['satuan']."',".$post['lama'].")";
            return $this->db->query($sql);
        }
        public function data_target_pembangunan($where="id_target_pembangunan"){
            $this->session->unset_userdata('data_target');
            $sql = "select * from target_pembangunan where $where='".$this->session->userdata('id1')."'";
            return $this->db->query($sql)->result();
        }
        public function edit_target_pekerjaan(){
            $post = $this->input->post();            
            $sql="update target_pembangunan set pembangunan='".$post['pembangunan']."', jumlah=".$post['jumlah'].", satuan='".$post['satuan']."', lama_pengerjaan=".$post['lama']." where id_target_pembangunan='".$this->session->userdata('id1')."'";
            return $this->db->query($sql);
        }
        public function hapus_target_pekerjaan($id){
            $sql = "delete from target_pembangunan where id_target_pembangunan='$id'";
            return $this->db->query($sql);
        }
        public function start_rancangan_proyek(){
            date_default_timezone_set('Asia/Jakarta');
            $sql="update data_proyek set status='pembangunan', start_proyek='".date('Y-m-d')."' where id_data_proyek='".$this->session->userdata('id')."'";
            return $this->db->query($sql);
        }
        public function tambah_rancangan_anggaran(){
            $post = $this->input->post();            
            if($post['nama']=="" || $post['jumlah']=="" || $post['satuan']=="" || $post['anggaran']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['nama'],0,3).(date("dmis")+1);
            $sql="insert into target_keuangan values('$id','".$this->session->userdata('id1')."','".$post['nama']."',".$post['jumlah'].",'".$post['satuan']."',".$post['anggaran'].")";
            return $this->db->query($sql);
        }
        public function data_target_keuangan($where="id_target_keuangan"){        
            $sql = "select * from target_keuangan where $where='".$this->session->userdata('id1')."'";
            return $this->db->query($sql)->result();
        }
        public function edit_rancangan_anggaran(){
            $post = $this->input->post();            
            $sql="update target_keuangan set nama_barang='".$post['nama']."', jumlah=".$post['jumlah'].", satuan='".$post['satuan']."', anggaran=".$post['anggaran']." where id_target_keuangan='".$this->session->userdata('id1')."'";
            return $this->db->query($sql);
        }
        public function hapus_rancangan_anggaran($id){
            $sql = "delete from target_keuangan where id_target_keuangan='$id'";
            return $this->db->query($sql);
        }
        public function data_proyek(){
            $sql = "select * from data_proyek where id_data_proyek='".$this->session->userdata('id')."'";
            return $this->db->query($sql)->result();
        }
        public function edit_data_perancangan(){
            $post = $this->input->post(); 
            $sql = "update data_proyek set username='".$post['mandor']."', nama_proyek='".$post['nama']."', lokasi='".$post['lokasi']."' where id_data_proyek='".$this->session->userdata('id')."'";
            return $this->db->query($sql);
        }
        public function hapus_data_perancangan($id){
            $sql = "select id_unit from data_proyek, blok, unit where data_proyek.id_data_proyek=blok.id_data_proyek and blok.id_blok=unit.id_blok and data_proyek.id_data_proyek='$id'";
            $data=$this->db->query($sql)->result();
            $where="";
            foreach ($data as $value) {
                $where=$where." id_unit='$value->id_unit' and";
            }
            $sql = "delete from target_pembangunan where ".substr($where,0,-3);
            $this->db->query($sql);
            $sql = "delete from target_keuangan where ".substr($where,0,-3);
            $this->db->query($sql);
            $sql = "delete from unit where ".substr($where,0,-3);
            $this->db->query($sql);
            $sql = "delete from blok where id_data_proyek='$id'";
            $this->db->query($sql);
            $sql = "delete from data_proyek where id_data_proyek='$id'";
            $this->db->query($sql);
            return true;
        }
        public function data_pembangunan_proyek(){
            $sementara=$this->main_model->data_proyek_status("pembangunan");
            date_default_timezone_set('Asia/Jakarta');
            $data[0]=null;
            foreach ($sementara[0] as $key => $value) {
                $end_date = new DateTime(date("Y-m-d"));
                $start_date = new DateTime($value->start_proyek);
                $interval = $start_date->diff($end_date);
                $data[$key]["id_data_proyek"]=$value->id_data_proyek;
                $data[$key]["nama_proyek"]=$value->nama_proyek;
                $tanggal=explode("-",$value->start_proyek);
                $data[$key]["start_proyek"]=$tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
                $data[$key]["sisa"]=$value->lama-$interval->days." hari";
            }
            return $data;
        }
        public function lihat_data_pembangunan(){
            $data=$this->main_model->data_perancangan_lihat();
            $whereperkembangan="";
            $wherepengeluaran="";
            foreach ($data['blok'] as $key => $value) {
                foreach ($data['unit'][$key] as $key1 => $value1) {
                    foreach ($data['pekerjaan'][$key1] as $value2) {
                        $whereperkembangan=$whereperkembangan." id_target_pembangunan='".$value2["id_target_pembangunan"]."' or";
                        $data["perkembangan"][$value2["id_target_pembangunan"]]=0;
                    }
                    foreach ($data['anggaran'][$key1] as $value2) {
                        $wherepengeluaran=$wherepengeluaran." id_target_keuangan='".$value2["id_target_keuangan"]."' or";
                        $data["pengeluaran"][$value2["id_target_keuangan"]]=0;
                    }
                }
            }
            $sql = "select sum(jumlah) as jumlah, id_target_pembangunan from perkembangan_pembangunan where".substr($whereperkembangan,0,-3)."group by id_target_pembangunan";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $value) {
                $data["perkembangan"][$value->id_target_pembangunan]=$value->jumlah;
            }
            $sql = "select sum(biaya) as biaya, id_target_keuangan from pengeluaran_keuangan where".substr($wherepengeluaran,0,-3)."group by id_target_keuangan";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $value) {
                $data["pengeluaran"][$value->id_target_keuangan]=$value->biaya;
            }
            $sql = "select * from evaluasi where id_data_proyek='".$this->session->userdata('id')."'";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $key => $value) {
                $data["evalueasi"][$key]['problem']=$value->problem;
                $data["evalueasi"][$key]['masukkan']=$value->masukkan;
                $data["evalueasi"][$key]['id_evaluasi']=$value->id_evaluasi;
            }
            // echo "<pre>";print_r($data);
            return $data;
        }
        public function tambah_evaluasi_proyek(){
            $post = $this->input->post(); 
            if($post['masalah']=="" || $post['masukkan']==""){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $id=substr($post['masalah'],0,3).(date("dmis")+1);
            $sql = "insert into evaluasi values('$id','".$this->session->userdata('id')."','".$post['masalah']."','".$post['masukkan']."')";
            return $this->db->query($sql); 
        }
        public function data_evaluasi(){
            $sql = "select * from evaluasi where id_evaluasi='".$this->session->userdata('id1')."'";
            return $this->db->query($sql)->result(); 
        }
        public function edit_evaluasi_proyek(){ 
            $post = $this->input->post();
            $sql = "update evaluasi set problem='".$post['masalah']."', masukkan='".$post['masukkan']."' where id_evaluasi='".$this->session->userdata('id1')."'";
            return $this->db->query($sql);
        }
        public function hapus_evaluasi_proyek($id){
            $sql = "delete from evaluasi where id_evaluasi='$id'";
            echo $sql;
            return $this->db->query($sql);
        }
        public function monitoring_proyek(){
            $data=$this->main_model->lihat_data_pembangunan();
            return $data;
        }
        public function cekproyek(){
            $post = $this->input->post(); 
            $sql = "select * from data_proyek where id_data_proyek='".$post['id_pencarian']."' and status='pembangunan'";
            $data=$this->db->query($sql)->result();
            if(count($data)>0){
                $this->session->set_userdata('id',$post['id_pencarian']);
                return "proyek";
            }
            else{
                $sql = "select * from data_proyek, blok, unit where data_proyek.id_data_proyek=blok.id_data_proyek and blok.id_blok=unit.id_blok and id_unit='".$post['id_pencarian']."' and status='pembangunan'";
                $data=$this->db->query($sql)->result();
                if(count($data)>0){
                    $this->session->set_userdata('id1',$post['id_pencarian']);
                    return "unit";
                }
            }
            $this->session->set_userdata(['error' => "Id proyek atau unit tidak ditemukan"]);
            return false;
        }
        public function monitoring_unit(){
            // $sql = "select nama_unit, pembangunan, target_pembangunan.jumlah, satuan, data_foto, perkembangan_pembangunan.jumlah, tanggal_pembangunan from unit,target_pembangunan, perkembangan_pembangunan where unit.id_unit=target_pembangunan.id_unit and target_pembangunan.id_target_pembangunan=perkembangan_pembangunan.id_target_pembangunan and unit.id_unit='".$this->session->userdata('id1')."'";
            $sql = "select nama_unit, id_target_pembangunan, jumlah, pembangunan, satuan from unit,target_pembangunan where unit.id_unit=target_pembangunan.id_unit and unit.id_unit='".$this->session->userdata('id1')."'";
            $sementara=$this->db->query($sql)->result();
            $where="";
            $bulan=["01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember"];
            foreach ($sementara as $value) {
                $where=$where." id_target_pembangunan='$value->id_target_pembangunan' or";
                $data['data']['nama']=$value->nama_unit;
                $data['data']['pembangunan'][$value->id_target_pembangunan]=$value->pembangunan;
                $data['data']['satuan'][$value->id_target_pembangunan]=$value->satuan;
                $data['pembangunan'][$value->id_target_pembangunan]=$value->jumlah;
                $data['jumlah'][$value->id_target_pembangunan]=0;
            }
            $sql="select id_target_pembangunan, data_foto, jumlah, tanggal_pembangunan from perkembangan_pembangunan where".substr($where,0,-3);
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $key => $value) {
                $data['perkembangan'][$key]['id']=$value->id_target_pembangunan;
                $data['perkembangan'][$key]['data_foto']=$value->data_foto;
                $data['perkembangan'][$key]['jumlah']=$value->jumlah;
                $tanggal=explode("-",$value->tanggal_pembangunan);
                $data['perkembangan'][$key]['tanggal_pembangunan']=$tanggal[2]." ".$bulan[$tanggal[1]]." ".$tanggal[0];
                $data['jumlah'][$value->id_target_pembangunan]+=$value->jumlah;;
            }
            $total=0;
            foreach ($data['pembangunan'] as $key => $value) {
                if($value<=$data['jumlah'][$key]) $persentase=100;
                else $persentase=($data['jumlah'][$key]/$value)*100;
                $total+=$persentase;
            }
            $sql="select * from pembayaran where id_unit='".$this->session->userdata('id1')."'";
            $sementara=$this->db->query($sql)->result();
            foreach ($sementara as $key => $value) {
                $data['pembayaran'][$value->id_pembayaran]["bon"]=$value->bon_pembayaran;
                $data['pembayaran'][$value->id_pembayaran]["tanggal"]=$value->tanggal;
            }
            $total=number_format($total/count($data['pembangunan']),2);
            $data['selesai']=$total;
            $data['belumselesai']=100-$total;
            return ($data);
        }
        public function pekerjaan_belum_selesai(){
            $data = $this->main_model->monitoring_unit(); 
            return $data;
        }
        public function tambah_target_selesai($data1,$data2){
            if($this->session->userdata('data_target') === null){
                $data[$data1]=$data2;
            }
            elseif($data2=="hapus"){
                $data=$this->session->userdata('data_target');
                unset($data[$data1]);
            }
            else{
                $data=$this->session->userdata('data_target');
                if(key_exists($data1,$data)) $data[$data1]=$data[$data1]+$data2;
                else $data[$data1]=$data2;
            }            
            $this->session->set_userdata('data_target',$data);
            $key=array_keys($data);
            $query="select pembangunan,satuan,id_target_pembangunan from target_pembangunan where id_target_pembangunan='".join("' or id_target_pembangunan='",$key)."'";
            $sementara=$this->db->query($query)->result();
            echo "<table>";
            foreach ($sementara as $key1 => $value) {
                echo "<tr>";
                echo "<td width=30>".($key1+1)."</td>";
                echo "<td width=400>".$value->pembangunan."(".$data[$value->id_target_pembangunan].$value->satuan.")</td>";
                echo "<td width=30>";
                    ?>
                        <a href='javascript:void(0)' onclick="hapus_perkembangan_proyek('<?=site_url()?>','<?=$key[$key1]?>')">Hapus</a>
                    <?php
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        public function upload_bukti_pembayaran(){
            if($_FILES['tambah']['size']==0){
                $this->session->set_userdata(['error' => "Data tidak lengkap"]);
                return false;
            }
            $unit=$this->session->userdata('id1');
            $nama = $_FILES['tambah']['name'];
            $id=substr($nama,0,3).(date("dmis")+1);
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $nama=$id.".".$ekstensi; 
            $config['upload_path']="./images/bukti_pembayaran";
            $config["allowed_types"]="gif|jpg|png|jpeg";
            $config['file_name'] = $id;
            $config['max_size'] = 20000;
            $this->load->library('upload',$config);
            if ( ! $this->upload->do_upload('tambah')){
                $this->session->set_userdata(['error' => $this->upload->display_errors()]);
                return false;
            } 
            date_default_timezone_set('Asia/Jakarta');
            $query="insert into pembayaran values ('$id','$unit','$nama','".date("Y-m-d")."')";
            return $this->db->query($query);
        }
        public function data_perkembangan_proyek(){
            
            return $this->db->query($query)->result();
        }
        public function data_edit_target(){
            $query = "select pembangunan, perkembangan_pembangunan.jumlah, tanggal_pembangunan, id_perkembangan_pembangunan from perkembangan_pembangunan,target_pembangunan where perkembangan_pembangunan.id_target_pembangunan=target_pembangunan.id_target_pembangunan and perkembangan_pembangunan.id_target_pembangunan='".$this->session->userdata('id1')."' order by id_perkembangan_pembangunan";
            return $this->db->query($query)->result();
        }
        public function edit_target_projek(){
            $post = $this->input->post(); 
            unset($post['simpan']);
            foreach ($post as $key => $value) {
                $query = "update perkembangan_pembangunan set jumlah='$value' where id_perkembangan_pembangunan='$key' ";
                $this->db->query($query);
            }
            return true;
        } 
    }