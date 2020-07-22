
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
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>
                                
                                <div class='form-group'>Regional <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Regional" value="<?php echo $reg; ?>" />
                                <div class='form-group'>Witel <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Witel" value="<?php echo $witel; ?>" />                                
                                <div class='form-group'>STO <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="STO" value="<?php echo $sto; ?>" />    
                                <div class='form-group'>PD Name <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="PD Name" value="<?php echo $pd_name; ?>" />
                                <div class='form-group'>ODP Name <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ODP Name" value="<?php echo $pd_name; ?>" />        
                                <div class='form-group'>ODP Index <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ODP Index" value="<?php echo $odp_index; ?>" />
                                <div class='form-group'>F COOR <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="F COOR" value="<?php echo $pd_name; ?>" />    
                                <div class='form-group'>F LOC <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="F LOC" value="<?php echo $f_loc; ?>" />
                                <div class='form-group'>F OLT <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="F OLT" value="<?php echo $f_olt; ?>" />    
                                <div class='form-group'>Latitude <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Latitude" value="<?php echo $latitude; ?>" />
                                <div class='form-group'>Longitude <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Longitude" value="<?php echo $longitude; ?>" />    
                                <div class='form-group'>Is Avail <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="IS Avail" value="<?php echo $is_avail; ?>" />                
                                <div class='form-group'>Is Blocking <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Is Blocking" value="<?php echo $is_blocking; ?>" />  
                                <div class='form-group'>Is Other <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Is Other" value="<?php echo $is_other; ?>" />    
                                <div class='form-group'>Is Reserve <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Is Reserve" value="<?php echo $is_reserve; ?>" />    
                                <div class='form-group'>Is Service <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Is Service" value="<?php echo $is_service; ?>" />
                                 <div class='form-group'>Is Total <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Is Total" value="<?php echo $is_total; ?>" />   
                                 <div class='form-group'>Update Date <?php echo form_error('name') ?>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Update Date" value="<?php echo $updatedate; ?>" />   
                                     </div></div>
                                    </div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
                                </div>                                
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('pegawai/tabelodp') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->