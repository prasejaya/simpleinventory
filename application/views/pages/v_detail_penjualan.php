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
                            <?php $a= $row->nm_gambar;
                            $b= $row->kd_penjualan?>
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
                <?php }?>
                <img src="http://localhost/toko/asset/uploads/<?php echo $a;?>">
                 
            <?php }
            ?>
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
                    <th>Gambar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                if(isset($barang_jual)){

                    foreach($barang_jual as $row ){
                          $a=$row->nm_gambar;
                        ?>
                        <tr>

                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row->kd_barang?></td>
                            <td><?php echo $row->nm_barang?></td>
                            <td><?php echo $row->qty?></td>
                            <td><?php echo currency_format($row->harga)?></td>
                             <img src="http://localhost/toko/asset/uploads/<?php echo $a;?>">
                        </tr>
                        <?php if ($this->session->userdata('LEVEL') == 'admin'){?>
                    <?php }
                }
            }?>
                </tbody>
            </table>
            <?php if ($this->session->userdata('LEVEL') != 'admin'){?>
            <form action="<?php echo base_url()?>penjualan/insertfoto" method="post" enctype="multipart/form-data">
            <div class="form-actions">
                 <label for="inputPassword3" class="col-sm-2 control-label">Bukti Pembayaran</label>
                        <div class="col-sm-10">
                          <input type="file" name="filefoto" class="form-control">
                        </div>
                    <input name="kd_penjualan" type="text" value="<?php echo $b;?>" readonly="readonly" style="display: none">
                   
                    <input type="submit" class="btn btn-success" value="Upload">
                    <a href="<?php echo site_url('penjualan')?>" class="btn btn-inverse">
                    <i class="icon-circle-arrow-left icon-white"></i> Back
                </a>
                
            </div>
            </form>
            <?} else {?>
                <a href="<?php echo site_url('penjualan')?>" class="btn btn-inverse">
                    <i class="icon-circle-arrow-left icon-white"></i> Back
                </a>
            <?php }
            ?>
        </div>
    </div>


</div>



