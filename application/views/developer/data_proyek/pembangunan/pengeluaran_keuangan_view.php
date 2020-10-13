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
                            <h1 class="heading-39291">Pengeluaran Keuangan <br> Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <p>
                                    <?php
                                        foreach ($tampil as $tampil) echo $tampil->nama_proyek;
                                    ?>
                                </p>
                                <table class="proyek">
                                    <tr>
                                        <th>no</th>
                                        <th colspan="2">Nama Barang</th>
                                        <th>Tanggal Pengeluaran</th>
                                        <th>Biaya</th>
                                    </tr>
                                    <?php
                                        if(empty($tampil1)) echo "<tr><td colspan='5'>Belum Memiliki perkembangan</td></tr>";
                                        $no=1;
                                        $total=0;
                                        foreach ($tampil1 as $tampil1){
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$tampil1->nama_barang?></td>
                                                    <td><?=$tampil1->jumlah?></td>
                                                    <td><?=$tampil1->tanggal_pengeluaran?></td>
                                                    <td>Rp. <?=number_format($tampil1->biaya,0,",",".")?></td>
                                                </tr>
                                            <?php
                                            $total=$total+$tampil1->biaya;
                                            $no++;
                                        }    
                                    ?>
                                    <tr>
                                        <td colspan="4" style="text-align:center">Total</td>
                                        <td>Rp. <?=number_format($total,0,",",".")?></td>
                                    </tr>
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