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
                            <h1>Monitoring Unit <br>Proyek</h1>
                            <div id='utama'></div>
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
                            <p>Perkembangan proyek perumahan atau rumah dapat dipantau disini</p>
                        </div>
                    </div>
                    <div class="row align-items-stretch">
                        <?php
                            if(isset($monitoring_unit['perkembangan'])){
                                foreach ($monitoring_unit['perkembangan'] as $value) {
                                    ?>
                                        <div class="col-lg-3 col-md-6 mb-5">
                                            <div class="post-entry-1 h-100">
                                                <a href="#">
                                                    <img src="<?=base_url('images/perkembangan_proyek/'.$value['data_foto'])?>" alt="Image"
                                                    class="img-fluid">
                                                </a>
                                                <div class="post-entry-1-contents">
                                                    <span class="meta"><?=$value['tanggal_pembangunan']?></span>
                                                    <p class="my-3"><?=$monitoring_unit['data']['pembangunan'][$value['id']]." (".$value['jumlah'].$monitoring_unit['data']['satuan'][$value['id']].")"?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
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
                $('#utama').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: '<?=$monitoring_unit['data']['nama']?>'
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
                            ['Selesai',<?=$monitoring_unit['selesai']?>],
                            ['Belum Selesai',<?=$monitoring_unit["belumselesai"]?>],
                        ]
                    }]
                });
            });
        </script>
    </body>
</html>