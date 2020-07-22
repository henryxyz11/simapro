<section class='content-header'>
	<h1>
		Data ODP
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
        <form action="<?php echo $action; ?>" method="post"><div class='box-body'>
         <div class="form-group">
            <label for="varchar">Witel <?php echo form_error('witel') ?></label>
            <input type="text" class="form-control" name="witel" id="witel" placeholder="Witel" value="<?php echo $witel; ?>" />
        </div>
<!--
	    <div class="form-group">
            <label for="varchar">Kandatel <?php echo form_error('kandatel') ?></label>
            <input type="text" class="form-control" name="kandatel" id="kandatel" placeholder="Kandatel" value="<?php echo $kandatel; ?>" />
        </div>
-->
<!--
	    <div class="form-group">
            <label for="varchar">Devicesto <?php echo form_error('devicesto') ?></label>
            <input type="text" class="form-control" name="devicesto" id="devicesto" placeholder="Devicesto" value="<?php echo $devicesto; ?>" />
        </div>
-->
	    <div class="form-group">
            <label for="varchar">Sto <?php echo form_error('sto') ?></label>
            <input type="text" class="form-control" name="sto" id="sto" placeholder="Sto" value="<?php echo $sto; ?>" />
        </div>
<!--
	    <div class="form-group">
            <label for="varchar">Device Id <?php echo form_error('device_id') ?></label>
            <input type="text" class="form-control" name="device_id" id="device_id" placeholder="Device Id" value="<?php echo $device_id; ?>" />
        </div>
-->
	    <div class="form-group">
            <label for="varchar">Device Name <?php echo form_error('device_name') ?></label>
            <input type="text" class="form-control" name="device_name" id="device_name" placeholder="Device Name" value="<?php echo $device_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Latitude <?php echo form_error('latitude') ?></label>
            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Longitude <?php echo form_error('longitude') ?></label>
            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" />
        </div>
            <div class='form-group'>ODP <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ODP" value="<?php echo $odp; ?>" />
            </div></div><div class='box-footer'>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tabelpelanggan') ?>" class="btn btn-default">Cancel</a>
	 </div>
            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</section><!-- /.content -->