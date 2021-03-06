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
                            <h1 class="heading-39291">Edit Rancangan Biaya <br> Proyek</h1>
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
                                            foreach ($data_target_keuangan as $value) {
                                                ?>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="nama">Nama Barang</label>
                                                            <input type="text" name="nama" id="nama" autocomplete="off" class="form-control" value="<?=$value->nama_barang?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" name="jumlah" id="jumlah" autocomplete="off" class="form-control" value="<?=$value->jumlah?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="satuan">Satuan</label>
                                                            <input type="text" name="satuan" id="satuan" autocomplete="off" class="form-control" value="<?=$value->satuan?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="anggaran">Anggaran Biaya</label>
                                                            <input type="number" name="anggaran" id="anggaran" autocomplete="off" class="form-control" value="<?=$value->anggaran?>">
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
        <?php $this->load->view("_partials/popup.php") ?>
        <?php $this->load->view("_partials/js.php") ?>
        <script>
            document.getElementById("formblok").hidden=true;
        </script>
    </body>
</html>