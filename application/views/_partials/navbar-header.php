<header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
    <div class="container-xl">
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <?php if(isset($tes)) :?>
                <?php if($tes['tipe_tes'] == 'Tes TOEFL Kolaborasi Universitas' || $tes['tipe_tes'] == 'Tes TOEFL Kolaborasi Perusahaan') :?>
                    <a href="javascript:void(0)">
                        <img src="<?= $link['value']?>/assets/img/logo.png" width="24" height="24" alt="Tabler" class="navbar-brand-image">
                    </a>
                    <a href="javascript:void(0)">
                        <img src="<?= $link['value']?>/assets/logo/<?= $tes['id_tes']?>.png" width="24" height="24" alt="Tabler" class="navbar-brand-image">
                    </a>
                <?php else :?>
                    <a href="javascript:void(0)">
                        <img src="<?= $link['value']?>/assets/img/logo.png" width="24" height="24" alt="Tabler" class="navbar-brand-image">
                    </a>
                <?php endif;?>
            <?php endif?>
        </h1>
        <?php if(isset($tes['waktu'])) :?>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown d-md-flex ">
                    <div>
                        <svg width="20" height="20">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-alarm" />
                        </svg>
                        <?php if($soal['tipe_soal'] == "TOEFL") :?>
                            <b><span id="waktu">&#8734;</span></b>
                        <?php else :?>
                            <b><span id="waktu"><?= $tes['waktu']?> Menit</span></b>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</header>