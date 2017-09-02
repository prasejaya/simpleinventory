<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Pemilik</th>
        <th>User ID</th>
        <th>Nama Pemilik</th>
        <th>Alamat</th>
        <th>No. Telfon</th>
        <th class="span2">
            <a href="#modalAddPemilik" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>

<!--            <a href="#" class="btn btn-mini btn-block btn-inverse disabled" data-toggle="modal">-->
<!--                <i class="icon-plus-sign icon-white"></i> Tambah Data-->
<!--            </a>-->
        </th>
    </tr>
    </thead>
    <tbody>

    <?php
    $no=1;
    if(isset($data_pemilik)){
        foreach($data_pemilik as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kd_pemilik; ?></td>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->nm_pemilik; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->notelp; ?></td>

                <td>
                    <a class="btn btn-mini" href="#modalEditPemilik<?php echo $row->kd_pemilik?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                    <a class="btn btn-mini" href="<?php echo site_url('master/hapus_Pemilik/'.$row->kd_pemilik);?>"
                       onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>

<!--                    <a class="btn btn-mini disabled" href="#" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>-->
<!--                    <a class="btn btn-mini disabled" href="#"> <i class="icon-remove"></i> Hapus</a>-->
                </td>

            </tr>

        <?php }
    }
    ?>

    </tbody>
</table>

<!-- ============ MODAL ADD Pemilik =============== -->
<div id="modalAddPemilik" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Data Pemilik</h3>
    </div>
    <form class="form-horizontal" method="post" action="<?php echo site_url('master/tambah_Pemilik')?>">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Kode Pemilik</label>
                <div class="controls">
                    <input name="kd_Pemilik" type="text" value="<?php echo $kd_pemilik; ?>" readonly>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >User ID</label>
                <div class="controls">
                    <input name="username" type="text" required>
                </div>
            </div>

            <hr/>

            <div class="control-group">
                <label class="control-label">Nama Pemilik</label>
                <div class="controls">
                    <input name="nama" type="text">
                </div>
            </div>

            <hr/>
             <div class="control-group">
                <label class="control-label" >Alamat/label>
                <div class="controls">
                    <input name="alamat" type="text" required>
                </div>
            </div>

            <hr/>
            
             <div class="control-group">
                <label class="control-label" >No. Telp</label>
                <div class="controls">
                    <input name="notelp" type="text" required>
                </div>
            </div>

            
          
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<!-- ============ MODAL EDIT Pemilik =============== -->
<?php
if (isset($data_pemilik)){
    foreach($data_pemilik as $row){
        ?>
        <div id="modalEditPemilik<?php echo $row->kd_pemilik?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Pemilik</h3>
            </div>

            <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_Pemilik')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Kode Pemilik</label>
                        <div class="controls">
                            <input name="kd_Pemilik" type="text" value="<?php echo $row->kd_pemilik; ?>" class="uneditable-input" readonly="true">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >User ID</label>
                        <div class="controls">
                            <input name="username" type="text" value="<?php echo $row->username?>" required>
                        </div>
                    </div>

                    <hr/>

                    <div class="control-group">
                        <label class="control-label">Nama Pemilik</label>
                        <div class="controls">
                            <input name="nama" type="text" value="<?php echo $row->nm_pemilik?>">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    <?php }
}
?>