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
                            <p class="my-5"><a href="<?=site_url('admin/data_proyek/perancangan/pembangunan/tambah_pembangunan')?>" class="more-39291">Tambah Pembangunan</a></p>
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
                                        <th>Aksi</th>
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
                                                    <td>
                                                        <a href="<?=site_url('admin/data_proyek/perancangan/pembangunan/edit_pembangunan/'.$rancanganpembangunan->id_target_pembangunan)?>">Edit</a>
                                                        /
                                                        <a href="#!" onclick="deletekonfirm('<?=site_url('admin/data_proyek/perancangan/pembangunan/hapus_pembangunan/'.$rancanganpembangunan->id_target_pembangunan)?>')">Hapus</a>
                                                    </td>
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
            <?php $this->load->view("_partials/popup.php") ?>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>
