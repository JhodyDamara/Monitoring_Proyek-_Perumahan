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
                            <h1 class="heading-39291">Detail Pembangunan <br>Proyek</h1>
                        </div>
                        <div class="col-md-5 text-right">
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                        <div class="col-md-12">
                            <blockquote class="testimonial-1">
                                <p>Id Proyek : <?=$this->session->userdata['id']?></p>  
                                <p>Nama Proyek : <?=$lihat_data_pembangunan['proyek']['nama_proyek']?></p>  
                                <p>Lokasi : <?=$lihat_data_pembangunan['proyek']['lokasi']?></p>
                                <p>Estimasi Keseluruhan Waktu Pekerjaan : <?=$lihat_data_pembangunan['proyek']['lama']?></p>
                                <p>Anggaran Keseluruhan Biaya : <?=$lihat_data_pembangunan['proyek']['anggaran']?></p>
                                <p>Hari Ke : <?=$lihat_data_pembangunan['proyek']['hari']+1?></p>
                                <cite><span class="text-black"><?=$lihat_data_pembangunan['proyek']['nama_pengguna']?></span> &mdash; <span class="text-muted">Mandor dan Penanggung Jawab Proyek</span></cite>
                            </blockquote>
                            <hr/>
                        </div>
                        <div class='col-md-12'>
                            <h2>Evaluasi</h2>
                            <p><a href="<?=site_url('developer/data_pembangunan_proyek/lihat_data_pembangunan/tambah_evaluasi_proyek')?>" class='more-39291'>Tambah Evalueasi Proyek</a></p>
                            <table class='proyek'>
                                <tr>
                                    <th>No</th>
                                    <th>Masalah</th>
                                    <th>Masukkan</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                    if(!isset($lihat_data_pembangunan["evalueasi"])) echo "<td colspan='4'>Belum memiliki Evaluasi proyek</td>";
                                    else{
                                        foreach ($lihat_data_pembangunan["evalueasi"] as $key => $value){
                                            echo "<tr>";
                                            echo "<td>".($key+1)."</td>";    
                                            echo "<td>".$value["problem"]."</td>";
                                            echo "<td>".$value["masukkan"]."</td>";
                                            echo "<td>";
                                                ?>
                                                    <a href="<?=site_url('developer/data_pembangunan_proyek/lihat_data_pembangunan/edit_evaluasi_proyek/'.$value["id_evaluasi"])?>">Edit</a>
                                                    /
                                                    <a href='#!' onclick="deletekonfirm('<?=site_url('developer/data_pembangunan_proyek/lihat_data_pembangunan/hapus_evaluasi_proyek/'.$value["id_evaluasi"])?>')">Hapus</a>
                                                <?php
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </table><hr/>
                        </div>
                        <?php
                            $hiddenblok=null;
                            if(count($lihat_data_pembangunan['blok'])==1) $hiddenblok="hidden"; 
                            foreach ($lihat_data_pembangunan['blok'] as $key => $value){
                                $hiddenunit=null;
                                if(count($lihat_data_pembangunan['unit'][$key])==1) $hiddenunit="hidden";
                                echo "<div class='col-md-12'>";
                                echo "<h2 $hiddenblok style='text-decoration: underline;color:#207561'>$value</h2>";
                                foreach ($lihat_data_pembangunan['unit'][$key] as $key1 => $value1) {
                                    echo "<h3 $hiddenunit style='text-decoration: underline'>$value1 ($key1)</h3>";
                                    echo "<h4>Target Pekerjaan</h4>";
                                    echo "<table class='proyek'>";
                                    echo "<tr>";
                                    echo "<th>No</th>";
                                    echo "<th>Pekerjaan</th>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th>Telah Selesai</th>";
                                    echo "<th>Persentase</th>";
                                    echo "</tr>";
                                    $no=1;
                                    $total_persentasi=0;
                                    foreach ($lihat_data_pembangunan['pekerjaan'][$key1] as $value2) {
                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td>".$value2['pembangunan']."</td>";
                                        echo "<td>".str_replace('.',',',$value2['jumlah'])." ".$value2['satuan']."</td>";
                                        echo "<td>".$lihat_data_pembangunan['perkembangan'][$value2['id_target_pembangunan']]."</td>";
                                        if($value2['jumlah']<=$lihat_data_pembangunan['perkembangan'][$value2['id_target_pembangunan']]) $persentase=100;
                                        else $persentase=($lihat_data_pembangunan['perkembangan'][$value2['id_target_pembangunan']]/$value2['jumlah'])*100;
                                        echo "<td>".number_format($persentase,1)." %</td>";
                                        echo "</tr>";
                                        $total_persentasi+=$persentase;
                                        $no++;
                                    }
                                    $total_persentasi=$total_persentasi/($no-1);
                                    echo "<tr>";
                                    echo "<td colspan='4'>Total Persentase $value1</td>";
                                    echo "<td>".number_format($total_persentasi,1)." %</td>";
                                    echo "</tr>";
                                    echo "</table><br>";
                                    echo "<h4>Rancangan Anggaran</h4>";
                                    echo "<table class='proyek'>";
                                    echo "<tr>";
                                    echo "<th>No</th>";
                                    echo "<th>Nama Barang</th>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th>Pengeluaran</th>";
                                    echo "<th>Selisih Biaya</th>";
                                    echo "</tr>";
                                    $total_selisih=0;
                                    $total_biaya=0;
                                    $no=1;
                                    foreach ($lihat_data_pembangunan['anggaran'][$key1] as $value2) {
                                        echo "<tr>";
                                        echo "<td>".$no."</td>";
                                        echo "<td>".$value2['nama_barang']."</td>";
                                        echo "<td>".$value2['jumlah']."</td>";
                                        echo "<td>Rp. ".number_format($value2['anggaran'],0,',','.')."</td>";
                                        $selisih=$value2['anggaran']-$lihat_data_pembangunan['pengeluaran'][$value2['id_target_keuangan']];
                                        if($selisih>0) $selisih=0;
                                        echo "<td>Rp. ".number_format($selisih,0,',','.')."</td>";
                                        echo "</tr>";
                                        $total_selisih+=$selisih;
                                        $total_biaya+=$value2['anggaran'];
                                        $no++;
                                    }
                                    echo "<tr>";
                                    echo "<td colspan='3'>Total anggaran dan Selisih Biaya $value1</td>";
                                    echo "<td>Rp. ".number_format($total_biaya,0,',','.')."</td>";
                                    echo "<td>Rp. ".number_format($total_selisih,0,',','.')."</td>";
                                    echo "</tr>";
                                    echo "</table><br>";
                                }
                                echo "<hr/></div>";
                            }?>
                    </div>
                </div>
            </div> 
            <?php $this->load->view("_partials/popup_gambar.php") ?>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>