<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $no=1;
    if(isset($data_barang)){
    foreach($data_barang as $row){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row->kd_barang; ?></td>
        <td><?php echo $row->nm_barang; ?></td>
        <td><?php echo $row->stok; ?></td>
        <td><?php echo currency_format($row->harga);?></td>
        <td>
           <a href="<?php echo site_url('penjualan/detail_penjualan')?>" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
           <i class="icon-plus-sign icon-white"></i> Beli
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>


