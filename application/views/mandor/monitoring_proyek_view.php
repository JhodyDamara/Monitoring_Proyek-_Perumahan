<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header.php") ?>
            <div class="ftco-blocks-cover-1">
                <div class="ftco-cover-1">
                    <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h1>Our Projects</h1>
                            <div id='utama'></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="site-section ">
                <?php
                    $total_persentase_proyek=0;
                    $no2=0;
                    foreach ($lihat_data_pembangunan['blok'] as $key => $value){
                        $data["text"][$key]=$value;
                        $total_persentase_blok=0;
                        ?>
                            <div class="container site-section">
                                <div class="row align-items-stretch feature-2">
                                    <div class="col-lg-9 feature-2-img">
                                        <div id='<?=$key?>'></div>
                                        <?php
                                            $no1=0;
                                            foreach ($lihat_data_pembangunan['unit'][$key] as $key1 => $value1) {
                                                $data["text"][$key1]=$value1;
                                                $no=0;
                                                $total_persentase=0;
                                                foreach ($lihat_data_pembangunan['pekerjaan'][$key1] as $value2) {
                                                    if($value2['jumlah']<=$lihat_data_pembangunan['perkembangan'][$value2['id_target_pembangunan']]) $persentase=100;
                                                    else $persentase=($lihat_data_pembangunan['perkembangan'][$value2['id_target_pembangunan']]/$value2['jumlah'])*100;
                                                    $total_persentase+=$persentase;
                                                    $no++;
                                                }
                                                $data["selesai"][$key1]=number_format($total_persentase/$no,1);
                                                $data["belumselesai"][$key1]=100-$data["selesai"][$key1];
                                                $total_persentase_blok+=$data["selesai"][$key1];
                                                $no1++;
                                                ?>
                                                    <div class="container site-section">
                                                        <div class="row align-items-stretch feature-2">
                                                            <div class="col-lg-9 feature-2-img order-lg-2">
                                                                <div id='<?=$key1?>'></div>
                                                            </div>
                                                            <div class="col-lg-3 feature-2-contents pr-lg-5">
                                                                <div class="fixed-content">
                                                                    <span class="caption"><?=$value1?></span>
                                                                    <p>Pekerjaan Selesai : <?=$data["selesai"][$key1]?>%</p>
                                                                    <a href="<?=site_url("mandor/monitoring/proyek/pekerjaan_belum_selesai/".$key1)?>"><p>Pekerjaan belum selesai : <?=$data["belumselesai"][$key1]?>%</p></a> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                            $data["selesai"][$key]=number_format($total_persentase_blok/$no1,1);
                                            $data["belumselesai"][$key]=100-$data["selesai"][$key];
                                            $total_persentase_proyek+=$data["selesai"][$key];
                                            $no2++;
                                        ?>
                                    </div>
                                    <div class="col-lg-3 feature-2-contents pl-lg-5">
                                        <div class="fixed-content">
                                            <span class="caption"><?=$value?></span>
                                            <p>Pekerjaan Selesai : <?=$data["selesai"][$key]?>%</p>
                                            <p>Pekerjaan belum selesai : <?=$data["belumselesai"][$key]?>%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    $data["selesai"]["utama"]=number_format($total_persentase_proyek/$no2,1);
                    $data["belumselesai"]["utama"]=100-$data["selesai"]["utama"];
                    $data["text"]["utama"]=$lihat_data_pembangunan['proyek']['nama_proyek'];
                ?>
            </div>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
        <script src="<?=base_url('js/highcharts.js')?>"></script>
        <?php
            foreach ($data["selesai"] as $key => $value) {
                ?>
                    <script>
                        $(function () {
                        $('#<?=$key?>').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false
                            },
                            title: {
                                text: '<?=$data['text'][$key]?>'
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
                                    ['Selesai',<?=$value?>],
                                    ['Belum Selesai',<?=$data["belumselesai"][$key]?>],
                                ]
                            }]
                        });
                    });
                    </script>
                <?php
            }
        ?>
    </body>
</html>