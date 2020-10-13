<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/section1.php") ?>
            <section class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="mb-5">
                            <h2 class="footer-heading mb-4">Monitor projekmu disini!!</h2>
                            <form action="" method="post" class="footer-suscribe-form">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Id Project atau Id_unit" aria-describedby="button-addon2" name="id_pencarian" id="id_pencarian" autocomplete="off">
                                    <div class="input-group-append">
                                        <input type="submit" name="submit" value="Cari" class="btn btn-primary text-white" id="button-addon2">
                                    </div>
                                </div>
                            </form> 
                        </div>
                        <!-- <div class="col-md-4 ml-auto">
                            <div class="year-experience-99301">
                                <h2 class="heading-39291">Banyak project yang telah diselesaikan</h2>
                                <span class="text">
                                    Setahun 
                                    <span>terakhir</span>
                                </span>
                                <span class="number">
                                    <span>0</span>
                                </span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <section id="myModal" class="modal login">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Form login</h2>
                        <span class="close" onclick="modalnone()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12 mb-5" >
                            <form action="" method="post">
                            <div class="form-group row">
                                <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="username" name="username" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                <input type="password" class="form-control" placeholder="password" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 mr-auto">
                                <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Login">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p>Lupa Password? Hubungi Admin</p>
                    </div>
                </div>
            </section>
            <?php $this->load->view("_partials/popup.php") ?>
            <?php $this->load->view("_partials/footer.php") ?>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
        <script>
            var modal = document.getElementById("myModal");
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </body>
</html>
