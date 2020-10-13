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
                            <h1 class="heading-39291">Pengaturan Akun</h1>
                            <p><?php $this->load->view("_partials/breadcrumb.php") ?></p>
                            <p class="my-5"><a href="<?=site_url('developer/pengaturan/tambah_akun')?>" class="more-39291">Tambah Akun</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="">
                            <div class="media-92812">
                                <table class="proyek">
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama Pengguna</th>
                                        <th>Gambar</th>
                                        <th>aksi</th>
                                    </tr>
                                    <?php
                                        if(empty($tampil)) echo "<td colspan='5'>Belum memiliki akun</td>";
                                        $i=1;
                                        foreach ($tampil as $tampil): 
                                            echo "<tr>";
                                            echo "<td>".$i."</td>";   
                                            echo "<td>".$tampil->username."</td>";
                                            echo "<td>".$tampil->nama_pengguna."</td>";
                                            echo "<td><img alt='' src='".base_url('images/pengguna/'.$tampil->foto)."' width='100px'></td>";
                                            ?>
                                                <td>
                                                    <a href="<?=site_url('developer/pengaturan/edit_akun/'.$tampil->username)?>">Edit</a>
                                                    / 
                                                    <a href="#!" onclick="deletekonfirm('<?=site_url('developer/pengaturan/hapus_akun/'.$tampil->username)?>')">Hapus</a>
                                                </td>
                                            <?php
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
            <?php $this->load->view("_partials/popup.php") ?>
        </div>
        <?php $this->load->view("_partials/js.php") ?>
    </body>
</html>