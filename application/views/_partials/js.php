<script src="<?=base_url('js/jquery-3.3.1.min.js')?>"></script>
<script src="<?=base_url('js/popper.min.js')?>"></script>
<script src="<?=base_url('js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('js/owl.carousel.min.js')?>"></script>
<script src="<?=base_url('js/jquery.sticky.js')?>"></script>
<script src="<?=base_url('js/jquery.waypoints.min.js')?>"></script>
<script src="<?=base_url('js/jquery.animateNumber.min.js')?>"></script>
<script src="<?=base_url('js/jquery.fancybox.min.js')?>"></script>
<script src="<?=base_url('js/jquery.easing.1.3.js')?>"></script>
<script src="<?=base_url('js/aos.js')?>"></script>
<script src="<?=base_url('js/main.js')?>"></script>
<script src="<?=base_url('js/mainFunction.js')?>"></script>
<?php
    if($this->session->userdata('error') != null){
        echo "<script>popupblock()</script>";
        $this->session->set_userdata(['error' => null]);
    }
?>