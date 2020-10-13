<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" onload="jumlahblok('<?=site_url('developer/jumlahblok')?>')">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <div class="site-section">
                <div class="container">
                    <div class="row mb-5 align-items-center">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Edit Data <br>Proyek</h1>
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
                                            foreach ($data_proyek as $value) {
                                                ?>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="mandor">Mandor</label>
                                                            <select name="mandor" id="mandor" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <?php
                                                                    foreach ($mandor as $mandor):
                                                                        ?>
                                                                            <option value="<?=$mandor->username?>" <?=$value->username==$mandor->username ? 'selected': '' ?>><?=$mandor->nama_pengguna?></option>
                                                                        <?php
                                                                    endforeach;
                                                                ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="nama">Nama Proyek</label>
                                                            <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$value->nama_proyek?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="lokasi">Lokasi</label>
                                                            <input type="text" name="lokasi" id="lokasi" class="form-control" autocomplete="off" value="<?=$value->lokasi?>">
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row">
                                                        <div class="col-md-12 mr-auto">
                                                            <input type="submit" name="simpan" id="simpan" value="simpan" class="btn btn-block btn-primary text-white py-3 px-5">
                                                            <input type="reset" name="reset" id="reset" value="reset" class="btn btn-block btn-primary text-white py-3 px-5">
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