<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <div class="site-section">
                <div class="container">
                    <div class="row mb-5 align-items-center">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Tambah Perancangan <br> Pembangunan</h1>
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
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="pembangunan">Pembangunan</label>
                                                <input type="text" name="pembangunan" id="pembangunan" class="form-control" autocomplete="off">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" name="jumlah" id="jumlah" class="form-control" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" name="satuan" id="satuan" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-10">
                                                <label for="lama">Lama Pengerjaan</label>
                                                <input type="number" name="lama" id="lama" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="col-md-2">
                                                <br><br>
                                                <p>/Hari</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 mr-auto">
                                                <input type="submit" name="simpan" id="simpan" value="simpan" class="btn btn-block btn-primary text-white py-3 px-5">
                                                <input type="reset" name="reset" id="reset" value="reset" class="btn btn-block btn-primary text-white py-3 px-5">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view("_partials/popup.php") ?>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>