<!--========================= Content Wrapper ==============================-->
<div class="container">

    <div class="well">
        <h4 class="alert alert-info" style="text-align: center">Keterangan</h4>
        <div class="row-fluid">
            <?php if(isset($dt_penjualan)){
                foreach($dt_penjualan as $row){
                    ?>
                    <div class="span6">
                        <dl class="dl-horizontal">
                            <dt>Kode Penjualan :</dt>
                            <dd><?php echo $row->kd_penjualan?></dd>
                            <br/>
                            <dt>Tanggal Penjualan :</dt>
                            <dd><?php echo date("d M Y",strtotime($row->tanggal_penjualan));?></dd>
                            <br/>
                            <dt>Total Harga :</dt>
                            <dd><strong><u><?= currency_format($row->total_harga); ?></u></strong></dd>
                        </dl>
                    </div>
                    <div class="span6">
                        <dl class="dl-horizontal">
                            <dt>Pelanggan :</dt>
                            <dd><?php echo $row->nm_pelanggan?></dd>
                            <br/>
                            <dt>Alamat :</dt>
                            <dd><?php echo $row->alamat?></dd>
                            <br/>
                            <dt>No. Telfon :</dt>
                            <dd><?php echo $row->notelp?></dd>
                        </dl>
                    </div>
        </div>
    </div>


    <div class="well">
        <h4 class="alert alert-info" style="text-align: center"> Daftar Barang</h4>
        <div class="row-fluid">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                if(isset($barang_jual)){
                    foreach($barang_jual as $row ){
                        ?>
                        <tr>

                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row->kd_barang?></td>
                            <td><?php echo $row->nm_barang?></td>
                            <td><?php echo $row->qty?></td>
                            <td><?php echo currency_format($row->harga)?></td>
                        </tr>
                       
             <?php   }
            }?>
                </tbody>
            </table>
                <a href="<?php echo site_url('penjualan')?>" class="btn btn-inverse">
                    <i class="icon-circle-arrow-left icon-white"></i> Back
                </a>
                <a href="<?php echo site_url('penjualan')?>" class="btn btn-inverse">
                    <i class="icon-print"></i> Print
                </a>
        </div>
    </div>
<?php }?>
<?php }?>
</div>



