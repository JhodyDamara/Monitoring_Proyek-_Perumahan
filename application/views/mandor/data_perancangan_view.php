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
                            <h1 class="heading-39291">Data Perancangan <br> Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Proyek</th>
                                        <th>Lama Pengerjaan</th>
                                        <th>Anggaran Biaya</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                        if(empty($data_perancangan_proyek[0])) echo "<td colspan='5'>Belum memiliki proyek</td>";
                                        foreach ($data_perancangan_proyek[0] as $key => $value){
                                            echo "<tr>";
                                            echo "<td>".($key+1)."</td>";    
                                            echo "<td>$value->nama_proyek</td>";
                                            echo "<td>$value->lama Hari</td>";
                                            echo "<td>".$data_perancangan_proyek[1][$value->id_data_proyek]."</td>";
                                            echo "<td>";
                                                ?>
                                                    <a href="<?=site_url('mandor/data_perancangan_proyek/lihat_data_perancangan/'.$value->id_data_proyek)?>">Lihat</a>
                                                <?php
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </table>
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