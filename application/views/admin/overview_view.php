<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <div class="site-section">
                <div class="container">
                    <div class="row  mb-5">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Menu Admin</h1>
                            <p>Biodata</p>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            foreach ($profile as $profile):
                                ?>
                                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="">
                                        <div class="media-92812">
                                            <img src="<?=base_url('images/pengguna/'.$profile->foto)?>" alt="foto profile" class="img-fluid">
                                        </div>
                                    </div>          
                                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="">
                                        <div class="media-92812">
                                            <div class="text">
                                                <span class="caption">User</span>
                                                <h3><?=$profile->nama_pengguna?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            endforeach;
                        ?>                
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>