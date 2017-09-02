<?php
if(isset($detail_pelanggan)){
    foreach($detail_pelanggan as $row){
        ?>

        <div class="control-group ">
            <label class="control-label">Alamat</label>
            <div class="controls ">
                <input name="alamat" type="text" value="<?php echo $row->alamat; ?>" readonly="readonly">
            </div>
        </div>

         <div class="control-group ">
            <label class="control-label">No. Telp</label>
            <div class="controls ">
                <input name="notelp" type="text" value="<?php echo $row->notelp; ?>" readonly="readonly">
            </div>
        </div>
    <?php
    }
}
?>
