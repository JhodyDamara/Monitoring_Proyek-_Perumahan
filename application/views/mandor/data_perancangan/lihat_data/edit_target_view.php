<h2>Tambah Target Proyek</h2>
<form action="" method="post">
    <?php
        foreach ($data_target_pembangunan as $value) {
            ?>
                <div>
                    <label for="pembangunan">Pembangunan</label>
                    <input type="text" name="pembangunan" id="pembangunan" autocomplete="off" value="<?=$value->pembangunan?>">
                </div>
                <div>
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" step="0.01" autocomplete="off" value="<?=$value->jumlah?>">
                </div>
                <div>
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" id="satuan" autocomplete="off" value="<?=$value->satuan?>">
                </div>
                <div>
                    <label for="lama">Lama Pengerjaan</label>
                    <input type="number" name="lama" id="lama" autocomplete="off" value="<?=$value->lama_pengerjaan?>">
                </div>
                <div>
                    <input type="submit" name="simpan" id="simpan" value="Simpan">
                    <a href="<?=site_url('developer/data_perancangan_proyek/lihat_data_perancangan')?>">Kembali</a>
                </div>
            <?php
        }
    ?>
</form> 