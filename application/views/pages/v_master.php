<!--========================= Content Wrapper ==============================-->
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabBarang" data-toggle="tab"><strong>DETAIL BARANG</strong></a></li>
        <li><a href="#tabPelanggan" data-toggle="tab"><strong>PELANGGAN</strong></a></li>
        <li><a href="#tabPegawai" data-toggle="tab"><strong>PEMILIK</strong></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabBarang">
            <?php $this->load->view('pages/v_tab_master_barang')?>
        </div>
        <div class="tab-pane" id="tabPelanggan">
            <?php $this->load->view('pages/v_tab_master_pelanggan')?>
        </div>
        <div class="tab-pane" id="tabPegawai">
            <?php $this->load->view('pages/v_tab_master_pemilik')?>
        </div>
    </div>
</div>
