<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <?php 
            $i=0;
            foreach ($mandor as $mandor):
                $data[$i][0]=$mandor->username;
                $data[$i][1]=$mandor->nama_pengguna;
                $i++;
            endforeach;
        ?>
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <div class="site-section">
                <div class="container">
                    <div class="row mb-5 align-items-center">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Update Data<br>Proyek</h1>
                        </div>
                        <div class="col-md-5 text-right">
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                </div>
                <div class="media-29191" style="margin-top:80px">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-7">
                                <div class="text">
                                    <form action="" method="post">
                                        <?php
                                            foreach ($update as $update):
                                                ?>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="mandor">Mandor</label>
                                                            <select name="mandor" id="mandor" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <?php
                                                                    foreach($data as $key => $value){
                                                                        $selected="";
                                                                        if($value[0]==$update->username)$selected="selected";
                                                                        echo "<option value='$value[0]' $selected>$value[1]</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div> 
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="jenis">Jenis Pembangunan</label>
                                                            <select name="jenis" id="jenis" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option value="Rumah" <?php if($update->jenis_proyek=="Rumah")echo "selected"?>>Rumah</option>
                                                                <option value="Ruko" <?php if($update->jenis_proyek=="Ruko")echo "selected"?>>Ruko</option>
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="nama">Nama Proyek</label>
                                                            <input type="text" name="nama" id="nama" value="<?=$update->nama_proyek?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="lokasi">Lokasi</label>
                                                            <input type="text" name="lokasi" id="lokasi" value="<?=$update->lokasi?>" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12 mr-auto">
                                                            <input type="submit" name="simpan" id="simpan" value="simpan" class="btn btn-block btn-primary text-white py-3 px-5">
                                                            <input type="reset" name="reset" id="reset" value="reset" class="btn btn-block btn-primary text-white py-3 px-5">
                                                        </div>
                                                    </div>
                                                <?php
                                            endforeach;    
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html> 