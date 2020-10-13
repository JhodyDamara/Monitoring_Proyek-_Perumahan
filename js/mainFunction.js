function modalblock(){
    var modal = document.getElementById("myModal"); 
    modal.style.display = "block";
}

function modalnone(){
    var modal = document.getElementById("myModal"); 
    modal.style.display = "none";
}

function popupblock(){
    var popup = document.getElementById("popup"); 
    popup.style.display = "block";
}

function popupnone(){
    var popup = document.getElementById("popup"); 
    popup.style.display = "none";
}

function deletekonfirm(link){
    $('#popup').attr('onclick', '');
    $('#hapusproyek').attr('href', link);
    document.getElementById("hapusdata").hidden=false;
    document.getElementById("text2").hidden=true;
    document.getElementById("text1").hidden=false;
    popupblock();
}

function view_pembayaran(link){
    popup.style.display = "block";
    $('#gambar').attr('src', link);
}

function jumlahblok(link){
    var jenis = $('#jenis').val();
    var jumlah = $('#jumlah').val();
    $("#form").load(link + "/" + jenis + "/" + jumlah);
    document.getElementById("form").hidden=false;
}

function perumahan(link){
    var jenis = $('#jenis').val();
    if(jenis=="Perumahan"){
        document.getElementById("formblok").hidden=false;
        document.getElementById("form").hidden=true;
    }
    else{
        document.getElementById("formblok").hidden=true;
        document.getElementById("form").hidden=false;
        $("#form").load(link + "/" + jenis + "/1");
    }
}

function tambah_perkembangan_proyek(link){
    var target = $('#target').val();
    var jumlah = $('#jumlah').val();
    if(target!="" && jumlah!=""){
        $("#tampil_tambah_target").load(link + "/mandor/tambah_target_selesai/" + target + "/"+jumlah);
    }
    document.getElementById("target").selectedIndex = "0";
    $('#jumlah').val("");
}
function hapus_perkembangan_proyek(link, id){
    $("#tampil_tambah_target").load(link + "/mandor/tambah_target_selesai/" + id + "/hapus");
} 