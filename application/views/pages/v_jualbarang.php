<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Aksi</th>
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
        <td width="5px"><input type="text" name="qty" ></td>
        <td>
            <a class="btn btn-mini" href="<?php echo site_url('penjualan/tambah_penjualan_to_cart_klien')?>"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> Beli</a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>


