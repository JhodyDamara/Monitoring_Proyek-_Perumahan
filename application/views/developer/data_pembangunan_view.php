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
                            <h1 class="heading-39291">Data Pembangunan <br> Proyek</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Proyek</th>
                                        <th>Proyek Dimulai</th>
                                        <th>Sisa Waktu Proyek</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                        if(!isset($data_proyek_status[0])) echo "<td colspan='5'>Belum memiliki pembangunan proyek</td>";
                                        else{
                                            foreach ($data_proyek_status as $key => $value){
                                                echo "<tr>";
                                                echo "<td>".($key+1)."</td>";    
                                                echo "<td>".$value["nama_proyek"]."</td>";
                                                echo "<td>".$value["start_proyek"]."</td>";
                                                echo "<td>".$value["sisa"]."</td>";
                                                echo "<td><a href='".site_url('developer/data_pembangunan_proyek/lihat_data_pembangunan/'.$value["id_data_proyek"])."'>Lihat</a></td>";
                                                echo "</tr>";
                                            }
                                        }
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