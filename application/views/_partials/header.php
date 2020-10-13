<?php
    $link=strtolower($this->session->userdata('userLogin'));
?>
<div class="site-mobile-menu site-navbar-target" >
    <div class="site-mobile-menu-header" >
        <div class="site-mobile-menu-close mt-3" >
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<header class="site-navbar site-navbar-target" role="banner">
    <div class="container">
        <div class="row align-items-center position-relative" >
            <div class="col-lg-12 text-center">
                <div class="site-logo">
                    <a href="<?=site_url($link)?>">Monitoring Proyek</a>
                </div>
                <div class="ml-auto toggle-button d-inline-block d-lg-none" >
                    <a href="#!" class="site-menu-toggle py-5 js-menu-toggle text-white"><span class="icon-menu h3 text-balck"></span></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="site-navigation text-left mr-auto " role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                        <li class="<?=$this->uri->segment(2) == 'data_perancangan_proyek' ? 'active': '' ?>">
                            <a href="<?=site_url($link.'/data_perancangan_proyek')?>" class="nav-link">Perancangan</a>
                        </li>
                        <li class="<?=$this->uri->segment(2) == 'data_pembangunan_proyek' ? 'active': '' ?>">
                            <a href="<?=site_url($link.'/data_pembangunan_proyek')?>" class="nav-link">Pembangunan</a>
                        </li>
                        <li class="<?=$this->uri->segment(2) == 'data_proyek' ? 'active': '' ?>">
                            <a href="<?=site_url($link.'/monitoring')?>" class="nav-link">Monitoring</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-6">
                <nav class="site-navigation text-left mr-auto " role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                        <li class="<?=$this->uri->segment(2) == 'data_tipe_pembangunan' ? 'active': '' ?>" <?=$link == 'mandor' ? 'hidden': '' ?>>
                            <a href="<?=site_url($link.'/data_tipe_pembangunan')?>" class="nav-link">Tipe Pembangunan</a>
                        </li>
                        <li class="<?=$this->uri->segment(2) == 'pengaturan' ? 'active': '' ?>">
                            <a href="<?=site_url($link.'/pengaturan')?>" class="nav-link">Pengaturan</a>
                        </li>
                        <li>
                            <a href="<?=site_url('login/logout')?>" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>