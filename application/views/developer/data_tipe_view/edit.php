<!doctype html>
<html lang="en">
    <head><?php $this->load->view("_partials/head.php") ?></head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap" id="home-section">
            <div class="site-section">
                <div class="container">
                    <div class="row  mb-5">
                        <div class="col-md-7">
                            <h1 class="heading-39291">Tambah Edit Pembangunan <br> Proyek</h1>
                        </div>
                    </div>
                    <div class="row align-items-stretch">
                        <div class="col-lg-12 col-md-6 mb-5">
                            <div class="post-entry-1 h-100">
                                <a href="<?=site_url('developer/data_tipe_pembangunan/edit/pekerjaan')?>" class="more-39291">Tambah Pekerjaan</a>
                                <div class="post-entry-1-contents">
                                    <table class='proyek'>
                                        <tr>
                                            <th>No</th>
                                            <th>Pekerjaan</th>
                                            <th>Jumlah Item</th>
                                            <th>Lama Pengerjaan</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php 
                                            $bykpembangunan=0;
                                            if(empty($data_tipe_edit["pembangunan"])) echo "<td colspan='5'>Belum memiliki rancangan pekerjaan</td>";
                                            $i=1;
                                            foreach ($data_tipe_edit["pembangunan"] as $key => $value){
                                                echo "<tr>";
                                                echo "<td>$i</td>";
                                                echo "<td>".$value['pembangunan']."</td>";
                                                echo "<td>".$value['jumlah']."</td>";
                                                echo "<td>".$value['lama_pengerjaan']." Hari</td>";
                                                echo "<td>";
                                                    ?>
                                                        <a href="<?=site_url('developer/data_tipe_pembangunan/edit/pekerjaan/edit/'.$key)?>">Edit</a>
                                                        /
                                                        <a href='#!' onclick="deletekonfirm('<?=site_url('developer/data_tipe_pembangunan/edit/pekerjaan/hapus/'.$key)?>')">Hapus</a>
                                                    <?php
                                                echo "</td>";
                                                echo "</tr>";
                                                $i++;
                                                $bykpembangunan++;
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-stretch">
                        <div class="col-lg-12 col-md-6 mb-5">
                            <div class="post-entry-1 h-100">
                                <a href="<?=site_url('developer/data_tipe_pembangunan/edit/anggaran')?>" class="more-39291">Tambah Biaya</a>
                                <div class="post-entry-1-contents">
                                    <table class='proyek'>
                                        <tr>
                                            <th>No</td>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Item</th>
                                            <th>Biaya</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <?php 
                                            $bykanggaran=0;
                                            if(empty($data_tipe_edit["anggaran"])) echo "<td colspan='5'>Belum memiliki rancangan anggaran</td>";
                                            $i=1;
                                            foreach ($data_tipe_edit["anggaran"] as $key => $value){
                                                echo "<tr>";
                                                echo "<td>$i</td>";
                                                echo "<td>".$value['nama_barang']."</td>";
                                                echo "<td>".$value['jumlah']."</td>";
                                                echo "<td>Rp. ".number_format($value['anggaran_biaya'],0,',','.')."</td>";
                                                echo "<td>";
                                                    ?>
                                                        <a href="<?=site_url('developer/data_tipe_pembangunan/edit/anggaran/edit/'.$key)?>">Edit</a>
                                                        /
                                                        <a href='#!' onclick="deletekonfirm('<?=site_url('developer/data_tipe_pembangunan/edit/anggaran/hapus/'.$key)?>')">Hapus</a>
                                                    <?php
                                                echo "</td>";
                                                echo "</tr>";
                                                $i++;
                                                $bykanggaran++;
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 col-md-6 mb-5">
                            <div class="post-entry-1 h-100">
                                <div class="post-entry-1-contents">
                                    <form action="" method="post">
                                        <input type="text" id="bykpembangunan" name="bykpembangunan" value="<?=$bykpembangunan?>" autocomplete="off" class="form-control" hidden>
                                        <input type="text" id="bykanggaran" name="bykanggaran" value="<?=$bykanggaran?>" autocomplete="off" class="form-control" hidden>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="tipe">Nama Tipe Pembangunan</label>
                                                <input type="text" id="tipe" name="tipe" autocomplete="off" class="form-control" value="<?=$data_tipe_edit["tipe"]?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 mr-auto">
                                                <input type="submit" name="simpan" id="simpan" value="Simpan" class="btn btn-block btn-primary text-white py-3 px-5">
                                                <a href="<?=site_url('developer/data_tipe_pembangunan')?>" class="btn btn-block btn-primary text-white py-3 px-5">Kembali</a>
                                        </div>
                                    </form>
                                </div>
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