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
                            <h1 class="heading-39291">Data Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                            <p class="my-5"><a href="<?=site_url('admin/data_proyek/tambah_data_proyek')?>" class="more-39291">Tambah Data Proyek</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th> 
                                        <th>Jenis Pembangunan</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr> 
                                    <?php 
                                        if(empty($proyek)) echo "<td colspan='5'>Belum memiliki proyek</td>";
                                        $i=1;
                                        foreach ($proyek as $proyek): 
                                            echo "<tr>";
                                            echo "<td>".$i."</td>";    
                                            echo "<td><img src='".base_url('images/'.$proyek->jenis_proyek).".png' alt='image' class='img-fluid' width='100px'></td>";
                                            echo "<td>".$proyek->lokasi."</td>";
                                            echo "<td>".$proyek->status."</td>";
                                            ?>
                                                <td>
                                                    <a href="<?=site_url('admin/data_proyek/update/'.$proyek->id_data_proyek)?>">Update</a>
                                                    /
                                                    <a href="#!" onclick="deletekonfirm('<?=site_url('admin/data_proyek/hapus_proyek/'.$proyek->id_data_proyek)?>')">Delete</a>
                                                    /
                                                    <a href="<?=site_url('admin/data_proyek/'.$proyek->status."/".$proyek->id_data_proyek)?>">Detail</a>
                                                </td>
                                            <?php
                                            echo "</tr>";
                                            $i++;
                                        endforeach;
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

