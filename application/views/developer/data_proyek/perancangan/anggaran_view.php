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
                            <h1 class="heading-39291">Rancangan Anggaran</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                            <p class="my-5"><a href="<?=site_url('developer/data_proyek/perancangan/anggaran/tambah_anggaran')?>" class="more-39291">Tambah Anggaran</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Biaya</th>
                                        <th>aksi</th>
                                    </tr> 
                                    <?php 
                                        if(empty($tampil)) echo "<tr><td colspan='5'>Belum Memiliki Anggaran</td></tr>";
                                        $no=1;
                                        foreach ($tampil as $tampil):
                                            ?>
                                                <tr> 
                                                    <td><?=$no?></td>
                                                    <td><?=$tampil->nama_barang?></td>
                                                    <td><?=$tampil->jumlah." ".$tampil->satuan?></td>
                                                    <td>Rp. <?=number_format($tampil->anggaran,0,",",".")?></td>
                                                    <td>
                                                        <a href="<?=site_url('developer/data_proyek/perancangan/anggaran/edit_anggaran/'.$tampil->id_target_keuangan)?>">Edit</a>
                                                        /
                                                        <a href="#!" onclick="deletekonfirm('<?=site_url('developer/data_proyek/perancangan/anggaran/hapus_anggaran/'.$tampil->id_target_keuangan)?>')">Hapus</a>
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