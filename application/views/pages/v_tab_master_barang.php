<script type="text/javascript">
    $(function(){
        $("#btnCari").click(function() {
            var $form = $('#masterPage').find('form'),
                $tgl_awal = $("#nm_barang").val(),
                $url = $form.attr('action');
            $.ajax({
                type: "POST",
                url: $url,
                dataType: "html",
                data: "tgl_awal="+$tgl_awal+"&tgl_akhir="+$tgl_akhir,
                cache:false,
                success: function(data){
                    $(".loader").fadeIn(500).fadeOut(500).queue(function(){
                        $('#result').html(data);
                    });
                }
            });
            return false;
        });
    });
</script>

<h3 style="text-align: center">
    Pencarian barang berdasarkan nama barang
</h3>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span4">&nbsp;</div>
        <div class="span4 loader" style="text-align: center">
            <div class="progress progress-striped active" style="display: none">
                <div class="bar" style="width: 100%;"></div>
            </div>
        </div>
        <div class="span4">&nbsp;</div>
    </div>

    <div style="border-bottom: 1px #999 dashed; margin-bottom: 20px"></div>

    <div class="row-fluid">
        <div id="masterPage">
            <form class="form-horizontal" method="post" action="<?= site_url('master/cari')?>">
                <div class="control-group">
                    <label class="control-label">Nama Barang</label>
                    <div class="controls">
                        <input type="text" id="nm_barang" name="nm_barang">
                    </div>
                </div>
  
                <div class="control-group">
                    <div class="controls">
                        <button id="btnCari" type="submit" class="btn btn-info"><i class="icon icon-white icon-search"></i> Search...</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="border-bottom: 1px #999 dashed; margin-bottom: 20px"></div>

    <div class="row-fluid">
        <div id="result"></div>
    </div>

</div>

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


<!-- ============ MODAL ADD BARANG =============== -->
<div id="modalAddBarang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Data Barang</h3>
    </div>
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('master/tambah_barang')?>">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Kode Barang</label>
                <div class="controls">
                    <input name="kd_barang" type="text" value="<?php echo $kd_barang; ?>" readonly>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Nama Barang</label>
                <div class="controls">
                    <input name="nm_barang" type="text" placeholder="Input Nama Barang...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Stok</label>
                <div class="controls">
                    <input name="stok" type="text" placeholder="Input Stok...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Harga</label>
                <div class="controls">
                    <input name="harga" type="text" placeholder="Input Harga...">
                </div>
            </div>
            <div class="form-actions">
                 <label for="control-label" class="col-sm-2 control-label">Upload Gambar</label>
                        <div class="col-sm-10">
                          <input type="file" name="filefoto" class="form-control">
                        </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<!-- ============ MODAL EDIT BARANG =============== -->
<?php
if (isset($data_barang)){
    foreach($data_barang as $row){
        ?>
        <div id="modalEditBarang<?php echo $row->kd_barang?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Barang</h3>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data"action="<?php echo site_url('master/edit_barang')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Kode Barang</label>
                        <div class="controls">
                            <input name="kd_barang" type="text" value="<?php echo $row->kd_barang;?>" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Nama Barang</label>
                        <div class="controls">
                            <input name="nm_barang" type="text" value="<?php echo $row->nm_barang;?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Stok</label>
                        <div class="controls">
                            <input name="stok" type="text" value="<?php echo $row->stok;?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Harga</label>
                        <div class="controls">
                            <input name="harga" type="text" value="<?php echo $row->harga;?>">
                        </div>
                    </div>
                    <div class="form-actions">
                      <label for="control-label" class="col-sm-2 control-label">Upload Gambar</label>
                        <div class="col-sm-10">
                          <input type="file" name="filefoto" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    <?php }
}
?>
