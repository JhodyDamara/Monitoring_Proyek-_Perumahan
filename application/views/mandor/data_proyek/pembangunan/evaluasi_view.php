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
                            <h1 class="heading-39291">Evaluasi <br> Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <p>
                                    <?php
                                        foreach ($tampil1 as $tampil1) echo $tampil1->nama_proyek;
                                    ?> 
                                </p>
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Masukkan</th>
                                    </tr>
                                    <?php
                                        if(empty($tampil)) echo "<tr><td colspan='3'>Belum memiliki evaluasi</td></tr>";
                                        $no=1;
                                        $total=0;
                                        foreach ($tampil as $tampil){
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$tampil->problem?></td>
                                                    <td><?=$tampil->masukkan?></td>
                                                </tr>
                                            <?php
                                            $no++;
                                        }    
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>