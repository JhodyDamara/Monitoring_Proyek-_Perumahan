<?php
    $bulan=["01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember"];
?>
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
                            <h1 class="heading-39291">Perkembangan Pembangunan <br> Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <?php
                                    foreach ($tampil2 as $tampil2) echo $tampil2->nama_proyek;
                                ?>
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th colspan="2">Telah Selesai</th>
                                        <th>Tanggal perkembangan</th>
                                    </tr>
                                    <?php
                                        if(empty($tampil)) echo "<tr><td colspan='5'>Belum Memiliki perkembangan</td></tr>";
                                        $no=1;
                                        $selesai=0;
                                        $belumselesai=0;
                                        $byk=count($tampil)+1;
                                        $galery=$tampil;
                                        foreach ($tampil as $tampil){
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$tampil->pembangunan?></td>
                                                    <td><?=$tampil->jumlah?></td>
                                                    <td><?=$tampil->tanggal_pembangunan?></td>
                                                </tr>
                                            <?php
                                            if(isset($data[$tampil->pembangunan])){
                                                $data[$tampil->pembangunan]+=$tampil->jumlah;
                                            }
                                            else{
                                                $data[$tampil->pembangunan]=$tampil->jumlah;
                                            }
                                            $no++;
                                        }
                                        foreach ($tampil1 as $tampil1){
                                            if(isset($data[$tampil1->pembangunan])) $sisa=$tampil1->jumlah-$data[$tampil1->pembangunan];
                                            else $sisa=$tampil1->jumlah;
                                            if($sisa<0) $sisa=0;
                                            $belumselesai+=$sisa;
                                            $selesai+=($tampil1->jumlah-$sisa);
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <div id='container'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div class="row  mb-5">
                        <div class="col-md-7">
                            <h2 class="heading-39291">Galery perkembangan</h2>
                            <p>Perkembangan proyek perumahan atau ruko dapat dipantau disini</p>
                        </div>
                    </div>
                    <div class="row align-items-stretch">
                        <?php
                            foreach ($galery as $galery){
                                $pecahan = explode('-', $galery->tanggal_pembangunan);
                                ?>
                                    <div class="col-lg-3 col-md-6 mb-5">
                                        <div class="post-entry-1 h-100">
                                                <img src="<?=base_url('images/perkembangan_proyek/'.$galery->data_foto)?>" alt="Image"
                                                class="img-fluid">
                                            <div class="post-entry-1-contents">
                                                <span class="meta"><?=$bulan[$pecahan[1]]." ".$pecahan[2].", ".$pecahan[0];?></span>
                                                <h2><?=$galery->pembangunan."(".$galery->jumlah.")"?></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
        <script src="<?=base_url('js/highcharts.js')?>"></script>
        <script>
            $(function () {
            $('#container').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Perkembangan proyek'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Persentase Perkembangan proyek',
                    data: [
                        ['Selesai',<?=$selesai?>],
                        ['Belum Selesai',<?=$belumselesai?>],
                    ]
                }]
            });
        });
        </script>
    </body>
</html>