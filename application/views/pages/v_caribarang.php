<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga</th>
        <th class="span2">
            <a href="#modalAddBarang" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>
        </th>
    </tr>
    </thead>
    <tbody>

    <?php
    $no=1;
    if(isset($dt_result)){
        foreach($dt_result as $row){
            ?>
            <tr class="gradeX">
               <td><?php echo $no++; ?></td>
				<td><?php echo $row->kd_barang; ?></td>
				<td><?php echo $row->nm_barang; ?></td>
				<td><?php echo $row->stok; ?></td>
				<td><?php echo currency_format($row->harga);?></td>
           <td>
            <a class="btn btn-mini" href="#modalEditBarang<?php echo $row->kd_barang?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
            <a class="btn btn-mini" href="<?php echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
               onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>
