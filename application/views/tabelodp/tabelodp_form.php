<section class='content-header'>
	<h1>
		ODP
        <small>Edit Data ODP</small>
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
	    <div class='form-group'>Regional <?php echo form_error('regional') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Regional" value="<?php echo $reg; ?>" />
                                </div>
                                    
                                <div class='form-group'>Witel <?php echo form_error('witel') ?>
                                    <input type="text" class="form-control" name="witel" id="witel" placeholder="Witel" value="<?php echo $witel; ?>" />
                                    </div>
                                    
                                <div class='form-group'>STO <?php echo form_error('sto') ?>
                                    <input type="text" class="form-control" name="sto" id="sto" placeholder="STO" value="<?php echo $sto; ?>" />
                                    </div>
                                    
                                <div class='form-group'>PD Name <?php echo form_error('pd_name') ?>
                                    <input type="text" class="form-control" name="pd_name" id="pd_name" placeholder="PD Name" value="<?php echo $pd_name; ?>" />
                                    </div>
                                    
                                <div class='form-group'>ODP Name <?php echo form_error('odp_name') ?>
                                    <input type="text" class="form-control" name="odp_name" id="odp_name" placeholder="ODP Name" value="<?php echo $pd_name; ?>" />     </div> 
                                    
                                <div class='form-group'>ODP Index <?php echo form_error('odp_index') ?>
                                    <input type="text" class="form-control" name="odp_index" id="odp_index" placeholder="ODP Index" value="<?php echo $odp_index; ?>" />
                                    </div>
                                    
                                <div class='form-group'>F COOR <?php echo form_error('f_coor') ?>
                                    <input type="text" class="form-control" name="f_coor" id="f_coor" placeholder="F COOR" value="<?php echo $pd_name; ?>" />
                                    </div>
                                    
                                <div class='form-group'>F LOC <?php echo form_error('f_loc') ?>
                                    <input type="text" class="form-control" name="f_loc" id="f_loc" placeholder="F LOC" value="<?php echo $f_loc; ?>" />
                                    </div>
                                    
                                    
                                <div class='form-group'>F OLT <?php echo form_error('f_olt') ?>
                                    <input type="text" class="form-control" name="f_olt" id="f_olt" placeholder="F OLT" value="<?php echo $f_olt; ?>" />
                                    </div>
                                    
                                <div class='form-group'>Latitude <?php echo form_error('latitude') ?>
                                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" />
                                    </div>
                                    
                                    
                                <div class='form-group'>Longitude <?php echo form_error('longitude') ?>
                                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" />    </div>
                                <div class='form-group'>Is Avail <?php echo form_error('is_avail') ?>
                                    <input type="text" class="form-control" name="is_avail" id="is_avail" placeholder="IS Avail" value="<?php echo $is_avail; ?>" />       </div>         
                                <div class='form-group'>Is Blocking <?php echo form_error('is_blocking') ?>
                                    <input type="text" class="form-control" name="is_blocking" id="is_blocking" placeholder="Is Blocking" value="<?php echo $is_blocking; ?>" />
                                    </div>
                                <div class='form-group'>Is Other <?php echo form_error('is_other') ?>
                                    <input type="text" class="form-control" name="is_other" id="is_other" placeholder="Is Other" value="<?php echo $is_other; ?>" />    </div>
                                <div class='form-group'>Is Reserve <?php echo form_error('is_reserve') ?>
                                    <input type="text" class="form-control" name="is_reserve" id="is_reserve" placeholder="Is Reserve" value="<?php echo $is_reserve; ?>" />
                                </div>
                                <div class='form-group'>Is Service <?php echo form_error('is_service') ?>
                                    <input type="text" class="form-control" name="is_service" id="is_service" placeholder="Is Service" value="<?php echo $is_service; ?>" />
                                    </div>
                                 <div class='form-group'>Is Total <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Is Total" value="<?php echo $is_total; ?>" />
                                     </div>
                                 <div class='form-group'>Update Date <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Update Date" value="<?php echo $updatedate; ?>" /> 
            </div></div>
        <div class='box-footer'>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('tabelodp') ?>" class="btn btn-default">Cancel</a>
            </div>
            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</section><!-- /.content -->