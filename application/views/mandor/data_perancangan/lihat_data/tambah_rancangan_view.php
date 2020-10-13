<h2>Tambah Rancangan Biaya</h2>
<form action="" method="post">
    <div>
        <label for="nama">Nama Barang</label>
        <input type="text" name="nama" id="nama" autocomplete="off">
    </div>
    <div>
        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" autocomplete="off">
    </div>
    <div>
        <label for="satuan">Satuan</label>
        <input type="text" name="satuan" id="satuan" autocomplete="off">
    </div>
    <div>
        <label for="anggaran">Anggaran Biaya</label>
        <input type="number" name="anggaran" id="anggaran" autocomplete="off">
    </div>
    <div>
        <input type="submit" name="simpan" id="simpan" value="Simpan">
        <a href="<?=site_url('developer/data_perancangan_proyek/lihat_data_perancangan')?>">Kembali</a>
    </div>
</form>