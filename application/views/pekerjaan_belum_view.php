<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <?php $this->load->view("_partials/header_user.php") ?>
            <div class="ftco-blocks-cover-1">
                <div class="ftco-cover-1">
                    <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h1>Detail Pembangunan <br>Proyek</h1>
                            <div id='utama'></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Pekerjaan</th>
                                        <th>Belum Selesai</th>
                                    </tr>
                                    <?php
                                        $i=1;
                                        foreach ($monitoring_unit['data']['pembangunan'] as $key => $tampil): 
                                            echo "<tr>";
                                            echo "<td>".$i."</td>";   
                                            echo "<td>".$tampil."</td>";
                                            $sisa=$monitoring_unit['pembangunan'][$key]-$monitoring_unit['jumlah'][$key];
                                            if($sisa<0)$sisa=0;
                                            echo "<td>".$sisa." ".$monitoring_unit['data']['satuan'][$key]."</td>";
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