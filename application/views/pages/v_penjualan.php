<!--================ Content Wrapper===========================================-->
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kode Penjualan</th>
        <th>Nama Pelanggan</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
       <?php if ($this->session->userdata('LEVEL') == 'admin'){ ?>
       <th>Status Pengiriman</th>
       <th>Status Barang</th>
        <th class="span4">
            <a href="<?php echo site_url('penjualan/pages_tambah_penjualan')?>" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>
        </th>
         <?php } else { ?>
        <th>Status Barang</th>
        <th class="span3">
            <a href="<?php echo site_url('penjualan/pages_tambah_penjualan')?>" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Pembelian</a>
        </th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if(isset($data_penjualan)){
        foreach($data_penjualan as $row){
            ?>
            <tr class="gradeX">
                <td><?php echo $no++; ?></td>
                <td><?php echo date("d M Y",strtotime($row->tanggal_penjualan)); ?></td>
                <td><?php echo $row->kd_penjualan; ?></td>
                <td><?php echo $row->nm_pelanggan; ?></td>
                <td><?php echo $row->jumlah; ?> Items</td>
                <td><?php echo currency_format($row->total_harga); ?></td>
                <?php if ($this->session->userdata('LEVEL') == 'admin'){ ?>
                <?php if($row->isbaca == '0') {?>
                        <td>Pesan Baru</td>
                         <?php } else { ?> 
                          <td>Pesan Lama</td>
                        <?php } ?>
                 <?php if($row->ismasuk == '0') {?>
                        <td>Barang Belum Dikirim</td>
                         <?php } elseif($row->ismasuk == '1') { ?> 
                          <td>Barang Sudah Dikirim</td>
                        <?php } elseif($row->ismasuk == '2') { ?> 
                          <td>Fix Barang Diterima</td>
                        <?php } ?>
                 <?php } else { ?>
                  <?php if($row->ismasuk == '0') {?>
                        <td>Barang Belum Diterima</td>
                         <?php } elseif($row->ismasuk == '1') { ?> 
                          <td>Barang Sudah Diterima</td>
                        <?php } elseif($row->ismasuk == '2') { ?> 
                          <td>Barang Sudah Fix Diterima</td>
                        <?php } ?>
                 <?}?>
                <td>
                  <?php  if ($this->session->userdata('LEVEL') == 'admin'){?>
                    <a class="btn btn-mini" href="<?php echo site_url('penjualan/detail_penjualan/'.$row->kd_penjualan)?>">
                        <i class="icon-eye-open"></i> View</a>
                    <?php }else{ ?>
                    <a class="btn btn-mini" href="<?php echo site_url('penjualan/detail_penjualan/'.$row->kd_penjualan)?>">
                        <i class="icon-eye-open"></i> Upload Bukti Pengiriman</a>
                    <?php }?>
                    <a class="btn btn-mini" href="<?php echo site_url('cetak/print_penjualan/'.$row->kd_penjualan)?>">
                        <i class="icon-print"></i> Print</a>
                  <?php  if ($this->session->userdata('LEVEL') == 'admin'){?>
                    <a class="btn btn-mini" href="<?php echo site_url('penjualan/hapus/'.$row->kd_penjualan)?>"
                       onclick="return confirm('Anda Yakin ?');">
                        <i class="icon-trash"></i> Hapus</a>
                    <a class="btn btn-mini" href="<?php echo site_url('penjualan/update/'.$row->kd_penjualan)?>"
                       onclick="return confirm('Anda Yakin ?');">
                        <i class="icon-eye-open"></i> Kirim Barang</a>
                   <?php }else{ ?>
                    <a class="btn btn-mini" href="<?php echo site_url('penjualan/updatekirim/'.$row->kd_penjualan)?>"
                       onclick="return confirm('Anda Yakin ?');">
                        <i class="icon-eye-open"></i> Barang OK</a>
                <?php }?>
                </td>
               
            </tr>
        <?php }
    }
    ?>

    </tbody>
</table>



