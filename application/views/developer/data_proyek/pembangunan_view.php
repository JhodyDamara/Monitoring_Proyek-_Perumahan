<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>    
            <div class="site-section section-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h1 class="heading-39291">Detai Pembangunan <br> Proyek</h1>
                            <cite><span class="text-black"><?php $this->load->view("_partials/breadcrumb.php") ?></span></cite>
                            <p><a href="<?=site_url('developer/data_proyek/pembangunan/perkembangan_pembangunan')?>" class="more-39291">Perkembangan Pembangunan</a></p>
                            <p><a href="<?=site_url('developer/data_proyek/pembangunan/pengeluaran_keuangan')?>" class="more-39291">Pengeluaran Keuangan</a></p>
                            <p><a href="<?=site_url('developer/data_proyek/pembangunan/evaluasi')?>" class="more-39291">evaluasi</a></p>
                        </div>
                        <div class="col-md-12 text-center">
                            <?php   
                                date_default_timezone_set('Asia/Jakarta');
                                foreach ($perancangan as $perancangan): 
                                    $tanggal = new DateTime($perancangan->start_proyek); 
                                    $sekarang = new DateTime(date("Y-m-d"));
                                    $perbedaan = $tanggal->diff($sekarang);
                                    ?>
                                        <h2 class="heading-39291">Id proyek : <?=$perancangan->id?></h2>
                                        <p>Nama Proyek : <?=$perancangan->nama_proyek?></p>
                                        <p>Penanggung Jawab : <?=$perancangan->nama_pengguna?></p>
                                        <p>Jenis Pembangunan : <?=$perancangan->jenis_proyek?></p>
                                        <p>Lokasi : <?=$perancangan->lokasi?></p>
                                        <p>
                                            Lama Pembangunan :
                                            <?php
                                                $lama=0;
                                                $tampil2=$rancanganpembangunan;
                                                foreach ($rancanganpembangunan as $rancanganpembangunan){
                                                    $lama=$lama+$rancanganpembangunan->lama_pengerjaan;
                                                }
                                                echo $lama;
                                            ?>
                                            hari
                                        </p>
                                        <p>Hari Ke : <?=$perbedaan->d+1?></p> 
                                    <?php
                                endforeach;
                            ?>
                        </div>
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <h2 class="heading-39291">Pembangunan</h2>
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Pembangunan</th>
                                        <th>Jumlah Item</th>
                                        <th>Lama Pengerjaan</th>
                                    </tr>
                                    <?php 
                                        $no=1;
                                        foreach ($tampil2 as $tampil2){
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$tampil2->pembangunan?></td>
                                                    <td><?=$tampil2->jumlah?></td>
                                                    <td><?=$tampil2->lama_pengerjaan?> Hari</td>
                                                </tr>
                                            <?php
                                            $no++;
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <h2 class="heading-39291">Anggaran</h2>
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Biaya</th>
                                    </tr> 
                                    <?php
                                        if(empty($tampil)) echo "<tr><td colspan='5'>Belum Memiliki Anggaran</td></tr>";
                                        $no=1;
                                        foreach ($tampil as $tampil):
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$tampil->nama_barang?></td>
                                                    <td><?=$tampil->jumlah?></td>
                                                    <td>Rp. <?=number_format($tampil->anggaran,0,",",".")?></td>
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