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
                            <h1 class="heading-39291">Tipe Pembangunan <br> Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                            <p class="my-5"><a href="<?=site_url('developer/data_tipe_pembangunan/tambah')?>" class="more-39291">Tambah Tipe Pembangunan</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr> 
                                        <th>No</th>
                                        <th>Tipe</th>
                                        <th>Lama Pengerjaan</th>
                                        <th>Total Biaya</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php 
                                        if($data_tipe_pembangunan===null) echo "<tr><td colspan=5>Belum Memiliki Tipe Proyek</td></tr>";
                                        else{
                                            $i=1;
                                        foreach ($data_tipe_pembangunan as $key => $value){
                                            echo "<tr>";
                                            echo "<td>$i</td>";
                                            echo "<td>".$value['tipe']."</td>";
                                            echo "<td>".$value['lama']." Hari</td>";
                                            echo "<td>Rp ".number_format($value['biaya'],0,',','.')."</td>";
                                            echo "<td>";
                                                ?>
                                                    <a href="<?=site_url('developer/data_tipe_pembangunan/edit/'.$key)?>">Edit</a>
                                                    /
                                                    <a href='#!' onclick="deletekonfirm('<?=site_url('developer/data_tipe_pembangunan/hapus/'.$key)?>')">Hapus</a>
                                                <?php
                                            echo "</td>";
                                            echo "</tr>";
                                            $i++;
                                        }}
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