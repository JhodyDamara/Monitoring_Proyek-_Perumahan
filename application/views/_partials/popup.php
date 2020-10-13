
<section id="popup" class="modal popup" onclick="popupnone()">
    <div class="modal-content">
        <div class="modal-body">
            <div class="col-lg-12 mb-5" >
                <p>Peringatan!!</p>
                <hr>
                <p id="text1" hidden>"Hapus data?"</p>
                <p id="text2">"<?php echo $this->session->userdata('error'); ?>"</p>
            </div>
        </div>
        <div class="modal-footer" id="hapusdata" hidden>
            <p><a href="#!" id="hapusproyek">Hapus</a></p>
            <p>|</p>
            <p><a href="#!" onclick="popupnone()">Batal</a></p>
        </div>
    </div>
</section>
