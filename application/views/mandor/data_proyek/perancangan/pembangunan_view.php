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
                            <h1 class="heading-39291">Rancangan Pembangunan</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Pembangunan</th>
                                        <th>Jumlah Item</th>
                                        <th>Lama Pengerjaan</th>
                                    </tr> 
                                    <?php 
                                        if(empty($rancanganpembangunan)) echo "<tr><td colspan='5'>Belum memiliki Rancangan Pembangunan</td></tr>";
                                        $no=1;
                                        foreach ($rancanganpembangunan as $rancanganpembangunan):
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$rancanganpembangunan->pembangunan?></td>
                                                    <td><?=$rancanganpembangunan->jumlah." ".$rancanganpembangunan->satuan?></td>
                                                    <td><?=$rancanganpembangunan->lama_pengerjaan?> Hari</td>
                                                </tr>
                                            <?php
                                            $no++;
                                        endforeach;
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
