<!doctype html>
<html lang="en"> 
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <div class="site-section">
                <div class="container">
                    <div class="row mb-5 align-items-center">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Edit Pembangunan <br>Proyek</h1>
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
                                            $data=$this->uri->segments;
                                            $id=count($data)-2;
                                            foreach ($tambah_pembangunan_edit as $value) {
                                                ?>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="pembangunan">Pembangunan</label>
                                                            <input type="text" name="pembangunan" id="pembangunan" autocomplete="off" value="<?=$value->pembangunan?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" name="jumlah" id="jumlah" step="0.01" autocomplete="off" value="<?=$value->jumlah?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="satuan">Satuan</label>
                                                            <input type="text" name="satuan" id="satuan" autocomplete="off" value="<?=$value->satuan?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="lama">Lama Pengerjaan</label>
                                                            <input type="number" name="lama" id="lama" autocomplete="off" value="<?=$value->lama_pengerjaan?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12 mr-auto">
                                                            <input type="submit" name="simpan" id="simpan" value="Simpan" class="btn btn-block btn-primary text-white py-3 px-5">
                                                            <a href="<?=site_url('developer/data_tipe_pembangunan/'.$data[$id])?>" class="btn btn-block btn-primary text-white py-3 px-5">Kembali</a>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
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