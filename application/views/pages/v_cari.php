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
