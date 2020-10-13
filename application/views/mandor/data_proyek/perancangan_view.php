<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>    
            <div class="site-section section-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h1 class="heading-39291">Detai Perancangan</h1>
                            <cite><span class="text-black"><?php $this->load->view("_partials/breadcrumb.php") ?></span></cite>
                            <p><a href="<?=site_url('mandor/data_proyek/perancangan/pembangunan')?>" class="more-39291">Pembangunan</a></p>
                            <p><a href="<?=site_url('mandor/data_proyek/perancangan/anggaran')?>" class="more-39291">Anggaran</a></p>
                        </div>
                        <div class="col-md-12 text-center">
                            <?php   
                                foreach ($perancangan as $perancangan): 
                                    ?>
                                        <p>Nama Proyek : <?=$perancangan->nama_proyek?></p>
                                        <p>Penanggung Jawab : <?=$perancangan->nama_pengguna?></p>
                                        <p>Jenis Pembangunan : <?=$perancangan->jenis_proyek?></p>
                                        <p>Lokasi : <?=$perancangan->lokasi?></p>
                                        <p>
                                            Lama Pembangunan :
                                            <?php
                                                $lama=0;
                                                foreach ($rancanganpembangunan as $rancanganpembangunan):
                                                    $lama=$lama+$rancanganpembangunan->lama_pengerjaan;
                                                endforeach;
                                                echo $lama;
                                            ?>
                                            hari
                                        </p>
                                        <p>
                                            Biaya Pembangunan : Rp.
                                            <?php
                                                $biaya=0;
                                                foreach ($keuangan as $keuangan):
                                                    $biaya+=$keuangan->anggaran;
                                                endforeach;
                                                echo number_format($biaya,0,",",".");
                                            ?>
                                        </p>
                                    <?php
                                endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>