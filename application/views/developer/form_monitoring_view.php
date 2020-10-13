<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <section class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="mb-5">
                            <h1 class="footer-heading mb-4">Form Monitoring Proyek</h1>
                            <!-- <h2 >Monitor projekmu disini!!</h2> -->
                            <form action="" method="post" class="footer-suscribe-form">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Id Project atau Id_unit" aria-describedby="button-addon2" name="id_pencarian" id="id_pencarian" autocomplete="off">
                                    <div class="input-group-append">
                                        <input type="submit" name="submit" value="Cari" class="btn btn-primary text-white" id="button-addon2">
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </section>
            <?php $this->load->view("_partials/popup.php") ?>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>