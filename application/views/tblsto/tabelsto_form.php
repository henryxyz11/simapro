
<section class='content-header'>
    <h1>
        STO
        <small>Edit Data STO</small>
    </h1>
</section>        
<section class='content'>
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                    <div class='col-md-5'>
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>
                                
                              <div class="form-group">
            <label for="varchar">Witel <?php echo form_error('witel') ?></label>
            <input type="text" class="form-control" name="witel" id="witel" placeholder="Witel" value="<?php echo $witel; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Datel <?php echo form_error('datel') ?></label>
            <input type="text" class="form-control" name="datel" id="datel" placeholder="Datel" value="<?php echo $datel; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Sto <?php echo form_error('sto') ?></label>
            <input type="text" class="form-control" name="sto" id="sto" placeholder="Sto" value="<?php echo $sto; ?>" />
        </div>
        <div class="form-group">
            <label for="decimal">Latitude <?php echo form_error('latitude') ?></label>
            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" />
        </div>
        <div class="form-group">
            <label for="decimal">Longitude <?php echo form_error('longitude') ?></label>
            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>                                 
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('pegawai/tabelsto') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->