<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <div class="site-section section-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Detail Rancangan <br>Proyek</h1>
                        </div>
                        <div class="col-md-5 text-right">
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                        <div class="col-md-12">
                            <blockquote class="testimonial-1">
                                <p>Nama Proyek : <?=$data_perancangan_lihat['proyek']['nama_proyek']?></p>  
                                <p>Lokasi : <?=$data_perancangan_lihat['proyek']['lokasi']?></p>
                                <p>Estimasi Waktu Pekerjaan : <?=$data_perancangan_lihat['proyek']['lama']?></p>
                                <p>Anggaran Biaya : <?=$data_perancangan_lihat['proyek']['anggaran']?></p>
                                <cite><span class="text-black"><?=$data_perancangan_lihat['proyek']['nama_pengguna']?></span> &mdash; <span class="text-muted">Mandor dan Penanggung Jawab Proyek</span></cite>
                            </blockquote>
                            <hr/>
                        </div>
                        <?php
                            $hiddenblok=null;
                            if(count($data_perancangan_lihat['blok'])==1) $hiddenblok="hidden"; 
                            foreach ($data_perancangan_lihat['blok'] as $key => $value){
                                $hiddenunit=null;
                                if(count($data_perancangan_lihat['unit'][$key])==1) $hiddenunit="hidden";
                                echo "<div class='col-md-12'>";
                                echo "<h2 $hiddenblok style='text-decoration: underline;color:#207561'>$value</h2>";
                                foreach ($data_perancangan_lihat['unit'][$key] as $key1 => $value1) {
                                    echo "<h3 $hiddenunit style='text-decoration: underline'>$value1</h3>";
                                    echo "<h4>Target Pekerjaan</h4>";
                                    echo "<table class='proyek'>";
                                    echo "<tr>";
                                    echo "<th>No</th>";
                                    echo "<th>Pekerjaan</th>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th>Estimasi Waktu</th>";
                                    echo "</tr>";
                                    $no=1;
                                    foreach ($data_perancangan_lihat['pekerjaan'][$key1] as $value1) {
                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td>".$value1['pembangunan']."</td>";
                                        echo "<td>".$value1['jumlah']." ".$value1['satuan']."</td>";
                                        echo "<td>".$value1['lama_pengerjaan']."</td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                    echo "</table><br>";
                                    echo "<h4>Rancangan Anggaran</h4>";
                                    echo "<table class='proyek'>";
                                    echo "<tr>";
                                    echo "<th>No</th>";
                                    echo "<th>Nama Barang</th>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th>Anggaran Biaya</th>";
                                    echo "</tr>";
                                    $no=1;
                                    foreach ($data_perancangan_lihat['anggaran'][$key1] as $value1) {
                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td>".$value1['nama_barang']."</td>";
                                        echo "<td>".$value1['jumlah']."</td>";
                                        echo "<td>Rp. ".number_format($value1['anggaran'],0,',','.')."</td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                    echo "</table><br>";
                                }
                                echo "<hr/></div>";
                            }
                        ?>
                    </div>
                </div>
            </div> 
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>